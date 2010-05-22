<?php
/**
*
* @author mtrs (mtrs) trst2007@gmail.com 
* @package umil
* @version $Id: install_vote_reminder.php, v1.0.0 2009/08/30 12:53:34 Exp $
* @copyright (c) 2009 mtrs 
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

if (!isset($config['vote_reminder_enable']))
{
	$config['vote_reminder_enable'] = 0;
	$user->data['user_vote_reminder'] = 0;	
}

// The name of the mod to be displayed during installation.
$mod_name = 'POLL_VOTE_REMINDER';

/*
* The name of the config variable which will hold the currently installed version
* You do not need to set this yourself, UMIL will handle setting and updating the version itself.
*/
$version_config_name = 'vote_reminder_version';

$language_file = 'mods/umil_vote_reminder_install';

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
		// Lets add config settings
		'config_add' => array(
			array('vote_reminder_topic_id', '0'),
			array('vote_reminder_optional', '0'),
		),
		// Lets add a new column to the phpbb_users and topics table
		'table_column_add' => array(
			array('phpbb_users', 'user_vote_reminder', array('BOOL', 0)),
			array('phpbb_topics', 'poll_vote_compulsory', array('BOOL', 0)),
		),		
	),
	
	// Version 0.0.2
	'0.0.2' => array(
		// Nothing changed in this version.
	),
	
	// Version 1.0.0-RC1
	'1.0.0-RC1' => array(
		// Nothing changed in this version.
		// Lets add config settings
		'config_add' => array(
			array('vote_reminder_enable', false),
		),
		// Lets remove config settings
		'config_remove' => array(
			array('vote_reminder_optional', '0'),
		),
		
		// Alright, now lets add some modules to the ACP
		'module_add' => array(
			// Now we will add the avatar mode from acp_board to the ACP_CAT_TEST_MOD category using the "manual" method.
            array('acp', 'ACP_MESSAGES', array(
			'module_basename'   => 'vote_reminder',
			'module_langname'   => 'ACP_VOTE_REMINDER',
			'module_mode'       => 'votes',
			'module_auth'       => 'acl_a_forum',
				)
			),
		),		
		
	),
	
	// Version 1.0.0-RC2
	'1.0.0-RC2' => array(
		// Lets add config settings
		'config_add' => array(
			array('vote_reminder_who_voted', false),
		),
		// Now to add some permission settings
		'permission_add' => array(
			array('u_vote_reminder', true),
		),		
	),
	
	// Version 1.0.0-RC3
	'1.0.0-RC3' => array(
		// Lets add config settings
		'config_add' => array(
			array('vote_reminder_interval', '0'),
		),
		// Lets add a new column to the phpbb_users and topics table
		'table_column_add' => array(
			array('phpbb_users', 'user_last_vote_reminder', array('TIMESTAMP', 0)),
		),		
	),
	
	// Version 1.0.0
	'1.0.0' => array(
		// Lets update a column in phpbb_users, thus new registered users won't have to cast votes once logging in to board
		'table_column_update' => array(
			array('phpbb_users', 'user_vote_reminder', array('BOOL', 1)),
		),		
		// Nothing changed in this version.
	),

	
);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);


?>