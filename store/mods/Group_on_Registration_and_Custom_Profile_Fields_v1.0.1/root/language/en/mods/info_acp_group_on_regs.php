<?php
/**
*
*  [English]
*
* @package language
* @version $Id:  info_acp_group_on_reg.php, v1.0.1 2009/11/21 15:35:00 mtrs Exp $
* @copyright (c) 2009 mtrs
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//



$lang = array_merge($lang, array(
	'ACP_GROUPS_REGS'						=> 'Groups on registration',
	'ACP_GROUPS_REGS_EXPLAIN'				=> 'You can define groups, which are not special and admin-mod groups to be displayed on registration. Displayed groups can be can be set default, and required to select on registration.',
	'ADD_GROUP'								=> 'Add group',
	'ADD_CPF_GROUP'							=> 'Add cpf based group',
	
	'CPF_AUTO_GROUP'						=> 'Resynchronise custom profile fields based groups',
	'CPF_AUTO_GROUP_EXPLAIN'				=> 'Batch adds/removes users to custom profile fields based groups based on user data.',
	'CPF_ADD_GROUP_LIST_CHANGED'			=> 'Custom profile fields based groups synchronised',

	'CPF_LANG_VALUE'						=> 'Option lang value',	
	'CPF_FIELD_NAME'						=> 'Custom profile field name',
	'CPF_TO_GROUPS'							=> 'Groups based on custom profile fields',
	'CPF_TO_GROUPS_EXPLAIN'					=> 'You can define groups to add users depending on custom profile fields on registration and user control panel. Also, you can batch add users to groups based on custom profile fields. Please note that, editing a custom profile field can reset group options.',
	
	'ENTER_GROUP_ID_NAME'					=> 'You should select a valid group ID or group name',

	'GROUPS_ON_REGISTRATION'				=> 'Groups',
	'GROUPS_ON_REGISTRATION_EXPLAIN'		=> 'Select one of the groups to join.',	
	'GROUPS_ENABLED'						=> 'Enable display groups on registration',
	'GROUPS_ENABLED_EXPLAIN'				=> 'Enabling displays groups on registration to join one of them.',
	'GROUPS_REQUIRE'						=> 'Require group selection on registration',
	'GROUPS_REQUIRE_EXPLAIN'				=> 'Users will have to select at least one of the listed groups.',
	'GROUPS_MULTIPLE_REGISTRATION'			=> 'Enable joining multiple groups on registration',
	'GROUPS_MULTIPLE_REGISTRATION_EXPLAIN'	=> 'Enabling permits users joining more than one group on registration. If this option enabled,<br /> groups on registration cannot be default.',
	'GROUPS_DEFAULT'						=> 'Make selected group on registration default',
	'GROUPS_DEFAULT_EXPLAIN'				=> 'Make the group default.',	
	'GROUPS_TO_CPF_ENABLE'					=> 'Enable custom profile fields based groups',
	'GROUPS_TO_CPF_ENABLE_EXPLAIN'			=> 'Enabling makes auto-groups based on user custom profile fields data entered on registration,<br />	UCP user profile and ACP user profile.',
	'GROUPS_TO_CPF_NO_PENDING'				=> 'Add users to hidden or closed groups without pending',
	'GROUPS_TO_CPF_NO_PENDING_EXPLAIN'		=> 'Enabling makes custom profile field based group adding automatic, for hidden and closed groups.',
	'GROUPS_FIELD_NAME'						=> 'Custom profile field name',
	'GROUPS_FIELD_NAME_EXPLAIN'				=> 'Select a custom profile field name. Only dropdown box type is shown.',	
	'GROUPS_LANG_VALUE'						=> 'Custom profile fields language value',
	'GROUPS_LANG_VALUE_EXPLAIN'				=> 'If this option is selected on registration, then user will be automatically added to group above. Ex. Female',
	'GROUPS_CPF_NAME'						=> 'Custom profile fields option value',
	'GROUPS_CPF_NAME_EXPLAIN'				=> 'Select a custom profile field option to add users to the group above.',
	'GROUP_NAME'							=> 'Group name',
	'GROUP_NAME_EXPLAIN'					=> 'Please select a group name that will displayed on registration.',
	'GROUP_NAME_ID'							=> 'Group',
	'GROUP_NAME_ID_EXPLAIN'					=> 'Select a group that will be displayed on registration.',
	'GROUP_MEMBERS'							=> 'Members',	
	'GROUP_ID'								=> 'Group ID',
	'GROUP_DEFAULT'							=> 'Default',
	'GROUP_ADDED'							=> 'Group has been successfully added display on registration list.',
	'GROUP_CPF_ADDED'						=> 'Custom profile field based group table updated',
	'GROUP_REMOVED'							=> 'The selected group ID has been successfully removed.',
	'CPF_GROUP_REMOVED'						=> 'Custom profile based group removed',

	'LOG_GROUPS_REG_DELETE'					=> '<strong>Group ID %s removed from display on registration groups list</strong>',
	'LOG_GROUPS_REG_ADD'					=> '<strong>Group ID %s added to display on registration groups list</strong>',
	'LOG_GROUPS_CPF_DELETE'					=> '<strong>Custom profile fields based groups updated</strong>',
	'LOG_GROUPS_CPF_ADD'					=> '<strong>Group ID %s added to custom profile fields based groups</strong>',
	'LOG_CONFIG_GROUPS_REG_UPDATED'			=> '<strong>Groups on registrations config updated</strong>',
	'LOG_CPF_GROUPS_SYNCHRONISED'			=> '<strong>Custom profile fields based groups synchronised</strong>',

	'NO_GROUP'								=> 'Group ID is not present',
	'NO_GROUP_TO_ADD'						=> 'There is no group to add, please create a new group first',
	'NO_CPF_TO_ADD'							=> 'There is no dropdown box custom profile options or all of them assigned to a group. <br />Please create a new dropdown box type custom profile field or add options to present ones.',
	'NO_CPF_GROUP_SELECTED'					=> 'Please select a group and custom profile field name and option value',
	'NO_CPF_GROUP_EXIST'					=> 'There is no group in custom profile fields groups list. Please add a group before synchronising.',
	'NO_VALUE_CHANGED'						=> 'You didn’t change any value to submit',	

	'REMOVE'								=> 'Remove',
	'REMOVE_GROUP'							=> 'Remove from group display list on registration',

));


?>