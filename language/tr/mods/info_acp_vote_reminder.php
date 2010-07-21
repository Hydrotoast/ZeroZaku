<?php
/**
*
*  Poll Vote Reminder [English]
*
* @package language
* @version $Id:  info_acp_vote_reminder.php,v 1.0.0 2009/08/30 mtrs Exp $
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
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//


$lang = array_merge($lang, array(
	'VOTE_REMINDER_ENABLE'				=> 'Anketlere oy verme hatırlatıcıyı etkinleştir',
	'VOTE_REMINDER_ENABLE_EXPLAIN'		=> 'Zorunlu anketlere oy verme için kullanıcıları yönlendirir.',
	'VOTE_REMINDER_ENABLED'				=> 'Anket hatırlatıcı etkinleştirildi',
	'VOTE_REMINDER_DISABLED'			=> 'Anket hatırlatıcı devredışı bırakıldı',	
	'VOTE_REMINDER_TOPIC_ID'			=> 'Zorunlu okunacak konu Topic ID',
	'VOTE_REMINDER_TOPIC_ID_EXPLAIN'	=> 'Kullanıcıların okumak için zorunlu yönlendirileceği bir konu numarası girin.',
	'VOTE_REMINDER_UPDATE'				=> 'Oy verme zorunlu anketleri hatırlat',
	'VOTE_REMINDER_UPDATE_EXPLAIN'		=> 'Panodaki tüm kullanıcılar henüz oy vermedikleri, zorunlu anketlere ve bir kez okunacak bir konuya yönlendirilir.',
	'SHOW_WHO_VOTED'					=> 'Kimler oy verdi göster',
	'SHOW_WHO_VOTED_EXPLAIN'			=> 'Ankete oy veren kullanıcı adlarını aşağıdaki listede gösterir.',
	'POLL_TITLE'						=> 'Anket başlığı',
	'POLL_TITLE_EXPLAIN'				=> 'Zorunlu oy verilecek anketler listesine eklemek için bir anket seç.',
	
	'ACP_VOTE_REMINDER'					=> 'Anketlere oy verme hatırlatıcı',
	'ACP_VOTE_REMINDER_EXPLAIN'			=> 'Bu panelden zorunlu oy verilecek anket konuları ekleyip çıkarabilirsiniz.',
	'ADD_TOPIC'							=> 'Yeni anket konusu ekle',
	'SELECT_POLL_TITLE'					=> 'Bir anket seçmelisiniz',
	'NUMBER'							=> 'No',
	'REMOVE'							=> 'Kaldır',
	'VOTE_END'							=> 'BİTİŞ',
	'LAST_VOTE'							=> 'Son oy',
	'NO_VOTE'							=> 'Henüz yok',
	'VOTE_COUNT'						=> 'Oy',
	'WHO_VOTED'							=> 'KİMLER OY VERDİ',	
	'UNLIMITED'							=> 'Belirsiz',
	'REMOVE_TOPIC'						=> 'Konuyu zorunlu oy verilecekler anketler listesinden çıkar',	
	'POLL_ADDED'						=> 'Anket konusu başarıyla zorunlu anket konuları arasına eklendi',
	'NO_TOPIC'							=> 'Konu mevcut değil veya bir anket konusu değil',
	'TOPIC_REMOVED'						=> 'Seçilen konu başarıyla zorunlu oy verilecek anketler listesinden çıkarıldı',

	'FORCE_READ_TOPIC_CHANGED'			=> 'Zorunlu okunacak konu değiştirildi',
	'NO_VALUE_CHANGED'					=> 'Kayıt edilecek hiç bir değişiklik yapmadınız',
	'NO_POLL_EXIST'						=> 'Eklenecek açık başka bir anket yok, lütfen önce yeni bir anket oluşturun',
	'WHO_VOTED_UPDATED'					=> 'Kimler oy verdi göster ayarı güncellendi',	
	'VOTE_REMINDER_INTERVAL'			=> 'Oy verme aralığı',
	'VOTE_REMINDER_INTERVAL_EXPLAIN'	=> 'Birden fazla zorunlu anket olması halinde, kullanıcılar ard arda değil ama, bir ara vererek oy verir, böylece daha kullanıcı dostu bir yol olur. Tüm zorunlu anketlere birden oy verilemesi için 0 girin.',
	
	'LOG_VOTE_TOPIC_ADD'				=> 'Topic ID %s anketi oy verme zorunlu anketler arasına alındı',
	'LOG_VOTE_TOPIC_REMOVE'				=> 'Topic ID %s anketi oy verme zorunlu anketler arasından çıkarıldı',

	'UPDATE_VOTE_REMINDER'				=> 'Oy verme hatırlatıcı ayarları yenilendi.',
	'RESET_VOTE_REMINDER'				=> '<strong>Anket hatırlatıcı ayarları sıfırlandı</strong>',
	
));

?>