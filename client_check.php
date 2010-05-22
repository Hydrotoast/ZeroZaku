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
$format = request_var('format', (string)'');
$client_id = request_var('client_id', 0);
$password = request_var('password', (string)'');

// For ZeroZaku clients
$client_type = request_var('client_type', 0);
$log = request_var('log', 'false');

if(!in_array($mode, array('', 'client', 'groups', 'posts', 'password')))
{
	trigger_error('NO_MODE');
}

if ($user->data['user_id'] == ANONYMOUS)
{
	login_box($phpbb_root_path . 'client_check.' . $phpEx, $user->lang['LOGIN_VIEWPAGE']);
}
else
{
	if($log == 'true')
	{	
		add_log('mod', 0, 0, 'LOG_USING_ZZ_CLIENT',  $user->data['username']);
	}
	
	switch($mode)
	{
		case 'password':
			if($client_id === 0)
			{
				die('Invalid Client ID');
			}
			else
			{
				$sql = 'SELECT client_pass FROM '. CLIENTS_TABLE . ' WHERE client_id=' . $client_id;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				
				if(phpbb_check_hash($password,$row['client_pass']))
				{
					echo 'true';
					
					// Increment the number of uses
					$sql = 'UPDATE ' . CLIENTS_TABLE . ' SET client_uses=client_uses + 1 WHERE client_id=' . $client_id;
					$db->sql_query($sql);
				}
				else
				{
					echo 'false';
				}
				$db->sql_freeresult($result);
			}
			break;
		case 'groups':
			// Create global group template variables
			if(!function_exists('group_memberships') )
			{
			    include($phpbb_root_path . 'includes/functions_user.'.$phpEx);
			}
			$groups = group_memberships(false,$user->data['user_id']);
			foreach ($groups as $grouprec)
			{
			    $groups_ary[] = $grouprec['group_id'];
			}
			
			// Return the data with the requested format
			echo format_client_data($groups_ary, $format);
			
			break;
		case 'posts':
			$sql = 'SELECT user_posts, user_warnings, user_rank FROM ' . USERS_TABLE . ' WHERE user_id = ' . $user->data['user_id'];
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			
			// Create the user array with all user data to be output
			$user_ary = array(
				'posts' 	=> $row['user_posts'],
				'warnings' 	=> $row['user_warnings']);
			
			$db->sql_freeresult($result);
			
			// Return the data with the requested format, but support legacy versions
			echo (empty($format)) ? $user_ary['posts'] : format_client_data($user_ary, $format);
		
			break;
		default:
			if($client_type != 0)
			{
				// Check if user has permission to use the specified client type
				switch($client_type)
				{
					case 1:
						$result = $auth->acl_get('u_standard_client');
						echo  ($result != false) ? 'true' : 'false';
						break;
					case 2:
						$result = $auth->acl_get('u_premium_client');
						echo  ($result != false) ? 'true' : 'false';
						break;
					case 3:
						$result = $auth->acl_get('u_beta_client');
						echo  ($result != false) ? 'true' : 'false';
						break;
					default:
						die('Invalid Client Type');
						break;	
				}
			}
			else
			{
				// Throw an error for an invalid client type
				die('Invalid Client Type');
			}
			break;
	}
}

/**
 * Displays the data according the specified format
 *
 * @param array $data
 * @param string $format - format for the return value
 */
function format_client_data($data, $format)
{
	switch($format)
	{
		case 'json':
			return json_encode($data);
			break;
		case 'xml':
			return to_xml($data, 'data', null);
			break;
		default:
			return var_dump($data);
			break;
	} 
}

/**
 * The main function for converting to an XML document.
 * Pass in a multi dimensional array and this recrusively loops through and builds up an XML document.
 *
 * @param array $data
 * @param string $rootNodeName - what you want the root node to be - defaultsto data.
 * @param SimpleXMLElement $xml - should only be used recursively
 * @return string XML
 */
function to_xml($data, $rootNodeName = 'data', $xml=null)
{
	if ($xml == null)
	{
		$xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$rootNodeName />");
	}
	
	// loop through the data passed in.
	foreach($data as $key => $value)
	{
		// no numeric keys in our xml please!
		if (is_numeric($key))
		{
			// make string key...
			$key = "group_". (string) $key;
		}
		
		// replace anything not alpha numeric
		$key = preg_replace('/[^a-z]/i', '', $key);
		
		// if there is another array found recrusively call this function
		if (is_array($value))
		{
			$node = $xml->addChild($key);
			// recrusive call.
			toXml($value, $rootNodeName, $node);
		}
		else 
		{
			// add single node.
            $value = htmlentities($value);
			$xml->addChild($key,$value);
		}
		
	}
	
	return $xml->asXML();
}
?>