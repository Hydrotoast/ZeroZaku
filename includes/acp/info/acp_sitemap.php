<?php
/**
*
* @package acp
* @version $Id: acp_sitemap.php,v 1.0.6 2010-01-14 14:56:43 FladeX Exp $
* @copyright (c) 2009 FladeX
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class acp_sitemap_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_sitemap',
			'title'		=> 'ACP_SITEMAP',
			'version'	=> '1.0.6',
			'modes'		=> array(
				'index'	=> array('title' => 'ACP_SITEMAP_INDEX_TITLE', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
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