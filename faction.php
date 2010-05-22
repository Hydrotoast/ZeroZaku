<?php
/**
*
* @package groups
* @version $Id: ucp.php 8915 2008-09-23 13:30:52Z acydburn $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
require($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
include($phpbb_root_path . 'includes/functions_privmsgs.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'factions/class_faction.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('factions');

add_form_key('factions');
$action = request_var('action', '');

if (empty($action))
{
	$action = 'view_faction';
}

if (!$user->data["is_registered"])
{
	trigger_error($user->lang['LOGIN_VIEWFORUM'] . $return_page, E_USER_WARNING);
}
else
{
	// Lets build a page ...
	$template->assign_vars(array(
		'L_FAQ_TITLE'	=> $l_title,
		'L_BACK_TO_TOP'	=> $user->lang['BACK_TO_TOP'])
	);
	
	page_header($l_title);
	include('factions/' . $action . '.' . $phpEx);
	
	make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
	
	page_footer();
}

?>