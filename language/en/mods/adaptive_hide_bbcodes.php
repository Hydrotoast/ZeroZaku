<?php
/**
*
* adaptive_hide_bbcodes [English]
*
* @package language
* @version $Id: adaptive_hide_bbcodes.php,v 1.0.2 2009/01/04 20:00:00 Izya Exp $
* @copyright (c) 2009 Dmitry Gredyushko (izya@nm.ru)
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
	'ADAPT_HIDE_GUEST'			=>	'<i>Hidden text. Registration required.</i>',
	'ADAPT_HIDE_GUEST_POSTS'	=>	'<i>Hidden text. Registration and a minimum of %d post(s) are required.</i>',
	'ADAPT_HIDE_POSTS'			=>	'<i>Hidden text. A minimum of %d posts are required.</i>',
	'ADAPT_HIDE_GROUPS'			=>	'<i>Hidden text. None of the groups you are a member of have been granted access.</i>',
	'ADAPT_HIDE_QUOTE'			=>	'[i]Hidden text[/i]'
));

?>