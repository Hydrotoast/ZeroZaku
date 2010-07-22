<?php
/**
*
* @package sitemap_fx 1.0.7
* @version $Id: sitemap.php 9048 2010-04-25 20:20:42Z FladeX $
* @copyright (c) 2009 FladeX
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
include($phpbb_root_path . 'includes/functions_sitemap_fx.' . $phpEx);

if (!$config['sitemap_enable'])
{
	exit;
}

$url = generate_board_url();
$last_forum_id = 0;

// Start session management
$user->session_begin();
$auth->acl($user->data);

header("Content-Type: text/xml");

if (($sitemap_index_file = $cache->get("_sitemap_fx_index")) === false)
{
	$sitemap_index_file = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	$sitemap_index_file .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

	$sql = 'SELECT forum_id, forum_topics, forum_type
			FROM ' . FORUMS_TABLE;
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		if (($auth->acl_get('f_list', $row['forum_id'])) && ($row['forum_type'] == 1) && ($row['forum_topics'] > 0))
		{
			sitemap_fx_forum((int) $row['forum_id']);

			$sitemap_index_file .= "<sitemap>\n";
			$sitemap_index_file .= "<loc>" . $url . "/sitemap/" . $row['forum_id'] . ".xml</loc>\n";
			$sitemap_index_file .= "<lastmod>" . date('Y-m-d\TH:i:s+00:00', time()) . "</lastmod>\n";
			$sitemap_index_file .= "</sitemap>\n";

			$last_forum_id = $row['forum_id'];
		}
	}
	$db->sql_freeresult($result);

	sitemap_fx_global((int) $last_forum_id);
	$sitemap_index_file .= "<sitemap>\n";
	$sitemap_index_file .= "<loc>" . $url . "/sitemap/0.xml</loc>\n";
	$sitemap_index_file .= "<lastmod>" . date('Y-m-d\TH:i:s+00:00', time()) . "</lastmod>\n";
	$sitemap_index_file .= "</sitemap>\n";

	$sitemap_index_file .= "</sitemapindex>\n";
	$cache->put("_sitemap_fx_index", $sitemap_index_file, 3600*$config['sitemap_cache_time']);
}

echo $sitemap_index_file;

?>