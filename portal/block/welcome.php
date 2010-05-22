<?php

/**
*
* @package - Board3portal
* @version $Id: welcome.php 325 2008-08-17 18:59:40Z kevin74 $
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

$allow_bbcode = 1;
$allow_urls = 1;
$allow_smilies = 1;

$message_parser = new parse_message($portal_config['portal_welcome_intro']);
$message_parser->parse($allow_bbcode, $allow_urls, $allow_smilies);

$text = $message_parser->message;
$bbcode_uid = $message_parser->bbcode_uid;
$bbcode_bitfield = $message_parser->bbcode_bitfield; 

$bbcode = new bbcode(base64_encode($bbcode_bitfield));
$text = censor_text($text);
$bbcode->bbcode_second_pass($text, $bbcode_uid, $bbcode_bitfield);
$text = bbcode_nl2br($text);
$text = smiley_text($text);

		$template->assign_vars(array(
			'S_DISPLAY_WELCOME' 	=> true,
			'PORTAL_WELCOME_INTRO'   => $text,
		));

?>