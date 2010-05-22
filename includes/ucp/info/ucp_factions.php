<?php
##############################################################
# FILENAME  : ucp_factions.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
   exit;
}

class ucp_factions_info
{
	function module ( )
	{
		return	array (
			'filename' => 'ucp_factions',
			'title' => 'UCP_CAT_FACTIONS',
			'modes' => array (
				'main' => array ( 'title' => 'UCP_FACTIONS_MAIN', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_FACTIONS' ) ),
				'add_challenge' => array ( 'title' => 'UCP_FACTIONS_ADD_CHALLENGE', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_FACTIONS' ) ),
				'challenges' => array ( 'title' => 'UCP_FACTIONS_CHALLENGES', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_FACTIONS' ) ),
				'edit_group' => array ( 'title' => 'UCP_FACTIONS_EDIT_GROUP', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_FACTIONS' ) ),
				'find_group' => array ( 'title' => 'UCP_FACTIONS_FIND_GROUP', 'auth' => '', 'display' => false, 'cat' => array ( 'UCP_CAT_FACTIONS' ) ),
				'matches' => array ( 'title' => 'UCP_FACTIONS_MATCHES', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_FACTIONS' ) ),
				'match_finder' => array ( 'title' => 'UCP_FACTIONS_MATCH_FINDER', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_FACTIONS' ) ),
				'group_members' => array ( 'title' => 'UCP_FACTIONS_GROUP_MEMBERS', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_FACTIONS' ) ),
				'pending_members' => array ( 'title' => 'UCP_FACTIONS_PENDING_MEMBERS', 'auth' => '', 'display' => false, 'cat' => array ( 'UCP_CAT_FACTIONS' ) ),
				'invite_members' => array ( 'title' => 'UCP_FACTIONS_INVITE_MEMBERS', 'auth' => '', 'display' => false, 'cat' => array ( 'UCP_CAT_FACTIONS' ) ),
				'ticket' => array ( 'title' => 'UCP_FACTIONS_TICKET', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_FACTIONS' ) ),
				'tournaments' => array ( 'title' => 'UCP_FACTIONS_TOURNAMENTS', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_FACTIONS' ) ),
				'matchcomm' => array ( 'title' => 'UCP_FACTIONS_MATCHCOMM', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_FACTIONS' ) )
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
