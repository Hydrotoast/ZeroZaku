<?php
/**
*
*  Pole Vote Reminder [Turkish]
*
* @package language
* @version $Id:  vote_reminder.php,v 1.0.0 2009/08/30 mtrs Exp $
* @copyright (c) 2009 mtrs
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
	'TOPIC_VOTE_REMINDER'			=> 'Bir ankete yönlendiriliyorsunuz. Lütfen ankete oy atalım.',
	'RETURN_TO_POLL_TOPIC'			=> '<br />%sAnket konusuna erişmek için tıklayın%s',
	'TOPIC_REMINDER'				=> 'Bir konuya yönlendiriliyorsunuz.',
	'RETURN_TO_TOPIC'				=> '<br />%sHızlı erişim için tıklayın%s',
	'POLL_VOTE_COMPULSORY'			=> 'Anket zorunlu',
	'POLL_VOTE_COMPULSORY_EXPLAIN'	=> 'Eğer anket zorunlu ise, kullanıcılar oy vermek üzere bu konuya yönlendirilebilir.',

));

?>