<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ADVANCED */

define('SET_SESSION_NAME','');			// Session name
define('DO_NOT_START_SESSION','0');		// Set to 1 if you have already started the session
define('DO_NOT_DESTROY_SESSION','0');	// Set to 1 if you do not want to destroy session on logout
define('SWITCH_ENABLED','1');		
define('INCLUDE_JQUERY','1');	
define('FORCE_MAGIC_QUOTES','0');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* DATABASE */

include_once dirname(dirname(__FILE__))."/config.php";

// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW

define('DB_SERVER',					$dbhost									);
define('DB_PORT',					'3306'									);
define('DB_USERNAME',				$dbuser									);
define('DB_PASSWORD',				$dbpasswd								);
define('DB_NAME',					$dbname									);
define('TABLE_PREFIX',				$table_prefix							);
define('DB_USERTABLE',				'users'									);
define('DB_USERTABLE_NAME',			'username'								);
define('DB_USERTABLE_USERID',		'user_id'								);
define('DB_USERTABLE_LASTACTIVITY',	'lastactivity'							);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* FUNCTIONS */

function getUserID() {
	$userid = 0;

	$sql = ("select config_value c from ".TABLE_PREFIX."config where config_name = 'cookie_name'");
	$query = mysql_query($sql);
	$cookie = mysql_fetch_array($query);

	if (!empty($_COOKIE[$cookie['c'].'_sid'])) {
		$sql = ("select session_user_id from ".TABLE_PREFIX."sessions where session_id = '".mysql_real_escape_string($_COOKIE[$cookie['c'].'_sid'])."'");
		$query = mysql_query($sql);
		$session = mysql_fetch_array($query);
		if ($session['session_user_id'] != 1) {
			$userid = $session['session_user_id'];
		}
	}

	return $userid;
}


function getFriendsList($userid,$time) {
	$sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX."sessions.session_time lastactivity, ".TABLE_PREFIX.DB_USERTABLE.".user_avatar avatar, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." link, cometchat_status.message, cometchat_status.status from ".TABLE_PREFIX."zebra join ".TABLE_PREFIX.DB_USERTABLE." on  ".TABLE_PREFIX."zebra.zebra_id = ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid left join ".TABLE_PREFIX."sessions on  ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." =  ".TABLE_PREFIX."sessions.session_user_id  where ".TABLE_PREFIX."zebra.user_id = '".mysql_real_escape_string($userid)."' and ".TABLE_PREFIX."zebra.friend = 1 and ".TABLE_PREFIX."zebra.foe = 0 order by username asc");

	if (defined('DISPLAY_ALL_USERS') && DISPLAY_ALL_USERS == 1) {
		$sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX."sessions.session_time lastactivity, ".TABLE_PREFIX.DB_USERTABLE.".user_avatar avatar, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." link, cometchat_status.message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid left join ".TABLE_PREFIX."sessions on  ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." =  ".TABLE_PREFIX."sessions.session_user_id  where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." <> '".mysql_real_escape_string($userid)."' and ('".$time."'-".TABLE_PREFIX."sessions.session_time <'".((ONLINE_TIMEOUT)*2)."') order by username asc");
	} 

	return $sql; 
}

function getUserDetails($userid) {
	$sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX."sessions.session_time lastactivity,  ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." link,  ".TABLE_PREFIX.DB_USERTABLE.".user_avatar avatar, cometchat_status.message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid left join ".TABLE_PREFIX."sessions on  ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." =  ".TABLE_PREFIX."sessions.session_user_id where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
	return $sql;
}

function updateLastActivity($userid) {
	$sql = ("update `".TABLE_PREFIX."sessions` set session_time = '".getTimeStamp()."' where session_user_id = '".mysql_real_escape_string($userid)."'");
	return $sql; 
}

function getUserStatus($userid) {
	 $sql = ("select cometchat_status.message, cometchat_status.status from cometchat_status where userid = '".mysql_real_escape_string($userid)."'");
	 return $sql;
}

function getLink($link) {
    return BASE_URL.'../memberlist.php?mode=viewprofile&u='.$link;
}

function getAvatar($image) {

	if (preg_match('/http:/',$image)) {
		return $image;
	} else if (is_file(dirname(dirname(__FILE__)).'/images/avatars/gallery/'.$image)) {
		return BASE_URL.'../images/avatars/gallery/'.$image;
	} else if (!empty($image)) {
		return BASE_URL.'../download/file.php?avatar='.$image;
	} else {
		return BASE_URL.'../images/spacer.gif';
	}
}


function getTimeStamp() {
	return time();
}

function processTime($time) {
	return $time;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* HOOKS */

function hooks_statusupdate($userid,$statusmessage) {
	
}

function hooks_forcefriends() {
	
}

function hooks_activityupdate($userid,$status) {

}

function hooks_message($userid,$unsanitizedmessage) {
	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* LICENSE */

include_once(dirname(__FILE__).'/license.php');
$x="\x62a\x73\x656\x34\x5fd\x65c\157\144\x65";
eval($x('JHI9ZXhwbG9kZSgnLScsJGxpY2Vuc2VrZXkpOyRwXz0wO2lmKCFlbXB0eSgkclsyXSkpJHBfPWludHZhbChwcmVnX3JlcGxhY2UoIi9bXjAtOV0vIiwnJywkclsyXSkpOw'));

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////