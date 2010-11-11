<?php
/**
*
* @package mcp
* @version $Id$
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
* mcp_usertree
* Facilitates searching for users connected by IP addresses
* @package mcp
*/
class mcp_usertree
{
	var $u_action;
	var $users = array();
	function usertreenode($userid, $parentip = 'null')
	{
		global $db;
		global $users;
		$returnval = '';
		$users[] = 1;
		$res = $db->sql_query("SELECT DISTINCT poster_ip FROM forum_posts WHERE poster_id = $userid AND poster_ip <> '$parentip'");

		$returnval .= '<ul>';
		while ($row=$db->sql_fetchrow($res))
		{
			$ipres = $db->sql_query("SELECT DISTINCT poster_id FROM forum_posts WHERE poster_ip='" . $row['poster_ip'] . "'");
					
				while ($iprow = $db->sql_fetchrow($ipres))
				{
					if (!in_array($iprow['poster_id'], $users))
					{
						$users[] = $iprow['poster_id'];
						$usrres = $db->sql_query("SELECT username, user_colour FROM forum_users WHERE user_id =" . $iprow['poster_id']);
						$usrrow = $db->sql_fetchrow($usrres);
						$returnval .=  '<li style="padding-left: 5px; margin-left: 5px;"><span style="font-weight:bold; color:#' . $usrrow['user_colour'] . ';">' . $usrrow['username'] . "</span> (" . $iprow['poster_id'] . ") - " .$row['poster_ip']. "</li>";
						$returnval .= $this->usertreenode($iprow['poster_id'], $row['poster_ip']);
					}
				}
			}
			$returnval .= '</ul>';
		return $returnval;
	}
	function main($id, $mode)
	{
		global $auth, $db, $user, $template, $users;
		global $config, $phpbb_root_path, $phpEx;
		
		$user->add_lang('acp/common');

		$action = request_var('action', array('' => ''));

		if (is_array($action))
		{
			list($action, ) = each($action);
		}
		else
		{
			$action = request_var('action', '');
		}

		$this->tpl_name = 'mcp_usertree';
		$this->page_title = 'User Tree';

		switch ($mode)
		{
			case 'search':
			
			if (isset($_POST['submit']))
			{
				$searchuser = 0;
				$res = $db->sql_query("SELECT * FROM forum_users WHERE username_clean = '" . strtolower(request_var('searchuser', '')) . "'");
				while ($userrow = $db->sql_fetchrow($res))
				{
					$searchuser = $userrow['user_id'];
				}
				if ($searchuser == 0) { $tree_result = "No such user was found"; }
				$tree_result = $this->usertreenode($searchuser);
			} else {
				$tree_result = "Search for a user to see thier tree.";
			}
			
			break;
		}

		$template->assign_vars(array(
			'S_TREE'		=> $tree_result,
			'L_TITLE'			=> "User Tree",
			)
		);
	}
}

?>