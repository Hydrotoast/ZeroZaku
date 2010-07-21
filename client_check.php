<?php
/**
*
* @package phpBB3
* @version $Id: index.php 9614 2009-06-18 11:04:54Z nickvergessen $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
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

$mode = request_var('mode', (string)'');
$client_type = request_var('client_type', 0);
$log = request_var('log', 'false');

if(!in_array($mode, array('', 'client', 'groups', 'posts')))
{
	trigger_error('NO_MODE');
}

if ($user->data['user_id'] != ANONYMOUS)
{
	if($log == 'true')
	{	
		add_log('mod', 0, 0, 'LOG_USING_ZZ_CLIENT',  $user->data['username']);
	}
	
	switch($mode)
	{
		case 'groups':
			// create global group template variables
			if(!function_exists('group_memberships') )
			{
			    include($phpbb_root_path . 'includes/functions_user.'.$phpEx);
			}
			$groups = group_memberships(false,$user->data['user_id']);
			foreach ($groups as $grouprec)
			{
			    echo $grouprec['group_id'] . ",";
			}
			break;
		case 'posts':
			$sql = 'SELECT user_posts FROM ' . USERS_TABLE . ' WHERE user_id = ' . (int)$user->data['user_id'];
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			echo $row['user_posts'];
			
			break;
		default:
			if($client_type != 0)
			{
				switch($client_type)
				{
					case 1:
						$result = $auth->acl_get('u_standard_client');
						if($result != false)
						{
							echo 'true';
						}
						else
						{
							echo 'false';
						}
						break;
					case 2:
						$result = $auth->acl_get('u_premium_client');
						if($result != false)
						{
							echo 'true';
						}
						else
						{
							echo 'false';
						}
						break;
					case 3:
						$result = $auth->acl_get('u_beta_client');
						if($result != false)
						{
							echo 'true';
						}
						else
						{
							echo 'false';
						}
						break;
					default:
						die('Invalid Client Type');
						break;	
				}
			}
			else
			{
				die('Invalid Client Type');
			}
			break;
	}
}
else
{
	echo 'guest';
}

?>