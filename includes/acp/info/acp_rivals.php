<?php
##############################################################
# FILENAME  : acp_rivals.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
   exit;
}

class acp_rivals_info
{
	function module ( )
	{
		return	array (
			'filename' => 'acp_rivals',
			'title' => 'ACP_CAT_RIVALS',
			'version' => '1.4.0',
			'modes' => array (
				'main' => array ( 'title' => 'ACP_RIVALS_MAIN', 'auth' => '', 'enable' => true, 'display' => true, 'cat' => array ( 'ACP_RIVALS' ) ),
				'add_ladder' => array ( 'title' => 'ACP_RIVALS_ADD_LADDER', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_RIVALS' ) ),
				'add_season' => array ( 'title' => 'ACP_RIVALS_ADD_SEASON', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_RIVALS' ) ),
				'add_platform' => array ( 'title' => 'ACP_RIVALS_ADD_PLATFORM', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_RIVALS' ) ),
				'add_tournament' => array ( 'title' => 'ACP_RIVALS_ADD_TOURNAMENT', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_RIVALS' ) ),
				'configure' => array ( 'title' => 'ACP_RIVALS_CONFIGURE', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_RIVALS' ) ),
				'manage_seasons' => array ( 'title' => 'ACP_RIVALS_MANAGE_SEASONS', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_RIVALS' ) ),
				'edit_season' => array ( 'title' => 'ACP_RIVALS_EDIT_SEASON', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_RIVALS' ) ),
				'edit_brackets' => array ( 'title' => 'ACP_RIVALS_EDIT_BRACKETS', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_RIVALS' ) ),
				'edit_groups' => array ( 'title' => 'ACP_RIVALS_EDIT_GROUPS', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_RIVALS' ) ),
				'edit_ladders' => array ( 'title' => 'ACP_RIVALS_EDIT_LADDERS', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_RIVALS' ) ),
				'edit_ladder' => array ( 'title' => 'ACP_RIVALS_EDIT_LADDER', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_RIVALS' ) ),
				'edit_subladder' => array ( 'title' => 'ACP_RIVALS_EDIT_SUBLADDER', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_RIVALS' ) ),
				'edit_platforms' => array ( 'title' => 'ACP_RIVALS_EDIT_PLATFORMS', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_RIVALS' ) ),
				'edit_tournaments' => array ( 'title' => 'ACP_RIVALS_EDIT_TOURNAMENTS', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_RIVALS' ) ),
				'report_match' => array ( 'title' => 'ACP_RIVALS_REPORT_MATCH', 'enable' => true, 'auth' => '', 'display' => true, 'cat' => array ( 'ACP_RIVALS' ) ),
				'seed_tournament' => array ( 'title' => 'ACP_RIVALS_SEED_TOURNAMENT', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_RIVALS' ) ),
				'edit_tournament' => array ( 'title' => 'ACP_RIVALS_EDIT_TOURNAMENT', 'enable' => true, 'auth' => '', 'display' => false, 'cat' => array ( 'ACP_RIVALS' ) )
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
