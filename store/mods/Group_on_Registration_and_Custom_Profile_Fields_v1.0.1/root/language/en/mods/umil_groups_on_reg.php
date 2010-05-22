<?php
/**
*
* 
* @package language
* @version $Id: umil_groups_on_reg.php, v 1.0.1 2009/1/21 12:53:34  Exp $
* @copyright (c) 2009 mtrs
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang)) 
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM
//

$lang = array_merge($lang, array(
		'INSTALL_GROUPS_ON_REGISTRATION'				=> 'Install Groups on Registration and Custom Profile Fields',
		'INSTALL_GROUPS_ON_REGISTRATION_CONFIRM'		=> 'Are you ready to install the Groups on Registration and Custom Profile Fields Mod?',
		'GROUPS_ON_REGISTRATION'						=> 'Groups on Registration and Custom Profile Fields',
		'GROUPS_ON_REGISTRATION_EXPLAIN'				=> 'Install Groups on Registration and Custom Profile Fields database changes with UMIL auto method.',
		'UNINSTALL_GROUPS_ON_REGISTRATION'				=> 'Uninstall Groups on Registration and Custom Profile Fields',
		'UNINSTALL_GROUPS_ON_REGISTRATION_CONFIRM'		=> 'Are you ready to uninstall the Groups on Registration and Custom Profile Fields? All settings and data saved by this mod will be removed!',
		'UPDATE_GROUPS_ON_REGISTRATION'					=> 'Update Groups on Registration and Custom Profile Fields Mod',
		'UPDATE_GROUPS_ON_REGISTRATION_CONFIRM'			=> 'Are you ready to update the Groups on Registration and Custom Profile Fields Mod?',

));

?>