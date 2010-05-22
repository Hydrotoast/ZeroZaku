<?php
/**
*
* @author Hero killaziller@yahoo.com - http://www.zerozaku.com
*
* @package phpBB3
* @version 1.0.0
* @copyright (c) 2010 Zerozaku
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

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('uploader');

$mode = request_var('mode', 'index');
$available_modes = array('index', 'view');

$file_id = request_var('file_id', 0);

$uploading = (isset($_POST['upload'])) ? true : false;

if(!in_array($mode, $available_modes))
{
	trigger_error('NO_MODE');
}

switch($mode)
{
	case 'index':
		$form_key = 'uploader_attach';
		add_form_key($form_key);
		
		if ($submit && !check_form_key($form_key))
		{
			trigger_error($user->lang['FORM_INVALID'], E_USER_WARNING);
		}
			
		$template->set_filenames(array('body' => 'uploader_index.html'));
		break;
	case 'view':
		break;
	default:
		break;
}

page_header('test');

page_footer();

?>