<?php
##############################################################
# FILENAME  : add_group.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# NOTES: Thanks, Mickroz for Group Logo fixes.
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

if ( !$user->data[ 'is_registered' ] )
{
	trigger_error ( 'LOGIN_INFO' );
}

$ladder		= new ladder ( );
$group		= new group ( );

include_once ( $phpbb_root_path . 'includes/functions_display.' . $phpEx );

// Are we submitting a form?
$submit	= request_var ( 'submit', '' );
if ( !empty ( $submit ) )
{
	// Check to see if the details have been entered.
	$group_name	= utf8_normalize_nfc ( request_var ( 'group_name', '', true ) );
	if ( !empty ( $group_name ) )
	{
		$group_logo		= request_var ( 'group_logo', '' );
		$group_desc		= $db->sql_escape ( utf8_normalize_nfc ( request_var ( 'group_desc', '', true ) ) );

		// Check for logo upload.
		if ( !empty ( $group_logo ) )
		{
			// Upload the logo for the group.
			$error	= array ( );
			list ( $avatar_type, $avatar, $avatar_width, $avatar_height ) = avatar_upload ( array (
				'uploadurl' => $group_logo,
				'user_id' => 3
			), $error );
		}
		else
		{
			// No logo, set blank.
			$avatar			= '';
			$avatar_type	= $avatar_width = $avatar_height = 0;
		}

		// Add the group.
		$group->add_group ( array (
			'group_name' => $group_name,
			'group_desc' => $group_desc,
			'group_tournaments' => '',
			'group_avatar' => $avatar,
			'group_avatar_type' => $avatar_type,
			'group_avatar_width' => $avatar_width,
			'group_avatar_height' => $avatar_height )
		);

		// Get the last group inserted.
		$sql	= "SELECT MAX(group_id) AS id FROM " . GROUPS_TABLE;
		$result	= $db->sql_query ( $sql );
		$row	= $db->sql_fetchrow ( $result );

		// Check to see if this is their first group.
		if ( $user->data[ 'group_session' ] == 0 )
		{
			// Set their group session.
			$sql	= "UPDATE " . USERS_TABLE . " SET group_session = {$row[ 'id' ]} WHERE user_id = " . $user->data[ 'user_id' ];
			$db->sql_query ( $sql );
		}

		// Add the leader to the group.
		$group->members ( 'add', $row[ 'id' ], $user->data[ 'user_id' ], 1 );

		// Completed. Let the user know.
		trigger_error ( 'GROUP_ADDED' );
	}
	else
	{
		// Enter details. Let the user know.
		trigger_error ( 'ENTER_GROUP_NAME' );
	}
}
else
{
	// Assign the other variable to the template.	
	$template->assign_vars ( array (
		'U_ACTION' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=add_group' ),
		'L_AVATAR_EXPLAIN' => sprintf ( $user->lang[ 'AVATAR_EXPLAIN' ], $config[ 'avatar_max_width' ], $config[ 'avatar_max_height' ], $config[ 'avatar_filesize' ] / 1024 ) )
	);
	$template->set_filenames ( array ( 'body' => 'factions/add_group.html' ) );
}

?>
