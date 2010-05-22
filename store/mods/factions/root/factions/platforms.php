<?php
##############################################################
# FILENAME  : platforms.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

$ladder	= new ladder ( );

// Get the platforms.
$sql	= "SELECT * FROM " . PLATFORMS_TABLE;
$result	= $db->sql_query ( $sql );

$i	= 1;
while ( $row = $db->sql_fetchrow ( $result ) )
{
	// Count the number of ladders for each platform.
	$sql_2		= "SELECT COUNT(ladder_id) AS num_ladders FROM " . LADDERS_TABLE . " WHERE ladder_platform = " . $row[ 'platform_id' ];
	$result_2	= $db->sql_query ( $sql_2 );
	$row_2		= $db->sql_fetchrow ( $result_2 );
	$db->sql_freeresult ( $result_2 );

	// Assign each platform to the template.
	$template->assign_block_vars ( 'block_platforms', array (
		'U_ACTION' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=ladders&amp;platform=' . $row[ 'platform_id' ] ),
		'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
		'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2',
		'COUNT' => $i,
		'NUM_LADDERS' => $row_2[ 'num_ladders' ],
		'PLATFORM_NAME' => $row[ 'platform_name' ] )
	);

	$i++;
}

$db->sql_freeresult ( $result );

$template->set_filenames ( array ( 'body' => 'factions/platforms.html' ) );

?>
