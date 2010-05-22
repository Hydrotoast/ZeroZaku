<?php
##############################################################
# FILENAME  : acp_factions_edit_groups.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Edit Groups
 * Called from acp_factions with mode == 'edit_groups'
 */
function acp_factions_edit_groups ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpbb_admin_path, $phpEx;

	$group		= new group ( );
	$ladder		= new ladder ( );
	$tournament	= new tournament ( );

	$submit		= request_var ( 'submit', '' );
	$group_id	= request_var ( 'group_id', 0 );

	// Are we submitting a form?
	if ( !empty ( $submit ) )
	{
		// Yes, handle the form.
		$group_delete	= request_var ( 'group_delete', 0 );
		if ( $group_delete != 0 )
		{
			// Try to set the user's group session to another group they own.
			$leader	= $group->data ( 'user_id', $group_id );
			$sql	= "SELECT * FROM " . USER_GROUP_TABLE . " WHERE group_leader = 1 AND user_id = " . $leader;
			$result	= $db->sql_query ( $sql );
			$row	= $db->sql_fetchrow ( $result );
			$db->sql_freeresult ( $result );

			if ( !empty ( $row[ 'group_id' ] ) )
			{
				$sql	= "UPDATE " . USERS_TABLE . " SET group_session = {$row[ 'group_id' ]} WHERE user_id = " . $leader;
				$db->sql_query ( $sql );
			}
			else
			{
				$sql	= "UPDATE " . USERS_TABLE . " SET group_session = 0 WHERE user_id = " . $leader;
				$db->sql_query ( $sql );
			}

			// Delete the group's data.
			$sql	= "DELETE FROM " . GROUPDATA_TABLE . " WHERE group_id = " . $group_id;
			$db->sql_query ( $sql );

			// Delete the group.
			group_delete ( $group_id );

			// Completed. Let the user know.
			trigger_error ( 'GROUP_UPDATED' );
		}

		// Check to see if they are adding to a ladder.
		$add_to_ladder	= request_var ( 'add_to_ladder', 0 );
		if ( $add_to_ladder != 0 )
		{
			// Add the group to the ladder.
			$sql		= "SELECT MAX(group_current_rank) AS current_rank FROM " . GROUPDATA_TABLE . " WHERE group_ladder = " . $add_to_ladder;
			$result		= $db->sql_query ( $sql );
			$row		= $db->sql_fetchrow ( $result );
			$db->sql_freeresult ( $result );
			$new_rank	= $row[ 'current_rank' ] + 1;

			$sql_array	= array (
				'group_id' => $group_id,
				'group_ladder' => $add_to_ladder,
				'group_score' => 1200,
				'group_streak' => 0,
				'group_current_rank' => $new_rank,
				'group_best_rank' => $new_rank,
				'group_worst_rank' => 0,
				'group_last_rank' => 0
			);
			$sql		= "INSERT INTO " . GROUPDATA_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
			$db->sql_query ( $sql );

			// Completed. Let the user know.
			trigger_error ( 'GROUP_UPDATED' );
		}

		// Check to see if they are adding to a tournament.
		$add_to_tournament	= request_var ( 'add_to_tournament', 0 );
		if ( $add_to_tournament != 0 )
		{
			// Check if the group is joined to the ladder the tournament is in.
			$group_data	= $group->data ( '*', $group_id );
			if ( $tournament->data ( 'tournament_ladder', $add_to_tournament ) != 0 && !in_array ( $tournament->data ( 'tournament_ladder', $add_to_tournament ), $group_data[ 'group_ladders' ]  ) )
			{
				// They are not. Let the user know.
				trigger_error ( 'GROUP_NOTSIGNED_UP_LADDER' );
			}

			// Add them to the tournament.
			$sql_array	= array (
				'group_tournament' => $add_to_tournament,
				'group_id' => $group_id,
				'group_bracket' => 1,
				'group_position' => 0
			);
			$sql		= "INSERT INTO " . TGROUPS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
			$db->sql_query ( $sql );

			// Add the tournament to the group's data.
			$tournaments	= unserialize ( $group->data ( 'group_tournaments', $group_id ) );
			$tournaments[ ]	= $add_to_tournament;
			$tournaments	= serialize ( $tournaments );

			$sql	= "UPDATE " . GROUPS_TABLE . " SET group_tournaments = '$tournaments' WHERE group_id = " . $group_id;
			$db->sql_query ( $sql );

			// Completed. Let the user know.
			trigger_error ( 'GROUP_UPDATED' );
		}

		// Check to see if they are moving the group.
		$move_ladder		= request_var ( 'move_ladder', 0 );
		$move_from_ladder	= request_var ( 'move_from_ladder', 0 );
		if ( $move_ladder != 0 )
		{
			// They are moving. Stats too?
			$move_stats	= request_var ( 'move_stats', 0 );
			if ( $move_stats != 0 )
			{
				// Yes, move the stats.
				$sql	= "UPDATE " . GROUPDATA_TABLE . " SET group_ladder = $move_ladder WHERE group_ladder = $move_from_ladder AND group_id = " . $group_id;
				$db->sql_query ( $sql );
			}
			else
			{
				// No, delete the stats.
				$sql	= "UPDATE " . GROUPDATA_TABLE . " SET group_ladder = $move_ladder, group_wins = 0, group_losses = 0, group_score = 1200, group_lastscore = 0, group_streak = 0 WHERE group_ladder = $move_from_ladder AND group_id = " . $group_id;
				$db->sql_query ( $sql );
			}

			// Completed. Let the user know.
			trigger_error ( 'GROUP_MOVED' );
		}

		// Check if a match was editted.
		$match_id	= request_var ( 'match_id', 0 );
		if ( $match_id != 0 )
		{
			// A match was editted. Get the match's details.
			$sql	= "SELECT * FROM " . MATCHES_TABLE . " WHERE match_id = " . $match_id;
			$result	= $db->sql_query ( $sql );
			$row	= $db->sql_fetchrow ( $result );
			$db->sql_fetchrow ( $result );

			$match_delete	= request_var ( 'match_delete', 0 );
			$match_ladder	= request_var ( 'match_ladder', 0 );

			if ( $match_delete == 1 )
			{
				// See who lost and who won to resync their stats.
				$winner	= $row[ 'match_winner' ];
				$loser	= ( $winner == $row[ 'match_challenger' ] ) ? $row[ 'match_challengee' ] : $row[ 'match_challenger' ];

				// Remove the match.
				$sql	= "DELETE FROM " . MATCHES_TABLE . " WHERE match_id = " . $match_id;
				$result	= $db->sql_query ( $sql );

				// Now, sync the stats for both groups.
				$sql	= "UPDATE " . GROUPDATA_TABLE . " SET group_wins = group_wins - 1 WHERE group_id = $winner AND group_ladder = " . $match_ladder;
				$db->sql_query ( $sql );
				$sql	= "UPDATE " . GROUPDATA_TABLE . " SET group_losses = group_losses - 1 WHERE group_id = $loser AND group_ladder = " . $match_ladder;
				$db->sql_query ( $sql );

				// Completed. Let the user know.
				trigger_error ( 'GROUP_UPDATED' );
			}

			// Update the match.
			$match_winner	= request_var ( 'match_winner', 0 );
			$loser	= ( $match_winner == $row[ 'match_challenger' ] ) ? $row[ 'match_challengee' ] : $row[ 'match_challenger' ];

			// Update the match.
			$sql	= "UPDATE " . MATCHES_TABLE . " SET match_winner = $match_winner WHERE match_id = " . $match_id;
			$db->sql_query ( $sql );

			// Now, sync the stats for both groups.
			$sql	= "UPDATE " . GROUPDATA_TABLE . " SET group_wins = group_wins + 1, group_losses = group_losses - 1 WHERE group_id = $match_winner AND group_ladder = " . $match_ladder;
			$db->sql_query ( $sql );
			$sql	= "UPDATE " . GROUPDATA_TABLE . " SET group_losses = group_losses + 1, group_wins = group_wins - 1 WHERE group_id = $loser AND group_ladder = " . $match_ladder;
			$db->sql_query ( $sql );

			// Completed. Let the user know.
			trigger_error ( 'GROUP_UPDATED' );
		}

		// Get and update the group's data.
		$group_name		= utf8_normalize_nfc ( request_var ( 'group_name', '', true ) );
		$group_desc		= utf8_normalize_nfc ( request_var ( 'group_desc', '', true ) );

		// Edit the group.
		$group->edit_group ( $group_id, array (
			'group_name' => $group_name,
			'group_desc' => $group_desc )
		);

		// Get and update the group's ladder data.
		$group_ladder	= request_var ( 'group_ladder', array ( 0 => 0 ) );
		$delete_ladder	= request_var ( 'delete_ladder', array ( 0 => 0 ) );
		$group_wins		= request_var ( 'group_wins', array ( 0 => 0 ) );
		$group_losses	= request_var ( 'group_losses', array ( 0 => 0 ) );
		$group_score	= request_var ( 'group_score', array ( 0 => 0 ) );
		$group_streak	= request_var ( 'group_streak', array ( 0 => 0 ) );

		$i	= 0;
		foreach ( $group_ladder AS $value )
		{
			if ( $delete_ladder[ $i ] == 1 )
			{
				// Remove the group from this ladder.
				$sql	= "DELETE FROM " . GROUPDATA_TABLE . " WHERE group_ladder = $value AND group_id = " . $group_id;
				$db->sql_query ( $sql );
			}
			else
			{
				// Update the group's ladder data.
				$sql	= "UPDATE " . GROUPDATA_TABLE . " SET group_wins = {$group_wins[ $i ]}, group_losses = {$group_losses[ $i ]}, group_score = {$group_score[ $i ]}, group_streak = {$group_streak[ $i ]} WHERE group_ladder = $value AND group_id = " . $group_id;
				$db->sql_query ( $sql );
			}

			$i++;
		}

		// Completed. Let the user know.
		trigger_error ( 'GROUP_UPDATED' );
	}
	else
	{
		// Check if a group ID was set.
		if ( !empty ( $group_id ) )
		{
			// Check if the group exists.
			$group_leader	= $group->data ( 'user_id', $group_id );
			if ( empty ( $group_leader ) )
			{
				// The group does not exist.
				trigger_error ( 'NONEXISTANT_GROUP' );
			}

			// Loop through the ladders the group is joined to.
			$group_data	= $group->data ( '*', $group_id );
			if ( sizeof ( $group_data[ 'group_ladders' ] ) > 0 )
			{
				foreach ( $group_data[ 'group_ladders' ] AS $value )
				{
					// Get the ladder's roots.
					$ladder_data	= $ladder->get_roots ( $value );

					// Get the group's data for this ladder.
					$sql	= "SELECT * FROM " . GROUPDATA_TABLE . " WHERE group_id = $group_id AND group_ladder = " . $value;
					$result	= $db->sql_query ( $sql );
					$row	= $db->sql_fetchrow ( $result );
					$db->sql_freeresult ( $result );

					// Assign each ladder to the template.
					$template->assign_block_vars ( 'block_ladders', array (
						'LADDER_ID' => $value,
						'PLATFORM' => $ladder_data[ 'PLATFORM_NAME' ],
						'LADDER' => $ladder_data[ 'LADDER_NAME' ],
						'SUBLADDER' => $ladder_data[ 'SUBLADDER_NAME' ],
						'GROUP_WINS' => $row[ 'group_wins' ],
						'GROUP_LOSSES' => $row[ 'group_losses' ],
						'GROUP_SCORE' => $row[ 'group_score' ],
						'GROUP_STREAK' => $row[ 'group_streak' ] )
					);
				}
			}

			// Get the group's matches.
			$sql	= "SELECT m.*, l.ladder_id FROM " . MATCHES_TABLE . " m, " . LADDERS_TABLE . " l WHERE (m.match_challenger = $group_id OR m.match_challengee = $group_id) AND m.match_finishtime <> '' AND m.match_ladder = l.ladder_id ORDER BY m.match_id DESC";
			$result	= $db->sql_query ( $sql );

			$i	= 0;
			while ( $row = $db->sql_fetchrow ( $result ) )
			{
				// Get the ladder's roots.
				$ladder_data	= $ladder->get_roots ( $row[ 'match_ladder' ] );

				// Assign each match to the template.
				$template->assign_block_vars ( 'block_matches', array (
					'U_ACTION' => $u_action,
					'PLATFORM' => $ladder_data[ 'PLATFORM_NAME' ],
					'LADDER' => $ladder_data[ 'LADDER_NAME' ],
					'SUBLADDER' => $ladder_data[ 'SUBLADDER_NAME' ],
					'MATCH_ID' => $row[ 'match_id' ],
					'LADDER_ID' => $row[ 'match_ladder' ],
					'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2',
					'DATE' => $user->format_date ( $row[ 'match_finishtime' ] ),
					'CHALLENGER' => $group->data ( 'group_name', $row[ 'match_challenger' ] ),
					'CHALLENGER_SELECTED' => ( $row[ 'match_winner' ] == $row[ 'match_challenger' ] ) ? 'selected="selected"' : '',
					'CHALLENGEE' => $group->data ( 'group_name', $row[ 'match_challengee' ] ),
					'CHALLENGEE_SELECTED' => ( $row[ 'match_winner' ] == $row[ 'match_challengee' ] ) ? 'selected="selected"' : '',
					'CHALLENGER_ID' => $row[ 'match_challenger' ],
					'CHALLENGEE_ID' => $row[ 'match_challengee' ],
					'WINNER' => ( $row[ 'match_finishtime' ] > 0 ) ? $group->data ( 'group_name', $row[ 'match_winner' ] ) : '-',
					'WINNER_ID' => $group->data ( 'group_id', $row[ 'match_winner' ] ) )
				);
			
				$i++;
			}

			$db->sql_freeresult ( $result );

			// Loop through the group's ladder list.
			if ( sizeof ( $group_data[ 'group_ladders' ] ) > 0 )
			{
				foreach ( $group_data[ 'group_ladders' ] AS $value )
				{
					// Get the ladder's roots.
					$ladder_data	= $ladder->get_roots ( $value );

					// Get the group's data for this ladder.
					$sql	= "SELECT * FROM " . GROUPDATA_TABLE . " WHERE group_id = $group_id AND group_ladder = " . $value;
					$result	= $db->sql_query ( $sql );
					$row	= $db->sql_fetchrow ( $result );
					$db->sql_freeresult ( $result );

					// Assign each ladder to the template.
					$template->assign_block_vars ( 'block_ladders2', array (
						'LADDER_ID' => $value,
						'PLATFORM' => $ladder_data[ 'PLATFORM_NAME' ],
						'LADDER' => $ladder_data[ 'LADDER_NAME' ],
						'SUBLADDER' => $ladder_data[ 'SUBLADDER_NAME' ] )
					);
				}
			}

			// Loop through the ladders.
			$sql	= "SELECT l.*, p.* FROM " . LADDERS_TABLE . " l, " . PLATFORMS_TABLE . " p WHERE l.ladder_platform = p.platform_id";
			$result	= $db->sql_query ( $sql );

			while ( $row = $db->sql_fetchrow ( $result ) )
			{
				// Assign it to the template.
				$template->assign_block_vars ( 'block_ladders3', array (
					'LADDER_NAME' => $row[ 'ladder_name' ],
					'PLATFORM' => $row[ 'platform_name' ] )
				);

				$sql_2		= "SELECT * FROM " . LADDERS_TABLE . " WHERE ladder_parent = " . $row[ 'ladder_id' ];
				$result_2	= $db->sql_query ( $sql_2 );

				// Loop through the ladder's sub-ladders.
				while ( $row_2 = $db->sql_fetchrow ( $result_2 ) )
				{
					// Assign them to the template.
					$template->assign_block_vars ( 'block_ladders3.block_subladders3', array (
						'LADDER_ID' => $row_2[ 'ladder_id' ],
						'LADDER_NAME' => $row_2[ 'ladder_name' ] )
					);
				}

				$db->sql_freeresult ( $result_2 );
			}

			// Get the tournaments.
			$sql	= "SELECT * FROM " . TOURNAMENTS_TABLE . " WHERE tournament_status <> 3 ORDER BY tournament_time DESC";
			$result	= $db->sql_query ( $sql );

			while ( $row = $db->sql_fetchrow ( $result ) )
			{
				// Assign the tournaments to the template.
				$template->assign_block_vars ( 'block_tournaments', array (
					'TOURNAMENT_ID' => $row[ 'tournament_id' ],
					'TOURNAMENT_NAME' => $row[ 'tournament_name' ] )
				);
			}

			$db->sql_freeresult ( $result );

			// Assign the group's details to the template.
			decode_message ( $group_data[ 'group_desc' ], $group_data[ 'group_desc_uid' ] );

			$template->assign_vars ( array (
				'GROUP_LEADER' => $group_data[ 'user_id' ],
				'GROUP_ID' => $group_id,
				'GROUP_DESC' => $group_data[ 'group_desc' ],
				'GROUP_NAME' => $group->group_name ( $group_data[ 'group_name' ] ) )
			);
		}

		// Assign the other variables to the template.
		$template->assign_vars ( array ( 'U_ACTION' => $u_action ) );
	}
}

?>
