<?php
/**
*
* mods_info_acp_sitemap.php [﻿Standard French]
*
* @package language
* @version $Id: $
* @copyright (c) 2009 phpBB Group
* @author 2009-12-28 - phpBB-fr.com
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

$lang = array_merge($lang, array(
	'ACP_SITEMAP_INDEX_TITLE'	=> 'Sitemap FX',
	'ACP_SITEMAP'	=> 'Sitemap FX',
	'ACP_SITEMAP_SETTINGS'	=> 'Réglages Sitemap FX',
	'ACP_SITEMAP_SETTINGS_EXPLAIN'	=> 'Ici, vous pouvez modifier les réglages de Sitemap FX',
	'INSTALL_SITEMAP_FX_MOD'		=> 'Install Sitemap FX mod?',
	'LOG_SITEMAP_SETTINGS_CHANGED'	=> '<strong>Modification de Sitemap effectuées</strong>',
	'SITEMAP_ENABLE'	=> 'Activation de Sitemap',
	'SITEMAP_ENABLE_EXPLAIN'	=> 'Activer pour autoriser les moteurs de recherches à utiliser un sitemap',
	'SITEMAP_SETTINGS_CHANGED'	=> 'Modification de Sitemap FX effectuée.',
	'SITEMAP_PRIORITY_0'	=> 'Priorité pour les sujets par défaut',
	'SITEMAP_PRIORITY_1'	=> 'Priorité pour les post-it',
	'SITEMAP_PRIORITY_2'	=> 'Priorité pour les annonces',
	'SITEMAP_PRIORITY_3'	=> 'Priorité pour les annonces globales',
	'SITEMAP_PRIORITY_EXPLAIN'	=> 'Définir la valeur de priorité de recherche. Choisir une valeur entre 0 et 1 au dixième près en séparant la décimale par un point. Exemple, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_0_EXPLAIN'	=> 'Définir la valeur de priorité de recherche. Choisir une valeur entre 0 et 1 au dixième près en séparant la décimale par un point. Exemple, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_1_EXPLAIN'	=> 'Définir la valeur de priorité de recherche. Choisir une valeur entre 0 et 1 au dixième près en séparant la décimale par un point. Exemple, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_2_EXPLAIN'	=> 'Définir la valeur de priorité de recherche. Choisir une valeur entre 0 et 1 au dixième près en séparant la décimale par un point. Exemple, <strong>0.5</strong>.',
	'SITEMAP_PRIORITY_3_EXPLAIN'	=> 'Définir la valeur de priorité de recherche. Choisir une valeur entre 0 et 1 au dixième près en séparant la décimale par un point. Exemple, <strong>0.5</strong>.',
	'SITEMAP_FREQ_0'	=> 'Fréquence de rafraichissement pour les sujets par défaut',
	'SITEMAP_FREQ_1'	=> 'Fréquence de rafraichissement pour les post-it',
	'SITEMAP_FREQ_2'	=> 'Fréquence de rafraichissement pour les annonces',
	'SITEMAP_FREQ_3'	=> 'Fréquence de rafraichissement pour les annonces globales',
	'SITEMAP_FREQ_0_EXPLAIN'	=> 'Définir la fréquence de rafraichissement pour les sujets par défaut.',
	'SITEMAP_FREQ_1_EXPLAIN'	=> 'Définir la fréquence de rafraichissement pour les post-it.',
	'SITEMAP_FREQ_2_EXPLAIN'	=> 'Définir la fréquence de rafraichissement pour les annonces.',
	'SITEMAP_FREQ_3_EXPLAIN'	=> 'Définir la fréquence de rafraichissement pour les annonces globales.',
	'SITEMAP_FREQ_NEVER'	=> 'Jamais',
	'SITEMAP_FREQ_YEARLY'	=> 'Annuel',
	'SITEMAP_FREQ_MONTHLY'	=> 'Mensuel',
	'SITEMAP_FREQ_WEEKLY'	=> 'Hebdomadaire',
	'SITEMAP_FREQ_DAILY'	=> 'Quotidien',
	'SITEMAP_FREQ_HOURLY'	=> 'Horaire',
	'SITEMAP_FREQ_ALWAYS'	=> 'Toujours',
	'SITEMAP_CACHE_TIME'	=> 'Rafraichissement général du sitemap (en heures)',
	'SITEMAP_CACHE_TIME_EXPLAIN'	=> 'Durée de vie des fichiers du cache de Sitemap FX. Les fichiers du caches seront automatiquement recrées après la durée définie. Pendant cette durée, les moteurs de recherches utiliseront les fichiers du cache. Mettre une plus grande valeur pour réduire la charge du serveur.',
));

?>