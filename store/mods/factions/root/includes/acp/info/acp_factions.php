<?php
##############################################################
# FILENAME  : acp_factions.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
   exit;
}

class acp_factions_info
{
	function module ( )
	{
		return	array (
			'filename' => 'acp_factions',
			'title' => 'ACP_CAT_FACTIONS',
			'version' => '1.4.0',
			'modes' => array (
				'main' => array ( 'title' => 'ACP_FACTIONS_MAIN', 'auth' => '', 'enable' => true, 'display' => true, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'add_ladder' => array ( 'title' => 'ACP_FACTIONS_ADD_LADDER', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'add_season' => array ( 'title' => 'ACP_FACTIONS_ADD_SEASON', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'add_platform' => array ( 'title' => 'ACP_FACTIONS_ADD_PLATFORM', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'add_tournament' => array ( 'title' => 'ACP_FACTIONS_ADD_TOURNAMENT', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'configure' => array ( 'title' => 'ACP_FACTIONS_CONFIGURE', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'manage_seasons' => array ( 'title' => 'ACP_FACTIONS_MANAGE_SEASONS', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'edit_season' => array ( 'title' => 'ACP_FACTIONS_EDIT_SEASON', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'edit_brackets' => array ( 'title' => 'ACP_FACTIONS_EDIT_BRACKETS', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'edit_groups' => array ( 'title' => 'ACP_FACTIONS_EDIT_GROUPS', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'edit_ladders' => array ( 'title' => 'ACP_FACTIONS_EDIT_LADDERS', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'edit_ladder' => array ( 'title' => 'ACP_FACTIONS_EDIT_LADDER', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'edit_subladder' => array ( 'title' => 'ACP_FACTIONS_EDIT_SUBLADDER', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'edit_platforms' => array ( 'title' => 'ACP_FACTIONS_EDIT_PLATFORMS', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'edit_tournaments' => array ( 'title' => 'ACP_FACTIONS_EDIT_TOURNAMENTS', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'report_match' => array ( 'title' => 'ACP_FACTIONS_REPORT_MATCH', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'seed_tournament' => array ( 'title' => 'ACP_FACTIONS_SEED_TOURNAMENT', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_FACTIONS' ) ),
				'edit_tournament' => array ( 'title' => 'ACP_FACTIONS_EDIT_TOURNAMENT', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_FACTIONS' ) )
			)
		);
	}

	function install ( )
	{
	}

	function uninstall ( )
	{
	}
}

?>
