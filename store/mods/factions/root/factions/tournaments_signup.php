<?php
##############################################################
# FILENAME  : tournaments_signup.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

$tournament		= new tournament ( );
$group			= new group ( );
$tournament_id	= request_var ( 'tournament_id', 0 );

// Check if the group is joined to the ladder the tournament is in.
if ( $tournament->data[ 'tournament_ladder' ] != 0 && !in_array ( $tournament->data[ 'tournament_ladder' ], $group->data[ 'group_ladders' ] ) )
{
	// They are not. Let the user know.
	trigger_error ( 'GROUP_NOTSIGNED_UP_LADDER' );
}

// Check if this is invitation only.
if ( $tournament->data[ 'tournament_type' ] == 2 && !in_array ( $group->data[ 'group_id' ], unserialize ( $tournament->data[ 'tournament_invite' ] ) ) )
{
	// They are not invited. Let the user know.
	trigger_error ( 'GROUP_NOTINVITED' );
}

// Get the list of tournaments the group is in.
$sql	= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_id = {$group->data[ 'group_id' ]} AND group_tournament = " . $tournament_id;
$result	= $db->sql_query ( $sql );
$row	= $db->sql_fetchrow ( $result );
$db->sql_freeresult ( $result );

// Are they already in this tournament?
if ( !empty ( $row[ 'group_id' ] ) )
{
	// They are. Let the user know.
	trigger_error ( 'ALREADY_IN_TOURNAMENT' );
}

// Get the number of groups in the tournament.
$sql	= "SELECT COUNT(*) AS num_groups FROM " . TGROUPS_TABLE . " WHERE group_tournament = $tournament_id AND group_bracket = 1";
$result	= $db->sql_query ( $sql );
$row	= $db->sql_fetchrow ( $result );
$db->sql_freeresult ( $result );

if ( $row[ 'num_groups' ] >= $tournament->data[ 'tournament_brackets' ] )
{
	// They can not join, the tournament is full. Let the user know. 
	trigger_error ( 'TOURNAMENT_FULL' );
}

// Everything is OK. Add them to the tournament.
$sql_array	= array (
	'group_tournament' => $tournament_id,
	'group_id' => $group->data[ 'group_id' ],
	'group_bracket' => 1,
	'group_position' => 0
);
$sql		= "INSERT INTO " . TGROUPS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
$db->sql_query ( $sql );

// Add the tournament to the group's data.
$tournaments	= unserialize ( $group->data[ 'group_tournaments' ] );
$tournaments[ ]	= $tournament_id;
$tournaments	= serialize ( $tournaments );

$sql	= "UPDATE " . GROUPS_TABLE . " SET group_tournaments = '$tournaments' WHERE group_id = " . $group->data[ 'group_id' ];
$db->sql_query ( $sql );

// Completed. Let the user know.
trigger_error ( 'GROUP_SIGNED_UP' );

?>
