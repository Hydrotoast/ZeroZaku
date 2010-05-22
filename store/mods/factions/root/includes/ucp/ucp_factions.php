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

class ucp_factions
{
	var	$u_action;

	function main ( $id, $mode )
	{
		global	$db, $user, $template;
		global	$phpbb_root_path, $phpEx;

		// Include Factions' classes and phpBB functions.
		include ( $phpbb_root_path . 'factions/classes/class_group.' . $phpEx );
		include ( $phpbb_root_path . 'factions/classes/class_tournament.' . $phpEx );
		include ( $phpbb_root_path . 'factions/classes/class_ladder.' . $phpEx );
		include ( $phpbb_root_path . 'factions/functions.' . $phpEx );
		include ( $phpbb_root_path . 'includes/functions_privmsgs.' . $phpEx );

		// Setup the language.
		$user->add_lang ( 'mods/lang_factions' );

		// Switch between the modes to manage Factions.
		switch ( $mode )
		{
			case 'main' :
				$this->tpl_name		= 'factions/ucp_factions_main';
				$this->page_title	= 'UCP_FACTIONS';

				$group	= new group ( );
				$ladder	= new ladder ( );

				// Check to see if the user has a group.
				if ( $user->data[ 'group_session' ] == 0 )
				{
					// They don't, redirect them to make a group.
					$redirect	= append_sid ( "{$phpbb_admin_path}factions.$phpEx", 'action=add_group' );
					redirect ( $redirect );
				}

				$switch	= request_var ( 'switch', 0 );
				if ( !empty ( $switch ) )
				{
					// Quick group switching feature. Check for hacking attempt.
					$sql	= "SELECT * FROM " . USER_GROUP_TABLE . " WHERE group_leader = 1 AND user_id = {$user->data[ 'user_id' ]} AND group_id = " . $switch;
					$result	= $db->sql_query ( $sql );
					$row	= $db->sql_fetchrow ( $result );
					$db->sql_freeresult ( $result );

					if ( sizeof ( $row ) == 0 )
					{
						// This group is not theirs. Redirect them back to the Clan CP.
						redirect ( $this->u_action );
					}

					// Update the user's session.
					$sql	= "UPDATE " . USERS_TABLE . " SET group_session = $switch WHERE user_id = " . $user->data[ 'user_id' ];
					$db->sql_query ( $sql );

					// Completed. Redirect the user back to the Clan CP.
					redirect ( $this->u_action );
				}

				// Get a list of the user's other groups.
				$sql	= "SELECT gd.*, ud.user_id FROM " . GROUPS_TABLE . " gd, " . USER_GROUP_TABLE . " ud WHERE ud.group_leader = 1 AND ud.user_id = {$user->data[ 'user_id' ]} AND ud.group_id = gd.group_id AND gd.group_type = " . GROUP_HIDDEN . " AND gd.group_id <> " . (int) $group->data[ 'group_id' ];
				$result	= $db->sql_query ( $sql );

				$i	= 0;
				while ( $row = $db->sql_fetchrow ( $result ) )
				{
					// Assign the groups to the template.
					$template->assign_block_vars ( 'block_switch', array (
						'U_ACTION' => $this->u_action . '&amp;switch=' . $row[ 'group_id' ],
						'GROUP_NAME' => $group->group_name ( $row[ 'group_name' ] ) )
					);

					$i++;
				}

				$db->sql_freeresult ( $result );

				// Get the challenges.
				$sql		= "SELECT COUNT(challenge_id) AS the_challenges FROM " . CHALLENGES_TABLE . " WHERE challengee = " . $group->data[ 'group_id' ];
				$result		= $db->sql_query ( $sql );
				$row		= $db->sql_fetchrow ( $result );
				$challenges	= $row[ 'the_challenges' ];
				$db->sql_freeresult ( $result );

				// Get the on-going challenges.
				$sql		= "SELECT COUNT(match_id) AS the_ogmatches FROM " . MATCHES_TABLE . " WHERE match_finishtime = 0 AND (match_challenger = {$group->data[ 'group_id' ]} OR match_challengee = {$group->data[ 'group_id' ]})";
				$result		= $db->sql_query ( $sql );
				$row		= $db->sql_fetchrow ( $result );
				$ogmatches	= $row[ 'the_ogmatches' ];
				$db->sql_freeresult ( $result );

				$sql		= "SELECT COUNT(match_id) AS the_matches FROM " . MATCHES_TABLE . " WHERE match_finishtime > 0 AND (match_challenger = {$group->data[ 'group_id' ]} OR match_challengee = {$group->data[ 'group_id' ]})";
				$result		= $db->sql_query ( $sql );
				$row		= $db->sql_fetchrow ( $result );
				$matches	= $row[ 'the_matches' ];
				$db->sql_freeresult ( $result );

				// Check if we need to remove any challenges.
				$sql	= "SELECT * FROM " . CHALLENGES_TABLE . " WHERE challenger = " . $group->data[ 'group_id' ];
				$result	= $db->sql_query ( $sql );

				while ( $row = $db->sql_fetchrow ( $result ) )
				{
					// Get the time difference in days.
					$days	= intval ( floor ( ( time ( ) - $row[ 'challenge_posttime' ] ) / 86400 ) );

					if ( $days >= 1 )
					{
						// The challenge hasent been accepted within 24 hours. Delete.
						$sql	= "DELETE FROM " . CHALLENGES_TABLE . " WHERE challenge_id = " . $row[ 'challenge_id' ];
						$db->sql_query ( $sql );

						// Send a PM to the group owner to let them know.
						$challengee	= $group->data ( 'group_name', $row[ 'challengee' ] );
						$subject	= $user->lang[ 'PM_CHALLENGEDELETED' ];
						$message	= sprintf ( $user->lang[ 'PM_CHALLENGEDELETEDTXT' ], $challengee, $challengee );
						insert_pm ( $group->data[ 'user_id' ], $user->data, $subject, $message );
					}
				}

				$db->sql_freeresult ( $result );

				// Assign the other variables to the template.
				$template->assign_vars ( array (
					'L_WELCOMETXT' => sprintf ( $user->lang[ 'WELCOME_CCPTXT' ], $group->group_name ( $group->data[ 'group_name' ] ) ),
					'GROUP_NAME' => $group->group_name ( $group->data[ 'group_name' ] ),
					'CHALLENGES' => $challenges,
					'ONGOING_MATCHES' => $ogmatches,
					'FINISHED_MATCHES' => $matches )
				);
			break;
			case 'add_challenge' :
				$this->tpl_name		= 'factions/ucp_factions_add_challenge';
				$this->page_title	= 'UCP_FACTIONS_ADD_CHALLENGE';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/ucp/factions/ucp_factions_add_challenge.' . $phpEx );
				ucp_factions_add_challenge ( $id, $mode, $this->u_action );
			break;
			case 'challenges' :
				$this->tpl_name		= 'factions/ucp_factions_challenges';
				$this->page_title	= 'UCP_FACTIONS_CHALLENGES';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/ucp/factions/ucp_factions_challenges.' . $phpEx );
				ucp_factions_challenges ( $id, $mode, $this->u_action );
			break;
			case 'edit_group' :
				$this->tpl_name		= 'factions/ucp_factions_edit_group';
				$this->page_title	= 'UCP_FACTIONS_EDIT_GROUP';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/ucp/factions/ucp_factions_edit_group.' . $phpEx );
				ucp_factions_edit_group ( $id, $mode, $this->u_action );
			break;
			case 'find_group' :
				$this->tpl_name		= 'factions/ucp_factions_find_group';
				$this->page_title	= 'UCP_FACTIONS_FIND_GROUP';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/ucp/factions/ucp_factions_find_group.' . $phpEx );
				ucp_factions_find_group ( $id, $mode, $this->u_action );
			break;
			case 'matches' :
				$this->tpl_name		= 'factions/ucp_factions_matches';
				$this->page_title	= 'UCP_FACTIONS_MATCHES';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/ucp/factions/ucp_factions_matches.' . $phpEx );
				ucp_factions_matches ( $id, $mode, $this->u_action );
			break;
			case 'match_finder' :
				$this->tpl_name		= 'factions/ucp_factions_match_finder';
				$this->page_title	= 'UCP_FACTIONS_MATCH_FINDER';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/ucp/factions/ucp_factions_match_finder.' . $phpEx );
				ucp_factions_match_finder ( $id, $mode, $this->u_action );
			break;
			case 'group_members' :
				$this->tpl_name		= 'factions/ucp_factions_group_members';
				$this->page_title	= 'UCP_FACTIONS_GROUP_MEMBERS';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/ucp/factions/ucp_factions_group_members.' . $phpEx );
				ucp_factions_group_members ( $id, $mode, $this->u_action );
			break;
			case 'pending_members' :
				$this->tpl_name		= 'factions/ucp_factions_pending_members';
				$this->page_title	= 'UCP_FACTIONS_PENDING_MEMBERS';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/ucp/factions/ucp_factions_pending_members.' . $phpEx );
				ucp_factions_pending_members ( $id, $mode, $this->u_action );
			break;
			case 'invite_members' :
				$this->tpl_name		= 'factions/ucp_factions_invite_members';
				$this->page_title	= 'UCP_FACTIONS_INVITE_MEMBERS';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/ucp/factions/ucp_factions_invite_members.' . $phpEx );
				ucp_factions_invite_members ( $id, $mode, $this->u_action );
			break;
			case 'ticket' :
				$this->tpl_name		= 'factions/ucp_factions_ticket';
				$this->page_title	= 'UCP_FACTIONS_TICKET';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/ucp/factions/ucp_factions_ticket.' . $phpEx );
				ucp_factions_ticket ( $id, $mode, $this->u_action );
			break;
			case 'tournaments' :
				$this->tpl_name		= 'factions/ucp_factions_tournaments';
				$this->page_title	= 'UCP_FACTIONS_TOURNAMENTS';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/ucp/factions/ucp_factions_tournaments.' . $phpEx );
				ucp_factions_tournaments ( $id, $mode, $this->u_action );
			break;
			case 'matchcomm' :
				$this->tpl_name		= 'factions/ucp_factions_matchcomm';
				$this->page_title	= 'UCP_FACTIONS_MATCHCOMM';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/ucp/factions/ucp_factions_matchcomm.' . $phpEx );
				ucp_factions_matchcomm ( $id, $mode, $this->u_action );
			break;
		}
	}
}

?>
