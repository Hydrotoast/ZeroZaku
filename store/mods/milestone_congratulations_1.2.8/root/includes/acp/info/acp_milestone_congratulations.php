<?php

/**
*
* @package - "Milestone Congratulations"
* @version $Id: acp_milestone_congratulations.php 4 2008-10-02 MartectX $
* @copyright (C)2008, MartectX ( http://mods.martectx.de/ )
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
class acp_milestone_congratulations_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_milestone_congratulations',
			'title'		=> 'MC_TITLE',
			'version'	=> '1.2.8',
			'modes'		=> array(
				'config_milestone_congratulations' => array(
					'title'		=> 'MC_CONFIG',
					'auth'		=> 'acl_a_board',
					'cat'		=> array('ACP_BOARD_CONFIGURATION'),
				),
			),
		);
	}
}

?>