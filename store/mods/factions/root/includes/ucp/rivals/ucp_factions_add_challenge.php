<?php
##############################################################
# FILENAME  : ucp_factions_add_challenge.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Add a Challenge
 * Called from ucp_factions with mode == 'add_challenge'
 */
function ucp_factions_add_challenge ( $id, $mode, $u_action )
{
	global	$db, $user, $template, $config;
	global	$phpbb_root_path, $phpEx;

	$group	= new group ( );
	$ladder	= new ladder ( );

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		$challengee			= utf8_normalize_nfc ( request_var ( 'challengee', '' ) );
		$challenge_details	= utf8_normalize_nfc ( request_var ( 'challenge_details', '', true ) );
		$challenge_unranked	= request_var ( 'challenge_unranked', 0 );
		$ladder_id			= request_var ( 'ladder_id', 0 );

		// Get the challengee's group data.
		$sql	= "SELECT * FROM " . GROUPS_TABLE . " WHERE (group_name LIKE '%::$challengee' OR group_id = " . intval ( $challengee ) . ")";
		$result	= $db->sql_query ( $sql );
		$row	= $db->sql_fetchrow ( $result );
		$db->sql_freeresult ( $result );

		if ( sizeof ( $row ) == 0 )
		{
			// Challengee is not in the database.
			trigger_error ( 'NONEXISTANT_GROUP' );
		}
		else
		{
			// Chellengee is in the database. Get their record.
			$challengee	= $row[ 'group_id' ];
		} 

		// Compare the ladder chosen.
		$sql	= "SELECT * FROM " . GROUPDATA_TABLE . " WHERE group_ladder = $ladder_id AND group_id = " . $challengee;
		$result	= $db->sql_query ( $sql );
		$row	= $db->sql_fetchrow ( $result );
		$db->sql_freeresult ( $result );

		if ( sizeof ( $row ) == 0 )
		{
			// Challengee is not in the same ladder as the logged-in group.
			trigger_error ( 'NONEXISTANT_GROUP2' );
		}

		// If Swap is on, then check for 3 ranks above or below.
		if ( $ladder->data ( 'ladder_ranking', $group_ladder ) == 1 )
		{
			// Swap is on, check ranking.
			$challenger_rank	= $group->data ( 'group_current_rank', $group->data[ 'group_id' ], $ladder_id );
			$rank				= $group->data ( 'group_current_rank', $challengee, $ladder_id );

			if ( ( ( $rank - $challenger_rank ) >= -3 && ( $rank - $challenger_rank ) <= 0 ) || ( $challenger_rank - $rank ) <= 3 )
			{
				// Everything is OK.
			}
			else
			{
				// They are out of the ranking range. Let the user know.
				trigger_error ( 'RANKING_RANGE' );
			}
		}

		// Get all the groups owned by the user.
		$sql	= "SELECT gd.*, ud.user_id FROM " . GROUPS_TABLE . " gd, " . USER_GROUP_TABLE . " ud WHERE ud.group_leader = 1 AND ud.user_id = {$user->data[ 'user_id' ]} AND gd.group_id = ud.group_id";
		$result	= $db->sql_query ( $sql );

		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			if ( $challengee == $row[ 'group_id' ] )
			{
				// They are trying to challenge themself. Warn them.
				trigger_error ( 'CHEATER' );
			}
		}

		$db->sql_freeresult ( $result );

		// Finally. Insert the challenge.
		$sql_array	= array (
			'challenger' => $group->data[ 'group_id' ],
			'challengee' => $challengee,
			'challenge_unranked' => $challenge_unranked,
			'challenge_details' => $challenge_details,
			'challenge_posttime' => time ( ),
			'challenge_ladder' => $ladder_id
		);
		$sql		= "INSERT INTO " . CHALLENGES_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
		$db->sql_query ( $sql );

		// Get all the ladder's root details for the PM.
		$ladder_data	= $ladder->get_roots ( $ladder_id );

		// Send a PM to the challengee.
		$subject	= sprintf ( $user->lang[ 'PM_CHALLENGE' ], $group->group_name ( $group->data[ 'group_name' ] ) );
		$message	= sprintf ( ( $challenge_unranked == 0 ) ? $user->lang[ 'PM_CHALLENGETXT' ] : $user->lang[ 'PM_CHALLENGETXT2' ], $config[ 'server_protocol' ], $config[ 'server_name' ], $config[ 'script_path' ], $group->data[ 'group_id' ], $group->group_name ( $group->data[ 'group_name' ] ), $ladder_data[ 'PLATFORM_NAME' ], $ladder_data[ 'LADDER_NAME' ], $ladder_data[ 'SUBLADDER_NAME' ] );
		insert_pm ( $group->data ( 'user_id', $challengee ), $user->data, $subject, $message );

		// Completed. Let the user know.
		trigger_error ( 'CHALLENGE_ADDED' );
	}
	else
	{
		// Check if the group is apart of a ladder yet.
		if ( sizeof ( $group->data[ 'group_ladders' ] ) == 0 )
		{
			// They are not apart of a ladder. Deny them.
			trigger_error ( 'GROUP_NOTIN_LADDER' );
		}

		$group_id	= request_var ( 'group_id', 0 );

		foreach ( $group->data[ 'group_ladders' ] AS $value )
		{
			// Get the ladder's roots to show.
			$ladder_data	= $ladder->get_roots ( $value );

			// Check to see if the ladder is locked.
			if ( $ladder_data[ 'SUBLADDER_LOCKED' ] == 0 )
			{
				// Assign each ladder to the template.
				$template->assign_block_vars ( 'block_ladders', array (
					'LADDER_ID' => $value,
					'PLATFORM' => $ladder_data[ 'PLATFORM_NAME' ],
					'LADDER' => $ladder_data[ 'LADDER_NAME' ],
					'SUBLADDER' => $ladder_data[ 'SUBLADDER_NAME' ] )
				);
			}
		}

		// Assign the other variables to the template.
		$template->assign_vars ( array (
			'U_ACTION' => $u_action,
			'U_FIND_GROUP' => append_sid ( "{$phpbb_root_path}ucp.$phpEx", 'i=factions&amp;mode=find_group' ),
			'GROUP_ID' => ( $group_id != 0 ) ? $group_id : '' )
		);
	}
}

?>
