<?php
/**
*
*  Poll Vote Reminder [English]
*
* @package language
* @version $Id:  info_acp_vote_reminder.php,v 1.0.0 2009/08/30 mtrs Exp $
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
	'VOTE_REMINDER_ENABLE'				=> 'Enable pole vote reminder',
	'VOTE_REMINDER_ENABLE_EXPLAIN'		=> 'Enabling can redirect users to vote topics in which voting is set compulsory.',
	'VOTE_REMINDER_ENABLED'				=> 'Pole vote reminder enabled',
	'VOTE_REMINDER_DISABLED'			=> 'Pole vote reminder disabled',	
	'VOTE_REMINDER_TOPIC_ID'			=> 'Force to read topic ID',
	'VOTE_REMINDER_TOPIC_ID_EXPLAIN'	=> 'After visiting polls, users are redirected to read a topic only once.',
	'VOTE_REMINDER_UPDATE'				=> 'Remind all users to vote compulsory polls',
	'VOTE_REMINDER_UPDATE_EXPLAIN'		=> 'Any user, who hasn’t voted compulsory polls yet, will be redirected to polls,<br />and a force to read topic once.',
	'SHOW_WHO_VOTED'					=> 'Show who voted',
	'SHOW_WHO_VOTED_EXPLAIN'			=> 'Shows the poll caster usernames in the list below.',
	'POLL_TITLE'						=> 'Poll title',
	'POLL_TITLE_EXPLAIN'				=> 'Select one of the polls to add vote compulsory poll topics.',
	
	'ACP_VOTE_REMINDER'					=> 'Pole vote reminder',
	'ACP_VOTE_REMINDER_EXPLAIN'			=> 'You can enable and disable vote reminder from this control panel, also you can add and remove vote topics to be voted compulsory and and one force to read topic ID.',
	'ADD_TOPIC'							=> 'Add poll topic',
	'SELECT_POLL_TITLE'					=> 'You should select a poll title',
	'NUMBER'							=> 'No',
	'REMOVE'							=> 'Remove',
	'VOTE_END'							=> 'Poll end',
	'LAST_VOTE'							=> 'Last vote',
	'NO_VOTE'							=> 'No vote yet',
	'WHO_VOTED'							=> 'Who voted',
	'VOTE_COUNT'						=> 'Votes',
	'UNLIMITED'							=> 'Never',
	'REMOVE_TOPIC'						=> 'Remove from voting compulsory topics list',
	'POLL_ADDED'						=> 'Poll has been successfully added to vote compulsory topics list.',
	'TOPIC_REMOVED'						=> 'The selected topic ID has been successfully removed.',
	'NO_TOPIC'							=> 'Topic ID is not present',
	'TOPIC_REMOVED'						=> 'Topic ID is removed from voting compulsory topics list',
	'FORCE_READ_TOPIC_CHANGED'			=> 'Force read topic changed',
	'NO_VALUE_CHANGED'					=> 'You didn’t change any value to submit',
	'NO_POLL_EXIST'						=> 'There is no poll topic that can be added, please create a new poll first',
	'WHO_VOTED_UPDATED'					=> 'Display who voted configuration updated',
	'VOTE_REMINDER_INTERVAL'			=> 'Vote interval',
	'VOTE_REMINDER_INTERVAL_EXPLAIN'	=> 'If there is more than one compulsory poll, setting an interval will remind users after a while again,<br /> thus friendlier than voting all at once. Enter 0 to redirect users to all polls at once.',

	'LOG_VOTE_TOPIC_REMOVE'				=> '<strong>Topic ID %s removed from voting compulsory polls list</strong>',
	'LOG_VOTE_TOPIC_ADD'				=> '<strong>Topic ID %s added to vote compulsory polls list</strong>',
	
	'UPDATE_VOTE_REMINDER'				=> 'Vote reminder reset',
	'RESET_VOTE_REMINDER'				=> '<strong>Reset vote reminder</strong>',
	
));

?>