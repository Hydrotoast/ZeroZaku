<?php

/**
*
* @author Mav (Jamie Hall) mail@packetecho.com
* @package umil
* @copyright (c) 2010 Mav
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*

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

// The name of the mod to be displayed during installation.
$mod_name = 'Community Moderation';

/*
* The name of the config variable which will hold the currently installed version
* You do not need to set this yourself, UMIL will handle setting and updating the version itself.
*/
$version_config_name = 'community_moderation_version';

/*
* The language file which will be included when installing
* Language entries that should exist in the language file for UMIL (replace $mod_name with the mod's name you set to $mod_name above)
* $mod_name
* 'INSTALL_' . $mod_name
* 'INSTALL_' . $mod_name . '_CONFIRM'
* 'UPDATE_' . $mod_name
* 'UPDATE_' . $mod_name . '_CONFIRM'
* 'UNINSTALL_' . $mod_name
* 'UNINSTALL_' . $mod_name . '_CONFIRM'
*/
$language_file = 'mods/community_moderation';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	// Version 0.0.1
	'0.0.1'	=> array(
		// Add a table
		'table_add' => array(
			array('phpbb_posts_votes', array(
					'COLUMNS'				=> array(
						'post_vote_id'		=> array('BINT', NULL, 'auto_increment'),
						'post_id'			=> array('UINT', 0),
						'user_id'			=> array('UINT', 0),
						'adjust'			=> array('BOOL', 0),
						'vote_time'			=> array('TIMESTAMP', 0),
						'voter_ip'			=> array('VCHAR:40', ''),
					),
					'PRIMARY_KEY'   => 'post_vote_id',
				),
			),
		),

		// Add a column
		'table_column_add' => array(
			array(POSTS_TABLE, 'post_upvotes', array('UINT', 0),
			),
			array(POSTS_TABLE, 'post_downvotes', array('UINT', 0),
			),
			array(USERS_TABLE, 'user_posts_bury_threshold', array('TINT:2', -3),
			),
		),

		// Lets add some config settings
		'config_add' => array(
			array('enable_community_moderation', '0'),
			array('posts_bury_threshold', '-3'),
		),

		// Now to add some permission settings
		'permission_add' => array(
			array('f_post_vote', 0),
		),

		// How about we give some default permissions then as well?
		'permission_set' => array(
			array('ROLE_FORUM_FULL', 'f_post_vote'),
			array('ROLE_FORUM_STANDARD', 'f_post_vote'),
			array('ROLE_FORUM_POLLS', 'f_post_vote'),
		),
	),

	// Version 0.0.2
	'0.0.2'	=> array(
		// nothing changed in this version
	),

	// Version 0.0.3
	'0.0.3'	=> array(
		// Add a column
		'table_column_add' => array(
			array(USERS_TABLE, 'user_posts_bury_hide', array('BOOL', 0),
			),
		),

		// Lets add some more config settings
		'config_add' => array(
			array('enable_community_moderation_ups', '0'),
			array('community_moderation_ups_up', '0.01'),
			array('community_moderation_ups_down', '0'),
		),

		// Now to add some permission settings
		'permission_add' => array(
			array('u_com_threshold', 1),
			array('u_com_style', 1),
			array('a_com_mod', 1),
		),

		// How about we give some default permissions then as well?
		'permission_set' => array(
			array('ROLE_USER_FULL', 'u_com_threshold'),
			array('ROLE_USER_FULL', 'u_com_style'),
			array('ROLE_USER_STANDARD', 'u_com_threshold'),
			array('ROLE_USER_STANDARD', 'u_com_style'),
			array('ROLE_ADMIN_STANDARD', 'a_com_mod'),
			array('ROLE_ADMIN_FULL', 'a_com_mod'),
		),

		// and last but not least...a module
		'module_add' => array(
			// First, lets add a new category named ACP_CAT_COM_MOD to ACP_CAT_DOT_MODS
			array('acp', 'ACP_CAT_DOT_MODS', 'ACP_CAT_COM_MOD'),

			// next let's add our module
			array('acp', 'ACP_CAT_COM_MOD', array(
					'module_basename'	=> 'community_moderation',
					'modes'				=> array('configuration'),
					'module_auth'		=> 'a_com_mod',
				),
			),
		),

		// Our final action, we purge the board cache
		'cache_purge' => array(
			array('imageset', 0),
			array('theme', 0),
			array('template', 0),
			array(),
		),
	),
);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

/*
*
* @param string $action The action (install|update|uninstall) will be sent through this.
* @param string $version The version this is being run for will be sent through this.
*/

?>