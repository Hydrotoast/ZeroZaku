<?php
##############################################################
# FILENAME  : acp_factions_configure.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Configure Factions
 * Called from acp_factions with mode == 'configure'
 */
function acp_factions_configure ( $id, $mode, $u_action )
{
	global	$db, $user, $template, $config;
	global	$phpbb_root_path, $phpbb_admin_path, $phpEx;

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		// Yes, handle the form.
		$ticket_receiver	= request_var ( 'ticket_receiver', 0 );
		$bye_group			= request_var ( 'bye_group', 0 );

		// Update options.
		set_config ( 'factions_ticketreceiver', $ticket_receiver );
		set_config ( 'factions_byegroup', $bye_group );

		// Completed. Let the user know.
		trigger_error ( 'CONFIGUREATION_UPDATED' );
	}
	else
	{
		$template->assign_vars ( array (
			'U_ACTION' => $u_action,
			'CONFIG' => $config[ 'factions_ticketreceiver' ],
			'BYE_GROUP' => $config[ 'factions_byegroup' ] )
		);
	}
}

?>
