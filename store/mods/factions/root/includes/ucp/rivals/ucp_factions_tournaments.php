<?php
##############################################################
# FILENAME  : ucp_factions_tournaments.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

define ( 'REPORT_WIN', 1 );
define ( 'CONFIRM_WIN', 2 );
define ( 'CONTEST_RESULT', 3 );

/**
 * Manage Tournaments
 * Called from ucp_factions with mode == 'tournaments'
 */
function ucp_factions_tournaments ( $id, $mode, $u_action )
{
	global	$db, $user,$template;
	global	$phpbb_root_path, $phpEx;

	$group		= new group ( );
	$tournament	= new tournament ( );

	// Are we submitting a form?
	$submit		= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		$tournament_id	= request_var ( 'tournament_id', 0 );
		$report_id		= request_var ( 'report_id', 0 );
		$type			= request_var ( 'type', 0 );

		// Get the group's tournament data.
		$sql	= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_tournament = $tournament_id AND group_id = {$group->data[ 'group_id' ]} ORDER BY group_bracket DESC";
		$result	= $db->sql_query_limit ( $sql, 1 );
		$row	= $db->sql_fetchrow ( $result );
		$db->sql_freeresult ( $result );

		// Get the group's opponent.
		$opp	= $tournament->get_matchup ( $row[ 'group_bracket' ], $row[ 'group_position' ] );

		switch ( $type )
		{
			case REPORT_WIN :
				// Get the tournament's data.
				$sql_2		= "SELECT * FROM " . TOURNAMENTS_TABLE . " WHERE tournament_id = " . $tournament_id;
				$result_2	= $db->sql_query ( $sql_2 );
				$row_2		= $db->sql_fetchrow ( $result_2 );
				$db->sql_freeresult ( $result_2 );

				// Create the report.
				$sql_array	= array (
					'tournament_id' => $tournament_id,
					'group_1' => $group->data[ 'group_id' ],
					'group_2' => $opp,
					'reported' => 1,
					'group_winner' => $group->data[ 'group_id' ]
				);
				$sql		= "INSERT INTO " . TREPORTS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
				$db->sql_query ( $sql );

				// Send a PM to the opponent.
				$subject	= $user->lang[ 'PM_TREPORT' ];
				$message	= sprintf ( $user->lang[ 'PM_TREPORTTXT' ], $group->group_name ( $group->data[ 'group_name' ] ), $row_2[ 'tournament_name' ], $group->group_name ( $group->data[ 'group_name' ] ) );
				insert_pm ( $group->data ( 'user_id', $opp ), $user->data, $subject, $message );

				// Completed. Let the user know.
				trigger_error ( 'TOURNAMENT_REPORTED' );
			break;
			case CONFIRM_WIN :
				// Get the report.
				$sql_2		= "SELECT * FROM " . TREPORTS_TABLE . " WHERE report_id = " . $report_id;
				$result_2	= $db->sql_query ( $sql_2 );
				$row_2		= $db->sql_fetchrow ( $result_2 );
				$db->sql_freeresult ( $result_2 );

				// Get the opponent's bracket and position.
				$aob	= ( $row[ 'group_position' ] % 2 == 0 ) ? $row[ 'group_position' ] - 1 : $row[ 'group_position' ] + 1;
				$sql_3		= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_bracket = {$row[ 'group_bracket' ]} AND group_position = $aob AND group_tournament = " . $tournament_id;
				$result_3	= $db->sql_query ( $sql_3 );
				$row_3		= $db->sql_fetchrow ( $result_3 );
				$db->sql_freeresult ( $result_3 );

				// Move the winner group in the brackets.
				$sql_array	= array (
					'group_tournament' => $tournament_id,
					'group_id' => $row_2[ 'group_winner' ],
					'group_bracket' => $row_3[ 'group_bracket' ] + 1,
					'group_position' => round ( $row_3[ 'group_position' ] / 2 )
				);
				$sql	= "INSERT INTO " . TGROUPS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
				$db->sql_query ( $sql );

				// Add the loser group to the finishedgroups. Removes them from the tournament.
				$tournament_finishedgroups		= unserialize ( $tournament->data[ 'tournament_finishedgroups' ] );
				$tournament_finishedgroups[ ]	= $group->data[ 'group_id' ];
				$tournament_finishedgroups		= serialize ( $tournament_finishedgroups );

				// Update the tournament data.
				$sql	= "UPDATE " . TOURNAMENTS_TABLE . " SET tournament_finishedgroups = '$tournament_finishedgroups' WHERE tournament_id = " . $tournament_id;
				$db->sql_query ( $sql );

				// Remove the tournament from the group's data.
				$group_tournaments	= unserialize ( $group->data[ 'group_tournaments' ] );
				foreach ( $group_tournaments AS $key => $value )
				{
					if ( $value == $tournament_id )
					{
						unset ( $group_tournaments[ $key ] );
					}
				}

				$group_tournaments	= serialize ( $group_tournaments );
				$sql	= "UPDATE " . GROUPS_TABLE . " SET group_tournaments = '$group_tournaments' WHERE group_id = " . $group->data[ 'group_id' ];
				$db->sql_query ( $sql );

				// Remove the tournament from the group's data.
				$group_tournaments	= unserialize ( $group->data ( 'group_tournaments', $opp ) );
				foreach ( $group_tournaments AS $key => $value )
				{
					if ( $value == $tournament_id )
					{
						unset ( $group_tournaments[ $key ] );
					}
				}

				$group_tournaments	= serialize ( $group_tournaments );
				$sql	= "UPDATE " . GROUPS_TABLE . " SET group_tournaments = '$group_tournaments' WHERE group_id = " . $opp;
				$db->sql_query ( $sql );

				// Update the report data.
				$sql	= "DELETE FROM " . TREPORTS_TABLE . " WHERE report_id = " . $report_id;
				$db->sql_query ( $sql );

				// Send a PM to the opponent.
				$subject	= $user->lang[ 'PM_TREPORTED' ];
				$message	= sprintf ( $user->lang[ 'PM_TREPORTEDTXT' ], $group->group_name ( $group->data[ 'group_name' ] ), $row_2[ 'tournament_name' ] );
				insert_pm ( $group->data ( 'user_id', $opp ), $user->data, $subject, $message );

				// Completed. Let the user know.
				trigger_error ( 'TOURNAMENT_REPORTED' );
			break;
			case CONTEST_RESULT :
				$redirect	= append_sid ( "{$phpbb_admin_path}ucp.$phpEx", 'i=factions&amp;mode=ticket' );
				redirect ( $redirect );
			break;
		}
	}
	else
	{
		// Get the group's tournaments.
		$tournaments	= unserialize ( $group->data[ 'group_tournaments' ] );
		if ( $group->data[ 'group_tournaments' ] != 'N/A' )
		{
			// Loop through the tournaments!
			$sql	= "SELECT * FROM " . TOURNAMENTS_TABLE . " WHERE tournament_id IN(" . implode ( $tournaments ) . ") AND tournament_status = 2";
			$result	= $db->sql_query ( $sql );

			while ( $row = $db->sql_fetchrow ( $result ) )
			{
				$tournament_finishedgroups	= (array) unserialize ( $row[ 'tournament_finishedgroups' ] );
				if ( !in_array ( $group->data[ 'group_id' ], $tournament_finishedgroups ) )
				{
					// Get the group's details for the tournament.
					$sql_2		= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_tournament = {$row[ 'tournament_id' ]} AND group_id = {$group->data[ 'group_id' ]} ORDER BY group_position, group_bracket DESC";
					$result_2	= $db->sql_query_limit ( $sql_2, 1 );
					$row_2		= $db->sql_fetchrow ( $result_2 );
					$db->sql_freeresult ( $result_2 );

					// Get the group's opponent for the current tournament and position.
					$opp	= $tournament->get_matchup ( $row_2[ 'group_bracket' ], $row_2[ 'group_position' ], $row_2[ 'group_tournament' ] );

					if ( $opp != false )
					{
						// Check to see if a report was made.
						$sql_4		= "SELECT * FROM " . TREPORTS_TABLE . " WHERE tournament_id = {$row[ 'tournament_id' ]} AND ((group_1 = {$group->data[ 'group_id' ]} AND group_2 = $opp) OR (group_1 = $opp AND group_2 = {$group->data[ 'group_id' ]}))";
						$result_4	= $db->sql_query ( $sql_4 );
						$row_4		= $db->sql_fetchrow ( $result_4 );
						$db->sql_freeresult ( $result_4 );

						if ( sizeof ( $row_4 ) > 0 )
						{
							if ( $row_4[ 'group_winner' ] != $group->data[ 'group_id' ] && $row_4[ 'reported' ] == 1 )
							{
								// A report was made. This group is not the winner, allow for confirm or contest of the result.
								$template->assign_block_vars ( 'block_reported', array (
									'U_CONFIRM_WIN'	=> $u_action . '&amp;type=' . CONFIRM_WIN . '&amp;submit=1&amp;report_id=' . $row_4[ 'report_id' ] . '&amp;tournament_id=' . $row[ 'tournament_id' ],
									'U_CONTEST_RESULT'	=> $u_action . '&amp;type=' . CONTEST_RESULT,
									'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
									'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2',
									'TOURNAMENT_ID' => $row[ 'tournament_id' ],
									'TOURNAMENT_NAME' => $row[ 'tournament_name' ],
									'OPPONENT' => $group->group_name ( $group->data ( 'group_name', $opp ) ) )
								);
							}
						}
						else
						{
							// A report was not made.
							$template->assign_block_vars ( 'block_unreported', array (
								'U_REPORT_WIN'	=> $u_action . '&amp;type=' . REPORT_WIN . '&amp;submit=1&amp;tournament_id=' . $row[ 'tournament_id' ],
								'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
								'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2',
								'TOURNAMENT_ID' => $row[ 'tournament_id' ],
								'TOURNAMENT_NAME' => $row[ 'tournament_name' ],
								'OPPONENT' => $group->group_name ( $group->data ( 'group_name', $opp ) ) )
							);
						}
					}
				}
			}

			$db->sql_freeresult ( $result );
		}
	}
}

?>
