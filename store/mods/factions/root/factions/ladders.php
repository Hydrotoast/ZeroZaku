<?php
##############################################################
# FILENAME  : ladders.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

$ladder		= new ladder ( );
$rules		= request_var ( 'rules', 0 );
$platform	= request_var ( 'platform', 0 );

// Are we going to show the rules?
if ( !empty ( $rules ) )
{
	// Setup the BBcode for the ladder rules.
	$rules	= nl2br ( generate_text_for_display ( $ladder->data[ 'ladder_rules' ], $ladder->data[ 'bbcode_uid' ], $ladder->data[ 'bbcode_bitfield' ], $ladder->data[ 'bbcode_options' ] ) );
	trigger_error ( $rules );
}

// Get the parent ladders and order them.
$sql	= "SELECT * FROM " . LADDERS_TABLE . " WHERE ladder_parent = 0 AND ladder_platform = $platform ORDER BY ladder_order ASC";
$result	= $db->sql_query ( $sql );

while ( $row = $db->sql_fetchrow ( $result ) )
{
	// Assign the ladders to the template.
	$template->assign_block_vars ( 'block_ladders', array (
		'U_LADDERRULES' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=ladders&amp;rules=1&amp;ladder_id=' . $row[ 'ladder_id' ] ),
		'LADDER_NAME' => $row[ 'ladder_name' ] )
	);

	// Get the sub-ladders and order them.
	$sql_2		= "SELECT * FROM " . LADDERS_TABLE . " WHERE ladder_parent = {$row[ 'ladder_id' ]} ORDER BY subladder_order ASC";
	$result_2	= $db->sql_query ( $sql_2 );

	while ( $row_2 = $db->sql_fetchrow ( $result_2 ) )
	{
		// Count the number of groups in the sub-ladder.
		$sql_3		= "SELECT COUNT(*) AS num_groups FROM " . GROUPDATA_TABLE . " WHERE group_ladder = " . $row_2[ 'ladder_id' ];
		$result_3	= $db->sql_query ( $sql_3 );
		$row_3		= $db->sql_fetchrow ( $result_3 );
		$db->sql_freeresult ( $result_3 );

		// Setup the BBcode for the ladder description.
		$desc	= nl2br ( generate_text_for_display ( $row_2[ 'ladder_desc' ], $row_2[ 'bbcode_uid' ], $row_2[ 'bbcode_bitfield' ], $row_2[ 'bbcode_options' ] ) );

		// Assign the sub-ladders to the template.
		$template->assign_block_vars ( 'block_ladders.block_subladders', array (
			'U_ACTION' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=subladders&amp;ladder_id=' . $row_2[ 'ladder_id' ] ),
			'LADDER_NAME' => $row_2[ 'ladder_name' ],
			'NUM_GROUPS' => $row_3[ 'num_groups' ],
			'LADDER_DESC' => $desc )
		);
	}

	$db->sql_freeresult ( $result_2 );
}

$db->sql_freeresult ( $result );

// Get the platform's data.
$sql	= "SELECT * FROM " . PLATFORMS_TABLE . " WHERE platform_id = " . $platform;
$result	= $db->sql_query ( $sql );
$row	= $db->sql_fetchrow ( $result );
$db->sql_freeresult ( $result );

// Set up the breadcrumb.
$template->assign_block_vars ( 'navlinks', array (
	'FORUM_NAME'	=> $row[ 'platform_name' ],
	'U_VIEW_FORUM'	=> append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=ladders&amp;platform=' . $platform ) )
);

$template->set_filenames ( array ( 'body' => 'factions/ladders.html' ) );

?>
