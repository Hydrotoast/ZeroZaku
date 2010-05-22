<?php

/**
*
* @package - "Milestone Congratulations"
* @version $Id: acp_milestone_congratulations.php 9 2008-10-02 MartectX $
* @copyright (C)2008, MartectX ( http://mods.martectx.de/ )
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
* @package acp
*/
class acp_milestone_congratulations
{
	var $u_action;

	function main($id, $mode)
	{
		global $auth, $cache, $config, $db, $dbms, $phpbb_admin_path, $phpbb_root_path, $phpEx, $table_prefix, $template, $user;

		$mc_version = '1.2.8';

		$user->add_lang('mods/milestone_congratulations');

		$this->tpl_name = 'acp_milestone_congratulations';
		$this->page_title = $user->lang['MC_TITLE'];

		if (!isset($config['milestone_version']))
		{
			set_config('milestone_version', '0');
		}

		if ($config['milestone_version'] != $mc_version)
		{
			include($phpbb_root_path . 'includes/db/db_tools.' . $phpEx);
			$db_tools = new phpbb_db_tools($db);

			switch ($config['milestone_version'])
			{
				case '0':
					// OK, let's install this: Some config variables first!
					set_config('milestone_version', $mc_version);
					set_config('milestone_setting', 0);
					set_config('milestone_history', 0);

					$goal = $config['num_posts'] + 1;
					while ($goal % 1000 != 0) $goal++;

					set_config('milestone_pgoal', $goal);
					set_config('milestone_pinc', 1000);
					set_config('milestone_posts', 1);
					set_config('milestone_pid', $user->data['user_id']);
					set_config('milestone_puser', $user->data['username']);
					set_config('milestone_pcolour', $user->data['user_colour']);

					$goal = $config['num_topics'] + 1;
					while ($goal % 100 != 0) $goal++;

					set_config('milestone_tgoal', $goal);
					set_config('milestone_tinc', 100);
					set_config('milestone_topics', 1);
					set_config('milestone_tid', $user->data['user_id']);
					set_config('milestone_tuser', $user->data['username']);
					set_config('milestone_tcolour', $user->data['user_colour']);

					$goal = $config['num_users'] + 1;
					while ($goal % 50 != 0) $goal++;

					set_config('milestone_ugoal', $goal);
					set_config('milestone_uinc', 50);
					set_config('milestone_users', 1);
					set_config('milestone_uid', $user->data['user_id']);
					set_config('milestone_uuser', $user->data['username']);
					set_config('milestone_ucolour', $user->data['user_colour']);

					// Need a table for the history!
					// BEGIN Multiple dbms create table
					// http://phpbbmodders.net/articles/3.0/create_table/
					{
						$install_dbms = $dbms;
						$install_path = $phpbb_root_path . 'milestones_schemata/';

						static $available_dbms = false;

						if (!$available_dbms)
						{
							if (!function_exists('get_available_dbms'))
							{
								include($phpbb_root_path . 'includes/functions_install.' . $phpEx);
							}

							$available_dbms = get_available_dbms($install_dbms);

							if ($install_dbms == 'mysql')
							{
								if (version_compare($db->mysql_version, '4.1.3', '>='))
								{
									$available_dbms[$install_dbms]['SCHEMA'] .= '_41';
								}
								else
								{
									$available_dbms[$install_dbms]['SCHEMA'] .= '_40';
								}
							}
						}

						$remove_remarks = $available_dbms[$install_dbms]['COMMENTS'];
						$delimiter = $available_dbms[$install_dbms]['DELIM'];

						$dbms_schema = $install_path . $available_dbms[$install_dbms]['SCHEMA'] . '_schema.sql';

						if (file_exists($dbms_schema))
						{
							$sql_query = @file_get_contents($dbms_schema);
							$sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);

							$remove_remarks($sql_query);

							$sql_query = split_sql_file($sql_query, $delimiter);

							foreach ($sql_query as $sql)
							{
								$db->sql_query($sql);
							}
							unset($sql_query);
						}
					}
					// END Multiple dbms create table

					// The admin installing gets all the fame (for now)!
					$sql = 'INSERT INTO ' . MILESTONES_TABLE . ' ' . $db->sql_build_array('INSERT', array(
						'user_id'	=> $user->data['user_id'],
						'milestone'	=> $config['milestone_posts'],
						'type'		=> 1
					));
					$db->sql_query($sql);

					$sql = 'INSERT INTO ' . MILESTONES_TABLE . ' ' . $db->sql_build_array('INSERT', array(
						'user_id'	=> $user->data['user_id'],
						'milestone'	=> $config['milestone_topics'],
						'type'		=> 2
					));
					$db->sql_query($sql);

					$sql = 'INSERT INTO ' . MILESTONES_TABLE . ' ' . $db->sql_build_array('INSERT', array(
						'user_id'	=> $user->data['user_id'],
						'milestone'	=> $config['milestone_users'],
						'type'		=> 3
					));
					$db->sql_query($sql);

					// Purge cache for template updates (milestone history page)
					$cache->purge();
					add_log('admin', 'MC_INSTALLED', $config['milestone_version']);
				break;

				case '1.2.0':
					set_config('milestone_version', '1.2.1');

				case '1.2.1':
					set_config('milestone_version', '1.2.2');

				case '1.2.2':
					set_config('milestone_version', '1.2.3');
					//$db_tools->sql_column_change(MILESTONES_TABLE, 'milestone', array('UINT', 0));

				case '1.2.3':
					set_config('milestone_version', '1.2.4');

				case '1.2.4':
					set_config('milestone_version', '1.2.5');
					$db_tools->sql_column_change(MILESTONES_TABLE, 'user_id', array('UINT', 0));
					$db_tools->sql_column_change(MILESTONES_TABLE, 'milestone', array('UINT', 0));

					switch ($config['milestone_setting'])
					{
						case 1:
							set_config('milestone_setting', 'POSTS_TOPICS_USERS');
						break;
						case 2:
							set_config('milestone_setting', 'POSTS');
						break;
						case 3:
							set_config('milestone_setting', 'TOPICS');
						break;
						case 4:
							set_config('milestone_setting', 'USERS');
						break;
						case 5:
							set_config('milestone_setting', 'POSTS_TOPICS');
						break;
						case 6:
							set_config('milestone_setting', 'POSTS_USERS');
						break;
						case 7:
							set_config('milestone_setting', 'TOPICS_USERS');
						break;
						default:
							set_config('milestone_setting', 0);
					}

				case '1.2.5':
					set_config('milestone_version', '1.2.6');

				case '1.2.6':
					set_config('milestone_version', '1.2.7');

				case '1.2.7':
					set_config('milestone_version', '1.2.8');
					$db_tools->sql_column_change(MILESTONES_TABLE, 'type', array('USINT', 0));
					$db_tools->sql_create_index(MILESTONES_TABLE, 'user_id', array('user_id'));
					$db_tools->sql_create_index(MILESTONES_TABLE, 'milestone', array('milestone'));
					$db_tools->sql_create_index(MILESTONES_TABLE, 'type', array('type'));

				add_log('admin', 'MC_UPDATED', $config['milestone_version']);
			}
		}

		add_form_key('acp_milestone_congratulations');

		$submit = (isset($_POST['submit'])) ? true : false;

		switch ($config['milestone_setting'])
		{
			case 'POSTS_TOPICS_USERS':
				$mc_p = 1;
				$mc_t = 1;
				$mc_u = 1;
			break;
			case 'POSTS':
				$mc_p = 1;
				$mc_t = 0;
				$mc_u = 0;
			break;
			case 'TOPICS':
				$mc_p = 0;
				$mc_t = 1;
				$mc_u = 0;
			break;
			case 'USERS':
				$mc_p = 0;
				$mc_t = 0;
				$mc_u = 1;
			break;
			case 'POSTS_TOPICS':
				$mc_p = 1;
				$mc_t = 1;
				$mc_u = 0;
			break;
			case 'POSTS_USERS':
				$mc_p = 1;
				$mc_t = 0;
				$mc_u = 1;
			break;
			case 'TOPICS_USERS':
				$mc_p = 0;
				$mc_t = 1;
				$mc_u = 1;
			break;
			default:
				$mc_p = 0;
				$mc_t = 0;
				$mc_u = 0;
		}

		if ($submit)
		{
			if (!check_form_key('acp_milestone_congratulations'))
			{
				trigger_error('FORM_INVALID');
			}

			$mc_pbox		= request_var('mc_pbox', 0);
			$mc_tbox		= request_var('mc_tbox', 0);
			$mc_ubox		= request_var('mc_ubox', 0);
			$mc_history		= request_var('mc_history', 0);
			$mc_colour		= request_var('mc_colour', 0);
			$mc_pinc		= request_var('mc_pinc', 1000);
			$mc_pgoal		= request_var('mc_pgoal', 1000);
			$mc_tinc		= request_var('mc_tinc', 100);
			$mc_tgoal		= request_var('mc_tgoal', 100);
			$mc_uinc		= request_var('mc_uinc', 50);
			$mc_ugoal		= request_var('mc_ugoal', 50);

			if ($mc_p != $mc_pbox || $mc_t != $mc_tbox || $mc_u != $mc_ubox)
			{
				if ($mc_pbox == 1 && $mc_tbox == 1 && $mc_ubox == 1)
				{
					set_config('milestone_setting', 'POSTS_TOPICS_USERS');
				}
				elseif ($mc_pbox == 1 && $mc_tbox == 0 && $mc_ubox == 0)
				{
					set_config('milestone_setting', 'POSTS');
				}
				elseif ($mc_pbox == 0 && $mc_tbox == 1 && $mc_ubox == 0)
				{
					set_config('milestone_setting', 'TOPICS');
				}
				elseif ($mc_pbox == 0 && $mc_tbox == 0 && $mc_ubox == 1)
				{
					set_config('milestone_setting', 'USERS');
				}
				elseif ($mc_pbox == 1 && $mc_tbox == 1 && $mc_ubox == 0)
				{
					set_config('milestone_setting', 'POSTS_TOPICS');
				}
				elseif ($mc_pbox == 1 && $mc_tbox == 0 && $mc_ubox == 1)
				{
					set_config('milestone_setting', 'POSTS_USERS');
				}
				elseif ($mc_pbox == 0 && $mc_tbox == 1 && $mc_ubox == 1)
				{
					set_config('milestone_setting', 'TOPICS_USERS');
				}
				else
				{
					set_config('milestone_setting', 0);
				}
			}

			if ($mc_history != $config['milestone_history'])
			{
				set_config('milestone_history', $mc_history);
			}

			if ($mc_pgoal != $config['milestone_pgoal'])
			{
				set_config('milestone_pgoal', $mc_pgoal);
			}

			if ($mc_pinc != $config['milestone_pinc'] && $mc_pinc > 0)
			{
				set_config('milestone_pinc', $mc_pinc);
			}

			if ($mc_tgoal != $config['milestone_tgoal'])
			{
				set_config('milestone_tgoal', $mc_tgoal);
			}

			if ($mc_tinc != $config['milestone_tinc'] && $mc_tinc > 0)
			{
				set_config('milestone_tinc', $mc_tinc);
			}

			if ($mc_ugoal != $config['milestone_ugoal'])
			{
				set_config('milestone_ugoal', $mc_ugoal);
			}

			if ($mc_uinc != $config['milestone_uinc'] && $mc_uinc > 0)
			{
				set_config('milestone_uinc', $mc_uinc);
			}

			if ($mc_colour)
			{
				$sql = 'SELECT user_colour
					FROM ' . USERS_TABLE . '
					WHERE user_id = ' . intval($config['milestone_pid']);
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					set_config('milestone_pcolour', $row['user_colour']);
				}
				$db->sql_freeresult($result);

				$sql = 'SELECT user_colour
					FROM ' . USERS_TABLE . '
					WHERE user_id = ' . intval($config['milestone_tid']);
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					set_config('milestone_tcolour', $row['user_colour']);
				}
				$db->sql_freeresult($result);

				$sql = 'SELECT user_colour
					FROM ' . USERS_TABLE . '
					WHERE user_id = ' . intval($config['milestone_uid']);
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					set_config('milestone_ucolour', $row['user_colour']);
				}
				$db->sql_freeresult($result);
			}

			$errormessage = ($mc_pinc <= 0 || $mc_tinc <= 0 || $mc_uinc <= 0) ? $user->lang['MC_NOTNULL'] : $user->lang['MC_SUCCESS'];

			trigger_error($errormessage . adm_back_link($this->u_action));
		}

		$mc_posts = sprintf($user->lang['MILESTONE_P'], $config['milestone_posts'], get_username_string('full', $config['milestone_pid'], $config['milestone_puser'], $config['milestone_pcolour'])) . '<br /><i>' . sprintf($user->lang['TOTAL_POSTS_OTHER'], $config['num_posts']) . '</i>';
		$mc_topics = sprintf($user->lang['MILESTONE_T'], $config['milestone_topics'], get_username_string('full', $config['milestone_tid'], $config['milestone_tuser'], $config['milestone_tcolour'])) . '<br /><i>' . sprintf($user->lang['TOTAL_TOPICS_OTHER'], $config['num_topics']) . '</i>';
		$mc_users = sprintf($user->lang['MILESTONE_U'], $config['milestone_users'], get_username_string('full', $config['milestone_uid'], $config['milestone_uuser'], $config['milestone_ucolour'])) . '<br /><i>' . sprintf($user->lang['TOTAL_USERS_OTHER'], $config['num_users']) . '</i>';

		$template->assign_vars(array(
			'MC_VERSION'	=> $config['milestone_version'],

			'MC_PBOX'		=> $mc_p,
			'MC_TBOX'		=> $mc_t,
			'MC_UBOX'		=> $mc_u,
			'MC_HISTORY'	=> $config['milestone_history'],
			'MC_HISTORYLNK'	=> '<a href="' . append_sid("{$phpbb_root_path}milestones.$phpEx", 'view=all') . '">' . $user->lang['MC_HISTORYLINK'] . '</a>',

			'MC_POSTS'		=> $mc_posts,
			'MC_PGOAL'		=> $config['milestone_pgoal'],
			'MC_PINC'		=> $config['milestone_pinc'],

			'MC_TOPICS'		=> $mc_topics,
			'MC_TGOAL'		=> $config['milestone_tgoal'],
			'MC_TINC'		=> $config['milestone_tinc'],

			'MC_USERS'		=> $mc_users,
			'MC_UGOAL'		=> $config['milestone_ugoal'],
			'MC_UINC'		=> $config['milestone_uinc'],

			'U_ACTION'		=> $this->u_action)
		);
	}
}

?>