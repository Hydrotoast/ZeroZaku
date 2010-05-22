<?php
/**
*
* @package acp
* @version $Id: acp_vote_reminder.php 8479 2009-08-30 00:22:48Z 
* @copyright (c) 2009 mtrs
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

class acp_vote_reminder_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_vote_reminder',
			'title'		=> 'ACP_VOTE_REMINDER',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'votes'		=> array('title' => 'ACP_VOTE_REMINDER', 'auth' => 'acl_a_forum', 'cat' => array('ACP_MESSAGES')),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}

?>