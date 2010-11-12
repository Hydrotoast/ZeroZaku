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
include($phpbb_root_path . 'includes/functions_user.'.$phpEx);
include($phpbb_root_path . 'portal/includes/functions.'.$phpEx);

$portal_config = obtain_portal_config();

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('viewforum','mods/lang_portal'));

$template->assign_vars('IN_PORTAL', true);

display_forums('', $config['load_moderators']);

// Portal Blocks
if ($portal_config['portal_welcome'])
{
	include($phpbb_root_path . 'portal/block/welcome.'.$phpEx);
}

if ($portal_config['portal_top_posters'])
{
	include($phpbb_root_path . 'portal/block/top_posters.'.$phpEx);
}

if ($portal_config['portal_recent']) 
{ 
	include($phpbb_root_path . 'portal/block/popular.'.$phpEx);
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
$sql = 'SELECT c.message,  u.user_id, u.username, u.user_colour
	FROM ' . CHAT_STATUS_TABLE . ' c INNER JOIN ' . USERS_TABLE . ' u
		ON c.userid = u.user_id
	ORDER BY c.lastchange DESC
	LIMIT 0, 10';
$result = $db->sql_query($sql);

while($row = $db->sql_fetchrow($result))
{
	$template->assign_block_vars('user_statuses', array(
		  'USERNAME'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
	    'STATUS'	=> $row['message'],
	));
}
// END USER STATUSES

// BEGIN FACTION RECOMMENDATIONS 
$sql = 'SELECT COUNT(*) AS count FROM ' . GROUPS_TABLE . ' g
	JOIN ' . USER_GROUP_TABLE . ' ug
		ON ug.group_id = g.group_id
	WHERE ug.user_id = ' . $user->data['user_id'] . '
		AND g.group_faction = 1';
$result = $db->sql_query($sql);
$memberships = $db->sql_fetchfield('count');
$db->sql_freeresult($result);

if(!$memberships)
{
	$sql = 'SELECT g.group_id, g.group_name, f.forum_name FROM ' .  GROUPS_TABLE . ' g
		JOIN ' . ACL_GROUPS_TABLE . ' ag
			ON g.group_id = ag.group_id
		JOIN ' . FORUMS_TABLE . ' f
			ON ag.forum_id = f.forum_id
		WHERE g.group_faction = 1
		LIMIT 0, 5';
	$result = $db->sql_query($sql);
	
	$sql = 'SELECT g.group_id, g.group_name, f.forum_name FROM ' .  GROUPS_TABLE . ' g
		JOIN ' . ACL_GROUPS_TABLE . ' ag
			ON g.group_id = ag.group_id
		JOIN ' . FORUMS_TABLE . ' f
			ON ag.forum_id = f.forum_id
		WHERE g.group_faction = 1
		LIMIT 0, 5';
	$result = $db->sql_query($sql);
	
	while($row = $db->sql_fetchrow($result))
	{
	    $group_id = $row['group_id'];
	    $template->assign_block_vars('faction_rec', array(
	        'NAME'	    => $row['group_name'],
	        'FORUM'		=> $row['forum_name'],
	        'U_JOIN'	=> append_sid("{$phpbb_root_path}ucp.$phpEx", "i=groups&mode=membership")
	    ));
	}
	    
	$db->sql_freeresult($result);
}
// END FACTION RECOMMENDATIONS

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

// BEGIN MUTUAL FRIENDS
include($phpbb_root_path . 'includes/functions_mutual_friends.' . $phpEx);
get_recommended_friends();
// END MUTUALS


/**
* Ultimate Points
*/
if ( isset($config['points_name']) )
{	
	// Add points lang
	$user->add_lang('mods/points');

	// Generate the bank statistics
	$sql_array = array(
		'SELECT'    => 'SUM(holding) AS total_holding, count(user_id) AS total_users',
		'FROM'      => array(
			POINTS_BANK_TABLE => 'b',
		),
		'WHERE'		=> 'id > 0',
	);
	$sql = $db->sql_build_query('SELECT', $sql_array);
	$result = $db->sql_query($sql);
	$b_row = $db->sql_fetchrow($result);
	$bankholdings = ( $b_row['total_holding'] ) ? $b_row['total_holding'] : 0;
	$bankusers = $b_row['total_users'];

	// Create most rich users - cash and bank
	$limit = $points_values['number_show_top_points'];
	$sql_array = array(
		'SELECT'    => 'u.user_id, u.username, u.user_colour, u.user_points, b.holding',

		'FROM'      => array(
			USERS_TABLE  => 'u',
		),
		'LEFT_JOIN' => array(
			array(
				'FROM'  => array(POINTS_BANK_TABLE => 'b'),
				'ON'    => 'u.user_id = b.user_id'
			)
		),
	);
	$sql = $db->sql_build_query('SELECT', $sql_array);
	$result = $db->sql_query($sql);

	// Create a new array for the users
	$rich_users = array();

	// Create sorting array
	$rich_users_sort = array();

	// Loop all users array to escape the 0 points users
	while( $row = $db->sql_fetchrow($result))
	{
		if ( $row['user_points'] > 0 || $row['holding'] > 0 ) //let away beggars
		{
			$total_points = $row['user_points'] + $row['holding'];
			$index = $row['user_id'];
			$rich_users[$index] = array('total_points' => $total_points, 'username' => $row['username'], 'user_colour' => $row['user_colour'], 'user_id' => $index);
			$rich_users_sort[$index] = $total_points;
		}
	}

	$db->sql_freeresult($result);

	// Sort by points desc
	arsort( $rich_users_sort);

	// Extract the user ids
	$rich_users_sort  = array_keys($rich_users_sort);

	// Create new sorted rich users array
	$rich_users_sorted = array();

	// Check, if number of users in array is below the set limit
	$new_limit = sizeof($rich_users) < $limit ? sizeof($rich_users) : $limit;

	for($i = 0; $i < $new_limit; $i++)
	{
		$rich_users_sorted[] = $rich_users[$rich_users_sort[$i]];
	}

	// Send to template
	foreach($rich_users_sorted as $var)
	{
		$template->assign_block_vars('rich_user', array(
			'USERNAME'         => get_username_string('full', $var['user_id'], $var['username'], $var['user_colour']),
			'SUM_POINTS'      => number_format_points($var['total_points']),
			'SUM_POINTS_NAME'   => $config['points_name'],
		));
	}

	//Generate the points statistics
	$sql_array = array(
		'SELECT'    => 'SUM(user_points) AS total_points',
		'FROM'      => array(
			USERS_TABLE => 'u',
		),
		'WHERE'		=> 'user_id > 0',
	);
	$sql = $db->sql_build_query('SELECT', $sql_array);
	$result = $db->sql_query($sql);
	$b_row = $db->sql_fetchrow($result);
	$totalpoints = ( $b_row['total_points'] ) ? $b_row['total_points'] : 0;
	$lottery_time = $user->format_date(($points_values['lottery_last_draw_time'] + $points_values['lottery_draw_period']), false, true);

	// Run Lottery
	if ( $points_values['lottery_draw_period'] != 0 && $points_values['lottery_last_draw_time'] + $points_values['lottery_draw_period'] - time() < 0 )
	{
		if (!function_exists('run_lottery'))
		{
			include($phpbb_root_path . 'includes/points/functions_points.' . $phpEx);
		}
		if (!function_exists('send_pm'))
		{
			include($phpbb_root_path . 'includes/functions_privmsgs.' . $phpEx);
		}
		run_lottery();
	}

	$template->assign_vars(array(
		'TOTAL_BANK_USER'			=> sprintf($user->lang['POINTS_BUPOINTS_TOTAL'], $bankusers, $points_values['bank_name']),
		'TOTAL_BANK_POINTS'			=> sprintf($user->lang['POINTS_BPOINTS_TOTAL'], number_format_points($bankholdings), $config['points_name'], $points_values['bank_name']),
		'TOTAL_POINTS_USER'			=> sprintf($user->lang['POINTS_TOTAL'], number_format_points($totalpoints), $config['points_name']),
		'LOTTERY_TIME'				=> sprintf($user->lang['POINTS_LOTTERY_TIME'], $lottery_time),
		'S_DISPLAY_LOTTERY'			=> ($points_config['display_lottery_stats']) ? true : false,
		'S_DISPLAY_POINTS_STATS'	=> ($points_config['stats_enable']) ? true : false,
		'S_DISPLAY_INDEX'			=> ($points_values['number_show_top_points'] > 0) ? true : false,
	));
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

include($phpbb_root_path . 'includes/functions_activity_stats.' . $phpEx);
activity_mod();

// Output page
page_header($user->lang['INDEX']);

$template->set_filenames(array(
	'body' => 'index_body.html')
);

page_footer();

?>