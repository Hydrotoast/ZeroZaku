<?php
/**
*
* @package phpBB3
* @version $Id functions_inactive_users.php 0.4.0 2009-04-13 23:29:18GMT mtrs $
* @version $Id$
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


function get_banned_user_list()
{
	//We obtain banned user_id list to use in viewtopic
	global $db, $user, $phpbb_root_path, $phpEx;
	$user->add_lang('mods/inactive_users');

	$sql = 'SELECT ban_userid, ban_end
		FROM ' . BANLIST_TABLE . '
		WHERE (ban_end > ' . time() . ' OR ban_end = 0)
			AND ban_exclude <> 1'; 
	$result = $db->sql_query($sql, 3600);
	//To disable 3600 seconds cache, comment the line above and uncomment the line below
	//$result = $db->sql_query($sql);
	
	$banned_users[] = '';
	while ($row = $db->sql_fetchrow($result))
	{
		$banned_users[$row['ban_userid']] = $row['ban_end'];
	}	
	$db->sql_freeresult($result);
	
	return $banned_users;
	
}


//viewtopic template variables
function banned_user_templates($poster_id, $banned_user_list, $lastvisit, $avatar, $user_posts, $user_type)
{
	global $config, $user, $template, $phpbb_root_path;

	$current_time = time();
	$inactive_data = array();
	$avatar_width = $avatar_height = 100;
	
	$user->add_lang('mods/inactive_users');
	if ($config['inactive_users_no_avatar'] && !$avatar)
	{
		//We assing two default avatars first: 25 posts is the thereshold
		if ($user_posts < 25)
		{
			$avatar_img = $phpbb_root_path . 'images/avatars/not_selected_new.gif';
		}
		else
		{
			$avatar_img = $phpbb_root_path . 'images/avatars/not_selected.gif';
		}
		
		$inactive_data = array(
				'POSTER_AVATAR'		=> '<img src="' . $avatar_img . '" width="' . $avatar_width . '" height="' . $avatar_height . '" alt="' . $user->lang['USER_AVATAR'] . '" />',
		);	
	}
	
	if (isset($banned_user_list[$poster_id]) && $config['inactive_users_excl_view_ban'])
	{
		//We controll if there is any banned user
		if ($banned_user_list[$poster_id] == 0)
		{
			$avatar_img = $phpbb_root_path . 'images/avatars/banned.gif';
			$inactive_data  = array(
				'RANK_TITLE'		=> $user->lang['USER_BANNED'],
				'RANK_IMG'			=> '',
				'RANK_IMG_SRC'		=> '',
				'POSTER_AVATAR'		=> ($config['inactive_users_avatar_view_enable']) ? '<img src="' . $avatar_img . '" width="' . $avatar_width . '" height="' . $avatar_height . '" alt="' . $user->lang['USER_AVATAR'] . '" />' : $avatar,
				'SIGNATURE'			=> '',
			);		
		}
		//We controll if there is any suspended (tempoararily) banned user
		else if ($banned_user_list[$poster_id] > $current_time)
		{
			$avatar_img = $phpbb_root_path . 'images/avatars/suspended.gif';
			$inactive_data  = array(
				'RANK_TITLE'		=> sprintf($user->lang['USER_SUSPENDED'], $user->format_date($banned_user_list[$poster_id], $format = 'd-m, H:i', true)),
				'RANK_IMG'			=> '',
				'RANK_IMG_SRC'		=> '',
				'POSTER_AVATAR'		=> ($config['inactive_users_avatar_view_enable']) ? '<img src="' . $avatar_img . '" width="' . $avatar_width . '" height="' . $avatar_height . '" alt="' . $user->lang['USER_AVATAR'] . '" />' : $avatar,
				'SIGNATURE'			=> '',
			);	
		}
	}
	else if ($user_type == USER_INACTIVE)
	{
		//We also assign deactivated users a custom avatar
		$avatar_img = $phpbb_root_path . 'images/avatars/deactivated.gif';
		$inactive_data  = array(
			'RANK_TITLE'		=> $user->lang['USER_DEACTIVE'],
			'RANK_IMG'			=> '',
			'RANK_IMG_SRC'		=> '',
			'POSTER_AVATAR'		=> ($config['inactive_users_avatar_view_enable']) ? '<img src="' . $avatar_img . '" width="' . $avatar_width . '" height="' . $avatar_height . '" alt="' . $user->lang['USER_AVATAR'] . '" />' : $avatar,
			'SIGNATURE'			=> '',
		);	
	}
	else if ($config['inactive_users_excl_view_time'] && $lastvisit != 0 && (($current_time - $lastvisit) > ($config['inactive_users_period'] * 2592000)))
	{	
		//At the end controll the user inactive period and change the rank title if user didn't visit for a long time
		$avatar_img = $phpbb_root_path . 'images/avatars/inactive.gif';
		$inactive_data  = array(
			'RANK_TITLE'		=> sprintf($user->lang['USER_INACTIVE'], round(($current_time - $lastvisit)/2592000)),
			'RANK_IMG'			=> '',
			'RANK_IMG_SRC'		=> '',			
			'POSTER_AVATAR'		=> ($config['inactive_users_avatar_view_enable']) ? '<img src="' . $avatar_img . '" width="' . $avatar_width . '" height="' . $avatar_height . '" alt="' . $user->lang['USER_AVATAR'] . '" />' : $avatar,
			'SIGNATURE'			=> '',
		);
	}

	return $inactive_data;

}

//memberlist.php custom avatar and titles function
function obtain_user_ban_info($user_id, $lastvisit, $user_posts, $user_type, $poster_avatar)
{
	global $db, $user, $config, $template, $phpbb_root_path;
	$user->add_lang('mods/inactive_users');
	$current_time = time();
	$inactive_data = array();
	//We obtain the excluded user_id list to exempt them from this mod
	$excluded_user_ids = array(); 
	$excluded_user_ids = ($config['inactive_users_exc_ids']) ? explode(",", $config['inactive_users_exc_ids']) : array();
	$avatar_img = $phpbb_root_path . 'images/avatars/';
	$avatar_width = $avatar_height = 100;
	$banned_users[] = '';
	if (in_array($user_id, $excluded_user_ids))
	{
		return false;
	}
	else if ($config['inactive_users_excl_prof_ban'])
	{
		//Run the sql to see if the is banned
		$sql = 'SELECT ban_userid, ban_end
			FROM ' . BANLIST_TABLE . '
			WHERE (ban_end > ' . time() . ' OR ban_end = 0)
				AND ban_userid = ' . $user_id . '';
			
		$result = $db->sql_query($sql);
	
		$banned_users[] = '';
		if ($row = $db->sql_fetchrow($result))
		{
			$banned_users[$row['ban_userid']] = $row['ban_end'];
		}
		$db->sql_freeresult($result);
	}
	
	if ($config['inactive_users_no_avatar'] && !$poster_avatar)
	{
		//We assing two default avatars first: 25 posts is the thereshold
		if ($user_posts < 25)
		{
			$avatar_img = $phpbb_root_path . 'images/avatars/not_selected_new.gif';
		}
		else
		{
			$avatar_img = $phpbb_root_path . 'images/avatars/not_selected.gif';
		}
		$inactive_data = array(
				'AVATAR_IMG'		=> '<img src="' . $avatar_img . '" width="' . $avatar_width . '" height="' . $avatar_height . '" alt="' . $user->lang['USER_AVATAR'] . '" />',
		);		
	}	

	if (isset($banned_users[$user_id]) && $config['inactive_users_excl_prof_ban'])
	{
		if ($banned_users[$user_id] == 0)
		{
			$avatar_img = $phpbb_root_path . 'images/avatars/banned.gif';
			$inactive_data  = array(
				'RANK_TITLE'		=> $user->lang['USER_BANNED'],
				'RANK_IMG'			=> '',
				'RANK_IMG_SRC'		=> '',
				'AVATAR_IMG'		=> ($config['inactive_users_avatar_prof_enable']) ? '<img src="' . $avatar_img . '" width="' . $avatar_width . '" height="' . $avatar_height . '" alt="' . $user->lang['USER_AVATAR'] . '" />' : $poster_avatar,				
			);
		}
		else if ($banned_users[$user_id] > time())
		{
			$avatar_img = $phpbb_root_path . 'images/avatars/suspended.gif';
			$inactive_data  = array(
				'RANK_TITLE'		=> sprintf($user->lang['USER_SUSPENDED'], $user->format_date($banned_users[$user_id], $format = 'd-m, H:i', true)),// $rank_title,
				'RANK_IMG'			=>'',
				'RANK_IMG_SRC'		=> '',
				'AVATAR_IMG'		=> ($config['inactive_users_avatar_prof_enable']) ? '<img src="' . $avatar_img . '" width="' . $avatar_width . '" height="' . $avatar_height . '" alt="' . $user->lang['USER_AVATAR'] . '" />' : $poster_avatar,
			);
		}
	}
	else if ($user_type == USER_INACTIVE)
	{
		$avatar_img = $phpbb_root_path . 'images/avatars/deactivated.gif';
		$inactive_data  = array(
			'RANK_TITLE'		=> $user->lang['USER_DEACTIVE'],
			'RANK_IMG'			=> '',
			'RANK_IMG_SRC'		=> '',
			'AVATAR_IMG'		=> ($config['inactive_users_avatar_prof_enable']) ? '<img src="' . $avatar_img . '" width="' . $avatar_width . '" height="' . $avatar_height . '" alt="' . $user->lang['USER_AVATAR'] . '" />' : $poster_avatar,
			'SIGNATURE'			=> '',
		);	
			
	}
	else if ($config['inactive_users_excl_prof_time'] && $lastvisit != 0 && ($current_time - $lastvisit) > ($config['inactive_users_period'] * 2592000))
	{
		$avatar_img = $phpbb_root_path . 'images/avatars/inactive.gif';
		$inactive_data  = array(
			'RANK_TITLE'	=> sprintf($user->lang['USER_INACTIVE'], round(($current_time - $lastvisit)/2592000)),
			'RANK_IMG'			=>'',
			'RANK_IMG_SRC'		=> '',
			'AVATAR_IMG'	=> (!$config['inactive_users_avatar_prof_enable']) ? $poster_avatar : '<img src="' . $avatar_img . '" width="' . $avatar_width . '" height="' . $avatar_height . '" alt="' . $user->lang['USER_AVATAR'] . '" />',
		);
	}

	return $inactive_data;

}

?>