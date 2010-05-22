<?php
/**
*
* @package ucp
* @version $Id: ucp_main.php 9459 2009-04-17 15:08:09Z acydburn $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* ucp_main
* UCP Front Panel
* @package ucp
*/
class ucp_clients
{
	var $p_master;
	var $u_action;

	function ucp_clients(&$p_master)
	{
		$this->p_master = &$p_master;
	}

	function main($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $phpbb_root_path, $phpEx;

		switch ($mode)
		{
			case 'front':

				$template->assign_var('S_SHOW_CLIENTS', true);

				$user->add_lang('clients');

				$edit		= (isset($_REQUEST['edit'])) ? true : false;
				$submit		= (isset($_POST['submit'])) ? true : false;
				$client_id	= ($edit) ? intval($_REQUEST['edit']) : 0;
				$delete		= (isset($_POST['delete'])) ? true : false;

				$s_hidden_fields = ($edit) ? '<input type="hidden" name="edit" value="' . $client_id . '" />' : '';
				$client_subject = $client_message = '';
				add_form_key('ucp_client');

				if ($delete)
				{
					if (check_form_key('ucp_client'))
					{
						$clients = array_keys(request_var('d', array(0 => 0)));

						if (sizeof($clients))
						{
							$sql = 'DELETE FROM ' . CLIENTS_TABLE . '
								WHERE ' . $db->sql_in_set('client_id', $clients) . '
									AND user_id = ' . $user->data['user_id'];
							$db->sql_query($sql);
						}
						$msg = $user->lang['CLIENTS_DELETED'];
						unset($clients);
					}
					else
					{
						$msg = $user->lang['FORM_INVALID'];
					}
					$message = $msg . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
					meta_refresh(3, $this->u_action);
					trigger_error($message);
				}

				if ($submit && $edit)
				{
					$client_name 		= request_var('client_name', '');
					$client_new_pass 	= request_var('client_new_pass', '');
					$client_passconf	= request_var('client_passconf', '');
					$client_passcur		= request_var('client_passcur', '');	
					if (check_form_key('ucp_client'))
					{	
						if ($client_name)
						{
							if($client_new_pass)
							{
								$sql = 'SELECT client_pass FROM '. CLIENTS_TABLE . ' WHERE client_id=' . $client_id;
								$result = $db->sql_query($sql);
								$row = $db->sql_fetchrow($result);
								
								if(strcmp($client_new_pass, $client_passconf) == 0 && phpbb_check_hash($client_passcur, $row['client_pass']))
								{
									$client_desc = utf8_normalize_nfc(request_var('client_desc', '', true));
									$uid = $bitfield = $options = ''; // will be modified by generate_text_for_storage
									$allow_bbcode = true;
									$allow_urls = $allow_smilies = false;
									generate_text_for_storage($text, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);
									
									// Update the client
									$sql_array	= array(
										'client_name'			=> $client_name,
										'client_pass'			=> phpbb_hash($client_pass),
										'client_desc'           => $client_desc,
										'client_desc_options'   => $allow_bbcode,
									    'client_desc_bitfield'  => $bitfield,
									    'client_desc_uid'       => $uid,
									);
									
									$sql = 'UPDATE ' . CLIENTS_TABLE . ' 
										SET ' . $db->sql_build_array('UPDATE', $sql_array) . '
										WHERE client_id=' . $client_id . '
											AND user_id=' . $user->data['user_id'];
									$db->sql_query($sql);
		
									$message = $user->lang['CLIENT_UPDATED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
		
									meta_refresh(3, $this->u_action);
									trigger_error($message);
								}
								else
								{
									$template->assign_var('ERROR', $user->lang['PASS_NO_MATCH_OR_CUR']);
								}
								$db->sql_freeresult($result);
							}
							elseif($client_passcur === '')
							{			
								$client_desc = utf8_normalize_nfc(request_var('client_desc', '', true));
								$uid = $bitfield = $options = ''; // will be modified by generate_text_for_storage
								$allow_bbcode = true;
								$allow_urls = $allow_smilies = false;
								generate_text_for_storage($text, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);
								
								// Update the client
								$sql_array	= array(
									'client_name'			=> $client_name,
									'client_desc'           => $client_desc,
									'client_desc_options'   => $allow_bbcode,
								    'client_desc_bitfield'  => $bitfield,
								    'client_desc_uid'       => $uid,
								);
								
								$sql = 'UPDATE ' . CLIENTS_TABLE . ' 
									SET ' . $db->sql_build_array('UPDATE', $sql_array) . '
									WHERE client_id=' . $client_id . '
										AND user_id=' . $user->data['user_id'];
								$db->sql_query($sql);
	
								$message = $user->lang['CLIENT_UPDATED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
	
								meta_refresh(3, $this->u_action);
								trigger_error($message);
							}
						}
						else
						{
							$template->assign_var('ERROR', $user->lang['EMPTY_CLIENT_NAME']);
						}
					}
					else
					{
						$template->assign_var('ERROR', $user->lang['FORM_INVALID']);
					}
				}
				
				$sql = 'SELECT client_id, client_name, client_uses, client_desc, client_desc_bitfield, client_desc_options, client_desc_uid FROM ' . CLIENTS_TABLE . '
						WHERE user_id = ' . $user->data['user_id'] . ' ' .
							(($edit) ? "AND client_id = $client_id" : '');
				$result = $db->sql_query($sql);
				$clientrows = array();

				while ($row = $db->sql_fetchrow($result))
				{
					$clientrows[] = $row;
				}
				$db->sql_freeresult($result);
				
				$template->assign_var('S_EDIT_CLIENT', $edit);
				
				$row_count = 0;
				foreach ($clientrows as $client)
				{
					($edit) ? decode_message($client['client_desc'], $client['client_desc_uid']) : '';
					
					$template_row = array(
						'CLIENT_ID'		=> $client['client_id'],
						'CLIENT_NAME'	=> $client['client_name'],
						'CLIENT_DESC'	=> ($edit) ? $client['client_desc'] : generate_text_for_display($client['client_desc'], $client['client_desc_uid'], $client['client_desc_bitfield'], $client['client_desc_options']),
						'CLIENT_USES'	=> $client['client_uses'],
						
						'U_VIEW_EDIT'	=> $this->u_action . '&amp;edit=' . $client['client_id'],
						'U_CLIENT_PERMA'	=> append_sid("{$phpbb_root_path}client_check.$phpEx", 'mode=password&amp;client_id=' . $client['client_id']),

						'S_HIDDEN_FIELDS'	=> $s_hidden_fields
					);
					$row_count++;

					($edit) ? $template->assign_vars($template_row) : $template->assign_block_vars('clientrow', $template_row);
				}

				if (!$edit)
				{
					$template->assign_var('S_CLIENT_ROWS', $row_count);
				}

			break;

			case 'add':
				$user->add_lang('clients');
				
				// Are we submitting a form?
				$submit	= (isset($_POST['submit'])) ? true : false;
				add_form_key('ucp_clients_add');
				
				if ($submit)
				{
					$client_name 		= request_var('client_name', '');
					$client_pass 		= request_var('client_pass', '');	
					$client_passconf	= request_var('client_passconf', '');
					if (check_form_key('ucp_clients_add'))
					{	
						if ($client_name && $client_pass && $client_passconf)
						{
							if(strcmp($client_pass, $client_passconf) == 0)
							{
								$sql = 'SELECT client_id
									FROM ' . CLIENTS_TABLE . '
									WHERE user_id = ' . $user->data['user_id'];
								$result = $db->sql_query($sql);
								$count = mysqli_num_rows($result);
								$db->sql_freeresult($result);
								
								if($count <= 10)
								{
									$client_desc = utf8_normalize_nfc(request_var('client_desc', '', true));
									$uid = $bitfield = $options = ''; // will be modified by generate_text_for_storage
									$allow_bbcode = true;
									$allow_urls = $allow_smilies = false;
									generate_text_for_storage($text, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);
									
									// Insert the client
									$sql_array	= array (
										'user_id' 				=> $user->data['user_id'],
										'client_name'			=> $client_name,
										'client_pass'			=> phpbb_hash($client_pass),
										'client_desc'           => $client_desc,
										'client_desc_options'   => $allow_bbcode,
									    'client_desc_bitfield'  => $bitfield,
									    'client_desc_uid'       => $uid,
									);
									
									$sql = 'INSERT INTO ' . CLIENTS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_array);
									$db->sql_query($sql);
		
									$message = $user->lang['CLIENT_ADDED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
		
									meta_refresh(3, $this->u_action);
									trigger_error($message);
								}
								else
								{
									$template->assign_var('ERROR', $user->lang['TOO_MANY_CLIENTS']);
								}
							}
							else
							{
								$template->assign_var('ERROR', $user->lang['PASS_NO_MATCH']);
							}
						}
						else
						{
							$template->assign_var('ERROR', ($client_name == '') ? $user->lang['EMPTY_CLIENT_NAME'] : (($client_pass == '') ? $user->lang['EMPTY_CLIENT_PASS'] : ''));
						}
					}
					else
					{
						$template->assign_var('ERROR', $user->lang['FORM_INVALID']);
					}
				}

			break;
		}

		$template->assign_vars(array(
			'L_TITLE'				=> $user->lang['UCP_CLIENTS_' . strtoupper($mode)],

			'S_DISPLAY_MARK_ALL'	=> ($mode == 'watched' || ($mode == 'clients' && !isset($_GET['edit']))) ? true : false,
			'S_HIDDEN_FIELDS'		=> (isset($s_hidden_fields)) ? $s_hidden_fields : '',
			'S_UCP_ACTION'			=> $this->u_action,
			
			'TEST_PAGE_IMG'			=> $user->img('icon_post_target', 'Test page'),
		));

		// Set desired template
		$this->tpl_name = 'ucp_clients_' . $mode;
		$this->page_title = 'UCP_CLIENTS_' . strtoupper($mode);
	}
}

?>