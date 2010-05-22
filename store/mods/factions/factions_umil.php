<?php
##############################################################
# FILENAME  : factions_umil.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
define ( 'UMIL_AUTO', true );
define ( 'IN_PHPBB', true );
$phpbb_root_path	= ( defined ( 'PHPBB_ROOT_PATH' ) ) ? PHPBB_ROOT_PATH : './';
$phpEx				= substr ( strrchr ( __FILE__, '.' ), 1 );
include ( $phpbb_root_path . 'common.' . $phpEx );

// Initilize the phpBB sessions.
$user->session_begin ( );
$auth->acl ( $user->data );
$user->setup ( );

if ( !file_exists ( $phpbb_root_path . 'umil/umil_auto.' . $phpEx ) )
{
	trigger_error ( 'Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR );
}

// The mod's name and config variable.
$mod_name				= 'PHPBB_FACTIONS';
$version_config_name	= 'factions_version';
$language_file			= 'mods/factions_umil';

// The mod's versions.
$versions	= array (
	// Version 2.0.9
	'2.0.9'	=> array (
		'config_add'	=> array (
			array ( 'factions_version', true ),
			array ( 'factions_ticketreceiver', 2 ),
			array ( 'factions_byegroup', 0 )
		),
		'config_update'	=> array (
			array ( 'avatar_max_height', 400 ),
			array ( 'avatar_max_width', 400 ),
			array ( 'avatar_filesize', 30000 ),
		),

		'table_column_add' => array (
			array ( 'phpbb_groups', 'group_tournaments', array ( 'VCHAR:255', 'N/A' ) ),
			array ( 'phpbb_users', 'group_session', array ( 'UINT', 0 ) ),
		),

		'table_add'	=> array (
			array ( 'phpbb_factions_challenges', array (
					'COLUMNS'		=> array (
						'challenge_id' => array ( 'UINT', NULL, 'auto_increment' ),
						'challenge_ladder' => array ( 'UINT', 0 ),
						'challenger' => array ( 'UINT', 0 ),
						'challengee' => array ( 'UINT', 0 ),
						'challenge_unranked' => array ( 'UINT', 0 ),
						'challenge_posttime' => array ( 'INT:11', 0 ),
						'challenge_details' => array ( 'TEXT_UNI', '' )
					),
					'PRIMARY_KEY'	=> 'challenge_id',
				),
			),
			array ( 'phpbb_factions_treports', array (
					'COLUMNS'		=> array (
						'report_id' => array ( 'UINT', NULL, 'auto_increment' ),
						'reported' => array ( 'UINT', 0 ),
						'tournament_id' => array ( 'UINT', 0 ),
						'group_1' => array ( 'UINT', 0 ),
						'group_2' => array ( 'UINT', 0 ),
						'group_winner' => array ( 'UINT', 0 )
					),
					'PRIMARY_KEY'	=> 'report_id',
				),
			),
			array ( 'phpbb_factions_matchfinder', array (
					'COLUMNS'		=> array (
						'match_id' => array ( 'UINT', NULL, 'auto_increment' ),
						'match_groupid' => array ( 'UINT', 0 ),
						'match_ladder' => array ( 'UINT', 0 ),
						'match_time' => array ( 'INT:11', 0 ),
						'match_initaltime' => array ( 'INT:11', 0 )
					),
					'PRIMARY_KEY'	=> 'match_id',
				),
			),
			array ( 'phpbb_factions_platforms', array (
					'COLUMNS'		=> array (
						'platform_id' => array ( 'UINT', NULL, 'auto_increment' ),
						'platform_name' => array ( 'VCHAR_UNI:255', '' )
					),
					'PRIMARY_KEY'	=> 'platform_id',
				),
			),
			array ( 'phpbb_factions_tgroups', array (
					'COLUMNS'		=> array (
						'group_tournament' => array ( 'UINT', 0 ),
						'group_id' => array ( 'UINT', 0 ),
						'group_bracket' => array ( 'UINT', 0 ),
						'group_position' => array ( 'UINT', 0 ),
						'group_loser' => array ( 'UINT', 0 ),
					)
				),
			),
			array ( 'phpbb_factions_seasons', array (
					'COLUMNS'		=> array (
						'season_id' => array ( 'UINT', NULL, 'auto_increment' ),
						'season_name' => array ( 'VCHAR_UNI:255', '' ),
						'season_ladder' => array ( 'UINT', 0 ),
						'season_status' => array ( 'UINT', 1 )
					),
					'PRIMARY_KEY'	=> 'season_id',
				),
			),
			array ( 'phpbb_factions_tournaments', array (
					'COLUMNS'		=> array (
						'tournament_id' => array ( 'UINT', NULL, 'auto_increment' ),
						'tournament_name' => array ( 'VCHAR_UNI', '' ),
						'tournament_brackets' => array ( 'UINT', 0 ),
						'tournament_status' => array ( 'UINT', 0 ),
						'tournament_type' => array ( 'UINT', 0 ),
						'tournament_season' => array ( 'UINT', 0 ),
						'tournament_finishedgroups' => array ( 'TEXT_UNI', '' ),
						'tournament_info' => array ( 'TEXT_UNI', '' ),
						'tournament_invite' => array ( 'TEXT_UNI', '' ),
						'tournament_direction' => array ( 'UINT', 0 ),
						'tournament_time' => array ( 'INT:11', 0 ),
						'tournament_startdate' => array ( 'INT:11', 0 ),
						'tournament_ladder' => array ( 'UINT', 0 ),
						'tournament_rm' => array ( 'UINT', 0 ),
						'bbcode_uid' => array ( 'VCHAR_UNI:8', '' ),
						'bbcode_bitfield' => array ( 'VCHAR_UNI:255', '' ),
						'bbcode_options' => array ( 'INT:4', 0 )
					),
					'PRIMARY_KEY'	=> 'tournament_id',
				),
			),
			array ( 'phpbb_factions_matches', array (
					'COLUMNS'		=> array (
						'match_id' => array ( 'UINT', NULL, 'auto_increment' ),
						'match_ladder' => array ( 'UINT', 0 ),
						'match_challenger' => array ( 'UINT', 0 ),
						'match_challengee' => array ( 'UINT', 0 ),
						'match_status' => array ( 'UINT', 0 ),
						'match_unranked' => array ( 'UINT', 0 ),
						'match_finishtime' => array ( 'INT:11', 0 ),
						'match_posttime' => array ( 'INT:11', 0 ),
						'match_details' => array ( 'TEXT_UNI', '' ),
						'match_winner' => array ( 'UINT', 0 ),
						'match_loser' => array ( 'UINT', 0 ),
						'match_winnerscore' => array ( 'UINT', 0 ),
						'match_loserscore' => array ( 'UINT', 0 )
					),
					'PRIMARY_KEY'	=> 'match_id',
				),
			),
			array ( 'phpbb_factions_ladders', array (
					'COLUMNS'		=> array (
						'ladder_id' => array ( 'UINT', NULL, 'auto_increment' ),
						'ladder_name' => array ( 'VCHAR_UNI:255', '' ),
						'ladder_desc' => array ( 'TEXT_UNI', '' ),
						'ladder_rules' => array ( 'TEXT_UNI', '' ),
						'ladder_order' => array ( 'UINT', 0 ),
						'ladder_rm' => array ( 'UINT', 0 ),
						'subladder_order' => array ( 'UINT', 0 ),
						'ladder_locked' => array ( 'UINT', 0 ),
						'ladder_cl' => array ( 'UINT', 1 ),
						'ladder_ranking' => array ( 'UINT', 0 ),
						'ladder_parent' => array ( 'UINT', 0 ),
						'ladder_platform' => array ( 'UINT', 0 ),
						'bbcode_uid' => array ( 'VCHAR_UNI:8', '' ),
						'bbcode_bitfield' => array ( 'VCHAR_UNI:255', '' ),
						'bbcode_options' => array ( 'INT:4', 0 )
					),
					'PRIMARY_KEY'	=> 'ladder_id',
				),
			),
			array ( 'phpbb_factions_seasondata', array (
					'COLUMNS'		=> array (
						'group_id' => array ( 'UINT', 0 ),
						'season_id' => array ( 'UINT', 0 ),
						'group_wins' => array ( 'UINT', 0 ),
						'group_losses' => array ( 'UINT', 0 ),
						'group_score' => array ( 'UINT', 0 ),
						'group_streak' => array ( 'TEXT_UNI', '' ),
						'group_current_rank' => array ( 'UINT', 0 ),
						'group_last_rank' => array ( 'UINT', 0 ),
						'group_best_rank' => array ( 'UINT', 0 ),
						'group_ladder' => array ( 'UINT', 0 ),
						'group_worst_rank' => array ( 'UINT', 0 )
					)
				),
			),
			array ( 'phpbb_factions_matchcomm', array (
					'COLUMNS'		=> array (
						'match_id' => array ( 'UINT', 0 ),
						'group_id' => array ( 'UINT', 0 ),
						'matchcomm_message' => array ( 'TEXT_UNI', '' ),
						'matchcomm_time' => array ( 'INT:11', 0 ),
						'matchcomm_unread' => array ( 'UINT', 1 )
					)
				),
			),
			array ( 'phpbb_factions_groupdata', array (
					'COLUMNS'		=> array (
						'group_id' => array ( 'UINT', 0 ),
						'group_wins' => array ( 'UINT', 0 ),
						'group_losses' => array ( 'UINT', 0 ),
						'group_score' => array ( 'UINT', 0 ),
						'group_streak' => array ( 'TEXT_UNI', '' ),
						'group_current_rank' => array ( 'UINT', 0 ),
						'group_ladder' => array ( 'UINT', 0 ),
						'group_last_rank' => array ( 'UINT', 0 ),
						'group_best_rank' => array ( 'UINT', 0 ),
						'group_lastscore' => array ( 'UINT', 0 ),
						'group_worst_rank' => array ( 'UINT', 0 )
					)
				),
			),
		),

		'custom' => 'module_installer'
	)
);

function module_installer ( )
{
	global	$phpbb_root_path, $phpEx;

	include ( $phpbb_root_path . 'factions/functions_install.' . $phpEx );

	$error	= array ( );
	install_module ( 'acp', 'acp_factions', $error, 'ACP_CAT_FACTIONS' );
	install_module ( 'ucp', 'ucp_factions', $error, 'UCP_CAT_FACTIONS' );
}

// Include the UMIF Auto file and everything else will be handled automatically.
include ( $phpbb_root_path . 'umil/umil_auto.' . $phpEx );
?>
