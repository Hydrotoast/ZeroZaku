<?php
/**
*
* @package phpBB3
* @version $Id: index.php 9614 2009-06-18 11:04:54Z nickvergessen $
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
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/functions_user.'.$phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);

include($phpbb_root_path . 'includes/functions_activity_stats.' . $phpEx);
activity_mod();

$template->set_filenames(array(
	'body' => 'anubis.html')
);

page_footer();

?>