<?php

/**
*
* @package - Board3portal
* @version $Id: recent.php 325 2008-08-17 18:59:40Z kevin74 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}

if (!defined('IN_PORTAL'))
{
   exit;
}

//
// Exclude forums
//
$sql_where = '';
if ($portal_config['portal_exclude_forums'])
{
	$exclude_forums = explode(',', $portal_config['portal_exclude_forums']);
	foreach ($exclude_forums as $i => $id)
	{
		if ($id > 0)
		{
			$sql_where .= ' AND t.forum_id <> ' . trim($id);
		}
	}
}

// Get a list of forums the user cannot read
$forum_ary = array_unique(array_keys($auth->acl_getf('!f_read', true)));

// Determine first forum the user is able to read (must not be a category)
$sql = 'SELECT forum_id
FROM ' . FORUMS_TABLE . '
WHERE forum_type = ' . FORUM_POST;

if (sizeof($forum_ary))
{
$sql .= ' AND ' . $db->sql_in_set('forum_id', $forum_ary, true);
}

$result = $db->sql_query_limit($sql, 1);
$g_forum_id = (int) $db->sql_fetchfield('forum_id');

//
// Recent hot topics
//
$sql = 'SELECT t.topic_title, t.forum_id, t.topic_id, f.forum_name
	FROM ' . TOPICS_TABLE . ' t
		JOIN ' . FORUMS_TABLE . ' f
	ON t.forum_id = f.forum_id
	WHERE t.topic_approved = 1 
		AND t.topic_replies >=' . $config['hot_threshold'] . '
		AND t.topic_moved_id = 0
		' . $sql_where . '
	ORDER BY topic_time DESC';

$result = $db->sql_query_limit($sql, 6);

while( ($row = $db->sql_fetchrow($result)) && ($row['topic_title']) )
{
	// auto auth
	if ( ($auth->acl_get('f_read', $row['forum_id'])) || ($row['forum_id'] == '0') )
	{
		$template->assign_block_vars('hot_topics', array(
			'TITLE'	 		=> character_limit($row['topic_title'], 24),
			'FULL_TITLE'	=> censor_text($row['topic_title']),
		    'FORUM'			=> $row['forum_name'],
			'U_VIEW_TOPIC'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . ( ($row['forum_id'] == 0) ? $g_forum_id : $row['forum_id'] ) . '&amp;t=' . $row['topic_id'])
		));
	}
}
$db->sql_freeresult($result);

?>