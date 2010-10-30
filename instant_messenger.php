<?php
/**
*
* @package phpBB3 instant messenger
* @version $Id: instant messenger.php 0.4.2
* @copyright (c) 2010 Gio Borje www.zerozaku.com
*
*/

/**
* @ignore
*/
if ( defined( 'IN_PHPBB'))
{
	define( 'IM_LOAD_ON_START', true);
}
else
{
	define('IN_PHPBB', true);

	$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
	$phpEx = substr(strrchr(__FILE__, '.'), 1);

	include_once($phpbb_root_path . 'common.' . $phpEx);
	include_once($phpbb_root_path . 'includes/functions_content.' . $phpEx);
	include_once($phpbb_root_path . 'includes/functions_display.' . $phpEx); 
	include_once($phpbb_root_path . 'includes/message_parser.' . $phpEx);        
}
// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

session_name( $user->data['session_id']);
session_id( $user->data['session_id']);
session_start();

//get the link hash for later use
$aid = request_var('aid', '');

/**
 * INITIAL SESSION SET
 */
if ( !isset( $_SESSION['username']) || empty( $_SESSION['username']) )
{
	$_SESSION['username'] = $user->data['username'];
} 
if ( !isset( $_SESSION['user_id']) || empty( $_SESSION['user_id']) )
{
	$_SESSION['user_id'] = $user->data['user_id'];
}  
if (!isset( $_SESSION['chatHistory']) )
{
  $_SESSION['chatHistory'] = array();	
}

if (!isset( $_SESSION['openChatBoxes']) )
{
  $_SESSION['openChatBoxes'] = array();	
}

if ( defined( 'IM_LOAD_ON_START'))
{
	showOnlineList();
}
$action = request_var('action', '', true);

switch( $action)
{
	case 'chatheartbeat':
		chatHeartbeat();
		break;
	case 'sendchat':
		sendChat();
		break;
	case 'closechat':
		closeChat();
		break;
	case 'startchatsession':
		startChatSession();
		break;
	case 'onlinelist':
		showOnlineList();
		break;
	case 'newposts':
		displayNewestPosts();
		break;
	case 'userstatus':
		user_status();
		break;
}

/**
 * Zakladni funkce chat, ktera kontroluje odeslane, prijate a neaktivni instant messenger boxy
 */
function chatHeartbeat()
{ 
	global $db, $user;	  

	/*
	 * Vyber zpravy nevyzvednute pro uzivatele
	 */
	$sql = 'SELECT im.*, u.username FROM ' . IM_TABLE . ' AS im, ' . USERS_TABLE . ' AS u
            WHERE ( im.to = ' . $_SESSION['user_id'] . ' AND im.from = u.user_id
              AND recd = 0)
            ORDER BY sent ASC';
	$result = $db->sql_query($sql);
	$items = '';

	$chatBoxes = array();

	while ($chat = $db->sql_fetchrow($result))
	{
		if (!isset($_SESSION['openChatBoxes'][$chat['from']]) && isset($_SESSION['chatHistory'][$chat['from']]))
		{
			$items = $_SESSION['chatHistory'][$chat['from']];
		}
     
		$chat['message'] = censor_text($chat['message']);
		$chat['message'] = preg_replace( '#\r?\n\r?#si', '<br />', $chat['message']);
		
		$item = '{"s":"0","f":"'.$chat['from'].'","f_name":"'.$chat['username'].'","m":"'.$chat['message'].'"},';
		$items .= $item;
		
		if (!isset($_SESSION['chatHistory'][$chat['from']]))
		{
			$_SESSION['chatHistory'][$chat['from']] = '';
		}
		
		$_SESSION['chatHistory'][$chat['from']] .= $item;
		
		unset($_SESSION['tsChatBoxes'][$chat['from']]);
		$_SESSION['openChatBoxes'][$chat['from']] = $chat['sent'];
	}

	if (!empty($_SESSION['openChatBoxes']))
	{
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $time)
		{
			if (!isset($_SESSION['tsChatBoxes'][$chatbox]))
			{
				$now = time()-$time;
				/*$time = date( 'd.m.Y', strtotime($time));*/
				$s_time = $user->format_date( $time, false, true);
				
				$message = $user->lang['CHAT_SENT'].$s_time;
				if ($now > 180)
				{
					$item = '{"s":"2","f":"'.$chatbox.'","m":"'.$message.'"},';
					$items .= $item;

					if (!isset($_SESSION['chatHistory'][$chatbox]))
					{
						$_SESSION['chatHistory'][$chatbox] = '';
					}
	
					$_SESSION['chatHistory'][$chatbox] .= $item;
					$_SESSION['tsChatBoxes'][$chatbox] = 1;
				}
			}
		}
	}

	$sql = 'UPDATE ' . IM_TABLE . '
          SET recd = 1
            WHERE ' . IM_TABLE . '.to = "'.$_SESSION['user_id'].'"
              AND recd = 0';
  	$result = $db->sql_query($sql);

	if ($items != '')
	{
		$items = substr($items, 0, -1);
	}
	
	header('Content-type: application/json');
	die( '{"items": ['.$items.']}');
}

function chatBoxSession($chatbox)
{
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

/*
 * Vytvoreni SESSION, otevrene boxy instant messengeru
 */
function startChatSession()
{
	$items = '';
	if (!empty($_SESSION['openChatBoxes']))
	{
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void)
		{
			$items .= chatBoxSession($chatbox);
		}
	}

	if ($items != '')
	{
		$items = substr($items, 0, -1);
	}

	header('Content-type: application/json');
	die( '{"username": "'.$_SESSION['username'].'", "items": ['.$items.']}');
}

/*
 * Ulozeni zpravy instant messengeru do DB
 */
function sendChat() {      
                    
	global $db, $aid;       
       
	 	//Verify link hash...
		
	if (!check_link_hash($aid, 'ajax'))
	{
		trigger_error('Invalid link hash');
	}
	
	$from = $_SESSION['user_id'];
	$to = request_var('uid', '', true);
	$to_name = request_var( 'uname', '', true);
	$message = request_var('message', '', true);

	$_SESSION['openChatBoxes'][$to] = time();
	
	$messagesan = censor_text($message);
	
	$messagesan = preg_replace( '#\r?\n\r?#si', '<br />', $messagesan);
	/*
	$messagesan = str_replace("\n\r","\n", $messagesan);
	$messagesan = str_replace("\r\n","\n", $messagesan);
	$messagesan = str_replace("\n","<br>", $messagesan);
	*/

	if (!isset($_SESSION['chatHistory'][$to]))
	{
    	$_SESSION['chatHistory'][$to] = '';
	}

	$_SESSION['chatHistory'][$to] .= '{"s": "1", "f": "'.$to.'", "f_name": "'.$to_name.'", "m": "'.$messagesan.'"},';

	unset($_SESSION['tsChatBoxes'][$to]); 

	$sql = 'INSERT INTO ' . IM_TABLE . '
            (' . IM_TABLE . '.from,' . IM_TABLE . '.to,message,sent)
              VALUES ("'.$from.'", "'.$to.'","'.$db->sql_escape($message).'",' . time() . ')';
//	$db->sql_return_on_error( true);
  	$result = $db->sql_query($sql);
	die( "true");
}

/*
 * Uzavreni SESSION instant messengeru
 */
function closeChat()
{
	$chatbox = request_var('chatbox', '', true);
	unset($_SESSION['openChatBoxes'][$chatbox]);
	
	die( "1");
}    

function showOnlineList()
{
	global $phpbb_root_path, $phpEx, $config;
	global $user, $template, $db, $auth;
	/**
	* List of online registered users for Instant messenger
	*/ 
  
	// If ANONYMOUS return empty string
	if ($user->data['user_id'] == ANONYMOUS) 
 	{ 
 		return;
 	}

 	include_once($phpbb_root_path . 'includes/functions_display.' . $phpEx);
    
    $online_time = 300;
    
    $where_in_only_friends = '';
    if ( $config['im_only_friends'] == 1)
    {
    	$sql = 'SELECT zebra_id, user_id FROM ' . ZEBRA_TABLE . '
    			WHERE friend = 1 ' .
    				"AND ( user_id = {$user->data['user_id']} OR zebra_id = {$user->data['user_id']} )"; // MY FRIENDS OR I HAVE BEEN FRIEND BY
    	$result = $db->sql_query( $sql);

    	$friends_ary = array();
    	while( $row = $db->sql_fetchrow( $result))
    	{
    		$friends_ary[] = $row['zebra_id'];
    		$friends_ary[] = $row['user_id'];
    	}
    	$db->sql_freeresult( $result);
    	$where_in_only_friends = ' AND ' . $db->sql_in_set( 'u.user_id', $friends_ary, false, true);
    }
    
    $sql = 'SELECT u.user_id, u.user_type, u.username, u.user_avatar, u.user_avatar_type, s.session_user_id, s.session_time, ims.user_deny_im, ims.user_status
    	FROM ' . SESSIONS_TABLE . ' AS s, ' . USERS_TABLE . ' AS u LEFT OUTER JOIN ' . USERS_IM_TABLE . ' AS ims ON ims.user_id = u.user_id
    	WHERE u.user_id = s.session_user_id
    		AND s.session_time >= ' . (time() - $online_time) . '
    		AND s.session_user_id <> ' . ANONYMOUS . '
    		AND u.user_id <> ' .$user->data['user_id'] . ' 
			AND u.user_type <> 2 ' . $where_in_only_friends . '         
    	ORDER BY u.username ASC';
	$result = $db->sql_query($sql);

	$show_uids_arr = array();
    while ($row = $db->sql_fetchrow($result))
    {            
    	if ( $row['user_deny_im'] == 1 || in_array( $row['user_id'], $show_uids_arr) )
    	{
    		continue;
    	}

    	$show_uids_arr[] = $row['user_id'];
		if ($row['session_time'] >= time() - 180) 
		{
			$img_status = $phpbb_root_path .'styles/'.$user->theme['theme_path'].'/theme/images/im_online.gif';
		}
		else
		{
			$img_status = $phpbb_root_path .'styles/'.$user->theme['theme_path'].'/theme/images/im_away.gif';
		}
		
		$template->assign_block_vars('online_row', array(
    		'AVATAR'		=> (!empty($row['user_avatar'])) ? get_user_avatar($row['user_avatar'], $row['user_avatar_type'], 22, 22) : '<img src="' . $phpbb_root_path .'/styles/'.$user->theme['theme_path'].'/theme/images/im_no_avatar.gif" width="22" height="22" />',
    		'IMG_STATUS'	=> $img_status,
    		'STATUS'		=> '<img src="' . $img_status . '" width="7" height="7" class="im_status" />',
		
    		'USERNAME'		=> $row['username'],
			'USER_ID'		=> $row['user_id'],      
    	));  
    	
    }

    $db->sql_freeresult($result);      
      
    if ( ! defined( 'IM_LOAD_ON_START'))
    {
		$template->set_filenames( array( 'body' => 'instant_messenger_online_body.html'));
	  
		page_header();
		page_footer();
    }
}

function displayNewestPosts()
{
	global $template, $db, $auth, $phpbb_root_path, $phpEx;
    /*
    * Display new posts
    */                  
    $posts_ary = array(
      'SELECT' => 'p.*, t.*, u.username, u.user_colour',
      'FROM' => array(
        POSTS_TABLE => 'p',
      ),
      'LEFT_JOIN' => array(
      array(
        'FROM' => array(USERS_TABLE => 'u'),
        'ON' => 'u.user_id = p.poster_id'
      ),
      array(
        'FROM' => array(TOPICS_TABLE => 't'),
        'ON' => 'p.topic_id = t.topic_id'
      ),
      ),
  
      'WHERE' => $db->sql_in_set('t.forum_id', array_keys($auth->acl_getf('f_read', true))) . '
        AND t.topic_status <> ' . ITEM_MOVED . '
        AND t.topic_approved = 1',
        'ORDER_BY' => 'p.post_id DESC',
      );
  
	$posts = $db->sql_build_query('SELECT', $posts_ary);
  
	$posts_result = $db->sql_query_limit($posts, 10);
  
	while ($posts_row = $db->sql_fetchrow($posts_result))
	{
        $topic_title = $posts_row['post_subject'];
        $post_author = get_username_string('full', $posts_row['poster_id'], $posts_row['username'], $posts_row['user_colour']);
        $post_link = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "p=" . $posts_row['post_id'] . "#p" . $posts_row['post_id']);
    
        $template->assign_block_vars('new_posts', array(
			'TOPIC_TITLE' => $topic_title,
			'POST_AUTHOR' => $post_author,
			'POST_LINK' => $post_link,
        ));
	}		       

	$template->set_filenames( array('body' => 'instant_messenger_newposts.html'));
	page_header();
	page_footer();
	
}

function user_status()
{
	global $db, $user, $aid;

	if($user->data['user_id'] != ANONYMOUS)
	{
		$mode	= request_var('mode', 'add');
		
		$sql = 'SELECT user_id FROM ' . USERS_IM_TABLE . ' WHERE user_id = ' . (int) $user->data['user_id'];
		
		$rs = $db->sql_query( $sql);
		$row = $db->sql_fetchrow( $rs);
		
		//Verify link hash...
		
		if (!check_link_hash($aid, 'ajax'))
		{
			trigger_error('Invalid link hash');
		}
		
		switch ($mode)
		{
			case 'add':
				$status_text = filter_var($db->sql_escape(request_var('status_text','',true)), FILTER_SANITIZE_STRING);
				
				$illegal_statuses = array('administrator', 'moderator', 'admin', 'mod', 'developer', 'dev', 'staff');
				if (in_array(strtolower($status_text), $illegal_statuses)) 
				{
				    break;
				}
				
				if ($status_text != '' && strlen($status_text) < 91)
				{
					$time = time();
					$sql_update = 'UPDATE ' . USERS_IM_TABLE . "
							SET user_status = '{$status_text}', user_lastchange = '{$time}'" . '
							WHERE user_id = ' . $user->data['user_id'];
					$sql_insert = 'INSERT INTO ' . USERS_IM_TABLE . " (user_id, user_status) VALUES ('{$user->data['user_id']}', '{$status_text}')";
				}
				break;
			case 'delete':
				$status_text = '';
				$sql_update = 'UPDATE ' . USERS_IM_TABLE . '
						SET user_status = null
						WHERE user_id = ' . $user->data['user_id'];
				$sql_insert = 'INSERT INTO ' . USERS_IM_TABLE . " (user_id, user_status) VALUES ('{$user->data['user_id']}', null)";
				break;
		}
	
		if (!$db->sql_query($row['user_id'] == $user->data['user_id'] ? $sql_update : $sql_insert))
		{
			die( 'false');
		}
		
		die ('true');
	}
}

/*
function prune_chat()
{
	global $db, $user;
	
	if ($user->data['user_type'] != USER_FOUNDER)
  {
    redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
  }
  
  $time = time() - 21600; // 6 hours ago

	$sql = 'DELETE FROM ' . IM_TABLE . '
			WHERE sent < ' . $time . '
      AND recd = 1';
		$db->sql_query($sql);
}
*/

?>    