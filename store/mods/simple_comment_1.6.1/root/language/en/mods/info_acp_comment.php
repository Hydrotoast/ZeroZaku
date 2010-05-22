<?php
/**
*
* @author platinum_2007 (Ian Taylor) iantaylor603@gmail.com
* @package umil
* @version $Id simple_comment_install.php 1.6.1-RC 2009-03-22 16:56:28GMT platinum_2007 $
* @copyright (c) 2009 ian taylor
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
    'ACP_COMMENT_INDEX_TITLE'                       => 'Simple comment mod',
    'ACP_COMMENT'                       			=> 'Simple comment mod',
	'ENABLE_COMMENT'								=> 'Enable comments',
	'ENABLE_QC'										=> 'Enable quick comments',
	'COMM_PER_PAGE'									=> 'Comments per page',
	'COMM_PER_PAGE_EXPLAIN'							=> 'Amount of comments to display on each pagination',
	'AVATAR_SIZE'									=>	'Avatar Size',
	'AVATAR_SIZE_EXPLAIN'							=>	'Size of the avatar on comment page',
	'COMMENT_AUTHOR'								=>  'Username',
	'COMMENT'										=> 	'Comment',
	'COMMENT_DATE'									=>  'date',
	'STATUS_DELETE'									=>	'delete',
	'COMMENT_DELETE'								=>	'delete',

	'COMMENT_TITLE'									=> 'Comment mod control panel',
    'DATABASE_HAS'									=> 'Your database has',
    'STORED_COMMENTS'								=> 'comment\'s stored',
    'MASS_DELETE'									=> 'Mass delete user comment',
    'MASS_DELETE_EXPLAIN'							=> 'Enter the user id to delete all the users comments<br/> <font color="red">This action will delete all of a specific users comments and cannot be undone!</font>',

));
?>