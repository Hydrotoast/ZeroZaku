<?php
##############################################################
# FILENAME  : acp_factions_add_ladder.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Add a Ladder
 * Called from acp_factions with mode == 'add_ladder'
 */
function acp_factions_add_ladder ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpbb_admin_path, $phpEx;

	$ladder	= new ladder ( );

	// Are we submitting a form?
	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		// Yes, handle the form.
		$ladder_type	= request_var ( 'ladder_type', 0 );
		if ( $ladder_type == 0 )
		{
			// Handling a ladder...
			$ladder_name		= utf8_normalize_nfc ( request_var ( 'ladder_name', '', true ) );
			$ladder_rules		= utf8_normalize_nfc ( request_var ( 'ladder_rules', '', true ) );
			$ladder_platform	= request_var ( 'ladder_platform', 0 );

			// Setup the BBcode for the ladder rules.
			$uid			= $bitfield = $options = '';
			$allow_bbcode	= $allow_urls = $allow_smilies = true;
			generate_text_for_storage ( $ladder_rules, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies );

			//Get the largest ladder order.
			$sql	= "SELECT MAX(ladder_order) AS lo FROM " . LADDERS_TABLE . " WHERE ladder_parent = 0";
			$result	= $db->sql_query ( $sql );
			$row	= $db->sql_fetchrow ( $result );
			$db->sql_freeresult ( $result );

			// Set up the SQL to add the ladder.
			$sql_array	= array (
				'ladder_name' => $ladder_name,
				'ladder_platform' => $ladder_platform,
				'ladder_rules' => $ladder_rules,
				'ladder_order' => $row[ 'lo' ] + 1,
				'ladder_desc' => '',
				'subladder_order' => 0,
				'bbcode_uid' => $uid,
				'bbcode_bitfield' => $bitfield,
				'bbcode_options' => $options
			); 
			$sql	= "INSERT INTO " . LADDERS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
			$db->sql_query ( $sql );
		}
		else
		{
			// Handling a sub-ladder.
			$ladder_name	= utf8_normalize_nfc ( request_var ( 'ladder_name', '', true ) );
			$ladder_desc	= utf8_normalize_nfc ( request_var ( 'ladder_desc', '', true ) );
			$ladder_cl		= request_var ( 'ladder_cl', 0 );
			$ladder_parent	= request_var ( 'ladder_parent', 0 );
			$ladder_ranking	= request_var ( 'ladder_ranking', 0 );
			$ladder_rm		= request_var ( 'ladder_rm', 0 );

			// Setup the BBcode for the ladder description.
			$uid			= $bitfield = $options = '';
			$allow_bbcode	= $allow_urls = $allow_smilies = true;
			generate_text_for_storage ( $ladder_desc, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies );

			//Get the largest ladder order.
			$sql	= "SELECT MAX(subladder_order) AS lo FROM " . LADDERS_TABLE . " WHERE ladder_parent = " . $ladder_parent;
			$result	= $db->sql_query ( $sql );
			$row	= $db->sql_fetchrow ( $result );
			$db->sql_freeresult ( $result );

			// Set up the SQL to add the sub-ladder.
			$sql_array	= array (
				'ladder_name' => $ladder_name,
				'ladder_desc' => $ladder_desc,
				'ladder_parent' => $ladder_parent,
				'ladder_rules' => '',
				'ladder_order' => 0,
				'subladder_order' => $row[ 'lo' ] + 1,
				'ladder_cl' => $ladder_cl,
				'ladder_ranking' => $ladder_ranking,
				'ladder_rm' => $ladder_rm,
				'bbcode_uid' => $uid,
				'bbcode_bitfield' => $bitfield,
				'bbcode_options' => $options
			);
			$sql	= "INSERT INTO " . LADDERS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
			$db->sql_query ( $sql );
		}

		// Completed. Let the user know.
		trigger_error ( 'LADDER_ADDED' );
	}
	else
	{
		// Get the number of platforms.
		$sql	= "SELECT COUNT(platform_id) AS num_platforms FROM " . PLATFORMS_TABLE;
		$result	= $db->sql_query ( $sql );
		$row	= $db->sql_fetchrow ( $result );
		$db->sql_freeresult ( $result );

		// Check if they can make a ladder (platform must be made first!).
		if ( $row[ 'num_platforms' ] == 0 )
		{
			// They have not added a platform.
			trigger_error ( 'MUST_ADD_PLATFORM' );
		}

		$sql	= "SELECT * FROM " . PLATFORMS_TABLE;
		$result	= $db->sql_query ( $sql );

		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			// Assign each platform to the template.
			$template->assign_block_vars ( 'block_platforms', array (
				'PLATFORM_ID' => $row[ 'platform_id' ],
				'PLATFORM_NAME' => $row[ 'platform_name' ] )
			);
		}

		$db->sql_freeresult ( $result );

		// Loop through the ladders.
		$sql	= "SELECT l.*, p.* FROM " . LADDERS_TABLE . " l, " . PLATFORMS_TABLE . " p WHERE l.ladder_platform = p.platform_id";
		$result	= $db->sql_query ( $sql );

		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			// Assign each ladder to the template.
			$template->assign_block_vars ( 'block_ladders', array (
				'LADDER_ID' => $row[ 'ladder_id' ],
				'LADDER_PLATFORM' => $row[ 'platform_name' ],
				'LADDER_NAME' => $row[ 'ladder_name' ] )
			);
		}

		$db->sql_freeresult ( $result );

		// Assign the other variables to the template.
		$template->assign_vars ( array ( 'U_ACTION' => $u_action ) );
	}
}

?>
