<?php
/**
* @package Terms
* @copyright (c) 2010 Gio Borje
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * Gets the terms specified by the topic author or moderators
 * @param $topic_id the id of the topic that contains the terms
 * @return an string of terms specified by the topic
 */
function getTerms($topic_id)
{
    global $db;
    
    $sql = 'SELECT t.term_name
    	FROM ' . TERMS_TABLE . ' as t
    	JOIN ' . TERMMAP_TABLE . ' as tm 
    		ON tm.term_id = t.term_id
    	WHERE tm.topic_id = ' . (int) $topic_id . '
    	LIMIT 5';
    $result = $db->sql_query($sql);
	
    $terms = array();
    while ($row = $db->sql_fetchrow($result))
    {
        $terms[] = $row['term_name'];
    }

    $db->sql_freeresult($result);

    return $terms;
}

?>