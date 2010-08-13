<?php
/**
*
* @package phpBB3
* @copyright (c) 2010 ZeroZaku
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

$mode = request_var('mode', 'user');
$format = request_var('format', (string)'');
$client_id = request_var('client_id', 0);
$password = request_var('password', (string)'');

// For ZeroZaku clients
$client_type = request_var('client_type', 0);
$log = request_var('log', 'false');

if(!in_array($action, array('get_user', 'authorize_client')))
{
	trigger_error('NO_MODE');
}

$api = new auth_api();
$api->$action();
echo format_data($api->get_output(), $format);

class auth_api 
{
    protected $output = '';
    protected $sql = '';
    
    function get_user()
    {
        global $db;
        
        $user_id = request_var('user_id', 0);
        
        $sql = 'SELECT username, user_posts, user_warnings, group_id, user_reputation, user_reputation_power 
        	FROM ' . USERS_TABLE . ' 
        	WHERE user_id = ' . (($user_id === 0) ? $user->data['user_id'] : $user_id);
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		
		// Create the user array with all user data to be output
		$user_ary = array(
		    'username'	        => $row['username'],
			'posts' 	        => $row['user_posts'],
			'warnings' 	        => $row['user_warnings'],
			'group_id'	        => $row['group_id'],
		    'reputation'	    => $row['user_reputation'],
		    'reputation_power'	=> $row['reputation_power']
		);
		
		$db->sql_freeresult($result);
		$this->output = $user_ary;
    }
    
    function authorize_client()
    {
        global $db;
        
        $client_id = request_var('client_id', 0);
        $password = request_var('password', '');
        
        $sql = 'SELECT client_pass FROM '. CLIENTS_TABLE . ' 
        	WHERE client_id=' . $client_id;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$client_pass = $row['client_pass'];
		$db->sql_freeresult($result);
		
		if(phpbb_check_hash($password, $client_pass))
		{	
			// Increment the number of uses
			$sql = 'UPDATE ' . CLIENTS_TABLE . ' 
				SET client_uses = client_uses + 1 
				WHERE client_id = ' . $client_id;
			$db->sql_query($sql);
		    	
			$this->output = 'true';
		}
		else
		{
			$this->output = 'false';
		}
    }

    function get_output()
    {
        return $this->output;
    }
}

/**
 * Displays the data according the specified format
 *
 * @param array $data
 * @param string $format - format for the return value
 */
function format_data($data, $format)
{
	switch($format)
	{
		case 'json':
			return json_encode($data);
			break;
		default:
			return to_xml($data, 'data', null);
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