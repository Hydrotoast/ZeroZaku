<?php
/**
*
* @author mtrs (mtrs) trst2007@gmail.com 
* @package umil
* @version $Id: install_groups_cpf_reg.php, v1.0.1 2009/11/21 12:53:34 Exp $
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

// The name of the mod to be displayed during installation.
$mod_name = 'GROUPS_ON_REGISTRATION';

/*
* The name of the config variable which will hold the currently installed version
* You do not need to set this yourself, UMIL will handle setting and updating the version itself.
*/
$version_config_name = 'groups_on_reg_version';

$language_file = 'mods/umil_groups_on_reg';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(

	// Version 0.0.3
	'0.0.3'	=> array(
		// Lets add config settings
		'config_add' => array(
			array('groups_on_reg_enable', false),
			array('groups_require', false),
			array('groups_default', false),	
			array('groups_to_cpf_enable', false),
			array('groups_field_name', ''),
			array('groups_lang_value', ''),
		),
	),
	
	// Version 1.0.0-RC1
	'1.0.0-RC1'	=> array(
		// Lets remove some config fields
		'config_remove' => array(
			array('groups_field_name'),
			array('groups_lang_value'),
		),
		
		// Alright, now lets add some modules to the ACP
		'module_add' => array(
			// Now we will add the groups on registration modul to ACP_GROUPS category using the "manual" method.
			array('acp', 'ACP_GROUPS', array(
					'module_basename'   => 'groups_reg',
					'module_langname'   => 'ACP_GROUPS_REGS',
					'module_mode'       => 'groups_reg',
					'module_auth'       => 'acl_a_group',
				),
			),
		),		
	
		// Lets add new columns to the phpbb_groups and phpbb_profile_fields_lang
		'table_column_add' => array(
			array('phpbb_groups', 'display_on_registration', array('BOOL', 0)),
			array('phpbb_profile_fields_lang', 'group_id', array('UINT', 0)),
			array('phpbb_profile_fields_lang', 'group_name', array('VCHAR:255', '')),
		),
	),

	// Version 1.0.0-RC2
	'1.0.0-RC2' => array(
		// Nothing changed in this version.
	),
	
	// Version 1.0.0-RC3
	'1.0.0-RC3' => array(
		// Nothing changed in this version.
	),
	
	// Version 1.0.0-RC4
	'1.0.0-RC4' => array(
		// Lets add config settings
		'config_add' => array(
			array('groups_on_reg_multiple', false),
		),
	),
	
	// Version 1.0.0-RC5
	'1.0.0-RC5' => array(
		// Lets add config settings
		'config_add' => array(
			array('groups_to_cpf_no_pending', false),
		),
	),
	
	// Version 1.0.0
	'1.0.0' => array(
		// Nothing changed in this version.
	),
	
	// Version 1.0.1
	'1.0.1' => array(
		// Nothing changed in this version.
	),		

);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);


?>