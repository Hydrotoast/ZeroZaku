<?php
##############################################################
# FILENAME  : ucp_factions_ticket.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Issue a Ticket
 * Called from ucp_factions with mode == 'ticket'
 */
function ucp_factions_ticket ( $id, $mode, $u_action )
{
	global	$config, $db, $user, $template;
	global	$phpbb_root_path, $phpEx;

	$group	= new group ( );
	$ladder	= new ladder ( );

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		// Yes, handle the form.
		$attachment	= $_FILES[ 'attachment' ];
		$type		= request_var ( 'type', '' );
		$ticket		= utf8_normalize_nfc ( request_var ( 'ticket', '', true ) );

		if ( !empty ( $attachment[ 'name' ] ) )
		{
			// Get the file's info for reference and checking.
			include ( $phpbb_root_path . 'includes/functions_upload.' . $phpEx );
			$upload = new fileupload ( 'FACTIONS_' );
			
			$upload->set_allowed_extensions ( array ( 'jpg', 'jpeg', 'png', 'tiff', 'pdf', 'gif', 'swf', 'mpeg', 'mpg', 'wmv', 'wav', 'avi', 'bmp' ) );
			
			$file = $upload->form_upload ( 'attachment' );
			$file->clean_filename ( 'unique_ext' );
			$file->move_file ( 'uploads/', false, false, CHMOD_READ );

			// Check if it was uploaded.
			if ( !$file->is_uploaded ( ) )
			{
				// Did not upload. Let the user know.
				trigger_error ( 'FACTIONS_FILE_NOT_UPLOADED' );
			}

			// Send a PM to the ticket receiver.
			$subject	= $user->lang[ 'PMTICKET' ] . ' (' . $type . ')';
			$message	= sprintf ( $user->lang[ 'PMTICKETTXT' ], $config[ 'server_protocol' ], $config[ 'server_name' ], $config[ 'script_path' ], $group->data[ 'group_id' ], $group->group_name ( $group->data[ 'group_name' ] ), $ticket, $config[ 'server_protocol' ], $config[ 'server_name' ], $config[ 'script_path' ], $file->realname );
		}
		else
		{
			// Send a PM to the ticket receiver.
			$subject	= $user->lang[ 'PMTICKET' ] . ' (' . $type . ')';
			$message	= sprintf ( $user->lang[ 'PMTICKETTXT' ], $config[ 'server_protocol' ], $config[ 'server_name' ], $config[ 'script_path' ], $group->data[ 'group_id' ], $group->data[ 'group_name' ], $ticket, '', '', '', '' );
		}

		insert_pm ( $config[ 'factions_ticketreceiver' ], $user->data, $subject, $message );

		// Completed. Let the user know.
		trigger_error ( 'TICKET_SENT' );
	}
	else
	{
		// Check if the group is apart of a ladder yet.
		if ( sizeof ( $group->data[ 'group_ladders' ] ) == 0 )
		{
			// They are not apart of a ladder. Deny them.
			trigger_error ( 'GROUP_NOTIN_LADDER' );
		}

		// Assign the other variables to the template.
		$template->assign_vars ( array ( 'U_ACTION' => $u_action ) );
	}
}

?>
