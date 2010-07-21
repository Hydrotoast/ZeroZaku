<?php
/*
*
* @package - Board3portal
* @version $Id: top_posters.php 325 2008-08-17 18:59:40Z kevin74 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}

if (!defined('IN_PORTAL'))
{
   exit;
}

/**
*/

$sql = 'SELECT user_id, username, user_posts, user_colour, user_avatar, user_avatar_type, user_avatar_width, user_avatar_height
	FROM ' . USERS_TABLE . '
	WHERE user_type <> ' . USER_IGNORE . '
		AND user_posts <> 0
	ORDER BY user_posts DESC';
$result = $db->sql_query_limit($sql, $portal_config['portal_max_most_poster']);

while( ($row = $db->sql_fetchrow($result)) && ($row['username']) )
{
	$template->assign_block_vars('top_poster', array(
		'S_SEARCH_ACTION'   => append_sid("{$phpbb_root_path}search.$phpEx", 'author_id=' . $row['user_id'] . '&amp;sr=posts'),
		'USERNAME_FULL'     => get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
	    'AVATAR'            => get_user_avatar($row['user_avatar'], $row['user_avatar_type'], 40, 40),
		'POSTER_POSTS'      => $row['user_posts'],
		)
	);
}
$db->sql_freeresult($result);

$template->assign_vars(array(
	'S_DISPLAY_TOP_POSTERS' => true
));

?>