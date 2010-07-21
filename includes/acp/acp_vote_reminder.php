<?php
/**
*
* @package acp
* @version $Id: acp_words.php 8479 2008-03-29 00:22:48Z naderman $
* @version $Id: acp_vote_reminder.php v1.0.0 2008-08-30 - modified by mtrs for pole vote reminder ACP module
* @copyright (c) 2005 phpBB Group
* @copyright (c) 2009 mtrs
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

class acp_vote_reminder
{
	var $u_action;
	
	function main($id, $mode)
	{
		global $db, $user, $config, $template, $phpbb_root_path, $phpEx;

		// Set up general vars
		$action = request_var('action', '');
		$action = (request_var('add', '')) ? 'add' : ((request_var('save', '')) ? 'save' : $action);
		$action = (request_var('update', '')) ? 'update' : $action;
		$action = (request_var('reminder-reset', '')) ? 'reminder-reset' : $action;
		
		$this->tpl_name = 'acp_vote_reminder';
		$this->page_title = 'ACP_VOTE_REMINDER';

		$form_name = 'acp_vote_reminder';
		add_form_key($form_name);

		switch ($action)
		{
			case 'add':
			
				//We obtain list of voting compulsory topics, which are still open to vote
				$sql = 'SELECT topic_id, topic_title, poll_title, forum_id, poll_length, poll_start, poll_last_vote
					FROM ' . TOPICS_TABLE . '
					WHERE poll_start <> 0
						AND poll_vote_compulsory = 0
						AND topic_status = ' . ITEM_UNLOCKED . '
					ORDER BY topic_id DESC';
				$result = $db->sql_query($sql);		
		
				$s_poll_options = '<option value=""  selected="selected">--</option>';
				$poll_exist = false;
				while ($row = $db->sql_fetchrow($result))
				{
					//We eliminate topics if poll is closed and user cannot vote
					if (($row['poll_length'] != 0 && ($row['poll_start'] + $row['poll_length']) > time()) || $row['poll_length'] == 0)
					{
						$topic_id = $row['topic_id'];
						$poll_title = $row['poll_title'];
						$s_poll_options .= "<option value=\"$topic_id\">$poll_title</option>";
						$poll_exist = true;
					}
				}
				$db->sql_freeresult($result);

				if (!$poll_exist)
				{
					trigger_error($user->lang['NO_POLL_EXIST'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$template->assign_vars(array(
					'S_ADD_TOPIC'		=> true,				
					'U_ACTION'			=> $this->u_action,
					'U_BACK'			=> $this->u_action,					
					'S_POLL_OPTIONS'	=> $s_poll_options,
					'TOPIC_ID'			=> request_var('topic_id', 0))
				);

			break;
			
			case 'save':

				if (!check_form_key($form_name))
				{
					trigger_error($user->lang['FORM_INVALID']. adm_back_link($this->u_action), E_USER_WARNING);
				}
				$topic_id = request_var('topic_id', 0);
				
	
				if (!$topic_id)
				{
					trigger_error($user->lang['SELECT_POLL_TITLE'] . adm_back_link($this->u_action), E_USER_WARNING);
				}
						
				$sql_ary = array(
					'poll_vote_compulsory'			=> 1,
				);
				
				if ($topic_id)
				{
					$db->sql_query('UPDATE ' . TOPICS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE topic_id = ' . $topic_id);
				}

				add_log('admin', 'LOG_VOTE_TOPIC_ADD', $topic_id);
				trigger_error($user->lang['POLL_ADDED'] . adm_back_link($this->u_action));

			break;			

			case 'delete':

				//Obtain the vote topic_id and set it not compulsory to vote anymore
				$topic_id = request_var('topic_id', 0);

				if (!$topic_id)
				{
					trigger_error($user->lang['NO_TOPIC'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				if (confirm_box(true))
				{
					$sql_ary = array(
						'poll_vote_compulsory'			=> 0,
					);
					
					if ($topic_id)
					{
						$db->sql_query('UPDATE ' . TOPICS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE topic_id = ' . $topic_id);
					}

					add_log('admin', 'LOG_VOTE_TOPIC_REMOVE', $topic_id);
					trigger_error($user->lang['TOPIC_REMOVED'] . adm_back_link($this->u_action));
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'i'				=> $id,
						'mode'			=> $mode,
						'topic_id'		=> $topic_id,
						'action'		=> 'delete',
					)));
				}

			break;
									
			case 'reminder-reset':
				
				//Reset users table vote reminder field, thus users can be redirected to any new compulsory polls again
				$sql = 'UPDATE ' . USERS_TABLE . '
					SET user_vote_reminder = 0
					WHERE user_vote_reminder = 1
						AND user_type <> ' . USER_IGNORE;
				$db->sql_query($sql);
				
				$sql = 'UPDATE ' . USERS_TABLE . '
					SET user_last_vote_reminder = 0
					WHERE user_type <> ' . USER_IGNORE;
				$db->sql_query($sql);
					
				add_log('admin', 'RESET_VOTE_REMINDER');			
				trigger_error($user->lang['RESET_VOTE_REMINDER'] . adm_back_link($this->u_action));

			break;
			
			
			case 'update':

				//Update config fields
				$vote_enabled = request_var('vote_reminder_enable', 0);
				$who_voted = request_var('vote_reminder_who_voted', 0);
				$vote_topic_id = abs(request_var('vote_reminder_topic_id', 0));
				$vote_interval = abs(request_var('vote_reminder_interval', 0));
				
				set_config('vote_reminder_enable', $vote_enabled);					
				set_config('vote_reminder_who_voted', $who_voted);
				set_config('vote_reminder_topic_id', $vote_topic_id);
				set_config('vote_reminder_interval', $vote_interval);
				
				trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
				
			break;
		}

		$template->assign_vars(array(
			'U_ACTION'			=> $this->u_action)
		);

		//We obtain list of voting compulsory topics, which are still open to vote
		$sql = 'SELECT p.topic_id, p.vote_user_id, u.username
			FROM ' . POLL_VOTES_TABLE . ' p
			LEFT JOIN ' . USERS_TABLE . ' u ON p.vote_user_id = u.user_id
			ORDER BY p.topic_id DESC';
		$result = $db->sql_query($sql);		
		
		$topic_votes_count = $who_voted = array();
		
		while ($row = $db->sql_fetchrow($result))
		{
			$who_voted[$row['topic_id']][] = ($row['vote_user_id'] != ANONYMOUS) ? $row['username'] : $user->lang['GUEST'];
		}
		$db->sql_freeresult($result);		
				
		//We obtain list of voting compulsory topics, which are still open to vote
		$sql = 'SELECT topic_id, topic_title, poll_title, forum_id, poll_length, poll_start, poll_last_vote
			FROM ' . TOPICS_TABLE . '
			WHERE poll_start <> 0
				AND poll_vote_compulsory = 1
				AND topic_status = ' . ITEM_UNLOCKED . '
			ORDER BY topic_id DESC';
		$result = $db->sql_query($sql);		
		
		$topic_id_list = array();
		$number = 1;
		
		while ($row = $db->sql_fetchrow($result))
		{
			//We eliminate topics if poll is closed and user cannot vote
			if (($row['poll_length'] != 0 && ($row['poll_start'] + $row['poll_length']) > time()) || $row['poll_length'] == 0)
			{
				$forum_id = $row['forum_id'];
				$topic_id = $row['topic_id'];
				$template->assign_block_vars('topics', array(
					'NUMBER'		=> $number,
					'POLL_TITLE'	=> $row['poll_title'],
					'VOTE_END'		=> ($row['poll_length'] == 0) ? $user->lang['UNLIMITED'] : $user->format_date(($row['poll_start'] + $row['poll_length']), $format = 'd-m-y', true),
					'LAST_VOTE'		=> ($row['poll_last_vote'] == 0) ? $user->lang['NO_VOTE'] : $user->format_date($row['poll_last_vote'], $format = 'd-m-y H-i', true),
					'VOTE_COUNT'	=> (isset($who_voted[$row['topic_id']])) ? sizeof($who_voted[$row['topic_id']]) : 0,
					'WHO_VOTED'		=> (isset($who_voted[$row['topic_id']]) && $config['vote_reminder_who_voted']) ? implode(', ', $who_voted[$row['topic_id']]) : '',
					'U_TOPIC'		=> ($forum_id) ? append_sid($phpbb_root_path . "viewtopic.$phpEx?f=$forum_id&amp;t=$topic_id") : append_sid($phpbb_root_path . "viewtopic.$phpEx?t=$topic_id"),
					'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;topic_id=' . $row['topic_id'],
					'ICON_REMOVED'	=> $phpbb_root_path . '/adm/images/icon_delete.gif'	
				));
				$number++;
			}
		}
		$db->sql_freeresult($result);
		
		$template->assign_vars( array(
			'VOTE_ENABLED'		=> ($config['vote_reminder_enable']) ? true : false,
			'WHO_VOTED'			=> ($config['vote_reminder_who_voted']) ? true : false,
			'VOTE_READ_TOPIC'	=> $config['vote_reminder_topic_id'],
			'VOTE_INTERVAL'		=> $config['vote_reminder_interval']
		));
	}
}

?>