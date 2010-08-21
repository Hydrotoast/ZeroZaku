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

if(!in_array($mode, array('index', 'view', '')))
{
    trigger_error('Invalid action');
}

switch($mode)
{
    case 'index':
        if(!$auth->acl_getf_global('a_'))
        {
            trigger_error('You don\'t belong here' . '<br />' . sprintf($user->lang['RETURN_INDEX'], '<a href="' . append_sid($phpbb_root_path . 'index.' . $phpEx) . '">', '</a>'));
        }
        
        $template_file = 'faction_view.html';
        
        $sql = 'SELECT fa.faction_leader, fa.faction_name, fa.faction_status, u.username, f.forum_name FROM ' . FACTION_APP_TABLE . ' fa
        	JOIN ' . USERS_TABLE .' u
        	JOIN ' . FORUMS_TABLE . ' f
        		ON fa.faction_leader = u.user_id
        			AND fa.forum_id = f.forum_id';
        $result = $db->sql_query($sql);
        
        while($row = $db->sql_fetchrow($result))
        {
            $leader_id = $row['faction_leader'];
            
	        switch($row['faction_status'])
	        {
	            case 0: $status = 'Pending'; break;
	            case 1: $status = 'Approved'; break;
	            case 2: $status = 'Denied'; break;
	        }
            
	        $template->assign_block_vars('faction_app', array(
	            'USERNAME'	        => $row['username'],
	            'FACTION_NAME'	    => $row['faction_name'],
	            'DESIRED_FORUM'	    => $row['forum_name'],
                'FACTION_STATUS'    => $status,
	            'LINK'			    => append_sid("{$phpbb_root_path}faction.$phpEx", "mode=view&u=$leader_id"),
	        ));
        }
        
        $template->assign_vars(array(
            'S_INDEX' => true
        ));
        
        $db->sql_freeresult($result);
    break;
    case 'view':
        if(!$auth->acl_getf_global('a_'))
        {
            trigger_error('You don\'t belong here' . '<br />' . sprintf($user->lang['RETURN_INDEX'], '<a href="' . append_sid($phpbb_root_path . 'index.' . $phpEx) . '">', '</a>'));
        }
        
        $template_file = 'faction_view.html';
        $user_id = request_var('u', 0);
        
        $sql = 'SELECT fa.*, u.username, u.user_email, f.forum_name FROM ' . FACTION_APP_TABLE . ' fa
        	JOIN ' . USERS_TABLE .' u
        	JOIN ' . FORUMS_TABLE . ' f
        		ON fa.faction_leader = u.user_id
        			AND fa.forum_id = f.forum_id
        	WHERE fa.faction_leader = ' . (int) $user_id;
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        
        $member_ids = array($row['member1'], $row['member2']);
        user_get_id_name($member_ids, $members, false);
        
        if($submit)
        {
            $accept_deny = request_var('submit', '');
            
            $sql = 'UPDATE ' . FACTION_APP_TABLE . '
                SET faction_status = \'' . (($accept_deny == 'Approve') ? '1' : '2') . '\'
                WHERE faction_leader = ' . (int) $user_id;
            $db->sql_query($sql);
        }
        
        switch($row['faction_status'])
        {
            case 0: $status = false; break;
            case 1: $status = 'Approved'; break;
            case 2: $status = 'Denied'; break;
        }
        
        $template->assign_vars(array(
            'S_VIEW'	=> true,
            'S_ACTION'	=> (($status) ? '' : append_sid("{$phpbb_root_path}faction.$phpEx", "mode=view&u=$user_id")),
            
            'FACTION_STATUS'	=> $status,
        
            'USERNAME'	    => $row['username'],
            'EMAIL'		    => $row['user_email'],
            'CONTRIBUTIONS'	=> $row['faction_leader_contrib'],
            
            'FACTION_NAME'	=> $row['faction_name'],
            'FACTION_DESC'	=> $row['faction_desc'],
            'DESIRED_FORUM'	=> $row['forum_name'],
        
            'MEMBER1'	=> $members[$row['member1']],
            'MEMBER2'	=> $members[$row['member2']]
        ));
    break;
    default:
        $template_file = 'faction_apply.html';
        
        $sql = 'SELECT * FROM ' . FACTION_APP_TABLE . '
        	WHERE faction_leader = ' . $user->data['user_id'];
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        
        $member_ids = array($row['member1'], $row['member2']);
        user_get_id_name($member_ids, $members, false); 
        
        $data = array(
    		'faction_name'	=> request_var('faction_name', (sizeof($row) ? $row['faction_name'] : '')),
    		'faction_desc'	=> request_var('faction_desc', (sizeof($row) ? $row['faction_desc'] : '')),
        	'forum_id'	    => request_var('forum_id', (sizeof($row) ? $row['forum_id'] : 0)),
        	'contrib'	    => request_var('contrib', (sizeof($row) ? $row['faction_leader_desc'] : '')),
                
    		'member1'	=> request_var('member1', (sizeof($row) ? $members[$row['member1']] : '')),
    		'member2'	=> request_var('member2', (sizeof($row) ? $members[$row['member2']] : ''))
        );
        
        add_form_key('faction_apply');
        
        if($submit)
        {            
            $error = validate_data($data, array(
                'faction_name'	=> array('string', false, 2, 90),
                'faction_desc'	=> array('string', false, 1, 500),
            	'forum_id'		=> array('num', false, 1, 255),
            	'contrib'	    => array('string', true, 2, 500),
                
                'member1'	=> array('string', false, $config['min_name_chars'], $config['max_name_chars']),
                'member2'	=> array('string', false, $config['min_name_chars'], $config['max_name_chars']),
            ));
            
            // Check if the users exist
            unset($member_ids);
            unset($members);
            
            $members = array($data['member1'], $data['member2']);
            user_get_id_name($member_ids, $members, false); 
            if(!isset($member_ids[0]) || !isset($member_ids[1]))
            {
                $error[] = 'These members don\'t exist';
            }
            
            if(!check_form_key('faction_apply'))
            {
                $error[] = 'FORM_INVALID';
            }
            
            if(!sizeof($error))
            {   
                $sql_ary = array(
    				'faction_name'	            => $data['faction_name'],
    				'faction_name_clean'	    => utf8_clean_string($data['faction_name']),
                    'faction_desc'			    => $data['faction_desc'],
                    'forum_id'				    => $data['forum_id'],
                    'faction_leader'		    => $user->data['user_id'],
                    'faction_leader_contrib'	=> $data['contrib'],
                
                    'member1'	=> $member_ids[0],
                    'member2'	=> $member_ids[1]
                );
                
                if (sizeof($sql_ary))
				{
				    if(sizeof($row))
				    {
				        $sql = 'UPDATE ' . FACTION_APP_TABLE . '
				        	SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
				        	WHERE faction_leader = ' . $user->data['user_id'];
				    }
				    else
				    {
						$sql = 'INSERT INTO ' . FACTION_APP_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
				    }
				    $db->sql_query($sql);
				}
                
                trigger_error('Your applicaiton has been submitted for review by an administrator. Please wait for an interview.' . '<br />' . sprintf($user->lang['RETURN_INDEX'], '<a href="' . append_sid($phpbb_root_path . 'index.' . $phpEx) . '">', '</a>'));
            }
               
            // Replace "error" strings with their real, localised form
			$error = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$user->lang['\\1'])) ? \$user->lang['\\1'] : '\\1'", $error);
        }
        
        switch($row['faction_status'])
        {
            case 0: $status = 'Pending'; break;
            case 1: $status = 'Approved'; break;
            case 2: $status = 'Denied'; break;
        }
        
        $template->assign_vars(array(
        	'ERROR'			=> (sizeof($error)) ? implode('<br />', $error) : '',
            'S_ACTION'	    => append_sid("{$phpbb_root_path}faction.$phpEx", 'mode=apply'),
            
            'S_STATUS'			=> $row['faciton_status'],
            'FACTION_STATUS'	=> $status,
            
            'FACTION_NAME'	=> $data['faction_name'],
            'FACTION_DESC'	=> $data['faction_desc'],
        	'CONTRIB'	=> $data['contrib'],
            'FORUM_ID'	=> $data['forum_id'],
        
            'MEMBER1'	=> $data['member1'],
            'MEMBER2'	=> $data['member2']
        ));
    break;
}

if($auth->acl_getf_global('a_'))
{
    $template->assign_vars(array(
        'U_FAPP_INDEX'	=> append_sid("{$phpbb_root_path}faction.$phpEx", 'mode=index')
    ));
}

page_header($user->lang['FACTIONS_TITLE']);

// Include the file for the action called.
$template->set_filenames(array('body' => $template_file));

page_footer();
?>
