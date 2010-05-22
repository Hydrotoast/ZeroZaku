<?php

/**
*
* milestone_congratulations.php [English]
*
* @package - "Milestone Congratulations"
* @version $Id: milestone_congratulations.php 5 2008-09-21 MartectX $
* @copyright (C)2008, MartectX ( http://mods.martectx.de/ )
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
	'MILESTONE_TITLE'	=> 'Milestone Congratulations',
	'MILESTONE_ERROR'	=> 'Install and run Administration Control Panel module first!',

	// ACP
	'MC_SETTING'		=> 'Functionality',
	'MC_SETTING_EXP'	=> 'Milestones to be displayed on index and history pages. History of <strong>all counters</strong> will <strong>always</strong> be kept!',
	'MC_HISTORY'		=> 'Show history',
	'MC_HISTORY_EXP'	=> 'Show a link to the history page on index page. History of <strong>all counters</strong> will <strong>always</strong> be kept!',
	'MC_HISTORYLINK'	=> 'Complete history overview',
	'MC_COLOUR'			=> 'Update colours now',
	'MC_COLOUR_EXP'		=> 'Check box to update all user colours once (e.g. after a promotion to moderator).',
	'MC_INC_EXP'		=> 'Upon reaching the current milestone the counter is automatically incremented by this amount.',
	'MC_SUCCESS'		=> 'Settings saved!',
	'MC_NOTNULL'		=> 'Increment values must be positive and must not be zero!',
	'MC_CURRENT'		=> 'Current setting of',
	'MC_INCREMENT'		=> 'Increment',
	'MC_POSTS'			=> 'post counter',
	'MC_TOPICS'			=> 'topic counter',
	'MC_USERS'			=> 'user counter',

	// Index
	'MILESTONE'			=> 'Milestone',
	'MILESTONES'		=> 'Milestones',
	'MILESTONE_HISTORY'	=> 'History',

	'MILESTONE_PTU'		=> 'Post <strong>#%1$d</strong> has been made by %2$s, topic <strong>#%3$d</strong> has been created by %4$s; registered user <strong>#%5$d</strong> is %6$s.',
	'MILESTONE_PT'		=> 'Post <strong>#%1$d</strong> has been made by %2$s, topic <strong>#%3$d</strong> has been created by %4$s.',
	'MILESTONE_PU'		=> 'Post <strong>#%1$d</strong> has been made by %2$s; registered user <strong>#%3$d</strong> is %4$s.',
	'MILESTONE_TU'		=> 'Topic <strong>#%1$d</strong> has been created by %2$s; registered user <strong>#%3$d</strong> is %4$s.',
	'MILESTONE_P'		=> 'Post <strong>#%1$d</strong> has been made by %2$s.',
	'MILESTONE_T'		=> 'Topic <strong>#%1$d</strong> has been created by %2$s.',
	'MILESTONE_U'		=> 'Registered user <strong>#%1$d</strong> is %2$s.',

/***	Remove all three lines beginning with /*** to enable alternate output on index page:
/***	"The 1000th post has been made by USERNAME, the 100th topic has been created by USERNAME; the 50th registered user is USERNAME."
/***	Only do this once posts, topics and users milestones go beyond 3 (because of the English language's 1st, 2nd, 3rd)!
	'MILESTONE_PTU'		=> 'The <strong>%1$dth</strong> post has been made by %2$s, the <strong>%3$dth</strong> topic has been created by %4$s; the <strong>%5$dth</strong> registered user is %6$s.',
	'MILESTONE_PT'		=> 'The <strong>%1$dth</strong> post has been made by %2$s, the <strong>%3$dth</strong> topic has been created by %4$s.',
	'MILESTONE_PU'		=> 'The <strong>%1$dth</strong> post has been made by %2$s; the <strong>%3$dth</strong> registered user is %4$s.',
	'MILESTONE_TU'		=> 'The <strong>%1$dth</strong> topic has been created by %2$s; the <strong>%3$dth</strong> registered user is %4$s.',
	'MILESTONE_P'		=> 'The <strong>%1$dth</strong> post has been made by %2$s.',
	'MILESTONE_T'		=> 'The <strong>%1$dth</strong> topic has been created by %2$s.',
	'MILESTONE_U'		=> 'The <strong>%1$dth</strong> registered user is %2$s.', /**/

	// Viewonline
	'VIEWING_MILESTONES'	=> 'Viewing Milestone History page'
));

?>