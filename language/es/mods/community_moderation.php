<?php

/**
*
* Community Moderation [Spanish]
*
* @package	language
* @copyright(c) 2010 Mav
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
// � � � � �
//

$lang = array_merge($lang, array(
    'DOWNVOTE'     			=> 'Voto negativo',
	'NO_POST_VOTE'			=> 'Debes seleccionar un mensaje en el cual votar.',
	'POST_BURIED'			=> 'Este mensaje por <strong>%1$s</strong> se ha ocultado ya que fue sepultado por la comunidad. %2$sMostrar este mensaje%3$s.',
	'POST_SCORE'			=> 'Puntuaci�n del mensaje por la comunidad',
	'UPVOTE'				=> 'Voto positivo',
	'USER_HAS_VOTED'		=> 'Ya has votado en este mensaje.',
));

?>