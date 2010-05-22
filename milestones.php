<?php

/**
*
* @package - "Milestone Congratulations"
* @version $Id: milestones.php 6 2008-09-21 MartectX $
* @copyright (C)2008, MartectX ( http://mods.martectx.de/ )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/milestone_congratulations');

// not yet installed & admin => Error
if (!isset($config['milestone_version']) && $auth->acl_get('a_'))
{
	trigger_error('MILESTONE_ERROR');
}

// not yet installed & regular user OR history disabled & regular user => redirect to index
if (!isset($config['milestone_version']) || (!$auth->acl_get('a_') && !$config['milestone_history']))
{
	redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
}

switch ($config['milestone_setting'])
{
	case 'POSTS_TOPICS_USERS':
		$typeshow = '';
	break;
	case 'POSTS':
		$typeshow = ' AND m.type = 1';
	break;
	case 'TOPICS':
		$typeshow = ' AND m.type = 2';
	break;
	case 'USERS':
		$typeshow = ' AND m.type = 3';
	break;
	case 'POSTS_TOPICS':
		$typeshow = ' AND ( m.type = 1 OR m.type = 2 )';
	break;
	case 'POSTS_USERS':
		$typeshow = ' AND ( m.type = 1 OR m.type = 3 )';
	break;
	case 'TOPICS_USERS':
		$typeshow = ' AND ( m.type = 2 OR m.type = 3 )';
	break;
	default:
		$typeshow = '';
}

$view = request_var('view', '');

if ($auth->acl_get('a_') && $view == 'all')
{
	$typeshow = '';
}

$sql_ary = array(
	'SELECT'	=> 'u.user_id, u.username, u.user_colour, m.user_id, m.milestone, m.type',
	'FROM'		=> array(
		USERS_TABLE			=> 'u',
		MILESTONES_TABLE	=> 'm',
	),
	'WHERE'		=> 'u.user_id = m.user_id' . $typeshow,
	'ORDER_BY'	=> 'm.type ASC, m.milestone ASC',
);
$result = $db->sql_query($db->sql_build_query('SELECT', $sql_ary));

// set variable for 'newtype' comparison
$type = '';

while ($row = $db->sql_fetchrow($result))
{
	$newtype = ($type != $row['type']) ? $row['type'] : '';

	$type = $row['type'];

	switch ($type)
	{
		case 1:
			$typetitle = $user->lang['POSTS'];
		break;
		case 2:
			$typetitle = $user->lang['TOPICS'];
		break;
		case 3:
			$typetitle = $user->lang['USERS'] . '#';
		break;
	}

	$template->assign_block_vars('milestone', array(
		'NUMBER'	=> $row['milestone'],
		'USER'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
		'NEWTYPE'	=> $newtype,
		'TYPE'		=> $typetitle
	));
}
$db->sql_freeresult($result);

page_header($user->lang['MILESTONE_HISTORY']);

$template->set_filenames(array(
    'body' => 'milestones.html',
));

page_footer();

?>