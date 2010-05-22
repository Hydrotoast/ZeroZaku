<?php
/** 
*
* @package phpBB3
* @version $Id: uninstall.php,v 1.6.5 2008/03/10 16:40:54 rxu Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('acp/common', 'mods/quick_reply'));

// Did user forget to login? Give 'em a chance to here ...
if ($user->data['user_id'] == ANONYMOUS)
{
	login_box('', $user->lang['LOGIN_ADMIN'], $user->lang['LOGIN_ADMIN_SUCCESS'], false);
}

// Is user any type of admin? No, then stop here, each script needs to
// check specific permissions but this is a catchall
if (!$auth->acl_get('a_'))
{
	trigger_error('NO_ADMIN');
}

$quick_reply_installed = (isset($config['allow_quick_reply'])) ? true : false;

if (!$quick_reply_installed)
{
	trigger_error('NOT_INSTALLED');
}

$users = $keyoptions = array();
$keyoptions = $user->keyoptions;

$sql = 'SELECT user_id, user_options FROM ' . USERS_TABLE . ' WHERE user_type IN (' . USER_NORMAL . ', ' . USER_FOUNDER . ')';
$result = $db->sql_query($sql);

// Get options values for each user
while ($row = $db->sql_fetchrow($result))
{
	$users[$row['user_id']] = $row['user_options'];
}
$db->sql_freeresult($result);

// Switch quick reply on (set true) or off (set false)
$set_allowquickreply = false;

foreach ($users as $value)
{			

		if ($set_allowquickreply && !($value & 1 << $keyoptions['viewquickreply']))
		{
			$value += 1 << $keyoptions['viewquickreply'];
		}
		else if (!$set_allowquickreply && ($value & 1 << $keyoptions['viewquickreply']))
		{
			$value -= 1 << $keyoptions['viewquickreply'];
		}
		
$sql = 'UPDATE ' . USERS_TABLE . " SET user_options = $value WHERE user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ')';
$db->sql_query($sql);
	
}

$uninstall_sql = array();

//$uninstall_sql[] = 'ALTER TABLE ' . USERS_TABLE . ' ALTER user_options SET DEFAULT 895';
$uninstall_sql[] = 'DELETE FROM ' . CONFIG_TABLE . ' WHERE config_name = \'allow_quick_reply\'';
$uninstall_sql[] = 'DELETE FROM ' . CONFIG_TABLE . ' WHERE config_name = \'allow_quick_reply_options\'';
$uninstall_sql[] = 'DELETE FROM ' . CONFIG_TABLE . ' WHERE config_name = \'allow_quick_post\'';
$uninstall_sql[] = 'DELETE FROM ' . CONFIG_TABLE . ' WHERE config_name = \'allow_quick_post_options\'';
//$uninstall_sql[] = 'DELETE FROM ' . MODULES_TABLE . ' WHERE module_basename = \'quick_reply\'';

foreach ($uninstall_sql as $query)
{
	$db->sql_query($query);
}

// Delete module
include($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);
$sql_module = 'SELECT module_id FROM ' . MODULES_TABLE . ' WHERE module_basename = \'quick_reply\'';
$result = $db->sql_query($sql_module);
if ($result)
{
	$module_id = $db->sql_fetchfield('module_id');
}
$db->sql_freeresult($result);

if ($module_id)
{
	$module = &new acp_modules();
	$module->module_class = 'acp';
	$module->delete_module($module_id);
}


$cache->purge();
add_log('admin', 'LOG_PURGE_CACHE');

trigger_error('UNINSTALLED');

?>