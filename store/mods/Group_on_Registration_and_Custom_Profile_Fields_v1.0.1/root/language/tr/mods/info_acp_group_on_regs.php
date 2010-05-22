<?php
/**
*
*  [Turkish]
*
* @package language
* @version $Id:  info_acp_group_on_reg.php, v1.0.1 2009/11/21 15:35:00 mtrs Exp $
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
	'ACP_GROUPS_REGS'						=> 'Kayıtta gruplar',
	'ACP_GROUPS_REGS_EXPLAIN'				=> 'Kayıtta gösterilecek gruplar tanımlayabilir, gruplar özel, yönetici veya yetkili olmayanlara arasından listelenir. Gösterilen gruplardan birini seçmeyi zorunlu yapabilir ve eklenen grupları varsayılan seçebilirsiniz.',
	'ADD_GROUP'								=> 'Grup ekle',
	'ADD_CPF_GROUP'							=> 'Grup ekle',
	
	'CPF_AUTO_GROUP'						=> 'Grupları özel profil alanı değerlerine göre senkronize et',
	'CPF_AUTO_GROUP_EXPLAIN'				=> 'Tüm kullanıcılar özel profil alanı kayıtlarına göre gruplara üye yapar veya gruptan çıkarır.',
	'CPF_ADD_GROUP_LIST_CHANGED'			=> 'Özel profil alanlarına bağlı gruplar senkronize edildi',
	'CPF_LANG_VALUE'						=> 'Dil değeri seçeneği',	
	'CPF_FIELD_NAME'						=> 'Özel profil alanı adı',
	'CPF_TO_GROUPS'							=> 'Özel profil alanlarına bağlı gruplar',
	'CPF_TO_GROUPS_EXPLAIN'					=> 'Özel profil alanları ve onlara bağlı grup tanımlayabilir ve kulllanıcılırın gruplara otomatik üye yapabilirsin. Ayrıca yönetim panelinde kullanıcıları toplu halde özel profil alanı değerine göre gruplara ekleyip çıkarabilirsiniz. Bir özel profil alanı düzenlemesinin grup ayarını sildiğini unutmayın.',	

	'ENTER_GROUP_ID_NAME'					=> 'Geçerli bir grup ID veya grup adı seçmelisiniz',

	'GROUPS_ON_REGISTRATION'				=> 'Gruplar',
	'GROUPS_ON_REGISTRATION_EXPLAIN'		=> 'Üye olmak için bir grup seçiniz.',		
	'GROUPS_ENABLED'						=> 'Kayıtta grup göstermeyi etkinleştir',
	'GROUPS_ENABLED_EXPLAIN'				=> 'Kayıtta gösterilen gruplara üyeler otomatik eklenebilir.',
	'GROUPS_REQUIRE'						=> 'Kayıtta grup seçmeyi zorunlu yap',
	'GROUPS_REQUIRE_EXPLAIN'				=> 'Kullanıcı kayıt sırasında bir grup seçmek zorunda olacaktır.',
	'GROUPS_MULTIPLE_REGISTRATION'			=> 'Kayıtta birden fazla gruba girişi etkinleştir',
	'GROUPS_MULTIPLE_REGISTRATION_EXPLAIN'	=> 'Etkinleştirilirse kullanıcı kayıt ekranında katılmak için birden fazla grup seçebilir. Bu durumda kayıtta seçilen gruplar varsayılan olmazlar.',
	'GROUPS_DEFAULT'						=> 'Kayıtta seçilen gurubu varsayılan yap',
	'GROUPS_DEFAULT_EXPLAIN'				=> 'Kayıt ekranında seçilen grubu varsayılan yapar.',	
	'GROUPS_TO_CPF_ENABLE'					=> 'Özel profil alanları bağlı otomatik grup üyeliğini etkinleştir',
	'GROUPS_TO_CPF_ENABLE_EXPLAIN'			=> 'Kayıtta ve profilde seçilen açılır liste kutusu özel profil alanı ile otomatik grup kaydı yapılmasını sağlar.',
	'GROUPS_TO_CPF_NO_PENDING'				=> 'Özel profil alanı seçimiyle gizli ve kapalı gruplara otomatik üye ekle',
	'GROUPS_TO_CPF_NO_PENDING_EXPLAIN'		=> 'Etkinleştirilince, gizli ve kapalı gruplara seçilen özel profil alanına göre onay olmadan üye eklenir.',
	'GROUPS_FIELD_NAME'						=> 'Özel profil alanı adı',
	'GROUPS_FIELD_NAME_EXPLAIN'				=> 'Bir özel profil alanı ismi seçin. Sadece açılır liste kutusu türü gösterilir.',		
	'GROUPS_LANG_VALUE'						=> 'Özel profil alanı değeri',
	'GROUPS_LANG_VALUE_EXPLAIN'				=> 'Bu seçenek kayıtta işaretlenirse, kullanıcı otomatik grup üyesi yapılır.',
	'GROUPS_CPF_NAME'						=> 'Özel profil alanı seçenek değeri',
	'GROUPS_CPF_NAME_EXPLAIN'				=> 'Yukarıda seçilen gruba eklemek için bir özel profil alanı seçin.',
	'GROUPS_REGISTRATION'					=> 'Kayıtta grupla göster',
	'GROUPS_REGISTRATION_EXPLAIN'			=> 'Üye olmaya açık grupları kayıtta üye olunabilmesi için listeler.',	
	'GROUP_NAME_ID'							=> 'Grup',
	'GROUP_NAME_ID_EXPLAIN'					=> 'Kayıtta gösterilecek bir grup seçin.',
	'GROUP_MEMBERS'							=> 'Üyeler',
	'GROUP_NAME'							=> 'Grup adı',
	'GROUP_NAME_EXPLAIN'					=> 'Lütfen kayıtta gösterilecek bir grup adı seçiniz.',
	'GROUP_ID'								=> 'Grup ID',
	'GROUP_DEFAULT'							=> 'Varsayılan',
	'GROUP_ADDED'							=> 'Grup başarıyla kayıtta gösterme listesine eklendi.',
	'GROUP_CPF_ADDED'						=> 'Özel profil alanlarına bağlı gruplar güncellendi',
	'GROUP_REMOVED'							=> 'Seçilen grup ID başarıyla çıkarıldı',
	'CPF_GROUP_REMOVED'						=> 'Özel profil alanına bağlı grup çıkarıldı',

	'LOG_GROUPS_REG_DELETE'					=> '<strong>Grup ID %s kayıtta gösterilen gruplar arasından çıkarıldı</strong>',
	'LOG_GROUPS_REG_ADD'					=> '<strong>Grup ID %s kayıtta gösterilen gruplara eklendi<strong>',
	'LOG_GROUPS_CPF_DELETE'					=> '<strong>Özel profil alanlarına bağlı gruplar güncellendi</strong>',
	'LOG_GROUPS_CPF_ADD'					=> '<strong>Grup ID %s özel profil alanlarına bağlı gruplara eklendi</strong>',
	'LOG_CONFIG_GROUPS_REG_UPDATED'			=> '<strong>Kayıtta gruplar ayarları güncellendi</strong>',
	'LOG_CPF_GROUPS_SYNCHRONISED'			=> '<strong>Özel profil alanlarına bağlı gruplar senkronize edildi</strong>',
	
	'NO_GROUP'								=> 'Grup ID mevcut değil',
	'NO_GROUP_TO_ADD'						=> 'Eklenbilecek bir grup yok, lütfen panoya önce yeni bir grup ekleyin',
	'NO_CPF_TO_ADD'							=> 'Bir gruba atanacak açılır liste kutusu türü özel profil alanı mevcut değil. Lüften gruba atamak için yeni bir açılır liste kutusu özel profil alanı oluşturun.',
	'NO_CPF_GROUP_SELECTED'					=> 'Lütfen bir grup ve özel profil alanı adı ve opsiyonu seçin',
	'NO_CPF_GROUP_EXIST'					=> 'Özel profil alanlarına bağlı hiçbir grup yok. Lüften senkronize etmeden önce bir grup ekleyelim.',
	'NO_VALUE_CHANGED'						=> 'Kayıt edilecek hiç bir değişiklik yapmadınız',
	
	'REMOVE'								=> 'Kaldır',
	'REMOVE_GROUP'							=> 'Grubu kayıtta gösterilen grup listesinden çıkar',
));


?>