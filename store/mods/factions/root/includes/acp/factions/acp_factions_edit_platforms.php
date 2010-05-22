<?php
##############################################################
# FILENAME  : acp_factions_edit_platforms.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Edit Platforms
 * Called from acp_factions with mode == 'edit_platforms'
 */
function acp_factions_edit_platforms ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpbb_admin_path, $phpEx;

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		// Yes, handle the form.
		$delete			= request_var ( 'delete', 0 );
		$platform_id	= request_var ( 'platform_id', 0 );

		// Are we deleting?
		if ( !empty ( $delete ) )
		{
			// Yes. Delete the platform.
			$sql	= "DELETE FROM " . PLATFORMS_TABLE . " WHERE platform_id = " . $platform_id;
			$db->sql_query ( $sql );

			// Completed. Let the user know.
			trigger_error ( 'PLATFORM_UPDATED' );
		}

		$platform_name	= utf8_normalize_nfc ( request_var ( 'platform_name', '', true ) );

		// Run the query to update the platform data.
		$sql	= "UPDATE " . PLATFORMS_TABLE . " SET platform_name = '$platform_name' WHERE platform_id = " . $platform_id;
		$db->sql_query ( $sql );

		// Completed. Let the user know.
		trigger_error ( 'PLATFORM_UPDATED' );
	}
	else
	{
		// Get the platform data.
		$sql	= "SELECT * FROM " . PLATFORMS_TABLE;
		$result	= $db->sql_query ( $sql );

		$i	= 0;
		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			// Assign each platform to the template.
			$template->assign_block_vars ( 'block_platforms', array (
				'U_ACTION' => $u_action,
				'PLATFORM_ID' => $row[ 'platform_id' ],
				'PLATFORM_NAME' => $row[ 'platform_name' ] )
			);

			$i++;
		}

		$db->sql_freeresult ( $result );
	}
}

?>
