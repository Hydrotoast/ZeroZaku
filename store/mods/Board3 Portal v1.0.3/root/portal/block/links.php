<?php

/**
*
* @package - Board3portal
* @version $Id: links.php 325 2008-08-17 18:59:40Z kevin74 $
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

$links = ( strlen($portal_config['portal_links_array']) > 0 ) ? unserialize($portal_config['portal_links_array']) : array();

ksort( $links );
reset( $links );

foreach( $links as $link_id => $link_data )
{
	$template->assign_block_vars('link', array(
		'URL' => $link_data['url'],
		'TEXT' => $link_data['text'],
	));
}

$template->assign_vars(array(
	'S_DISPLAY_LINKS' => true,
));

?>