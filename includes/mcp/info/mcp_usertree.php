<?php
/**
*
* @package mcp
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
class mcp_usertree_info
{
	function module()
	{
		return array(
			'filename'	=> 'mcp_usertree',
			'title'		=> 'User Tree',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'search'				=> array('title' => 'Search', 'auth' => '', 'cat' => array('MCP_USERTREE')),
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