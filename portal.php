<?php

/**
*
* @package - Board3portal
* @version $Id: portal.php 494 2009-03-28 14:14:34Z Christian_N $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/


define('IN_PHPBB', true);
define('IN_PORTAL', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'portal/includes/functions.'.$phpEx);

$portal_config = obtain_portal_config();

if (!$portal_config['portal_enable'])
{
	// Redirect the user to the installer
	// We have to generate a full HTTP/1.1 header here since we can't guarantee to have any of the information
	// available as used by the redirect function
	$server_name = (!empty($_SERVER['HTTP_HOST'])) ? strtolower($_SERVER['HTTP_HOST']) : ((!empty($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : getenv('SERVER_NAME'));
	$server_port = (!empty($_SERVER['SERVER_PORT'])) ? (int) $_SERVER['SERVER_PORT'] : (int) getenv('SERVER_PORT');
	$secure = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 1 : 0;

	$script_name = (!empty($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : getenv('PHP_SELF');
	if (!$script_name)
	{
		$script_name = (!empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
	}

	// Replace any number of consecutive backslashes and/or slashes with a single slash
	// (could happen on some proxy setups and/or Windows servers)
	$script_path = trim(dirname($script_name)) . '/'.$phpbb_root_path.'index.' . $phpEx;
	$script_path = preg_replace('#[\\\\/]{2,}#', '/', $script_path);

	$url = (($secure) ? 'https://' : 'http://') . $server_name;

	if ($server_port && (($secure && $server_port <> 443) || (!$secure && $server_port <> 80)))
	{
		// HTTP HOST can carry a port number...
		if (strpos($server_name, ':') === false)
		{
			$url .= ':' . $server_port;
		}
	}

	$url .= $script_path;
	header('Location: ' . $url);
	exit;
}

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/lang_portal');

if ( is_file( $phpbb_root_path . 'install/index.'.$phpEx ) === TRUE && ($user->data['user_type'] == USER_FOUNDER) )
{
		$template->assign_vars(array(
			'S_DISPLAY_GENERAL'	=> true,
			'GEN_TITLE'				=> $user->lang['PORTAL_INSTALL'],
			'GEN_MESSAGE'			=> $user->lang['PORTAL_INSTALL_TEXT']
		));
}

if ($portal_config['portal_recent']) 
{ 
	include($phpbb_root_path . 'portal/block/recent.'.$phpEx);
}

if ($portal_config['portal_recent']) 
{ 
	include($phpbb_root_path . 'portal/block/popular.'.$phpEx);
}

if ($portal_config['portal_top_posters'])
{
	include($phpbb_root_path . 'portal/block/top_posters.'.$phpEx);
}

// BEGIN mChat Mod
if(!defined('MCHAT_INCLUDE') && $config['mchat_on_index'] && $config['mchat_enable'] && $auth->acl_get('u_mchat_view') && $user->optionget('mchat'))
{
	define('MCHAT_INCLUDE', true);
	$mchat_include_index = true;
	include($phpbb_root_path.'mchat.'.$phpEx);
}
// END mChat Mod

// output page
page_header($user->lang['PORTAL']);

$template->set_filenames(array(
	'body' => '/portal/portal_body.html'
));

page_footer();

?>