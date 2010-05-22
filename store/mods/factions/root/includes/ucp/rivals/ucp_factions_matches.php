<?php
##############################################################
# FILENAME  : ucp_factions_matches.php
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
 * Manage Matches
 * Called from ucp_factions with mode == 'matches'
 */
function ucp_factions_matches ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpEx;

	$group	= new group ( );

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		$match_id	= request_var ( 'match_id', 0 );
		$type		= request_var ( 'type', 0 );

		switch ( $type )
		{
			case REPORT_WIN :
				// Get the match information.
				$sql	= "SELECT * FROM " . MATCHES_TABLE . " WHERE match_id = " . $match_id;
				$result	= $db->sql_query ( $sql );
				$row	= $db->sql_fetchrow ( $result );
				$db->sql_freeresult ( $result );

				// Confirm that this is their match.
				if ( !in_array ( $group->data[ 'group_id' ], array ( $row[ 'match_challenger' ], $row[ 'match_challengee' ] ) ) )
				{
					trigger_error ( );
				}

				$opponent	= ( $row[ 'match_challenger' ] == $group->data[ 'group_id' ] ) ? $row[ 'match_challengee' ] : $row[ 'match_challenger' ];
				$opponent	= $group->data ( 'user_id', $opponent );

				// Set the match winner.
				$sql	= "UPDATE " . MATCHES_TABLE . " SET match_winner = {$group->data[ 'group_id' ]} WHERE match_id = " . $match_id;
				$db->sql_query ( $sql );

				// Send a PM to the loser to tell them to confirm the win...
				$subject	= $user->lang[ 'PMCONFIRMWIN' ];
				$message	= sprintf ( $user->lang[ 'PMCONFIRMWINTXT' ], $group->group_name ( $group->data[ 'group_name' ] ) );
				insert_pm ( $opponent, $user->data, $subject, $message );

				// Completed. Let the user know.
				trigger_error ( 'MATCH_REPORTED' );
			break;
			case CONFIRM_WIN :
				// Get the match information.
				$sql	= "SELECT * FROM " . MATCHES_TABLE . " WHERE match_id = " . $match_id;
				$result	= $db->sql_query ( $sql );
				$row	= $db->sql_fetchrow ( $result );
				$db->sql_freeresult ( $result );

				// Confirm that this is their match.
				if ( !in_array ( $group->data[ 'group_id' ], array ( $row[ 'match_challenger' ], $row[ 'match_challengee' ] ) ) )
				{
					trigger_error ( );
				}

				$opponent	= ( $row[ 'match_challenger' ] == $group->data[ 'group_id' ] ) ? $row[ 'match_challengee' ] : $row[ 'match_challenger' ];
				$opponent	= $group->data ( 'user_id', $opponent );

				// Set the match loser.
				$sql	= "UPDATE " . MATCHES_TABLE . " SET match_loser = {$group->data[ 'group_id' ]}, match_finishtime = " . time ( ) . " WHERE match_id = " . $match_id;
				$db->sql_query ( $sql );

				// Get the match information (repopulate).
				$sql	= "SELECT * FROM " . MATCHES_TABLE . " WHERE match_id = " . $match_id;
				$result	= $db->sql_query ( $sql );
				$row	= $db->sql_fetchrow ( $result );
				$db->sql_freeresult ( $result );

				if ( $row[ 'match_unranked' ] == 0 )
				{
					// Get both group's data.
					$sql_2		= "SELECT * FROM " . GROUPDATA_TABLE . " WHERE group_id = {$row[ 'match_winner' ]} AND group_ladder = " . $row[ 'match_ladder' ];
					$result_2	= $db->sql_query ( $sql_2 );
					$row_2		= $db->sql_fetchrow ( $result_2 );
					$db->sql_freeresult ( $result_2 );

					$sql_3		= "SELECT * FROM " . GROUPDATA_TABLE . " WHERE group_id = {$row[ 'match_loser' ]} AND group_ladder = " . $row[ 'match_ladder' ];
					$result_3	= $db->sql_query ( $sql_3 );
					$row_3		= $db->sql_fetchrow ( $result_3 );
					$db->sql_freeresult ( $result_3 );

					// Calculate the new group stats for the winning group.
					// ELO scoring system.
					$score	= calculate_elo ( $row_2[ 'group_score' ], $row_3[ 'group_score' ], true );
					$streak	= ( $group->data ( 'group_streak', $row[ 'match_winner' ], $row[ 'match_ladder' ] ) < 0 ) ? 'group_streak = 0' : 'group_streak = group_streak + 1';
					$sql	= "UPDATE " . GROUPDATA_TABLE . " SET group_wins = group_wins + 1, group_lastscore = group_score, group_score = $score, $streak WHERE group_id = {$row[ 'match_winner' ]} AND group_ladder = " . $row[ 'match_ladder' ];
					$db->sql_query ( $sql );

					// Calculate the new group stats for the loosing group.
					// ELO scoring system.
					$score	= calculate_elo ( $row_3[ 'group_score' ], $row_2[ 'group_score' ], false );
					$streak	= ( $group->data ( 'group_streak', $row[ 'match_loser' ], $row[ 'match_ladder' ] ) <= 0 ) ? 'group_streak = group_streak - 1' : 'group_streak = 0';
					$sql	= "UPDATE " . GROUPDATA_TABLE . " SET group_losses = group_losses + 1, group_lastscore = group_score, group_score = $score, $streak WHERE group_id = {$row[ 'match_loser' ]} AND group_ladder = " . $row[ 'match_ladder' ];
					$db->sql_query ( $sql );

					// Get the match information (repopulate).
					$sql	= "SELECT * FROM " . MATCHES_TABLE . " WHERE match_id = " . $match_id;
					$result	= $db->sql_query ( $sql );
					$row	= $db->sql_fetchrow ( $result );
					$db->sql_freeresult ( $result );

					// Now, update the ranks. Swap if needed.
					$ladder	= new ladder ( );
					$ladder->update_ranks ( $row[ 'match_winner' ], $row[ 'match_loser' ], $row[ 'match_ladder' ] );
				}

				// Send a PM to the winner to tell them that it was confirmed
				$subject	= $user->lang[ 'PMWINCONFIRMED' ];
				$message	= sprintf ( $user->lang[ 'PMWINCONFIRMEDTXT' ], $group->group_name ( $group->data[ 'group_name' ] ) );
				insert_pm ( $opponent, $user->data, $subject, $message );

				// Completed. Let the user know.
				trigger_error ( 'MATCH_REPORTED' );
			break;
			case CONTEST_RESULT :
				$redirect	= append_sid ( "{$phpbb_admin_path}ucp.$phpEx", 'i=factions&amp;mode=ticket' );
				redirect ( $redirect );
			break;
		}
	}
	else
	{
		// Check if the group is apart of a ladder yet.
		if ( empty ( $group->data[ 'group_ladders' ] ) )
		{
			// They are not apart of a ladder. Deny them.
			trigger_error ( 'GROUP_NOTIN_LADDER' );
		}

		// Get all the unreported and reported matches.
		$sql	= "SELECT * FROM " . MATCHES_TABLE . " WHERE (match_challengee = {$group->data[ 'group_id' ]} OR match_challenger = {$group->data[ 'group_id' ]})";
		$result	= $db->sql_query ( $sql );

		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			$opponent	= ( $row[ 'match_challenger' ] == $group->data[ 'group_id' ] ) ? $row[ 'match_challengee' ] : $row[ 'match_challenger' ];

			if ( empty ( $row[ 'match_winner' ] ) )
			{
				if ( $row[ 'match_finishtime' ] == 0 )
				{
					// Assign each reported match to the template.
					$template->assign_block_vars ( 'block_unreported', array (
						'U_OPPONENT' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=group_profile&amp;group_id=' . $opponent ),
						'U_REPORT_WIN'	=> $u_action . '&amp;match_id=' . $row[ 'match_id' ] . '&amp;type=' . REPORT_WIN . '&amp;submit=1',
						'OPPONENT' => ( $row[ 'match_challenger' ] == $group->data[ 'group_id' ] ) ? $group->group_name ( $group->data ( 'group_name', $row[ 'match_challengee' ] ) ) : $group->group_name ( $group->data ( 'group_name', $row[ 'match_challenger' ] ) ),
						'TIME' => $user->format_date ( $row[ 'match_posttime' ] ),
						'MATCH_ID' => $row[ 'match_id' ],
						'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
						'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2' )
					);
				}
			}
			else
			{
				if ( $row[ 'match_winner' ] != $group->data[ 'group_id' ] && empty ( $row[ 'match_loser' ] ) )
				{
					// Assign each unreported match to the template.
					$template->assign_block_vars ( 'block_reported', array (
						'U_OPPONENT' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=group_profile&amp;group_id=' . $opponent ),
						'U_CONFIRM_WIN'	=> $u_action . '&amp;match_id=' . $row[ 'match_id' ] . '&amp;type=' . CONFIRM_WIN . '&amp;submit=1',
						'U_CONTEST_RESULT'	=> $u_action . '&amp;match_id=' . $row[ 'match_id' ] . '&amp;type=' . CONTEST_RESULT . '&amp;submit=1',
						'OPPONENT' => ( $row[ 'match_challenger' ] == $group->data[ 'group_id' ] ) ? $group->group_name ( $group->data ( 'group_name', $row[ 'match_challengee' ] ) ) : $group->group_name ( $group->data ( 'group_name', $row[ 'match_challenger' ] ) ),
						'TIME' => $user->format_date ( $row[ 'match_posttime' ] ),
						'MATCH_ID' => $row[ 'match_id' ],
						'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
						'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2' )
					);
				}
			}

			$i++;
		}

		$db->sql_freeresult ( $result );

		// Assign the other variables to the template.
		$template->assign_vars ( array ( 'U_ACTION' => $u_action ) );
	}
}

?>
