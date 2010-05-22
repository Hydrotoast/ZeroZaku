<?php
/**
*
* @package acp
* @version $Id: board3_portal_check_version.php 411 2008-11-12 17:16:28Z kevin74 $
* @copyright (c) 2007 StarTrekGuide
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package mod_version_check
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

class board3_portal_check_version
{
	function version()
	{
		global $portal_config, $phpbb_root_path, $phpEx;
			include_once($phpbb_root_path . 'portal/includes/functions.' . $phpEx);
			$portal_config = obtain_portal_config();

		return array(
			'author'	=> 'Saint_hh',
			'title'		=> 'Board3 Portal',
			'tag'		=> 'board3_portal',
			'version'	=> $portal_config['portal_version'],
			'file'		=> array('board3.de', 'updatecheck', 'board3_portal.xml'),
		);
	}
}

?>