<?php

/**
*
* @package - Board3portal
* @version $Id: portal.php 494 2009-03-28 14:14:34Z Christian_N $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/


define('IN_PHPBB', true);
define('IN_PORTAL', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'portal/includes/functions.'.$phpEx);

$portal_config = obtain_portal_config();

if (!$portal_config['portal_enable'])
{
	// Redirect the user to the installer
	// We have to generate a full HTTP/1.1 header here since we can't guarantee to have any of the information
	// available as used by the redirect function
	$server_name = (!empty($_SERVER['HTTP_HOST'])) ? strtolower($_SERVER['HTTP_HOST']) : ((!empty($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : getenv('SERVER_NAME'));
	$server_port = (!empty($_SERVER['SERVER_PORT'])) ? (int) $_SERVER['SERVER_PORT'] : (int) getenv('SERVER_PORT');
	$secure = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 1 : 0;

	$script_name = (!empty($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : getenv('PHP_SELF');
	if (!$script_name)
	{
		$script_name = (!empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
	}

	// Replace any number of consecutive backslashes and/or slashes with a single slash
	// (could happen on some proxy setups and/or Windows servers)
	$script_path = trim(dirname($script_name)) . '/'.$phpbb_root_path.'index.' . $phpEx;
	$script_path = preg_replace('#[\\\\/]{2,}#', '/', $script_path);

	$url = (($secure) ? 'https://' : 'http://') . $server_name;

	if ($server_port && (($secure && $server_port <> 443) || (!$secure && $server_port <> 80)))
	{
		// HTTP HOST can carry a port number...
		if (strpos($server_name, ':') === false)
		{
			$url .= ':' . $server_port;
		}
	}

	$url .= $script_path;
	header('Location: ' . $url);
	exit;
}

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/lang_portal');

if ( is_file( $phpbb_root_path . 'install/index.'.$phpEx ) === TRUE && ($user->data['user_type'] == USER_FOUNDER) )
{
		$template->assign_vars(array(
			'S_DISPLAY_GENERAL'	=> true,
			'GEN_TITLE'				=> $user->lang['PORTAL_INSTALL'],
			'GEN_MESSAGE'			=> $user->lang['PORTAL_INSTALL_TEXT']
		));
}

// Portal Blocks
if ($portal_config['portal_welcome'])
{
	include($phpbb_root_path . 'portal/block/welcome.'.$phpEx);
}

if ($portal_config['portal_recent']) 
{ 
	include($phpbb_root_path . 'portal/block/recent.'.$phpEx);
}

if ($portal_config['portal_recent']) 
{ 
	include($phpbb_root_path . 'portal/block/popular.'.$phpEx);
}

if ($portal_config['portal_top_posters'])
{
	include($phpbb_root_path . 'portal/block/top_posters.'.$phpEx);
}

function get_db_stat($mode)
{
	global $db, $user;

	switch($mode)
	{
		case 'announcementtotal':
			$sql = 'SELECT COUNT(distinct t.topic_id) AS announcement_total
				FROM ' . TOPICS_TABLE . ' t, ' . POSTS_TABLE . ' p
				WHERE t.topic_type = ' . POST_ANNOUNCE . '
					AND p.post_id = t.topic_first_post_id';
		break;
		case 'stickytotal':
			$sql = 'SELECT COUNT(distinct t.topic_id) AS sticky_total
				FROM ' . TOPICS_TABLE . ' t, ' . POSTS_TABLE . ' p
				WHERE t.topic_type = ' . POST_STICKY . '
					AND p.post_id = t.topic_first_post_id';
		break;
		case 'attachmentstotal':
			$sql = 'SELECT COUNT(attach_id) AS attachments_total
					FROM ' . ATTACHMENTS_TABLE;
		break;
	}
	
	if (!($result = $db->sql_query($sql)))
		return false;

	$row = $db->sql_fetchrow($result);
 
	switch ($mode)
	{
		case 'announcementtotal':
			return $row['announcement_total'];
		break;
		case 'stickytotal':
			return $row['sticky_total'];
		break;
		case 'attachmentstotal':
			return $row['attachments_total'];
		break;
	}
	return false;
}

// BEGIN USER STATUSES
$sql = 'SELECT uim.user_status,  u.user_id, u.username, u.user_colour
	FROM ' . USERS_IM_TABLE . ' uim INNER JOIN ' . USERS_TABLE . ' u
		ON uim.user_id = u.user_id
	ORDER BY uim.user_lastchange DESC
	LIMIT 0, 10';
$result = $db->sql_query($sql);

while($row = $db->sql_fetchrow($result))
{
	$template->assign_block_vars('user_statuses', array(
		'USERNAME'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
	    'STATUS'	=> $row['user_status'],
	));
}
// END USER STATUSES

// BEGIN mChat Mod
if(!defined('MCHAT_INCLUDE') && $config['mchat_on_index'] && $config['mchat_enable'] && $auth->acl_get('u_mchat_view') && $user->optionget('mchat'))
{
	define('MCHAT_INCLUDE', true);
	$mchat_include_index = true;
	include($phpbb_root_path.'chat.'.$phpEx);
}
// END mChat Mod

include($phpbb_root_path . 'includes/functions_activity_stats.' . $phpEx);
activity_mod();

// BEGIN USER COLUMN

// Get user...
$sql = 'SELECT u.*, im.user_status
  FROM ' . USERS_TABLE . ' u
  JOIN ' . USERS_IM_TABLE . ' im
    ON u.user_id = im.user_id
  WHERE u.user_posts > 0 
    AND u.user_warnings < 2 
    AND u.user_id <> ' . ANONYMOUS. '
    AND im.user_status <> ""
  ORDER BY RAND()
  LIMIT 0, 6';
$result = $db->sql_query($sql);

while($row = $db->sql_fetchrow($result))
{
    get_user_rank($row['user_rank'], false, $row['rank_title'], $row['rank_image'], $row['rank_image_src']);
    $member = array();
    
	$id_cache[] = $member;
    
    $member = array(
      'USERNAME'          => get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
      'AVATAR'            => ($user->optionget('viewavatars')) ? get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height']) : '',
      'USER_ID'           => $row['user_id'],
      'RANK_TITLE'        => $row['rank_title'],
      'RANK_IMG'          => $row['rank_image'],
      'RANK_IMG_SRC'      => $row['rank_image_src'],
			'JOINED'            => $user->format_date($row['user_regdate'], "M jS Y", true),
			'POSTS'             => $row['user_posts'],
			'FROM'              => (!empty($row['user_from'])) ? $row['user_from'] : '',
      'STATUS'            => ($row['user_status']) ? $row['user_status'] : '',
    );

    $template->assign_block_vars('user_column', $member);
}
$db->sql_freeresult($result);
// END USER COLUMN

// Grab group details for legend display
if ($auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel'))
{
	$sql = 'SELECT group_id, group_name, group_colour, group_type
		FROM ' . GROUPS_TABLE . '
		WHERE group_legend = 1
		ORDER BY group_name ASC';
}
else
{
	$sql = 'SELECT g.group_id, g.group_name, g.group_colour, g.group_type
		FROM ' . GROUPS_TABLE . ' g
		LEFT JOIN ' . USER_GROUP_TABLE . ' ug
			ON (
				g.group_id = ug.group_id
				AND ug.user_id = ' . $user->data['user_id'] . '
				AND ug.user_pending = 0
			)
		WHERE g.group_legend = 1
			AND (g.group_type <> ' . GROUP_HIDDEN . ' OR ug.user_id = ' . $user->data['user_id'] . ')
		ORDER BY g.group_name ASC';
}
$result = $db->sql_query($sql);

$legend = array();
while ($row = $db->sql_fetchrow($result))
{
	$colour_text = ($row['group_colour']) ? ' style="color:#' . $row['group_colour'] . '"' : '';
	$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name'];

	if ($row['group_name'] == 'BOTS' || ($user->data['user_id'] != ANONYMOUS && !$auth->acl_get('u_viewprofile')))
	{
		$legend[] = '<span' . $colour_text . '>' . $group_name . '</span>';
	}
	else
	{
		$legend[] = '<a' . $colour_text . ' href="' . append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=group&amp;g=' . $row['group_id']) . '">' . $group_name . '</a>';
	}
}
$db->sql_freeresult($result);

$legend = implode(', ', $legend);

// Generate birthday list if required ...
$birthday_list = '';
if ($config['load_birthdays'] && $config['allow_birthdays'])
{
	$now = getdate(time() + $user->timezone + $user->dst - date('Z'));
	$sql = 'SELECT u.user_id, u.username, u.user_colour, u.user_birthday
		FROM ' . USERS_TABLE . ' u
		LEFT JOIN ' . BANLIST_TABLE . " b ON (u.user_id = b.ban_userid)
		WHERE (b.ban_id IS NULL
			OR b.ban_exclude = 1)
			AND u.user_birthday LIKE '" . $db->sql_escape(sprintf('%2d-%2d-', $now['mday'], $now['mon'])) . "%'
			AND u.user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ')';
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$birthday_list .= (($birthday_list != '') ? ', ' : '') . get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);

		if ($age = (int) substr($row['user_birthday'], -4))
		{
			$birthday_list .= ' (' . ($now['year'] - $age) . ')';
		}
	}
	$db->sql_freeresult($result);
}

// Assign index specific vars
$template->assign_vars(array(
	'TOTAL_POSTS'	=> $config['num_posts'],
	'TOTAL_TOPICS'	=> $config['num_topics'],
	'TOTAL_USERS'	=> $config['num_users'],
    'S_ANN'			=> get_db_stat('announcementtotal'),
	'S_SCT'			=> get_db_stat('stickytotal'),
	'S_TOT_ATTACH'	=> ($config['allow_attachments']) ? get_db_stat('attachmentstotal') : 0,
	'NEWEST_USER'	=> sprintf($user->lang['NEWEST_USER'], get_username_string('full', $config['newest_user_id'], $config['newest_username'], $config['newest_user_colour'])),

	'LEGEND'		=> $legend,
	'BIRTHDAY_LIST'	=> $birthday_list,

	'FORUM_IMG'				=> $user->img('forum_read', 'NO_NEW_POSTS'),
	'FORUM_NEW_IMG'			=> $user->img('forum_unread', 'NEW_POSTS'),
	'FORUM_LOCKED_IMG'		=> $user->img('forum_read_locked', 'NO_NEW_POSTS_LOCKED'),
	'FORUM_NEW_LOCKED_IMG'	=> $user->img('forum_unread_locked', 'NO_NEW_POSTS_LOCKED'),

	'S_DISPLAY_BIRTHDAY_LIST'	=> ($config['load_birthdays']) ? true : false,

	'U_MARK_FORUMS'		=> ($user->data['is_registered'] || $config['load_anon_lastread']) ? append_sid("{$phpbb_root_path}index.$phpEx", 'hash=' . generate_link_hash('global') . '&amp;mark=forums') : '',
	'U_MCP'				=> ($auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=main&amp;mode=front', true, $user->session_id) : '')
);

// output page
page_header($user->lang['PORTAL']);

$template->set_filenames(array(
	'body' => '/portal/portal_body.html'
));

page_footer();

?>