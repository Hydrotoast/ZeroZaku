<?php
/**
*
* info_acp_sitemap.php [English]
*
* @package language
* @version $Id: sitemap.php,v 1.0.7 2010-04-25 21:00:58 FladeX Exp $
* @copyright (c) 2009 FladeX
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
	'ACP_SITEMAP_INDEX_TITLE'			=> 'Sitemap FX',
	'ACP_SITEMAP'						=> 'Sitemap FX',
	'ACP_SITEMAP_SETTINGS'				=> 'Sitemap FX Einstellungen',
	'ACP_SITEMAP_SETTINGS_EXPLAIN'		=> 'Hier kannst Du die Sitemap FX-Einstellungen ändern',
	'INSTALL_SITEMAP_FX_MOD'			=> 'Sitemap FX-Mod installieren?',
	'LOG_SITEMAP_SETTINGS_CHANGED'		=> '<strong>Sitemap-Einstellungen geändert</strong>',
	'SITEMAP_ENABLE'					=> 'Sitemap eingeschaltet',
	'SITEMAP_ENABLE_EXPLAIN'			=> 'Suchmaschinen erlauben, die Sitemap zu durchsuchen',
	'SITEMAP_SETTINGS_CHANGED'			=> 'Sitemap FX-Einstellungen geändert.',
	'SITEMAP_PRIORITY_0'				=> 'Priorität für normale Themen',
	'SITEMAP_PRIORITY_1'				=> 'Priorität für Notizen',
	'SITEMAP_PRIORITY_2'				=> 'Priorität für Ankündigungen',
	'SITEMAP_PRIORITY_3'				=> 'Priorität für globale Bekanntmachungen',
	'SITEMAP_PRIORITY_EXPLAIN'			=> 'Setze den Prioritätswert für die Suche. Der Wert kann von 0 bis 1 in Dezimalschritten eingegeben werden. Zum Beispiel, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_0_EXPLAIN'		=> 'Setze den Prioritätswert für die Suche. Der Wert kann von 0 bis 1 in Dezimalschritten eingegeben werden. Zum Beispiel, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_1_EXPLAIN'		=> 'Setze den Prioritätswert für die Suche. Der Wert kann von 0 bis 1 in Dezimalschritten eingegeben werden. Zum Beispiel, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_2_EXPLAIN'		=> 'Setze den Prioritätswert für die Suche. Der Wert kann von 0 bis 1 in Dezimalschritten eingegeben werden. Zum Beispiel, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_3_EXPLAIN'		=> 'Setze den Prioritätswert für die Suche. Der Wert kann von 0 bis 1 in Dezimalschritten eingegeben werden. Zum Beispiel, <strong>0.5</strong>.',
	'SITEMAP_FREQ_0'					=> 'Änderungsfrequenz für normale Themen',
	'SITEMAP_FREQ_1'					=> 'Änderungsfrequenz für Notizen',
	'SITEMAP_FREQ_2'					=> 'Änderungsfrequenz für Bekanntmachungen',
	'SITEMAP_FREQ_3'					=> 'Änderungsfrequenz für globale Bekanntmachungen',
	'SITEMAP_FREQ_0_EXPLAIN'			=> 'Setze die Frequenz für normale Themen.',
	'SITEMAP_FREQ_1_EXPLAIN'			=> 'Setze die Frequenz für Notizen.',
	'SITEMAP_FREQ_2_EXPLAIN'			=> 'Setze die Frequenz für Bekanntmachungen.',
	'SITEMAP_FREQ_3_EXPLAIN'			=> 'Setze die Frequenz für globale Bekanntmachungen.',
	'SITEMAP_FREQ_NEVER'				=> 'Nie',
	'SITEMAP_FREQ_YEARLY'				=> 'Jährlich',
	'SITEMAP_FREQ_MONTHLY'				=> 'Monatlich',
	'SITEMAP_FREQ_WEEKLY'				=> 'Wöchentlich',
	'SITEMAP_FREQ_DAILY'				=> 'täglich',
	'SITEMAP_FREQ_HOURLY'				=> 'Stündlich',
	'SITEMAP_FREQ_ALWAYS'				=> 'ständig',
	'SITEMAP_CACHE_TIME'				=> 'Pufferintervall sitemap (in Stunden)',
	'SITEMAP_CACHE_TIME_EXPLAIN'		=> 'Sitemap wird nach der eingestellten Zeit erstellt. Nach Ablauf der eingestellten Zeit wird die Sitemap neu erstellt. Während der übrigen Zeit wird die Sitemap aus dem Cache ausgelesen. Je höher die Werte sind, desto weniger wird der Server belastet.',
));

?>