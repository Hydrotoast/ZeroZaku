<?php

/**
*
* @package - Board3portal
* @version $Id: link_us.php 325 2008-08-17 18:59:40Z kevin74 $
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

//doing the easy way ;)
$u_link = $config['server_protocol'] . $config['server_name'] . $config['script_path'];

// Assign specific vars
$template->assign_vars(array(
	'S_DISPLAY_LINK_US' => true,
	'LINK_US_TXT'		=> sprintf($user->lang['LINK_US_TXT'], $config['sitename']),
	'U_LINK_US'			=> '&lt;a&nbsp;href=&quot;' . $u_link . '&quot;&nbsp;' . (($config['site_desc']) ? 'title=&quot;' . $config['site_desc'] . '&quot;' : '' ) . '&gt;' . (($config['sitename']) ? $config['sitename'] : $u_link ) . '&lt;/a&gt;',
));

?>