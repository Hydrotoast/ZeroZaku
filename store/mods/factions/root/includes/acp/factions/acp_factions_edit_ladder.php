<?php
##############################################################
# FILENAME  : acp_factions_edit_ladder.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Edit a Ladder
 * Called from acp_factions with mode == 'edit_ladder'
 */
function acp_factions_edit_ladder ( $id, $mode, $u_action )
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
		$delete		= request_var ( 'delete', 0 );

		// Are we deleting?
		if ( !empty ( $delete ) )
		{
			// Yes. Delete the ladder.
			$sql	= "DELETE FROM " . LADDERS_TABLE . " WHERE ladder_id = " . $ladder_id;
			$db->sql_query ( $sql );

			// Completed. Let the user know.
			trigger_error ( 'LADDER_UPDATED' );
		}

		$ladder_name	= utf8_normalize_nfc ( request_var ( 'ladder_name', '', true ) );
		$ladder_rules	= utf8_normalize_nfc ( request_var ( 'ladder_rules', '', true ) );

		// Setup the BBcode for the ladder rules.
		$uid			= $bitfield = $options = '';
		$allow_bbcode	= $allow_urls = $allow_smilies = true;
		generate_text_for_storage ( $ladder_rules, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies );

		// Update the ladder's data.
		$sql	= "UPDATE " . LADDERS_TABLE . " SET ladder_name = '$ladder_name', ladder_rules = '$ladder_rules', bbcode_uid = '$uid', bbcode_bitfield = '$bitfield', bbcode_options = $options WHERE ladder_id = " . $ladder_id;
		$db->sql_query ( $sql );

		// Completed. Let the user know.
		trigger_error ( 'LADDER_UPDATED' );
	}
	else
	{
		// Get the ladder's information.
		$ladder_data	= $ladder->data ( '*', $ladder_id );
		decode_message ( $ladder_data[ 'ladder_rules' ], $ladder_data[ 'bbcode_uid' ] );

		// Assign the information to the template.
		$template->assign_vars ( array (
			'U_ACTION' => $u_action,
			'LADDER_ID' => $ladder_id,
			'LADDER_NAME' => $ladder_data[ 'ladder_name' ],
			'LADDER_RULES' => $ladder_data[ 'ladder_rules' ] )
		);
	}
}

?>
