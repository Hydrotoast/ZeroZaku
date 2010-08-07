<?php
/**
*
* @package acp
* @copyright (c) 2010 Mav
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
class acp_community_moderation_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_community_moderation',
			'title'		=> 'ACP_CAT_COM_MOD',
			'version'	=> '0.0.3',
			'modes'		=> array(
				'configuration'		=> array('title' => 'ACP_COM_MOD_CONFIG', 'auth' => 'acl_a_com_mod', 'cat' => array('ACP_CAT_DOT_MODS')),
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