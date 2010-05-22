<?php

/**
*
* milestone_congratulations.php [German]
*
* @package - "Milestone Congratulations"
* @version $Id: milestone_congratulations.php 5 2008-09-21 MartectX $
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
	'MILESTONE_TITLE'	=> 'Meilenstein-Gratulierer',
	'MILESTONE_ERROR'	=> 'Administrationsmodul installieren und ausführen!',

	// ACP
	'MC_SETTING'		=> 'Funktionsumfang',
	'MC_SETTING_EXP'	=> 'Welche erreichten Meilensteine sollen auf der Start- und Historienseite angezeigt werden? Die Historie wird <strong>unabhängig hiervon</strong> zu allem geführt!',
	'MC_HISTORY'		=> 'Historie anzeigen',
	'MC_HISTORY_EXP'	=> 'Einen Link zur Historie auf der Startseite anzeigen. Die Historie wird unabhängig hiervon <strong>immer</strong> geführt!',
	'MC_HISTORYLINK'	=> 'Komplette Historie anzeigen',
	'MC_COLOUR'			=> 'Farben aktualisieren',
	'MC_COLOUR_EXP'		=> 'Anwählen, um jetzt die Einfärbung der Nutzer zu aktualisieren (z.B. nach Ernennung zum Moderator).',
	'MC_INC_EXP'		=> 'Bei Erreichen wird automatisch um diesen Betrag erhöht und damit das nächste Ziel festgesetzt.',
	'MC_SUCCESS'		=> 'Änderungen gespeichert!',
	'MC_NOTNULL'		=> 'Schrittweiten müssen positiv sein und dürfen nicht null betragen!',
	'MC_CURRENT'		=> 'Momentanstand',
	'MC_INCREMENT'		=> 'Schrittweite',
	'MC_POSTS'			=> 'Beitragszähler',
	'MC_TOPICS'			=> 'Themenzähler',
	'MC_USERS'			=> 'Nutzerzähler',

	// Index
	'MILESTONE'			=> 'Nächstes Ziel',
	'MILESTONES'		=> 'Nächste Ziele',
	'MILESTONE_HISTORY'	=> 'Historie',
	'MILESTONE_PTU'		=> 'Der <strong>%1$d.</strong> Beitrag wurde von %2$s verfasst, das <strong>%3$d.</strong> Thema von %4$s erstellt; der <strong>%5$d.</strong> registrierte Benutzer ist %6$s.',
	'MILESTONE_PT'		=> 'Der <strong>%1$d.</strong> Beitrag wurde von %2$s verfasst, das <strong>%3$d.</strong> Thema von %4$s erstellt.',
	'MILESTONE_PU'		=> 'Der <strong>%1$d.</strong> Beitrag wurde von %2$s verfasst; der <strong>%3$d.</strong> registrierte Benutzer ist %4$s.',
	'MILESTONE_TU'		=> 'Das <strong>%1$d.</strong> Thema von %2$s erstellt; der <strong>%3$d.</strong> registrierte Benutzer ist %4$s.',
	'MILESTONE_P'		=> 'Der <strong>%1$d.</strong> Beitrag wurde von %2$s verfasst.',
	'MILESTONE_T'		=> 'Das <strong>%1$d.</strong> Thema wurde von %2$s erstellt.',
	'MILESTONE_U'		=> 'Der <strong>%1$d.</strong> registrierte Benutzer ist %2$s.',

	// Viewonline
	'VIEWING_MILESTONES'	=> 'Betrachtet Meilenstein-Historie'
));

?>