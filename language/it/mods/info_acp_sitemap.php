<?php
/**
*
* info_acp_sitemap.php [Italian]
* translator: Riccardo Vianello aka etms51
* @package language
* @version $Id: sitemap.php,v 1.0.5 2009-08-17 20:49:58 FladeX Exp $
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
	'ACP_SITEMAP_INDEX_TITLE'		=> 'Mappa del sito FX',
	'ACP_SITEMAP'					=> 'Mappa del sito FX',
	'ACP_SITEMAP_SETTINGS'			=> 'Impostazioni Mappa del sito FX',
	'ACP_SITEMAP_SETTINGS_EXPLAIN'	=> 'Qui puoi cambiare le impostazioni della Mappa del sito FX',
	'INSTALL_SITEMAP_FX_MOD'		=> 'Install Sitemap FX mod?',
	'LOG_SITEMAP_SETTINGS_CHANGED'	=> '<strong> Impostazioni modificate della mappa del sito</strong>',
	'SITEMAP_ENABLE'				=> 'Mappa del sito abilitato',
	'SITEMAP_ENABLE_EXPLAIN'		=> 'Permette di consentire l\'uso della mappa del sito per i motori di ricerca',
	'SITEMAP_SETTINGS_CHANGED'		=> 'Le impostazioni della mappa del sito FX sono cambiati.',
	'SITEMAP_PRIORITY_0'			=> 'Priorità per gli argomenti di default',
	'SITEMAP_PRIORITY_1'			=> 'Priorità per gli argomenti importanti',
	'SITEMAP_PRIORITY_2'			=> 'Priorità per gli annunci',
	'SITEMAP_PRIORITY_3'			=> 'Priorità per gli annunci globali',
	'SITEMAP_PRIORITY_EXPLAIN'		=> 'Imposta il valore di priorità per la ricerca. Il valore può essere da 0 a 1 nella forma di numeri decimali separati da punti. Per esempio, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_0_EXPLAIN'	=> 'Imposta il valore di priorità per la ricerca. Il valore può essere da 0 a 1 nella forma di numeri decimali separati da punti. Per esempio, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_1_EXPLAIN'	=> 'Imposta il valore di priorità per la ricerca. Il valore può essere da 0 a 1 nella forma di numeri decimali separati da punti. Per esempio, <strong>0.5</strong>.Set priority’s value for searching. The value can be from 0 to 1 in the form of decimal numbers separated by periods. For example, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_2_EXPLAIN'	=> 'Imposta il valore di priorità per la ricerca. Il valore può essere da 0 a 1 nella forma di numeri decimali separati da punti. Per esempio, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_3_EXPLAIN'	=> 'Imposta il valore di priorità per la ricerca. Il valore può essere da 0 a 1 nella forma di numeri decimali separati da punti. Per esempio, <strong>0.5</strong>.',
	'SITEMAP_FREQ_0'				=> 'Cambia freq. per gli argomenti di default',
	'SITEMAP_FREQ_1'				=> 'Cambia freq. per gli argomenti importanti',
	'SITEMAP_FREQ_2'				=> 'Cambia freq. per gli annunci',
	'SITEMAP_FREQ_3'				=> 'Cambia freq. per gli annunci globali',
	'SITEMAP_FREQ_0_EXPLAIN'		=> 'Imposta la frequenza di modifica per gli argomenti di default.',
	'SITEMAP_FREQ_1_EXPLAIN'		=> 'Imposta la frequenza di modifica per gli argomenti importanti.',
	'SITEMAP_FREQ_2_EXPLAIN'		=> 'Imposta la frequenza di modifica per gli annunci.',
	'SITEMAP_FREQ_3_EXPLAIN'		=> 'Imposta la frequenza di modifica per gli annunci globali.',
	'SITEMAP_FREQ_NEVER'			=> 'Mai',
	'SITEMAP_FREQ_YEARLY'			=> 'Annuale',
	'SITEMAP_FREQ_MONTHLY'			=> 'Mensilmente',
	'SITEMAP_FREQ_WEEKLY'			=> 'Settimanalmente',
	'SITEMAP_FREQ_DAILY'			=> 'Giornalmente',
	'SITEMAP_FREQ_HOURLY'			=> 'ogni ora',
	'SITEMAP_FREQ_ALWAYS'			=> 'Sempre',
	'SITEMAP_CACHE_TIME'			=> 'Intervallo di cache del sitemap (in ore)',
	'SITEMAP_CACHE_TIME_EXPLAIN'	=> 'La mappa del sito sarà creato attraverso la cache per un tempo specifico. Dopo il completamento degli intervalli di tempo specificato, la mappa del sito verrà creato nuovamente. Il resto del tempo il file sarà preso dalla cache. Inserire un valore di più con meno carico sul server.',
));

?>