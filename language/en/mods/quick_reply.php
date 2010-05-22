<?php
/** 
*
* posting [English]
*
* @package language
* @version $Id: quick_reply.php,v 1.6.6 2008/03/10 16:38:47 rxu Exp $
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
	'QUICK_REPLY'			=> 'Quick reply',
	'QUICK_POST'			=> 'Quick post',
	'ACP_QUICK_REPLY_EXPLAIN'	=> 'Here you can change quick post/reply forms view. You can switch on/off entire quick post/reply forms or displaying of smilies/attachbox/checkboxes/post icons separately.',
	'QUOTE_TEXT'			=> 'Select the text you want to quote',
	'QUICK_REPLY_DISPLAY'	=> 'Display quick reply panel at topic view',
	'QUICK_POST_DISPLAY'	=> 'Display quick topic post panel at forum view',
	
// ACP block
	'ALLOW_QUICK_REPLY'					=> 'Allow quick reply for users',
	'ALLOW_QUICK_REPLY_EXPLAIN'			=> 'Users can post reply directly at topic view.',
	'ALLOW_QUICK_REPLY_NONE'			=> 'None',
	'ALLOW_QUICK_REPLY_REG'				=> 'Registered only',
	'ALLOW_QUICK_REPLY_ALL'				=> 'All',
	'ALLOW_QR_OPTIONS_NONE'				=> 'None',
	'ALLOW_REPLY_ICONS'					=> 'Post/topic icons',
	'ALLOW_REPLY_CHECKBOXES'			=> 'Checkboxes',
	'ALLOW_REPLY_ATTACHBOX'				=> 'Attachbox',
	'ALLOW_REPLY_SMILIES'				=> 'Smilies',
	'ALLOW_QUICK_POST'					=> 'Allow quick topic post for users',
	'ALLOW_QUICK_POST_EXPLAIN'			=> 'Users can start topic directly at forum view.',
	
// Install block
	'INSTALLED'							=> 'You have successfully <strong>installed</strong> Quick reply mod.',
	'NO_FILES_MODIFIED'					=> 'You haven\'t modified files in according to Quick reply MOD installation instruction.',
	'NOT_INSTALLED'						=> 'You have not Quick reply mod installed.',
	'UNINSTALLED'						=> 'You have successfully <strong>uninstalled</strong> Quick reply mod from your database.',
));

?>