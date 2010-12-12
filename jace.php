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

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if ($user->data['user_id'] == ANONYMOUS)
{
	login_box($phpbb_root_path . 'client_check.' . $phpEx, $user->lang['LOGIN_VIEWPAGE']);
}

// Output page
page_header($user->lang['INDEX']);

$template->set_filenames(array(
  'body' => 'jace_body.html')
);

page_footer();

?>