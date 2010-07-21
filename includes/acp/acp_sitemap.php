<?php
/**
*
* @package acp
* @version $Id: acp_sitemap.php,v 1.0.6 2010-01-14 14:55:02 FladeX Exp $
* @copyright (c) 2009 FladeX
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
class acp_sitemap
{
	var $u_action;
	function main($id, $mode)
	{
		global $db, $user, $auth, $template;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$action = request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		if ($mode != 'index')
		{
			return;
		}

		$this->tpl_name = 'acp_sitemap';
		$this->page_title = 'ACP_SITEMAP_SETTINGS';

		$sitemap_enable = request_var('sitemap_enable', $config['sitemap_enable']);
		$sitemap_priority_0 = request_var('sitemap_priority_0', $config['sitemap_priority_0']);
		$sitemap_priority_1 = request_var('sitemap_priority_1', $config['sitemap_priority_1']);
		$sitemap_priority_2 = request_var('sitemap_priority_2', $config['sitemap_priority_2']);
		$sitemap_priority_3 = request_var('sitemap_priority_3', $config['sitemap_priority_3']);
		$sitemap_freq_0 = request_var('sitemap_freq_0', $config['sitemap_freq_0']);
		$sitemap_freq_1 = request_var('sitemap_freq_1', $config['sitemap_freq_1']);
		$sitemap_freq_2 = request_var('sitemap_freq_2', $config['sitemap_freq_2']);
		$sitemap_freq_3 = request_var('sitemap_freq_3', $config['sitemap_freq_3']);
		$sitemap_cache_time = request_var('sitemap_cache_time', $config['sitemap_cache_time']);

		$form_name = 'acp_sitemap';
		add_form_key($form_name);

		if ($submit)
		{
			if (!check_form_key($form_name))
			{
				trigger_error($user->lang['FORM_INVALID']. adm_back_link($this->u_action), E_USER_WARNING);
			}

			$error = array();

			$message = $user->lang['SITEMAP_SETTINGS_CHANGED'];
			$log = 'SITEMAP_SETTINGS_CHANGED';

			set_config('sitemap_enable', $sitemap_enable);
			set_config('sitemap_priority_0', $sitemap_priority_0);
			set_config('sitemap_priority_1', $sitemap_priority_1);
			set_config('sitemap_priority_2', $sitemap_priority_2);
			set_config('sitemap_priority_3', $sitemap_priority_3);
			set_config('sitemap_freq_0', $sitemap_freq_0);
			set_config('sitemap_freq_1', $sitemap_freq_1);
			set_config('sitemap_freq_2', $sitemap_freq_2);
			set_config('sitemap_freq_3', $sitemap_freq_3);
			set_config('sitemap_cache_time', $sitemap_cache_time);

			add_log('admin', 'LOG_' . $log);
			trigger_error($message . adm_back_link($this->u_action));
		}

		$sitemap_freq_list_0 = '<option value="never"' . (($sitemap_freq_0 == "never") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_NEVER'] . '</option>';
		$sitemap_freq_list_0 .= '<option value="yearly"' . (($sitemap_freq_0 == "yearly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_YEARLY'] . '</option>';
		$sitemap_freq_list_0 .= '<option value="monthly"' . (($sitemap_freq_0 == "monthly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_MONTHLY'] . '</option>';
		$sitemap_freq_list_0 .= '<option value="weekly"' . (($sitemap_freq_0 == "weekly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_WEEKLY'] . '</option>';
		$sitemap_freq_list_0 .= '<option value="daily"' . (($sitemap_freq_0 == "daily") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_DAILY'] . '</option>';
		$sitemap_freq_list_0 .= '<option value="hourly"' . (($sitemap_freq_0 == "hourly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_HOURLY'] . '</option>';
		$sitemap_freq_list_0 .= '<option value="always"' . (($sitemap_freq_0 == "always") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_ALWAYS'] . '</option>';

		$sitemap_freq_list_1 = '<option value="never"' . (($sitemap_freq_1 == "never") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_NEVER'] . '</option>';
		$sitemap_freq_list_1 .= '<option value="yearly"' . (($sitemap_freq_1 == "yearly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_YEARLY'] . '</option>';
		$sitemap_freq_list_1 .= '<option value="monthly"' . (($sitemap_freq_1 == "monthly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_MONTHLY'] . '</option>';
		$sitemap_freq_list_1 .= '<option value="weekly"' . (($sitemap_freq_1 == "weekly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_WEEKLY'] . '</option>';
		$sitemap_freq_list_1 .= '<option value="daily"' . (($sitemap_freq_1 == "daily") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_DAILY'] . '</option>';
		$sitemap_freq_list_1 .= '<option value="hourly"' . (($sitemap_freq_1 == "hourly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_HOURLY'] . '</option>';
		$sitemap_freq_list_1 .= '<option value="always"' . (($sitemap_freq_1 == "always") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_ALWAYS'] . '</option>';

		$sitemap_freq_list_2 = '<option value="never"' . (($sitemap_freq_2 == "never") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_NEVER'] . '</option>';
		$sitemap_freq_list_2 .= '<option value="yearly"' . (($sitemap_freq_2 == "yearly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_YEARLY'] . '</option>';
		$sitemap_freq_list_2 .= '<option value="monthly"' . (($sitemap_freq_2 == "monthly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_MONTHLY'] . '</option>';
		$sitemap_freq_list_2 .= '<option value="weekly"' . (($sitemap_freq_2 == "weekly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_WEEKLY'] . '</option>';
		$sitemap_freq_list_2 .= '<option value="daily"' . (($sitemap_freq_2 == "daily") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_DAILY'] . '</option>';
		$sitemap_freq_list_2 .= '<option value="hourly"' . (($sitemap_freq_2 == "hourly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_HOURLY'] . '</option>';
		$sitemap_freq_list_2 .= '<option value="always"' . (($sitemap_freq_2 == "always") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_ALWAYS'] . '</option>';

		$sitemap_freq_list_3 = '<option value="never"' . (($sitemap_freq_3 == "never") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_NEVER'] . '</option>';
		$sitemap_freq_list_3 .= '<option value="yearly"' . (($sitemap_freq_3 == "yearly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_YEARLY'] . '</option>';
		$sitemap_freq_list_3 .= '<option value="monthly"' . (($sitemap_freq_3 == "monthly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_MONTHLY'] . '</option>';
		$sitemap_freq_list_3 .= '<option value="weekly"' . (($sitemap_freq_3 == "weekly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_WEEKLY'] . '</option>';
		$sitemap_freq_list_3 .= '<option value="daily"' . (($sitemap_freq_3 == "daily") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_DAILY'] . '</option>';
		$sitemap_freq_list_3 .= '<option value="hourly"' . (($sitemap_freq_3 == "hourly") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_HOURLY'] . '</option>';
		$sitemap_freq_list_3 .= '<option value="always"' . (($sitemap_freq_3 == "always") ? ' selected="selected"' : '') . '>' . $user->lang['SITEMAP_FREQ_ALWAYS'] . '</option>';

		$template->assign_vars(array(
			'U_ACTION'				=> $this->u_action,
			'SITEMAP_ENABLE'		=> $sitemap_enable,
			'SITEMAP_PRIORITY_0'	=> $sitemap_priority_0,
			'SITEMAP_PRIORITY_1'	=> $sitemap_priority_1,
			'SITEMAP_PRIORITY_2'	=> $sitemap_priority_2,
			'SITEMAP_PRIORITY_3'	=> $sitemap_priority_3,
			'SITEMAP_FREQ_0'		=> $sitemap_freq_0,
			'SITEMAP_FREQ_1'		=> $sitemap_freq_1,
			'SITEMAP_FREQ_2'		=> $sitemap_freq_2,
			'SITEMAP_FREQ_3'		=> $sitemap_freq_3,
			'SITEMAP_FREQ_LIST_0'	=> $sitemap_freq_list_0,
			'SITEMAP_FREQ_LIST_1'	=> $sitemap_freq_list_1,
			'SITEMAP_FREQ_LIST_2'	=> $sitemap_freq_list_2,
			'SITEMAP_FREQ_LIST_3'	=> $sitemap_freq_list_3,
			'SITEMAP_CACHE_TIME'	=> $sitemap_cache_time,
		));

	}
}

?>