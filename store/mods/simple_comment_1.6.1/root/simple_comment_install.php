<?php
/**
*
* @author platinum_2007 (Ian Taylor) iantaylor603@gmail.com
* @package umil
* @version $Id simple_comment_install.php 1.6.1-RC 2009-03-22 16:56:28GMT platinum_2007 $
* @copyright (c) 2009 ian taylor
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

// The name of the mod to be displayed during installation.
$mod_name = 'SIMPLE_COMMENT_MOD';

/*
* The name of the config variable which will hold the currently installed version
* You do not need to set this yourself, UMIL will handle setting and updating the version itself.
*/
$version_config_name = 'simple_comment_version';

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
$language_file = 'mods/simple_comment_mod';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	// Version 1.4.0
	'1.4.0' => array(
		'table_add' => array(
			array('phpbb_comment', array(
				'COLUMNS'	=> array(
					'comment_id'			=> array('UINT', NULL, 'auto_increment'),
					'comment_date'			=> array('VCHAR', ''),
					'comment_poster_id'		=> array('UINT', '0'),
					'comment_text'			=> array('TEXT', ''),
					'comment_to_id'			=> array('UINT', '0'),
					'comment_author'		=> array('VCHAR', '0'),
					'bbcode_bitfield'		=> array('VCHAR', ''),
					'bbcode_uid'			=> array('VCHAR', ''),
					'bbcode_options'		=> array('UINT', '0'),
					'enable_smilies'		=> array('TINT:', 1),
					'enable_bbcode'			=> array('TINT:', 1),
					'enable_magic_url'		=> array('TINT:', 1),
				),
				'PRIMARY_KEY' => array('comment_id'),
			)),
		),
		'table_column_add' => array(
			array(USERS_TABLE, 'user_last_comment', array('INT:', '0')),
		),
		 'module_add' => array(
		 		 array('acp', 'ACP_CAT_DOT_MODS', 'ACP_COMMENT'),
		 		 
		           array('acp', 'ACP_COMMENT', array(
                                        'module_basename'                => 'comment',
                                        'modes'                          => array('index'),
                                ),
                        ),
                  
),

		'config_add' => array(
			array('simple_comment_enable', true),
			array('comm_per_page', '20'),
			array('enable_qc', '1'),
			array('enable_comment', '1'),
			array('sc_av_size', '50'),
		),
		'cache_purge' => '',
	),
	
	'1.5.0'	=>	array(
		'table_column_add' => array(
			array(USERS_TABLE, 'allow_all_comment', array('INT:', '1')),
			array(USERS_TABLE, 'allow_friend_only', array('INT:', '0')),
			array(USERS_TABLE, 'allow_friend_view', array('INT:', '0')),
			array(USERS_TABLE, 'allow_comment_email', array('INT:', '0')),

		),
	),
	// nothing new here
	'1.6.0-RC'	=>	array(
	
	),
	'1.6.1-RC'	=>	array(
	
	),
	'1.6.1'	=>	array(
	
	),
);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

?>