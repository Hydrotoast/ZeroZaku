<?php
##############################################################
# FILENAME  : acp_factions_add_tournament.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Add a Tournament
 * Called from acp_factions with mode == 'add_tournament'
 */
function acp_factions_add_tournament ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpbb_admin_path, $phpEx;

	$ladder		= new ladder ( );
	$tournament	= new tournament ( );
	$group		= new group ( );

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		// Yes, handle the form.
		$tournament_name		= utf8_normalize_nfc ( request_var ( 'tourn_name', '', true ) );
		$tournament_info		= utf8_normalize_nfc ( request_var ( 'tourn_info', '', true ) );
		$tournament_season		= request_var ( 'tourn_season', 0 );
		$tournament_brackets	= request_var ( 'tourn_brackets', 0 );
		$tournament_type		= request_var ( 'tourn_type', 0 );
		$tournament_dir			= request_var ( 'tourn_dir', 0 );
		$tournament_ladder		= request_var ( 'tourn_ladder', 0 );
		$tournament_startdate	= request_var ( 'tourn_startdate', array ( 0 => 0 ) );
		$tournament_invite		= request_var ( 'tourn_invite', '' );

		// Setup the BBcode for the ladder rules.
		$uid			= $bitfield = $options = '';
		$allow_bbcode	= $allow_urls = $allow_smilies = true;
		generate_text_for_storage ( $ladder_rules, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies );

		// Convert the start date to a UNIX timestamp.
		$start_date	= mktime ( $tournament_startdate[ 3 ], $tournament_startdate[ 4 ], 0, $tournament_startdate[ 0 ], $tournament_startdate[ 1 ], $tournament_startdate[ 2 ] );

		// Check if this is a invitational tournament.
		if ( !empty ( $tournament_invite ) )
		{
			$tournament_invite	= explode ( "\n", $tournament_invite );
			foreach ( $tournament_invite AS $value )
			{
				// Send a PM to the group leader telling them they were invited.
				$signup_url	= append_sid ( "{$phpbb_root_path}factions.$phpEx", "action=tournament_signup&amp;group_id={$group->data[ 'group_id' ]}" );

				$subject	= $user->lang[ 'PM_TOURNAMENTINVITE' ];
				$message	= sprintf ( $user->lang[ 'PM_TOURNAMENTINVITETXT' ], $tournament_name, $config[ 'server_protocol' ], $config[ 'server_name' ], $config[ 'script_path' ], $signup_url );
				insert_pm ( $group->data ( 'user_id', $value ), $user->data, $subject, $message );
			}

			$tournament_invite	= serialize ( $tournament_invite );
		}

		// Run the query to add the tournament.
		$sql_array	= array (
			'tournament_status' => 1,
			'tournament_name' => $tournament_name,
			'tournament_brackets' => $tournament_brackets,
			'tournament_info' => $tournament_info,
			'tournament_type' => $tournament_type,
			'tournament_direction' => $tournament_dir,
			'tournament_time' => time ( ),
			'tournament_invite' => $tournament_invite,
			'tournament_ladder' => $tournament_ladder,
			'tournament_finishedgroups' => '',
			'tournament_startdate' => $start_date,
			'tournament_season' => $tournament_season,
			'bbcode_uid' => $uid,
			'bbcode_options' => $options,
			'bbcode_bitfield' => $bitfield
		);
		$sql	= "INSERT INTO " . TOURNAMENTS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
		$db->sql_query ( $sql );

		// Completed. Let the user know.
		trigger_error ( 'TOURNAMENT_ADDED' );
	}
	else
	{
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
			// Assign the month to the template.
			$template->assign_block_vars ( 'block_months', array (
				'MONTH' => ( $key + 1 ),
				'MONTH_NAME' => $value )
			);
		}

		// Set the days for the start date.
		for ( $i = 1; $i <= 31; $i++ )
		{
			// Assign the day to the template.
			$template->assign_block_vars ( 'block_days', array (
				'DAY' => ( strlen ( $i ) == 1 ) ? '0' . $i : $i )
			);
		}

		// Set the years for the start date.
		for ( $i = date ( 'Y' ); $i < ( date ( 'Y' ) + 3 ); $i++ )
		{
			// Assign the year to the template.
			$template->assign_block_vars ( 'block_years', array (
				'YEAR' => $i )
			);
		}

		// Set the hours for the start date.
		for ( $i = 1; $i <= 24; $i++ )
		{
			// Assign the hour to the template.
			$template->assign_block_vars ( 'block_hours', array (
				'HOUR' => ( strlen ( $i ) == 1 ) ? '0' . $i : $i )
			);
		}

		// Set the minutes for the start date.
		for ( $i = 0; $i <= 55; $i += 5 )
		{
			// Assign the minute to the template.
			$template->assign_block_vars ( 'block_minutes', array (
				'MINUTE' => ( strlen ( $i ) == 1 ) ? '0' . $i : $i )
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
				'SEASON_NAME' => $row[ 'season_name' ] )
			);
		}

		$db->sql_freeresult ( $result );

		// Assign the other variables to the template.
		$template->assign_vars ( array ( 'U_ACTION' => $u_action ) );
	}
}

?>
