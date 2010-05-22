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
if (!defined('IN_PHPBB'))
{
	exit;
}
class acp_comment
{
   var $u_action;
   var $new_config;
   function main($id, $mode)
   {
      global $db, $user, $auth, $template;
      global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
      switch($mode)
      {
         case 'index':
            $this->page_title = 'ACP_COMMENT';
            $this->tpl_name = 'acp_comment';
            break;
            
       }
       if(isset($_POST['submit']))
       {
		set_config('enable_comment', request_var('enable_comment', 0));
		set_config('enable_qc', request_var('enable_qc', 0));
		set_config('enable_status_memberlist', request_var('enable_status_memberlist', 0));
		set_config('comm_per_page', request_var('comm_per_page', 0));
		set_config('sc_av_size', request_var('sc_av_size', 0));
		}
		
	$template->assign_vars(array(
			
			'ENABLE_COMMENT'		=> $config['enable_comment'],
			'ENABLE_QC'				=> $config['enable_qc'],
			'COMM_PER_PAGE'			=> $config['comm_per_page'],
			'AVATAR_SIZE'			=> $config['sc_av_size'],
			'U_ACTION_ALL'			=> $this->u_action . '&amp;action=deleteall',
			'U_ACTION'				=> $this->u_action,

			));

	$start   = request_var('start', 0);
	$limit   = request_var('limit', 25);

		$sql = $db->sql_build_query('SELECT', array(
			'SELECT'	=> 'u.username, u.user_colour, c.*',
			'FROM'		=> array(
				USERS_TABLE		=> 'u',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(COMMENT_TABLE => 'c'),
					'ON'	=> 'c.comment_to_id = u.user_id'		
				)
			),
			'WHERE'		=> 'c.comment_to_id = u.user_id',		
			'ORDER_BY'	=> 'c.comment_id DESC'
		));

	$result = $db->sql_query_limit($sql, $limit, $start);

	while($row = $db->sql_fetchrow($result, $limit, $start))
	{

			$row['bbcode_options'] = (($row['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) +
    					(($row['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) + 
    					(($row['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);
			$comment_text_format = generate_text_for_display($row['comment_text'], $row['bbcode_uid'], $row['bbcode_bitfield'], 		$row['bbcode_options']);
				
			$id= $row['comment_id'];
			$mass = $row['comment_author'];

			$template->assign_block_vars('comment',array(	
				'COMMENT_DATE'		=> $user->format_date($row['comment_date']),
				'COMMENT_AUTHOR'	=> $row['comment_author'],
				'COMMENT_TO'		=> $row['username'],
				'COMMENT_TEXT'		=> $comment_text_format,
				'USER_COLOUR'		=> $row['user_colour'],
				'U_ACTION'			=> $this->u_action . '&amp;action=delete&amp;id='.$id,
	
			));

	}
	$sql = 'SELECT COUNT(comment_id) AS number_comment FROM '.COMMENT_TABLE;
	$result = $db->sql_query($sql);

	$total_comment = $db->sql_fetchfield('number_comment');

	$db->sql_freeresult($result);
	$action = $this->u_action;
	$template->assign_vars(array(
    	'PAGINATION'        => generate_pagination($action, $total_comment, $limit, $start),
    	'PAGE_NUMBER'       => on_page($total_comment, $limit, $start),
    	'TOTAL_STATUS'       => $total_comment,
	));



	$action = request_var('action', '');
	switch($action)
	{
	case 'deleteall': 
	
		$id = request_var('mass_delete', 0);
		$sql = 'DELETE 
					FROM '.COMMENT_TABLE.'
			 			WHERE comment_poster_id='.$id;
		$db->sql_query($sql);
		redirect($this->u_action);
		break;
		
	case 'delete':
	
		$id = request_var('id', 0);
		$sql = 'DELETE 
					FROM '.COMMENT_TABLE.'
			 			WHERE comment_id='.$id;
		$db->sql_query($sql);
		redirect($this->u_action);

		break;


	}
					
	}

}

?>