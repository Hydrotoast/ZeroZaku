<?php

/**
*
* @package - "Milestone Congratulations"
* @version $Id: functions_milestones.php 2 2008-09-19 MartectX $
* @copyright (C)2008, MartectX ( http://mods.martectx.de/ )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

function milestones()
{
	global $config, $db, $user;

	if (!isset($config['milestone_setting'])) return '';

	if ($config['milestone_pgoal'] == $config['num_posts'])
	{
		$sql = 'INSERT INTO ' . MILESTONES_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'user_id'	=> $user->data['user_id'],
			'milestone'	=> $config['milestone_pgoal'],
			'type'		=> 1
		));
		$db->sql_query($sql);

		set_config('milestone_pid', $user->data['user_id']);
		set_config('milestone_puser', $user->data['username']);
		set_config('milestone_pcolour', $user->data['user_colour']);
		set_config('milestone_posts', $config['milestone_pgoal']);
		set_config('milestone_pgoal', $config['milestone_pgoal'] + $config['milestone_pinc']);
	}

	if ($config['milestone_tgoal'] == $config['num_topics'])
	{
		$sql = 'INSERT INTO ' . MILESTONES_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'user_id'	=> $user->data['user_id'],
			'milestone'	=> $config['milestone_tgoal'],
			'type'		=> 2
		));
		$db->sql_query($sql);

		set_config('milestone_tid', $user->data['user_id']);
		set_config('milestone_tuser', $user->data['username']);
		set_config('milestone_tcolour', $user->data['user_colour']);
		set_config('milestone_topics', $config['milestone_tgoal']);
		set_config('milestone_tgoal', $config['milestone_tgoal'] + $config['milestone_tinc']);
	}

	if ($config['milestone_ugoal'] == $config['num_users'])
	{
		$sql = 'INSERT INTO ' . MILESTONES_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'user_id'	=> $config['newest_user_id'],
			'milestone'	=> $config['milestone_ugoal'],
			'type'		=> 3
		));
		$db->sql_query($sql);

		set_config('milestone_uid', $config['newest_user_id']);
		set_config('milestone_uuser', $config['newest_username']);
		set_config('milestone_ucolour', $config['newest_user_colour']);
		set_config('milestone_users', $config['milestone_ugoal']);
		set_config('milestone_ugoal', $config['milestone_ugoal'] + $config['milestone_uinc']);
	}
}

function milestone_info()
{
	global $auth, $config, $user;

	if (!isset($config['milestone_setting']) || !$auth->acl_get('a_')) return '';

	switch ($config['milestone_setting'])
	{
		case 'POSTS_TOPICS_USERS':
			return '[ ' . $user->lang['MILESTONES'] . ': ' . $config['milestone_pgoal'] . ' | ' . $config['milestone_tgoal'] . ' | ' . $config['milestone_ugoal'] . ' ]';
		break;
		case 'POSTS':
			return '[ ' . $user->lang['MILESTONE'] . ': ' . $config['milestone_pgoal'] . ' ]';
		break;
		case 'TOPICS':
			return '[ ' . $user->lang['MILESTONE'] . ': ' . $config['milestone_tgoal'] . ' ]';
		break;
		case 'USERS':
			return '[ ' . $user->lang['MILESTONE'] . ': ' . $config['milestone_ugoal'] . ' ]';
		break;
		case 'POSTS_TOPICS':
			return '[ ' . $user->lang['MILESTONES'] . ': ' . $config['milestone_pgoal'] . ' | ' . $config['milestone_tgoal'] . ' ]';
		break;
		case 'POSTS_USERS':
			return '[ ' . $user->lang['MILESTONES'] . ': ' . $config['milestone_pgoal'] . ' | ' . $config['milestone_ugoal'] . ' ]';
		break;
		case 'TOPICS_USERS':
			return '[ ' . $user->lang['MILESTONES'] . ': ' . $config['milestone_tgoal'] . ' | ' . $config['milestone_ugoal'] . ' ]';
		break;
		default:
			return '';
	}
}

function milestone_message()
{
	global $config, $user;

	if (!isset($config['milestone_setting'])) return '';

	switch ($config['milestone_setting'])
	{
		case 'POSTS_TOPICS_USERS':
			return sprintf($user->lang['MILESTONE_PTU'], $config['milestone_posts'], get_username_string('full', $config['milestone_pid'], $config['milestone_puser'], $config['milestone_pcolour']), $config['milestone_topics'], get_username_string('full', $config['milestone_tid'], $config['milestone_tuser'], $config['milestone_tcolour']), $config['milestone_users'], get_username_string('full', $config['milestone_uid'], $config['milestone_uuser'], $config['milestone_ucolour']));
		break;
		case 'POSTS':
			return sprintf($user->lang['MILESTONE_P'], $config['milestone_posts'], get_username_string('full', $config['milestone_pid'], $config['milestone_puser'], $config['milestone_pcolour']));
		break;
		case 'TOPICS':
			return sprintf($user->lang['MILESTONE_T'], $config['milestone_topics'], get_username_string('full', $config['milestone_tid'], $config['milestone_tuser'], $config['milestone_tcolour']));
		break;
		case 'USERS':
			return sprintf($user->lang['MILESTONE_U'], $config['milestone_users'], get_username_string('full', $config['milestone_uid'], $config['milestone_uuser'], $config['milestone_ucolour']));
		break;
		case 'POSTS_TOPICS':
			return sprintf($user->lang['MILESTONE_PT'], $config['milestone_posts'], get_username_string('full', $config['milestone_pid'], $config['milestone_puser'], $config['milestone_pcolour']), $config['milestone_topics'], get_username_string('full', $config['milestone_tid'], $config['milestone_tuser'], $config['milestone_tcolour']));
		break;
		case 'POSTS_USERS':
			return sprintf($user->lang['MILESTONE_PU'], $config['milestone_posts'], get_username_string('full', $config['milestone_pid'], $config['milestone_puser'], $config['milestone_pcolour']), $config['milestone_users'], get_username_string('full', $config['milestone_uid'], $config['milestone_uuser'], $config['milestone_ucolour']));
		break;
		case 'TOPICS_USERS':
			return sprintf($user->lang['MILESTONE_TU'], $config['milestone_topics'], get_username_string('full', $config['milestone_tid'], $config['milestone_tuser'], $config['milestone_tcolour']), $config['milestone_users'], get_username_string('full', $config['milestone_uid'], $config['milestone_uuser'], $config['milestone_ucolour']));
		break;
		default:
			return '';
	}
}

function milestone_history()
{
	global $config, $phpbb_root_path, $phpEx, $user;

	if (isset($config['milestone_setting']) && $config['milestone_history'])
	{
		return '(<a href="' . append_sid("{$phpbb_root_path}milestones.$phpEx") . '">' . $user->lang['MILESTONE_HISTORY'] . '</a>)';
	}
	return '';
}

?>