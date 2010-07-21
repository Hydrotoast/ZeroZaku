<?php
/**
*
* @package phpBB3
* @version $Id: top_five.php,v 1.0.5 2009/08/17 06:20:00 EST rmcgirr83 Exp $
* @copyright (c) 2009 Rich McGirr
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Include only once.
*/
if (!defined('INCLUDES_TOP_FIVE_PHP'))
{
	define('INCLUDES_TOP_FIVE_PHP', true);
	
	global $auth, $cache, $config, $user, $db, $phpbb_root_path, $phpEx, $template;

    $user->add_lang('mods/top_five');

	// grab auths that allow a user to read a forum
	$forum_array = array_unique(array_keys($auth->acl_getf('!f_read', true)));

	// we have auths, change the sql query below
	$sql_and = '';
	if (sizeof($forum_array))
	{
		$sql_and = ' AND ' . $db->sql_in_set('p.forum_id', $forum_array, true);
	}

	// grab all posts that meet criteria and auths
	$sql_ary = array(
		'SELECT'	=> 'MAX(p.post_time) as post_time, u.user_id, u.username, u.user_colour, t.topic_title, t.forum_id, t.topic_last_post_id',
		'FROM'		=> array(TOPICS_TABLE => 't', POSTS_TABLE => 'p'),
		'LEFT_JOIN'	=> array(
			array(
				'FROM'	=> array(USERS_TABLE => 'u'),
				'ON'	=> 'p.poster_id = u.user_id',
   			),
		),
		'WHERE'		=> 'p.topic_id = t.topic_id
			   AND p.post_approved = 1
			   AND t.topic_moved_id = 0' . $sql_and,
		'GROUP_BY'	=> 't.topic_id',
		'ORDER_BY'	=> 'post_time DESC',
	);

	$result = $db->sql_query_limit($db->sql_build_query('SELECT', $sql_ary), 5);

    while( $row = $db->sql_fetchrow($result) )
    {
   
		$view_topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row['forum_id'] . '&amp;p=' . $row['topic_last_post_id'] . '#p' . $row['topic_last_post_id']);
		$topic_title = censor_text($row['topic_title']);

       	$template->assign_block_vars('top_five_topic',array(
       		'U_TOPIC' 		=> $view_topic_url,
       		'USERNAME_FULL'	=> $user->lang['BY'] . ' ' . get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
       		'TOPIC_TITLE' 	=> $user->lang['IN'] . ' ' . $topic_title));
    }

    $db->sql_freeresult($result);

	// an array of user types we dont' bother with
	// could add board founder (USER_FOUNDER) if wanted
	$ignore_users = array(USER_IGNORE, USER_INACTIVE);
	
	// top five posters
	if (($user_posts = $cache->get('_top_five_posters')) === false)
	{
	    $user_posts = array();

		// grab users with most posts
	    $sql = 'SELECT user_id, username, user_colour, user_posts
	       	FROM ' . USERS_TABLE . '
			WHERE ' . $db->sql_in_set('user_type', $ignore_users, true) . '
				AND user_posts <> 0
	       ORDER BY user_posts DESC';
		$result = $db->sql_query_limit($sql, 5);

		while ($row = $db->sql_fetchrow($result))
		{
			$user_posts[$row['user_id']] = array(
				'user_id'		=> $row['user_id'],
                'username'		=> $row['username'],
                'user_colour'	=> $row['user_colour'],
				'user_posts'    => $row['user_posts'],
			);
		}
        $db->sql_freeresult($result);

		// cache this data for 5 minutes, this improves performance
		$cache->put('_top_five_posters', $user_posts, 300);
	 }

	 foreach ($user_posts as $row)
	 {
		$username_string = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);

		$template->assign_block_vars('top_five_active',array(
			'S_SEARCH_ACTION'	=> append_sid("{$phpbb_root_path}search.$phpEx", 'author_id=' . $row['user_id'] . '&amp;sr=posts'),
			'POSTS' 			=> $row['user_posts'],
			'USERNAME_FULL'		=> $username_string)
	   );
    }

    // newest registered users
	if (($newest_users = $cache->get('_top_five_newest_users')) === false)
	{
	    $newest_users = array();

	    // grab most recent registered users
		$sql = 'SELECT user_id, username, user_colour, user_regdate
			FROM ' . USERS_TABLE . '
			WHERE ' . $db->sql_in_set('user_type', $ignore_users, true) . '
				AND user_inactive_reason = 0
			ORDER BY user_regdate DESC';
		$result = $db->sql_query_limit($sql, 5);

		while ($row = $db->sql_fetchrow($result))
		{
			$newest_users[$row['user_id']] = array(
				'user_id'				=> $row['user_id'],
				'username'				=> $row['username'],
     			'user_colour'			=> $row['user_colour'],
                'user_regdate'			=> $row['user_regdate'],
			);
		}
	    $db->sql_freeresult($result);

		// cache this data for 5 minutes, this improves performance
		$cache->put('_top_five_newest_users', $newest_users, 300);
	 }

	 foreach ($newest_users as $row)
	 {
		$username_string = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);

		$template->assign_block_vars('top_five_newest',array(
			'REG_DATE'			=> $user->format_date($row['user_regdate']),
			'USERNAME_FULL'		=> $username_string)
	   );
    }
}
?>