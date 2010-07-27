<?php
/*
*
* bb3portal [English]
*
* @package phpBB3 Portal  a.k.a canverPortal  ( www.phpbb3portal.com )
* @version $Id: portal.php,v 1.6 2008/02/09 08:18:14 angelside Exp $
* @copyright (c) Canver Software - www.canversoft.net
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @translation by: YOU_NICK http://www.yourwebpage.tld  DATE
*/

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine


$lang = array_merge($lang, array(
	// General
	'PORTAL'				=> 'Portal',
	'WELCOME'				=> 'Welcome',

	// news & global announcements
	'LATEST_ANNOUNCEMENTS'	=> 'Latest global announcements',
	'LATEST_NEWS'			=> 'Latest news',
	'READ_FULL'				=> 'Read all',
	'NO_NEWS'				=> 'No news',
	'NO_ANNOUNCEMENTS'		=> 'No global announcements',
	'POSTED_BY'				=> 'Poster',
	'COMMENTS'				=> 'Comments',
	'VIEW_COMMENTS'			=> 'View comments',
	'POST_REPLY'			=> 'Write comments',
	'TOPIC_VIEWS'			=> 'Views',

	// who is online
	'WIO_TOTAL'			=> 'Total',
	'WIO_REGISTERED'	=> 'Registered',
	'WIO_HIDDEN'		=> 'Hidden',
	'WIO_GUEST'			=> 'Guest',
	//'RECORD_ONLINE_USERS'=> 'View record: <strong>%1$s</strong><br />%2$s',

	// user menu
	'USER_MENU'			=> 'User menu',
	'UM_LOG_ME_IN'		=> 'remember me',
	'UM_HIDE_ME'		=> 'hide me',
	'UM_MAIN_SUBSCRIBED'=> 'Subscribed',
	'UM_BOOKMARKS'		=> 'Bookmarks',

	// statistics
	'ST_NEW'		=> 'New',
	'ST_NEW_POSTS'	=> 'New post',
	'ST_NEW_TOPICS'	=> 'New topic',
	'ST_NEW_ANNS'	=> 'New announcment',
	'ST_NEW_STICKYS'=> 'New sticky',
	'ST_TOP'		=> 'Total',
	'ST_TOP_ANNS'	=> 'Total announcment',
	'ST_TOP_STICKYS'=> 'Total sticky',
	'ST_TOT_ATTACH'	=> 'Total attachments',

	// search
	'SH'		=> 'go',
	'SH_SITE'	=> 'forums',
	'SH_POSTS'	=> 'posts',
	'SH_AUTHOR'	=> 'author',
	'SH_ENGINE'	=> 'search engines',
	'SH_ADV'	=> 'advanced search',
	
	// recent
	'RECENT_TOPIC'		=> 'Recent topic',
	'RECENT_ANN'		=> 'Recent announcment',
	'RECENT_HOT_TOPIC'	=> 'Recent popular topic',

	// random member
	'RND_MEMBER'	=> 'Random member',
	'RND_JOIN'		=> 'Join',
	'RND_POSTS'		=> 'Posts',
	'RND_OCC'		=> 'Occupation',
	'RND_FROM'		=> 'Location',
	'RND_WWW'		=> 'Web page',

	// top poster
	'TOP_POSTER'	=> 'Top poster',

	// links
	'LINKS'	=> 'Affiliations',

	// latest members
	'LATEST_MEMBERS'	=> 'Latest members',

	// make donation
	'DONATION' 		=> 'Make donation',
	'DONATION_TEXT'	=> 'is a formation suplying services with no intention of any revenue. Anyone who wants to support this formation can do it by donating so that the cost of server, the domain and etc. could be paid of.',
	'PAY_MSG'		=> 'After selecting the amount which you want to donate from the menu, you can go on by clicking on the picture of PayPal.',
	'PAY_ITEM'		=> 'Make donation', // paypal item

	// main menu
	'M_MENU' 	=> 'Menu',
	'M_CONTENT'	=> 'Content',
	'M_HELP'	=> 'Help',
	'M_BBCODE'	=> 'BBCode FAQ',
	'M_TERMS'	=> 'Term of use',
	'M_PRV'		=> 'Privacy policy',
	'M_SEARCH'	=> 'Search',

	// link us
	'LINK_US'		=> 'Link to us',
	'LINK_US_TXT'	=> 'Please feel free to link to <strong>%s</strong>. Use the following HTML:',

	// friends
	'FRIENDS'				=> 'Friends',
	'FRIENDS_OFFLINE'		=> 'Offline',
	'FRIENDS_ONLINE'		=> 'Online',
	'NO_FRIENDS'			=> 'No friends currently defined',
	'NO_FRIENDS_OFFLINE'	=> 'No friends offline',
	'NO_FRIENDS_ONLINE'		=> 'No friends online',
	
	// last bots
	'LAST_VISITED_BOTS'		=> 'Last %s visited bots',
	
	// wordgraph
	'WORDGRAPH'				=> 'Wordgraph',

	// change style
	'BOARD_STYLE'			=> 'Board style',
	'STYLE_CHOOSE'			=> 'Select a style',
		
	// team
	'NO_ADMINISTRATORS_P'	=> 'No administrators',
	'NO_MODERATORS_P'		=> 'No moderators',

	// average Statistics
	'TOPICS_PER_DAY'	=> 'Topics per day',
	'POSTS_PER_DAY'	    => 'Posts per day',
	'USERS_PER_DAY'	    => 'Users per day',
	'TOPICS_PER_USER'	=> 'Topics per user',
	'POSTS_PER_USER'	=> 'Posts per user',
	'POSTS_PER_TOPIC'	=> 'Posts per topic',

	// poll
	'LATEST_POLLS'			=> 'Latest Polls',
	'NO_OPTIONS'			=> 'This poll has no available options.',
	'NO_POLL'				=> 'No polls available',
	'RETURN_PORTAL'			=> '%sReturn to the portal%s',

	// other
	'POLL'		=> 'Poll',
	'CLOCK'		=> 'Clock',
	'SPONSOR'	=> 'Sponsors',
	
	/**
	* DO NOT REMOVE or CHANGE
	*/
	'PORTAL_COPY'	=> 'Portal by <a href="http://www.phpbb3portal.com" title="phpBB3 Portal" target="_blank">phpBB3 Portal</a> &copy; <a href="http://www.phpbbturkiye.net" title="phpBB Türkiye" target="_blank">phpBB</a> Türkiye',
	)
);

// mini calendar
$lang = array_merge($lang, array(
	'Mini_Cal_calendar'		=> 'Calendar',
	'Mini_Cal_add_event'	=> 'Add Event',
	'Mini_Cal_events'		=> 'Upcoming Events',
	'Mini_Cal_no_events'	=> 'None',
	'Mini_cal_this_event'	=> 'This month holiday events',
	'View_next_month'		=> 'next month',
	'View_previous_month'	=> 'previous month',

// uses MySQL DATE_FORMAT - %c  long_month, numeric (1..12) - %e  Day of the long_month, numeric (0..31)
// see http://www.mysql.com/doc/D/a/Date_and_time_functions.html for more details
// currently supports: %a, %b, %c, %d, %e, %m, %y, %Y, %H, %k, %h, %l, %i, %s, %p
	'Mini_Cal_date_format'		=> '%b %e',
	'Mini_Cal_date_format_Time'	=> '%H:%i',

// if you change the first day of the week in constants.php, you should change values for the short day names accordingly
// e.g. FDOW = Sunday -> $lang['mini_cal']['day'][1] = 'Su'; ... $lang['mini_cal']['day'][7] = 'Sa'; 
//      FDOW = Monday -> $lang['mini_cal']['day'][1] = 'Mo'; ... $lang['mini_cal']['day'][7] = 'Su'; 
	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'Su',
			'2'	=> 'Mo',
			'3'	=> 'Tu',
			'4'	=> 'We',
			'5'	=> 'Th',
			'6'	=> 'Fr',
			'7'	=> 'Sa',
		),

		'month'	=> array(
			'1'	=> 'Jan',
			'2'	=> 'Feb',
			'3'	=> 'Mar',
			'4'	=> 'Apr',
			'5'	=> 'May',
			'6'	=> 'Jun',
			'7'	=> 'Jul',
			'8'	=> 'Aug',
			'9'	=> 'Sep',
			'10'=> 'Oct',
			'11'=> 'Nov',
			'12'=> 'Dec',
		),

		'long_month'=> array(
			'1'	=> 'January',
			'2'	=> 'February',
			'3'	=> 'March',
			'4'	=> 'April',
			'5'	=> 'May',
			'6'	=> 'June',
			'7'	=> 'July',
			'8'	=> 'August',
			'9'	=> 'September',
			'10'=> 'October',
			'11'=> 'November',
			'12'=> 'December',
		),
	),
));

?>