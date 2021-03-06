<?php
/**
*
* @author idiotnesia pungkerz@gmail.com - http://www.phpbbindonesia.com
*
* @package phpBB3
* @version 0.3.1
* @copyright (c) 2008, 2009 phpbbindonesia
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/reputation_mod');

//-- mod : Community Moderation ------------------------------------------------------------
$force		= request_var('force', '');
$vmode		= request_var('vmode', '');

if (!class_exists('community_moderation'))
{
	require($phpbb_root_path . 'includes/functions_community_moderation.' . $phpEx);
}
//-- fin mod : Community Moderation --------------------------------------------------------

// Define initial vars
$mode			= request_var('mode', 'positive');
$post_id		= request_var('p', 0);
$forum_id       = request_var('f', 0);
$submit			= (isset($_POST['submit'])) ? true : false;
$cancel			= (isset($_POST['cancel'])) ? true : false;
$message		= request_var('message', '', true);
$error			= '';
$redirect		= append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'p=' . $post_id) . '#p' . $post_id;
$token          = request_var('hash', '');

$ajax = request_var('ajax', false);

if (!check_link_hash($token, "reputation_{$forum_id}"))
{
	trigger_error('RP_INVALID_HASH');
}

if ($cancel)
{
	redirect($redirect);
}

if (!$config['rp_enable'])
{
	meta_refresh(5, $redirect);
	trigger_error($user->lang['RP_DISABLED'] . '<br />' . sprintf($user->lang['RETURN_PAGE'], '<a href="' . append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'p=' . $post_id)  . '#p' . $post_id . '">', '</a>'));
}

if (!$user->data['is_registered'])
{
	login_box();
}

if (!$auth->acl_get('u_rp_give'))
{
	meta_refresh(5, $redirect);
	trigger_error($user->lang['RP_USER_DISABLED'] . '<br />' . sprintf($user->lang['RETURN_PAGE'], '<a href="' . append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'p=' . $post_id)  . '#p' . $post_id . '">', '</a>'));
}

// get post info
$poster = $reputation->get_post_info($post_id);

// some validation
if ($config['rp_forum_exclusions'])
{
	$forum_exc = explode(',', $config['rp_forum_exclusions']);
	if (in_array($poster['forum_id'], $forum_exc))
	{
		meta_refresh(5, $redirect);
		trigger_error('RP_FORUM_DISABLED');
	}
}

if ($poster['user_id'] == $user->data['user_id'])
{
	meta_refresh(5, $redirect);
	trigger_error($user->lang['RP_SELF'] . '<br />' . sprintf($user->lang['RETURN_PAGE'], '<a href="' . append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'p=' . $post_id)  . '#p' . $post_id . '">', '</a>'));
}

if ($poster['user_hide_reputation'])
{
	meta_refresh(5, $redirect);
	trigger_error('RP_USER_SELF_DISABLED');
}

$sql = 'SELECT rep_post_id
	FROM ' . REPUTATIONS_TABLE . '
	WHERE rep_from = ' . $user->data['user_id'] . '
		AND rep_post_id = ' . $post_id;
$result = $db->sql_query($sql);
$rep_post_id = $db->sql_fetchfield('rep_post_id');
$db->sql_freeresult($result);

if ($rep_post_id)
{
	meta_refresh(5, $redirect);
	trigger_error($user->lang['RP_SAME_POST'] . '<br />' . sprintf($user->lang['RETURN_PAGE'], '<a href="' . append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'p=' . $post_id)  . '#p' . $post_id . '">', '</a>'));
}

$now = time();

$sql = 'SELECT rep_to, rep_time
	FROM ' . REPUTATIONS_TABLE . '
	WHERE rep_from = ' . $user->data['user_id'] . '
	ORDER BY rep_time DESC';
$result = $db->sql_query_limit($sql, $config['rp_user_spread']);

$check['rep_to'] = array();
$check['rep_time'] = array();

while ($row = $db->sql_fetchrow($result))
{
	$check['rep_to'][] = $row['rep_to'];
	$check['rep_time'][] = $row['rep_time'];
}
$db->sql_freeresult($result);

// check reputation spread
if ($config['rp_user_spread'] && !$auth->acl_get('u_rp_ignore') && (in_array($poster['user_id'], $check['rep_to'])))
{
	meta_refresh(5, $redirect);
	trigger_error($user->lang['RP_USER_SPREAD_FIRST'] . '<br />' . sprintf($user->lang['RETURN_PAGE'], '<a href="' . append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'p=' . $post_id)  . '#p' . $post_id . '">', '</a>'));
}

if (!isset($check['rep_time'][0]))
{
	$check['rep_time'][0] = 0;
}

// check time limit
if ($config['rp_time_limitation'] && !$auth->acl_get('u_rp_ignore') && (($now - $check['rep_time'][0]) < ($config['rp_time_limitation'] * 3600)))
{
	meta_refresh(5, $redirect);
	trigger_error($user->lang['RP_TIMES_LIMIT'] . '<br />' . sprintf($user->lang['RETURN_PAGE'], '<a href="' . append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'p=' . $post_id)  . '#p' . $post_id . '">', '</a>'));
}

if ($submit && $config['rp_comment_max_chars'] && (strlen($message) > $config['rp_comment_max_chars']))
{
	$error = sprintf($user->lang['RP_TOO_LONG_COMMENT'], strlen($message), $config['rp_comment_max_chars']);
}

if ($submit && $config['rp_force_comment'] && ((utf8_clean_string($message) === '')))
{
	$error = $user->lang['RP_NO_COMMENT'];
}

//get user power
$user_power = $reputation->get_rep_power($user->data['user_posts'], $user->data['user_regdate'], $user->data['user_reputation'], $user->data['group_id']);

$form_name = 'reputation';
add_form_key($form_name);

if ($submit && !check_form_key($form_name))
{
	trigger_error($user->lang['FORM_INVALID']);
}

if ($config['rp_disable_comment'] || ($submit && !$error)) 
{
	$text = utf8_normalize_nfc($message);
	$uid = $bitfield = $options = ''; // will be modified by generate_text_for_storage
	$allow_bbcode = $allow_urls = $allow_smilies = true;
	generate_text_for_storage($text, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

	$data = array(
		'post_id'		=> $post_id,
		'time'			=> $now,
		'bitfield'		=> $bitfield,
		'uid'			=> $uid,
		'bbcode'		=> $allow_bbcode,
		'urls'			=> $allow_urls,
		'smilies'		=> $allow_smilies,
		'comment'		=> $text,
		'ip_address'	=> $user->ip
	);

    $community_moderation = new community_moderation();
    $community_moderation->record_vote_info($mode, $post_id, $forum_id, $data);

    meta_refresh(3, $redirect);

    if ($config['rp_disable_comment'])
    {
        redirect($redirect);
    }

    trigger_error($user->lang['RP_SENT'] . '<br />' . sprintf($user->lang['RETURN_PAGE'], '<a href="' . $redirect . '">', '</a>'));
}


$template->assign_vars(array(
	'POSITIVE'			=> ($mode == 'positive') ? true : false,
	'S_GIVE_NEGATIVE'	=> ($auth->acl_get('u_rp_give_negative')) ? true : false,
    'S_AJAX'            => $ajax,
	'ERROR'				=> ($error) ? $error : '',
	'COMMENT'			=> $message,
	'REP_KEY'           => md5($user->session_id),
	'U_POST_ACTION'		=> append_sid("{$phpbb_root_path}reputation.$phpEx", 'p=' . $post_id . '&amp;f=' . $forum_id . '&amp;hash=' . generate_link_hash("reputation_{$forum_id}")),)

);


page_header($user->lang['RP_TITLE']);

$template->set_filenames(array(
	'body' => 'reputation_body.html')
);


page_footer();


?>