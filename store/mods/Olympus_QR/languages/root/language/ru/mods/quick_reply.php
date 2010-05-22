<?php
/** 
*
* posting [Russian]
*
* @package language
* @version $Id: quick_reply.php,v 1.6.6 2008/03/10 16:39:58 rxu Exp $
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
	'QUICK_POST'				=> 'Быстрая тема',
	'QUICK_REPLY'				=> 'Быстрый ответ',
	'ACP_QUICK_REPLY_EXPLAIN'	=> 'Здесь вы можете настроить желаемый вид и функции быстрого ответа в темах. Вы можете включить/отключить быстрый ответ, а также управлять отображением смайликов, формой добавления вложений и т.п.',
	'QUOTE_TEXT'				=> 'Выделите текст в сообщении',
	'QUICK_REPLY_DISPLAY'		=> 'Показывать панель быстрого ответа в темах',
	'QUICK_POST_DISPLAY'		=> 'Показывать панель быстрого создания тем в форумах',
	
// Блок администраторского раздела
	'ALLOW_QUICK_REPLY'					=> 'Разрешить быстрый ответ',
	'ALLOW_QUICK_REPLY_EXPLAIN'			=> 'Пользователи смогут отправлять сообщения на странице просмотра темы.',
	'ALLOW_QUICK_REPLY_REG'				=> 'Зарегистрированным пользователям',
	'ALLOW_QUICK_REPLY_ALL'				=> 'Всем',
	'ALLOW_QUICK_REPLY_NONE'			=> 'Нет',
	'ALLOW_REPLY_ICONS'					=> 'Значки сообщений/тем',
	'ALLOW_REPLY_CHECKBOXES'			=> 'Чекбоксы',
	'ALLOW_REPLY_ATTACHBOX'				=> 'Вложение файлов',
	'ALLOW_REPLY_SMILIES'				=> 'Смайлики',
	'ALLOW_QUICK_POST'					=> 'Разрешить быстрые темы',
	'ALLOW_QUICK_POST_EXPLAIN'			=> 'Пользователи смогут начинать новые темы на странице просмотра форума.',
	
// Блок установки
	'INSTALLED'							=> 'Мод быстрого ответа успешно <strong>установлен</strong>.',
	'NO_FILES_MODIFIED'					=> 'Вы не внесли изменения в файлы в соответствии с инструкцией по установке мода.',
	'NOT_INSTALLED'						=> 'На вашей конференции не был установлен данный мод быстрого ответа.',
	'UNINSTALLED'						=> 'Мод быстрого ответа успешно <strong>удалён</strong> из базы данных.',
));

?>