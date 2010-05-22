<?php
/**
*
* inactive_users [English]
*
* @package language
* @version $Id: inactive_users.php,v 0.2.5 2008/09/30 15:35:00 mtrs Exp $
* @copyright (c) 2008 mtrs
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

//$user->add_lang('mods/inactive_users');

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
	'USER_BANNED'								=> 'Uzaklaştırıldı',
	'USER_BAN_REASON'							=> 'Uzaklaştırma Sebebi',
	'USER_DEACTIVE'								=> 'Deaktif',
	'USER_INACTIVE'								=> '%s aydır aktif değil',
	'USER_SUSPENDED'							=> 'Üyeliği %s <br />tarihine kadar askıda' ,
));

?>