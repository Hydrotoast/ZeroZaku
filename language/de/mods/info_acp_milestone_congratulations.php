<?php

/**
*
* info_acp_milestone_congratulations.php [German]
*
* @package - "Milestone Congratulations"
* @version $Id: info_acp_milestone_congratulations.php 1 2008-07-29 MartectX $
* @copyright (C)2008, MartectX ( http://mods.martectx.de/ )
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
	'MC_TITLE'		=> 'Meilenstein-Gratulierer',
	'MC_CONFIG'		=> 'Einstellungen des Meilenstein-Gratulierers',
	'MC_INSTALLED'	=> '<strong>Modifikation installiert</strong><br />» Meilenstein-Gratulierer v%s',
	'MC_UPDATED'	=> '<strong>Modifikationsupdate</strong><br />» Meilenstein-Gratulierer v%s'
));

?>