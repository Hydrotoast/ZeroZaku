<?php
/**
*
* 
* @package language
* @version $Id: umil_poll_vote_reminder_install.php, v 1.0.0 2009/08/30 12:53:34  Exp $
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
		'INSTALL_POLL_VOTE_REMINDER'				=> 'Install Poll vote reminder',
		'INSTALL_POLL_VOTE_REMINDER_CONFIRM'		=> 'Are you ready to install the Poll vote reminder Mod?',
		'POLL_VOTE_REMINDER'						=> 'Poll vote reminder',
		'POLL_VOTE_REMINDER_EXPLAIN'				=> 'Install Poll vote reminder database changes with UMIL auto method.',
		'UNINSTALL_POLL_VOTE_REMINDER'				=> 'Uninstall Poll vote reminder',
		'UNINSTALL_POLL_VOTE_REMINDER_CONFIRM'		=> 'Are you ready to uninstall the Poll vote reminder? All settings and data saved by this mod will be removed!',
		'UPDATE_POLL_VOTE_REMINDER'					=> 'Update Poll vote reminder Mod',
		'UPDATE_POLL_VOTE_REMINDER_CONFIRM'			=> 'Are you ready to update the Poll vote reminder Mod?',

));

?>