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
		$row = array(
			'user_deny_im' => 1,
			'user_status' => '',
			'user_sound_im' => '0',
		);
	}
	else
	{
		$sql = "SELECT user_deny_im, user_status, user_sound_im FROM " . USERS_IM_TABLE . " WHERE user_id = " . $user->data['user_id'];
		$result = $db->sql_query( $sql);
		$row = $db->sql_fetchrow( $result);
		if ( !isset( $row['user_deny_im']))
		{
			$sql = "INSERT INTO " . USERS_IM_TABLE . "
				( user_id, user_deny_im, user_status, user_sound_im) VALUES
				( '{$user->data['user_id']}', 0, null, 1)";
			$db->sql_query( $sql);
			
			$row = array( 
				'user_deny_im' => 0,
				'user_status' => '',
				'user_sound_im' => '1',
			);
		}
		$db->sql_freeresult( $result);
	}

	$user->data = array_merge( $user->data, $row);
	
	return true;
}

$phpbb_hook->register( 'phpbb_user_session_handler', 'im_extend_user_data');

?>