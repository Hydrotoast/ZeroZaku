<?php
/**
* @package Mutual Friend Requests
* @copyright (c) 2010 Gio Borje
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

function get_mutual_friends($user_id)
{
    global $template, $db, $user;
    
    if($user_id != $user->data['user_id'])
	{
		$sql = 'SELECT z1.*, z2.*, u.username, u.user_type, u.user_colour, u.user_avatar, u.user_avatar_type 
			FROM ' . USERS_TABLE . ' u
			JOIN ' . ZEBRA_TABLE . ' z1 ON z1.friend = 1 
				AND ((u.user_id = z1.user_id AND z1.zebra_id = ' . $user->data['user_id'] . ')
					OR (u.user_id = z1.zebra_id AND z1.user_id = ' . $user->data['user_id'] . '))
			JOIN ' . ZEBRA_TABLE . ' z2 ON z2.friend = 1 
				AND ((u.user_id = z2.user_id AND z2.zebra_id = ' . $user_id . ')
					OR (u.user_id = z2.zebra_id AND z2.user_id = ' . $user_id . '))
			ORDER BY u.username_clean ASC';
		$result = $db->sql_query($sql);
		
		$rows = 0;
		while($row = $db->sql_fetchrow($result))
		{
		    $zebra_id = ($row['zebra_id'] === $user_id) ? $row['user_id'] : $row['zebra_id'];
		    
		    $template->assign_block_vars('mutual_friend', array(
		     	'USER_ID'	    => $zebra_id,
		        'USERNAME'	    => get_username_string(($row['user_type'] <> USER_IGNORE) ? 'full' : 'no_profile', $zebra_id, $row['username'], $row['user_colour']),
		        'S_FIRST'		=> (($rows === 0) ? true : false)
		    ));
		    $rows++;
		}
		
		$template->assign_vars(array(
		    'MF'		  => true,
		    'MF_TOTAL'    => $result->num_rows
		));
		
		$db->sql_freeresult($result);
	}
}

function get_recommended_friends()
{
    global $template, $db, $user;
    
	// Get my friends
	$sql = 'SELECT u.user_id
		FROM ' . USERS_TABLE . ' u
		JOIN ' . ZEBRA_TABLE . ' z
			ON z.friend = 1
			AND ( z.user_id = ' . $user->data['user_id'] . ' AND u.user_id = z.zebra_id )
				OR ( z.zebra_id = ' . $user->data['user_id'] . ' AND u.user_id = z.user_id )
		ORDER BY RAND()';
	$result = $db->sql_query($sql);
	
	$friends = $friend_tuple = array();
	while($row = $db->sql_fetchrow($result))
	{
	    $friends[] = $row['user_id'];
	}
	$db->sql_freeresult($result);
	
	// Determine the strength of the relationship
	$num_tuples = 2;
	if(sizeof($friends) >= $num_tuples)
	{
		$friend_tuple = array_rand($friends, $num_tuples);
	}
	
	// Make sure we have friends to compare
	if(sizeof($friend_tuple))
	{
	    // Get friends of friends
		$sql = 'SELECT ';
		foreach($friend_tuple as $key => $friend)
		{
		    $sql .= 'z' . $key . '.zebra_id, z' . $key . '.user_id, ';
		}
		$sql .=	'u.username, user_type, u.user_colour FROM ' . USERS_TABLE . ' u ';
		foreach($friend_tuple as $key => $friend)
		{
			$sql .= 'JOIN ' . ZEBRA_TABLE . ' z' . $key . ' ON z' . $key . '.friend = 1 
				AND ((u.user_id = z' . $key . '.user_id AND z' . $key . '.zebra_id = ' . $friends[$friend] . ')
					OR (u.user_id = z' . $key . '.zebra_id AND z' . $key . '.user_id = ' . $friends[$friend] . ')) ';
		}
		$sql .=  ' ORDER BY RAND() LIMIT 0, 10';
	    $result = $db->sql_query($sql);
	    
	    // Set template variables
	    $rows = 0;
		while($row = $db->sql_fetchrow($result))
		{
		    $zebra_id = (in_array($row['zebra_id'], $friends)) ? $row['user_id'] : $row['zebra_id'];
		    
		    if($zebra_id !== $user->data['user_id'])
		    {
			    $template->assign_block_vars('rec_friend', array(
			        'USER_ID'		=> $zebra_id,
			        'USERNAME'	    => get_username_string(($row['user_type'] <> USER_IGNORE) ? 'full' : 'no_profile', $zebra_id, $row['username'], $row['user_colour']),
			        'ADD_URL'		=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=zebra&amp;mode=friends', true, $user->session_id),
			        'S_FIRST'		=> (($rows === 0) ? true : false)
			    ));  
			    ++$rows;
		    }
		}
		
		$template->assign_vars(array(
		    'REC_FRIEND_TOTAL' => $rows,
		));
		
		$db->sql_freeresult($result);
	}
}

?>