<?php
/**
*
* inactive_users [English]
*
* @package language
* @version $Id: inactive_users.php,v 0.2.6 2008/09/30 15:35:00 mtrs Exp $
* @copyright (c) 2008 mtrs
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
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'INACTIVE_USERS_ENABLE'					=> 'Enable inactive users',
	'INACTIVE_USERS_TITLES'					=> 'Inactive and Banned Users` Custom Titles & Avatars',
	'INACTIVE_USERS_EXCL_VIEW_BAN'			=> 'Enable viewtopic banned/suspended option',
	'INACTIVE_USERS_EXCL_VIEW_TIME' 		=> 'Enable viewtopic inactive time option', 
	'INACTIVE_USERS_EXCL_PROF_BAN' 			=> 'Enable profile banned/suspended option',
	'INACTIVE_USERS_EXCL_PROF_TIME' 		=> 'Enable profile inactive time option', 
	'INACTIVE_USERS_AVATAR_VIEW_ENABLE'		=> 'Enable Custom avatars in viewtopic',
	'INACTIVE_USERS_AVATAR_PROF_ENABLE'		=> 'Enable Custom avatars in profiles',
	'INACTIVE_USERS_NO_AVATAR' 				=> 'Enable default avatars',
	'INACTIVE_USERS_NO_AVATAR_EXPLAIN' 		=> 'Users having less than 25 posts take different default avatar',
	'INACTIVE_USERS_PERIOD'					=> 'Inactive custom title period',
	'INACTIVE_USERS_PERIOD_EXPLAIN'			=> 'Enter the number of months inactive users will be assigned Custom Title of "Inactive for X months', 
	'INACTIVE_USERS_EXC_IDS'				=> 'Inactive Users to be excluded by user_id',
	'INACTIVE_USERS_EXC_IDS_EXPLAIN'		=> 'Enter specific user_ids to be excluded from this mod. Maximum 255 characters can be entered',
	'INACTIVE_USERS_INCLUDED_IDS'			=> 'User who can only see this mod output.',
	'INACTIVE_USERS_INCLUDED_IDS_EXPLAIN'	=> 'Only the user_ids entered will have mod enabled, thus see Custom titles and avatars. When you fill this field, the other options (except default avatar) above are disabled for other users. Leave empty to disable this field.',
	'MOD_INSTALLED'							=> 'Mod installed successfully. Please remove the install_inactive_users.php script.',
	'INSTALL_INACTIVE_USERS'				=> 'Install Inactive Users mod',
	'MOD_INSTALLED'							=> 'Installed successfully. Please remove install_inactive_users.php file.',
	
));

?>