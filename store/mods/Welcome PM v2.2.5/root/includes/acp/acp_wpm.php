<?php
/** 
*
* @package acp
* @version $Id: $
* @copyright (c) 2007 DualFusion - 2008 ..::Frans::..
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
*/
class acp_wpm
{
	var $u_action, $wpm;

	function main($id, $mode)
	{
		global $db, $user, $template, $cache;
		global $config, $phpbb_root_path, $phpEx;

		$user->add_lang('posting');
		$user->add_lang('mods/info_acp_wpm');

		include ($phpbb_root_path . 'includes/functions_user.' . $phpEx);
		include ($phpbb_root_path . 'includes/functions_display.' . $phpEx);
		include ($phpbb_root_path . 'includes/functions_wpm.' . $phpEx);
		include ($phpbb_root_path . 'includes/message_parser.' . $phpEx);

		$wpm = new welcome_pm();

		// Set up general vars
		$this->page_title	= 'ACP_WELCOME_PM';
		$this->tpl_name		= 'acp_wpm';

		$submit		= (isset($_POST['submit']))  ? true : false;
		$preview	= (isset($_POST['preview'])) ? true : false;
		
		$wpm_data = array();
		foreach ($wpm->data as $k => $v)
		{
			$wpm_data[$k] = utf8_normalize_nfc(request_var($k, $v, true));
		}

		if ($submit == true)
		{
			$username	= request_var('username', '');
			$error		= array();

			if ($username != '')
			{
				user_get_id_name($user_id, $username, false);
				$wpm_data['user_id'] = isset($user_id[0]) ? $user_id[0] : '';

				if ($wpm_data['user_id'] == '')
				{
					$error[] = array('data' => $username[0], 'error' => 'USER');
				}
			}
			else
			{
				$error[] = array('data' => 'USERNAME', 'error' => 'EMPTY');
			}

			$wpm_data['user_id'] = (($wpm_data['user_id'] != '') ? $wpm_data['user_id'] : '2');
			foreach ($wpm->data as $k => $v)
			{

				if ($wpm_data[$k] == '')
				{
					if ($k != 'enable')
					{
						$error[] = array('data' => $k, 'error' => 'EMPTY');
					}
				}
				$bool = ($wpm_data[$k] != $v && !$error)? $wpm->set_data($k, $wpm_data[$k]): '' ;
			}

			if ($error)
			{
				$err	= '';
				$size	= sizeof($error);
				for ($i = 0; $i < $size; $i++)
				{
					if ($error[$i]['data'] == 'user_id')
					{
						$error[$i]['data'] = 'username';
					}

					$data = ($error[$i]['error'] == 'EMPTY') ? $user->lang[strtoupper($error[$i]['data'])] : $error[$i]['data'];

					$err .= sprintf($user->lang['WPM_ERROR_' . $error[$i]['error']], $data) . '<br />';
				}

				unset($username);

				$template->assign_vars(array(
					'ERROR'		=> true,
					'ERROR_MSG'	=> $err)
				);
			}
			else
			{
				add_log('admin', 'LOG_WPM_SETTINGS_UPDATED');
				trigger_error($user->lang['WPM_UPDATED'] . adm_back_link($this->u_action));
			}
		}
		
		$user_id = $wpm_data['user_id'];
		user_get_id_name($user_id, $username, false);
		$wpm_data['username'] = request_var('username', (isset($username[$wpm_data['user_id']]) ? $username[$wpm_data['user_id']] : $username[0]));
		$wpm->get_vars();

		if ($preview == true)
		{
			// Switch array keys, with values in welcome pm.
			for($i = 0; $i < sizeof($wpm->vars); $i++)
			{
				$vars[$wpm->vars[$i]['var']] = $wpm->vars[$i]['value'];
			}

			$subject		= str_replace(array_keys($vars), array_values($vars), $wpm_data['subject']);
			$message		= str_replace(array_keys($vars), array_values($vars), $wpm_data['message']);

			$subject		= utf8_normalize_nfc($subject);
			$message		= utf8_normalize_nfc($message);

			$uid			= $bitfield			= $options		= '';
			$allow_bbcode	= $allow_smilies	= $allow_urls	= true;

			generate_text_for_storage($message, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

			$wpm_data['preview_msg']	= generate_text_for_display($message, $uid, $bitfield, $options);
			$wpm_data['preview_subj']	= $subject;
		}

		for ($i = 0, $size = sizeof($wpm->vars); $i < $size; $i++) // 11 predefined variables
		{
			$template->assign_block_vars('vars', array(
				'NAME'		=> $wpm->vars[$i]['name'],
				'VARIABLE'	=> $wpm->vars[$i]['var'],
				'EXAMPLE'	=> $wpm->vars[$i]['value'])
			);
		}

		display_custom_bbcodes();

		$template->assign_vars(array(
			'USERNAM'			=> $wpm_data['username'],
			'SUBJECT'			=> $wpm_data['subject'],
			'MESSAGE'			=> $wpm_data['message'],
			'MESSAGE_LEN'		=> strlen($wpm_data['message']),
			'PREVIEW_MSG'		=> ($preview) ? $wpm_data['preview_msg']  : '',
			'PREVIEW_SUBJ'		=> ($preview) ? $wpm_data['preview_subj'] : '',

			'L_SMILIES'			=> strtoupper($user->lang['SMILIES']),

			'S_BBCODE_ALLOWED'	=> true,
			'S_BBCODE_QUOTE'	=> true,
			'S_BBCODE_IMG'		=> true,
			'S_LINKS_ALLOWED'	=> true,
			'S_BBCODE_FLASH'	=> true,
			'S_ENABLE_CHECKED'	=> (bool) (int) $wpm_data['enable'],
			'S_PREVIEW'			=> $preview,

			'T_TEMPLATE_PATH'	=> $phpbb_root_path . 'styles/prosilver/template',

			'U_FIND_USERNAME'	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=searchuser&amp;form=select_user&amp;field=username&amp;select_single=true'),
			'UA_FIND_USERNAME'	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=searchuser&amp;form=postform&amp;field=username&amp;select_single=true'),

			'U_SMILIES'			=> append_sid("{$phpbb_root_path}posting.$phpEx", 'mode=smilies'),
			'U_ACTION'			=> $this->u_action)
		);
	}
}
?>