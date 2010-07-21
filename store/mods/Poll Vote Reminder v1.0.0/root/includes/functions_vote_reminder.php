<?php
/**
*
* @package phpBB3
* @author mtrs 
* @version $Id: functions_vote_reminder.php, v 1.0.0 2009/08/30 12:53:34 Exp $
* @copyrigh(c) 2009 mtrs
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit();
}

function poll_vote_reminder()
{	
	global $db, $auth, $user, $config, $phpbb_root_path, $phpEx, $topic_id;
	$user->add_lang('mods/vote_reminder');
	
	//Let's not force voting frequently, users may get angry :)
	if (($user->data['user_last_vote_reminder'] + $config['vote_reminder_interval'] * 60) > time() && $config['vote_reminder_interval'])
	{
		return false;
	}

	$mode = request_var('mode', '');
	$is_page_ucp = ($user->page['page_name'] == 'ucp.'.$phpEx) ? true : false;
	
	if ($user->page['page_name'] == 'adm/index.'.$phpEx || ($is_page_ucp && $mode == 'profile_info') || ($is_page_ucp && $mode == 'logout') || ($is_page_ucp && $mode == 'login'))
	{
		return false;
	}
	else if (!$user->data['is_registered'] || $user->data['is_bot'])
	{
		//Update users_table for guests and bots in case they could come until here, so no more redirection
		$sql = 'UPDATE ' . USERS_TABLE . "
			SET user_vote_reminder = 1
			WHERE user_id = " . $user->data['user_id'];
		$db->sql_query($sql);

		return false;
	}

	$vote_comp_topic_ids = $poll_topic_id_list = array();

	//Obtain poll list in which visiting user has already casted votes
	$sql = 'SELECT topic_id
		FROM ' . POLL_VOTES_TABLE . '
		WHERE vote_user_id = ' . $user->data['user_id'] . '
		GROUP BY topic_id';
	$result = $db->sql_query($sql);		
		
	while ($row = $db->sql_fetchrow($result))
	{			
		$poll_topic_id_list[] = $row['topic_id'];
	}
	$db->sql_freeresult($result);
	
	$forum_array = array_unique(array_keys($auth->acl_getf('!f_vote', true)));
	$sql_and = '';
	if (sizeof($forum_array))
	{
		$sql_and = ' AND ' . $db->sql_in_set('forum_id', $forum_array, true);
	}
	// grab all polls that meet criteria and auths	
		
	//Obtain the list of voting compulsory topics where this user hasn't voted yet
	$sql = 'SELECT topic_id, poll_length, poll_start, poll_last_vote
		FROM ' . TOPICS_TABLE . '
		WHERE poll_start <> 0
			AND poll_vote_compulsory = 1
			AND topic_status = ' . ITEM_UNLOCKED . '
			' . $sql_and . '
		ORDER BY poll_start DESC';
	$result = $db->sql_query($sql);		

	while ($row = $db->sql_fetchrow($result))
	{
		if (!in_array($row['topic_id'], $poll_topic_id_list) && (($row['poll_length'] != 0 && ($row['poll_start'] + $row['poll_length']) > time()) || $row['poll_length'] == 0))
		{
			$vote_comp_topic_ids[] = $row['topic_id'];
			$vote_topic_id = $row['topic_id'];
		}
	}
	$db->sql_freeresult($result);

	if (request_var('search_id', '') == 'egosearch' || ($user->page['page_name'] == 'viewtopic.'.$phpEx && (in_array($topic_id, $vote_comp_topic_ids) || in_array($topic_id, $poll_topic_id_list))))
	{
		return false;
	}
	
	if (sizeof($vote_comp_topic_ids))
	{
		//If there is more than one compulsory poll, we make sure only one user can be redirected to force vote polls in the last 60 seconds. We set user_last_vote_reminder field
		if ($config['vote_reminder_interval'])
		{
			$sql = 'SELECT topic_id
				FROM ' . TOPICS_TABLE . '
				WHERE poll_start <> 0
					AND poll_vote_compulsory = 1
					AND poll_last_vote > ' . (time() - 60) . '
					AND topic_status = ' . ITEM_UNLOCKED . '
					' . $sql_and . '
				ORDER BY poll_last_vote DESC';
			$result = $db->sql_query($sql);

			$user_voted_recently = false;
			while ($row = $db->sql_fetchrow($result))
			{
				if (in_array($row['topic_id'], $poll_topic_id_list))
				{
					$user_voted_recently = true;
					continue;
				}
			}
			$db->sql_freeresult($result);
		
			if ($user_voted_recently )
			{
				//We update last vote reminder time, thus users won't be forced to vote in polls for a while
				$sql = 'UPDATE ' . USERS_TABLE . '
					SET user_last_vote_reminder = ' . time() . '
					WHERE user_id = ' . $user->data['user_id'];
				$db->sql_query($sql);
		
				return false;
			}
		}
	
		//We redirect users from any topic, that is not a force vote poll list or force read topic
		meta_refresh(6, append_sid("{$phpbb_root_path}viewtopic.$phpEx?t=$vote_topic_id"));
		$message = sprintf($user->lang['TOPIC_VOTE_REMINDER']) . '<br />' . sprintf($user->lang['RETURN_TO_POLL_TOPIC'], '<a href="' . append_sid("{$phpbb_root_path}viewtopic.$phpEx?t=$vote_topic_id") . '">', '</a>');
		trigger_error($message, E_USER_WARNING);
	}
	else
	{
		//At last, we check if we should redirect to any force to read topics		
		$topic_id = $config['vote_reminder_topic_id'];

		//Finally update users_table, so no more redirection until reminder is reset
		$sql = 'UPDATE ' . USERS_TABLE . "
			SET user_vote_reminder = 1
			WHERE user_id = " . $user->data['user_id'];
		$db->sql_query($sql);

		if (topic_exists($topic_id))
		{
			//Redirect user to read topic
			meta_refresh(2, append_sid("{$phpbb_root_path}viewtopic.$phpEx?t=$topic_id"));
			$message = sprintf($user->lang['TOPIC_REMINDER']) . '<br />' . sprintf($user->lang['RETURN_TO_TOPIC'], '<a href="' . append_sid("{$phpbb_root_path}viewtopic.$phpEx?t=$topic_id") . '">', '</a>');
			trigger_error($message, E_USER_WARNING);
		}
	}
	
	return true;
}

function topic_exists($topic_id)
{
	global $db;
	
	if (!$topic_id || empty($topic_id))
	{
		return false;
	}	

	//We learn if this topic_id exist
	$sql = 'SELECT topic_id
		FROM ' . TOPICS_TABLE . '
		WHERE topic_id = ' . $topic_id . '
			AND topic_status <> ' . ITEM_MOVED;
	$result = $db->sql_query_limit($sql, 1);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if (!$row)
	{
		return false;
	}
	else
	{
		return true;
	}
}

?>