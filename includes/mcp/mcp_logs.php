<?php
/**
*
* @package mcp
* @version $Id: mcp_logs.php 10433 2010-01-24 16:00:18Z rxu $
* @copyright (c) 2005 phpBB Group
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
* mcp_logs
* Handling warning the users
* @package mcp
*/
class mcp_logs
{
	var $u_action;
	var $p_master;

	function mcp_logs(&$p_master)
	{
		$this->p_master = &$p_master;
	}

	function main($id, $mode)
	{
		global $auth, $db, $user, $template;
		global $config, $phpbb_root_path, $phpEx;

		$user->add_lang('acp/common');

		$action = request_var('action', array('' => ''));

		if (is_array($action))
		{
			list($action, ) = each($action);
		}
		else
		{
			$action = request_var('action', '');
		}

		if($mode == 'ip_search')
		{
		    $this->tpl_name = 'mcp_ip_search';
			$this->page_title = 'MCP_IP_SEARCH';

			$ip = request_var('ip', '');
			$type = request_var('type', '');
			$url = $this->u_action . '&amp;ip=' . $ip;
			$start = request_var('start', 0);
			
			if ($ip)
			{
				$user->add_lang('memberlist');
			
				$sql_ip = $db->sql_escape($ip);
				$start = (int) $start;
				$limit = request_var('limit', 10);
			
				$total = 0;
				$cnt = 1;
				$output = '';
				
				$types = array('bot_check', 'poll_votes', 'posts', 'privmsgs', 'users');
				if(!in_array($type, $types))
				    trigger_error('NOT_AUTHORISED');
				
				switch ($type)
				{
					case 'bot_check' :
						$sql = 'SELECT bot_name, bot_agent FROM ' . BOTS_TABLE . ' WHERE bot_ip = \'' . $sql_ip . '\'';
						$result = $db->sql_query($sql);
						
						$output = '<thead><tr><th>' . $user->lang['USERNAME'] . '</th><th>' . $user->lang['USER_AGENT'] .'</th></tr></thead>';
						while ($row = $db->sql_fetchrow($result))
						{
							++$cnt;
							$output .= '<tr class="row' . ($cnt % 2 + 1) . '">';
							foreach ($row as $name => $data)
							{
								$output .= '<td>' . $data . '</td>';
							}
							$output .= '</tr>';
						}
						$db->sql_freeresult($result);
					break;
					// case 'bot_check' :
			
					case 'poll_votes' :
						$db->sql_query('SELECT count(vote_user_ip) AS total FROM ' . POLL_VOTES_TABLE . '
							WHERE vote_user_ip = \'' . $sql_ip . '\'');
						$total = $db->sql_fetchfield('total');
						$sql = 'SELECT v.topic_id, v.poll_option_id, v.vote_user_id, u.user_id, u.username, u.user_colour FROM ' . POLL_VOTES_TABLE . ' v, ' . USERS_TABLE . ' u
							WHERE v.vote_user_ip = \'' . $sql_ip . '\'
								AND u.user_id = v.vote_user_id
							ORDER BY topic_id DESC';
						$result = $db->sql_query_limit($sql, $limit, $start);
						
						$output = '<thead><tr><th>' . $user->lang['ID'] . '</th><th>' . $user->lang['VOTE'] . '</th><th>' . $user->lang['USERNAME'] . '</th></tr></thead>';
						while ($row = $db->sql_fetchrow($result))
						{
							++$cnt;
							$row['topic_id'] = '<a href="' . append_sid("{$phpbb_root_path}viewtopic.$phpEx", 't=' . $row['topic_id']) . '">' . $row['topic_id'] . '</a>';
							$row['username'] = get_username_string('full', $row['vote_user_id'], $row['username'], $row['user_colour']);
							unset($row['user_id'], $row['vote_user_id'], $row['user_colour']);
							$output .= '<tr class="row' . ($cnt % 2 + 1) . '">';
							foreach ($row as $name => $data)
							{
								$output .= '<td>' . $data . '</td>';
							}
							$output .= '</tr>';
						}
						$db->sql_freeresult($result);
					break;
					// case 'poll_votes' :
			
					case 'posts' :
						$db->sql_query('SELECT count(post_id) AS total FROM ' . POSTS_TABLE . '
							WHERE poster_ip = \'' . $sql_ip . '\'');
						$total = $db->sql_fetchfield('total');
						$sql = 'SELECT p.post_subject, p.topic_id, p.post_id, p.poster_id, u.username, u.user_colour, p.post_username, p.post_time FROM ' . POSTS_TABLE . ' p, ' . USERS_TABLE . ' u
							WHERE poster_ip = \'' . $sql_ip . '\'
								AND u.user_id = p.poster_id
							ORDER BY post_time DESC';
						$result = $db->sql_query_limit($sql, $limit, $start);
						
						$output = '<thead><tr><th>' . $user->lang['TOPIC'] . '</th><th>' . $user->lang['USERNAME'] . '</th><th>' . $user->lang['TIME'] . '</th></tr></thead>';
						while ($row = $db->sql_fetchrow($result))
						{
						    ++$cnt;
							$row['post_subject'] = '<a href="' . append_sid("{$phpbb_root_path}viewtopic.$phpEx", "t={$row['topic_id']}&amp;p={$row['post_id']}#p{$row['post_id']}") . '">' . $row['post_subject'] . '</a>';
							$row['username'] = get_username_string('full', $row['poster_id'], $row['username'], $row['user_colour'], $row['post_username']);
							$row['post_time'] = $user->format_date($row['post_time']);
							unset($row['poster_id'], $row['post_id'], $row['topic_id'], $row['user_colour'], $row['post_username']);

							$output .= '<tr class="row' . ($cnt % 2 + 1) . '">';
							foreach ($row as $name => $data)
							{
								$output .= '<td>' . $data . '</td>';
							}
							$output .= '</tr>';
						}
						$db->sql_freeresult($result);
					break;
					// case 'posts' :
			
					case 'privmsgs' :
						$db->sql_query('SELECT count(msg_id) AS total FROM ' . PRIVMSGS_TABLE . '
							WHERE author_ip = \'' . $sql_ip . '\'');
						$total = $db->sql_fetchfield('total');
						$sql = 'SELECT p.msg_id, p.author_id, u.username, u.user_colour, p.message_time, message_subject FROM ' . PRIVMSGS_TABLE . ' p, ' . USERS_TABLE . ' u
							WHERE author_ip = \'' . $sql_ip . '\'
							AND u.user_id = p.author_id
							ORDER BY message_time DESC';
						$result = $db->sql_query_limit($sql, $limit, $start);
						
						$output = '<thead><tr><th>' . $user->lang['ID'] . '</th><th>' . $user->lang['AUTHOR'] . '</th><th>' . $user->lang['TIME'] . '</th><th>' . $user->lang['MESSAGE'] . '</th></thead>';
						while ($row = $db->sql_fetchrow($result))
						{
						    ++$cnt;
							$row['username'] = get_username_string('full', $row['author_id'], $row['username'], $row['user_colour']);
							unset($row['author_id'], $row['user_colour']);
			
							$row['message_time'] = $user->format_date($row['message_time']);
							$output .= '<tr class="row' . ($cnt % 2 + 1) . '">';
							foreach ($row as $name => $data)
							{
								$output .= '<td>' . $data . '</td>';
							}
							$output .= '</tr>';
						}
						$db->sql_freeresult($result);
					break;
					//case 'privmsgs' :
			
					case 'users' :
						$db->sql_query('SELECT count(user_id) AS total FROM ' . USERS_TABLE . '
							WHERE user_ip = \'' . $sql_ip . '\'');
						$total = $db->sql_fetchfield('total');
						$sql = 'SELECT user_id, username, user_regdate, user_email, user_colour  FROM ' . USERS_TABLE . '
							WHERE user_ip = \'' . $sql_ip . '\'
							ORDER BY user_regdate DESC';
						$result = $db->sql_query_limit($sql, $limit, $start);
						
						$output = '<thead><tr><th>' . $user->lang['USERNAME'] . '</th><th>' . $user->lang['REGISTERED'] . '</th><th>' . $user->lang['EMAIL'] . '</th></tr></thead>';
						while ($row = $db->sql_fetchrow($result))
						{
						    ++$cnt;
							$row['username'] = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);
							unset($row['user_colour'], $row['user_id']);
			
							$row['user_regdate'] = $user->format_date($row['user_regdate']);
							$output .= '<tr class="row' . ($cnt % 2 + 1) . '">';
							foreach ($row as $name => $data)
							{
								$output .= '<td>' . $data . '</td>';
							}
							$output .= '</tr>';
						}
						$db->sql_freeresult($result);
					break;
					// case 'users' :
				}
			
				if ($output)
				{
					$template->assign_block_vars('data_output', array(
						'DATA'			=> $output,
					));
					
					$template->assign_vars(array(
					    'TOTAL'			=> ($total) ? $total . ' ' . $user->lang['LOGS'] : false,
					    'PAGINATION'	=> ($total) ? generate_pagination($url . "&amp;type=$type&amp;limit=$limit", $total, $limit, $start, true, 'data_output') : '',
					));
				}
			}

			$template->assign_vars(array(
				'L_TITLE'				=> $user->lang['MCP_IP_SEARCH'],
				'L_TITLE_EXPLAIN'		=> $user->lang['MCP_IP_SEARCH_EXPLAIN'],
				'S_DATA_OUTPUT'			=> true,
			    
			    'IP'	=> ($ip) ? $ip : '',
			    'TYPE'	=> ($type) ? $type : '',
			));
			
			return;
		}
		else
		{
			// Set up general vars
			$start		= request_var('start', 0);
			$deletemark = ($action == 'del_marked') ? true : false;
			$deleteall	= ($action == 'del_all') ? true : false;
			$marked		= request_var('mark', array(0));
	
			// Sort keys
			$sort_days	= request_var('st', 0);
			$sort_key	= request_var('sk', 't');
			$sort_dir	= request_var('sd', 'd');
	
			$this->tpl_name = 'mcp_logs';
			$this->page_title = 'MCP_LOGS';
	
			$forum_list = array_values(array_intersect(get_forum_list('f_read'), get_forum_list('m_')));
			$forum_list[] = 0;
	
			$forum_id = $topic_id = 0;
	
			switch ($mode)
			{
				case 'front':
				break;
	
				case 'forum_logs':
					$forum_id = request_var('f', 0);
	
					if (!in_array($forum_id, $forum_list))
					{
						trigger_error('NOT_AUTHORISED');
					}
	
					$forum_list = array($forum_id);
				break;
	
				case 'topic_logs':
					$topic_id = request_var('t', 0);
	
					$sql = 'SELECT forum_id
						FROM ' . TOPICS_TABLE . '
						WHERE topic_id = ' . $topic_id;
					$result = $db->sql_query($sql);
					$forum_id = (int) $db->sql_fetchfield('forum_id');
					$db->sql_freeresult($result);
	
					if (!in_array($forum_id, $forum_list))
					{
						trigger_error('NOT_AUTHORISED');
					}
	
					$forum_list = array($forum_id);
				break;
			}
	
			// Delete entries if requested and able
			if (($deletemark || $deleteall) && $auth->acl_get('a_clearlogs'))
			{
				if (confirm_box(true))
				{
					if ($deletemark && sizeof($marked))
					{
						$sql = 'DELETE FROM ' . LOG_TABLE . '
							WHERE log_type = ' . LOG_MOD . '
								AND ' . $db->sql_in_set('forum_id', $forum_list) . '
								AND ' . $db->sql_in_set('log_id', $marked);
						$db->sql_query($sql);
	
						add_log('admin', 'LOG_CLEAR_MOD');
					}
					else if ($deleteall)
					{
						$sql = 'DELETE FROM ' . LOG_TABLE . '
							WHERE log_type = ' . LOG_MOD . '
								AND ' . $db->sql_in_set('forum_id', $forum_list);
	
						if ($mode == 'topic_logs')
						{
							$sql .= ' AND topic_id = ' . $topic_id;
						}
						$db->sql_query($sql);
	
						add_log('admin', 'LOG_CLEAR_MOD');
					}
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'f'			=> $forum_id,
						't'			=> $topic_id,
						'start'		=> $start,
						'delmarked'	=> $deletemark,
						'delall'	=> $deleteall,
						'mark'		=> $marked,
						'st'		=> $sort_days,
						'sk'		=> $sort_key,
						'sd'		=> $sort_dir,
						'i'			=> $id,
						'mode'		=> $mode,
						'action'	=> request_var('action', array('' => ''))))
					);
				}
			}
	
			// Sorting
			$limit_days = array(0 => $user->lang['ALL_ENTRIES'], 1 => $user->lang['1_DAY'], 7 => $user->lang['7_DAYS'], 14 => $user->lang['2_WEEKS'], 30 => $user->lang['1_MONTH'], 90 => $user->lang['3_MONTHS'], 180 => $user->lang['6_MONTHS'], 365 => $user->lang['1_YEAR']);
			$sort_by_text = array('u' => $user->lang['SORT_USERNAME'], 't' => $user->lang['SORT_DATE'], 'i' => $user->lang['SORT_IP'], 'o' => $user->lang['SORT_ACTION']);
			$sort_by_sql = array('u' => 'u.username_clean', 't' => 'l.log_time', 'i' => 'l.log_ip', 'o' => 'l.log_operation');
	
			$s_limit_days = $s_sort_key = $s_sort_dir = $u_sort_param = '';
			gen_sort_selects($limit_days, $sort_by_text, $sort_days, $sort_key, $sort_dir, $s_limit_days, $s_sort_key, $s_sort_dir, $u_sort_param);
	
			// Define where and sort sql for use in displaying logs
			$sql_where = ($sort_days) ? (time() - ($sort_days * 86400)) : 0;
			$sql_sort = $sort_by_sql[$sort_key] . ' ' . (($sort_dir == 'd') ? 'DESC' : 'ASC');
	
			$keywords = utf8_normalize_nfc(request_var('keywords', '', true));
			$keywords_param = !empty($keywords) ? '&amp;keywords=' . urlencode(htmlspecialchars_decode($keywords)) : '';
	
			// Grab log data
			$log_data = array();
			$log_count = 0;
			view_log('mod', $log_data, $log_count, $config['topics_per_page'], $start, $forum_list, $topic_id, 0, $sql_where, $sql_sort, $keywords);
	
			$template->assign_vars(array(
				'PAGE_NUMBER'		=> on_page($log_count, $config['topics_per_page'], $start),
				'TOTAL'				=> ($log_count == 1) ? $user->lang['TOTAL_LOG'] : sprintf($user->lang['TOTAL_LOGS'], $log_count),
				'PAGINATION'		=> generate_pagination($this->u_action . "&amp;$u_sort_param$keywords_param", $log_count, $config['topics_per_page'], $start),
	
				'L_TITLE'			=> $user->lang['MCP_LOGS'],
	
				'U_POST_ACTION'			=> $this->u_action,
				'S_CLEAR_ALLOWED'		=> ($auth->acl_get('a_clearlogs')) ? true : false,
				'S_SELECT_SORT_DIR'		=> $s_sort_dir,
				'S_SELECT_SORT_KEY'		=> $s_sort_key,
				'S_SELECT_SORT_DAYS'	=> $s_limit_days,
				'S_LOGS'				=> ($log_count > 0),
				'S_KEYWORDS'			=> $keywords,
				)
			);
	
			foreach ($log_data as $row)
			{
				$data = array();
	
				$checks = array('viewtopic', 'viewforum');
				foreach ($checks as $check)
				{
					if (isset($row[$check]) && $row[$check])
					{
						$data[] = '<a href="' . $row[$check] . '">' . $user->lang['LOGVIEW_' . strtoupper($check)] . '</a>';
					}
				}
	
				$template->assign_block_vars('log', array(
					'USERNAME'		=> $row['username_full'],
					'IP'			=> $row['ip'],
					'DATE'			=> $user->format_date($row['time']),
					'ACTION'		=> $row['action'],
					'DATA'			=> (sizeof($data)) ? implode(' | ', $data) : '',
					'ID'			=> $row['id'],
					)
				);
			}
		}
	}
}

?>