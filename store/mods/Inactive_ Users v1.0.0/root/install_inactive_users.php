<?php
/**
*
* @author mtrs (mtrs) trst2007@gmail.com 
* @package umil
* @version $Id install_inactive_users.php 1.0.0 2009-06-20 23:29:18GMT mtrs $
* @copyright (c) 2009 mtrs 
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
$user->setup('mods/info_acp_inactive_users');

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


if (confirm_box(true))
{
	// Install the base 1.0.0 version
	if (!$umil->config_exists('inactive_users_version'))
	{
		$umil->config_add('inactive_users_version', '1.0.0', '0');
		
		$umil->config_add('inactive_users_enable', '1', '0');

		$umil->config_add('inactive_users_excl_view_ban', '1', '0');

		$umil->config_add('inactive_users_excl_view_time', '1', '0');

		$umil->config_add('inactive_users_excl_prof_ban', '1', '0');

		$umil->config_add('inactive_users_excl_prof_time', '1', '0');

		$umil->config_add('inactive_users_avatar_view_enable', '1', '0');

		$umil->config_add('inactive_users_avatar_prof_enable', '1', '0');

		$umil->config_add('inactive_users_no_avatar', '1', '0');

		$umil->config_add('inactive_users_period', '3', '0');
		
		$umil->config_add('inactive_users_exc_ids', '', '0');

	}
	//Addd user permission
	$umil->permission_add('u_view_customavatars');
	
	// Our final action, we purge the board cache
	$umil->cache_purge();
		
	// We are done
	$message = $user->lang['MOD_INSTALLED'];
	trigger_error($message);
}
else
{
	$message = $user->lang['INSTALL_INACTIVE_USERS'];
	
	confirm_box(false, $message);
}


?>