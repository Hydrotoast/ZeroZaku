<?php
/**
*
* info_acp_sitemap.php [Russian]
*
* @package language
* @version $Id: sitemap.php,v 1.0.6 2010-01-14 14:59:58 FladeX Exp $
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
	'ACP_SITEMAP_INDEX_TITLE'		=> 'Sitemap FX',
	'ACP_SITEMAP'					=> 'Sitemap FX',
	'ACP_SITEMAP_SETTINGS'			=> 'Настройки Sitemap FX',
	'ACP_SITEMAP_SETTINGS_EXPLAIN'	=> 'Здесь вы можете настроить Sitemap FX',
	'INSTALL_SITEMAP_FX_MOD'		=> 'Установить мод Sitemap FX?',
	'LOG_SITEMAP_SETTINGS_CHANGED'	=> '<strong>Изменены настройки Sitemap</strong>',
	'SITEMAP_ENABLE'				=> 'Включить Sitemap',
	'SITEMAP_ENABLE_EXPLAIN'		=> 'Включение позволяет использовать Sitemap для поисковых систем',
	'SITEMAP_SETTINGS_CHANGED'		=> 'Настройки Sitemap успешно изменены.',
	'SITEMAP_PRIORITY_0'			=> 'Приоритет обычных тем',
	'SITEMAP_PRIORITY_1'			=> 'Приоритет прикрепленных тем',
	'SITEMAP_PRIORITY_2'			=> 'Приоритет объявлений',
	'SITEMAP_PRIORITY_3'			=> 'Приоритет глобальных тем',
	'SITEMAP_PRIORITY_EXPLAIN'		=> 'Установите значение приоритета для индексации. Значение может быть от 0 до 1 в виде десятичного числа, разделенного точкой. Например, <strong>0.55</strong>.',
	'SITEMAP_PRIORITY_0_EXPLAIN'	=> 'Установите значение приоритета для индексации. Значение может быть от 0 до 1 в виде десятичного числа, разделенного точкой. Например, <strong>0.55</strong>.',
	'SITEMAP_PRIORITY_1_EXPLAIN'	=> 'Установите значение приоритета для индексации. Значение может быть от 0 до 1 в виде десятичного числа, разделенного точкой. Например, <strong>0.55</strong>.',
	'SITEMAP_PRIORITY_2_EXPLAIN'	=> 'Установите значение приоритета для индексации. Значение может быть от 0 до 1 в виде десятичного числа, разделенного точкой. Например, <strong>0.55</strong>.',
	'SITEMAP_PRIORITY_3_EXPLAIN'	=> 'Установите значение приоритета для индексации. Значение может быть от 0 до 1 в виде десятичного числа, разделенного точкой. Например, <strong>0.55</strong>.',
	'SITEMAP_FREQ_0'				=> 'Частота обновления обычных тем',
	'SITEMAP_FREQ_1'				=> 'Частота обновления прикрепленных тем',
	'SITEMAP_FREQ_2'				=> 'Частота обновления объявлений',
	'SITEMAP_FREQ_3'				=> 'Частота обновления глобальных тем',
	'SITEMAP_FREQ_0_EXPLAIN'		=> 'Установите частоту обновления обычных тем.',
	'SITEMAP_FREQ_1_EXPLAIN'		=> 'Установите частоту обновления прикрепленных тем.',
	'SITEMAP_FREQ_2_EXPLAIN'		=> 'Установите частоту обновления объявлений.',
	'SITEMAP_FREQ_3_EXPLAIN'		=> 'Установите частоту обновления глобальных тем.',
	'SITEMAP_FREQ_NEVER'			=> 'Никогда',
	'SITEMAP_FREQ_YEARLY'			=> 'Ежегодно',
	'SITEMAP_FREQ_MONTHLY'			=> 'Ежемесячно',
	'SITEMAP_FREQ_WEEKLY'			=> 'Еженедельно',
	'SITEMAP_FREQ_DAILY'			=> 'Ежедневно',
	'SITEMAP_FREQ_HOURLY'			=> 'Ежечасно',
	'SITEMAP_FREQ_ALWAYS'			=> 'Постоянно',
	'SITEMAP_CACHE_TIME'			=> 'Промежуток кэширования sitemap (в часах)',
	'SITEMAP_CACHE_TIME_EXPLAIN'	=> 'Созданный sitemap будет закэширован на указанное время. После завершения указанного временного промежутка sitemap будет создан заново. В остальное время файл будет браться из кэша. Ставьте большее значение для меньшей нагрузки на сервер.',
));

?>