<?php
/**
*
* @author Ian Taylor, Platinum2007 iantaylor603@gmail.com - http://street-steeze.com
*
* @package Simple Profile comments
* @version 1.6.1
* @copyright (c) Street Steeze, Ian-Taylor.ca street-steeze.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
// php extension using

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include( $phpbb_root_path . 'includes/functions_messenger.' .$phpEx );

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/simple_comment_mod');

	// Make sure the user leaving a commment is logged in, Damn spam bots.
    if ($user->data['user_id'] == ANONYMOUS)
    {
        login_box('', 'LOGIN');
    }

	$mode = request_var('mode', '');

	if(!empty($_POST) && $mode == 'new_comment') 
	{	
	// check if the comment is blank, if so trigger a error.
		if(!request_var('comment_text','', true))
		{
			trigger_error($user->lang['BLANK_COMMENT']);
		}
	
		$time 				= time();
		$comment_id 		= request_var('comment_id', 0);
		$comment_poster_id 	= $user->data['user_id'];
		$comment_author 	= $user->data['username'];;
		$comment_text 		= request_var('comment_text','', true);
		$comment_to_id 		= request_var('comment_to_id', 0);
		$uid = $bitfield 	= $options = ''; 
		$allow_bbcode 		= $allow_urls = $allow_smilies = true;

		generate_text_for_storage($comment_text, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

		$sql_ary = (array(
    		'comment_date'       		=> $time,
			'comment_id'        		=> $comment_id,
			'comment_poster_id'         => $comment_poster_id,
			'comment_to_id'         	=> $comment_to_id,
			'comment_author'            => $comment_author,
			'comment_text'              => $comment_text,
    		'bbcode_uid'        		=> $uid,
    		'bbcode_bitfield'   		=> $bitfield,					
   			'bbcode_options'    		=> $options,
	
		));

		$sql = 'INSERT INTO ' . COMMENT_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
		$db->sql_query($sql);
		
		// Send a email to the comment reciever, only if they want to get one.
		$messenger = new messenger();
		$sql = 'SELECT username, user_lang, user_email, user_jabber, user_notify_type, allow_comment_email 
			FROM '.USERS_TABLE.' 
			WHERE user_id ='.$comment_to_id;
			
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
			$do_want = ($row['allow_comment_email']) ? true:false;
			
			if($do_want)
			{
   				$messenger->template('new_comment', $row['user_lang']);
    			$messenger->to($row['user_email'], $row['username']);
    			$messenger->im($row['user_jabber'], $row['username']);
    			$messenger->assign_vars(array(
        			'BOARD_EMAIL_SIG'    => $config['board_email_sig'],
        			'USERNAME'    		 => $row['username'],
        			'COMMENT_POSTER'	 => $comment_author,
    			));
    			$messenger->send($row['user_notify_type']);
				$messenger->save_queue();
			}
		$id = request_var('comment_to_id', 0);
		redirect(append_sid("{$phpbb_root_path}memberlist.$phpEx","mode=viewprofile&amp;u=".$id));
		
	}


	// Deleting of comments.
	if($mode == 'delete') 
	{
		$u = request_var('u', 0);
		$p = request_var('p', 0);
		$comment_id = request_var('comment', 0);

		$sql = 'SELECT * from '. COMMENT_TABLE .' WHERE comment_id ='.$comment_id;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		
 	// User must be regestered, must be deleting his/her own comments or comments from his/her own profile. Admins and Moderators can delete from any profile.
		if ($user->data['is_registered'] && ($row['comment_poster_id'] == $user->data['user_id'] || $row['comment_to_id'] == $user->data['user_id']) || ($auth->acl_getf_global('m_') || $auth->acl_get('a_')))
		{

			$sql = 'DELETE 
				FROM '. COMMENT_TABLE .
				' WHERE comment_id='.$comment_id;
			$db->sql_query($sql);
			// Re-direct back to the previous profile.
			$id = request_var('p', 0);
			redirect(append_sid("{$phpbb_root_path}memberlist.$phpEx","mode=viewprofile&amp;u=".$id));


		}
		else
		{
     		trigger_error('NOT_AUTHORISED');
		}
	}
	
?>