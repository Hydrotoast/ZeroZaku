<?php
/** 
*
* @package phpBB3
* @version $Id: quick_reply.php,v 1.6.4 2007/12/22 01:10:26 rxu Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Minimum Requirement: PHP 4.3.3
*/

/**
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

$quick_reply = false;
$mode = (isset($topic_id)) ? 'reply' : 'post';

$quick_reply_userprefs = ($user->optionget('viewquick' . $mode)) ? true : false;
$quick_reply_guests = ($user->data['user_id'] == ANONYMOUS && $config['allow_quick_' . $mode] == 2) ? true : false;
$quick_reply_display = ($user->data['user_id'] == ANONYMOUS) ? $quick_reply_guests : $quick_reply_userprefs;

if ($config['allow_quick_' . $mode] && $quick_reply_display)
{
	$main_data = array();
	$main_data = ($mode == 'reply') ? $topic_data : $forum_data;
	
	if ($auth->acl_get('f_' . $mode, $forum_id))
	{
		$quick_reply = true;
	}

	if ($main_data['forum_type'] != FORUM_POST)
	{
		$quick_reply = false;
	}

	if (($main_data['forum_status'] == ITEM_LOCKED || (isset($main_data['topic_status']) && $main_data['topic_status'] == ITEM_LOCKED)) && !$auth->acl_get('m_edit', $forum_id))
	{
		$quick_reply = false;
	}
}

if ($quick_reply)
{
	include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
	$user->add_lang(array('posting', 'mcp', 'mods/quick_reply'));

	// Set some default variables
	$uninit = array('post_attachment' => 0, 'poster_id' => $user->data['user_id'], 'enable_magic_url' => 0, 'topic_status' => 0, 'topic_type' => POST_NORMAL, 'post_subject' => '', 'topic_title' => '', 'post_time' => 0, 'post_edit_reason' => '', 'notify_set' => 0);
	foreach ($uninit as $var_name => $default_value)
	{
		if (!isset($main_data[$var_name]))
		{
			$main_data[$var_name] = $default_value;
		}
	}
	unset($uninit);

	$options = array('allow_' . $mode . '_icons' => 1, 'allow_' . $mode . '_checkboxes' => 2, 'allow_' . $mode . '_attachbox' => 3, 'allow_' . $mode . '_smilies' => 4);
	foreach ($options as $key => $value)
	{
		$config[$key] = ($config['allow_quick_' . $mode . '_options'] & 1 << $value) ? 1 : 0;

	}
	
	$bbcode_status	= ($config['allow_bbcode'] && $auth->acl_get('f_bbcode', $forum_id)) ? true : false;
	$smilies_status	= ($bbcode_status && $config['allow_smilies'] && $auth->acl_get('f_smilies', $forum_id)) ? true : false;
	$img_status		= ($bbcode_status && $auth->acl_get('f_img', $forum_id)) ? true : false;
	$url_status		= ($config['allow_post_links']) ? true : false;
	$flash_status	= ($bbcode_status && $auth->acl_get('f_flash', $forum_id) && $config['allow_post_flash']) ? true : false;
	$quote_status	= ($auth->acl_get('f_' . $mode, $forum_id)) ? true : false;

	if ($config['allow_' . $mode . '_smilies'])
	{
		generate_smilies('inline', $forum_id);
	}
	
	$s_topic_icons = false;
	if ($main_data['enable_icons'] && $auth->acl_get('f_icons', $forum_id) && $config['allow_' . $mode . '_icons'])
	{
		$s_topic_icons = posting_gen_topic_icons($mode, ($mode == 'reply') ? $main_data['icon_id'] : '');
	}

	$bbcode_checked		= ($config['allow_bbcode']) ? !$user->optionget('bbcode') : 1;
	$smilies_checked	= ($config['allow_smilies']) ? !$user->optionget('smilies') : 1;
	$urls_checked		= false;
	$sig_checked		= ($config['allow_sig'] && $user->optionget('attachsig')) ? true: false;
	$lock_topic_checked	= (isset($main_data['topic_status']) && $main_data['topic_status'] == ITEM_LOCKED) ? 1 : 0;

	// Check if user is watching this topic
	if ($mode != 'post' && $config['allow_topic_notify'] && $user->data['is_registered'])
	{
		$sql = 'SELECT topic_id
			FROM ' . TOPICS_WATCH_TABLE . '
			WHERE topic_id = ' . $topic_id . '
				AND user_id = ' . $user->data['user_id'];
		$result = $db->sql_query($sql);
		$main_data['notify_set'] = (int) $db->sql_fetchfield('topic_id');
		$db->sql_freeresult($result);
	}
	
	// If the user is replying or posting and not already watching this topic but set to always being notified we need to overwrite this setting
	$notify_set			= ($mode != 'edit' && $config['allow_topic_notify'] && $user->data['is_registered'] && !$main_data['notify_set']) ? $user->data['user_notify'] : $main_data['notify_set'];
	$notify_checked		= ($mode == 'post') ? $user->data['user_notify'] : $notify_set;

	// Action URL, include session_id for security purpose
	$s_action = append_sid("{$phpbb_root_path}posting.$phpEx", "mode=$mode&amp;f=$forum_id", true, $user->session_id);
	$s_action .= (isset($topic_id) && $topic_id) ? "&amp;t=$topic_id" : '';

	// Visual Confirmation
	$solved_captcha = false;

	if ($config['enable_post_confirm'] && !$user->data['is_registered'] && $solved_captcha === false && ($mode == 'post' || $mode == 'reply' || $mode == 'quote'))
	{
		// Show confirm image
		$sql = 'DELETE FROM ' . CONFIRM_TABLE . "
			WHERE session_id = '" . $db->sql_escape($user->session_id) . "'
				AND confirm_type = " . CONFIRM_POST;
		$db->sql_query($sql);

		// Generate code
		$code = gen_rand_string(mt_rand(5, 8));
		$confirm_id = md5(unique_id($user->ip));
		$seed = hexdec(substr(unique_id(), 4, 10));

		// compute $seed % 0x7fffffff
		$seed -= 0x7fffffff * floor($seed / 0x7fffffff);

		$sql = 'INSERT INTO ' . CONFIRM_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'confirm_id'	=> (string) $confirm_id,
			'session_id'	=> (string) $user->session_id,
			'confirm_type'	=> (int) CONFIRM_POST,
			'code'			=> (string) $code,
			'seed'			=> (int) $seed)
		);
		$db->sql_query($sql);

		$template->assign_vars(array(
			'S_CONFIRM_CODE'			=> true,
			'CONFIRM_ID'				=> $confirm_id,
			'CONFIRM_IMAGE'				=> '<img src="' . append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=confirm&amp;id=' . $confirm_id . '&amp;type=' . CONFIRM_POST) . '" alt="" title="" />',
			'L_POST_CONFIRM_EXPLAIN'	=> sprintf($user->lang['POST_CONFIRM_EXPLAIN'], '<a href="mailto:' . htmlspecialchars($config['board_contact']) . '">', '</a>'),
		));
	}

	$s_hidden_fields = ($mode == 'reply' || $mode == 'quote') ? '<input type="hidden" name="topic_cur_post_id" value="' . $main_data['topic_last_post_id'] . '" />' : '';
	$s_hidden_fields .= '<input type="hidden" name="lastclick" value="' . time() . '" />';

	// Add default subject
	$subject = '';
	if ($mode == 'reply')
	{
		$subject = ((strpos($main_data['topic_title'], 'Re: ') !== 0) ? 'Re: ' : '') . censor_text($main_data['topic_title']);
	}
	
	// Add form encoding type
	$form_enctype = (@ini_get('file_uploads') == '0' || strtolower(@ini_get('file_uploads')) == 'off' || @ini_get('file_uploads') == '0' || !$config['allow_attachments'] || !$auth->acl_get('u_attach') || !$auth->acl_get('f_attach', $forum_id)) ? '' : ' enctype="multipart/form-data"';

	// Attachment entry
	// Not using acl_gets here, because it is using OR logic
	$show_attach_box = false;
	if ($auth->acl_get('f_attach', $forum_id) && $auth->acl_get('u_attach') && $config['allow_attachments'] && $form_enctype && $config['allow_' . $mode . '_attachbox'])
	{
		$show_attach_box = true;
	}	

	$extra_options_display = ($config['allow_' . $mode . '_checkboxes']) ? 'show' : 'none';
	add_form_key('posting');

	// Send vars to template
	$template->assign_vars(array(

		'QUICK_REPLY'			=> $quick_reply,
		'EXTRA_OPTIONS_DISPLAY'	=> $extra_options_display,
		'SUBJECT'				=> $subject,
		
		'SMILIES_STATUS'		=> ($smilies_status) ? $user->lang['SMILIES_ARE_ON'] : $user->lang['SMILIES_ARE_OFF'],
		'BBCODE_STATUS'			=> ($bbcode_status) ? sprintf($user->lang['BBCODE_IS_ON'], '<a href="' . append_sid("{$phpbb_root_path}faq.$phpEx", 'mode=bbcode') . '">', '</a>') : sprintf($user->lang['BBCODE_IS_OFF'], '<a href="' . append_sid("{$phpbb_root_path}faq.$phpEx", 'mode=bbcode') . '">', '</a>'),
		'IMG_STATUS'			=> ($img_status) ? $user->lang['IMAGES_ARE_ON'] : $user->lang['IMAGES_ARE_OFF'],
		'FLASH_STATUS'			=> ($flash_status) ? $user->lang['FLASH_IS_ON'] : $user->lang['FLASH_IS_OFF'],
		'SMILIES_STATUS'		=> ($smilies_status) ? $user->lang['SMILIES_ARE_ON'] : $user->lang['SMILIES_ARE_OFF'],
		'URL_STATUS'			=> ($bbcode_status && $url_status) ? $user->lang['URL_IS_ON'] : $user->lang['URL_IS_OFF'],
		
		'L_QUICK_REPLY'				=> $user->lang['QUICK_' . strtoupper($mode)],
		'L_ICON'					=> ($mode == 'reply') ? $user->lang['POST_ICON'] : $user->lang['TOPIC_ICON'],
		'L_MESSAGE_BODY_EXPLAIN'	=> (intval($config['max_post_chars'])) ? sprintf($user->lang['MESSAGE_BODY_EXPLAIN'], intval($config['max_post_chars'])) : '',
		
		'S_DISPLAY_USERNAME'		=> (!$user->data['is_registered']) ? true : false,	
		'S_SHOW_TOPIC_ICONS'		=> $s_topic_icons,
		'S_SMILIES_ALLOWED'			=> ($smilies_status && $config['allow_' . $mode . '_smilies']) ? true : false,
		'S_BBCODE_ALLOWED'			=> $bbcode_status,
		'S_BBCODE_CHECKED'			=> ($bbcode_checked) ? ' checked="checked"' : '',
		'S_SMILIES_ALLOWED'			=> $smilies_status,
		'S_SMILIES_CHECKED'			=> ($smilies_checked) ? ' checked="checked"' : '',
		'S_SIG_ALLOWED'				=> ($auth->acl_get('f_sigs', $forum_id) && $config['allow_sig'] && $user->data['is_registered']) ? true : false,
		'S_SIGNATURE_CHECKED'		=> ($sig_checked) ? ' checked="checked"' : '',
		'S_NOTIFY_ALLOWED'			=> (!$user->data['is_registered'] || !$config['allow_topic_notify'] || !$config['email_enable']) ? false : true,
		'S_NOTIFY_CHECKED'			=> ($notify_checked) ? ' checked="checked"' : '',
		'S_LOCK_TOPIC_ALLOWED'		=> (($mode == 'edit' || $mode == 'reply' || $mode == 'quote') && ($auth->acl_get('m_lock', $forum_id) || ($auth->acl_get('f_user_lock', $forum_id) && $user->data['is_registered'] && !empty($main_data['topic_poster']) && $user->data['user_id'] == $main_data['topic_poster'] && $main_data['topic_status'] == ITEM_UNLOCKED))) ? true : false,
		'S_LOCK_TOPIC_CHECKED'		=> ($lock_topic_checked) ? ' checked="checked"' : '',
		'S_LINKS_ALLOWED'			=> $url_status,
		'S_MAGIC_URL_CHECKED'		=> ($urls_checked) ? ' checked="checked"' : '',
		
		'S_BBCODE_IMG'			=> $img_status,
		'S_BBCODE_URL'			=> $url_status,
		'S_BBCODE_FLASH'		=> $flash_status,
		'S_BBCODE_QUOTE'		=> $quote_status,
		'S_SHOW_ATTACH_BOX'		=> $show_attach_box,
		'S_PRIVMSGS'			=> false,
		
		'S_HIDDEN_FIELDS'		=> $s_hidden_fields,
		'S_FORM_ENCTYPE'		=> $form_enctype,
		'S_POST_ACTION'			=> $s_action )

	);
	
	// Build custom bbcodes array
	display_custom_bbcodes();
}
	
?>