<?php

/**
*
* @author Mav
* @package - Community Moderation
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
	'ACP_CAT_COM_MOD'						=> 'Community Moderation',
	'ACP_COM_MOD_CONFIG'					=> 'Configuration',
	'ACP_COM_MOD_SETTINGS'					=> 'Community Moderation settings',
	'ACP_COM_MOD_SETTINGS_EXPLAIN'			=> 'Here you can change the configuration settings for the Community Moderation MOD',

	'ENABLE_USERS_THRESHOLD'				=> 'Enable user threshold',
	'ENABLE_USERS_THRESHOLD_EXPLAIN'		=> 'Allow users to set their own threshold for hiding posts',

	'ENABLE_USERS_STYLE'					=> 'Enable user style',
	'ENABLE_USERS_STYLE_EXPLAIN'			=> 'Allow users to decide if buried posts are hidden',

	'COM_MOD_SETTINGS_CHANGED'				=> 'Community Moderation settings changed.',

	'ENABLE_COMMUNITY_MODERATION'			=> 'Enable community moderation',
	'ENABLE_COMMUNITY_MODERATION_EXPLAIN'	=> 'Enable to allow users to upvote/downvote posts; burying posts with a low score.',

	'LOG_COM_MOD_SETTINGS_CHANGED'			=> '<strong>Community Moderation settings changed</strong>',

	'BURY_HIDE'								=> 'Hide buried posts',
	'BURY_HIDE_EXPLAIN'						=> 'Select the posts you wish to hide when their score dips below the threshold',

	'BURY_HIDE_NONE'						=> 'Do not hide buried posts',
	'BURY_HIDE_FRIENDS'						=> 'Do not hide buried posts from friends',
	'BURY_HIDE_ALL'							=> 'Hide all buried posts',

	'POSTS_BURY_THRESHOLD'					=> 'Post bury threshold',
	'POSTS_BURY_THRESHOLD_EXPLAIN'			=> 'The score required to bury a post (range -99 > -1).',

	'ULTIMATE_POINTS_SETTINGS'				=> 'Ultimate Points settings',
	'ULTIMATE_POINTS_ENABLE'				=> 'Enable Ultimate Points',
	'ULTIMATE_POINTS_UPVOTE'				=> 'Ultimate points per upvote',
	'ULTIMATE_POINTS_UPVOTE_EXPLAIN'		=> 'The amount of ultimate points awarded per upvote.',
	'ULTIMATE_POINTS_DOWNVOTE'				=> 'Ultimate points per downvote',
	'ULTIMATE_POINTS_DOWNVOTE_EXPLAIN'		=> 'The amount of ultimate points deducted per downvote.',
));

?>