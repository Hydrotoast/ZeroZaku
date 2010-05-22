<?php
/**
*
* @package acp
* @version $Id: $
* @copyright (c) 2007 DualFusion - 2008 ..::Frans::..
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package module_install
*/
class acp_wpm_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_wpm',
			'title'		=> 'ACP_WELCOME_PM',
			'version'	=> '2.2.3',
			'modes'		=> array(
				'settings'	=> array('title' => 'ACP_WPM_SETTINGS', 'auth' => 'acl_a_', 'cat' => array('ACP_CAT_USERS')),
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