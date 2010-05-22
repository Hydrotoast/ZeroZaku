<?php
/**
*
* acp_info_auto_gropus [Standard french]
*
* @package language
* @version 1.0.1 $
* @copyright (c) 2007 A_Jelly_Doughnut
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
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
   'AUTO_GROUP'         => 'Paramètres du Groupe Automatique',
   'GROUP_MIN_POSTS'      => 'Nombre de posts minimum',
   'GROUP_MAX_POSTS'      => 'Nombre de posts maximum',
   'GROUP_MIN_DAYS'      => 'Jours minimum d\'adhésion',
   'GROUP_MAX_DAYS'      => 'Jours maximum d\'adhésion',
   'GROUP_MIN_WARNINGS'   => 'Nombre d\'avertissements minimum',
   'GROUP_MAX_WARNINGS'   => 'Nombre d\'avertissements maximum',
   'DEFAULT_AUTO_GROUP'   => 'Utiliser par défaut automatiquement',
   'DEFAULT_AUTO_GROUP_EXPLAIN'   => 'Les utilisateurs changent de groupe par défaut après avoir été ajoutés à ce groupe.',)
);

?>