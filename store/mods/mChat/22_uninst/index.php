<?php
/**
*
* @package phpBB3
* @version $Id: index.php 9614 2009-06-18 11:04:54Z nickvergessen $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
define('IN_PORTAL', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'portal/includes/functions.'.$phpEx);

$portal_config = obtain_portal_config();

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('viewforum','mods/lang_portal', 'mods/milestone_congratulations'));

$template->assign_vars('IN_PORTAL', true);

display_forums('', $config['load_moderators']);

// Portal Blocks
if ($portal_config['portal_welcome'])
{
	include($phpbb_root_path . 'portal/block/welcome.'.$phpEx);
}
	
if ($portal_config['portal_advanced_stat'])
{
	include($phpbb_root_path . 'portal/block/statistics.'.$phpEx);
}

if ($portal_config['portal_friends'])
{
	include($phpbb_root_path . 'portal/block/friends.'.$phpEx);
}

if ($portal_config['portal_top_posters'])
{
	include($phpbb_root_path . 'portal/block/top_posters.'.$phpEx);
}

if ($portal_config['portal_links'])
{
	include($phpbb_root_path . 'portal/block/links.'.$phpEx);
}

if ($portal_config['portal_pay_s_block'] or ($portal_config['portal_pay_c_block']))
{
	include($phpbb_root_path . 'portal/block/donate.'.$phpEx);
}

// BEGIN Milestones
switch ($config['milestone_setting'])
{
	case 'POSTS_TOPICS_USERS':
		$typeshow = '';
	break;
	case 'POSTS':
		$typeshow = ' AND m.type = 1';
	break;
	case 'TOPICS':
		$typeshow = ' AND m.type = 2';
	break;
	case 'USERS':
		$typeshow = ' AND m.type = 3';
	break;
	case 'POSTS_TOPICS':
		$typeshow = ' AND ( m.type = 1 OR m.type = 2 )';
	break;
	case 'POSTS_USERS':
		$typeshow = ' AND ( m.type = 1 OR m.type = 3 )';
	break;
	case 'TOPICS_USERS':
		$typeshow = ' AND ( m.type = 2 OR m.type = 3 )';
	break;
	default:
		$typeshow = '';
}

$view = request_var('view', '');

if ($auth->acl_get('a_') && $view == 'all')
{
	$typeshow = '';
}

$sql_ary = array(
	'SELECT'	=> 'u.user_id, u.username, u.user_colour, m.user_id, m.milestone, m.type',
	'FROM'		=> array(
		USERS_TABLE			=> 'u',
		MILESTONES_TABLE	=> 'm',
	),
	'WHERE'		=> 'u.user_id = m.user_id' . $typeshow,
	'ORDER_BY'	=> 'm.type ASC, m.milestone DESC',
);
$result = $db->sql_query_limit($db->sql_build_query('SELECT', $sql_ary), 10);

// set variable for 'newtype' comparison
$type = '';

while ($row = $db->sql_fetchrow($result))
{
	$newtype = ($type != $row['type']) ? $row['type'] : '';

	$type = $row['type'];

	switch ($type)
	{
		case 1:
			$typetitle = $user->lang['POST'];
		break;
		case 2:
			$typetitle = $user->lang['TOPICS'];
		break;
		case 3:
			$typetitle = $user->lang['USERS'] . '#';
		break;
	}

	$template->assign_block_vars('milestone', array(
		'NUMBER'	=> $row['milestone'],
		'USER'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
		'NEWTYPE'	=> $newtype,
		'TYPE'		=> $typetitle
	));
}
$db->sql_freeresult($result);
// END Milestones

// Set some stats, get posts count from forums data if we... hum... retrieve all forums data
$total_posts	= $config['num_posts'];
$total_topics	= $config['num_topics'];
$total_users	= $config['num_users'];

$l_total_user_s = ($total_users == 0) ? 'TOTAL_USERS_ZERO' : 'TOTAL_USERS_OTHER';
$l_total_post_s = ($total_posts == 0) ? 'TOTAL_POSTS_ZERO' : 'TOTAL_POSTS_OTHER';
$l_total_topic_s = ($total_topics == 0) ? 'TOTAL_TOPICS_ZERO' : 'TOTAL_TOPICS_OTHER';

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


include($phpbb_root_path . 'includes/functions_milestones.' . $phpEx);
$user->add_lang('mods/milestone_congratulations');
// Assign index specific vars
$template->assign_vars(array(
	'MILESTONE_INFO'	=> milestone_info(),
	'MILESTONE_MESSAGE'	=> milestone_message(),
	'MILESTONE_HISTORY'	=> milestone_history(),
	'TOTAL_POSTS'	=> sprintf($user->lang[$l_total_post_s], $total_posts),
	'TOTAL_TOPICS'	=> sprintf($user->lang[$l_total_topic_s], $total_topics),
	'TOTAL_USERS'	=> sprintf($user->lang[$l_total_user_s], $total_users),
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

include($phpbb_root_path . 'includes/functions_activity_stats.' . $phpEx);
activity_mod();


// Output page
page_header($user->lang['INDEX']);

$template->set_filenames(array(
	'body' => 'index_body.html')
);

page_footer();

?>