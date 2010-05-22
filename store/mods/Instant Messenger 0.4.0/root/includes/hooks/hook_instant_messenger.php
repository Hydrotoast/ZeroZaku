<?php 
/**
*
* @package phpBB3 instant messenger
* @version $Id$
* @copyright (c) 2010 Kamahl & Culprit
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

function im_extend_user_data()
{
	global $user, $db;
	
	if ( $user->data['user_id'] == ANONYMOUS)
	{
		$user->data['user_deny_im'] = 1;
		$user->data['user_status'] = '';
	}
	else
	{
		$sql = "SELECT user_deny_im, user_status FROM " . USERS_IM_TABLE . " WHERE user_id = " . $user->data['user_id'];
		$result = $db->sql_query( $sql);
		$row = $db->sql_fetchrow( $result);
		$user->data['user_deny_im'] = isset( $row['user_deny_im']) ? $row['user_deny_im'] : 0;
		$user->data['user_status'] = isset( $row['user_status']) && $row['user_status'] != '' ? $row['user_status'] : '&nbsp;';
		$db->sql_freeresult( $result);
		unset( $sql);
		unset( $row);
		unset( $result);
	}

	return true;
}

$phpbb_hook->register( 'phpbb_user_session_handler', 'im_extend_user_data');

?>