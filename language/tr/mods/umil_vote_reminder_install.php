<?php
/** 
*
* 
* @package language
* @version $Id: umil_poll_vote_reminder_install.php, v 1.0.0 2009/08/30 12:53:34  Exp $
* @copyright (c) 2009 mtrs
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//

$lang = array_merge($lang, array(
		'INSTALL_POLL_VOTE_REMINDER'				=> 'Anketlere Oy Verme Hatırlatma eklentisini kur',
		'INSTALL_POLL_VOTE_REMINDER_CONFIRM'		=> 'Anketlere Oy Verme Hatırlatma eklentisini kurmaya hazır mısınız?',
		'POLL_VOTE_REMINDER'						=> 'Anketler Oy Verme Hatırlatma',
		'POLL_VOTE_REMINDER_EXPLAIN'				=> 'Anketler Oy Verme Hatırlatma eklentisi veritabanı değişikliklerini UMIL otomatik yöntemiyle kur.',
		'UNINSTALL_POLL_VOTE_REMINDER'				=> 'Anketlere Oy Verme Hatırlatma eklentisini kaldır',
		'UNINSTALL_POLL_VOTE_REMINDER_CONFIRM'		=> 'Anketlere Oy Verme Hatırlatma eklentisini kaldırmaya hazır mısınız? Bu eklenti tarafından yapılan tüm ayarlar ve eklenen veri kaldırılacaktır!',
		'UPDATE_POLL_VOTE_REMINDER'					=> 'Anketlere Oy Verme Hatırlatma eklentisini güncelle',
		'UPDATE_POLL_VOTE_REMINDER_CONFIRM'			=> 'Anketlere Oy Verme Hatırlatma eklentisini güncellemeye hazır mısınız?',

	));

?>