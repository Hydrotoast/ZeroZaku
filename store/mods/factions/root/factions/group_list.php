<?php
##############################################################
# FILENAME  : group_list.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

$group		= new group ( );
$ladder		= new ladder ( );
$start		= request_var ( 'start', 0 );

// Get the group's data.
$sql	= "SELECT cl.*, cd.*, ug.user_id FROM " . GROUPS_TABLE . " cl, " . GROUPDATA_TABLE . " cd, " . USER_GROUP_TABLE . " ug WHERE cd.group_id = cl.group_id AND ug.group_id = cl.group_id AND ug.group_leader = 1 ";
$where	= "";

$ladder_id	= request_var ( 'ladder_id', 0 );
if ( $ladder_id != 0 )
{
	// Filtering for ladder.
	$where	= "AND cd.group_ladder = $ladder_id ";
}

$alpha	= request_var ( 'alpha', '' );
if ( !empty ( $alpha ) )
{
	// Filtering for name.
	$where	= "AND (cl.group_name LIKE '%::" . strtoupper ( $alpha ) . "%' OR cl.group_name LIKE '%::" . strtolower ( $alpha ) . "%') ";
}

// Combine the SQL and the WHERE.
$sql	.= $where . "GROUP BY cd.group_id ORDER BY group_name ASC";
$result	= $db->sql_query_limit ( $sql, 15, $start );

$i	= 0;
while ( $row = $db->sql_fetchrow ( $result ) )
{
	// Assign the groups to the template.
	$template->assign_block_vars ( 'block_groups', array (
		'U_ACTION' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=group_profile&amp;group_id=' . $row[ 'group_id' ] ),
		'GROUP_NAME' => $group->group_name ( $row[ 'group_name' ] ),
		'GROUP_MEMBERS' => sizeof ( $group->members ( 'get_members', $row[ 'group_id' ] ) ),
		'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
		'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2' )
	);

	// Check if a challenge link is to be showen.
	if ( $row[ 'user_id' ] != $user->data[ 'user_id' ] && $user->data[ 'user_id' ] != ANONYMOUS )
	{
		// Show the challenge link.
		$template->assign_block_vars ( 'block_groups.block_challenge', array (
			'U_CHALLENGE' => append_sid ( "{$phpbb_root_path}ucp.$phpEx", 'i=factions&amp;mode=add_challenge&amp;group_id=' . $row[ 'group_id' ] ) )
		);
	}

	$i++;
}

$db->sql_freeresult ( $result );

// Setup the alphas.
$alphas	= range ( 'a', 'z' );
foreach ( $alphas AS $value )
{
	// Show the A B Cs!
	$template->assign_block_vars ( 'block_alphas', array (
		'U_ALPHA' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=group_list&amp;ladder_id=' . $ladder_id . '&amp;alpha=' . $value ),
		'ALPHA' => $value )
	);
}

// Loop through the ladder list.
$ladders	= $ladder->ladder_list ( );
foreach ( $ladders AS $key => $value )
{
	$sql	= "SELECT * FROM " . PLATFORMS_TABLE . " WHERE platform_id = " . $ladders[ $key ][ 'PLATFORM' ];
	$result	= $db->sql_query ( $sql );
	$row	= $db->sql_fetchrow ( $result );

	// Assign it to the template.
	$template->assign_block_vars ( 'block_ladders', array (
		'LADDER_NAME' => $ladders[ $key ][ 'NAME' ],
		'PLATFORM' => $row[ 'platform_name' ] )
	);

	// Loop through the ladder's sub-ladders.
	foreach ( $ladders[ $key ][ 'SUBLADDERS' ] AS $key_2 => $value_2 )
	{
		// Assign them to the template.
		$template->assign_block_vars ( 'block_ladders.block_subladders', array (
			'LADDER_NAME' => $ladders[ $key ][ 'SUBLADDERS' ][ $key_2 ][ 'NAME' ],
			'LADDER_ID' => $key_2 )
		);
	}
}

// Setup the pagination.
$sql	= "SELECT cl.*, cd.* AS total FROM " . GROUPS_TABLE . " cl, " . GROUPDATA_TABLE . " cd WHERE cl.group_id = cd.group_id $where GROUP BY cd.group_id";
$result	= $db->sql_query ( $sql );
$total	= sizeof ( $db->sql_fetchrowset ( $result ) );
$db->sql_freeresult ( $result );

// Generate the pagination.
$pagination	= generate_pagination ( append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=group_list&amp;ladder_id=' . $ladder_id . '&amp;alpha=' . $alpha ), $total, 15, $start );

// Assign the other variables to the template.
$template->assign_vars ( array (
	'U_ACTION' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=group_list&amp;alpha=' . $alpha ),
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => on_page ( $total, 15, $start ) )
);

$template->set_filenames ( array ( 'body' => 'factions/group_list.html' ) );

?>
