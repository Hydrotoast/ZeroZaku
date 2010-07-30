<?php
/**
*
* info_acp_sitemap.php [Spanish] translation by davaguco
*
* @package language
* @version $Id: sitemap.php,v 1.0.7 2010-04-25 20:51:58 FladeX Exp $
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
	'ACP_SITEMAP_SETTINGS'			=> 'Configuración de Sitemap FX',
	'ACP_SITEMAP_SETTINGS_EXPLAIN'	=> 'Aquí puedes cambiar la configuración de Sitemap FX',
	'INSTALL_SITEMAP_FX_MOD'		=> '¿Instalar el mod Sitemap FX?',
	'LOG_SITEMAP_SETTINGS_CHANGED'	=> '<strong>Se ha modificado la configuración del Sitemap</strong>',
	'SITEMAP_ENABLE'				=> 'Sitemap Activado',
	'SITEMAP_ENABLE_EXPLAIN'		=> 'Activar permite utilizar el sitemap para los motores de búsquedas',
	'SITEMAP_SETTINGS_CHANGED'		=> 'Se ha modificado la configuración de Sitemap FX.',
	'SITEMAP_PRIORITY_0'			=> 'Prioridad de los hilos normales',
	'SITEMAP_PRIORITY_1'			=> 'Priority de los hilos fijos',
	'SITEMAP_PRIORITY_2'			=> 'Prioridad de los anuncios',
	'SITEMAP_PRIORITY_3'			=> 'Prioridad de los anuncios globales',
	'SITEMAP_PRIORITY_EXPLAIN'		=> 'Fijar valor de prioridad para búsquedas. Este valor puede ir de 0 a 1, en forma de números decimales separados por puntos. Por ejemplo, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_0_EXPLAIN'	=> 'Fijar valor de prioridad para búsquedas. Este valor puede ir de 0 a 1, en forma de números decimales separados por puntos. Por ejemplo, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_1_EXPLAIN'	=> 'Fijar valor de prioridad para búsquedas. Este valor puede ir de 0 a 1, en forma de números decimales separados por puntos. Por ejemplo, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_2_EXPLAIN'	=> 'Fijar valor de prioridad para búsquedas. Este valor puede ir de 0 a 1, en forma de números decimales separados por puntos. Por ejemplo, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_3_EXPLAIN'	=> 'Fijar valor de prioridad para búsquedas. Este valor puede ir de 0 a 1, en forma de números decimales separados por puntos. Por ejemplo, <strong>0.5</strong>.',
	'SITEMAP_FREQ_0'				=> 'Frecuencia de cambios para hilos normales',
	'SITEMAP_FREQ_1'				=> 'Frecuencia de cambios para hilos fijos',
	'SITEMAP_FREQ_2'				=> 'Frecuencia de cambios para anuncios',
	'SITEMAP_FREQ_3'				=> 'Frecuencia de cambios para anuncios globales',
	'SITEMAP_FREQ_0_EXPLAIN'		=> 'Fijar la frecuencia con que se modifican los hilos normales.',
	'SITEMAP_FREQ_1_EXPLAIN'		=> 'Fijar la frecuencia con que se modifican los hilos fijos.',
	'SITEMAP_FREQ_2_EXPLAIN'		=> 'Fijar la frecuencia con que se modifican los anuncios.',
	'SITEMAP_FREQ_3_EXPLAIN'		=> 'Fijar la frecuencia con que se modifican los anuncios globales.',
	'SITEMAP_FREQ_NEVER'			=> 'Nunca',
	'SITEMAP_FREQ_YEARLY'			=> 'Anualmente',
	'SITEMAP_FREQ_MONTHLY'			=> 'Mensualmente',
	'SITEMAP_FREQ_WEEKLY'			=> 'Semanalmente',
	'SITEMAP_FREQ_DAILY'			=> 'Diariamente',
	'SITEMAP_FREQ_HOURLY'			=> 'Cada hora',
	'SITEMAP_FREQ_ALWAYS'			=> 'Siempre',
	'SITEMAP_CACHE_TIME'			=> 'Intervalo de caché del sitemap (en horas)',
	'SITEMAP_CACHE_TIME_EXPLAIN'	=> 'El Sitemap se creará a través de la caché durante el tiempo especificado. Después de este intervalo de tiempo, el sitemap se creará de nuevo. El resto del tiempo el fichero se tomará de la caché. Introduce un valor más alto para reducir la carga del servidor.',
));

?>