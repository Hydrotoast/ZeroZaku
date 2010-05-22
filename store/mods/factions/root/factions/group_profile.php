<?php
##############################################################
# FILENAME  : group_profile.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

$group		= new group ( );
$ladder		= new ladder ( );

$group_id		= request_var ( 'group_id', 0 );
$season_id		= request_var ( 'season_id', 0 );
$season_ladder	= request_var ( 'season_ladder', 0 );
$group_data		= $group->data ( '*', $group_id );

include_once ( $phpbb_root_path . 'includes/functions_display.' . $phpEx );

// Get the leader's data.
$sql	= "SELECT * FROM " . USERS_TABLE . " WHERE user_id = " . $group_data[ 'user_id' ];
$result	= $db->sql_query ( $sql );
$row	= $db->sql_fetchrow ( $result );
$db->sql_freeresult ( $result );

// Assign the leader's data to the template.
$template->assign_vars ( array (
	'U_LEADERPROFILE' => append_sid ( "{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $row[ 'user_id' ] ),
	'U_CHALLENGE' => ( $group_data[ 'user_id' ] != $user->data[ 'user_id' ] ) ? append_sid ( "{$phpbb_root_path}ucp.$phpEx", 'i=factions&amp;mode=add_challenge&amp;group_id=' . $group_id ) : '',
	'LEADER_NAME' => $row[ 'username' ] )
);

// Get the list of group members for the group.
$members	= (array) $group->members ( 'get_members', $group_id );
$i			= 0;
if ( sizeof ( $members ) > 0 )
{
	foreach ( $members AS $value )
	{
		// Get the member's data.
		$sql		= "SELECT * FROM " . USERS_TABLE . " WHERE user_id = " . $value;
		$result		= $db->sql_query ( $sql );
		$row		= $db->sql_fetchrow ( $result );
		$db->sql_freeresult ( $result );

		// Assign the member's data to the template.
		$template->assign_block_vars ( 'block_members', array (
			'U_MEMBERPROFILE' => append_sid ( "{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $row[ 'user_id' ] ),
			'MEMBER_NAME' => $row[ 'username' ],
			'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2' )
		);

		$i++;
	}
}

// Get the on-going and finished matches from the database.
$sql	= "SELECT m.*, l.* FROM " . MATCHES_TABLE . " m, " . LADDERS_TABLE . " l WHERE (m.match_challenger = $group_id OR m.match_challengee = $group_id) AND m.match_ladder = l.ladder_id ORDER BY m.match_id DESC";
$result	= $db->sql_query ( $sql );

$i	= 0;
while ( $row = $db->sql_fetchrow ( $result ) )
{
	// Get the ladder's roots.
	$ladder_data	= $ladder->get_roots ( $row[ 'match_ladder' ] );

	// Assign each match to the template.
	$template->assign_block_vars ( 'block_matchhistory', array (
		'PLATFORM' => $ladder_data[ 'PLATFORM_NAME' ],
		'LADDER' => $ladder_data[ 'LADDER_NAME' ],
		'SUBLADDER' => $ladder_data[ 'SUBLADDER_NAME' ],
		'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2',
		'STATUS' => ( $row[ 'match_finishtime' ] > 0 ) ? $user->lang[ 'FINISHED' ] : $user->lang[ 'ONGOING' ],
		'DATE' => ( $row[ 'match_finishtime' ] > 0 ) ? $user->format_date ( $row[ 'match_finishtime' ] ) : $user->format_date ( $row[ 'match_posttime' ] ),
		'CHALLENGER' => ( $row[ 'match_challenger' ] == $group_id ) ? '<strong>' . $group->group_name ( $group->data ( 'group_name', $row[ 'match_challenger' ] ) ) . '</strong>' : $group->group_name ( $group->data ( 'group_name', $row[ 'match_challenger' ] ) ),
		'CHALLENGEE' => ( $row[ 'match_challengee' ] == $group_id ) ? '<strong>' . $group->group_name ( $group->data ( 'group_name', $row[ 'match_challengee' ] ) ) . '</strong>' : $group->group_name ( $group->data ( 'group_name', $row[ 'match_challengee' ] ) ),
		'WINNER' => ( $row[ 'match_finishtime' ] > 0 ) ? $group->group_name ( $group->data ( 'group_name', $row[ 'match_winner' ] ) ) : '-' )
	);

	$i++;
}

$db->sql_freeresult ( $result );

// Check if we need to show the "Request to Join".
if ( !in_array ( $user->data[ 'user_id' ], $members ) && $user->data[ 'user_id' ] != $group->data[ 'user_id' ] )
{
	// The user is not in the group so show the message.
	$template->assign_block_vars ( 'block_request', array ( 'U_REQUEST' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=join_group&amp;type=1&amp;group_id=' . $group_id ) ) );
}

// Get the ladders the group is joined to.
$sql	= "SELECT * FROM " . GROUPDATA_TABLE . " WHERE group_id = " . $group_id;
$result	= $db->sql_query ( $sql );

while ( $row = $db->sql_fetchrow ( $result ) )
{
	// Get the ladder's roots.
	$ladder_data	= $ladder->get_roots ( $row[ 'group_ladder' ] );

	// Get the season for this ladder.
	$sql_2		= "SELECT * FROM " . SEASONS_TABLE . " WHERE season_ladder = {$row[ 'group_ladder' ]} AND season_status = 1";
	$result_2	= $db->sql_query ( $sql_2 );
	$row_2		= $db->sql_fetchrow ( $result_2 );
	$db->sql_freeresult ( $result_2 );

	// Check where to get the data.
	if ( $season_id != 0 && $season_ladder == $row[ 'group_ladder' ] )
	{
		// User selected to see archived season data.
		$sql_2		= "SELECT * FROM " . SEASONS_TABLE . " WHERE season_id = " . $season_id;
		$result_2	= $db->sql_query ( $sql_2 );
		$row_2		= $db->sql_fetchrow ( $result_2 );
		$db->sql_freeresult ( $result_2 );

		$sql_3		= "SELECT * FROM " . SEASONDATA_TABLE . " WHERE season_id = $season_id AND group_id = " . $group_id;
		$result_3	= $db->sql_query ( $sql_3 );
		$data		= $db->sql_fetchrow ( $result_3 );
		$db->sql_freeresult ( $result_3 );
	}
	else
	{
		// User needs to see the current season.
		$data	= $row;
	}

	// Assign the ladder and the stats to the template.
	$template->assign_block_vars ( 'block_ladders', array (
		'U_ACTION' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=group_profile&amp;group_id=' . $group_id ),
		'SEASON_NAME' => ( !empty ( $row_2[ 'season_name' ] ) ) ? $row_2[ 'season_name' ] : $user->lang[ 'CURRENT_SEASON' ],
		'PLATFORM' => $ladder_data[ 'PLATFORM_NAME' ],
		'LADDER' => $ladder_data[ 'LADDER_NAME' ],
		'SUBLADDER_ID' => $ladder_data[ 'SUBLADDER_ID' ],
		'SUBLADDER' => $ladder_data[ 'SUBLADDER_NAME' ],
		'GROUP_WINS' => $data[ 'group_wins' ],
		'GROUP_LOSSES' => $data[ 'group_losses' ],
		'GROUP_STREAK' => $data[ 'group_streak' ],
		'GROUP_SCORE' => $data[ 'group_score' ],
		'CURRENT_RANK' => $data[ 'group_current_rank' ],
		'LAST_RANK' => $data[ 'group_last_rank' ],
		'BEST_RANK' => $data[ 'group_best_rank' ],
		'WORST_RANK' => $data[ 'group_worst_rank' ] )
	);

	// Get all the seasons for this ladder.
	$sql_4		= "SELECT s.*, sd.* FROM " . SEASONS_TABLE . " s, " . SEASONDATA_TABLE . " sd WHERE s.season_ladder = {$row[ 'group_ladder' ]} AND sd.group_ladder = {$row[ 'group_ladder' ]} AND sd.group_id = " . $group_id;
	$result_4	= $db->sql_query ( $sql_4 );

	while ( $row_4 = $db->sql_fetchrow ( $result_4 ) )
	{
		// Assign each season to the template.
		$template->assign_block_vars ( 'block_ladders.block_seasons', array (
			'SEASON_ID' => $row_4[ 'season_id' ],
			'SEASON_NAME' => $row_4[ 'season_name' ] )
		);
	}

	$db->sql_freeresult ( $result_4 );
}

$db->sql_freeresult ( $result );

// Setup the BBcode for the group description.
$desc	= nl2br ( generate_text_for_display ( $group_data[ 'group_desc' ], $group_data[ 'group_desc_uid' ], $group_data[ 'group_desc_bitfield' ], $group_data[ 'group_desc_options' ] ) );

// Assign the other variables to the template.
$template->assign_vars ( array (
	'GROUP_ID' => $group_id,
	'GROUP_LOGO' => get_user_avatar ( $group_data[ 'group_avatar' ], $group_data[ 'group_avatar_type' ], $group_data[ 'group_avatar_width' ], $group_data[ 'group_avatar_height' ], 'GROUP_AVATAR' ),
	'GROUP_NAME' => $group->group_name ( $group_data[ 'group_name' ] ),
	'GROUP_DESC' => ( !empty ( $desc ) ) ? $desc : '-' )
);

$template->set_filenames ( array ( 'body' => 'factions/group_profile.html' ) );

?>
