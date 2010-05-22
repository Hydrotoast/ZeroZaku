<?php
##############################################################
# FILENAME  : ucp_factions_invite_members.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Invite Members
 * Called from ucp_factions with mode == 'invite_members'
 */
function ucp_factions_invite_members ( $id, $mode, $u_action )
{
	global	$db, $user, $template, $config;
	global	$phpbb_root_path, $phpEx;

	$group	= new group ( );

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		$member_id	= utf8_normalize_nfc ( request_var ( 'member_id', '' ) );

		// Invite user. Get the user's information.
		$sql		= "SELECT * FROM " . USERS_TABLE . " WHERE (username_clean = '" . utf8_clean_string ( $member_id ) . "' OR user_id = " . intval ( $member_id ) . ")";
		$result		= $db->sql_query ( $sql );
		$row		= $db->sql_fetchrow ( $result );
		$db->sql_freeresult ( $result );

		// Check to see if the user exists.
		if ( empty ( $row[ 'user_id' ] ) )
		{
			// This user apparently does not exist.
			trigger_error ( 'USER_NOT_FOUND' );
		}

		// Check if they are inviting themselves.
		if ( $row[ 'user_id' ] == $user->data[ 'user_id' ] )
		{
			// They are :/. Kill it.
			trigger_error ( 'CANT_INVITE_YOURSELF' );
		}

		// Send the PM.
		$yes_url	= append_sid ( "factions.$phpEx", "action=join_group&amp;group_id={$group->data[ 'group_id' ]}&amp;type=2&amp;type_2=1" );
		$no_url		= append_sid ( "factions.$phpEx", "action=join_group&amp;group_id={$group->data[ 'group_id' ]}&amp;type=2&amp;type_2=2" );

		$subject	= $user->lang[ 'PMINVITE' ];
		$message	= sprintf ( $user->lang[ 'PMINTVITETXT' ], $group->group_name ( $group->data[ 'group_name' ] ), $config[ 'server_protocol' ], $config[ 'server_name' ], $config[ 'script_path' ], $yes_url, $config[ 'server_protocol' ], $config[ 'server_name' ], $config[ 'script_path' ], $no_url );
		insert_pm ( $row[ 'user_id' ], $user->data, $subject, $message );

		// Completed. Let the user know.
		trigger_error ( 'USER_INVITED' );
	}
	else
	{
		// Assign the other variables to the template.
		$template->assign_vars ( array ( 'U_ACTION' => $u_action ) );
	}
}

?>
