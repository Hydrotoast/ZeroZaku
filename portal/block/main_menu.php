<?php

/**
*
* @package - Board3portal
* @version $Id: main_menu.php 464 2009-02-11 01:22:30Z Christian_N $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}

if (!defined('IN_PORTAL'))
{
   exit;
}

$template->assign_vars(array(
	'S_DISPLAY_MAINMENU' 	=> true,
	'U_M_BBCODE'   			=> append_sid("{$phpbb_root_path}faq.$phpEx", 'mode=bbcode'),
	'U_M_TERMS'      		=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=terms'),
	'U_M_PRV'      			=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=privacy'),
));

?>