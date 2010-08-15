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
$mode	= request_var('mode', '');
$submit = (isset($_POST['submit']) ? true : false);

page_header($user->lang['FACTIONS_TITLE']);

if(empty($mode))
{
    trigger_error('Invalid action');
}

switch($mode)
{
    case 'apply':
        $template_file = 'faction_apply.html';
        
        if($submit)
        {
            $contrib = request_var('contrib', '');
            $faction_name = request_var('faction', '');
            $forum_id = request_var('forum_id', 0);
            $faction_desc = request_var('desc');
            
            $member1 = request_var('member1', 0);
            $memebr2 = request_var('member2', 0);
            
            
        }
    break;
    case 'view':
        $template_file = 'faction_view.html';
        
        $template->assign_vars(array(
            'USERNAME'	    => '',
            'REALNAME'	    => '',
            'EMAIL'		    => '',
            'CONTRIBUTIONS'	=> '',
            
            'FACTION_NAME'	=> '',
            'DESIRED_FORUM'	=> '',
            'FACTION_DESC'	=> '',
        
            'MEMBER1'	=> '',
            'MEMBER2'	=> ''
        ));
    break;
}

page_header();

// Include the file for the action called.
$template->set_filenames(array('body' => $template_file));

page_footer();
?>
