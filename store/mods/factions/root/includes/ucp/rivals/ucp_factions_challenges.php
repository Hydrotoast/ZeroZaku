<?php
##############################################################
# FILENAME  : ucp_factions_challenges.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Manage Challenges
 * Called from ucp_factions with mode == 'challenges'
 */
function ucp_factions_challenges ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpEx;

	$group	= new group ( );
	$ladder	= new ladder ( );

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		$accept		= request_var ( 'accept', array ( 0 => 0 ) );
		$decline	= request_var ( 'decline', array ( 0 => 0 ) );

		if ( !empty ( $accept ) )
		{
			foreach ( $accept AS $value )
			{
				// Get the challenge detials.
				$sql	= "SELECT * FROM " . CHALLENGES_TABLE . " WHERE challenge_id = " . $value;
				$result	= $db->sql_query ( $sql );
				$row	= $db->sql_fetchrow ( $result );
				$db->sql_freeresult ( $result );

				// Accept the challenge. "Move" the challenge to the matches table.
				$sql_array	= array (
					'match_challenger' => $row[ 'challenger' ],
					'match_challengee' => $row[ 'challengee' ],
					'match_posttime' => $row[ 'challenge_posttime' ],
					'match_unranked' => $row[ 'challenge_unranked' ],
					'match_details' => '',
					'match_ladder' => $row[ 'challenge_ladder' ]
				);
				$sql		= "INSERT INTO " . MATCHES_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
				$db->sql_query ( $sql );

				// Delete the challenge, its now a match.
				$sql	= "DELETE FROM " . CHALLENGES_TABLE . " WHERE challenge_id = " . $value;
				$db->sql_query ( $sql );

				// Send a PM to the challenger's group leader telling them it was accepted.
				$subject	= $user->lang[ 'PM_CHALLENGEACCEPTED' ];
				$message	= sprintf ( $user->lang[ 'PM_CHALLENGEACCEPTEDTXT' ], $group->group_name ( $group->data[ 'group_name' ] ) );
				insert_pm ( $group->data ( 'user_id', $row[ 'challenger' ] ), $user->data, $subject, $message );
			}
		}

		if ( !empty ( $decline ) )
		{
			foreach ( $decline AS $value )
			{
				// Get the challenge details.
				$sql	= "SELECT * FROM " . CHALLENGES_TABLE . " WHERE challenge_id = " . $value;
				$result	= $db->sql_query ( $sql );
				$row	= $db->sql_fetchrow ( $result );
				$db->sql_freeresult ( $result );

				// Decline the challenge. Delete it.
				$sql	= "DELETE FROM " . CHALLENGES_TABLE . " WHERE challenge_id = " . $value;
				$db->sql_query ( $sql );

				// Send a PM to the challenger's group leader and to the logged in group.
				$subject	= $user->lang[ 'PM_CHALLENGEDECLINED' ];
				$message	= sprintf ( $user->lang[ 'PM_CHALLENGEDECLINEDTXT' ], $group->group_name ( $group->data[ 'group_name' ] ) );
				insert_pm ( $group->data ( 'user_id', $row[ 'challenger' ] ), $user->data, $subject, $message );
			}
		}

		// Completed. Let the user know.
		trigger_error ( 'CHALLENGES_UPDATED' );
	}
	else
	{
		// Check if the group is apart of a ladder yet.
		if ( sizeof ( $group->data[ 'group_ladders' ] ) == 0 )
		{
			// They are not apart of a ladder. Deny them.
			trigger_error ( 'GROUP_NOTIN_LADDER' );
		}

		foreach ( $group->data[ 'group_ladders' ] AS $value )
		{
			// Get the ladder's root detials to show.
			$ladder_data	= $ladder->get_roots ( $value );

			// Check to see if the ladder is locked.
			if ( $ladder_data[ 'SUBLADDER_LOCKED' ] == 0 )
			{
				// Assign each ladder to the template.
				$template->assign_block_vars ( 'block_ladders', array (
					'PLATFORM' => $ladder_data[ 'PLATFORM_NAME' ],
					'LADDER' => $ladder_data[ 'LADDER_NAME' ],
					'SUBLADDER' => $ladder_data[ 'SUBLADDER_NAME' ] )
				);

				// Get the challenges for this ladder and group.
				$sql	= "SELECT * FROM " . CHALLENGES_TABLE . " WHERE challengee = {$group->data[ 'group_id' ]} AND challenge_ladder = $value ORDER BY challenge_posttime DESC";
				$result	= $db->sql_query ( $sql );

				$i	= 0;
				while ( $row = $db->sql_fetchrow ( $result ) )
				{
					// Assign each challenge to the template.
					$template->assign_block_vars ( 'block_ladders.block_challenges', array (
						'U_CHALLENGER' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=group_profile&amp;group_id=' . $row[ 'challenger' ] ),
						'CHALLENGER' => $group->group_name ( $group->data ( 'group_name', $row[ 'challenger' ] ) ),
						'TIME' => $user->format_date ( $row[ 'challenge_posttime' ] ),
						'DETAILS' => nl2br ( $row[ 'challenge_details' ] ),
						'CHALLENGE_ID' => $row[ 'challenge_id' ],
						'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
						'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2' )
					);

					$i++;
				}

				$db->sql_freeresult ( $result );
			}
		}

		// Assign the other variables to the template.
		$template->assign_vars ( array ( 'U_ACTION' => $u_action ) );
	}
}

?>
