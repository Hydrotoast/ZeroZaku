<?php
##############################################################
# FILENAME  : tournaments.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

$group		= new group ( );
$tournament	= new tournament ( );
$ladder		= new ladder ( );

$start			= request_var ( 'start', 0 );
$season_id		= request_var ( 'season_id', 0 );
$tournament_id	= request_var ( 'tournament_id', 0 );

if ( !empty ( $tournament_id ) )
{
	// Check how many spots are free.
	$sql	= "SELECT COUNT(*) AS num_groups FROM " . TGROUPS_TABLE . " WHERE group_tournament = $tournament_id AND group_bracket = 1";
	$result	= $db->sql_query ( $sql );
	$row	= $db->sql_fetchrow ( $result );
	$db->sql_freeresult ( $result );

	if ( $row[ 'num_groups' ] >= 1 )
	{
		$math	= $tournament->data[ 'tournament_brackets' ] - $row[ 'num_groups' ];
	}
	else
	{
		$math	= $tournament->data[ 'tournament_brackets' ];
	}

	// Setup the BBcode for the tournament info.
	$info	= nl2br ( generate_text_for_display ( $tournament->data[ 'tournament_info' ], $tournament->data[ 'bbcode_uid' ], $tournament->data[ 'bbcode_bitfield' ], $tournament->data[ 'bbcode_options' ] ) );

	trigger_error ( sprintf ( $user->lang[ 'TOURNAMENT_SPOTS' ], $math, $info ) );
}

// Get all the public tournaments.
$sql	= "SELECT * FROM " . TOURNAMENTS_TABLE . " WHERE tournament_status <> 3 ORDER BY tournament_time DESC";
$result	= $db->sql_query ( $sql );

$i				= 0;
$show_signup	= true;
while ( $row = $db->sql_fetchrow ( $result ) )
{
	if ( !empty ( $group->data[ 'group_id' ] ) )
	{
		// Set the code up for it.
		$sql_2		= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_id = {$group->data[ 'group_id' ]} AND group_tournament = " . $row[ 'tournament_id' ];
		$result_2	= $db->sql_query ( $sql_2 );
		$row_2		= $db->sql_fetchrow ( $result_2 );
		$db->sql_freeresult ( $result_2 );

		// Count number of groups signed up.
		$sql_3		= "SELECT COUNT(*) AS num_groups FROM " . TGROUPS_TABLE . " WHERE group_tournament = {$row[ 'tournament_id' ]} AND group_bracket = 1";
		$result_3	= $db->sql_query ( $sql_3 );
		$row_3		= $db->sql_fetchrow ( $result_3 );
		$db->sql_freeresult ( $result_3 );

		if ( !empty ( $row_2[ 'group_id' ] ) )
		{
			$show_signup	= false;
		}
		else
		{
			if ( $row[ 'tournament_startdate' ] >= time ( ) )
			{
				if ( $row_3[ 'num_groups' ] >= $row[ 'tournament_brackets' ] )
				{
					$show_signup	= false;
				}
			}
			else if ( $row[ 'tournament_type' ] == 2 )
			{
				if ( !in_array ( $group->data[ 'group_id' ], unserialize ( (array) $row[ 'tournament_invite' ] ) ) )
				{
					$show_signup	= false;
				}
			}
		}
	}
	else
	{
		$show_signup	= false;
	}

	// Check if the tournament is assigned to a ladder.
	$tournament_ladder	= $tournament->data ( 'tournament_ladder', $row[ 'tournament_id' ] );
	if ( $tournament_ladder != 0 )
	{
		$tsubladder	= $ladder->data ( 'ladder_name', $tournament_ladder );

		// Get the ladder the sub-ladder is joined to.
		$sql_3		= "SELECT * FROM " . LADDERS_TABLE . " WHERE ladder_id = " . $ladder->data ( 'ladder_parent', $tournament_ladder );
		$result_3	= $db->sql_query ( $sql_3 );
		$row_3		= $db->sql_fetchrow ( $result_3 );
		$db->sql_freeresult ( $result_3 );
		$tladder	= $row_3[ 'ladder_name' ];

		// Get the platform the ladder is joined to.
		$sql_4		= "SELECT * FROM " . PLATFORMS_TABLE . " WHERE platform_id = " . $row_3[ 'ladder_platform' ];
		$result_4	= $db->sql_query ( $sql_4 );
		$row_4		= $db->sql_fetchrow ( $result_4 );
		$db->sql_freeresult ( $result_4 );
		$tplatform	= $row_4[ 'platform_name' ];
	}
	else
	{
		$tsubladder	= '-';
		$tladder	= '-';
		$tplatform	= '-';
	}

	// Assign each tournament to the template
	$template->assign_block_vars ( 'block_tournaments', array (
		'U_ACTION' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=tournaments_brackets&amp;tournament_id=' . $row[ 'tournament_id' ] ),
		'U_ACTION2' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=tournaments&amp;tournament_id=' . $row[ 'tournament_id' ] ),
		'U_ACTION3' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=tournaments_signup&amp;tournament_id=' . $row[ 'tournament_id' ] ),
		'TOURNAMENT_NAME' => $row[ 'tournament_name' ],
		'SHOW_SIGNUP' => $show_signup,
		'SHOW_INVITE' => ( !in_array ( $group->data[ 'group_id' ], (array) unserialize ( $row[ 'tournament_invite' ] ) ) && $tournament->data[ 'tournament_type' ] == 2 ) ? true : false,
		'TIME' => $user->format_date ( $row[ 'tournament_startdate' ], 'm/d/Y' ),
		'TOURNAMENT_STARTS' => $user->format_date ( $row[ 'tournament_startdate' ] ),
		'PLATFORM' => $tplatform,
		'LADDER' => $tladder,
		'SUBLADDER' => $tsubladder,
		'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
		'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2' )
	);

	$i++;
}

$db->sql_freeresult ( $result );

// Get all the archived tournaments.
$sql	= "SELECT * FROM " . TOURNAMENTS_TABLE . " WHERE tournament_status = 3 AND tournament_season = $season_id ORDER BY tournament_time DESC";
$result	= $db->sql_query_limit ( $sql, 10, $start );

$i	= 0;
while ( $row = $db->sql_fetchrow ( $result ) )
{
	// Check if the tournament is assigned to a ladder.
	$tournament_ladder	= $tournament->data ( 'tournament_ladder', $row[ 'tournament_id' ] );
	if ( $tournament_ladder != 0 )
	{
		$tsubladder	= $ladder->data ( 'ladder_name', $tournament_ladder );

		// Get the ladder the sub-ladder is joined to.
		$sql_3		= "SELECT * FROM " . LADDERS_TABLE . " WHERE ladder_id = " . $ladder->data ( 'ladder_parent', $tournament_ladder );
		$result_3	= $db->sql_query ( $sql_3 );
		$row_3		= $db->sql_fetchrow ( $result_3 );
		$db->sql_freeresult ( $result_3 );
		$tladder	= $row_3[ 'ladder_name' ];

		// Get the platform the ladder is joined to.
		$sql_4		= "SELECT * FROM " . PLATFORMS_TABLE . " WHERE platform_id = " . $row_3[ 'ladder_platform' ];
		$result_4	= $db->sql_query ( $sql_4 );
		$row_4		= $db->sql_fetchrow ( $result_4 );
		$db->sql_freeresult ( $result_4 );
		$tplatform	= $row_4[ 'platform_name' ];
	}
	else
	{
		$tsubladder	= '-';
		$tladder	= '-';
		$tplatform	= '-';
	}

	// Assign each tournament to the template
	$template->assign_block_vars ( 'block_archivedtournaments', array (
		'U_ACTION' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=tournaments_brackets&amp;tournament_id=' . $row[ 'tournament_id' ] ),
		'TOURNAMENT_NAME' => $row[ 'tournament_name' ],
		'TIME' => $user->format_date ( $row[ 'tournament_startdate' ], 'm/d/Y' ),
		'PLATFORM' => $tplatform,
		'LADDER' => $tladder,
		'SUBLADDER' => $tsubladder,
		'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
		'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2' )
	);

	$i++;
}

$db->sql_freeresult ( $result );

// Get all the active seasons.
$sql	= "SELECT s.*, td.* FROM " . SEASONS_TABLE . " s, " . TOURNAMENTS_TABLE . " td WHERE s.season_id = td.tournament_season GROUP BY s.season_id";
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

// Setup the pagination.
$sql	= "SELECT COUNT(tournament_id) AS total FROM " . TOURNAMENTS_TABLE . " WHERE tournament_status = 3";
$result	= $db->sql_query ( $sql );
$total	= $db->sql_fetchrow ( $result );
$db->sql_freeresult ( $result );

// Generate the pagination.
$pagination	= generate_pagination ( append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=tournaments' ), $total[ 'total' ], 10, $start );

// Get the season name.
$season_name	= '';
if ( $season_id != 0 )
{
	$sql	= "SELECT * FROM " . SEASONS_TABLE . " WHERE season_id = " . $season_id;
	$result	= $db->sql_query ( $sql );
	$row	= $db->sql_fetchrow ( $result );

	$season_name	= '(' . $row[ 'season_name' ] . ')';
}

// Assign the other variables to the template.
$template->assign_vars ( array (
	'U_ACTION' =>  append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=tournaments' ),
	'SEASON_NAME' => $season_name,
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => on_page ( $total[ 'total' ], 10, $start ) )
);

$template->set_filenames ( array ( 'body' => 'factions/tournaments.html' ) );

?>
