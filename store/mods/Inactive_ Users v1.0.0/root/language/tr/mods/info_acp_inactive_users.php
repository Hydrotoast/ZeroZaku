<?php
/**
*
* inactive_users [English]
*
* @package language
* @version $Id: inactive_users.php,v 0.2.6 2008/09/30 15:35:00 mtrs Exp $
* @copyright (c) 2008 mtrs
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
	'INACTIVE_USERS_ENABLE'					=> 'Inaktif kullanıcı eklentisini etkinleştir',
	'INACTIVE_USERS_TITLES'					=> 'Aktif olmayan ve yasaklı üyelere özel avatar ve başlık',
	'INACTIVE_USERS_EXCL_VIEW_BAN'			=> 'Konu sayfasnında yasaklı olanları göster',
	'INACTIVE_USERS_EXCL_VIEW_TIME' 		=> 'Konu sayfasnında aktif olmayanları göster', 
	'INACTIVE_USERS_EXCL_PROF_BAN' 			=> 'Profilde yasaklı olanları göster',
	'INACTIVE_USERS_EXCL_PROF_TIME' 		=> 'Profilde aktif olmayanları göster', 
	'INACTIVE_USERS_AVATAR_VIEW_DISABLE'	=> 'Konu sayfalarında özel avatar göster',
	'INACTIVE_USERS_AVATAR_PROF_DISABLE'	=> 'Profilde Özel avatarları etkinleştir',
	'INACTIVE_USERS_NO_AVATAR' 				=> 'Varsayılan avatarları göster',
	'INACTIVE_USERS_NO_AVATAR_EXPLAIN' 		=> '25`den az iletisi olanlar ve fazla olanlara farklı iki avatar atanır',
	'INACTIVE_USERS_PERIOD'					=> 'Aktif olunmayan süre ayarı (ay)',
	'INACTIVE_USERS_PERIOD_EXPLAIN'			=> 'Aktif olmayan sayılmak için siteye en az kaç ayda bir gelinmeli', 
	'INACTIVE_USERS_EXC_IDS'				=> 'Muaf kullanıcı user_id değerleri',
	'INACTIVE_USERS_EXC_IDS_EXPLAIN'		=> 'Bu eklentiden muaf tutulan kullanıcı user_ids değerleri girin. Maksimum 255 karakter girilebilir',
	'INACTIVE_USERS_INCLUDED_IDS'			=> 'Bu eklentiyi görebilecek kullanıcılar',
	'INACTIVE_USERS_INCLUDED_IDS_EXPLAIN'	=> 'Sadece buraya girilen user_id ler bu eklenti sonucunu görebilir. Bu alana ilgisiz bir değer doldurulunca, varsayılan avatar hariç, eklenti devredışı olur.',
	'INSTALL_INACTIVE_USERS'				=> 'Aktif olmayan kullanıcılar eklentisini kur',
	'MOD_INSTALLED'							=> 'Eklenti başarıyla kurulmuştur. Lütfen install_inactive_users.php dosyasını kaldırınız.',
		
));

?>