<?php
##############################################################
# FILENAME  : acp_factions_edit_tournaments.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Edit Tournaments
 * Called from acp_factions with mode == 'edit_tournaments'
 */
function acp_factions_edit_tournaments ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpbb_admin_path, $phpEx;

	$group		= new group ( );
	$ladder		= new ladder ( );
	$tournament	= new tournament ( );

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		// Yes, handle the form.
		$delete			= request_var ( 'delete', 0 );
		$tournament_id	= request_var ( 'tournament_id', 0 );

		// Are we deleting?
		if ( !empty ( $delete ) )
		{
			// Yes. Delete the tournament.
			$sql	= "DELETE FROM " . TOURNAMENTS_TABLE . " WHERE tournament_id = " . $tournament_id;
			$db->sql_query ( $sql );

			// Get all the groups in the tournament.
			$sql	= "SELECT DISTINCT group_id FROM " . TGROUPS_TABLE . " WHERE group_tournament = " . $tournament_id;
			$result	= $db->sql_query ( $result );

			while ( $row = $db->sql_fetchrow ( $result ) )
			{
				// Remove the group from the tournament.
				$tournaments	= unserialize ( $group->data ( 'group_tournaments', $row[ 'group_id' ] ) );
				foreach ( $tournaments AS $key => $value )
				{
					if ( $value == $tournament_id )
					{
						// Tournament IDs match, remove it.
						unset ( $tournaments[ $key ] );
					}
				}

				// Re-serialize the array for the database.
				$tournaments	= serialize ( $tournaments );

				// Update the group's data.
				$sql	= "UPDATE " . GROUPS_TABLE . " SET group_tournaments = '$tournaments' WHERE group_id = " . $row[ 'group_id' ];
				$db->sql_query ( $result );
			}

			$db->sql_freeresult ( $result );

			// Delete the groups from the tournament.
			$sql	= "DELETE FROM " . TGROUPS_TABLE . " WHERE group_tournament = " . $tournament_id;
			$db->sql_query ( $sql );

			// Completed. Let the user know.
			trigger_error ( 'TOURNAMENT_UPDATED' );
		}

		// Add bye groups if needed.
		$tournament->add_byes ( $tournament_id );

		// Update the tournament's data.
		$sql	= "UPDATE " . TOURNAMENTS_TABLE . " SET tournament_status = 2 WHERE tournament_id = " . $tournament->data[ 'tournament_id' ];
		$db->sql_query ( $sql );

		// Completed. Let the user know.
		trigger_error ( 'TOURNAMENT_UPDATED' );
	}
	else
	{
		$filter		= request_var ( 'filter', '' );
		$ladder_id	= request_var ( 'ladder_id', 0 );

		$where	= "WHERE tournament_name <> '' ";
		if ( $filter == 'started' )
		{
			// Clause to filter for started tournaments.
			$where	.= "AND tournament_status = 2 ";
		}
		else if ( $filter == 'unstarted' )
		{
			// Clause to filter for unstarted tournaments.
			$where	.= "AND tournament_status = 1 ";
		}

		if ( $ladder_id == 0 )
		{
			// Clause to filter for all tournaments.
			$where	.= "AND tournament_id >= 1";
		}
		else if ( $ladder_id == -1 )
		{
			// Clause to filter for unassigned tournaments.
			$where	.= "AND tournament_ladder = 0";
		}
		else
		{
			// Clause to filter for assigned tournaments.
			$where	.= "AND tournament_ladder = " . $ladder_id;
		}

		// Get the tournaments.
		$sql	= "SELECT * FROM " . TOURNAMENTS_TABLE . " $where ORDER BY tournament_time DESC";
		$result	= $db->sql_query ( $sql );

		$i					= 0;
		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			// Get the number of groups in the tournament.
			$sql_2		= "SELECT COUNT(*) AS num_groups FROM " . TGROUPS_TABLE . " WHERE group_tournament = {$row[ 'tournament_id' ]} AND group_bracket = 1";
			$result_2	= $db->sql_query ( $sql_2 );
			$row_2		= $db->sql_fetchrow ( $result_2 );

			// Assign each tournament to the template.
			$template->assign_block_vars ( 'block_tournaments', array (
				'U_ACTION' => $u_action,
				'U_EDITBRACKETS' => append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=factions&amp;mode=edit_brackets&amp;tournament_id=' . $row[ 'tournament_id' ] ),
				'U_EDITTOURNAMENT' => append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=factions&amp;mode=edit_tournament&amp;tournament_id=' . $row[ 'tournament_id' ] ),
				'U_STARTTOURNAMENT' => ( $row[ 'tournament_status' ] != 2 ) ? append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=factions&amp;mode=edit_tournaments&amp;submit=1&amp;tournament_id=' . $row[ 'tournament_id' ] ) : '',
				'U_DELETE' => append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=factions&amp;mode=edit_tournaments&amp;submit=1&amp;delete=1&amp;tournament_id=' . $row[ 'tournament_id' ] ),
				'TOURNAMENT_ID' => $row[ 'tournament_id' ],
				'TOURNAMENT_NAME' => $row[ 'tournament_name' ],
				'SPOTS_TAKEN' => $row_2[ 'num_groups' ],
				'SPOTS_OPEN' => $row[ 'tournament_brackets' ] )
			);

			$i++;
		}

		$db->sql_freeresult ( $result );

		// Loop through the ladders.
		$sql	= "SELECT l.*, p.* FROM " . LADDERS_TABLE . " l, " . PLATFORMS_TABLE . " p WHERE l.ladder_platform = p.platform_id";
		$result	= $db->sql_query ( $sql );

		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			// Assign it to the template.
			$template->assign_block_vars ( 'block_ladders', array (
				'LADDER_NAME' => $row[ 'ladder_name' ],
				'PLATFORM' => $row[ 'platform_name' ] )
			);

			$sql_2		= "SELECT * FROM " . LADDERS_TABLE . " WHERE ladder_parent = " . $row[ 'ladder_id' ];
			$result_2	= $db->sql_query ( $sql_2 );

			// Loop through the ladder's sub-ladders.
			while ( $row_2 = $db->sql_fetchrow ( $result_2 ) )
			{
				// Assign them to the template.
				$template->assign_block_vars ( 'block_ladders.block_subladders', array (
					'LADDER_ID' => $row_2[ 'ladder_id' ],
					'LADDER_NAME' => $row_2[ 'ladder_name' ] )
				);
			}

			$db->sql_freeresult ( $result_2 );
		}

		$db->sql_freeresult ( $result );
	}
}

?>
