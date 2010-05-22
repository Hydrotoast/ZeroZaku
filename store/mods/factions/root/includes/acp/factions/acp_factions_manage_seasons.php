<?php
##############################################################
# FILENAME  : acp_factions_manage_seasons.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Manage Seasons
 * Called from acp_factions with mode == 'manage_seasons'
 */
function acp_factions_manage_seasons ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpbb_admin_path, $phpEx;

	$ladder	= new ladder ( );

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		// Yes, handle the form. End the season...
		$ladder_id	= request_var ( 'ladder_id', 0 );
		$season_id	= request_var ( 'season_id', 0 );

		// Get all the groups for this season's ladders.
		$sql	= "SELECT s.*, cd.* FROM " . SEASONS_TABLE . " s, " . GROUPDATA_TABLE . " cd WHERE s.season_ladder = cd.group_ladder AND s.season_status = 1 AND s.season_id = " . $season_id;
		$result	= $db->sql_query ( $sql );
		$row	= $db->sql_fetchrow ( $result );
		$db->sql_freeresult ( $result );

		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			// Basically we're going to push the group's current data to a season.
			$sql_array	= array (
				'season_id' => $row[ 'season_id' ],
				'group_id' => $row[ 'group_id' ],
				'group_wins' => $row[ 'group_wins' ],
				'group_losses' => $row[ 'group_losses' ],
				'group_score' => $row[ 'group_score' ],
				'group_streak' => $row[ 'group_streak' ],
				'group_current_rank' => $row[ 'group_current_rank' ],
				'group_last_rank' => $row[ 'group_last_rank' ],
				'group_worst_rank' => $row[ 'group_worst_rank' ],
				'group_best_rank' => $row[ 'group_best_rank' ],
				'group_ladder' => $row[ 'group_ladder' ]
			);
			$sql		= "INSERT INTO " . SEASONDATA_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
			$db->sql_query ( $sql );
		}

		$db->sql_freeresult ( $result );

		// Reset everything for every group!
		$sql	= "UPDATE " . GROUPDATA_TABLE . " SET group_wins = 0, group_losses = 0, group_score = 1200, group_lastscore = 0, group_streak = 0, group_current_rank = 0, group_last_rank = 0, group_worst_rank = 0, group_best_rank = 0 WHERE group_ladder = " .  $ladder_id;
		$db->sql_query ( $sql );

		// Now, set their ranks!
		$sql	= "SELECT * FROM " . GROUPDATA_TABLE . " WHERE group_ladder = " . $ladder_id;
		$result	= $db->sql_query ( $sql );

		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			$sql_2		= "SELECT MAX(group_current_rank) AS max_rank FROM " . GROUPDATA_TABLE . " WHERE group_ladder = " . $ladder_id;
			$result_2	= $db->sql_query ( $sql_2 );
			$row_2		= $db->sql_fetchrow ( $result_2 );
			$db->sql_freeresult ( $result_2 );

			// Update their ranks.
			$new_rank	= $row_2[ 'max_rank' ] + 1;
			$sql_3		= "UPDATE " . GROUPDATA_TABLE . " SET group_current_rank = $new_rank, group_last_rank = 0, group_best_rank = $new_rank, group_worst_rank = 0 WHERE group_id = {$row[ 'group_id' ]} AND group_ladder = " . $ladder_id;
			$db->sql_query ( $sql_3 );
		}

		// Finally, change the seasons' status to ended.
		$sql	= "UPDATE " . SEASONS_TABLE . " SET season_status = 0 WHERE season_id = " . $season_id;
		$db->sql_query ( $sql );

		// Completed. Let the user know.
		trigger_error ( 'SEASON_ENDED' );
	}
	else
	{
		// Get the parent ladders and order them.
		$sql	= "SELECT * FROM " . LADDERS_TABLE . " WHERE ladder_parent = 0 ORDER BY ladder_order ASC";
		$result	= $db->sql_query ( $sql );

		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			// Get the platform this ladder is joined to.
			$sql_2		= "SELECT * FROM " . PLATFORMS_TABLE . " WHERE platform_id = " . $row[ 'ladder_platform' ];
			$result_2	= $db->sql_query ( $sql_2 );
			$row_2		= $db->sql_fetchrow ( $result_2 );
			$db->sql_freeresult ( $result_2 );

			// Assign each ladder to the template.
			$template->assign_block_vars ( 'block_ladders', array (
				'LADDER_NAME' => $row[ 'ladder_name' ],
				'PLATFORM_NAME' => $row_2[ 'platform_name' ] )
			);

			// Get the sub-ladders for this ladder.
			$sql_3		= "SELECT * FROM " . LADDERS_TABLE . " WHERE ladder_parent = {$row[ 'ladder_id' ]} ORDER BY subladder_order ASC";
			$result_3	= $db->sql_query ( $sql_3 );

			while ( $row_3 = $db->sql_fetchrow ( $result_3 ) )
			{
				// See if we can end or start a season...
				$sql_4		= "SELECT * FROM " . SEASONS_TABLE . " WHERE season_ladder = {$row_3[ 'ladder_id' ]} AND season_status = 1";
				$result_4	= $db->sql_query ( $sql_4 );
				$row_4		= $db->sql_fetchrow ( $result_4 );
				$db->sql_freeresult ( $result_4 );

				if ( $row_4[ 'season_status' ] == 1 )
				{
					// There is an on-going season, allow for ending.
					$language	= $user->lang[ 'END_SEASON' ];
					$action		= $u_action . '&amp;submit=1&amp;season_id=' . $row_4[ 'season_id' ] . '&amp;ladder_id=' . $row_3[ 'ladder_id' ];

					$action_2	= append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=factions&amp;mode=edit_season&amp;season_id=' . $row_4[ 'season_id' ] );
				}
				else
				{
					// There is no season started, allow for starting.
					$language	= $user->lang[ 'START_SEASON' ];
					$action		= append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=factions&amp;mode=add_season&amp;ladder_id=' . $row_3[ 'ladder_id' ] );

					$action_2	= '';
				}

				// Assign each sub-ladder to the template.
				$template->assign_block_vars ( 'block_ladders.block_subladders', array (
					'U_ACTION' => $action,
					'U_ACTION2' => $action_2,
					'L_LANGUAGE' => $language,
					'LADDER_NAME' => $row_3[ 'ladder_name' ] )
				);
			}

			$db->sql_freeresult ( $result_3 );
		}

		$db->sql_freeresult ( $result );
	}
}

?>
