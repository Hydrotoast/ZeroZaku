<?php
##############################################################
# FILENAME  : ucp_factions_edit_group.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# NOTES: Thanks, Mickroz for Group Logo fixes.
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Edit Group
 * Called from ucp_factions with mode == 'edit_group'
 */
function ucp_factions_edit_group ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpEx;

	$group	= new group ( );
	$ladder	= new ladder ( );

	include_once ( $phpbb_root_path . 'includes/functions_display.' . $phpEx );

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		$group_delete	= request_var ( 'group_delete', 0 );
		if ( $group_delete != 0 )
		{
			// Try to set the user's group session to another group they own.
			$sql	= "SELECT gd.*, ud.user_id FROM " . GROUPS_TABLE . " gd, " . USER_GROUP_TABLE . " ud WHERE ud.group_leader = 1 AND ud.user_id = {$user->data[ 'user_id' ]} AND ud.group_id = gd.group_id AND gd.group_type = " . GROUP_HIDDEN . " AND gd.group_id <> " . (int) $group->data[ 'group_id' ];
			$result	= $db->sql_query ( $sql );
			$row	= $db->sql_fetchrow ( $result );
			$db->sql_freeresult ( $result );

			if ( !empty ( $row[ 'group_id' ] ) )
			{
				$sql	= "UPDATE " . USERS_TABLE . " SET group_session = {$row[ 'group_id' ]} WHERE user_id = " . $user->data[ 'user_id' ];
				$db->sql_query ( $sql );
			}
			else
			{
				$sql	= "UPDATE " . USERS_TABLE . " SET group_session = 0 WHERE user_id = " . $user->data[ 'user_id' ];
				$db->sql_query ( $sql );
			}

			// Delete the group's data.
			$sql	= "DELETE FROM " . GROUPDATA_TABLE . " WHERE group_id = " . $group->data[ 'group_id' ];
			$db->sql_query ( $sql );

			// Delete the group.
			group_delete ( $group->data[ 'group_id' ] );

			// Completed. Let the user know.
			trigger_error ( $user->lang[ 'factions_cu' ] );
		}

		$group_name		= utf8_normalize_nfc ( request_var ( 'group_name', '', true ) );
		$group_desc		= utf8_normalize_nfc ( request_var ( 'group_desc', '', true ) );
		$group_logo		= request_var ( 'group_logo', '' );

		// Check if a user has entered a clan name if not return the error
		if ( empty ( $group_name ) )
		{
			trigger_error ( 'ENTER_GROUP_NAME' );
		}

		// Are we updating the clan logo?
		if ( !empty ( $group_logo ) )
		{
			// Check if logo is the same.
			if ( $group->data[ 'group_logo' ] != $group_logo )
			{
				// Its not, upload the new one.
				list ( $avatar_type, $avatar, $avatar_width, $avatar_height ) = avatar_upload ( array (
					'uploadurl' => $group_logo,
					'user_id' => 3
				), $error );
			}
			else
			{
				// It is, get the data.
				$avatar			= $group->data[ 'group_avatar' ];
				$avatar_type	= $group->data[ 'group_avatar_type' ];
				$avatar_width	= $group->data[ 'group_avatar_width' ];
				$avatar_height	= $group->data[ 'group_avatar_height' ];
			}
		}
		else
		{
			// Deleteing or leaving blank.
			$avatar			= '';
			$avatar_type	= $avatar_width = $avatar_height = 0;
		}

		// Edit the group.
		$group->edit_group ( $group->data[ 'group_id' ], array (
			'group_name' => $group_name,
			'group_desc' => $group_desc,
			'group_avatar' => $avatar,
			'group_avatar_type' => $avatar_type,
			'group_avatar_width' => $avatar_width,
			'group_avatar_height' => $avatar_height )
		);

		// Completed. Let the user know.
		trigger_error ( 'GROUP_UPDATED' );
	}
	else
	{
		// Get the group's avatar.
		$avatar_img	= get_user_avatar ( $group->data[ 'group_avatar' ], $group->data[ 'group_avatar_type' ], $group->data[ 'group_avatar_width' ], $group->data[ 'group_avatar_height' ], 'GROUP_AVATAR' );

		// Assign the other variables to the template.
		decode_message ( $group->data[ 'group_desc' ], $group->data[ 'group_desc_uid' ] );
		$template->assign_vars ( array (
			'U_ACTION' => $u_action,
			'GROUP_AVATAR' => $avatar_img,
			'L_AVATAR_EXPLAIN' => sprintf ( $user->lang[ 'AVATAR_EXPLAIN' ], $config[ 'avatar_max_width' ], $config[ 'avatar_max_height' ], $config[ 'avatar_filesize' ] / 1024 ),
			'GROUP_DESC' => $group->data[ 'group_desc' ],
			'GROUP_NAME' => $group->group_name ( $group->data[ 'group_name' ] ) )
		);
	}
}

?>
