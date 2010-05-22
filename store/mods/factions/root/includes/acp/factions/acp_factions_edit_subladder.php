<?php
##############################################################
# FILENAME  : acp_factions_edit_subladder.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Edit a Sub-Ladder
 * Called from acp_factions with mode == 'edit_subladder'
 */
function acp_factions_edit_subladder ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpbb_admin_path, $phpEx;

	$ladder	= new ladder ( );

	$submit		= request_var ( 'submit', '' );
	$ladder_id	= request_var ( 'ladder_id', 0 );

	// Are we submitting a form?
	if ( !empty ( $submit ) )
	{
		// Yes, handle the form.
		$delete	= request_var ( 'delete', 0 );
		if ( !empty ( $delete ) )
		{
			// Delete the ladder.
			$sql	= "DELETE FROM " . LADDERS_TABLE . " WHERE ladder_id = " . $ladder_id;
			$db->sql_query ( $sql );

			// Now, remove the groups from the ladder.
			$sql	= "DELETE FROM " . GROUPDATA_TABLE . " WHERE group_ladder = " . $ladder_id;
			$db->sql_query ( $sql );

			// Completed. Let the user know.
			trigger_error ( 'LADDER_UPDATED' );
		}

		// Check if we are resetting the ladder stats.
		$ladder_reset	= request_var ( 'ladder_reset', 0 );
		if ( $ladder_reset != 0 )
		{
			// Reset everything for every group!
			$sql	= "UPDATE " . GROUPDATA_TABLE . " SET group_wins = 0, group_losses = 0, group_score = 1200, group_lastscore = 0, group_streak = 0, group_current_rank = 0, group_last_rank = 0, group_worst_rank = 0, group_best_rank = 0 WHERE group_ladder = " .  $ladder_id;
			$db->sql_query ( $sql );

			// Now, set their ranks!
			$sql	= "SELECT * FROM " . GROUPDATA_TABLE . " WHERE group_ladder = " . $ladder_id;
			$result	= $db->sql_query ( $sql );

			$i	= 1;
			while ( $row = $db->sql_fetchrow ( $result ) )
			{
				// Update their ranks.
				$sql_2		= "UPDATE " . GROUPDATA_TABLE . " SET group_current_rank = $i, group_last_rank = 0, group_best_rank = $i, group_worst_rank = $i WHERE group_id = {$row[ 'group_id' ]} AND group_ladder = " . $ladder_id;
				$db->sql_query ( $sql_2 );

				$i++;
			}
		}

		$ladder_name	= utf8_normalize_nfc ( request_var ( 'ladder_name', '', true ) );
		$ladder_desc	= utf8_normalize_nfc ( request_var ( 'ladder_desc', '', true ) );
		$ladder_locked	= request_var ( 'ladder_locked', 0 );
		$ladder_cl		= request_var ( 'ladder_cl', 0 );
		$ladder_ranking	= request_var ( 'ladder_ranking', 0 );
		$ladder_rm		= request_var ( 'ladder_rm', 0 );

		// Check to see if we switched systems.
		if ( $ladder_ranking == 1 && $ladder->data ( 'ladder_ranking', $ladder_id ) != 1 )
		{
			/* Switching from ELO to SWAP. You must keep the same placings for groups, to be fair, so this syncs the rankings and keeps them the same when switching from ELO to SWAP.*/

			// Order the groups by their ELO scoring.
			$sql	= "SELECT * FROM " . GROUPDATA_TABLE . " WHERE group_ladder = $ladder_id ORDER BY group_score DESC";
			$result	= $db->sql_query ( $sql );

			$i	= 1;
			while ( $row = $db->sql_fetchrow ( $result ) )
			{
				// Set the new ranks for the groups.
				$sql_2	= "UPDATE " . GROUPDATA_TABLE . " SET group_current_rank = $i, group_worst_rank = 0, group_best_rank = $i, group_last_rank = 0 WHERE group_id = " . $row[ 'group_id' ];
				$db->sql_query ( $sql_2 );

				$i++;
			}

			$db->sql_freeresult ( $sql );
		}

		// Setup the BBcode for the ladder description.
		$uid			= $bitfield = $options = '';
		$allow_bbcode	= $allow_urls = $allow_smilies = true;
		generate_text_for_storage ( $ladder_desc, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies );

		// Update the ladder.
		$sql	= "UPDATE " . LADDERS_TABLE . " SET ladder_name = '$ladder_name', ladder_desc = '$ladder_desc', ladder_locked = $ladder_locked, ladder_ranking = $ladder_ranking, ladder_cl = $ladder_cl, ladder_rm = $ladder_rm, bbcode_uid = '$uid', bbcode_bitfield = '$bitfield', bbcode_options = $options WHERE ladder_id = " . $ladder_id;
		$db->sql_query ( $sql );

		// Completed. Let the user know.
		trigger_error ( 'LADDER_UPDATED' );
	}
	else
	{
		// Get the ladder's information.
		$ladder_data	= $ladder->data ( '*', $ladder_id );
		decode_message ( $ladder_data[ 'ladder_desc' ], $ladder_data[ 'bbcode_uid' ] );

		// Assign the information to the template.
		$template->assign_vars ( array (
			'U_ACTION' => $u_action,
			'LADDER_ID' => $ladder_id,
			'LADDER_NAME' => $ladder_data[ 'ladder_name' ],
			'LADDER_DESC' => $ladder_data[ 'ladder_desc' ],
			'LADDER_PARENT' => $ladder_data[ 'ladder_id' ],
			'LADDER_RM'		=> $ladder_data[ 'ladder_rm' ],
			'LADDER_LOCKED' => ( $ladder_data[ 'ladder_locked' ] == 0 ) ? 'checked="checked"' : '',
			'LADDER_LOCKED2' => ( $ladder_data[ 'ladder_locked' ] == 1 ) ? 'checked="checked"' : '',
			'LADDER_CL' => ( $ladder_data[ 'ladder_cl' ] == 1 ) ? 'checked="checked"' : '',
			'LADDER_RANKING' => ( $ladder_data[ 'ladder_ranking' ] == 0 ) ? 'checked="checked"' : '',
			'LADDER_RANKING2' => ( $ladder_data[ 'ladder_ranking' ] == 1 ) ? 'checked="checked"' : '' )
		);
	}
}

?>
