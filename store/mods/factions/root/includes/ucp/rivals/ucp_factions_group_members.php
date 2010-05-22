<?php
##############################################################
# FILENAME  : ucp_factions_group_members.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

define ( 'DELETE_MEMBER', 1 );
define ( 'ASSIGN_MEMBER', 2 );

/**
 * Manage Members
 * Called from ucp_factions with mode == 'group_members'
 */
function ucp_factions_group_members ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpEx;

	$group	= new group ( );

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		$member_id	= request_var ( 'member_id', array ( 0 => 0 ) );
		$members	= request_var ( 'members', array ( 0 => 0 ) );

		foreach ( $member_id AS $key => $value )
		{
			if ( $members[ $key ] == DELETE_MEMBER )
			{
				// Remove the member.
				$group->members ( 'remove', $group->data[ 'group_id' ], $value );

				// Completed. Let the user know.
				trigger_error ( 'MEMBER_REMOVED' );
			}
			/*else if ( $members[ $key ] == ASSIGN_MEMBER )
			{
				// Promotes a member to a leader.
				$group->members ( 'promote', $group->data[ 'group_id' ], $value );

				// Completed. Let the user know.
				trigger_error ( 'MEMBER_ASSIGNED_AS_LEADER' );
			}
			else
			{
				continue;
			}*/
		}
	}
	else
	{
		// Get members of the group.
		$members	= (array) $group->members ( 'get_members', $group->data[ 'group_id' ] );
		$i			= 0;
		foreach ( $members AS $value )
		{
			// Get the member's data.
			$sql		= "SELECT * FROM " . USERS_TABLE . " WHERE user_id = " . $value;
			$result		= $db->sql_query ( $sql );
			$row		= $db->sql_fetchrow ( $result );
			$db->sql_freeresult ( $result );

			// Assign each member to the template.
			$template->assign_block_vars ( 'block_members', array (
				'U_PROFILE' => append_sid ( "{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $row[ 'user_id' ] ),
				'MEMBER_ID' => $row[ 'user_id' ],
				'MEMBER_NAME' => $row[ 'username' ],
				'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
				'ROW_OLOR' => ( $i % 2 ) ? 'row1' : 'row2' )
			);

			$i++;
		}

		$db->sql_freeresult ( $result );

		// Assign the other variables to the template.
		$template->assign_vars ( array (
			'U_ACTION' => $u_action,
			'U_INVITE_MEMBERS' => append_sid ( "{$phpbb_root_path}ucp.$phpEx", 'i=factions&amp;mode=invite_members' ),
			'U_PENDING_MEMBERS' => append_sid ( "{$phpbb_root_path}ucp.$phpEx", 'i=factions&amp;mode=pending_members' ) ) );
	}
}

?>
