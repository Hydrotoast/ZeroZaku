<?php
##############################################################
# FILENAME  : tournaments_brackets.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

$tournament		= new tournament ( );
$group			= new group ( );
$tournament_id	= request_var ( 'tournament_id', 0 );

// Get the number of groups in the tournament.
$sql	= "SELECT COUNT(*) AS num_groups FROM " . TGROUPS_TABLE . " WHERE group_tournament = $tournament_id AND group_bracket = 1";
$result	= $db->sql_query ( $sql );
$row	= $db->sql_fetchrow ( $result );
$db->sql_freeresult ( $result );

// Check if all the groups have signed up yet.
if ( $tournament->data[ 'tournament_status' ] == 1 )
{
	// Any groups signed up yet?
	if ( $row[ 'num_groups' ] > 0 )
	{
		// Show who signed up.
		$message	= $user->lang[ 'BRACKETS_CANT_GENERATE' ] . '<br /><ol>';

		$sql	= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_tournament = $tournament_id AND group_bracket = 1";
		$result	= $db->sql_query ( $sql );

		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			// Show the group's name who signed up.
			$message	.= '<li><a href="' . append_sid ( "{$phpbb_root_path}factions.$phpEx", 'action=group_profile&amp;group_id=' . $row[ 'group_id' ] ) . '">' . $group->group_name ( $group->data ( 'group_name', $row[ 'group_id' ] ) ) . '</li>';
		}

		$db->sql_freeresult ( $result );

		$message	.= '</ol>';
	}
	else
	{
		// No one signed up, yet.
		$message	= $user->lang[ 'BRACKETS_CANT_GENERATE' ];
	}

	trigger_error ( $message );
}

// Generate the tournament.
$tournament->generate_tournament ( );

$template->set_filenames ( array ( 'body' => 'factions/tournaments_backets.html' ) );

?>
