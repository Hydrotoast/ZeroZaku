<?php
##############################################################
# FILENAME  : acp_factions_add_season.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Add a Season
 * Called from acp_factions with mode == 'add_season'
 */
function acp_factions_add_season ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpbb_admin_path, $phpEx;

	$ladder		= new ladder ( );
	$ladder_id	= request_var ( 'ladder_id', 0 );

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		// Yes, handle the form. Start the season.
		$season_name	= utf8_normalize_nfc ( request_var ( 'season_name', '', true ) );

		// Add the season to the database.
		$sql_array	= array (
			'season_id' => NULL,
			'season_name' => $season_name,
			'season_ladder' => $ladder_id,
			'season_status' => 1
		);
		$sql	= "INSERT INTO " . SEASONS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
		$db->sql_query ( $sql );

		// Completed. Let the user know.
		trigger_error ( 'SEASON_STARTED' );
	}
	else
	{
		// Assign the other variables to the template.
		$template->assign_vars ( array (
			'U_ACTION' => $u_action,
			'LADDER_ID' => $ladder_id )
		);
	}
}

?>
