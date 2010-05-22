<?php
##############################################################
# FILENAME  : info_acp_factions.php
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
	'ACP_CAT_FACTIONS'				=> 'phpBB Factions',
	'ACP_FACTIONS'					=> 'phpBB Factions',
	'ACP_FACTIONS_ADD_LADDER'			=> 'Add a Ladder',
	'ACP_FACTIONS_ADD_SEASON'			=> 'Add a Season',
	'ACP_FACTIONS_EDIT_SEASON'		=> 'Edit Season',
	'ACP_FACTIONS_ADD_PLATFORM'		=> 'Add a Platform',
	'ACP_FACTIONS_ADD_TOURNAMENT'		=> 'Add a Tournament',
	'ACP_FACTIONS_CONFIGURE'			=> 'Configure',
	'ACP_FACTIONS_MANAGE_SEASONS'		=> 'Manage Seasons',
	'ACP_FACTIONS_EDIT_BRACKETS'		=> 'Edit Brackets',
	'ACP_FACTIONS_EDIT_GROUPS'		=> 'Edit Clans',
	'ACP_FACTIONS_EDIT_LADDERS'		=> 'Edit Ladders',
	'ACP_FACTIONS_EDIT_LADDER'		=> 'Edit Ladder',
	'ACP_FACTIONS_EDIT_SUBLADDER'		=> 'Edit Sub-Ladder',
	'ACP_FACTIONS_EDIT_PLATFORMS'		=> 'Edit Platforms',
	'ACP_FACTIONS_EDIT_TOURNAMENT'	=> 'Edit Tournament',
	'ACP_FACTIONS_EDIT_TOURNAMENTS'	=> 'Edit Tournaments',
	'ACP_FACTIONS_MAIN'				=> 'Main Page',
	'ACP_FACTIONS_REPORT_MATCH'		=> 'Report a Match',
	'ACP_FACTIONS_SEED_TOURNAMENT'	=> 'Seed Tournament' )
);

?>
