<?php

/**
*
* @package - Community Moderation [Spanish ]
* @copyright (c) 2010 Mav
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
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
// Some characters for use
// ’ » “ ” …


$lang = array_merge($lang, array(
	'ENABLE_COMMUNITY_MODERATION'   		=> 'Habilitar moderación por la comunidad',
	'ENABLE_COMMUNITY_MODERATION_EXPLAIN'   => 'Habilitar a todos los usuarios para votar postitivo/negativo en mensajes; sepultando mensajes con baja puntuación.',

	'POSTS_BURY_THRESHOLD'					=> 'Límite para sepultar mensajes',
	'POSTS_BURY_THRESHOLD_EXPLAIN'			=> 'La puntuación requerida para sepultar un mensaje (intervalo -99 > -1).',
));

?>