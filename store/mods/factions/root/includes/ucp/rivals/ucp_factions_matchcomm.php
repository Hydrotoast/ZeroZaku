<?php
##############################################################
# FILENAME  : ucp_factions_matchcomm.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * MatchComm
 * Called from ucp_factions with mode == 'matchcomm'
 */
function ucp_factions_matchcomm ( $id, $mode, $u_action )
{
	global	$db, $user, $template;
	global	$phpbb_root_path, $phpEx;

	$group		= new group ( );

	// Check if the group is apart of a ladder yet.
	if ( sizeof ( $group->data[ 'group_ladders' ] ) == 0 )
	{
		// They are not apart of a ladder. Deny them.
		trigger_error ( 'GROUP_NOTIN_LADDER' );
	}

	$match_id	= request_var ( 'match_id', 0 );
	$action		= request_var ( 'action', 'show_matchcomms' );

	switch ( $action )
	{
		case 'send_chat' :
			$chat_text	= utf8_normalize_nfc ( request_var ( 'chat_text', '', true ) );

			// Check for message hijacking.
			$sql	= "SELECT * FROM " . MATCHES_TABLE . " WHERE (match_challenger = {$group->data[ 'group_id' ]} OR match_challengee = {$group->data[ 'group_id' ]}) AND match_id = " . $match_id;
			$result	= $db->sql_query ( $sql );
			$row	= $db->sql_fetchrow ( $result );
			$db->sql_freeresult ( $result );

			if ( sizeof ( $row ) == 0 )
			{
				// Hijacking. Let the user know.
				trigger_error ( 'MATCHCOMM_WRONG_MATCH' );
			}

			// Submit the chat text to MatchComm.
			$sql_array	= array (
				'match_id' => $match_id,
				'group_id' => $group->data[ 'group_id' ],
				'matchcomm_message' => $chat_text,
				'matchcomm_time' => time ( )
			);
			$sql		= "INSERT INTO " . MATCHCOMM_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
			$db->sql_query ( $sql );
		break;
		case 'get_chat' :
			// Check for message hijacking.
			$sql	= "SELECT * FROM " . MATCHES_TABLE . " WHERE (match_challenger = {$group->data[ 'group_id' ]} OR match_challengee = {$group->data[ 'group_id' ]}) AND match_id = " . $match_id;
			$result	= $db->sql_query ( $sql );
			$row	= $db->sql_fetchrow ( $result );
			$db->sql_freeresult ( $result );

			if ( sizeof ( $row ) == 0 )
			{
				// Hijacking. Let the user know.
				trigger_error ( 'MATCHCOMM_WRONG_MATCH' );
			}

			// Get the messages for this MatchComm.
			$sql	= "SELECT * FROM " . MATCHCOMM_TABLE . " WHERE match_id = {$match_id} ORDER BY matchcomm_time DESC";
			$result	= $db->sql_query ( $sql );

			$i	= 0;
			while ( $row = $db->sql_fetchrow ( $result ) )
			{
				if ( $row[ 'matchcomm_unread' ] == 1 && $row[ 'group_id' ] != $group->data[ 'group_id' ] )
				{
					// Your group hasnt read this message. Read it.
					$sql	= "UPDATE " . MATCHCOMM_TABLE . " SET matchcomm_unread = 0 WHERE match_id = {$match_id} AND group_id = " . $row[ 'group_id' ];
					$db->sql_query ( $sql );
				}

				// Assign the messages to the template.
				$template->assign_block_vars ( 'block_messages', array (
					'GROUP_NAME' => $group->group_name ( $group->data ( 'group_name', $row[ 'group_id' ] ) ),
					'MESSAGE_TIME' => $user->format_date ( $row[ 'matchcomm_time' ] ),
					'MESSAGE' => $row[ 'matchcomm_message' ],
					'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
					'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2' )
				);

				$i++;
			}

			// Assign the other variables to the template.
			$template->assign_vars ( array ( 'SHOW_CHAT2' => true ) );
		break;
		case 'show_chat' :
			// Assign the other variables to the template.
			$template->assign_vars ( array (
				'U_ACTION' => append_sid ( "{$phpbb_root_path}ucp.$phpEx", 'i=factions&amp;mode=matchcomm' ),
				'SHOW_CHAT' => true,
				'MATCH_ID' => $match_id )
			);
		break;
		case 'show_matchcomms' :
			// Get the MatchComms for this group.
			$sql	= "SELECT * FROM " . MATCHES_TABLE . " WHERE (match_challenger = {$group->data[ 'group_id' ]} OR match_challengee = {$group->data[ 'group_id' ]}) AND match_finishtime = 0";
			$result	= $db->sql_query ( $sql );
			$db->sql_freeresult ( $result );

			$i	= 0;
			while ( $row = $db->sql_fetchrow ( $result ) )
			{
				// Get the number of unread MatchComm messages.
				$sql_2		= "SELECT COUNT(matchcomm_message) AS unread_messages FROM " . MATCHCOMM_TABLE . " WHERE matchcomm_unread = 1 AND group_id <> {$group->data[ 'group_id' ]} AND match_id = " . $row[ 'match_id' ];
				$result_2	= $db->sql_query ( $sql_2 );
				$row_2		= $db->sql_fetchrow ( $result_2 );
				$db->sql_freeresult ( $result_2 );

				// Assign the MatchComms to the template.
				$template->assign_block_vars ( 'block_matchcomms', array (
					'U_ACTION' => append_sid ( "{$phpbb_root_path}ucp.$phpEx", 'i=factions&amp;mode=matchcomm&amp;action=show_chat&amp;match_id=' . $row[ 'match_id' ] ),
					'GROUP_NAME' => ( $row[ 'match_challenger' ] == $group->data[ 'group_id' ] ) ? $group->group_name ( $group->data ( 'group_name', $row[ 'match_challengee' ] ) ) : $group->group_name ( $group->data ( 'group_name', $row[ 'match_challenger' ] ) ),
					'UNREAD_MESSAGES' => $row_2[ 'unread_messages' ],
					'BG_COLOR' => ( $i % 2 ) ? 'bg1' : 'bg2',
					'ROW_COLOR' => ( $i % 2 ) ? 'row1' : 'row2' )
				);

				$i++;
			}

			$db->sql_freeresult ( $result );

			// Assign the other variables to the template.
			$template->assign_vars ( array ( 'SHOW_MATCHCOMMS' => true ) );
		break;
	}
}

?>
