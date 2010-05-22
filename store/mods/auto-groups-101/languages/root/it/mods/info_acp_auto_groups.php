<?php
/**
*
* acp_info_auto_gropus [Italian]
*
* @package language
* @version 1.0.0 $
* @copyright (c) 2007 A_Jelly_Doughnut
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*@ translation copyright (c) 2007 Nico phpBB.it
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
 
/**
* DO NOT CHANGE
*/
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
	'AUTO_GROUP'			=> 'Impostazioni Auto Gruppo',
	'GROUP_MIN_POSTS'		=> 'Numero minimo messaggi',
	'GROUP_MAX_POSTS'		=> 'Numero massimo messaggi',
	'GROUP_MIN_DAYS'		=> 'Numero minimo giorni di iscrizione',
	'GROUP_MAX_DAYS'		=> 'Numero massimo giorni di iscrizione',
	'GROUP_MIN_WARNINGS'	=> 'Numero minimo avvertimenti',
	'GROUP_MAX_WARNINGS'	=> 'Numero massimo avvertimenti',
	'DEFAULT_AUTO_GROUP'	=> 'Diventa gruppo predefinito automaticamente',
	'DEFAULT_AUTO_GROUP_EXPLAIN'	=> 'Nel momento che vengono inseriti in questo gruppo gli utenti cambieranno il gruppo predefinito.',)
);
?>