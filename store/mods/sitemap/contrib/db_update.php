<?php
/**
*
* @package phpBB3_Tools
* @copyright (c) 2008 Alek$
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

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();
$l_title = 'Database update';

$self_destroy = request_var('self_destroy', false);

if($self_destroy)
{
	if(@unlink(__FILE__))
	{
		trigger_error('Database update script was successfuly deleted from server.');
	}
	trigger_error('Unable to delete database update script from server ('.__FILE__.'). Do it manualy, using FTP access.');
}

$sql[] = 'INSERT INTO ' . $table_prefix . 'config (config_name, config_value, is_dynamic) VALUES (\'sitemap_enable\', \'1\', \'0\')';
$sql[] = 'INSERT INTO ' . $table_prefix . 'config (config_name, config_value, is_dynamic) VALUES (\'sitemap_cache_time\', \'96\', \'0\')';
$sql[] = 'INSERT INTO ' . $table_prefix . 'config (config_name, config_value, is_dynamic) VALUES (\'sitemap_priority_0\', \'0.5\', \'0\')';
$sql[] = 'INSERT INTO ' . $table_prefix . 'config (config_name, config_value, is_dynamic) VALUES (\'sitemap_priority_1\', \'0.5\', \'0\')';
$sql[] = 'INSERT INTO ' . $table_prefix . 'config (config_name, config_value, is_dynamic) VALUES (\'sitemap_priority_2\', \'0.5\', \'0\')';
$sql[] = 'INSERT INTO ' . $table_prefix . 'config (config_name, config_value, is_dynamic) VALUES (\'sitemap_priority_3\', \'0.5\', \'0\')';
$sql[] = 'INSERT INTO ' . $table_prefix . 'config (config_name, config_value, is_dynamic) VALUES (\'sitemap_freq_0\', \'daily\', \'0\')';
$sql[] = 'INSERT INTO ' . $table_prefix . 'config (config_name, config_value, is_dynamic) VALUES (\'sitemap_freq_1\', \'daily\', \'0\')';
$sql[] = 'INSERT INTO ' . $table_prefix . 'config (config_name, config_value, is_dynamic) VALUES (\'sitemap_freq_2\', \'daily\', \'0\')';
$sql[] = 'INSERT INTO ' . $table_prefix . 'config (config_name, config_value, is_dynamic) VALUES (\'sitemap_freq_3\', \'daily\', \'0\')';


$user->lang['UPDATE_DB'] = 'Update database?';
$user->lang['UPDATE_DB_CONFIRM'] = 'Following queries will be executed:<br /><textarea name="sql" id="sql" class="inputbox" rows="7" cols="30">' . htmlspecialchars(implode(";\n", $sql).';') . '</textarea>';

if(confirm_box(true))
{
	$db->sql_transaction();
	foreach($sql as $query)
	{
		$db->sql_query($query);
	}
	$db->sql_transaction('commit');
	$report = "Following modifications was successfuly added to database:
<dl class=\"codebox\"><dt>Code: </dt><dd><code>" . implode('</code></dd></dl> <span style="font-weight:bold;color:#00AA00">[ SUCCEED ]</span><br /><br /><dl class="codebox"><dt>Code: </dt><dd><code>', $sql) . "</code></dd></dl> <span style=\"font-weight:bold;color:#00AA00\">[ SUCCEED ]</span><br /><br /><input type=\"button\" class=\"button2\" value=\"Remove db_update.php script\" onclick=\"document.location.href='db_update.php?self_destroy=true'\">";
	trigger_error($report);
}
else
{
	confirm_box(false, 'UPDATE_DB');
}

?>