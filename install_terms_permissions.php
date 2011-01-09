<?php
    define('IN_PHPBB', true);
    $phpbb_root_path = './';
    $phpEx = substr(strrchr(__FILE__, '.'), 1);
    include($phpbb_root_path . 'common.' . $phpEx);
	
    $user->session_begin();
    $auth->acl($user->data);
    $user->setup();
	
    include($phpbb_root_path . 'includes/acp/auth.' . $phpEx);
    $auth_admin = new auth_admin();

    $auth_admin->acl_add_option(array(
        'local'     => array('f_manage_term'),
        'global'   	=> array('m_manage_term')
    ));
    
    if (empty($lang) || !is_array($lang))
	{
	    $lang = array();
	}
    
    $lang['permission_cat']['terms'] = 'Terms Management';
    
    $lang = array_merge($lang, array(
        'acl_f_manage_term'	=> array('lang' => 'Can manage topic tags', 'cat' => 'terms'),
        'acl_m_manage_term'	=> array('lang' => 'Can manage topic tags', 'cat' => 'terms'),
    ));
	
	echo 'success';
?>