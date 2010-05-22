<?php
##############################################################
# FILENAME  : join_group.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

define ( 'USERS_REQUEST', 1 );
define ( 'PM_REQUEST', 2 );

$group		= new group ( );
$type		= request_var ( 'type', 0 );
$group_id	= request_var ( 'group_id', 0 );
$group_data	= $group->data ( '*', $group_id );

// Check if there is a request to join.
if ( $type == USERS_REQUEST )
{
	// This happens when a user requests to join from the group's profile.
	// Is the user in the group already?
	$members	= (array) $group->members ( 'get_members', $group_id );

	if ( in_array ( $user->data[ 'user_id' ], $members ) )
	{
		// They are :/. Kill it.
		trigger_error ( 'YOUR_APART_OF_GROUP' );
	}
	else
	{
		// Add the user to the pending members of the group.
		$group->members ( 'add', $group_id, $user->data[ 'user_id' ], 0, 1 );

		// Send a PM to the group leader.
		$subject	= $user->lang[ 'PMPENDINGMEMBER' ];
		$message	= sprintf ( $user->lang[ 'PMPENDINGMEMBERTXT' ], $user->data[ 'user_name' ], $group->group_name ( $group->data ( 'group_name', $group_id ) ) );
		insert_pm ( $group->data ( 'user_id', $group_id ), $user->data, $subject, $message );

		// Completed. Let the user know.
		trigger_error ( 'REQUEST_SENT' );
	}
}
else if ( $type == PM_REQUEST )
{
	// This is linked from the PM when a group leader sends a invite.
	$type_2	= request_var ( 'type_2', 0 );
	if ( $type_2 == 1 )
	{
		// User wants to join the group.
		// Is the user in the group already?
		$members	= (array) $group->members ( 'get_all', $group_id );

		if ( in_array ( $user->data[ 'user_id' ], $members ) )
		{
			// They are :/. Kill it.
			trigger_error ( 'YOUR_APART_OF_GROUP' );
		}
		else
		{
			// Add the user to the members of the group.
			$group->members ( 'add', $group_id, $user->data[ 'user_id' ] );
	
			// Completed. Let the user know.
			trigger_error ( 'JOINED_GROUP' );
		}
	}
	else
	{
		// User does not want to join the group.
		$group->members ( 'remove', $group_id, $user->data[ 'user_id' ] );

		// Completed. Let the user know.
		trigger_error ( 'REQUEST_DECLINED' );
	}
}

?>
