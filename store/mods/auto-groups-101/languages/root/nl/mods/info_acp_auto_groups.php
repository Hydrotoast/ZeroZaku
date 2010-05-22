<?php
/**
*
* acp_info_auto_groups [Dutch]
*
* @translated by RdJ1 / vertaald door RdJ1
* @http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=355570
* @copyright (c) 2008 RdJ1 (this translation / deze vertaling)
*
* @package language
* @version 1.0.0 $
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
   'AUTO_GROUP'               => 'Auto Groep-instellingen',
   'GROUP_MIN_POSTS'            => 'Minimum berichten-aantal',
   'GROUP_MAX_POSTS'            => 'Maximum berichten-aantal',
   'GROUP_MIN_DAYS'            => 'Minimum dagen lidmaatschap',
   'GROUP_MAX_DAYS'            => 'Maximum dagen lidmaatschap',
   'GROUP_MIN_WARNINGS'         => 'Minimum aantal waarschuwingen',
   'GROUP_MAX_WARNINGS'         => 'Maximum aantal waarschuwingen',
   'DEFAULT_AUTO_GROUP'         => 'Maak automatisch standaardgroep',
   'DEFAULT_AUTO_GROUP_EXPLAIN'   => 'Deze groep wordt automatisch zijn/haar standaardgroep als de gebruikers worden toegevoegd.',)
);
?>