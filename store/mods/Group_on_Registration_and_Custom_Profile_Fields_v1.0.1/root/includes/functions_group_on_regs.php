<?php
/**
*
* @package phpBB3
* @author mtrs
* @version $Id: functions_group_on_reg.php 1.0.1 2009-11-21 16:53:36Z mtrs $
* @copyrigh(c) 2009 mtrs
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit();
}

function group_on_registration()
{
	//We obtain the list of groups, which are not special, for registration screen
	global $db, $user, $config, $template;
	$user->setup('mods/group_on_regs');

	$sql = 'SELECT group_id, group_name
		FROM ' . GROUPS_TABLE . '
		WHERE group_type <> ' . GROUP_SPECIAL . '
			AND display_on_registration = 1';
	$result = $db->sql_query($sql);

	$group_id = 0;
	$s_group_multi_options = '';
	$s_group_options = '<option value=""  selected="selected">--</option>';
		
	while ($row = $db->sql_fetchrow($result))
	{
		$group_id = $row['group_id'];
		$group_name = $row['group_name'];
		$s_group_options .= "<option value=\"$group_id\">$group_name</option>";
		$s_group_multi_options .= "<input id=\"$group_name\" type=\"checkbox\" name=\"reg_group_id[]\" value=\"$group_id\" /><label for=\"$group_name\">$group_name</label><br />";
	}
	$db->sql_freeresult($result);
	
	if (isset($group_id))
	{
		$template->assign_vars(array(
			'S_GROUP_OPTIONS'				=> $s_group_options,
			'S_GROUP_MULTIPLE_OPTIONS'		=> $s_group_multi_options,
			'S_GROUPS_ON_REGISTRATION'		=> ($config['groups_on_reg_enable'] && $group_id) ? true : false,
			'S_GROUPS_ON_REG_MULTIPLE'		=> ($config['groups_on_reg_multiple']) ? true : false,
			'GROUPS_REGISTRATION_EXP'		=> ($config['groups_on_reg_multiple']) ? $user->lang['GROUPS_MULTIPLE_ON_REGISTRATION'] : $user->lang['GROUPS_ONE_ON_REGISTRATION'],
			'S_GROUPS_REQUIRED'				=> ($config['groups_require']) ? true : false,
		));
	}
		
}

function reg_group_select($reg_group_id)
{
	global $db, $template, $config;

	//We save the selected group option, to return in case there is any error
	$s_group_options = (empty($reg_group_id)) ? '<option value=""  selected="selected">--</option>' : '<option value=""  >--</option>';
	
	$sql = 'SELECT group_id, group_name
		FROM ' . GROUPS_TABLE . '
		WHERE group_type <> ' . GROUP_SPECIAL . '
			AND display_on_registration = 1';
	$result = $db->sql_query($sql);

	$group_id = 0;
	$selected = 'selected="selected"';
	$s_group_multi_options = '';
		
	while ($row = $db->sql_fetchrow($result))
	{
		$group_id = $row['group_id'];
		$group_name = $row['group_name'];

		$s_group_options .= ($group_id == $reg_group_id) ? "<option value=\"$group_id\" $selected>$group_name</option>" : "<option value=\"$group_id\">$group_name</option>";
		if ($config['groups_on_reg_multiple'])
		{
			$checked = (in_array($group_id, $reg_group_id)) ? "checked = \"checked\"" : '';
			$s_group_multi_options .= "<input id=\"$group_name\" type=\"checkbox\"$checked name=\"reg_group_id[]\" value=\"$group_id\" /><label for=\"$group_name\">$group_name</label><br />";	
		}
	}
	$db->sql_freeresult($result);
		
	$template->assign_vars(array(
		'S_GROUP_OPTIONS'				=> $s_group_options,
		'S_GROUP_MULTIPLE_OPTIONS'		=> $s_group_multi_options,
		'S_GROUPS_ON_REGISTRATION'		=> ($config['groups_on_reg_enable'] && $group_id) ? true : false,
	));
	
	return ($config['groups_on_reg_multiple']) ? $s_group_multi_options : $s_group_options;
}

function group_add_registration($user_id, $reg_group_id)
{
	//At the end, we add user to a group and update default group settings
	global $db, $user, $config;
	$user->add_lang('mods/group_on_regs');
	
	//Begin: Select Group on Registration	
	if (isset($reg_group_id))
	{
		$sql = 'SELECT group_id
			FROM ' . GROUPS_TABLE . '
			WHERE group_id = ' . $reg_group_id . '
				AND group_type = ' . GROUP_FREE;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		
		$pending = 1;
		if ($row)
		{
			$pending = 0;
		}
	
		//We add user to a new group selected on registration
		$sql = 'INSERT INTO ' . USER_GROUP_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'user_id'		=> (int) $user_id,
			'group_id'		=> (int) $reg_group_id,
			'user_pending'	=> $pending)
		);
		$db->sql_query($sql);

		//Set group if enabled
		if ($config['groups_default'] && !$config['groups_on_reg_multiple'] && !$pending)
		{
			group_set_user_default($reg_group_id, array($user_id), false);
			
			// set the newest user colour to default group colour
			$sql = 'SELECT user_colour
				FROM ' . USERS_TABLE . '
				WHERE user_id = ' . (int) $user_id . '
					AND user_type = ' . USER_NORMAL;
			$result = $db->sql_query_limit($sql, 1);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
			
			if ($row['user_colour'])
			{
				set_config('newest_user_colour', $row['user_colour'], true);
			}
		}
	}
}

//Add or delete users to/from groups based on custom profile fields - on registration only add user to gruop if correct option is selected
function group_add_delete_user_cpf($user_id)
{
	global $db, $user, $config, $phpbb_root_path, $phpEx;

	if (!function_exists('group_user_add'))
	{
		include($phpbb_root_path . 'includes/functions_user.'.$phpEx);
	}
	$user_id_ary = array($user_id);
	$group_default = false;
	
	$sql_where = ($config['groups_to_cpf_no_pending']) ? 'WHERE group_type IN (' . GROUP_FREE . ', ' . GROUP_CLOSED . ', ' . GROUP_HIDDEN . ')' : 'WHERE group_type = ' . GROUP_FREE;

	$sql = 'SELECT group_id
		FROM ' . GROUPS_TABLE . '
		' . $sql_where;
	$result = $db->sql_query($sql);

	$groups_free = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$groups_free[] = $row['group_id'];
	}
	$db->sql_freeresult($result);
	
	$user->get_profile_fields($user_id);
	$user_fields = $user->profile_fields;
	
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
		if (isset($user_fields['pf_' . $row['field_name']]))
		{
			if ($user_fields['pf_' . $row['field_name']] == ($row['option_id'] + 1))
			{
				$pending = (in_array($row['group_id'], $groups_free)) ? 0 : 1;
				group_user_add($row['group_id'], $user_id_ary, false, $row['group_name'], $group_default, 0, $pending, false);
			}
			else if (request_var('mode', '') != 'register')
			{
				group_user_del($row['group_id'], $user_id_ary, false, $row['group_name']);
			}
		}
	}
	$db->sql_freeresult($result);	
	
	return;
}

function validate_reg_group_id($num, $optional = false, $min = 0, $max = 1E99)
{
	global $user, $config;
	$user->setup('mods/group_on_regs');
	
	if (empty($num) && $optional)
	{
		return false;
	}
	if ($config['groups_on_reg_multiple'] && empty($num))
	{
		return $user->lang['SHOULD_SELECT_GROUPS'];
	}		
	else if ($num < $min && !$config['groups_on_reg_multiple'])
	{
		return $user->lang['SHOULD_SELECT_GROUP'];
	}

	return false;
}
?>