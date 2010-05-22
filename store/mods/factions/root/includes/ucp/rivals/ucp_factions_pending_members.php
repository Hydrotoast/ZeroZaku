<?php
##############################################################
# FILENAME  : ucp_factions_pending_members.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

define ( 'ADD_PENDING', 1 );
define ( 'DELETE_PENDING', 2 );

/**
 * Manage Pending Members
 * Called from ucp_factions with mode == 'pending_members'
 */
function ucp_factions_pending_members ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpEx;

	$group	= new group ( );

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		$member_id			= request_var ( 'member_id', array ( 0 => 0 ) );
		$pending_members	= request_var ( 'pending_members', array ( 0 => 0 ) );
		foreach ( $member_id AS $key => $value )
		{
			if ( $pending_members[ $key ] == ADD_PENDING )
			{
				// Add the user to the group.
				$group->members ( 'approve', $group->data[ 'group_id' ] , $value );

				// Send a PM to the member telling them they have been approved.
				$subject	= $user->lang[ 'PMREQUEST_APPROVED' ];
				$message	= sprintf ( $user->lang[ 'PMREQUEST_APPROVEDTXT' ], $group->group_name ( $group->data[ 'group_name' ] ) );
				insert_pm ( $value, $user->data, $subject, $message );

				// Completed. Let the user know.
				trigger_error ( 'USER_ADDED_TO_GROUP' );
			}
			else if ( $pending_members[ $key ] == DELETE_PENDING )
			{
				// Remove the pending member.
				$group->members ( 'remove', $group->data[ 'group_id' ] , $value );

				// Send a PM to the member telling them they have been declined.
				$subject	= $user->lang[ 'PMREQUEST_DECLINED' ];
				$message	= sprintf ( $user->lang[ 'PMREQUEST_DECLINEDTXT' ], $group->group_name ( $group->data[ 'group_name' ] ) );
				insert_pm ( $value, $user->data, $subject, $message );

				// Completed. Let the user know.
				trigger_error ( 'USER_REMOVED_FROM_PENDING' );
			}
			else
			{
				continue;
			}
		}
	}
	else
	{
		// Get pending members.
		$members	= (array) $group->members ( 'get_pending', $group->data[ 'group_id' ] );
		$i			= 0;
		foreach ( $members AS $value )
		{
			// Get the member's data.
			$sql		= "SELECT * FROM " . USERS_TABLE . " WHERE user_id = " . $value;
			$result		= $db->sql_query ( $sql );
			$row		= $db->sql_fetchrow ( $result );
			$db->sql_freeresult ( $result );

			// Assign each member to the template.
			$template->assign_block_vars ( 'block_pendingmembers', array (
				'U_PROFILE' => append_sid ( "{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $row[ 'user_id' ] ),
				'MEMBER_ID' => $row[ 'user_id' ],
				'MEMBER_NAME' => $row[ 'username' ],
				'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
				'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2'  )
			);

			$i++;
		}

		$db->sql_freeresult ( $result );

		// Assign the other variables to the template.
		$template->assign_vars ( array ( 'U_ACTION' => $u_action ) );
	}
}

?>
