<?php
##############################################################
# FILENAME  : ladder_membership.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

$group		= new group ( );
$ladder		= new ladder ( );
$type		= request_var ( 'type', 0 );
$ladder_id	= request_var ( 'ladder_id', 0 );

if ( $type == 1 )
{
	// The group is wishing to join the ladder. Do some checking!
	$sql	= "SELECT * FROM " . GROUPDATA_TABLE . " WHERE group_ladder = $ladder_id AND group_id = " . $group->data[ 'group_id' ];
	$result	= $db->sql_query ( $sql );
	$row	= $db->sql_fetchrow ( $result );

	if ( !empty ( $row[ 'group_id' ] ) )
	{
		// They are already joined with the ladder. Let the user know.
		trigger_error ( 'ALREADY_IN_LADDER' );
	}

	// Check if there are required members needed.
	if ( $ladder->data[ 'ladder_rm' ] != 0 )
	{
		// Get the members joined to this group.
		$members	= $group->members ( 'get_members', $group->data[ 'group_id' ] );

		if ( sizeof ( $members ) <= $ladder->data[ 'ladder_rm' ] )
		{
			// They do not have enough members. Let the user know.
			trigger_error ( sprintf ( $user->lang[ 'REQUIRED_MEMBERS_FAILED' ], $ladder->data[ 'ladder_rm' ] ) );
		}
	}

	// Everything seems OK. Join them to the ladder.
	$sql		= "SELECT MAX(group_current_rank) AS current_rank FROM " . GROUPDATA_TABLE . " WHERE group_ladder = " . $ladder_id;
	$result		= $db->sql_query ( $sql );
	$row		= $db->sql_fetchrow ( $result );
	$db->sql_freeresult ( $result );
	$new_rank	= $row[ 'current_rank' ] + 1;

	$sql_array	= array (
		'group_id' => $group->data[ 'group_id' ],
		'group_ladder' => $ladder_id,
		'group_score' => 1200,
		'group_current_rank' => $new_rank,
		'group_streak' => 0,
		'group_best_rank' => $new_rank,
		'group_worst_rank' => $new_rank,
		'group_last_rank' => 0
	);
	$sql		= "INSERT INTO " . GROUPDATA_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
	$db->sql_query ( $sql );

	// Completed. Let the user know.
	trigger_error ( 'JOINED_WITH_LADDER' );
}
else
{
	// Check to make sure the ladder is not locked.
	if ( $ladder->data[ 'ladder_locked' ] == 1 )
	{
		// Ladder is locked. Let the user know.
		trigger_error ( 'LADDER_JOIN_LOCKED' );
	}

	// The group is wishing to leave the ladder.
	$sql	= "DELETE FROM " . GROUPDATA_TABLE . " WHERE group_ladder = $ladder_id AND group_id = " . $group->data[ 'group_id' ];
	$db->sql_query ( $sql );

	// Completed. Let the user know.
	trigger_error ( 'LEFT_LADDER' );
}

?>
