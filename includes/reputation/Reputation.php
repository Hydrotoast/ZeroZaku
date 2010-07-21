<?php
/** 
*
* @package Reputation
* @copyright (c) 2009 Gio Borje
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if(!defined('IN_PHPBB'))
{
	exit;
}

// Table name
if (isset($table_prefix))
{
	define('REP_TABLE', $table_prefix . 'rep');
}

class reputation 
{
	// Config vars
	var $config		= array();
	
	// Auth vars
	var $can_rep	= false;
	var $user_level = false;
	
	// Time
	var $current_time 	= false;
	
	function reputation()
	{
		global $config, $user, $auth;
		
		// Load the language
		$user->add_lang('reputation');
		
		// Move configs to internal array, for less globals in functions
		$this->version						= $config['rep_version'];
		$this->config['enabled']			= ($config['rep_enabled']) ? true : false;
		$this->config['enabled_ucp']		= ($config['rep_enabled_ucp']) ? true : false;
		$this->config['comments']			= ($config['rep_comments']) ? true : false;
		$this->config['comments_reqd']		= ($config['rep_comments_reqd']) ? true : false;
		$this->config['notify_email']		= ($config['email_enable'] && $config['rep_notify_email']) ? true : false;
		$this->config['notify_pm']			= ($config['allow_privmsg'] && $config['rep_notify_pm']) ? true : false;
		$this->config['notify_jabber']		= ($config['jab_enable'] && $config['rep_notify_jabber']) ? true : false;
		$this->config['drafts']				= ($config['rep_drafts']) ? true : false;
		$this->config['icons']				= ($config['rep_icons']) ? true : false;
		$this->config['viewprofile']		= ($config['rep_viewprofile']) ? true : false;
		$this->config['toplist']			= ($config['rep_toplist']) ? true : false;
		$this->config['toplist_users']		= (int) ($user->data['is_registered']) ? $user->data['user_rep_toplist_users'] : $config['rep_toplist_users'];
		$this->config['time']				= (float) $config['rep_time'];
		$this->config['posts']				= (int)	$config['rep_posts'];
		$this->config['comments_per_page']	= (int) $config['rep_comments_per_page'];
		$this->config['power']				= ($config['rep_power']) ? true : false;
		$this->config['power_show']			= ($config['rep_power_show']) ? true : false;
		$this->config['power_max']			= (int) ($config['rep_power_max'] < 1) ? 5 : $config['rep_power_max'];
		$this->config['per_day']			= ($config['rep_per_day'] > 0) ? (int) $config['rep_per_day'] : false;
		$this->config['zebra']				= ($config['rep_zebra']) ? true : false;
		$this->config['anonym_increase']				= ($config['rep_anonym_increase']) ? true : false;
		$this->config['anonym_decrease']				= ($config['rep_anonym_decrease']) ? true : false;
		$this->config['minimum']			= (int) $config['rep_minimum'];

		// Configure user settings
		$this->user_level = ($auth->acl_get('a_')) ? 'admin' : (($user->data['is_registered']) ? 'user' : 'guest');
		if ($this->user_level != 'guest')
		{
			$this->config['user_enabled']		= ($this->config['enabled_ucp'] && !$user->data['user_rep_enable']) ? false : true;
			$this->config['user_notify_email']	= ($this->config['notify_email'] && $user->data['user_rep_notify_email']) ? true : false;
			$this->config['user_notify_pm']		= ($this->config['notify_pm'] && $user->data['user_rep_notify_pm']) ? true : false;
			$this->config['user_notify_jabber']	= ($this->config['notify_jabber'] && $user->data['user_rep_notify_jabber']) ? true : false;
			$this->config['toplist']			= ($this->config['toplist'] && $user->data['user_rep_toplist']) ? true : false;
			$this->config['comments_per_page']	= (int) $user->data['user_rep_comments_per_page'];
			$this->config['comments_self']		= (isset($user->data['user_rep_comments_self']) && $user->data['user_rep_comments_self']) ? true : false;
		}
		else
		{
			$this->config['user_enabled']		= true;
			$this->config['user_notify_email']	= false;
			$this->config['user_notify_pm']		= false;
			$this->config['user_notify_jabber']	= false;
		}
	}
	
	
	
	
}
?>