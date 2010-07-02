<?php
/*
filename: bbc_download.php
Author: CyberAlien : http://www.stsoftware.biz
Notes: CyberAlien (aka CA ;) ) released the enhanced bbcode parser to the public
	on the 31 May 2005 @ 7:38 am (for more information see the following post
	http://www.phpbbstyles.com/viewtopic.php?t=6107 )
Version: 1.0.6
Description: Used with the XS Syntax Highlighter to download the contents of a syntax block
*/

define('IN_PHPBB', true);
define('IN_XSBBC_DOWNLOAD', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);

$post_id = request_var('p', 0);
$code_id = request_var('item', 0);
$mode = request_var('mode', '');

if( !$post_id )
{
	trigger_error('XS_SH_NO_TOPIC_ID');
}

// Get the Post
$sql = "SELECT * FROM " . ( $mode == 'pm' ? PRIVMSGS_TABLE : POSTS_TABLE ) . "
				WHERE " . ( $mode == 'pm' ? 'msg_id' : 'post_id' ) . "={$post_id}";
if ( !($result = $db->sql_query($sql)) )
{
	trigger_error('XS_SH_NO_TOPIC');
}
if (($posttext = $db->sql_fetchrow($result)) === false)
{
	trigger_error('XS_SH_NO_TOPIC');
}
$db->sql_freeresult($result);

// prepare variables
$code_filename = '';
$code_text = '';
define('EXTRACT_CODE', $code_id);

// compile post
$bbcode_uid = $posttext['bbcode_uid'];
$sh_bbcode->allow_bbcode = true;
$sh_bbcode->allow_smilies = $config['allow_smilies'] && $posttext['enable_smilies'] ? true : false;

$sh_bbcode->code_post_id = ($mode == 'pm' ? $posttext['msg_id'] : $posttext['post_id']);
$message = $sh_bbcode->parse(($mode == 'pm' ? $posttext['message_text'] : $posttext['post_text']), $bbcode_uid);
$sh_bbcode->code_post_id = 0;

if(!strlen($sh_bbcode->code_text))
{
	trigger_error('XS_SH_NO_CONTENT');
}

$code_text = undo_htmlspecialchars($sh_bbcode->code_text, true);

if(empty($sh_bbcode->code_filename))
{
	$code_filename = 'code_' . $post_id . ($code_id ? '_' . $code_id : '') . '.txt';
}
else
{
	$code_filename = $sh_bbcode->code_filename;
}
//header('Content-Type: text/plain');
header('Content-Type: application/zip');
header('Content-Length: ' . strlen($code_text));
header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Content-Disposition: attachment; filename="' . $code_filename . '"');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');

echo $code_text;

?>
