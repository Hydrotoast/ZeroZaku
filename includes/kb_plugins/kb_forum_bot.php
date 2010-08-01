<?php
/**
*
* @package phpBB Knowledge Base Mod (KB)
* @version $Id: kb_forum_bot.php 442 2010-02-04 17:55:31Z tom.martin60@btinternet.com $
* @copyright (c) 2009 Andreas Nexmann, Tom Martin
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

// Only add these options if in acp
if (defined('IN_KB_PLUGIN'))
{
	if (!function_exists('make_forum_select'))
	{
		include($phpbb_root_path . 'includes/functions_admin.' . $phpEx);
	}

	$acp_options['legend1'] 					= 'ARTICLE_POST_BOT';
	$acp_options['kb_forum_bot_enable'] 		= array('lang' => 'ENABLE_FORUM_BOT',			'validate' => 'bool',	'type' => 'radio:yes_no', 	'explain' 	=> false);
	$acp_options['kb_forum_bot_user'] 			= array('lang' => 'ARTICLE_POST_BOT_USER',		'validate' => 'int',	'type' => 'text:3:5', 		'explain' 	=> true);
	$acp_options['kb_forum_bot_forum_id'] 		= array('lang' => 'FORUM_ID',					'validate' => 'int',	'type' => 'select',			'function'	=> 'make_forum_select',		'params'	=> array(isset($config['kb_forum_bot_forum_id']) ? $config['kb_forum_bot_forum_id'] : false, false, true, true),	'explain' 	=> true);
	$acp_options['kb_forum_bot_subject'] 		= array('lang' => 'ARTICLE_POST_BOT_SUB',		'validate' => 'string',	'type' => 'text:30:50', 	'explain' 	=> true);
	$acp_options['kb_forum_bot_message'] 		= array('lang' => 'ARTICLE_POST_BOT_MSG',		'validate' => 'string',	'type' => 'textarea:10:12', 'explain' 	=> true);
		
	$details = array(
		'PLUGIN_NAME'			=> 'PLUGIN_BOT',
		'PLUGIN_DESC'			=> 'PLUGIN_BOT_DESC',
		'PLUGIN_COPY'			=> 'PLUGIN_COPY',
		'PLUGIN_VERSION'		=> '1.0.0',
		'PLUGIN_MENU'			=> NO_MENU,
		'PLUGIN_PAGE_PERM'		=> array('add'),
		'PLUGIN_PAGES'			=> array('add'),
	);
}

/**
* Extra details for the mod does it need to call functions on certain areas?
*/
$on_article_post[] = 'post_new_article';
$on_article_approve[] = 'post_new_article';

// Doesn't need to pharse anything but we need it or errors will appear
function forum_bot($cat_id = 0)
{
	global $config;
	
	if (!$config['kb_forum_bot_enable'])
	{
		return;
	}
}

function forum_bot_versions()
{
	global $user;

	$versions = array(
		'0.0.1'	=> array(			
			'config_add'	=> array(
				array('kb_forum_bot_enable', 1),
			),
		),
		
		'0.0.2'	=> array(			
			'config_add'	=> array(
				array('kb_forum_bot_user', $user->data['user_id']),
				array('kb_forum_bot_message', $user->lang['ARTICLE_POST_BOT_MSG_EX']),
			),
		),
		
		'0.0.3'	=> array(			
			'config_add'	=> array(
				array('kb_forum_bot_subject', $user->lang['ARTICLE_POST_BOT_SUB_EX']),
			),
		),
		
		'0.0.4'	=> array(			
			'config_add'	=> array(
				array('kb_forum_bot_forum_id', ''),
			),
		),
		
		//Major release
		'1.0.0'	=> array(	
		),
	);

	return $versions;
}

function append_to_kb_options()
{
	global $user, $phpEx;

	$content = "<table cellspacing=\"1\">
		<caption>" . $user->lang['AVAILABLE'] . ' ' . $user->lang['VARIABLE'] . "</caption>
		<col class=\"col1\" /><col class=\"col2\" /><col class=\"col1\" />
			<thead>
				<tr>
					<th>" . $user->lang['NAME'] . "</th>
					<th>" . $user->lang['VARIABLE'] . "</th>
					<th>" . $user->lang['EXAMPLE'] . "</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>" . $user->lang['ARTICLE_AUTHOR'] . "</td>
					<td><b>{AUTHOR}</b></td>
					<td><b>" . $user->data['username'] . "</b></td>
				</tr>
				<tr>
					<td>" . $user->lang['ARTICLE_TITLE'] . "</td>
					<td><b>{TITLE}</b></td>
					<td><b>" . $user->lang['ARTICLE_TITLE_EX'] . "</b></td>
				</tr>
				<tr>
					<td>" . $user->lang['ARTICLE_DESC'] . "</td>
					<td><b>{DESC}</b></td>
					<td><b>" . $user->lang['ARTICLE_DESC_EX'] . "</b></td>
				</tr>
				<tr>
					<td>" . $user->lang['ARTICLE_TIME'] . "</td>
					<td><b>{TIME}</b></td>
					<td><b>" . $user->format_date(time()) . "</b></td>
				</tr>
				<tr>
					<td>" . $user->lang['ARTICLE_LINK'] . "</td>
					<td><b>{LINK}</b></td>
					<td><b>" . generate_board_url() . '/kb.' . $phpEx . "?a=1</b></td>
				</tr>
			</tbody>
		</table>
	";

	return $content;
}

function change_auth($user_id, $mode = 'replace', $data = false)
{
	global $user, $auth, $db;
	
	switch($mode)
	{
		// in 3.0.6 auths are no longer a concern thanks to "force_approved_state"
		case 'replace':

				$data = array(
						'user_backup'   => $user->data,
				);
										
				// sql to get the bots info
				$sql = 'SELECT *
						FROM ' . USERS_TABLE . '
						WHERE user_id = ' . (int) $user_id;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				// reset the current users info to that of the bot      
				$user->data = array_merge($user->data, $row);
				
				$kb_auth = new kb_auth;
				$kb_auth->acl($user->data, $auth);				
				unset($row);
				
				return $data;                                      
				
		break;
		
		// now we restore the users stuff
		case 'restore':
				$user->data = $data['user_backup'];

				unset($data);
		break;
	}
}

function post_new_article($data)
{
	global $config, $user, $phpbb_root_path, $phpEx;

	if (!function_exists('user_notification'))
	{
		include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
	}
	
	if (($config['kb_forum_bot_forum_id'] == '' || $config['kb_forum_bot_forum_id'] == 0)
		|| ($config['kb_forum_bot_user'] == '' || $config['kb_forum_bot_user'] == 0)
		|| $config['kb_forum_bot_subject'] == '' 
		|| $config['kb_forum_bot_message'] == '')
	{
		return;
	}
	
	$vars = array(
		'{AUTHOR}'		=> '[url=' . generate_board_url() . '/memberlist.' . $phpEx . '?mode=viewprofile&u=' . $data['article_user_id'] . '][color=#' . $data['article_user_color'] . ']' . $data['article_user_name'] . '[/color][/url]',
		'{TITLE}'		=> $data['article_title'],
		'{DESC}'		=> $data['article_desc'],
		'{TIME}'		=> $user->format_date($data['article_time']),
		'{LINK}'		=> generate_board_url() . '/kb.' . $phpEx . '?a=' . $data['article_id'],
	);
	
	//Get post bots permissions
	$perms = change_auth($config['kb_forum_bot_user']);

	//Parse the text with the bbcode parser and write into $text
	$subject	= utf8_normalize_nfc($config['kb_forum_bot_subject']);
	$message	= utf8_normalize_nfc($config['kb_forum_bot_message']);
	
	$message = str_replace(array_keys($vars), array_values($vars), $message);
	$subject = str_replace(array_keys($vars), array_values($vars), $subject);
	
	// variables to hold the parameters for submit_post
	$poll = $uid = $bitfield = $options = ''; 
	generate_text_for_storage($subject, $uid, $bitfield, $options, false, false, false);
	generate_text_for_storage($message, $uid, $bitfield, $options, true, true, true);

	$data = array( 
		'forum_id'				=> $config['kb_forum_bot_forum_id'],
		'icon_id'				=> false,
	
		'enable_bbcode'			=> true,
		'enable_smilies'		=> true,
		'enable_urls'			=> true,
		'enable_sig'			=> true,

		'message'				=> $message,
		'post_checksum'			=> '',
		'message_md5'			=> '',
					
		'bbcode_bitfield'		=> $bitfield,
		'bbcode_uid'			=> $uid,

		'post_edit_locked'		=> 0,
		'topic_title'			=> $subject,
		'notify_set'			=> false,
		'notify'				=> false,
		'post_time' 			=> 0,
		'forum_name'			=> '',
		'enable_indexing'		=> true,
		
		'force_approved_state'  => true,
	);

	kb_submit_post('post', $subject, '', POST_NORMAL, $poll, $data);	
	
	//Restore user permissions
	change_auth('', 'restore', $perms);	
}

/**
* Copy of standard Submit Post function taken from 3.0.6 done so to stop conflicts with other mods that have changed it and stopped it working
* @todo Split up and create lightweight, simple API for this.
*/
function kb_submit_post($mode, $subject, $username, $topic_type, &$poll, &$data, $update_message = true, $update_search_index = true)
{
	global $db, $auth, $user, $config, $phpEx, $template, $phpbb_root_path;

	// We do not handle erasing posts here
	if ($mode == 'delete')
	{
		return false;
	}

	$current_time = time();

	if ($mode == 'post')
	{
		$post_mode = 'post';
		$update_message = true;
	}
	else if ($mode != 'edit')
	{
		$post_mode = 'reply';
		$update_message = true;
	}
	else if ($mode == 'edit')
	{
		$post_mode = ($data['topic_replies_real'] == 0) ? 'edit_topic' : (($data['topic_first_post_id'] == $data['post_id']) ? 'edit_first_post' : (($data['topic_last_post_id'] == $data['post_id']) ? 'edit_last_post' : 'edit'));
	}

	// First of all make sure the subject and topic title are having the correct length.
	// To achieve this without cutting off between special chars we convert to an array and then count the elements.
	$subject = truncate_string($subject);
	$data['topic_title'] = truncate_string($data['topic_title']);

	// Collect some basic information about which tables and which rows to update/insert
	$sql_data = $topic_row = array();
	$poster_id = ($mode == 'edit') ? $data['poster_id'] : (int) $user->data['user_id'];

	// Retrieve some additional information if not present
	if ($mode == 'edit' && (!isset($data['post_approved']) || !isset($data['topic_approved']) || $data['post_approved'] === false || $data['topic_approved'] === false))
	{
		$sql = 'SELECT p.post_approved, t.topic_type, t.topic_replies, t.topic_replies_real, t.topic_approved
			FROM ' . TOPICS_TABLE . ' t, ' . POSTS_TABLE . ' p
			WHERE t.topic_id = p.topic_id
				AND p.post_id = ' . $data['post_id'];
		$result = $db->sql_query($sql);
		$topic_row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$data['topic_approved'] = $topic_row['topic_approved'];
		$data['post_approved'] = $topic_row['post_approved'];
	}

	// This variable indicates if the user is able to post or put into the queue - it is used later for all code decisions regarding approval
	// The variable name should be $post_approved, because it indicates if the post is approved or not
	$post_approval = 1;

	// Check the permissions for post approval. Moderators are not affected.
	if (!$auth->acl_get('f_noapprove', $data['forum_id']) && !$auth->acl_get('m_approve', $data['forum_id']))
	{
		// Post not approved, but in queue
		$post_approval = 0;
	}

	// Mods are able to force approved/unapproved posts. True means the post is approved, false the post is unapproved
	if (isset($data['force_approved_state']))
	{
		$post_approval = ($data['force_approved_state']) ? 1 : 0;
	}

	// Start the transaction here
	$db->sql_transaction('begin');

	// Collect Information
	switch ($post_mode)
	{
		case 'post':
		case 'reply':
			$sql_data[POSTS_TABLE]['sql'] = array(
				'forum_id'			=> ($topic_type == POST_GLOBAL) ? 0 : $data['forum_id'],
				'poster_id'			=> (int) $user->data['user_id'],
				'icon_id'			=> $data['icon_id'],
				'poster_ip'			=> $user->ip,
				'post_time'			=> $current_time,
				'post_approved'		=> $post_approval,
				'enable_bbcode'		=> $data['enable_bbcode'],
				'enable_smilies'	=> $data['enable_smilies'],
				'enable_magic_url'	=> $data['enable_urls'],
				'enable_sig'		=> $data['enable_sig'],
				'post_username'		=> (!$user->data['is_registered']) ? $username : '',
				'post_subject'		=> $subject,
				'post_text'			=> $data['message'],
				'post_checksum'		=> $data['message_md5'],
				'post_attachment'	=> (!empty($data['attachment_data'])) ? 1 : 0,
				'bbcode_bitfield'	=> $data['bbcode_bitfield'],
				'bbcode_uid'		=> $data['bbcode_uid'],
				'post_postcount'	=> ($auth->acl_get('f_postcount', $data['forum_id'])) ? 1 : 0,
				'post_edit_locked'	=> $data['post_edit_locked']
			);
		break;

		case 'edit_first_post':
		case 'edit':

		case 'edit_last_post':
		case 'edit_topic':

			// If edit reason is given always display edit info

			// If editing last post then display no edit info
			// If m_edit permission then display no edit info
			// If normal edit display edit info

			// Display edit info if edit reason given or user is editing his post, which is not the last within the topic.
			if ($data['post_edit_reason'] || (!$auth->acl_get('m_edit', $data['forum_id']) && ($post_mode == 'edit' || $post_mode == 'edit_first_post')))
			{
				$data['post_edit_reason']		= truncate_string($data['post_edit_reason'], 255, 255, false);

				$sql_data[POSTS_TABLE]['sql']	= array(
					'post_edit_time'	=> $current_time,
					'post_edit_reason'	=> $data['post_edit_reason'],
					'post_edit_user'	=> (int) $data['post_edit_user'],
				);

				$sql_data[POSTS_TABLE]['stat'][] = 'post_edit_count = post_edit_count + 1';
			}
			else if (!$data['post_edit_reason'] && $mode == 'edit' && $auth->acl_get('m_edit', $data['forum_id']))
			{
				$sql_data[POSTS_TABLE]['sql'] = array(
					'post_edit_reason'	=> '',
				);
			}

			// If the person editing this post is different to the one having posted then we will add a log entry stating the edit
			// Could be simplified by only adding to the log if the edit is not tracked - but this may confuse admins/mods
			if ($user->data['user_id'] != $poster_id)
			{
				$log_subject = ($subject) ? $subject : $data['topic_title'];
				add_log('mod', $data['forum_id'], $data['topic_id'], 'LOG_POST_EDITED', $log_subject, (!empty($username)) ? $username : $user->lang['GUEST']);
			}

			if (!isset($sql_data[POSTS_TABLE]['sql']))
			{
				$sql_data[POSTS_TABLE]['sql'] = array();
			}

			$sql_data[POSTS_TABLE]['sql'] = array_merge($sql_data[POSTS_TABLE]['sql'], array(
				'forum_id'			=> ($topic_type == POST_GLOBAL) ? 0 : $data['forum_id'],
				'poster_id'			=> $data['poster_id'],
				'icon_id'			=> $data['icon_id'],
				'post_approved'		=> (!$post_approval) ? 0 : $data['post_approved'],
				'enable_bbcode'		=> $data['enable_bbcode'],
				'enable_smilies'	=> $data['enable_smilies'],
				'enable_magic_url'	=> $data['enable_urls'],
				'enable_sig'		=> $data['enable_sig'],
				'post_username'		=> ($username && $data['poster_id'] == ANONYMOUS) ? $username : '',
				'post_subject'		=> $subject,
				'post_checksum'		=> $data['message_md5'],
				'post_attachment'	=> (!empty($data['attachment_data'])) ? 1 : 0,
				'bbcode_bitfield'	=> $data['bbcode_bitfield'],
				'bbcode_uid'		=> $data['bbcode_uid'],
				'post_edit_locked'	=> $data['post_edit_locked'])
			);

			if ($update_message)
			{
				$sql_data[POSTS_TABLE]['sql']['post_text'] = $data['message'];
			}

		break;
	}

	$post_approved = $sql_data[POSTS_TABLE]['sql']['post_approved'];
	$topic_row = array();

	// And the topic ladies and gentlemen
	switch ($post_mode)
	{
		case 'post':
			$sql_data[TOPICS_TABLE]['sql'] = array(
				'topic_poster'				=> (int) $user->data['user_id'],
				'topic_time'				=> $current_time,
				'topic_last_view_time'		=> $current_time,
				'forum_id'					=> ($topic_type == POST_GLOBAL) ? 0 : $data['forum_id'],
				'icon_id'					=> $data['icon_id'],
				'topic_approved'			=> $post_approval,
				'topic_title'				=> $subject,
				'topic_first_poster_name'	=> (!$user->data['is_registered'] && $username) ? $username : (($user->data['user_id'] != ANONYMOUS) ? $user->data['username'] : ''),
				'topic_first_poster_colour'	=> $user->data['user_colour'],
				'topic_type'				=> $topic_type,
				'topic_time_limit'			=> ($topic_type == POST_STICKY || $topic_type == POST_ANNOUNCE) ? ($data['topic_time_limit'] * 86400) : 0,
				'topic_attachment'			=> (!empty($data['attachment_data'])) ? 1 : 0,
			);

			if (isset($poll['poll_options']) && !empty($poll['poll_options']))
			{
				$poll_start = ($poll['poll_start']) ? $poll['poll_start'] : $current_time;
				$poll_length = $poll['poll_length'] * 86400;
				if ($poll_length < 0)
				{
					$poll_start = $poll_start + $poll_length;
					if ($poll_start < 0)
					{
						$poll_start = 0;
					}
					$poll_length = 1;
				}

				$sql_data[TOPICS_TABLE]['sql'] = array_merge($sql_data[TOPICS_TABLE]['sql'], array(
					'poll_title'		=> $poll['poll_title'],
					'poll_start'		=> $poll_start,
					'poll_max_options'	=> $poll['poll_max_options'],
					'poll_length'		=> $poll_length,
					'poll_vote_change'	=> $poll['poll_vote_change'])
				);
			}

			$sql_data[USERS_TABLE]['stat'][] = "user_lastpost_time = $current_time" . (($auth->acl_get('f_postcount', $data['forum_id']) && $post_approval) ? ', user_posts = user_posts + 1' : '');

			if ($topic_type != POST_GLOBAL)
			{
				if ($post_approval)
				{
					$sql_data[FORUMS_TABLE]['stat'][] = 'forum_posts = forum_posts + 1';
				}
				$sql_data[FORUMS_TABLE]['stat'][] = 'forum_topics_real = forum_topics_real + 1' . (($post_approval) ? ', forum_topics = forum_topics + 1' : '');
			}
		break;

		case 'reply':
			$sql_data[TOPICS_TABLE]['stat'][] = 'topic_last_view_time = ' . $current_time . ',
				topic_replies_real = topic_replies_real + 1,
				topic_bumped = 0,
				topic_bumper = 0' .
				(($post_approval) ? ', topic_replies = topic_replies + 1' : '') .
				((!empty($data['attachment_data']) || (isset($data['topic_attachment']) && $data['topic_attachment'])) ? ', topic_attachment = 1' : '');

			$sql_data[USERS_TABLE]['stat'][] = "user_lastpost_time = $current_time" . (($auth->acl_get('f_postcount', $data['forum_id']) && $post_approval) ? ', user_posts = user_posts + 1' : '');

			if ($post_approval && $topic_type != POST_GLOBAL)
			{
				$sql_data[FORUMS_TABLE]['stat'][] = 'forum_posts = forum_posts + 1';
			}
		break;

		case 'edit_topic':
		case 'edit_first_post':
			if (isset($poll['poll_options']) && !empty($poll['poll_options']))
			{
				$poll_start = ($poll['poll_start']) ? $poll['poll_start'] : $current_time;
				$poll_length = $poll['poll_length'] * 86400;
				if ($poll_length < 0)
				{
					$poll_start = $poll_start + $poll_length;
					if ($poll_start < 0)
					{
						$poll_start = 0;
					}
					$poll_length = 1;
				}
			}

			$sql_data[TOPICS_TABLE]['sql'] = array(
				'forum_id'					=> ($topic_type == POST_GLOBAL) ? 0 : $data['forum_id'],
				'icon_id'					=> $data['icon_id'],
				'topic_approved'			=> (!$post_approval) ? 0 : $data['topic_approved'],
				'topic_title'				=> $subject,
				'topic_first_poster_name'	=> $username,
				'topic_type'				=> $topic_type,
				'topic_time_limit'			=> ($topic_type == POST_STICKY || $topic_type == POST_ANNOUNCE) ? ($data['topic_time_limit'] * 86400) : 0,
				'poll_title'				=> (isset($poll['poll_options'])) ? $poll['poll_title'] : '',
				'poll_start'				=> (isset($poll['poll_options'])) ? $poll_start : 0,
				'poll_max_options'			=> (isset($poll['poll_options'])) ? $poll['poll_max_options'] : 1,
				'poll_length'				=> (isset($poll['poll_options'])) ? $poll_length : 0,
				'poll_vote_change'			=> (isset($poll['poll_vote_change'])) ? $poll['poll_vote_change'] : 0,
				'topic_last_view_time'		=> $current_time,

				'topic_attachment'			=> (!empty($data['attachment_data'])) ? 1 : (isset($data['topic_attachment']) ? $data['topic_attachment'] : 0),
			);

			// Correctly set back the topic replies and forum posts... only if the topic was approved before and now gets disapproved
			if (!$post_approval && $data['topic_approved'])
			{
				// Do we need to grab some topic informations?
				if (!sizeof($topic_row))
				{
					$sql = 'SELECT topic_type, topic_replies, topic_replies_real, topic_approved
						FROM ' . TOPICS_TABLE . '
						WHERE topic_id = ' . $data['topic_id'];
					$result = $db->sql_query($sql);
					$topic_row = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);
				}

				// If this is the only post remaining we do not need to decrement topic_replies.
				// Also do not decrement if first post - then the topic_replies will not be adjusted if approving the topic again.

				// If this is an edited topic or the first post the topic gets completely disapproved later on...
				$sql_data[FORUMS_TABLE]['stat'][] = 'forum_topics = forum_topics - 1';
				$sql_data[FORUMS_TABLE]['stat'][] = 'forum_posts = forum_posts - ' . ($topic_row['topic_replies'] + 1);

				set_config_count('num_topics', -1, true);
				set_config_count('num_posts', ($topic_row['topic_replies'] + 1) * (-1), true);

				// Only decrement this post, since this is the one non-approved now
				if ($auth->acl_get('f_postcount', $data['forum_id']))
				{
					$sql_data[USERS_TABLE]['stat'][] = 'user_posts = user_posts - 1';
				}
			}

		break;

		case 'edit':
		case 'edit_last_post':

			// Correctly set back the topic replies and forum posts... but only if the post was approved before.
			if (!$post_approval && $data['post_approved'])
			{
				$sql_data[TOPICS_TABLE]['stat'][] = 'topic_replies = topic_replies - 1, topic_last_view_time = ' . $current_time;
				$sql_data[FORUMS_TABLE]['stat'][] = 'forum_posts = forum_posts - 1';

				set_config_count('num_posts', -1, true);

				if ($auth->acl_get('f_postcount', $data['forum_id']))
				{
					$sql_data[USERS_TABLE]['stat'][] = 'user_posts = user_posts - 1';
				}
			}

		break;
	}

	// Submit new topic
	if ($post_mode == 'post')
	{
		$sql = 'INSERT INTO ' . TOPICS_TABLE . ' ' .
			$db->sql_build_array('INSERT', $sql_data[TOPICS_TABLE]['sql']);
		$db->sql_query($sql);

		$data['topic_id'] = $db->sql_nextid();

		$sql_data[POSTS_TABLE]['sql'] = array_merge($sql_data[POSTS_TABLE]['sql'], array(
			'topic_id' => $data['topic_id'])
		);
		unset($sql_data[TOPICS_TABLE]['sql']);
	}

	// Submit new post
	if ($post_mode == 'post' || $post_mode == 'reply')
	{
		if ($post_mode == 'reply')
		{
			$sql_data[POSTS_TABLE]['sql'] = array_merge($sql_data[POSTS_TABLE]['sql'], array(
				'topic_id' => $data['topic_id'])
			);
		}

		$sql = 'INSERT INTO ' . POSTS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_data[POSTS_TABLE]['sql']);
		$db->sql_query($sql);
		$data['post_id'] = $db->sql_nextid();

		if ($post_mode == 'post')
		{
			$sql_data[TOPICS_TABLE]['sql'] = array(
				'topic_first_post_id'		=> $data['post_id'],
				'topic_last_post_id'		=> $data['post_id'],
				'topic_last_post_time'		=> $current_time,
				'topic_last_poster_id'		=> (int) $user->data['user_id'],
				'topic_last_poster_name'	=> (!$user->data['is_registered'] && $username) ? $username : (($user->data['user_id'] != ANONYMOUS) ? $user->data['username'] : ''),
				'topic_last_poster_colour'	=> $user->data['user_colour'],
				'topic_last_post_subject'	=> (string) $subject,
			);
		}

		unset($sql_data[POSTS_TABLE]['sql']);
	}

	$make_global = false;

	// Are we globalising or unglobalising?
	if ($post_mode == 'edit_first_post' || $post_mode == 'edit_topic')
	{
		if (!sizeof($topic_row))
		{
			$sql = 'SELECT topic_type, topic_replies, topic_replies_real, topic_approved, topic_last_post_id
				FROM ' . TOPICS_TABLE . '
				WHERE topic_id = ' . $data['topic_id'];
			$result = $db->sql_query($sql);
			$topic_row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
		}

		// globalise/unglobalise?
		if (($topic_row['topic_type'] != POST_GLOBAL && $topic_type == POST_GLOBAL) || ($topic_row['topic_type'] == POST_GLOBAL && $topic_type != POST_GLOBAL))
		{
			if (!empty($sql_data[FORUMS_TABLE]['stat']) && implode('', $sql_data[FORUMS_TABLE]['stat']))
			{
				$db->sql_query('UPDATE ' . FORUMS_TABLE . ' SET ' . implode(', ', $sql_data[FORUMS_TABLE]['stat']) . ' WHERE forum_id = ' . $data['forum_id']);
			}

			$make_global = true;
			$sql_data[FORUMS_TABLE]['stat'] = array();
		}

		// globalise
		if ($topic_row['topic_type'] != POST_GLOBAL && $topic_type == POST_GLOBAL)
		{
			// Decrement topic/post count
			$sql_data[FORUMS_TABLE]['stat'][] = 'forum_posts = forum_posts - ' . ($topic_row['topic_replies_real'] + 1);
			$sql_data[FORUMS_TABLE]['stat'][] = 'forum_topics_real = forum_topics_real - 1' . (($topic_row['topic_approved']) ? ', forum_topics = forum_topics - 1' : '');

			// Update forum_ids for all posts
			$sql = 'UPDATE ' . POSTS_TABLE . '
				SET forum_id = 0
				WHERE topic_id = ' . $data['topic_id'];
			$db->sql_query($sql);
		}
		// unglobalise
		else if ($topic_row['topic_type'] == POST_GLOBAL && $topic_type != POST_GLOBAL)
		{
			// Increment topic/post count
			$sql_data[FORUMS_TABLE]['stat'][] = 'forum_posts = forum_posts + ' . ($topic_row['topic_replies_real'] + 1);
			$sql_data[FORUMS_TABLE]['stat'][] = 'forum_topics_real = forum_topics_real + 1' . (($topic_row['topic_approved']) ? ', forum_topics = forum_topics + 1' : '');

			// Update forum_ids for all posts
			$sql = 'UPDATE ' . POSTS_TABLE . '
				SET forum_id = ' . $data['forum_id'] . '
				WHERE topic_id = ' . $data['topic_id'];
			$db->sql_query($sql);
		}
	}

	// Update the topics table
	if (isset($sql_data[TOPICS_TABLE]['sql']))
	{
		$sql = 'UPDATE ' . TOPICS_TABLE . '
			SET ' . $db->sql_build_array('UPDATE', $sql_data[TOPICS_TABLE]['sql']) . '
			WHERE topic_id = ' . $data['topic_id'];
		$db->sql_query($sql);
	}

	// Update the posts table
	if (isset($sql_data[POSTS_TABLE]['sql']))
	{
		$sql = 'UPDATE ' . POSTS_TABLE . '
			SET ' . $db->sql_build_array('UPDATE', $sql_data[POSTS_TABLE]['sql']) . '
			WHERE post_id = ' . $data['post_id'];
		$db->sql_query($sql);
	}

	// Update Poll Tables
	if (isset($poll['poll_options']) && !empty($poll['poll_options']))
	{
		$cur_poll_options = array();

		if ($poll['poll_start'] && $mode == 'edit')
		{
			$sql = 'SELECT *
				FROM ' . POLL_OPTIONS_TABLE . '
				WHERE topic_id = ' . $data['topic_id'] . '
				ORDER BY poll_option_id';
			$result = $db->sql_query($sql);

			$cur_poll_options = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$cur_poll_options[] = $row;
			}
			$db->sql_freeresult($result);
		}

		$sql_insert_ary = array();

		for ($i = 0, $size = sizeof($poll['poll_options']); $i < $size; $i++)
		{
			if (strlen(trim($poll['poll_options'][$i])))
			{
				if (empty($cur_poll_options[$i]))
				{
					// If we add options we need to put them to the end to be able to preserve votes...
					$sql_insert_ary[] = array(
						'poll_option_id'	=> (int) sizeof($cur_poll_options) + 1 + sizeof($sql_insert_ary),
						'topic_id'			=> (int) $data['topic_id'],
						'poll_option_text'	=> (string) $poll['poll_options'][$i]
					);
				}
				else if ($poll['poll_options'][$i] != $cur_poll_options[$i])
				{
					$sql = 'UPDATE ' . POLL_OPTIONS_TABLE . "
						SET poll_option_text = '" . $db->sql_escape($poll['poll_options'][$i]) . "'
						WHERE poll_option_id = " . $cur_poll_options[$i]['poll_option_id'] . '
							AND topic_id = ' . $data['topic_id'];
					$db->sql_query($sql);
				}
			}
		}

		$db->sql_multi_insert(POLL_OPTIONS_TABLE, $sql_insert_ary);

		if (sizeof($poll['poll_options']) < sizeof($cur_poll_options))
		{
			$sql = 'DELETE FROM ' . POLL_OPTIONS_TABLE . '
				WHERE poll_option_id > ' . sizeof($poll['poll_options']) . '
					AND topic_id = ' . $data['topic_id'];
			$db->sql_query($sql);
		}

		// If edited, we would need to reset votes (since options can be re-ordered above, you can't be sure if the change is for changing the text or adding an option
		if ($mode == 'edit' && sizeof($poll['poll_options']) != sizeof($cur_poll_options))
		{
			$db->sql_query('DELETE FROM ' . POLL_VOTES_TABLE . ' WHERE topic_id = ' . $data['topic_id']);
			$db->sql_query('UPDATE ' . POLL_OPTIONS_TABLE . ' SET poll_option_total = 0 WHERE topic_id = ' . $data['topic_id']);
		}
	}

	// Submit Attachments
	if (!empty($data['attachment_data']) && $data['post_id'] && in_array($mode, array('post', 'reply', 'quote', 'edit')))
	{
		$space_taken = $files_added = 0;
		$orphan_rows = array();

		foreach ($data['attachment_data'] as $pos => $attach_row)
		{
			$orphan_rows[(int) $attach_row['attach_id']] = array();
		}

		if (sizeof($orphan_rows))
		{
			$sql = 'SELECT attach_id, filesize, physical_filename
				FROM ' . ATTACHMENTS_TABLE . '
				WHERE ' . $db->sql_in_set('attach_id', array_keys($orphan_rows)) . '
					AND is_orphan = 1
					AND poster_id = ' . $user->data['user_id'];
			$result = $db->sql_query($sql);

			$orphan_rows = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$orphan_rows[$row['attach_id']] = $row;
			}
			$db->sql_freeresult($result);
		}

		foreach ($data['attachment_data'] as $pos => $attach_row)
		{
			if ($attach_row['is_orphan'] && !isset($orphan_rows[$attach_row['attach_id']]))
			{
				continue;
			}

			if (!$attach_row['is_orphan'])
			{
				// update entry in db if attachment already stored in db and filespace
				$sql = 'UPDATE ' . ATTACHMENTS_TABLE . "
					SET attach_comment = '" . $db->sql_escape($attach_row['attach_comment']) . "'
					WHERE attach_id = " . (int) $attach_row['attach_id'] . '
						AND is_orphan = 0';
				$db->sql_query($sql);
			}
			else
			{
				// insert attachment into db
				if (!@file_exists($phpbb_root_path . $config['upload_path'] . '/' . utf8_basename($orphan_rows[$attach_row['attach_id']]['physical_filename'])))
				{
					continue;
				}

				$space_taken += $orphan_rows[$attach_row['attach_id']]['filesize'];
				$files_added++;

				$attach_sql = array(
					'post_msg_id'		=> $data['post_id'],
					'topic_id'			=> $data['topic_id'],
					'is_orphan'			=> 0,
					'poster_id'			=> $poster_id,
					'attach_comment'	=> $attach_row['attach_comment'],
				);

				$sql = 'UPDATE ' . ATTACHMENTS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $attach_sql) . '
					WHERE attach_id = ' . $attach_row['attach_id'] . '
						AND is_orphan = 1
						AND poster_id = ' . $user->data['user_id'];
				$db->sql_query($sql);
			}
		}

		if ($space_taken && $files_added)
		{
			set_config_count('upload_dir_size', $space_taken, true);
			set_config_count('num_files', $files_added, true);
		}
	}

	// we need to update the last forum information
	// only applicable if the topic is not global and it is approved
	// we also check to make sure we are not dealing with globaling the latest topic (pretty rare but still needs to be checked)
	if ($topic_type != POST_GLOBAL && !$make_global && ($post_approved || !$data['post_approved']))
	{
		// the last post makes us update the forum table. This can happen if...
		// We make a new topic
		// We reply to a topic
		// We edit the last post in a topic and this post is the latest in the forum (maybe)
		// We edit the only post in the topic
		// We edit the first post in the topic and all the other posts are not approved
		if (($post_mode == 'post' || $post_mode == 'reply') && $post_approved)
		{
			$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_post_id = ' . $data['post_id'];
			$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_post_subject = '" . $db->sql_escape($subject) . "'";
			$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_post_time = ' . $current_time;
			$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_poster_id = ' . (int) $user->data['user_id'];
			$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_poster_name = '" . $db->sql_escape((!$user->data['is_registered'] && $username) ? $username : (($user->data['user_id'] != ANONYMOUS) ? $user->data['username'] : '')) . "'";
			$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_poster_colour = '" . $db->sql_escape($user->data['user_colour']) . "'";
		}
		else if ($post_mode == 'edit_last_post' || $post_mode == 'edit_topic' || ($post_mode == 'edit_first_post' && !$data['topic_replies']))
		{
			// this does not _necessarily_ mean that we must update the info again,
			// it just means that we might have to
			$sql = 'SELECT forum_last_post_id, forum_last_post_subject
				FROM ' . FORUMS_TABLE . '
				WHERE forum_id = ' . (int) $data['forum_id'];
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			// this post is the latest post in the forum, better update
			if ($row['forum_last_post_id'] == $data['post_id'])
			{
				// If post approved and subject changed, or poster is anonymous, we need to update the forum_last* rows
				if ($post_approved && ($row['forum_last_post_subject'] !== $subject || $data['poster_id'] == ANONYMOUS))
				{
					// the post's subject changed
					if ($row['forum_last_post_subject'] !== $subject)
					{
						$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_post_subject = \'' . $db->sql_escape($subject) . '\'';
					}

					// Update the user name if poster is anonymous... just in case an admin changed it
					if ($data['poster_id'] == ANONYMOUS)
					{
						$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_poster_name = '" . $db->sql_escape($username) . "'";
					}
				}
				else if ($data['post_approved'] !== $post_approved)
				{
					// we need a fresh change of socks, everything has become invalidated
					$sql = 'SELECT MAX(topic_last_post_id) as last_post_id
						FROM ' . TOPICS_TABLE . '
						WHERE forum_id = ' . (int) $data['forum_id'] . '
						AND topic_approved = 1';
					$result = $db->sql_query($sql);
					$last_post_id = (int) $db->sql_fetchfield('last_post_id', $result);
					$db->sql_freeresult($result);

					// any posts left in this forum?
					if (!empty($last_post_id))
					{
						$sql = 'SELECT p.post_id, p.post_subject, p.post_time, p.poster_id, p.post_username, u.user_id, u.username, u.user_colour
							FROM ' . POSTS_TABLE . ' p, ' . USERS_TABLE . ' u
							WHERE p.poster_id = u.user_id
								AND p.post_id = ' . $last_post_id;
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);

						// salvation, a post is found! jam it into the forums table
						$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_post_id = ' . (int) $row['post_id'];
						$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_post_subject = '" . $db->sql_escape($row['post_subject']) . "'";
						$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_post_time = ' . (int) $row['post_time'];
						$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_poster_id = ' . (int) $row['poster_id'];
						$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_poster_name = '" . $db->sql_escape(($row['poster_id'] == ANONYMOUS) ? $row['post_username'] : $row['username']) . "'";
						$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_poster_colour = '" . $db->sql_escape($row['user_colour']) . "'";
					}
					else
					{
						// just our luck, the last topic in the forum has just been turned unapproved...
						$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_post_id = 0';
						$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_post_subject = ''";
						$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_post_time = 0';
						$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_poster_id = 0';
						$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_poster_name = ''";
						$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_poster_colour = ''";
					}
				}
			}
		}
	}
	else if ($make_global)
	{
		// somebody decided to be a party pooper, we must recalculate the whole shebang (maybe)
		$sql = 'SELECT forum_last_post_id
			FROM ' . FORUMS_TABLE . '
			WHERE forum_id = ' . (int) $data['forum_id'];
		$result = $db->sql_query($sql);
		$forum_last_post_id = (int) $db->sql_fetchfield('forum_last_post_id', $result);
		$db->sql_freeresult($result);

		// we made a topic global, go get new data
		if ($topic_row['topic_type'] != POST_GLOBAL && $topic_type == POST_GLOBAL && $forum_last_post_id == $topic_row['topic_last_post_id'])
		{
			// we need a fresh change of socks, everything has become invalidated
			$sql = 'SELECT MAX(topic_last_post_id) as last_post_id
				FROM ' . TOPICS_TABLE . '
				WHERE forum_id = ' . (int) $data['forum_id'] . '
				AND topic_approved = 1';
			$result = $db->sql_query($sql);
			$last_post_id = (int) $db->sql_fetchfield('last_post_id', $result);
			$db->sql_freeresult($result);

			// any posts left in this forum?
			if (!empty($last_post_id))
			{
				$sql = 'SELECT p.post_id, p.post_subject, p.post_time, p.poster_id, p.post_username, u.user_id, u.username, u.user_colour
					FROM ' . POSTS_TABLE . ' p, ' . USERS_TABLE . ' u
					WHERE p.poster_id = u.user_id
						AND p.post_id = ' . $last_post_id;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				// salvation, a post is found! jam it into the forums table
				$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_post_id = ' . (int) $row['post_id'];
				$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_post_subject = '" . $db->sql_escape($row['post_subject']) . "'";
				$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_post_time = ' . (int) $row['post_time'];
				$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_poster_id = ' . (int) $row['poster_id'];
				$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_poster_name = '" . $db->sql_escape(($row['poster_id'] == ANONYMOUS) ? $row['post_username'] : $row['username']) . "'";
				$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_poster_colour = '" . $db->sql_escape($row['user_colour']) . "'";
			}
			else
			{
				// just our luck, the last topic in the forum has just been globalized...
				$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_post_id = 0';
				$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_post_subject = ''";
				$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_post_time = 0';
				$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_poster_id = 0';
				$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_poster_name = ''";
				$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_poster_colour = ''";
			}
		}
		else if ($topic_row['topic_type'] == POST_GLOBAL && $topic_type != POST_GLOBAL && $forum_last_post_id < $topic_row['topic_last_post_id'])
		{
			// this post has a higher id, it is newer
			$sql = 'SELECT p.post_id, p.post_subject, p.post_time, p.poster_id, p.post_username, u.user_id, u.username, u.user_colour
				FROM ' . POSTS_TABLE . ' p, ' . USERS_TABLE . ' u
				WHERE p.poster_id = u.user_id
					AND p.post_id = ' . (int) $topic_row['topic_last_post_id'];
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			// salvation, a post is found! jam it into the forums table
			$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_post_id = ' . (int) $row['post_id'];
			$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_post_subject = '" . $db->sql_escape($row['post_subject']) . "'";
			$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_post_time = ' . (int) $row['post_time'];
			$sql_data[FORUMS_TABLE]['stat'][] = 'forum_last_poster_id = ' . (int) $row['poster_id'];
			$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_poster_name = '" . $db->sql_escape(($row['poster_id'] == ANONYMOUS) ? $row['post_username'] : $row['username']) . "'";
			$sql_data[FORUMS_TABLE]['stat'][] = "forum_last_poster_colour = '" . $db->sql_escape($row['user_colour']) . "'";
		}
	}

	// topic sync time!
	// simply, we update if it is a reply or the last post is edited
	if ($post_approved)
	{
		// reply requires the whole thing
		if ($post_mode == 'reply')
		{
			$sql_data[TOPICS_TABLE]['stat'][] = 'topic_last_post_id = ' . (int) $data['post_id'];
			$sql_data[TOPICS_TABLE]['stat'][] = 'topic_last_poster_id = ' . (int) $user->data['user_id'];
			$sql_data[TOPICS_TABLE]['stat'][] = "topic_last_poster_name = '" . $db->sql_escape((!$user->data['is_registered'] && $username) ? $username : (($user->data['user_id'] != ANONYMOUS) ? $user->data['username'] : '')) . "'";
			$sql_data[TOPICS_TABLE]['stat'][] = "topic_last_poster_colour = '" . (($user->data['user_id'] != ANONYMOUS) ? $db->sql_escape($user->data['user_colour']) : '') . "'";
			$sql_data[TOPICS_TABLE]['stat'][] = "topic_last_post_subject = '" . $db->sql_escape($subject) . "'";
			$sql_data[TOPICS_TABLE]['stat'][] = 'topic_last_post_time = ' . (int) $current_time;
		}
		else if ($post_mode == 'edit_last_post' || $post_mode == 'edit_topic' || ($post_mode == 'edit_first_post' && !$data['topic_replies']))
		{
			// only the subject can be changed from edit
			$sql_data[TOPICS_TABLE]['stat'][] = "topic_last_post_subject = '" . $db->sql_escape($subject) . "'";

			// Maybe not only the subject, but also changing anonymous usernames. ;)
			if ($data['poster_id'] == ANONYMOUS)
			{
				$sql_data[TOPICS_TABLE]['stat'][] = "topic_last_poster_name = '" . $db->sql_escape($username) . "'";
			}
		}
	}
	else if (!$data['post_approved'] && ($post_mode == 'edit_last_post' || $post_mode == 'edit_topic' || ($post_mode == 'edit_first_post' && !$data['topic_replies'])))
	{
		// like having the rug pulled from under us
		$sql = 'SELECT MAX(post_id) as last_post_id
			FROM ' . POSTS_TABLE . '
			WHERE topic_id = ' . (int) $data['topic_id'] . '
				AND post_approved = 1';
		$result = $db->sql_query($sql);
		$last_post_id = (int) $db->sql_fetchfield('last_post_id', $result);
		$db->sql_freeresult($result);

		// any posts left in this forum?
		if (!empty($last_post_id))
		{
			$sql = 'SELECT p.post_id, p.post_subject, p.post_time, p.poster_id, p.post_username, u.user_id, u.username, u.user_colour
				FROM ' . POSTS_TABLE . ' p, ' . USERS_TABLE . ' u
				WHERE p.poster_id = u.user_id
					AND p.post_id = ' . $last_post_id;
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			// salvation, a post is found! jam it into the topics table
			$sql_data[TOPICS_TABLE]['stat'][] = 'topic_last_post_id = ' . (int) $row['post_id'];
			$sql_data[TOPICS_TABLE]['stat'][] = "topic_last_post_subject = '" . $db->sql_escape($row['post_subject']) . "'";
			$sql_data[TOPICS_TABLE]['stat'][] = 'topic_last_post_time = ' . (int) $row['post_time'];
			$sql_data[TOPICS_TABLE]['stat'][] = 'topic_last_poster_id = ' . (int) $row['poster_id'];
			$sql_data[TOPICS_TABLE]['stat'][] = "topic_last_poster_name = '" . $db->sql_escape(($row['poster_id'] == ANONYMOUS) ? $row['post_username'] : $row['username']) . "'";
			$sql_data[TOPICS_TABLE]['stat'][] = "topic_last_poster_colour = '" . $db->sql_escape($row['user_colour']) . "'";
		}
	}

	// Update total post count, do not consider moderated posts/topics
	if ($post_approval)
	{
		if ($post_mode == 'post')
		{
			set_config_count('num_topics', 1, true);
			set_config_count('num_posts', 1, true);
		}

		if ($post_mode == 'reply')
		{
			set_config_count('num_posts', 1, true);
		}
	}

	// Update forum stats
	$where_sql = array(POSTS_TABLE => 'post_id = ' . $data['post_id'], TOPICS_TABLE => 'topic_id = ' . $data['topic_id'], FORUMS_TABLE => 'forum_id = ' . $data['forum_id'], USERS_TABLE => 'user_id = ' . $poster_id);

	foreach ($sql_data as $table => $update_ary)
	{
		if (isset($update_ary['stat']) && implode('', $update_ary['stat']))
		{
			$sql = "UPDATE $table SET " . implode(', ', $update_ary['stat']) . ' WHERE ' . $where_sql[$table];
			$db->sql_query($sql);
		}
	}

	// Delete topic shadows (if any exist). We do not need a shadow topic for an global announcement
	if ($make_global)
	{
		$sql = 'DELETE FROM ' . TOPICS_TABLE . '
			WHERE topic_moved_id = ' . $data['topic_id'];
		$db->sql_query($sql);
	}

	// Committing the transaction before updating search index
	$db->sql_transaction('commit');

	// Delete draft if post was loaded...
	$draft_id = request_var('draft_loaded', 0);
	if ($draft_id)
	{
		$sql = 'DELETE FROM ' . DRAFTS_TABLE . "
			WHERE draft_id = $draft_id
				AND user_id = {$user->data['user_id']}";
		$db->sql_query($sql);
	}

	// Index message contents
	if ($update_search_index && $data['enable_indexing'])
	{
		// Select the search method and do some additional checks to ensure it can actually be utilised
		$search_type = basename($config['search_type']);

		if (!file_exists($phpbb_root_path . 'includes/search/' . $search_type . '.' . $phpEx))
		{
			trigger_error('NO_SUCH_SEARCH_MODULE');
		}

		if (!class_exists($search_type))
		{
			include("{$phpbb_root_path}includes/search/$search_type.$phpEx");
		}

		$error = false;
		$search = new $search_type($error);

		if ($error)
		{
			trigger_error($error);
		}

		$search->index($mode, $data['post_id'], $data['message'], $subject, $poster_id, ($topic_type == POST_GLOBAL) ? 0 : $data['forum_id']);
	}

	// Topic Notification, do not change if moderator is changing other users posts...
	if ($user->data['user_id'] == $poster_id)
	{
		if (!$data['notify_set'] && $data['notify'])
		{
			$sql = 'INSERT INTO ' . TOPICS_WATCH_TABLE . ' (user_id, topic_id)
				VALUES (' . $user->data['user_id'] . ', ' . $data['topic_id'] . ')';
			$db->sql_query($sql);
		}
		else if ($data['notify_set'] && !$data['notify'])
		{
			$sql = 'DELETE FROM ' . TOPICS_WATCH_TABLE . '
				WHERE user_id = ' . $user->data['user_id'] . '
					AND topic_id = ' . $data['topic_id'];
			$db->sql_query($sql);
		}
	}

	if ($mode == 'post' || $mode == 'reply' || $mode == 'quote')
	{
		// Mark this topic as posted to
		markread('post', $data['forum_id'], $data['topic_id'], $data['post_time']);
	}

	// Mark this topic as read
	// We do not use post_time here, this is intended (post_time can have a date in the past if editing a message)
	markread('topic', (($topic_type == POST_GLOBAL) ? 0 : $data['forum_id']), $data['topic_id'], time());

	//
	if ($config['load_db_lastread'] && $user->data['is_registered'])
	{
		$sql = 'SELECT mark_time
			FROM ' . FORUMS_TRACK_TABLE . '
			WHERE user_id = ' . $user->data['user_id'] . '
				AND forum_id = ' . (($topic_type == POST_GLOBAL) ? 0 : $data['forum_id']);
		$result = $db->sql_query($sql);
		$f_mark_time = (int) $db->sql_fetchfield('mark_time');
		$db->sql_freeresult($result);
	}
	else if ($config['load_anon_lastread'] || $user->data['is_registered'])
	{
		$f_mark_time = false;
	}

	if (($config['load_db_lastread'] && $user->data['is_registered']) || $config['load_anon_lastread'] || $user->data['is_registered'])
	{
		// Update forum info
		if ($topic_type == POST_GLOBAL)
		{
			$sql = 'SELECT MAX(topic_last_post_time) as forum_last_post_time
				FROM ' . TOPICS_TABLE . '
				WHERE forum_id = 0';
		}
		else
		{
			$sql = 'SELECT forum_last_post_time
				FROM ' . FORUMS_TABLE . '
				WHERE forum_id = ' . $data['forum_id'];
		}
		$result = $db->sql_query($sql);
		$forum_last_post_time = (int) $db->sql_fetchfield('forum_last_post_time');
		$db->sql_freeresult($result);

		update_forum_tracking_info((($topic_type == POST_GLOBAL) ? 0 : $data['forum_id']), $forum_last_post_time, $f_mark_time, false);
	}

	// Send Notifications
	if ($mode != 'edit' && $mode != 'delete' && $post_approval)
	{
		user_notification($mode, $subject, $data['topic_title'], $data['forum_name'], $data['forum_id'], $data['topic_id'], $data['post_id']);
	}

	$params = $add_anchor = '';

	if ($post_approval)
	{
		$params .= '&amp;t=' . $data['topic_id'];

		if ($mode != 'post')
		{
			$params .= '&amp;p=' . $data['post_id'];
			$add_anchor = '#p' . $data['post_id'];
		}
	}
	else if ($mode != 'post' && $post_mode != 'edit_first_post' && $post_mode != 'edit_topic')
	{
		$params .= '&amp;t=' . $data['topic_id'];
	}

	$url = (!$params) ? "{$phpbb_root_path}viewforum.$phpEx" : "{$phpbb_root_path}viewtopic.$phpEx";
	$url = append_sid($url, 'f=' . $data['forum_id'] . $params) . $add_anchor;

	return $url;
}
?>