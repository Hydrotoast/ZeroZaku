<?php
##############################################################
# FILENAME  : subladders.php
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
$ladder_id	= request_var ( 'ladder_id', 0 );

// Order the groups by their score.
$order_by	= ( $ladder->data[ 'ladder_ranking' ] == 0 ) ? 'cdd.group_score' : 'cdd.group_current_rank';
if ( $order_by == 'cdd.group_score' )
{
	// Sort by scores. High to low.
	$sort	= 'DESC';
}
else
{
	// Sort by rank. Low to high.
	$sort	= 'ASC';
}

$sql		= "SELECT cdd.*, csd.* FROM " . GROUPDATA_TABLE . " cdd, " . GROUPS_TABLE . " csd WHERE cdd.group_ladder = $ladder_id AND csd.group_id = cdd.group_id ORDER BY $order_by $sort";
$result		= $db->sql_query_limit ( $sql, 15, $start );

$i	= 0;
while ( $row = $db->sql_fetchrow ( $result ) )
{
	if ( $order_by == 'cdd.group_score' )
	{
		// Apply the proper ladder position to the group.
		// Offset it based on the page number.
		if ( $start > 0 )
		{
			$pos	= ordinal ( $start + ( $i + 1 ) );
		}
		else
		{
			$pos	= ordinal ( $i + 1 );
		}
	}
	else
	{
		// Use the ordinal current rank.
		$pos	= ordinal ( $row[ 'group_current_rank' ] );
	}

	// Check if a challenge link is to be showen.
	if ( $ladder->data[ 'ladder_cl' ] == 1 && $row[ 'group_id' ] != $group->data[ 'group_id' ] )
	{
		// Show the challenge link.
		$challenge_link	= append_sid ( "{$phpbb_root_path}ucp.$phpEx", 'i=factions&amp;mode=add_challenge&amp;group_id=' . $row[ 'group_id' ] );
	}
	else
	{
		// Don't show it.
		$challenge_link	= '';
	}

	// Get the up or down ranking image.
	if ( $row[ 'group_last_rank' ] != $row[ 'group_current_rank' ] && $row[ 'group_last_rank' ] != 0 )
	{
		if ( $row[ 'group_current_rank' ] < $row[ 'group_last_rank' ] )
		{
			// They have moved up.
			$up_down	= '<img src="' . $phpbb_root_path . 'factions/images/rank_up.png" />';
		}
		else
		{
			// They have moved down.
			$up_down	= '<img src="' . $phpbb_root_path . 'factions/images/rank_down.png" />';
		}
	}
	else
	{
		// They are a new group.
		$up_down	= '';
	}

	// Get the hot or cold image.
	if ( $row[ 'group_streak' ] >= 4 )
	{
		// They are on a hot streak.
		$hot_cold	= '<img src="' . $phpbb_root_path . 'factions/images/hot.png" />';
	}
	else if ( $row[ 'group_streak' ] <= -4 )
	{
		// They are on a cold streak.
		$hot_cold	= '<img src="' . $phpbb_root_path . 'factions/images/cold.png" />';
	}
	else
	{
		// They are neutral.
		$hot_cold	= '';
	}

	// Assign the groups to the template.
	$template->assign_block_vars ( 'block_groups', array (
		'U_ACTION' => append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=group_profile&amp;group_id=' . $row[ 'group_id' ] ),
		'U_CHALLENGE_LINK' => $challenge_link,
		'POS' => $pos,
		'UP_DOWN' => $up_down,
		'HOT_COLD' => $hot_cold,
		'GROUP_NAME' => $group->group_name ( $row[ 'group_name' ] ),
		'GROUP_ID' => $row[ 'group_id' ],
		'GROUP_WINS' => $row[ 'group_wins' ],
		'GROUP_LOSSES' => $row[ 'group_losses' ],
		'GROUP_SCORE' => $row[ 'group_score' ],
		'GROUP_STREAK' => $row[ 'group_streak' ],
		'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
		'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2' )
	);

	$i++;
}

$db->sql_freeresult ( $result );

// Setup the pagination.
$sql	= "SELECT COUNT(group_id) AS total FROM " . GROUPDATA_TABLE . " WHERE group_ladder = " . $ladder_id;
$result	= $db->sql_query ( $sql );
$total	= $db->sql_fetchrow ( $result );
$db->sql_freeresult ( $result );

// Generate the pagination.
$pagination	= generate_pagination ( append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=subladders&amp;ladder_id=' . $ladder_id ), $total[ 'total' ], 15, $start );

// Check if the group is in this sub-ladder or not.
if ( $user->data[ 'is_registered' ] && $group->data[ 'group_id' ] != 0 )
{
	if ( !in_array ( $ladder_id, $group->data[ 'group_ladders' ] ) )
	{
		// The group is not in this sub-ladder. Show join link.
		$membership			= $user->lang[ 'JOIN_LADDER' ];
		$membership_action	= append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=ladder_membership&amp;type=1&amp;ladder_id=' . $ladder_id );
	}
	else
	{
		if ( $ladder->data[ 'ladder_locked' ] == 0 )
		{
			// The group is already joined with this ladder. Show leave link.
			$membership			= $user->lang[ 'LEAVE_LADDER' ];
			$membership_action	= append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=ladder_membership&amp;type=2&amp;ladder_id=' . $ladder_id );
		}
		else
		{
			$membership			= '';
			$membership_action	= '';
		}
	}
}
else
{
	$membership			= '';
	$membership_action	= '';
}

// Assign the other variables to the template.
$template->assign_vars ( array (
	'U_MEMBERSHIP' => $membership_action,
	'L_MEMBERSHIP' => $membership,
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => on_page ( $total[ 'total' ], 15, $start ) )
);

// Set up the breadcrumbs.
$ladder_data	= $ladder->get_roots ( $ladder_id );
$template->assign_block_vars ( 'navlinks', array (
	'FORUM_NAME'	=> $ladder_data[ 'PLATFORM_NAME' ],
	'U_VIEW_FORUM'	=> append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=ladders&amp;platform=' . $ladder_data[ 'PLATFORM_ID' ] ) )
);
$template->assign_block_vars ( 'navlinks', array (
	'FORUM_NAME'	=> $ladder_data[ 'LADDER_NAME' ],
	'U_VIEW_FORUM'	=> append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=ladders&amp;platform=' . $ladder_data[ 'PLATFORM_ID' ] ) )
);
$template->assign_block_vars ( 'navlinks', array (
	'FORUM_NAME'	=> $ladder_data[ 'SUBLADDER_NAME' ],
	'U_VIEW_FORUM'	=> append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=subladders&amp;ladder_id=' . $ladder_data[ 'SUBLADDER_ID' ] ) )
);

$template->set_filenames ( array ( 'body' => 'factions/subladders.html' ) );

?>
