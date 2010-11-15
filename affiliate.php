<?php
/**
*
* @package Affiliate
* @version 1.0.0
* @copyright (c) Gio Borje (www.zerozaku.com)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
**/

/**
* DO NOT CHANGE (IN_PHPBB)!
*/
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path.'common.'.$phpEx);
include($phpbb_root_path.'includes/functions_display.' . $phpEx);

// Start session management.
$user->session_begin();
$auth->acl($user->data);
$user->setup('affiliate');

$mode = request_var('mode', '');
if(!in_array($mode, array('click', 'manage', 'keygen')))
{
    trigger_error('INVALID_ACTION');
}

switch($mode)
{
    case 'click':
        $ad_id = request_var('a', 0);
        
        $sql = 'UPDATE ' . ADS_TABLE . '
        	SET ad_clicks = ad_clicks + 1
        	WHERE ad_id = ' . (int) $ad_id;
        $db->sql_query($sql);
        
        // Make sure the browser does not cache this
		header('Content-type: text/html; charset=UTF-8');
		header('Cache-Control: private, no-cache="set-cookie"');
		header('Expires: 0');
		header('Pragma: no-cache');
		
		exit('1');
    break;
    case 'manage':
        $affiliate_id = request_var('af', 0);
        $affiliate_key = request_var('key', '');
        
        $sql = 'SELECT affiliate_key FROM ' . AFFILIATE_TABLE . '
        	WHERE affiliate_id = ' . (int) $affiliate_id;
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        
        if(phpbb_check_hash($affiliate_key, $row['affiliate_key']))
        {
	        $sql = 'SELECT ad.ad_name, ad.ad_img, ad.ad_url, ad.ad_impressions, ad.ad_clicks, f.forum_name FROM ' . ADS_TABLE . ' ad
	        	JOIN ' . FORUMS_TABLE . ' f
	        		ON ad.forum_id = f.forum_id
	        	WHERE ad.affiliate_id = ' . (int) $affiliate_id;
	        $result = $db->sql_query($sql);
	        
	        while($row = $db->sql_fetchrow($result))
	        {
	            $template->assign_block_vars('ad_stats', array(
	                'URL'			=> $row['ad_url'],
	                'IMG_NAME'		=> $row['ad_img'],
	                'IMG'			=> $phpbb_root_path . 'images/affiliates/' . basename($row['ad_name']) . '/' . basename($row['ad_img']),
	                'FORUM_NAME'	=> $row['forum_name'],
	                'IMPRESSIONS'	=> $row['ad_impressions'],
	                'CLICKS'		=> $row['ad_clicks']
	            ));
	        }
	        $db->sql_freeresult($result);
	        
	        $sql = 'SELECT affiliate_name FROM ' . AFFILIATE_TABLE . '
	        	WHERE affiliate_id = ' . (int) $affiliate_id;
	        $result = $db->sql_query($sql);
	        $row = $db->sql_fetchrow($result);
	        $db->sql_freeresult($result);
	
			$template->assign_vars(array(
			    'AFFILIATE_NAME'	=> $row['affiliate_name']
			));
			
			page_header('Affiliate management');
			$template->set_filenames(array('body' => 'affiliate_manage.html'));
			page_footer();
        }
        else
        {
            trigger_error('Invalid affiliate ID and key combination.');
        }
    break;
    case 'keygen':
        if($auth->acl_getf_global('a_'))
        {
            $affiliate_id = request_var('af', 0);
	        $key = request_var('key', '');
	        
	        $sql = 'UPDATE ' . AFFILIATE_TABLE . '
	        	SET affiliate_key = \'' . $db->sql_escape(phpbb_hash($key)) . '\'
	        	WHERE affiliate_id = ' . (int) $affiliate_id;
	        $db->sql_query($sql);
	        
	        echo phpbb_hash($key);
        }
    break;
}
?>