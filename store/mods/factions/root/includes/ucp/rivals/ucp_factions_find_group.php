<?php
##############################################################
# FILENAME  : ucp_factions_find_group.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Find a Group
 * Called from ucp_factions with mode == 'find_group'
 */
function ucp_factions_find_group ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpEx;

	$group	= new group ( );
	$ladder	= new ladder ( );

	$submit	= request_var ( 'submit', '' );
	if ( !empty ( $submit ) )
	{
		// Replace the * with a SQL LIKE symbol %.
		$group_search	= $db->sql_like_expression ( str_replace ( '*', $db->any_char, utf8_clean_string ( '*::' . request_var ( 'group_search', '', true ) ) ) );

		$sql		= "SELECT c.*, cl.*, ud.user_id FROM " . GROUPS_TABLE . " c, " . GROUPDATA_TABLE . " cl, " . USER_GROUP_TABLE . " ud WHERE LOWER(c.group_name) $group_search AND c.group_id = cl.group_id AND ud.group_leader = 0 AND ud.user_id <> {$user->data[ 'user_id' ]} AND ud.group_id = c.group_id AND cl.group_ladder IN(" . implode ( ',', $group->data[ 'group_ladders' ] ) . ")";
		$result		= $db->sql_query ( $sql );

		$i	= 0;
		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			// Assign each group to the template.
			$template->assign_block_vars ( 'block_groups', array (
				'U_GROUP' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=group_profile&amp;group_id=' . $row[ 'group_id' ] ),
				'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2',
				'GROUP_NAME' => $group->group_name ( $row[ 'group_name' ] ),
				'GROUP_ID' => $row[ 'group_id' ] )
			);

			$i++;
		}

		$db->sql_freeresult ( $result );
	}

	// Assign the other variables to the template.
	$template->assign_vars ( array ( 'U_ACTION' => $u_action ) );
}

?>
