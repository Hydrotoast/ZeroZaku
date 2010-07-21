<?php
/**
*
* @author idiotnesia pungkerz@gmail.com - http://www.phpbbindonesia.com
*
* @package umil
* @version 0.3.0
* @copyright (c) 2008, 2009 phpbbindonesia
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

if (!class_exists('reputation'))
{
	trigger_error('Cannot find reputation class. You must perform the editing files first.', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'REPUTATION_POINT';

// for update only
$config['reputation_version'] = '0.2.0';

/*
* The name of the config variable which will hold the currently installed version
* You do not need to set this yourself, UMIL will handle setting and updating the version itself.
*/
$version_config_name = 'reputation_version';

$language_file = 'mods/reputation_mod';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	// Version 0.2.0 and 0.2.0a -- Sorry, the previous version is not supported
	'0.2.0'	=> array(
		'config_add' => array(
			array('rp_block_per_points', '100'),
			array('rp_comment_max_chars', '255'),
			array('rp_disable_comment', '0'),
			array('rp_display', '3'),
			array('rp_enable', '0'),
			array('rp_force_comment', '1'),
			array('rp_forum_exclusions', '0'),
			array('rp_max_blocks', '10'),
			array('rp_max_power', '5'),
			array('rp_membership_days', '0'),
			array('rp_min_posts', '100'),
			array('rp_power_rep_point', '0'),
			array('rp_recent_points', '5'),
			array('rp_reg_bonus', '0'),
			array('rp_time_limitation', '12'),
			array('rp_total_posts', '100'),
			array('rp_user_spread', '5'),
		),

		'permission_add' => array(
			array('a_reputation', true),
			array('m_rp_moderate', true),
			array('u_rp_ignore', true),
			array('u_rp_give', true),
			array('u_rp_disable', true),
		),

		'permission_set' => array(
			// Global Role permissions
			array('ROLE_ADMIN_FULL', 'a_reputation'),
			array('ROLE_MOD_FULL', 'm_rp_moderate'),
			array('ROLE_USER_FULL', array('u_rp_ignore', 'u_rp_give', 'u_rp_disable')),
			array('ROLE_USER_STANDARD', 'u_rp_give'),
		),

		// Now to add a table (this uses the layout from develop/create_schema_files.php and from phpbb_db_tools)
		'table_add' => array(
			array('phpbb_reputations', array(
					'COLUMNS'		=> array(
						'rep_id'				=> array('UINT', NULL, 'auto_increment'),
						'rep_from'				=> array('UINT', 0),
						'rep_to'				=> array('UINT', 0),
						'rep_time'				=> array('TIMESTAMP', 0),
						'rep_post_id'			=> array('UINT', 0),
						'rep_point'				=> array('INT:11', 0),
						'rep_comment'			=> array('MTEXT_UNI', ''),
						'bbcode_uid'			=> array('VCHAR:8', ''),
						'bbcode_bitfield'		=> array('VCHAR:255', ''),
						'enable_bbcode'			=> array('BOOL', 1),
						'enable_smilies'		=> array('BOOL', 1),
						'enable_urls'			=> array('BOOL', 1),
					),
					'PRIMARY_KEY'	=> 'rep_id',
					),
			),

			array('phpbb_reputations_ranks', array(
					'COLUMNS'		=> array(
						'rank_id'				=> array('UINT', NULL, 'auto_increment'),
						'rank_title'			=> array('VCHAR_UNI', ''),
						'rank_points'			=> array('INT:11', 0),
					),
					'PRIMARY_KEY'	=> 'rank_id',
					),
			),
		),

		// Lets add a new column to the phpbb_test table named test_time
		'table_column_add' => array(
			array('phpbb_groups', 'group_reputation_power', array('UINT', 0)),
			array('phpbb_users', 'user_reputation', array('INT:11', 0)),
			array('phpbb_users', 'user_hide_reputation', array('BOOL', 0)),
		),

		'module_add' => array(
			// First, lets add a new category named ACP_CAT_TEST_MOD to ACP_CAT_DOT_MODS
			array('acp', 'ACP_CAT_DOT_MODS', 'ACP_RP_SETTINGS'),

            array('acp', 'ACP_RP_SETTINGS', array(
					'module_basename'	=> 'rep_settings',
				),
			),
            array('acp', 'ACP_RP_SETTINGS', array(
					'module_basename'	=> 'rep_ranks',
				),
			),
		),

	),

	// Version 0.3.0
	'0.3.0'	=> array(
		// Lets add a config setting named test_enable and set it to true
		'config_add' => array(
			array('rp_minimum_point', -5000),
			array('rp_maximum_point', 10000),
		),

		'config_remove'	=> array(
			array('rp_reg_bonus', false),
		),

		'permission_add' => array(
			array('u_rp_give_negative', true),
			array('u_rp_view_comment', true),
		),

		'permission_set' => array(
			// Global Role permissions
			array('ROLE_USER_FULL', array('u_rp_give_negative', 'u_rp_view_comment')),
			array('ROLE_USER_STANDARD', array('u_rp_give_negative', 'u_rp_view_comment')),
		),

		'table_column_add' => array(
			array('phpbb_reputations', 'rep_ip_address', array('VCHAR:40', '')),
			array('phpbb_reputations', 'username', array('VCHAR_UNI:255', '')),
		),

		'module_add' => array(
            array('acp', 'ACP_RP_SETTINGS', array(
					'module_basename'	=> 'rep_change_point',
				),
			),
		),

		'custom'	=> 'table_sync',
	),
);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

function table_sync($action, $version)
{
	global $db, $table_prefix, $umil;

	switch ($action)
	{
		case 'update' :
			// Run this when installing/updating

			if ($umil->table_exists('phpbb_reputations'))
			{
				$sql = 'SELECT u.username, u.user_id
							FROM ' . REPUTATIONS_TABLE . ' r
							LEFT JOIN  ' . USERS_TABLE . ' u ON (u.user_id = r.rep_from)
							GROUP BY u.user_id';
						$result = $db->sql_query($sql);

						while ($row = $db->sql_fetchrow($result))
						{
							$sql = 'UPDATE ' . REPUTATIONS_TABLE . "
								SET username = '" . $db->sql_escape($row['username']) . "'
								WHERE rep_from = " . (int) $row['user_id'];
							$db->sql_query($sql);
						}
						$db->sql_freeresult($result);


				// Method 1 of displaying the command (and Success for the result)
				return 'TABLE_SYNC';
			}
		break;
	}
}
?>