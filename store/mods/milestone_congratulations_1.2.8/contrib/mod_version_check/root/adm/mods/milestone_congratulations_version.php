<?php

/**
*
* @package - "Milestone Congratulations"
* @version $Id: milestone_congratulations_version.php 3 2008-09-21 MartectX $
* @copyright (C)2008, MartectX ( http://mods.martectx.de/ )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package mod_version_check
*/
class milestone_congratulations_version
{
	function version()
	{
		return array(
			'author'	=> 'MartectX',
			'title'		=> 'Milestone Congratulations',
			'tag'		=> 'milestone_congratulations',
			'version'	=> '1.2.8',
			'file'		=> array('mods.martectx.de', '', 'versioncheck.xml'),
		);
	}
}

?>