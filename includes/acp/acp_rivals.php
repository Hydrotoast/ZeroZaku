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

class acp_rivals
{
	var	$u_action;

	function main ( $id, $mode )
	{
		global	$db, $user, $config, $template;
		global	$phpbb_root_path, $phpbb_admin_path, $phpEx;

		// Include Rivals' classes.
		include ( $phpbb_root_path . 'includes/functions_user.' . $phpEx );
		include ( $phpbb_root_path . 'rivals/classes/class_group.' . $phpEx );
		include ( $phpbb_root_path . 'rivals/classes/class_tournament.' . $phpEx );
		include ( $phpbb_root_path . 'rivals/classes/class_ladder.' . $phpEx );
		include ( $phpbb_root_path . 'rivals/functions.' . $phpEx );
		include ( $phpbb_root_path . 'includes/functions_privmsgs.' . $phpEx );

		// Setup the language.
		$user->add_lang ( 'mods/lang_rivals' );

		// Switch between the modes to manage Rivals.
		switch ( $mode )
		{
			case 'main' :
				$this->tpl_name		= 'rivals/acp_rivals_main';
				$this->page_title	= 'ACP_RIVALS';

				// Get the number of groups.
				$sql	= "SELECT COUNT(gd.group_id) AS the_groups, ud.* FROM " . GROUPS_TABLE . " gd, " . USER_GROUP_TABLE . " ud WHERE gd.group_id = ud.group_id AND ud.group_leader = 1 AND group_type = " . GROUP_HIDDEN . " GROUP BY group_id";
				$result	= $db->sql_query ( $sql );
				$row	= $db->sql_fetchrow ( $result );
				$db->sql_freeresult ( $result );
				$groups	= $row[ 'the_groups' ];

				// Get the challenges.
				$sql		= "SELECT COUNT(challenge_id) AS the_challenges FROM " . CHALLENGES_TABLE;
				$result		= $db->sql_query ( $sql );
				$row		= $db->sql_fetchrow ( $result );
				$db->sql_freeresult ( $result );
				$challenges	= $row[ 'the_challenges' ];

				// Get the on-going matches.
				$sql		= "SELECT COUNT(match_id) AS the_ogmatches FROM " . MATCHES_TABLE . " WHERE match_finishtime = 0";
				$result		= $db->sql_query ( $sql );
				$row		= $db->sql_fetchrow ( $result );
				$db->sql_freeresult ( $result );
				$ogmatches	= $row[ 'the_ogmatches' ];

				// Get the finished matches.
				$sql		= "SELECT COUNT(match_id) AS the_matches FROM " . MATCHES_TABLE . " WHERE match_finishtime > 0";
				$result	= $db->sql_query ( $sql );
				$row		= $db->sql_fetchrow ( $result );
				$db->sql_freeresult ( $result );
				$matches	= $row[ 'the_matches' ];
					
				// Assign the other variables to the template
				$template->assign_vars ( array (
					'BYE_GROUP' => $config[ 'rivals_byegroup' ],
					'CHALLENGES' => $challenges,
					'ONGOING_MATCHES' => $ogmatches,
					'FINISHED_MATCHES' => $matches,
					'GROUPS' => $groups )
				);
			break;
			case 'add_ladder' :
				$this->tpl_name		= 'rivals/acp_rivals_add_ladder';
				$this->page_title	= 'ACP_RIVALS_ADD_LADDER';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_add_ladder.' . $phpEx );
				acp_rivals_add_ladder ( $id, $mode, $this->u_action );
			break;
			case 'add_platform' :
				$this->tpl_name		= 'rivals/acp_rivals_add_platform';
				$this->page_title	= 'ACP_RIVALS_ADD_PLATFORM';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_add_platform.' . $phpEx );
				acp_rivals_add_platform ( $id, $mode, $this->u_action );
			break;
			case 'add_tournament' :
				$this->tpl_name		= 'rivals/acp_rivals_add_tournament';
				$this->page_title	= 'ACP_RIVALS_ADD_TOURNAMENT';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_add_tournament.' . $phpEx );
				acp_rivals_add_tournament ( $id, $mode, $this->u_action );
			break;
			case 'configure' :
				$this->tpl_name		= 'rivals/acp_rivals_configure';
				$this->page_title	= 'ACP_RIVALS_CONFIGURE';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_configure.' . $phpEx );
				acp_rivals_configure ( $id, $mode, $this->u_action );
			break;
			case 'edit_brackets' :
				$this->tpl_name		= 'rivals/acp_rivals_edit_brackets';
				$this->page_title	= 'ACP_RIVALS_EDIT_BRACKETS';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_edit_brackets.' . $phpEx );
				acp_rivals_edit_brackets ( $id, $mode, $this->u_action );
			break;
			case 'edit_groups' :
				$this->tpl_name		= 'rivals/acp_rivals_edit_groups';
				$this->page_title	= 'ACP_RIVALS_EDIT_GROUPS';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_edit_groups.' . $phpEx );
				acp_rivals_edit_groups ( $id, $mode, $this->u_action );
			break;
			case 'edit_ladders' :
				$this->tpl_name		= 'rivals/acp_rivals_edit_ladders';
				$this->page_title	= 'ACP_RIVALS_EDIT_LADDERS';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_edit_ladders.' . $phpEx );
				acp_rivals_edit_ladders ( $id, $mode, $this->u_action );
			break;
			case 'edit_ladder' :
				$this->tpl_name		= 'rivals/acp_rivals_edit_ladder';
				$this->page_title	= 'ACP_RIVALS_EDIT_LADDER';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_edit_ladder.' . $phpEx );
				acp_rivals_edit_ladder ( $id, $mode, $this->u_action );
			break;
			case 'edit_subladder' :
				$this->tpl_name		= 'rivals/acp_rivals_edit_subladder';
				$this->page_title	= 'ACP_RIVALS_EDIT_SUBLADDER';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_edit_subladder.' . $phpEx );
				acp_rivals_edit_subladder ( $id, $mode, $this->u_action );
			break;
			case 'edit_platforms' :
				$this->tpl_name		= 'rivals/acp_rivals_edit_platforms';
				$this->page_title	= 'ACP_RIVALS_EDIT_PLATFORMS';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_edit_platforms.' . $phpEx );
				acp_rivals_edit_platforms ( $id, $mode, $this->u_action );
			break;
			case 'edit_tournaments' :
				$this->tpl_name		= 'rivals/acp_rivals_edit_tournaments';
				$this->page_title	= 'ACP_RIVALS_EDIT_TOURNAMENTS';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_edit_tournaments.' . $phpEx );
				acp_rivals_edit_tournaments ( $id, $mode, $this->u_action );
			break;
			case 'report_match' :
				$this->tpl_name		= 'rivals/acp_rivals_report_match';
				$this->page_title	= 'ACP_RIVALS_REPORT_MATCH';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_report_match.' . $phpEx );
				acp_rivals_report_match ( $id, $mode, $this->u_action );
			break;
			case 'seed_tournament' :
				$this->tpl_name		= 'rivals/acp_rivals_seed_tournament';
				$this->page_title	= 'ACP_RIVALS_SEED_TOURNAMENT';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_seed_tournament.' . $phpEx );
				acp_rivals_seed_tournament ( $id, $mode, $this->u_action );
			break;
			case 'edit_tournament' :
				$this->tpl_name		= 'rivals/acp_rivals_edit_tournament';
				$this->page_title	= 'ACP_RIVALS_EDIT_TOURNAMENT';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_edit_tournament.' . $phpEx );
				acp_rivals_edit_tournament ( $id, $mode, $this->u_action );
			break;
			case 'manage_seasons' :
				$this->tpl_name		= 'rivals/acp_rivals_manage_seasons';
				$this->page_title	= 'ACP_RIVALS_MANAGE_SEASONS';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_manage_seasons.' . $phpEx );
				acp_rivals_manage_seasons ( $id, $mode, $this->u_action );
			break;
			case 'add_season' :
				$this->tpl_name		= 'rivals/acp_rivals_add_season';
				$this->page_title	= 'ACP_RIVALS_ADD_SEASON';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_add_season.' . $phpEx );
				acp_rivals_add_season ( $id, $mode, $this->u_action );
			break;
			case 'edit_season' :
				$this->tpl_name		= 'rivals/acp_rivals_edit_season';
				$this->page_title	= 'ACP_RIVALS_EDIT_SEASON';

				// Include the file for this mode.
				include ( $phpbb_root_path . 'includes/acp/rivals/acp_rivals_edit_season.' . $phpEx );
				acp_rivals_edit_season ( $id, $mode, $this->u_action );
			break;
		}
	}
}

?>
