<?php
/**
*
* @package acp
* @copyright (c) 2010 Mav
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
* @package acp
*/
class acp_community_moderation
{
	var $u_action;
	function main($id, $mode)
	{
		global $db, $user, $auth, $template;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		include ($phpbb_root_path . 'includes/functions_community_moderation.' . $phpEx);

		$community_moderation	= new community_moderation();
		$action = request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		if ($mode != 'configuration')
		{
			return;
		}

		$this->tpl_name = 'acp_community_moderation';
		$this->page_title = 'ACP_COM_MOD_SETTINGS';

		$enable_community_moderation = request_var('enable_community_moderation', $config['enable_community_moderation']);
		$posts_bury_threshold = request_var('posts_bury_threshold', $config['posts_bury_threshold']);
		$enable_community_moderation_ups = request_var('enable_community_moderation_ups', $config['enable_community_moderation_ups']);
		$community_moderation_ups_up = request_var('community_moderation_ups_up', $config['community_moderation_ups_up']);
		$community_moderation_ups_down = request_var('community_moderation_ups_down', $config['community_moderation_ups_down']);

		$form_name = 'acp_community_moderation';
		add_form_key($form_name);

		if ($submit)
		{
			if (!check_form_key($form_name))
			{
				trigger_error($user->lang['FORM_INVALID']. adm_back_link($this->u_action), E_USER_WARNING);
			}

			$error = array();

			$message = $user->lang['COM_MOD_SETTINGS_CHANGED'];
			$log = 'COM_MOD_SETTINGS_CHANGED';

			set_config('enable_community_moderation', $enable_community_moderation);
			set_config('posts_bury_threshold', $posts_bury_threshold);
			set_config('enable_community_moderation_ups', $enable_community_moderation_ups);
			set_config('community_moderation_ups_up', $community_moderation_ups_up);
			set_config('community_moderation_ups_down', $community_moderation_ups_down);

			add_log('admin', 'LOG_' . $log);
			trigger_error($message . adm_back_link($this->u_action));
		}

		$template->assign_vars(array(
			'U_ACTION'							=> $this->u_action,

			'S_MOD_ENABLE'						=> $enable_community_moderation,
			'S_POSTS_BURY_THRESHOLD'			=> $posts_bury_threshold,
			'S_ENABLE_ULTIMATE_POINTS'			=> $enable_community_moderation_ups,
			'S_ULTIMATE_POINTS_UPVOTE'			=> $community_moderation_ups_up,
			'S_ULTIMATE_POINTS_DOWNVOTE'		=> $community_moderation_ups_down,
		));

		if ($community_moderation->ultimate_points_installed())
		{
			$template->assign_vars(array(
				'S_ULTIMATE_POINTS_INSTALLED' 	=> true,
			));
		}
	}
}

?>