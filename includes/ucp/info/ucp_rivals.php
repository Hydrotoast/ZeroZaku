<?php
##############################################################
# FILENAME  : ucp_rivals.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
   exit;
}

class ucp_rivals_info
{
	function module ( )
	{
		return	array (
			'filename' => 'ucp_rivals',
			'title' => 'UCP_CAT_RIVALS',
			'modes' => array (
				'main' => array ( 'title' => 'UCP_RIVALS_MAIN', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_RIVALS' ) ),
				'add_challenge' => array ( 'title' => 'UCP_RIVALS_ADD_CHALLENGE', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_RIVALS' ) ),
				'challenges' => array ( 'title' => 'UCP_RIVALS_CHALLENGES', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_RIVALS' ) ),
				'edit_group' => array ( 'title' => 'UCP_RIVALS_EDIT_GROUP', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_RIVALS' ) ),
				'find_group' => array ( 'title' => 'UCP_RIVALS_FIND_GROUP', 'auth' => '', 'display' => false, 'cat' => array ( 'UCP_CAT_RIVALS' ) ),
				'matches' => array ( 'title' => 'UCP_RIVALS_MATCHES', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_RIVALS' ) ),
				'match_finder' => array ( 'title' => 'UCP_RIVALS_MATCH_FINDER', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_RIVALS' ) ),
				'group_members' => array ( 'title' => 'UCP_RIVALS_GROUP_MEMBERS', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_RIVALS' ) ),
				'pending_members' => array ( 'title' => 'UCP_RIVALS_PENDING_MEMBERS', 'auth' => '', 'display' => false, 'cat' => array ( 'UCP_CAT_RIVALS' ) ),
				'invite_members' => array ( 'title' => 'UCP_RIVALS_INVITE_MEMBERS', 'auth' => '', 'display' => false, 'cat' => array ( 'UCP_CAT_RIVALS' ) ),
				'ticket' => array ( 'title' => 'UCP_RIVALS_TICKET', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_RIVALS' ) ),
				'tournaments' => array ( 'title' => 'UCP_RIVALS_TOURNAMENTS', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_RIVALS' ) ),
				'matchcomm' => array ( 'title' => 'UCP_RIVALS_MATCHCOMM', 'auth' => '', 'display' => true, 'cat' => array ( 'UCP_CAT_RIVALS' ) )
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
