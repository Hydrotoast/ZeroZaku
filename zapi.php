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

$method = request_var('method', '');
$api_key = request_var('key', '');

// Set as request_var() when more formats are available
$type = request_var('format', 'json');

$user_id = request_var('user_id', 0);
$username = request_var('username', '');

if(!in_array($method, array('user', 'generate')))
{
    echo 'Invalid method: method does not exist';
}

function format_api_data($data)
{
    global $type;
    
    switch($type)
    {
        case 'json':
            header('Content-Type: application/json');
            echo json_encode($data);
        break;
    }
}

switch($method)
{
    case 'generate':
        echo substr(sha1(unique_id() + 'zanzibar'), 0, 12);
    break;
    case 'user':
        if(empty($api_key) || strlen($api_key) !== 12)
        {
            exit('Invalid API Key: empty or invalid length');
        }
        
		$sql = 'SELECT user_api_key
			FROM ' . USERS_TABLE . ' 
			WHERE user_api_key = \'' . $db->sql_escape(utf8_clean_string($api_key)) . '\'';
		$result = $db->sql_query($sql);
		if($result->num_rows < 1)
		{
		    exit('Invalid API Key');
		}
		$db->sql_freeresult($result);

		unset($sql);
		if(!empty($user_id))
		{
		    $sql = 'SELECT user_id, username, group_id, user_posts, user_rank, user_avatar, user_lastvisit
		    	FROM ' . USERS_TABLE . ' WHERE user_id = ' . (int) $user_id;
		    $result = $db->sql_query($sql);
		    $row = $db->sql_fetchrow($result);
		    $db->sql_freeresult($result);
		    
		    format_api_data($row);
		}
		elseif(!empty($username))
		{
		    $sql = 'SELECT user_id, username, group_id, user_posts, user_rank, user_avatar, user_lastvisit
		    	FROM ' . USERS_TABLE . '
		    	WHERE username = \'' . $db->sql_escape(utf8_clean_string($username)) . '\'';
		    $result = $db->sql_query($sql);
		    $row = $db->sql_fetchrow($result);
		    $db->sql_freeresult($result);
		    
		    format_api_data($row);
		}
		else
		{
		    echo 'User ID or username required';
		}
	break;
}

?>