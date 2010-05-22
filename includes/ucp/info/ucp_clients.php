<?php
/**
*
* @package ucp
* @version $Id: ucp_main.php 8479 2008-03-29 00:22:48Z naderman $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
class ucp_clients_info
{
	function module()
	{
		return array(
			'filename'	=> 'ucp_clients',
			'title'		=> 'UCP_CLIENTS',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'front'			=> array('title' => 'UCP_CLIENTS_FRONT', 'auth' => '', 'cat' => array('UCP_CLIENTS')),
				'add'			=> array('title' => 'UCP_CLIENTS_ADD', 'auth' => '', 'cat' => array('UCP_CLIENTS')),
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