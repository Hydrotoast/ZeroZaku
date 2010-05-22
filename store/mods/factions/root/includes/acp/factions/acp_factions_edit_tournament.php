<?php
##############################################################
# FILENAME  : acp_factions_edit_tournament.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Edit a Tournament
 * Called from acp_factions with mode == 'edit_tournament'
 */
function acp_factions_edit_tournament ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpbb_admin_path, $phpEx;

	$ladder		= new ladder ( );
	$group		= new group ( );
	$tournament	= new tournament ( );

	$tournament_id		= request_var ( 'tournament_id', 0 );
	$submit				= request_var ( 'submit', '' );

	// Are we submitting a form?
	if ( !empty ( $submit ) )
	{
		// Yes, handle the form.
		$remove_group	= request_var ( 'remove_group', 0 );
		if ( $remove_group != 0 )
		{
			// Remove the signed up group.
			$sql	= "DELETE FROM " . TGROUPS_TABLE . " WHERE group_tournament = $tournament_id AND group_id = " . $remove_group;
			$db->sql_query ( $sql );

			// Completed. Let the user know.
			trigger_error ( 'GROUP_REMOVED_TOURNAMENT' );
		}

		$tournament_name		= utf8_normalize_nfc ( request_var ( 'tourn_name', '', true ) );
		$tournament_info		= utf8_normalize_nfc ( request_var ( 'tourn_info', '', true ) );
		$tournament_season		= request_var ( 'tourn_season', 0 );
		$tournament_brackets	= request_var ( 'tourn_brackets', 0 );
		$tournament_startdate	= request_var ( 'tourn_startdate', array ( 0 => 0 ) );
		$tournament_archive		= request_var ( 'tourn_archive', 0 );

		// Setup the BBcode for the tournament info.
		$uid			= $bitfield = $options = '';
		$allow_bbcode	= $allow_urls = $allow_smilies = true;
		generate_text_for_storage ( $tournament_info, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies );

		// Convert the start date to a UNIX timestamp.
		$start_date	= mktime ( $tournament_startdate[ 3 ], $tournament_startdate[ 4 ], 0, $tournament_startdate[ 0 ], $tournament_startdate[ 1 ], $tournament_startdate[ 2 ] );

		// Run the query to update the tournament.
		$tournament_archive	= ( $tournament_archive == 1 ) ? 3 : 'tournament_status';
		$sql				= "UPDATE " . TOURNAMENTS_TABLE . " SET tournament_name = '$tournament_name', tournament_info = '$tournament_info', tournament_season = $tournament_season, tournament_brackets = $tournament_brackets, tournament_startdate = $start_date, tournament_status = $tournament_archive, bbcode_uid = '$uid', bbcode_bitfield = '$bitfield', bbcode_options = $options WHERE tournament_id = " . $tournament_id;
		$db->sql_query ( $sql );

		// Completed. Let the user know.
		trigger_error ( 'TOURNAMENT_UPDATED' );
	}
	else
	{
		// Break down the tournament's start date.
		$month	= date ( 'm', $tournament->data[ 'tournament_startdate' ] );
		$day	= date ( 'd', $tournament->data[ 'tournament_startdate' ] );
		$year	= date ( 'Y', $tournament->data[ 'tournament_startdate' ] );
		$hour	= date ( 'H', $tournament->data[ 'tournament_startdate' ] );
		$minute	= date ( 'i', $tournament->data[ 'tournament_startdate' ] );

		// Set the months for the start date.
		$months	= array (
			$user->lang[ 'datetime' ][ 'January' ],
			$user->lang[ 'datetime' ][ 'February' ],
			$user->lang[ 'datetime' ][ 'March' ],
			$user->lang[ 'datetime' ][ 'April' ],
			$user->lang[ 'datetime' ][ 'May' ],
			$user->lang[ 'datetime' ][ 'June' ],
			$user->lang[ 'datetime' ][ 'July' ],
			$user->lang[ 'datetime' ][ 'August' ],
			$user->lang[ 'datetime' ][ 'September' ],
			$user->lang[ 'datetime' ][ 'October' ],
			$user->lang[ 'datetime' ][ 'November' ],
			$user->lang[ 'datetime' ][ 'December' ]
		);

		foreach ( $months AS $key => $value )
		{
			$fixed_month	= $key + 1;

			// Assign the month to the template.
			$template->assign_block_vars ( 'block_months', array (
				'MONTH' => $fixed_month,
				'MONTH_NAME' => $value,
				'SELECTED' => ( $fixed_month == $month ) ? 'selected="selected"' : '' )
			);
		}

		// Set the days for the start date.
		for ( $i = 1; $i <= 31; $i++ )
		{
			$fixed_day	= ( strlen ( $i ) == 1 ) ? '0' . $i : $i;

			// Assign the day to the template.
			$template->assign_block_vars ( 'block_days', array (
				'DAY' => $fixed_day,
				'SELECTED' => ( $fixed_day == $day ) ? 'selected="selected"' : '' )
			);
		}

		// Set the years for the start date.
		for ( $i = date ( 'Y' ); $i < ( date ( 'Y' ) + 3 ); $i++ )
		{
			// Assign the year to the template.
			$template->assign_block_vars ( 'block_years', array (
				'YEAR' => $i,
				'SELECTED' => ( $i == $year ) ? 'selected="selected"' : '' )
			);
		}

		// Set the hours for the start date.
		for ( $i = 1; $i <= 24; $i++ )
		{
			$fixed_hour	= ( strlen ( $i ) == 1 ) ? '0' . $i : $i;

			// Assign the hour to the template.
			$template->assign_block_vars ( 'block_hours', array (
				'HOUR' => $fixed_hour,
				'SELECTED' => ( $fixed_hour == $hour ) ? 'selected="selected"' : '' )
			);
		}

		// Set the minutes for the start date.
		for ( $i = 0; $i <= 55; $i += 5 )
		{
			$fixed_minute	= ( strlen ( $i ) == 1 ) ? '0' . $i : $i;

			// Assign the minute to the template.
			$template->assign_block_vars ( 'block_minutes', array (
				'MINUTE' => $fixed_minute,
				'SELECTED' => ( $fixed_minute == $minute ) ? 'selected="selected"' : '' )
			);
		}

		// Get all the active seasons.
		$sql	= "SELECT * FROM " . SEASONS_TABLE . " WHERE season_status = 1";
		$result	= $db->sql_query ( $sql );

		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			// Assign each season to the template.
			$template->assign_block_vars ( 'block_seasons', array (
				'SEASON_ID' => $row[ 'season_id' ],
				'SEASON_NAME' => $row[ 'season_name' ],
				'SELECTED' => ( $tournament->data[ 'tournament_season' ] == $row[ 'season_id' ] ) ? 'selected="selected"' : '' )
			);
		}

		$db->sql_freeresult ( $result );

		// Get the groups signed up for this tournament (if its unstarted).
		if ( $tournament->data[ 'tournament_status' ] == 1 )
		{
			$sql	= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_tournament = $tournament_id AND group_bracket = 1";
			$result	= $db->sql_query ( $sql );

			while ( $row = $db->sql_fetchrow ( $result ) )
			{
				// 
				$template->assign_block_vars ( 'block_groups', array (
					'U_REMOVE' => $u_action . '&amp;remove_group=' . $row[ 'group_id' ] . '&amp;submit=1&amp;tournament_id=' . $tournament_id,
					'GROUP_NAME' => $group->group_name ( $group->data ( 'group_name', $row[ 'group_id' ] ) ) )
				);
			}
		}

		// Assign the other variables to the template.
		decode_message ( $tournament->data[ 'tournament_info' ], $tournament->data[ 'bbcode_uid' ] );
		$template->assign_vars ( array (
			'U_ACTION' => $u_action . '&amp;tournament_id=' . $tournament_id,
			'TOURNAMENT_NAME' => $tournament->data[ 'tournament_name' ],
			'TOURNAMENT_INFO' => $tournament->data[ 'tournament_info' ],
			'TOURNAMENT_BRACKETS' => $tournament->data[ 'tournament_brackets' ],
			'TOURNAMENT_ARCHIVE' => ( $tournament->data[ 'tournament_status' ] == 3 ) ? 'checked="checked"' : '' )
		);
	}
}

?>
