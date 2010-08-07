<?php

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

// Load language
$user->add_lang('mods/community_moderation');

class community_moderation
{
	/**
	* Constructor
	*/
	function community_moderation()
	{
		global $config, $user, $auth;

		// Move configs to internal array, for less globals in functions
		$this->config['enabled'] = ($config['enable_community_moderation']) ? true : false;
		$this->config['threshold'] = ($config['posts_bury_threshold']) ? (int) $config['posts_bury_threshold'] : -3;
		$this->config['enable_ups'] = ($config['enable_community_moderation_ups']) ? true : false;
		$this->config['ups_upvote'] = (int) $config['community_moderation_ups_up'];
		$this->config['ups_downvote'] = (int) $config['community_moderation_ups_down'];

		if ($user->data['is_registered'] && $auth->acl_get('u_com_threshold') && ($user->data['user_posts_bury_threshold'] <> $config['posts_bury_threshold']))
		{
			$this->config['threshold'] = (int) $user->data['user_posts_bury_threshold'];
		}
	}

	/**
	* Store revision information into the database
	*/
	function record_vote_info(&$vmode, &$post_id, $auth, $viewtopic_url, $forum_id)
	{
		if (!$this->config['enabled'])
		{
			return;
		}

		global $db, $user, $reputation, $phpbb_root_path, $phpEx;

		// Guests cannot vote
		if (!$auth->acl_get('f_post_vote', $forum_id))
		{
			trigger_error('NOT_AUTHORISED');
		}

		$uid = $user->data['user_id'];

		// Check a post_id has been given
		if (!$post_id)
		{
			trigger_error('NO_POST');
		}

		// Has the user already voted for this post?
		$sql = 'SELECT post_id
					FROM ' . VOTES_TABLE . '
					WHERE post_id = ' . $post_id . '
						AND user_id = ' . $uid;

		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if ($row)
		{
			trigger_error('USER_HAS_VOTED');
		}

		// record vote details
		$sql_ary = array(
				'post_id'		=> (int) $post_id,
				'user_id'		=> $user->data['user_id'],
				'adjust'		=> ($vmode == 'upvote') ? 1 : 0,
				'vote_time'		=> time(),
				'voter_ip'		=> $user->ip
		);

		$db->sql_query('INSERT INTO ' . VOTES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));

		// update counts
		$sql = 'SELECT post_upvotes, post_downvotes, poster_id
					FROM ' . POSTS_TABLE . '
					WHERE post_id = ' . $post_id;

		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if ($vmode == 'upvote')
		{
			$reputation->add_point($row['poster_id'], 1);
			$vote_update = $row['post_upvotes'] + 1;
			$sql_ary = array(
				'post_upvotes'	=> (int) $vote_update
			);
		}
		else
		{
			$reputation->subtract_point($row['poster_id'], 1);
			$vote_update = $row['post_downvotes'] + 1;
			$sql_ary = array(
				'post_downvotes'	=> (int) $vote_update
			);
		}

		$sql = 'UPDATE ' . POSTS_TABLE . '
			SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
			WHERE post_id = ' . (int) $post_id;

		$db->sql_query($sql);

		$redirect_url = $viewtopic_url . '&amp;p=' . $post_id;
		redirect($redirect_url);
	}

	/**
	* Update viewtopic's SQL-query
	*/
	function viewtopic_sql(&$sql)
	{
		if (!$this->config['enabled'])
		{
			return;
		}

		global $user;

		$sql = str_replace('p.*', 'p.*, v.user_id AS has_voted', $sql);
		$sql = str_replace('WHERE', 'LEFT JOIN ' . VOTES_TABLE . ' v ON v.user_id = ' . $user->data['user_id'] . ' AND v.post_id = p.post_id WHERE', $sql);
	}

	/**
	* Adds community moderation information to posts rowset
	*/
	function viewtopic_rowset(&$rowset, $user, $row, $force)
	{
		if (!$this->config['enabled'])
		{
			return;
		}

		$post_score = 0;
		$is_buried = false;

		$post_score = $rowset['post_upvotes'] - $rowset['post_downvotes'];

		if ($post_score > 0)
		{
			$post_score = '+'. $post_score;
		}
		else if ($post_score < 0)
		{
			if ($post_score <= $this->config['threshold'])
			{
				switch ($user->data['user_posts_bury_hide'])
				{
					case '0':
						$is_buried = true;
					break;

					case '1':
						if (!$row['friend'])
						{
							$is_buried = true;
						}
					break;

					case '2':
					default:
						$is_buried = false;
					break;
				}
			}

			if ($force == $row['post_id'])
			{
				$is_buried = false;
			}
		}

		$rowset['post_score'] = $post_score;
		$rowset['is_buried'] = $is_buried;
	}

	/**
	* Adds community moderation information to post on viewtopic page
	*/
	function viewtopic_postrow(&$postrow, $auth, $user_cache, $poster_id, $row, $viewtopic_url, $forum_id)
	{
		$post_id = $row['post_id'];

		global $phpbb_root_path, $phpEx, $user;

		$postrow = array_merge($postrow, array(
			'POST_SCORE'		=> $row['post_score'],
			'POST_UPVOTES'		=> $row['post_upvotes'],
			'POST_DOWNVOTES'	=> $row['post_downvotes'],

			'U_UPVOTE'			=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'p=' . $post_id . '&amp;vmode=upvote'),
			'U_DOWNVOTE'		=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'p=' . $post_id . '&amp;vmode=downvote'),

			'S_BURIED_POST'				=> $row['is_buried'],
			'S_HAS_VOTED'				=> $row['has_voted'],
			'S_COMMUNITY_MOD_ENABLED'	=> $this->config['enabled'],
			'S_CAN_COMMUNITY_MOD'		=> ($auth->acl_get('f_post_vote', $forum_id)) ? true : false,

			'L_BURIED_POST'				=> ($row['is_buried']) ? sprintf($user->lang['POST_BURIED'], get_username_string('full', $poster_id, $row['username'], $row['user_colour'], $row['post_username']), '<a href="' . $viewtopic_url . "&amp;p={$post_id}&amp;force={$post_id}" . '">', '</a>') : '',
		));
	}
}

?>