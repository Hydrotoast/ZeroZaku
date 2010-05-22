<?php
/**
*
* @author mtrs (mtrs) trst2007@gmail.com 
* @package umil
* @version $Id: install_cpf_permission.php,v 1.0.1 2009/07/15 12:53:34  Exp $
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
$user->setup('install');

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
	$umil->permission_add(array('u_cpf_allow_see', 'u_cpf_allow_use',));
	
	$umil->permission_set(array(
		array('ROLE_ADMIN_FULL', array('u_cpf_allow_see', 'u_cpf_allow_use')),
		array('ROLE_ADMIN_STANDARD', array('u_cpf_allow_see', 'u_cpf_allow_use')),
		array('ROLE_MOD_FULL', array('u_cpf_allow_see', 'u_cpf_allow_use')),
		array('ROLE_MOD_STANDARD', array('u_cpf_allow_see', 'u_cpf_allow_use')),
	));

	// Our final action, we purge the board cache
	$umil->cache_purge();
		
	// We are done
	$message = $user->lang['DONE'];
	trigger_error($message);
}
else
{
	$message = $user->lang['INSTALL_START'];
	
	confirm_box(false, $message);
}


?>