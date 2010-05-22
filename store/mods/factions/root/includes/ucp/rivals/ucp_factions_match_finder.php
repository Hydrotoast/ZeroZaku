<?php
##############################################################
# FILENAME  : ucp_factions_match_finder.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

define ( 'SEARCH_MATCH', 1 );
define ( 'ADD_MATCH', 2 );

/**
 * Match Finder
 * Called from ucp_factions with mode == 'match_finder'
 */
function ucp_factions_match_finder ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpEx;

	$group	= new group ( );
	$ladder	= new ladder ( );

	// Are we submitting a form?
	$match_type	= request_var ( 'match_type', 0 );
	if ( $match_type == ADD_MATCH )
	{
		$match_time		= request_var ( 'match_time', 0 );
		$group_ladder	= request_var ( 'group_ladder', 0 );

		// Insert the group into the match finder.
		$sql_array	= array (
			'match_groupid' => $group->data[ 'group_id' ],
			'match_ladder' => $group_ladder,
			'match_time' => $match_time,
			'match_initaltime' => time ( )
		);
		$sql		= "INSERT INTO " . MATCHFINDER_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
		$db->sql_query ( $sql );

		// Completed. Let the user know.
		trigger_error ( 'MATCH_FINDER_ADDED' );
	}
	else
	{
		// Check if the group is apart of a ladder yet.
		if ( sizeof ( $group->data[ 'group_ladders' ] ) == 0 )
		{
			// They are not apart of a ladder. Deny them.
			trigger_error ( 'GROUP_NOTIN_LADDER' );
		}

		if ( $match_type == SEARCH_MATCH )
		{
			$match_time	= request_var ( 'match_time', 0 );

			// Get the groups open for a challenge during this time.
			$sql	= "SELECT * FROM " . MATCHFINDER_TABLE . " WHERE match_time <= $match_time AND match_ladder IN(" . implode ( ',', $group->data[ 'group_ladders' ] ) . ") AND match_groupid <> {$group->data[ 'group_id' ]} ORDER BY match_time DESC";
			$result	= $db->sql_query ( $sql );

			$i	= 0;
			while ( $row = $db->sql_fetchrow ( $result ) )
			{
				$match_expiretime	= date ( 'i', ( $row[ 'match_initaltime' ] + ( 60 * $row[ 'match_time' ] ) ) );
				if ( date ( 'i', time ( ) ) >= $match_expiretime )
				{
					// Group is past it's set match time. Remove the expired match finder entry.
					$sql	= "DELETE FROM " . MATCHFINDER_TABLE . " WHERE match_id = " . $row[ 'match_id' ];
					$db->sql_query ( $sql );
				}
				else
				{
					// Assign each group to the template.
					$group_data	= $group->data ( '*', $row[ 'match_groupid' ] );
					$template->assign_block_vars ( 'block_matchtime.block_groups', array (
						'U_GROUP' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'group_profile&amp;group_id=' . $row[ 'match_groupid' ] ),
						'U_CHALLENGE' => append_sid ( "{$phpbb_root_path}ucp.$phpEx", 'i=factions&amp;mode=add_challenge&amp;group_id=' . $row[ 'match_groupid' ] ),
						'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
						'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2',
						'GROUP_NAME' => $group->group_name ( $group_data[ 'group_name' ] ),
						'GROUP_WINS' => $group_data[ 'group_wins' ],
						'GROUP_LOSSES' => $group_data[ 'group_losses' ],
						'GROUP_STREAK' => $group_data[ 'group_streak' ] )
					);

					$i++;
				}
			}

			$db->sql_freeresult ( $result );
	
			if ( $i == 0 )
			{
				// No groups found. Let the user know.
				trigger_error ( 'NO_GROUPS_FOUND' );
			}
		}
		else
		{
			// Build the minutes box.
			for ( $i = 5; $i <= 60; $i += 5 )
			{
				// Assign each minute time to the template.
				$template->assign_block_vars ( 'block_minutes', array ( 'MINUTE' => $i ) );
			}

			// Build the ladder list.
			foreach ( $group->data[ 'group_ladders' ] AS $value )
			{
				// Get the ladder's root detials to show.
				$ladder_data	= $ladder->get_roots ( $value );

				// Check to see if the ladder is locked.
				if ( $ladder_data[ 'SUBLADDER_LOCKED' ] == 0 )
				{
					// Assign each ladder to the template.
					$template->assign_block_vars ( 'block_ladders', array (
						'SUBLADDER_ID' => $value,
						'PLATFORM' => $ladder_data[ 'PLATFORM_NAME' ],
						'LADDER' => $ladder_data[ 'LADDER_NAME' ],
						'SUBLADDER' => $ladder_data[ 'SUBLADDER_NAME' ] )
					);
				}
			}
		}

		// Assign the other variables to the template.
		$template->assign_vars ( array ( 'U_ACTION' => $u_action ) );
	}
}

?>
