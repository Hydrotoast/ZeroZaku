<?php
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include ($phpbb_root_path . 'common.' . $phpEx);

// Initilize the phpBB sessions.
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/lang_factions');

// Start the output.
$action	= request_var('action', '');
page_header($user->lang['FACTIONS_TITLE']);

$submit = request_var('submit', '');

if($submit)
{
    
}

// Include the file for the action called.
$basename = basename($action . '.' . $phpEx);
include($phpbb_root_path . 'factions/' . $basename . '.' . $phpEx);

page_footer();
?>
