<?php
/**
*
* @author Mav (Jamie Hall) mail@packetecho.com
* @package umil
* @copyright (c) 2010 Mav
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// We only allow a founder to install this MOD
if ($user->data['user_type'] != USER_FOUNDER)
{
	if ($user->data['user_id'] == ANONYMOUS)
	{
		login_box('', 'LOGIN');
	}
	trigger_error('NOT_AUTHORISED');
}

if (!class_exists('umil'))
{
	include($phpbb_root_path . 'umil/umil.' . $phpEx);
}

$umil = new umil(true);

$mod = array(
	'name'		=> 'Community Moderation',
	'version'	=> '0.0.3',
	'config'	=> 'community_moderation_version',
	'enable'	=> 'community_moderation_enable',
);

if (confirm_box(true))
{
	// Install the base 0.0.1 version
	if (!$umil->config_exists($mod['config']))
	{
		$umil->permission_add(array(
			array('f_post_vote', 0),
			array('u_com_threshold', 1),
			array('u_com_style', 1),
			array('a_com_mod', 1),
		));

		$umil->permission_set(array(
			array('ROLE_FORUM_FULL', 'f_post_vote'),
			array('ROLE_FORUM_STANDARD', 'f_post_vote'),
			array('ROLE_FORUM_POLLS', 'f_post_vote'),
			array('ROLE_USER_FULL', 'u_com_threshold'),
			array('ROLE_USER_FULL', 'u_com_style'),
			array('ROLE_USER_STANDARD', 'u_com_threshold'),
			array('ROLE_USER_STANDARD', 'u_com_style'),
			array('ROLE_ADMIN_STANDARD', 'a_com_mod'),
			array('ROLE_ADMIN_FULL', 'a_com_mod'),
		));

		// We must handle the version number ourselves.
		$umil->config_add($mod['config'], $mod['version']);

		$umil->config_add('enable_community_moderation', '1', '0');

		$umil->config_add('posts_bury_threshold', '-3', '0');

		$umil->config_add('enable_community_moderation_ups', '0', '0');
		$umil->config_add('community_moderation_ups_up', '1', '0');
		$umil->config_add('community_moderation_ups_down', '0', '0');

		$umil->module_add(array(
			array('acp', 'ACP_CAT_DOT_MODS', 'ACP_CAT_COM_MOD'),

			array('acp', 'ACP_CAT_COM_MOD', array(
					'module_basename'	=> 'community_moderation',
					'modes'				=> array('configuration'),
					'module_auth'		=> 'a_com_mod',
				),
			),
		));

		// Our final action, we purge the board cache
		$umil->cache_purge();
	}

	// We are done
	trigger_error('Done!');
}
else
{
	confirm_box(false, 'Install Community Moderation');
}

// Shouldn't get here.
redirect($phpbb_root_path . $user->page['page_name']);

?>