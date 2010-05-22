<?php
/**
*
* sitemap [English]
*
* @package language
* @version $Id: sitemap.php,v 1.0.5 2009/08/17 20:49:58 FladeX Exp $
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
	'ACP_SITEMAP_INDEX_TITLE'		=> 'Sitemap FX',
	'ACP_SITEMAP'					=> 'Sitemap FX',
	'ACP_SITEMAP_SETTINGS'			=> 'Sitemap FX settings',
	'ACP_SITEMAP_SETTINGS_EXPLAIN'	=> 'Here you can change Sitemap FX settings',
	'LOG_SITEMAP_SETTINGS_CHANGED'	=> '<strong>Sitemap settings changed</strong>',
	'SITEMAP_ENABLE'				=> 'Sitemap enabled',
	'SITEMAP_ENABLE_EXPLAIN'		=> 'Enable allows use sitemap for search engines',
	'SITEMAP_SETTINGS_CHANGED'		=> 'Sitemap FX settings changed.',
	'SITEMAP_PRIORITY_0'			=> 'Priority for default topics',
	'SITEMAP_PRIORITY_1'			=> 'Priority for sticky topics',
	'SITEMAP_PRIORITY_2'			=> 'Priority for announcements',
	'SITEMAP_PRIORITY_3'			=> 'Priority for global announcements',
	'SITEMAP_PRIORITY_EXPLAIN'		=> 'Set priority’s value for searching. The value can be from 0 to 1 in the form of decimal numbers separated by periods. For example, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_0_EXPLAIN'	=> 'Set priority’s value for searching. The value can be from 0 to 1 in the form of decimal numbers separated by periods. For example, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_1_EXPLAIN'	=> 'Set priority’s value for searching. The value can be from 0 to 1 in the form of decimal numbers separated by periods. For example, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_2_EXPLAIN'	=> 'Set priority’s value for searching. The value can be from 0 to 1 in the form of decimal numbers separated by periods. For example, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_3_EXPLAIN'	=> 'Set priority’s value for searching. The value can be from 0 to 1 in the form of decimal numbers separated by periods. For example, <strong>0.5</strong>.',
	'SITEMAP_FREQ_0'				=> 'Changefreq for default topics',
	'SITEMAP_FREQ_1'				=> 'Changefreq for sticky topics',
	'SITEMAP_FREQ_2'				=> 'Changefreq for announcements',
	'SITEMAP_FREQ_3'				=> 'Changefreq for global anouncements',
	'SITEMAP_FREQ_0_EXPLAIN'		=> 'Set change frequency for default topics.',
	'SITEMAP_FREQ_1_EXPLAIN'		=> 'Set change frequency for sticky topics.',
	'SITEMAP_FREQ_2_EXPLAIN'		=> 'Set change frequency for announcements.',
	'SITEMAP_FREQ_3_EXPLAIN'		=> 'Set change frequency for global announcements.',
	'SITEMAP_FREQ_NEVER'			=> 'Never',
	'SITEMAP_FREQ_YEARLY'			=> 'Yearly',
	'SITEMAP_FREQ_MONTHLY'			=> 'Monthly',
	'SITEMAP_FREQ_WEEKLY'			=> 'Weekly',
	'SITEMAP_FREQ_DAILY'			=> 'Daily',
	'SITEMAP_FREQ_HOURLY'			=> 'Hourly',
	'SITEMAP_FREQ_ALWAYS'			=> 'Always',
	'SITEMAP_CACHE_TIME'			=> 'Interval caching sitemap (in hours)',
	'SITEMAP_CACHE_TIME_EXPLAIN'	=> 'Sitemap will be created through the cached for a specified time. After completion of the specified time intervals sitemap will be created anew. The rest of the time the file will be taken from the cache. Put more value for less load on the server.',
));

?>