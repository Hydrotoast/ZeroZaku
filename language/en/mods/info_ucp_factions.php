<?php
##############################################################
# FILENAME  : info_ucp_factions.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
   exit;
}

if ( empty ( $lang ) || !is_array ( $lang ) )
{
	$lang	= array ( );
}

$lang	= array_merge ( $lang, array (
	'UCP_CAT_FACTIONS'				=> 'Clan Control Panel',
	'UCP_FACTIONS_ADD_CHALLENGE'		=> 'Add a Challenge',
	'UCP_FACTIONS_CHALLENGES'			=> 'Manage Challenges',
	'UCP_FACTIONS_GROUP_MEMBERS'		=> 'Manage Members',
	'UCP_FACTIONS_INVITE_MEMBERS'		=> 'Invite Members',
	'UCP_FACTIONS_PENDING_MEMBERS'	=> 'Manage Pending Members',
	'UCP_FACTIONS_EDIT_GROUP'			=> 'Edit Clan',
	'UCP_FACTIONS_FIND_GROUP'			=> 'Find a Clan',
	'UCP_FACTIONS_MAIN'				=> 'Main Page',
	'UCP_FACTIONS_MATCHCOMM'			=> 'MatchComm',
	'UCP_FACTIONS_MATCHES'			=> 'Manage Matches',
	'UCP_FACTIONS_MATCH_FINDER'		=> 'Match Finder',
	'UCP_FACTIONS_TICKET'				=> 'Issue a Ticket',
	'UCP_FACTIONS_TOURNAMENTS'		=> 'Manage Tournaments' )
);

?>
