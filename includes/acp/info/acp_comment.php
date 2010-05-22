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
if (!defined('IN_PHPBB'))
{
	exit;
}
class acp_comment_info
{
    function module()
    {
        return array(
            'filename'    => 'acp_comment',
            'title'        => 'ACP_COMMENT',
            'version'    => '1.6.1',
            'modes'        => array(
            'index'        => array('title' => 'ACP_COMMENT_INDEX_TITLE', 'auth' => 'acl_a_board', 'cat' => array('ACP_CAT_DOT_MODS')),
            ),
        );
    }

    function install()
    {
    }

    function uninstall()
    {
    }
}
?>