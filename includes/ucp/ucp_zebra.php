<?php
/**
*
* @package ucp
* @version $Id: ucp_zebra.php 9597 2009-06-16 14:06:56Z nickvergessen $
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
* ucp_zebra
* @package ucp
*/
class ucp_zebra
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $phpbb_root_path, $phpEx;
		
		include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

		$submit	= (isset($_POST['submit']) || isset($_GET['add']) || isset($_GET['remove'])) ? true : false;
		$s_hidden_fields = '';

		$l_mode = strtoupper($mode);
		
		if ($submit)
		{
			$data = $error = array();
			$updated = false;

			$var_ary = array(
				'usernames'	=> array(0),
				'add'		=> '',
			);

			foreach ($var_ary as $var => $default)
			{
				$data[$var] = request_var($var, $default, true);
			}
			
            if (!empty($data['add']) || sizeof($data['usernames']))
			{
				if (confirm_box(true))
				{
					// Remove users
					if (!empty($data['usernames']))
					{
					    if($mode == 'pending')
					    {
					    	$sql = 'DELETE FROM ' . ZEBRA_TABLE . '
								WHERE zebra_id = ' . $user->data['user_id'] . '
									AND ' . $db->sql_in_set('user_id', $data['usernames']) . '
									AND pending = 1';
					    }
					    else
					    {
							$sql = 'DELETE FROM ' . ZEBRA_TABLE . '
								WHERE pending = 0
									AND ( user_id = ' . $user->data['user_id'] . ' AND ' . $db->sql_in_set('zebra_id', $data['usernames']) . ')
									OR ( zebra_id = ' . $user->data['user_id'] . ' AND ' . $db->sql_in_set('user_id', $data['usernames']) . ')';
					    }

					    $db->sql_query($sql);
					    
						$updated = true;
					}

					// Add users
					if ($data['add'])
					{
						$data['add'] = array_map('trim', array_map('utf8_clean_string', explode("\n", $data['add'])));
						
						if($mode == 'pending')
						{
							 $sql = 'SELECT z.*, u.username, u.username_clean
								FROM ' . ZEBRA_TABLE . ' z, ' . USERS_TABLE . ' u
								WHERE z.zebra_id = ' . $user->data['user_id'] . '
									AND z.pending = 1
									AND u.user_id = z.user_id';
						    $result = $db->sql_query($sql);
						
						    $requests = array();
					        while($row = $db->sql_fetchrow($result))
					        {
					            $requests[] = utf8_clean_string($row['username']);
					        }
					        $db->sql_freeresult($result);
					        
					        // only add users who requested to be your friend
					        $n = sizeof($data['add']);
					        $data['add'] = array_intersect($data['add'], $requests);
					        
						    if (sizeof($data['add']) < $n)
							{
								$error[] = var_dump($requests);
							}
						}
						else
						{
						    // Do these name/s exist on a list already? If so, ignore ... we could be
							// 'nice' and automatically handle names added to one list present on
							// the other (by removing the existing one) ... but I have a feeling this
							// may lead to complaints
							$sql = 'SELECT z.*, u.username, u.username_clean
								FROM ' . ZEBRA_TABLE . ' z, ' . USERS_TABLE . ' u
								WHERE z.user_id = ' . $user->data['user_id'] . '
									AND u.user_id = z.zebra_id';
							$result = $db->sql_query($sql);
	
							$friends = $foes = $pending = array();
							while ($row = $db->sql_fetchrow($result))
							{
								if ($row['friend'])
								{
									$friends[] = utf8_clean_string($row['username']);
								}
								elseif ($row['foe'])
								{
									$foes[] = utf8_clean_string($row['username']);
								}
								elseif ($row['pending'])
								{
								    $pending[] = utf8_clean_string($row['username']);
								}
							}
							$db->sql_freeresult($result);
						    
							// remove friends from the username array
							$n = sizeof($data['add']);
							$data['add'] = array_diff($data['add'], $friends);
	
							if (sizeof($data['add']) < $n && $mode == 'foes')
							{
								$error[] = $user->lang['NOT_ADDED_FOES_FRIENDS'];
							}
	
							// remove foes from the username array
							$n = sizeof($data['add']);
							$data['add'] = array_diff($data['add'], $foes);
	
							if (sizeof($data['add']) < $n && $mode == 'friends')
							{
								$error[] = $user->lang['NOT_ADDED_FRIENDS_FOES'];
							}
						    
						    // remove pending from the username array
						    $n = sizeof($data['add']);
						    $data['add'] = array_diff($data['add'], $pending);
						    
						    if (sizeof($data['add']) < $n && $mode == 'friends')
							{
								$error[] = $user->lang['NOT_ADDED_FRIENDS_PENDING'];
							}
						}

						// remove the user himself from the username array
						$n = sizeof($data['add']);
						$data['add'] = array_diff($data['add'], array(utf8_clean_string($user->data['username'])));

						if (sizeof($data['add']) < $n)
						{
							$error[] = $user->lang['NOT_ADDED_' . $l_mode . '_SELF'];
						}

						unset($friends, $foes, $n);

						if (sizeof($data['add']))
						{
							$sql = 'SELECT user_id, user_type
								FROM ' . USERS_TABLE . '
								WHERE ' . $db->sql_in_set('username_clean', $data['add']) . '
									AND user_type <> ' . USER_INACTIVE;
							$result = $db->sql_query($sql);

							$user_id_ary = array();
							while ($row = $db->sql_fetchrow($result))
							{
								if ($row['user_id'] != ANONYMOUS && $row['user_type'] != USER_IGNORE)
								{
									$user_id_ary[] = $row['user_id'];
								}
								else if ($row['user_id'] != ANONYMOUS)
								{
									$error[] = $user->lang['NOT_ADDED_' . $l_mode . '_BOTS'];
								}
								else
								{
									$error[] = $user->lang['NOT_ADDED_' . $l_mode . '_ANONYMOUS'];
								}
							}
							$db->sql_freeresult($result);

							if (sizeof($user_id_ary))
							{
								// Remove users from foe list if they are admins or moderators
								if ($mode == 'foes')
								{
									$perms = array();
									foreach ($auth->acl_get_list($user_id_ary, array('a_', 'm_')) as $forum_id => $forum_ary)
									{
										foreach ($forum_ary as $auth_option => $user_ary)
										{
											$perms = array_merge($perms, $user_ary);
										}
									}

									$perms = array_unique($perms);

									if (sizeof($perms))
									{
										$error[] = $user->lang['NOT_ADDED_FOES_MOD_ADMIN'];
									}

									// This may not be right ... it may yield true when perms equate to deny
									$user_id_ary = array_diff($user_id_ary, $perms);
									unset($perms);
								}
								
								if (sizeof($user_id_ary))
								{
								    switch($mode)
								    {
									    case 'pending':
									        $db->sql_transaction('begin');
									        foreach ($user_id_ary as $zebra_id)
											{
												$sql = 'UPDATE ' . ZEBRA_TABLE . '
													SET friend = 1, pending = 0
													WHERE user_id = ' . (int) $zebra_id . '
														AND zebra_id = ' . (int) $user->data['user_id'];
												
												$db->sql_query($sql);
											}
											$db->sql_transaction('commit');
									        break;
									    case 'friends':
									        $db->sql_transaction('begin');
											$sql_ary = array();
											foreach ($user_id_ary as $zebra_id)
											{
											    $sql = 'UPDATE ' . USERS_TABLE . '
											    	SET friend_requests = friend_requests+1
											    	WHERE user_id = ' . $zebra_id;
											    $db->sql_query($sql);
											    
												$sql_ary[] = array(
													'user_id'		=> (int) $user->data['user_id'],
													'zebra_id'		=> (int) $zebra_id,
													'pending'		=> 1
												);
											}	
											$db->sql_multi_insert(ZEBRA_TABLE, $sql_ary);
											$db->sql_transaction('commit');
									        break;
									    case 'foes':
									        $sql_mode = ($mode == 'friends') ? 'pending' : 'foe';
										
											$db->sql_transaction('begin');
											foreach ($user_id_ary as $zebra_id)
											{
											    $sql = 'DELETE FROM ' . ZEBRA_TABLE . '
											    	WHERE pending = 1
											    		AND (( user_id = ' . (int) $zebra_id . ' AND zebra_id = ' . (int) $user->data['user_id'] . ' )
											    		OR ( user_id = ' . (int) $user->data['user_id'] . ' AND zebra_id = ' . (int) $zebra_id . '))';
											    $db->sql_query($sql);
											}
											$db->sql_transaction('commit');
											
											$sql_ary = array();
											foreach ($user_id_ary as $zebra_id)
											{
												$sql_ary[] = array(
													'user_id'		=> (int) $user->data['user_id'],
													'zebra_id'		=> (int) $zebra_id,
													'foe'		    => 1
												);
											}
											
											$db->sql_multi_insert(ZEBRA_TABLE, $sql_ary);
										    break;
								    }

									$updated = true;
								}
								unset($user_id_ary);
							}
							else if (!sizeof($error))
							{
								$error[] = $user->lang['USER_NOT_FOUND_OR_INACTIVE'];
							}
						}
					}

					if ($updated)
					{
						meta_refresh(3, $this->u_action);
						$message = $user->lang[$l_mode . '_UPDATED'] . '<br />' . implode('<br />', $error) . ((sizeof($error)) ? '<br />' : '') . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
						trigger_error($message);
					}
					else
					{
						$template->assign_var('ERROR', implode('<br />', $error));
					}
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'mode'		=> $mode,
						'submit'	=> true,
						'usernames'	=> $data['usernames'],
						'add'		=> $data['add']))
					);
				}
			}
		}

		if($mode === 'pending')
		{
		    $sql = 'UPDATE ' . USERS_TABLE . '
		    	SET friend_requests = 0
		    	WHERE user_id = ' . $user->data['user_id'];
		    $db->sql_query($sql);
		    
            $sql = 'SELECT z.user_id, z.zebra_id, u.username, u.username_clean
				FROM ' . ZEBRA_TABLE . ' z, ' . USERS_TABLE . ' u
				WHERE z.zebra_id = ' . $user->data['user_id'] . '
					AND z.pending = 1
					AND u.user_id = z.user_id
				ORDER BY u.username_clean ASC';
		    $result = $db->sql_query($sql);
		}
		else
		{
			$sql_and = ($mode == 'friends') ? 'z.friend = 1' : 'z.foe = 1';
			$sql = 'SELECT z.user_id, z.zebra_id, u.username, u.user_colour, u.username_clean, u.user_avatar, u.user_avatar_type
				FROM ' . USERS_TABLE . ' u
				JOIN ' . ZEBRA_TABLE . ' z ON ' . $sql_and . '
					AND ((u.user_id = z.user_id AND z.zebra_id = ' . $user->data['user_id'] . ')
						OR (u.user_id = z.zebra_id AND z.user_id = ' . $user->data['user_id'] . '))
				ORDER BY u.username_clean ASC';
			$result = $db->sql_query($sql);
		}

		$s_username_options = '';
		while ($row = $db->sql_fetchrow($result))
		{
		    $zebra_id = ($row['zebra_id'] == $user->data['user_id']) ? $row['user_id'] : $row['zebra_id'];
		    
		    $template->assign_block_vars('zebra', array(
		        'USER_ID'	        => $zebra_id,
			));

			if ($mode !== 'pending') {
				$template->assign_block_vars('zebra', array(
					'USERNAME'	   	    => get_username_string('full', $zebra_id, $row['username'], $row['user_colour']),
					'USERNAME_CLEAN'	=> get_username_string('username', $zebra_id, $row['username'], $row['user_colour']),
					'AVATAR'	    	=> ($user->optionget('viewavatars')) ? get_user_avatar($row['user_avatar'], $row['user_avatar_type'], 40, 40) : '',

					'U_PROFILE'		=> get_username_string('profile', $zebra_id, $row['username'], $row['user_colour'])
				));
			}
		}

		$template->assign_vars(array(
			'L_TITLE'			=> $user->lang['UCP_ZEBRA_' . $l_mode],
            'TOTAL'				=> (isset($result->num_rows) ? $result->num_rows : 0),
		
			'U_FIND_USERNAME'	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=searchuser&amp;form=ucp&amp;field=add'),

			'S_HIDDEN_FIELDS'		=> $s_hidden_fields,
			'S_UCP_ACTION'			=> $this->u_action)
		);
		$db->sql_freeresult($result);

		$this->tpl_name = 'ucp_zebra_' . $mode;
		$this->page_title = 'UCP_ZEBRA_' . $l_mode;
	}
}

?>
