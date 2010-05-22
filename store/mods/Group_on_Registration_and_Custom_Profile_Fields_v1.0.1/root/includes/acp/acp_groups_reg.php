<?php
/**
*
* @package acp
* @version $Id: acp_words.php 8479 2008-03-29 00:22:48Z naderman $
* @version $Id: acp_groups_reg.php 2009-11-21 - v1.0.1 modified by mtrs for groups on registration ACP module
* @copyright (c) 2005 phpBB Group
* @copyright (c) 2009 mtrs
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

class acp_groups_reg
{
	var $u_action;
	
	function main($id, $mode)
	{
		global $db, $user, $config, $template, $phpbb_root_path, $phpEx;

		// Set up general vars
		$action = request_var('action', '');
		$action = (request_var('add', '')) ? 'add' : ((request_var('save', '')) ? 'save' : $action);
		$action = (request_var('update', '')) ? 'update' : $action;
		$action = (request_var('update_custom_config', '')) ? 'update_custom_config' : $action;
		$action = (request_var('update_custom', '')) ? 'update_custom' : $action;		
		$action = (request_var('add_cpf', '')) ? 'add_cpf' : ((request_var('cpf_update', '')) ? 'cpf_update' : $action);
		
		$s_hidden_fields = '';

		$this->tpl_name = 'acp_groups_regs';
		$this->page_title = 'ACP_GROUPS_REGS';

		$form_name = 'acp_groups_regs';
		add_form_key($form_name);

		switch ($action)
		{
			case 'update':

				//We update config entries of groups on registration
				$this->update_groups_registration_config();

			break;		

			case 'add':
				//We add ne groups to display on registration
				$this->add_groups_registration();
					
			break;
			
			case 'save':
				
				//We save the new groups 
				$this->save_groups();

			break;			

			case 'delete':

				//We delete groups from display on registration list
				$this->delete_groups();

			break;			
			
			case 'add_cpf':

				//We add custom profile fields based groups to auto add and remove
				$this->add_remove_cpf_groups();

			break;			

			case 'cpf_update':
				
				//Update cpf based groups list
				$this->cpf_based_groups_update();
				
			break;			

			case 'cpfdelete':
				
				//Delete cpf based groups
				$this->cpf_groups_delete();

			break;			
			
			case 'update_custom_config':
			
				//Update all user groups based on custom profile fields, depending on settings add or remove users to groups
				$this->update_config_cpf_groups();

			break;
			
			case 'update_custom':
			
				//Update all user groups based on custom profile fields, depending on settings add or remove users to groups
				$this->update_synchronise_cpf_groups();

			break;			
			
		}

		//Obtain groups member count
		$total_group_members = $this->group_members_count();
		
		//Add config template variables
		$template->assign_vars( array(
			'U_ACTION'					=> $this->u_action,
			'GROUPS_REG_ENABLED'		=> $config['groups_on_reg_enable'],
			'GROUPS_DEFAULT'			=> $config['groups_default'],
			'GROUPS_REQUIRE'			=> $config['groups_require'],
			'GROUPS_MULTIPLE'			=> $config['groups_on_reg_multiple'],
			'GROUPS_TO_CPF_ENABLED'		=> $config['groups_to_cpf_enable'],
			'GROUPS_TO_CPF_NO_PENDING'	=> $config['groups_to_cpf_no_pending'],
			'S_HIDDEN_FIELDS'			=> $s_hidden_fields
		));				
		
		//We obtain groups names displayed on registration
		$sql = 'SELECT group_name, group_id
			FROM ' . GROUPS_TABLE . '
			WHERE display_on_registration = 1
				AND group_type <> ' . GROUP_SPECIAL;
		$result = $db->sql_query($sql);		
		
		while ($row = $db->sql_fetchrow($result))
		{
			$group_id = $row['group_id'];
			$template->assign_block_vars('groups', array(
				'GROUP_ID'			=> $group_id,
				'GROUP_NAME'		=> $row['group_name'],
				'GROUP_MEMBERS'		=> (isset($total_group_members[$row['group_id']])) ? $total_group_members[$row['group_id']] : 0,
				'U_GROUP'			=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=group&amp;g=' . $group_id),
				'U_DELETE'			=> $this->u_action . '&amp;action=delete&amp;group_id=' . $group_id,
				'ICON_REMOVED'		=> $phpbb_root_path . '/adm/images/icon_delete.gif',
			));
		}
		$db->sql_freeresult($result);
			
		//Obtain custom profile fields based groups data
		$sql = 'SELECT l.lang_value, l.field_id, l.option_id, l.group_id, l.group_name, l.group_id, f.field_name
			FROM ' . PROFILE_FIELDS_LANG_TABLE . ' l, ' . PROFILE_FIELDS_TABLE . ' f
			WHERE l.lang_id = ' . $user->get_iso_lang_id() . '
				AND l.option_id <> 0
				AND l.field_type = ' . FIELD_DROPDOWN . '
				AND l.group_id <> 0
				AND l.field_id = f.field_id';
		$result = $db->sql_query($sql);
		
		$group_id_list = $group_name_list =array();
		while ($row = $db->sql_fetchrow($result))
		{
			$group_id_list[] = $row['group_id'];
			$group_name_list[] = $row['group_name'];
			$group_id = $row['group_id'];
			$field_id = $row['field_id'];
			$option_id = $row['option_id'];
				
			$template->assign_block_vars('cpf_groups', array(
				'GROUP_ID'			=> $group_id,
				'GROUP_NAME'		=> $row['group_name'],
				'GROUP_MEMBERS'		=> (isset($total_group_members[$row['group_id']])) ? $total_group_members[$row['group_id']] : 0,				
				'FIELD_NAME'		=> $row['field_name'],
				'LANG_VALUE'		=> $row['lang_value'],		
				'U_GROUP'			=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=group&amp;g=' . $group_id),
				'U_DELETE'			=> $this->u_action . '&amp;action=cpfdelete&amp;field_id='. $field_id . '&amp;option_id='. $option_id,
				'ICON_REMOVED'		=> $phpbb_root_path . '/adm/images/icon_delete.gif',
			));				
		}
		$db->sql_freeresult($result);

		//Delete any custom profile fields based group, if group name or group_id changes
		$this->validate_groups_cpfs($group_id_list, $group_name_list);
	}
	
	function update_groups_registration_config()
	{
		global $config, $user;
	
		//Obtain the config data and update		
		$groups_on_reg_enable = request_var('groups_on_reg_enable', 0);				
		$groups_default = request_var('groups_default', 0);
		$groups_require = request_var('groups_require', 0);
		$groups_on_reg_multiple = request_var('groups_on_reg_multiple', 0);
						
		set_config('groups_on_reg_enable', $groups_on_reg_enable);
		set_config('groups_default', $groups_default);
		set_config('groups_require', $groups_require);
		set_config('groups_on_reg_multiple', $groups_on_reg_multiple);
	
		add_log('admin', 'LOG_CONFIG_GROUPS_REG_UPDATED');
		trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
	}
	
	function add_groups_registration()
	{
		//Get group list be added for groups on registration
		global $db, $user, $template;
		
		$s_hidden_fields = '';
		$admin_mod_groups = $this->get_admin_mod_groups();
		
		$sql = 'SELECT group_id, group_name
			FROM ' . GROUPS_TABLE . '
			WHERE group_type <> ' . GROUP_SPECIAL . '
				AND display_on_registration = 0';
		$result = $db->sql_query($sql);

		$s_group_options = '<option value=""  selected="selected">--</option>';
		$no_option = false;
		while ($row = $db->sql_fetchrow($result))
		{
			if (!in_array($row['group_id'] ,$admin_mod_groups))
			{
				$group_id_name = $row['group_id'] . ':' . $row['group_name'];
				$group_name = $row['group_name'];
				$s_group_options .= "<option value=\"$group_id_name\">$group_name</option>";
				$no_option = true;
			}
		}
		$db->sql_freeresult($result);

		if (!$no_option)
		{
			trigger_error($user->lang['NO_GROUP_TO_ADD'] . adm_back_link($this->u_action), E_USER_WARNING);
		}
		
		$template->assign_vars(array(
			'S_ADD_GROUP'				=> true,
			'U_ACTION'					=> $this->u_action,
			'U_BACK'					=> $this->u_action,
			'S_GROUP_NAME_OPTIONS'		=> $s_group_options,
			'GROUP_NAME_ID'				=> utf8_normalize_nfc(request_var('group_name_id', '', true)),
			'S_HIDDEN_FIELDS'			=> $s_hidden_fields,
		));
	}
	
	function save_groups()
	{
		//Add groups to display groups on registration list
		global $db, $user;
		
		$group_name_id = utf8_normalize_nfc(request_var('group_name_id', '', true));
				
		if (empty($group_name_id))
		{
			trigger_error($user->lang['ENTER_GROUP_ID_NAME'] . adm_back_link($this->u_action), E_USER_WARNING);
		}
				
		$groud_id_name_list = explode(':', $group_name_id);
		$group_id = (int) $groud_id_name_list[0];
		$group_name = $groud_id_name_list[1];
				
		$sql_ary = array(
			'display_on_registration'			=> 1,
		);					
		$db->sql_query('UPDATE ' . GROUPS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE group_id = ' . $group_id);

		add_log('admin', 'LOG_GROUPS_REG_ADD', $group_id);
		$message = $user->lang['GROUP_ADDED'];
		trigger_error($message . adm_back_link($this->u_action));			
	}
	
	function delete_groups()
	{
		//Remove groups from display groups on registration list
		global $db, $user;
		
		//Obtain the vote topic_id and set it not compulsory to vote anymore
		$group_id = request_var('group_id', 0);

		if (!$group_id)
		{
			trigger_error($user->lang['NO_GROUP'] . adm_back_link($this->u_action), E_USER_WARNING);
		}

		if (confirm_box(true))
		{
			$sql_ary = array(
				'display_on_registration'			=> 0,
			);
			if ($group_id)
			{
				$db->sql_query('UPDATE ' . GROUPS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE group_id = ' . $group_id);
			}
					
			add_log('admin', 'LOG_GROUPS_REG_DELETE', $group_id);
			trigger_error($user->lang['GROUP_REMOVED'] . adm_back_link($this->u_action));
		}
		else
		{
			confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
				'group_id'		=> $group_id,
				'action'		=> 'delete',
			)));
		}		
	}
	
	function update_config_cpf_groups()
	{
		//Update config data
		global $config, $user;
		
		//Obtain the config data and update if needed				
		$groups_to_cpf_enable = request_var('groups_to_cpf_enable', 0);
		$groups_to_cpf_no_pending = request_var('groups_to_cpf_no_pending', 0);
				
		set_config('groups_to_cpf_enable', $groups_to_cpf_enable);
		set_config('groups_to_cpf_no_pending', $groups_to_cpf_no_pending);
		trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
	}
	
	function update_synchronise_cpf_groups()
	{
		//Update config data and synchronise cpf groups members
		global $user;
		
		$message = '';
		if ($this->cpf_group_exist())
		{
				//Batch add users to groups depending on custom profile fields auto-group add settings
				$this->group_batch_user_add_cpf();
				add_log('admin', 'LOG_CPF_GROUPS_SYNCHRONISED');
				trigger_error($user->lang['CPF_ADD_GROUP_LIST_CHANGED'] . adm_back_link($this->u_action));
		}
		else
		{
			trigger_error($user->lang['NO_CPF_GROUP_EXIST'] . adm_back_link($this->u_action), E_USER_WARNING);
		}
		
		if (empty($message))
		{
			trigger_error($user->lang['NO_VALUE_CHANGED'] . adm_back_link($this->u_action), E_USER_WARNING);
		}
	}
	
	function add_remove_cpf_groups()
	{
		//Add and remove groups froum custom profile fields based list
		global $db, $user, $template;
		$s_hidden_fields = '';
		
		//Learn admin and mod auth groups, we do not list them for auto add
		$admin_mod_groups = $this->get_admin_mod_groups();
			
		//Obtain custom profile fields lang values
		$sql = 'SELECT l.lang_value, l.field_id, l.option_id, l.group_id, f.field_name
			FROM ' . PROFILE_FIELDS_LANG_TABLE . ' l, ' . PROFILE_FIELDS_TABLE . ' f
			WHERE l.lang_id = ' . $user->get_iso_lang_id() . '
				AND l.option_id <> 0
				AND l.field_type = ' . FIELD_DROPDOWN . '
				AND l.field_id = f.field_id';
		$result = $db->sql_query($sql);
	
		$s_field_id_name_options = '<option value=""  selected="selected">--</option>';
		$option_exist = false;
		$group_id_list = array();
		while ($row = $db->sql_fetchrow($result))
		{
			if ($row['group_id'] == 0)
			{
				$field_id_name = $row['field_name'] . ':' . $row['lang_value'];
				$lang_value_field_id = $row['option_id'] . ':' . $row['field_id'] . ':' . $row['lang_value'];
				$s_field_id_name_options .= "<option value=\"$lang_value_field_id\">$field_id_name</option>";				
				$option_exist = true;	
			}
			else
			{
				$group_id_list[] = $row['group_id'];
			}
		}
		$db->sql_freeresult($result);
		
		$sql = 'SELECT group_id, group_name
			FROM ' . GROUPS_TABLE . '
			WHERE group_type <> ' . GROUP_SPECIAL;
		$result = $db->sql_query($sql);
							
		$s_group_options = '<option value=""  selected="selected">--</option>';
		$group_exist = false;
		while ($row = $db->sql_fetchrow($result))
		{
			if (!in_array($row['group_id'], $admin_mod_groups))
			{
				$group_id_name = $row['group_id'] . ':' . $row['group_name'];
				$group_name = $row['group_name'];
				$s_group_options .= (!in_array($row['group_id'], $group_id_list)) ? "<option value=\"$group_id_name\">$group_name</option>" : '';
				$group_exist = true;
			}
		}
		$db->sql_freeresult($result);
		
		if (!$option_exist || !$group_exist)
		{
			trigger_error($user->lang['NO_CPF_TO_ADD'] . adm_back_link($this->u_action), E_USER_WARNING);
		}
				
		$template->assign_vars(array(
			'S_CPF_ADD_GROUP'			=> true,
			'U_ACTION'					=> $this->u_action,
			'U_BACK'					=> $this->u_action,
			'GROUP_ID'					=> request_var('group_id', 0),
			'CPF_GROUP_NAME'			=> utf8_normalize_nfc(request_var('group_name', '', true)),
			'CPF_FIELD_NAME'			=> strtolower(request_var('field_option_name', '')),
			'S_GROUP_NAME_OPTIONS'		=> $s_group_options,
			'S_FIELD_NAME_OPTIONS'		=> $s_field_id_name_options,
			'S_HIDDEN_FIELDS'			=> $s_hidden_fields
		));		
	}
	
	function cpf_based_groups_update()
	{
		//Update-add groups to custom profile fields based list
		global $db, $user, $form_name;
		
		$field_option_name = utf8_normalize_nfc(request_var('field_option_name', '', true));
		$group_name_id = utf8_normalize_nfc(request_var('group_name_id', '', true));

		if(empty($field_option_name) || empty($group_name_id))
		{
			$message = $user->lang['NO_CPF_GROUP_SELECTED'];
			trigger_error($message . adm_back_link($this->u_action), E_USER_WARNING);
		}
				
		$field_option_name_list = explode(':', $field_option_name);
		$groud_id_name_list = explode(':', $group_name_id);
				
		$group_id = (int) $groud_id_name_list[0];
		$group_name = $groud_id_name_list[1];
								
		$option_id = (int) $field_option_name_list[0];
		$field_id = (int) $field_option_name_list[1];
		$lang_value = $field_option_name_list[2];
	
		$sql_ary = array(
			'group_id'			=> $group_id,
			'group_name'		=> $group_name,
			);					
		$db->sql_query('UPDATE ' . PROFILE_FIELDS_LANG_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE field_id = ' . $field_id . ' AND option_id = ' . $option_id);		
				
		add_log('admin', 'LOG_GROUPS_CPF_ADD', $group_id);
		$message = $user->lang['GROUP_CPF_ADDED'];
		trigger_error($message . adm_back_link($this->u_action));	
	}
	
	function cpf_groups_delete()
	{
		//Remove groups from cpf based groups
		global $db, $user;

		//Obtain the group_id and remove it from the list
		$field_id = request_var('field_id', 0);
		$option_id = request_var('option_id', 0);
				
		if (!$option_id)
		{
			trigger_error($user->lang['NO_GROUP'] . adm_back_link($this->u_action), E_USER_WARNING);
		}

		if (confirm_box(true))
		{
			$sql_ary = array(
				'group_id'			=> 0,
				'group_name'		=> '',
			);
			$db->sql_query('UPDATE ' . PROFILE_FIELDS_LANG_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE field_id = ' . $field_id . ' AND option_id = ' . $option_id);
					
			add_log('admin', 'LOG_GROUPS_CPF_DELETE');
			$message = $user->lang['CPF_GROUP_REMOVED'];
			trigger_error($message . adm_back_link($this->u_action));
		}
		else
		{
			confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
				'field_id'		=> $field_id,
				'option_id'		=> $option_id,
				'action'		=> 'cpfdelete',
			)));
		}
	}
	
	function group_batch_user_add_cpf()
	{
		global $db, $user;

		//Obtain custom profile fields based group names
		$sql = 'SELECT l.lang_value, l.group_id, l.group_name, l.option_id, f.field_name
			FROM ' . PROFILE_FIELDS_LANG_TABLE . ' l, ' . PROFILE_FIELDS_TABLE . ' f
			WHERE l.lang_id = ' . $user->get_iso_lang_id() . '
				AND l.group_id <> 0
				AND l.field_type = ' . FIELD_DROPDOWN . '
				AND l.field_id = f.field_id
			GROUP BY l.group_id';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$this->group_cpf_batch_user_add($row['field_name'], $row['lang_value'], $row['group_name'], $row['group_id'], $row['option_id']);
		}
		$db->sql_freeresult($result);	

		return;
	}

	function group_cpf_batch_user_add($cpf_field_name, $cpf_lang_value, $group_name, $group_id, $option_id)
	{
		//We add batch add users to groups based on dropdown box type custom profile fields
		global $db, $user, $config, $phpbb_root_path, $phpEx;

		if (!function_exists('group_user_add'))
		{
			include($phpbb_root_path . 'includes/functions_user.'.$phpEx);
		}

		$sql = 'SELECT *
		FROM ' . PROFILE_FIELDS_DATA_TABLE;
		$result = $db->sql_query($sql);
		
		$user_id_ary = array();
		while ($row = $db->sql_fetchrow($result))
		{	
			if (isset($row['pf_' . $cpf_field_name]))
			{
				if ($row['pf_' . $cpf_field_name] == ($option_id + 1))
				{
					$user_id_ary[] = $row['user_id'];
				}
			}
		}
		$db->sql_freeresult($result);
	
		$sql = 'SELECT user_id
			FROM ' . USER_GROUP_TABLE . '
			WHERE group_id = ' . $group_id . '
			ORDER BY user_id ASC';
		$result = $db->sql_query($sql);

		$user_id_ary_all = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$user_id_ary_all[] = (int) $row['user_id'];
		}
		$db->sql_freeresult($result);
	
		// Do all the users exist in this group?
		$user_id_ary_add = array_diff($user_id_ary, $user_id_ary_all);
		$user_id_ary_del = array_diff($user_id_ary_all, $user_id_ary);
	
		$sql = 'SELECT group_id, group_type
			FROM ' . GROUPS_TABLE . '
			WHERE group_id = ' . $group_id . '
				AND group_type <> ' . GROUP_SPECIAL;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		
		$pending = false;
		if ($row)
		{			
			$pending = ($config['groups_to_cpf_no_pending']) ? (($row['group_type'] == GROUP_OPEN) ? true : false) : (($row['group_type'] != GROUP_FREE) ? true : false);
		}
		$group_default = false;

		if (!empty($user_id_ary_add))
		{
			group_user_add($group_id, $user_id_ary_add, false, $group_name, $group_default, 0, $pending, false);
		}
		if (!empty($user_id_ary_del))
		{
			group_user_del($group_id, $user_id_ary_del, false, $group_name);
		}
		return;	
	}
	
	function cpf_group_exist()
	{
		//Learn if there is custom profile fields based group exists
		global $db, $user;

		$group_exist = false;
		$sql = 'SELECT COUNT(group_id) AS num_groups
			FROM ' . PROFILE_FIELDS_LANG_TABLE . '
			WHERE group_id <> 0
				AND field_type = ' . FIELD_DROPDOWN;
		$result = $db->sql_query($sql);	
		$total_cpf_groups = (int) $db->sql_fetchfield('num_groups');
		$db->sql_freeresult($result);

		if ($total_cpf_groups)
		{
			$group_exist = true;
		}
			
		return $group_exist;
	}
	
	function group_members_count()
	{
		global $db;		
		
		//Count how many people are in which group
		$sql = 'SELECT group_id
			FROM ' . USER_GROUP_TABLE . '
			WHERE group_leader = 0';
		$result = $db->sql_query($sql);
		
		$group_members = array();
		while ($row = $db->sql_fetchrow($result))
		{
			if (!isset($group_members[$row['group_id']]))
			{
				$group_members[$row['group_id']] = 1;
			}
			else
			{
				$group_members[$row['group_id']]++;
			}
		}
		$db->sql_freeresult($result);
		
		return $group_members;
	}
	
	function validate_groups_cpfs($group_id_list, $group_name_list)
	{
		global $db; 
		
		//We update custom profil based groups, in case, group_id or group_name is changed
		$group_id_list_all = $group_name_list_all = array();
		$sql = 'SELECT group_name, group_id
			FROM ' . GROUPS_TABLE;
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{		
			$group_id_list_all[] = $row['group_id'];
			$group_name_list_all[] = $row['group_name'];
		}
		$db->sql_freeresult($result);		
				
		$group_id_diff =  array_diff($group_id_list, $group_id_list_all);
		$group_name_diff = 	array_diff($group_name_list, $group_name_list_all);
		
		if (sizeof($group_id_diff))
		{
			$sql_in = $group_id_diff;
			$sql_ary = array(
				'group_id'			=> 0,
				'group_name'		=> '',
			);
			$db->sql_query('UPDATE ' . PROFILE_FIELDS_LANG_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE ' . $db->sql_in_set('group_id', $sql_in));
		}
		else if (sizeof($group_name_diff))
		{
			$sql_in = $group_name_diff;
			$sql_ary = array(
				'group_id'			=> 0,
				'group_name'		=> '',
			);
			$db->sql_query('UPDATE ' . PROFILE_FIELDS_LANG_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE ' . $db->sql_in_set('group_name', $sql_in));
		}
		
		return;
	}
	
	function get_admin_mod_groups()
	{
		global $db; 
		
		//Obtain admin and moderator group list - because we don't want auto adding any user to moderator or administrator groups
		$admin_mod_roles = $admin_mod_option_ids = $admin_mod_groups = array();
		$admin_mod_ary = array("a_", "m_");

		$sql = 'SELECT role_id
			FROM ' . ACL_ROLES_TABLE . '
			WHERE ' . $db->sql_in_set('role_type', $admin_mod_ary);
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{		
			$admin_mod_roles[] = $row['role_id'];
		}
		$db->sql_freeresult($result);				

		$sql = 'SELECT auth_option_id, auth_option
			FROM ' . ACL_OPTIONS_TABLE;
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))		
		{	
			if (in_array(substr($row['auth_option'], 0, 2), array("a_", "m_")))
			{
				$admin_mod_option_ids[] = $row['auth_option_id'];
			}
		}
		$db->sql_freeresult($result);
			
		$sql = 'SELECT group_id, auth_option_id, auth_role_id
			FROM ' . ACL_GROUPS_TABLE;	
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))		
		{	
			if (in_array($row['auth_role_id'], $admin_mod_roles) || in_array($row['auth_option_id'], $admin_mod_option_ids))
			{
				$admin_mod_groups[] = $row['group_id'];
			}
		}
		$db->sql_freeresult($result);
		
		$admin_mod_groups = array_unique($admin_mod_groups);
		
		return $admin_mod_groups;
	}
}
?>