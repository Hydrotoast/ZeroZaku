<?php
##############################################################
# FILENAME  : acp_factions_edit_brackets.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

define ( 'MOVE_RIGHT', 1 );
define ( 'MOVE_LEFT', 2 );
define ( 'MOVE_UP', 3 );
define ( 'MOVE_DOWN', 4 );

/**
 * Edit Brackets
 * Called from acp_factions with mode == 'edit_brackets'
 */
function acp_factions_edit_brackets ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpbb_admin_path, $phpEx;

	$ladder		= new ladder ( );
	$group		= new group ( );
	$tournament	= new tournament ( );

	$submit			= request_var ( 'submit', '' );
	$tournament_id	= request_var ( 'tournament_id', 0 );

	// Are we submitting a form?
	if ( !empty ( $submit ) )
	{
		// Yes, handle the form.
		$move			= request_var ( 'move', MOVE_RIGHT );
		$where			= request_var ( 'where', 0 );
		$group_1		= request_var ( 'group_1', 0 );
		$group_2		= request_var ( 'group_2', 0 );
		$position		= request_var ( 'position', 0 );
		$bracket		= request_var ( 'bracket', 0 );
		$remove_group	= request_var ( 'remove_group', 0 );

		// Check to see if we are removing a group from the brackets.
		if ( $remove_group != 0 )
		{
			// Remove the group from the bracket.
			$tournament->remove_group ( $remove_group );

			// Completed. Let the user know.
			trigger_error ( 'REMOVE_GROUP_TOURNAMENT' );
		}

		// From winner bracket or loser brackets 1 = Winner, else = Loser.
		if ( $where == 1 )
		{
			if ( $tournament->data[ 'tournament_type' ] == 1 )
			{
				// Single elimination tournament.
				if ( $move == MOVE_RIGHT )
				{
					// Move the winner group in the brackets.
					$sql_array	= array (
						'group_tournament' => $tournament_id,
						'group_id' => $group_1,
						'group_bracket' => $bracket + 1,
						'group_position' => round ( $position / 2 )
					);
					$sql	= "INSERT INTO " . TGROUPS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
					$db->sql_query ( $sql );

					// Add the loser group to the finishedgroups. Removes them from the tournament.
					$tournament_finishedgroups		= unserialize ( $tournament->data[ 'tournament_finishedgroups' ] );
					$tournament_finishedgroups[ ]	= $group_2;
					$tournament_finishedgroups		= serialize ( $tournament_finishedgroups );

					// Update the tournament data.
					$sql	= "UPDATE " . TOURNAMENTS_TABLE . " SET tournament_finishedgroups = '$tournament_finishedgroups' WHERE tournament_id = " . $tournament_id;
					$db->sql_query ( $sql );
				}
				else if ( $move == MOVE_LEFT )
				{
					// Move the group back into its old position. Simple.
					$sql	= "DELETE FROM " . TGROUPS_TABLE . " WHERE group_id = $group_1 AND group_bracket = $bracket AND group_position = $position AND group_tournament = " . $tournament_id;
					$db->sql_query ( $sql );
				}
				else
				{
					// Move the group up or down. Get the group above/below!
					$aob	= ( $move == MOVE_UP ) ? ( $position - 1 ) : ( $position + 1 );
					$sql	= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_bracket = $bracket AND group_position = $aob AND group_tournament = " . $tournament_id;
					$result	= $db->sql_query ( $sql );
					$row	= $db->sql_fetchrow ( $result );
					$db->sql_freeresult ( $result );

					// Now, switch their positions.
					$sql	= "UPDATE " . TGROUPS_TABLE . " SET group_position = {$row[ 'group_position' ]} WHERE group_id = $group_1 AND group_bracket = $bracket AND group_position = $position AND group_tournament = " . $tournament_id;
					$db->sql_query ( $sql );
					$sql	= "UPDATE " . TGROUPS_TABLE . " SET group_position = $position WHERE group_id = {$row[ 'group_id' ]} AND group_bracket = $bracket AND group_position = {$row[ 'group_position' ]} AND group_tournament = " . $tournament_id;
					$db->sql_query ( $sql );
				}
			}
			else
			{
				// Double elimination tournament.
				if ( $move == MOVE_RIGHT )
				{
					// Move the winner group in the brackets.
					$sql	= "INSERT INTO " . TGROUPS_TABLE . " (group_tournament, group_id, group_bracket, group_position) VALUES ($tournament_id, $group_1, " . ( $bracket + 1 ) . ", " . ( round ( $position / 2 ) ) . ")";
					$db->sql_query ( $sql );

					// Get the next spot to use for the loser bracket.
					$sql	= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_tournament = $tournament_id AND group_bracket = 1 ORDER BY group_position DESC";
					$result	= $db->sql_query_limit ( $sql, 1 );
					$row	= $db->sql_fetchrow ( $result );
					$db->sql_freeresult ( $result );

					// Move the loser group into the loser bracket.
					$position	= ( $row[ 'group_position' ] > 0 ) ? $row[ 'group_position' ] : 0;

					$sql_array	= array (
						'group_tournament' => $tournament_id,
						'group_id' => $group_2,
						'group_loser' => 1,
						'group_bracket' => 1,
						'group_position' => $row[ 'group_position' ] + 1
					);
					$sql		= "INSERT INTO " . TGROUPS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
					$db->sql_query ( $sql );
				}
				else if ( $move == MOVE_LEFT )
				{
					// Move the group back into its old position. Simple.
					$sql	= "DELETE FROM " . TGROUPS_TABLE . " WHERE group_id = $group_1 AND group_bracket = $bracket AND group_position = $position AND group_tournament = " . $tournament_id;
					$db->sql_query ( $sql );
				}
				else
				{
					// Move the group up or down. Get the group above/below!
					$aob	= ( $move == MOVE_UP ) ? ( $position - 1 ) : ( $position + 1 );
					$sql	= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_bracket = $bracket AND group_position = $aob AND group_tournament = " . $tournament_id;
					$result	= $db->sql_query ( $sql );
					$row	= $db->sql_fetchrow ( $result );
					$db->sql_freeresult ( $result );

					// Now, switch their positions.
					$sql	= "UPDATE " . TGROUPS_TABLE . " SET group_position = {$row[ 'group_position' ]} WHERE group_id = $group_1 AND group_bracket = $bracket AND group_position = $position AND group_tournament = " . $tournament_id;
					$db->sql_query ( $sql );
					$sql	= "UPDATE " . TGROUPS_TABLE . " SET group_position = $position WHERE group_id = {$row[ 'group_id' ]} AND group_bracket = $bracket AND group_position = {$row[ 'group_position' ]} AND group_tournament = " . $tournament_id;
					$db->sql_query ( $sql );
				}
			}

			// Check if a PM needs to be sent, only to losing and advancing groups.
			if ( $move == MOVE_RIGHT )
			{
				// Send a PM nofitfing both groups.	
				$subject	= $user->lang[ 'PM_TOURNAMENT' ];
				$message	= sprintf ( $user->lang[ 'PM_TOURNAMENTMSG' ], $tournament->data ( 'tournament_name', $tournament_id ) );
				insert_pm ( $group->data ( 'user_id', $group_1 ), $user->data, $subject, $message );

				$subject	= $user->lang[ 'PM_TOURNAMENT' ];
				$message	= sprintf ( $user->lang[ 'PM_TOURNAMENTMSG2' ], $tournament->data ( 'tournament_name', $tournament_id ) );
				insert_pm ( $group->data ( 'user_id', $group_2 ), $user->data, $subject, $message );
			}

			// Completed. Let the user know.
			trigger_error ( 'TOURNAMENT_UPDATED' );
		}
		else
		{
			if ( $move == MOVE_RIGHT )
			{
				// Move the winner group from the loser bracket into the next bracket.
				$sql_array	= array (
					'group_tournament' => $tournament_id,
					'group_id' => $group_1,
					'group_bracket' => $bracket + 1,
					'group_position' => round ( $position / 2 ),
					'group_loser' => 1
				);
				$sql		= "INSERT INTO " . TGROUPS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
				$db->sql_query ( $sql );

				// Add the loser group to the finishedgroups. Removes them from the tournament.
				$tournament_finishedgroups	= $tournament->data ( 'tournament_finishedgroups', $tournament_id ) . '|' . $group_2;

				// Update the tournament data.
				$sql	= "UPDATE " . TOURNAMENTS_TABLE . " SET tournament_finishedgroups = '$tournament_finishedgroups' WHERE tournament_id = " . $tournament_id;
				$db->sql_query ( $sql );
			}
			else if ( $move == MOVE_LEFT )
			{
				// Move the group back into its old position. Simple.
				$sql	= "DELETE FROM " . TGROUPS_TABLE . " WHERE group_id = $group_1 WHERE group_bracket = $bracket AND group_position = $position AND group_loser = 1 AND group_tournament = " . $tournament_id;
				$db->sql_query ( $sql );
			}
			else
			{
				// Move the group up or down. Get the group above/below!
				$aob	= ( $move == MOVE_UP ) ? ( $position - 1 ) : ( $position + 1 );
				$sql	= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_bracket = $bracket AND group_position = $aob AND group_loser = 1 AND group_tournament = " . $tournament_id;
				$result	= $db->sql_query ( $sql );
				$row	= $db->sql_fetchrow ( $result );
				$db->sql_freeresult ( $result );

				// Now, switch their positions.
				$sql	= "UPDATE " . TGROUPS_TABLE . " SET group_position = {$row[ 'group_position' ]} WHERE group_id = $group_1 AND group_bracket = $bracket AND group_position = $position AND group_loser = 1 AND group_tournament = " . $tournament_id;
				$db->sql_query ( $sql );
				$sql	= "UPDATE " . TGROUPS_TABLE . " SET group_position = $position WHERE group_id = {$row[ 'group_id' ]} AND group_bracket = $bracket AND group_position = {$row[ 'group_position' ]} AND group_loser = 1 AND group_tournament = " . $tournament_id;
				$db->sql_query ( $sql );
			}

			// Check if a PM needs to be sent, only to losing and advancing groups.
			if ( $move == MOVE_RIGHT )
			{
				// Send a PM nofitfing both groups.
				$subject	= $user->lang[ 'PM_TOURNAMENT' ];
				$message	= sprintf ( $user->lang[ 'PM_TOURNAMENTMSG' ], $tournament->data ( 'tournament_name', $tournament_id ) );
				insert_pm ( $group->data ( 'user_id', $group_1 ), $user->data, $subject, $message );

				$subject	= $user->lang[ 'PM_TOURNAMENT' ];
				$message	= sprintf ( $user->lang[ 'PM_TOURNAMENTMSG2' ], $tournament->data ( 'tournament_name', $tournament_id ) );
				insert_pm ( $group->data ( 'user_id', $group_2 ), $user->data, $subject, $message );
			}

			// Completed. Let the user know.
			trigger_error ( 'TOURNAMENT_UPDATED' );
		}
	}
	else
	{
		// Generate the admin editable tournament.
		$tournament->generate_tournament ( true, $u_action );
	}
}

?>
