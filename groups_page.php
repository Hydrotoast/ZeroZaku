<?php
/**
*
* @package phpBB3
* @version $Id: groups_page.php,v 1.0.1 2009-08-16 09:28:00 EST rmcgirr83 $
* @copyright (c) Rich McGirr
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);


$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('groups');

// grab user count of groups
$sql = 'SELECT group_id
	FROM ' . USER_GROUP_TABLE . '
		WHERE user_pending <> 1
			ORDER BY group_id';
$result = $db->sql_query($sql);

$groups_count = array();
while ($row = $db->sql_fetchrow($result))
{
	$groups_count[] = $row['group_id'];
}
$db->sql_freeresult($result);
$total_groups_count = sizeof($groups_count);

// now get the group(s) info

$sql_where = " WHERE group_name <> 'GUESTS'";

// don't want coppa group?
if (!$config['coppa_enable'])
{
	$sql_where .= " AND group_name <> 'REGISTERED_COPPA'";
}

$sql = 'SELECT *
	FROM ' . GROUPS_TABLE . '
	' . $sql_where . '
	ORDER BY group_name';
$result = $db->sql_query($sql);

// we gots us some results ?
if ($row = $db->sql_fetchrow($result))
{
	do
	{
		if ($row['group_type'] == GROUP_HIDDEN && !$auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel'))
		{
			continue;
		}
		// how many users does the group have?
		if ($total_groups_count)
		{
			$user_count = 0;
			for ($i = 0; $i < $total_groups_count; $i++)
			{
	            if ($row['group_id'] == $groups_count[$i])
	            {
					$user_count++;
	            }
			}
		}
		// Grab rank information
		$ranks = $cache->obtain_ranks();
		
		$rank_title = $rank_img = $rank_img_src = '';
		if ($row['group_rank'])
		{
			if (isset($ranks['special'][$row['group_rank']]))
			{
				$rank_title = $ranks['special'][$row['group_rank']]['rank_title'];
			}
			$rank_img = (!empty($ranks['special'][$row['group_rank']]['rank_image'])) ? '<img src="' . $config['ranks_path'] . '/' . $ranks['special'][$row['group_rank']]['rank_image'] . '" alt="' . $ranks['special'][$row['group_rank']]['rank_title'] . '" title="' . $ranks['special'][$row['group_rank']]['rank_title'] . '" /><br />' : '';
			$rank_img_src = (!empty($ranks['special'][$row['group_rank']]['rank_image'])) ? $config['ranks_path'] . '/' . $ranks['special'][$row['group_rank']]['rank_image'] : '';
		}

		// open, closed, hidden blah blah blah
		switch ($row['group_type'])
		{
			case GROUP_OPEN:
				$row['l_group_type'] = 'OPEN';
			break;
				
			case GROUP_HIDDEN:
				$row['l_group_type'] = 'HIDDEN';
			break;
			
			case GROUP_CLOSED:
				$row['l_group_type'] = 'CLOSED';
			break;

			case GROUP_SPECIAL:
				$row['l_group_type'] = 'SPECIAL';
			break;

			case GROUP_FREE:
				$row['l_group_type'] = 'FREE';
			break;
		}

		// Misusing the avatar function for displaying group avatars...
		$avatar_img = get_user_avatar($row['group_avatar'], $row['group_avatar_type'], $row['group_avatar_width'], $row['group_avatar_height'], 'GROUP_AVATAR');		
		$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name'];
		$u_group = append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=group&amp;g=' . $row['group_id']);
		$s_bot_group = ($row['group_name'] == 'BOTS') ? true : false;

		$template->assign_block_vars('group_row', array(
			'GROUP_NAME'	=> $group_name,
			'GROUP_RANK'	=> $rank_title,
			'GROUP_DESC'	=> generate_text_for_display($row['group_desc'], $row['group_desc_uid'], $row['group_desc_bitfield'], $row['group_desc_options']),
			'GROUP_COLOR'	=> $row['group_colour'],
			'GROUP_TYPE'	=> $user->lang['GROUP_IS_' . $row['l_group_type']],
			'GROUP_COUNT'	=> number_format($user_count),
			'AVATAR_IMG'	=> $avatar_img,
			'RANK_TITLE'	=> $rank_title,
			'RANK_IMG'		=> $rank_img,
			'RANK_IMG_SRC'	=> $rank_img_src,			
			
			'S_BOT_GROUP'	=> $s_bot_group,
			'U_GROUP'		=> $u_group,
		));
	}
	while ($row = $db->sql_fetchrow($result));

	$db->sql_freeresult($result);
}

$page_title = $config['sitename'] . ' - ' . $user->lang['GROUPS'];
// Output the page
page_header($page_title);
	
$template->set_filenames(array(
	'body' => 'groups_page_body.html'
));
	
page_footer();

?>