<?php
/** 
*
* @package phpBB3
* @version $Id: install.php,v 1.6.7 2008/03/10 16:23: rxu Exp $
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
$user->setup(array('acp/common', 'acp/modules', 'mods/quick_reply'));

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

$users = $keyoptions = array();

// Check if Quick reply mod already installed
$keyoptions = $user->keyoptions;
$quick_reply_installed = (isset($keyoptions['viewquickreply'])) ? true : false;

if (!$quick_reply_installed)
{
	trigger_error('NO_FILES_MODIFIED');
}


$cache->purge();
add_log('admin', 'LOG_PURGE_CACHE');

$sql = 'SELECT user_id, user_options FROM ' . USERS_TABLE . ' WHERE user_type IN (' . USER_NORMAL . ', ' . USER_FOUNDER . ')';
$result = $db->sql_query($sql);

// Get options values for each user
while ($row = $db->sql_fetchrow($result))
{
	$users[$row['user_id']] = $row['user_options'];
}
$db->sql_freeresult($result);

// Switch quick reply on (set true) or off (set false)
$set_allowquickreply = true;
$set_allowquickpost = false;

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

	if ($set_allowquickpost && !($value & 1 << $keyoptions['viewquickpost']))
	{
		$value += 1 << $keyoptions['viewquickpost'];
	}
	else if (!$set_allowquickpost && ($value & 1 << $keyoptions['viewquickpost']))
	{
		$value -= 1 << $keyoptions['viewquickpost'];
	}
	
	$sql = 'UPDATE ' . USERS_TABLE . " SET user_options = $value WHERE user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ')';
	$db->sql_query($sql);
	
}

$user_options_default = 895;
if ($set_allowquickreply && !($user_options_default & 1 << $keyoptions['viewquickreply']))
{
	$user_options_default += 1 << $keyoptions['viewquickreply'];
}
else if (!$set_allowquickreply && ($user_options_default & 1 << $keyoptions['viewquickreply']))
{
	$user_options_default -= 1 << $keyoptions['viewquickreply'];
}

if ($set_allowquickpost && !($user_options_default & 1 << $keyoptions['viewquickpost']))
{
	$user_options_default += 1 << $keyoptions['viewquickpost'];
}
else if (!$set_allowquickpost && ($user_options_default & 1 << $keyoptions['viewquickpost']))
{
	$user_options_default -= 1 << $keyoptions['viewquickreply'];
}

set_config('allow_quick_reply', '1');
set_config('allow_quick_reply_options', '0');
set_config('allow_quick_post', '0');
set_config('allow_quick_post_options', '0');

// Do we need to set this default value? Just leave it alone for now :)
/*
$install_sql = array();
// Set default quick reply switched on for all new users
$install_sql[] = 'ALTER TABLE ' . USERS_TABLE . " ALTER user_options SET DEFAULT $user_options_default";
foreach($install_sql as $query)
{
	$db->sql_query($query);
}
*/

// Install quick reply ACP module
$result = array();
$result = module_install('quick_reply', 'acp');

$switch_key = ($set_allowquickreply) ? 'on' : 'off';

if ($result['error'])
{
	trigger_error($result['error']);
}
else if ($result['result'])
{
	trigger_error($result['result']);
}

trigger_error('INSTALLED');



function module_install($module_name = '', $module_class = '')
{
	global $cache, $db, $phpbb_root_path, $phpEx, $user;

	if (empty($module_name) || empty($module_class))
	{
		return array('error' => $user->lang['NO_MODULE']);
	}
	
	if (!file_exists($phpbb_root_path . 'includes/acp/info/acp_' . $module_name . '.' . $phpEx))
	{
		return array('error' => $user->lang['NO_MODULE']);
	}
	
	require($phpbb_root_path . 'includes/functions_admin.' . $phpEx);
	require($phpbb_root_path . 'includes/functions_module.' . $phpEx);
	include($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);

	$module = &new acp_modules();
	$module_info = $module_data = array();

	$module->module_class = $module_class;
	$parent_id = 0;
	$result = $error = '';

	$module_info = $module->get_module_infos($module_name, $module_class);

	if (sizeof($module_info))
	{
		
		foreach ($module_info as $module_basename => $fileinfo)
		{
			foreach ($fileinfo['modes'] as $module_mode => $row)
			{
				foreach ($row['cat'] as $cat_name)
				{
					$sql = 'SELECT module_id FROM ' . MODULES_TABLE . " WHERE module_langname = '$cat_name'";
					$result = $db->sql_query($sql);
					$parent_id = $db->sql_fetchfield('module_id');
					$db->sql_freeresult($result);
					if (!$parent_id)
					{
						continue;
					}

					$sql_module = 'SELECT module_id FROM ' . MODULES_TABLE . " WHERE module_basename = '$module_basename'";
					$result = $db->sql_query($sql_module);
					if ($module_id = $db->sql_fetchfield('module_id'))
					{
						$module_data['module_id'] = $module_id;
					}
					$db->sql_freeresult($result);

					$module_data = array_merge($module_data, array(
						'module_basename'	=> $module_basename,
						'module_enabled'	=> 1,
						'module_display'	=> (isset($row['display'])) ? (int) $row['display'] : 1,
						'parent_id'			=> $parent_id,
						'module_class'		=> $module_class,
						'module_langname'	=> $row['title'],
						'module_mode'		=> $module_mode,
						'module_auth'		=> $row['auth'],
					));

					$module->update_module_data($module_data, true);

					// Check for last sql error happened
					if ($db->sql_error_triggered)
					{
						$error = $db->sql_error($db->sql_error_sql);
						trigger_error($error['message'], $db->sql_error_sql, __LINE__, __FILE__);
					}
				}
			}
		}
		$cache->purge();
		$result = $user->lang['MODULE_ADDED'];
	}
	else
	{
		$error = $user->lang['NO_MODULE'];
	}
	
	return array(
			'error'			=> $error,
			'result'		=> $result,
			'module_name'	=> $module_name
			);
}

?>