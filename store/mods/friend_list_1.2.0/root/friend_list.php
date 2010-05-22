<?php
/**
*
* @author Ian Taylor, Platinum2007 iantaylor603@gmail.com - http://street-steeze.com
*
* @package Profile friends list
* @version 1.2.0
* @copyright (c) Street Steeze, Ian-Taylor.ca street-steeze.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
// php extension using

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('memberlist');
page_header($user->lang['FRIEND_LIST']);

$template->set_filenames(array(
    'body' => 'friend_list_body.html',
));

$user_id = request_var('u', 0);

// check if there is a user_id
if(!$user_id)
{
   trigger_error($user->lang['NO_FRIEND']);
}


// some needed variables
$user_id = request_var('u', 0);
$start   = request_var('start', 0);
$limit = request_var('limit', intval($config['number_friends']));
$first_char = request_var('first_char', '');
	
// check the mode, escape the variables for use way down in the counting of friends
if($first_char)
{

	$where = 'u.user_id=z.zebra_id AND z.friend = 1 AND z.user_id = '.$user_id.' AND u.username_clean ' . $db->sql_like_expression(substr($first_char, 0, 1) . $db->any_char);
	$pagination_friend = append_sid($phpbb_root_path . 'friend_list.' . $phpEx ,'u='.$user_id.'&amp;first_char='.$first_char);
		
}
else
{

	$where = ' u.user_id=z.zebra_id AND z.friend = 1 AND z.user_id ='.$user_id;
	$pagination_friend = append_sid($phpbb_root_path . 'friend_list.' . $phpEx ,'u='.$user_id);

}

$sort_url = append_sid($phpbb_root_path . 'friend_list.' . $phpEx ,'u='.$user_id);

// time to make the babies
$sql = $db->sql_build_query('SELECT', array(
	'SELECT'	=> 'u.user_avatar, u.username, u.user_colour, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height, z.user_id, u.user_regdate, u.user_lastvisit, user_posts, z.zebra_id, z.friend',
	'FROM'		=> array(
		USERS_TABLE		=> 'u',
	),
	'LEFT_JOIN'	=> array(
		array(
			'FROM'	=> array(ZEBRA_TABLE => 'z'),
			'ON'	=> 'u.user_id=z.zebra_id'		
		)
	),
		'WHERE'		=> $where,
		'ORDER_BY'	=> 'z.zebra_id'
	));

$result = $db->sql_query_limit($sql, $limit, $start);
         
while($row_av = $db->sql_fetchrow( $result )) 
{

	$avatar_friend = get_user_avatar($row_av['user_avatar'], $row_av['user_avatar_type'], $row_av['user_avatar_width'],$row_av['user_avatar_height']);

	$friend_id = $row_av['zebra_id'];
	$avatar_size_size = $config['friend_avatar_size'];

	$template->assign_block_vars('fri',array(

      	'FRI_ID'   			=> $row_av['zebra_id'],
      	'FRI_AV'   			=> $avatar_friend,
      	'USERNAME'   		=> get_username_string('full', $row_av['zebra_id'], $row_av['username'], $row_av['user_colour']),
      	'WIDTH'				=> $config['friend_avatar_size'],
        'USER_COLOR' 		=> $row_av['user_colour'],
      	'AV_LINK'  			=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=$friend_id"),      
      	'FRI_AV_THUMB'  	=>   ($row_av['user_avatar']) ? get_user_avatar($row_av['user_avatar'], $row_av['user_avatar_type'], ($row_av['user_avatar_width'] > $row_av['user_avatar_height']) ? $avatar_size_size : ($avatar_size_size / $row_av['user_avatar_height']) * $row_av['user_avatar_width'], ($row_av['user_avatar_height'] > $row_av['user_avatar_width']) ? $avatar_size_size : ($avatar_size_size / $row_av['user_avatar_width']) * $row_av['user_avatar_height']) : '',
      	'ONLINE_USER'		=> is_user_online($row_av['zebra_id']),
      	'REG_DATE'			=> $user->format_date($row_av['user_regdate']),
      	'LAST_VISIT'		=> $user->format_date($row_av['user_lastvisit']),
      	'POSTS'				=> $row_av['user_posts'],
	));
}

$db->sql_freeresult($result);


// count some stuff up for the pagination
$profile = request_var('u', 0);

$sql = 'SELECT COUNT(zebra_id) AS number_friends 
		FROM '. ZEBRA_TABLE .' z,'.USERS_TABLE." u 
			WHERE $where";
$result = $db->sql_query($sql);
$total_friends = $db->sql_fetchfield('number_friends');

$db->sql_freeresult($result);

$template->assign_vars(array(
    'FRINATION'        => generate_pagination($pagination_friend, $total_friends, $limit, $start),
    'PAGE_NUMBER_F'    => on_page($total_friends, $limit, $start),
    'TOTAL_FRIENDS'    => ($total_friends == 1) ? $user->lang['LIST_FRIEND'] : sprintf($user->lang['LIST_FRIENDS'], $total_friends),
    'U_MODE_ACTION'	   => $sort_url

));


page_footer();

?>