<?php
/** 
*
* 
* @package language
* @version $Id: umil_groups_on_reg.php, v 1.0.1 2009/11/21 12:53:34  Exp $
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
		'INSTALL_GROUPS_ON_REGISTRATION'				=> 'Kayıtta Grup Üyeliği ve Özel Profil Alanları eklentisini kur',
		'INSTALL_GROUPS_ON_REGISTRATION_CONFIRM'		=> 'Kayıtta Grup Üyeliği ve Özel Profil Alanları eklentisini kurmaya hazır mısınız?',
		'GROUPS_ON_REGISTRATION'						=> 'Anketler Oy Verme Hatırlatma',
		'GROUPS_ON_REGISTRATION_EXPLAIN'				=> 'Anketler Oy Verme Hatırlatma eklentisi veritabanı değişikliklerini UMIL otomatik yöntemiyle kur.',
		'UNINSTALL_GROUPS_ON_REGISTRATION'				=> 'Kayıtta Grup Üyeliği ve Özel Profil Alanları eklentisini kaldır',
		'UNINSTALL_GROUPS_ON_REGISTRATION_CONFIRM'		=> 'Kayıtta Grup Üyeliği ve Özel Profil Alanları eklentisini kaldırmaya hazır mısınız? Bu eklenti tarafından yapılan tüm ayarlar ve eklenen veri kaldırılacaktır!',
		'UPDATE_GROUPS_ON_REGISTRATION'					=> 'Kayıtta Grup Üyeliği ve Özel Profil Alanları eklentisini güncelle',
		'UPDATE_GROUPS_ON_REGISTRATION_CONFIRM'			=> 'Kayıtta Grup Üyeliği ve Özel Profil Alanları eklentisini güncellemeye hazır mısınız?',

	));

?>