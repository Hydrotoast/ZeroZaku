<?php
/**
*
* @package acp
* @version $Id: v1.0.1 acp_groups_reg.php 2009-11-21 00:22:48Z 
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

class acp_groups_reg_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_groups_reg',
			'title'		=> 'ACP_GROUPS_REGS',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'groups_reg'		=> array('title' => 'ACP_GROUPS_REGS', 'auth' => 'acl_a_group', 'cat' => array('ACP_GROUPS')),
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