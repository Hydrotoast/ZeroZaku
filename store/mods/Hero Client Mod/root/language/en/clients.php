<?php
/**
*
* posting [English]
*
* @package language
* @version $Id: posting.php 9742 2009-07-09 10:34:40Z bantu $
* @copyright (c) 2005 phpBB Group
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
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ADD_ATTACHMENT'			=> 'Upload attachment',
	
	'CLIENTS_EXPLAIN'		=> 'Here you can view, edit and delete your clients. You can test your client by clicking on the ID and manually appending your client\'s password e.g. \'&password=mypassword\'.',
	'CLIENTS_ADD_EXPLAIN'	=> 'Here you can add up to 10 clients to your client index.',
	
	'CLIENT_ID'					=> 'ID',
	'CLIENT_NAME'				=> 'Client name',
	'CLIENT_NAME_EXPLAIN'		=> 'The name of your client or program',
	'CLIENT_DESC'				=> 'Client Description',
	'CLIENT_DESC_EXPLAIN'		=> 'A description of your client or program and its purpose',
	'CLIENT_PASS'				=> 'Client password',
	'CLIENT_PASS_EXPLAIN'		=> 'A custom password to prevent leechers from leaking your client',
	'CLIENT_PASSCONF'			=> 'Confirm password',
	'CLIENT_NEW_PASS'			=> 'New client password',
	'CLIENT_NEW_PASS_EXPLAIN'	=> 'Set your client\'s new password',
	'CLIENT_PASSCUR'			=> 'Current client password',
	'CLIENT_PASSCUR_EXPLAIN'	=> 'You must confirm your current password if you wish to change it',
	'CLIENT_USES'				=> 'Times Used',
	'CLIENT_DETAILS'			=> 'Client details',
	
	'CLIENT_ADDED'			=> 'Client has been successfully added.',
	'CLIENT_UPDATED'		=> 'Client has been successfully updated',
	'CLIENTS_DELETED'		=> 'The selected clients have been deleted.',
	
	'PASS_NO_MATCH'			=> 'The client password and confirmation password do not match',
	'PASS_NO_MATCH_OR_CUR'	=> 'The client password and confirmation password do not match or your current password was incorrect',
	'TOO_MANY_CLIENTS'		=> 'You may only have a maximum of 10 clients',
	'NO_CLIENTS'			=> 'You have no clients at this time',
	
	'EMPTY_CLIENT_NAME'		=> 'Client name cannot be empty',
	'EMPTY_CLIENT_PASS'		=> 'Client password cannot be empty',
	
	'CLIENT_ADD'			=> 'Add a new client',
));

?>