<?php
##############################################################
# FILENAME  : acp_factions_add_platform.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Add a Platform
 * Called from acp_factions with mode == 'add_platform'
 */
function acp_factions_add_platform ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpbb_admin_path, $phpEx;

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		// Yes, handle the form.
		$platform_name	= utf8_normalize_nfc ( request_var ( 'platform_name', '', true ) );

		// Run the query to add the platform.
		$sql_array	= array (
			'platform_name' => $platform_name
		);
		$sql	= "INSERT INTO " . PLATFORMS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
		$db->sql_query ( $sql );

		// Completed. Let the user know.
		trigger_error ( 'PLATFORM_ADDED' );
	}
	else
	{
		// Assign the other variables to the template.
		$template->assign_vars ( array ( 'U_ACTION' => $u_action ) );
	}
}

?>
