<?php
##############################################################
# FILENAME  : lang_factions.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
   exit;
}

if ( empty ( $lang ) || !is_array ( $lang ) )
{
	$lang	= array ( );
}

$lang	= array_merge ( $lang, array (
	'ADMIN_NO_ONGOING'				=> 'Clan has no on-going matches.',
	'ALL'							=> 'All',
	'ADD_GROUP_TO_LADDER'			=> 'Add Clan to Ladder',
	'ADD_GROUP_TO_TOURNAMENT'		=> 'Add Clan to Tournament',
	'ARCHIVED_TOURNAMENTS'			=> 'Archived Tournaments',
	'ARCHIVE_TOURNAMENT'			=> 'Archive Tournament?',
	'ACCEPT'						=> 'Accept',
	'ADD_CHALLENGE'					=> 'Add a Challenge',
	'ADD_GROUP'						=> 'Create a Clan',
	'ADD_LADDER'					=> 'Add a Ladder',
	'ADD_PLATFORM'					=> 'Add a Platform',
	'ADD_SUBLADDER'					=> 'Add a Sub-Ladder',
	'ADD_TOURNAMENT'				=> 'Add a Tournament',
	'ADD_TO_MATCH_FINDER'			=> 'Add Your Clan to the Match Finder for',
	'ALREADY_IN_LADDER'				=> 'Your clan is already joined with this ladder.',
	'ALREADY_IN_TOURNAMENT'			=> 'Your clan is aleady signed up with this tournament',
	'ASSIGN_AS_BACKUP'				=> 'Assign as Backup Leader',
	'ASSIGN_AS_LEADER'				=> 'Assign as Leader',

	'BRACKETS_CANT_GENERATE'		=> 'The brackets can not be generated because all the clans have not signed up yet or the tournament has not yet been started by the administrator.',
	'BEST_RANK'						=> 'Best Rank',
	'BYE_GROUP'						=> 'BYE clan used in tournaments.',

	'CANT_INVITE_YOURSELF'			=> 'You can not invite yourself!',
	'CHALLENGE'						=> 'Challenge',
	'CHALLENGES_UPDATED'			=> 'The challenges have been updated.',
	'CHALLENGE_ADDED'				=> 'The challenge has been made.',
	'CHEATER'						=> 'Trying to cheat? Because you cannot challenge yourself!',
	'CHEATING'						=> 'Cheating',
	'CHALLENGE_UNRANKED'			=> 'Unranked',

	'GROUP_NOTINVITED'				=> 'Your group has not been invited to join this tournament.',
	'GROUP_MOVED'					=> 'The clan has been moved to the new ladder.',
	'GROUP_ADDED'					=> 'The clan has been created, you may now login to the clan.',
	'GROUP_REMOVED_TOURNAMENT'		=> 'The clan has been removed from the tournament.',
	'GROUP_DESC'					=> 'Clan Information',
	'GROUP_ID'						=> 'Clan ID',
	'GROUP_INFORMATION'				=> 'Clan Information',
	'GROUP_LADDER'					=> 'Clan Ladder',
	'GROUP_LEADER'					=> 'Clan Leader',
	'GROUP_LOGIN'					=> 'Clan Login',
	'GROUP_LOGO'					=> 'Clan Logo',
	'GROUP_LOSSES'					=> 'Clan Losses',
	'GROUP_MEMBERS'					=> 'Clan Members',
	'GROUP_NAME'					=> 'Clan Name',
	'GROUP_NOTIN_LADDER'			=> 'Sorry, before you can use this feature, you must first join a ladder.',
	'GROUP_NOTSIGNED_UP_LADDER'		=> 'Your clan is not a part of this ladder. You can not sign up.',
	'GROUP_SCORE'					=> 'Clan Score',
	'GROUP_SIGNED_UP'				=> 'Your clan is now signed up to the tournament.',
	'GROUP_STREAK'					=> 'Clan Streak',
	'GROUP_TAG'						=> 'Clan Tag',
	'GROUP_UPDATED'					=> 'The clan has been updated.',
	'GROUP_WINS'					=> 'Clan Wins',
	'CONFIGUREATION_UPDATED'		=> 'The configuration has been updated.',
	'CONFIGURE_FACTIONS'				=> 'Configure Factions',
	'CURRENT_RANK'					=> 'Rank',
	'CURRENT_SEASON'				=> 'Current Season',
	'CONFIRM_WIN'					=> 'Confirm Win',
	'CONTEST_RESULT'				=> 'Contest Result',
	'CONFIGURATION_NOT_COMPLETE'	=> 'You have not set your forum\'s BYE clan. Please do so on the Factions configure page.',

	'DECLINE'						=> 'Decline',
	'DETAILS'						=> 'Details',

	'ELO'							=> 'ELO',
	'EDIT_BRACKETS'					=> 'Edit Brackets',
	'END_SEASON'					=> 'End Season',
	'EDIT_GROUP'					=> 'Edit Clan',
	'EDIT_SEASON'					=> 'Edit Season',
	'EDIT_GROUPS'					=> 'Edit Clans',
	'EDIT_FINISHED'					=> 'Edit Finished Matches',
	'EDIT_TOURNAMENT'				=> 'Edit Tournament',
	'EDIT_TOURNAMENTS'				=> 'Edit Tournaments',
	'ENTER_GROUP_NAME'				=> 'You must enter a clan name before creating your clan.',
	'EXTENSION_NOT_ALLOWED'			=> 'The extension of the file you are trying to upload is not allowed.',
	'EXTRA'							=> 'Details',

	'FILTER'						=> 'Filter',
	'FINAL_ROUND'					=> 'Finals',
	'FIND_GROUP'					=> 'Find Clan',
	'FINISHED'						=> 'Finished',
	'FINISHED_MATCHES'				=> 'Finished Matches',

	'INSTALLER_COMPLETE'			=> 'phpBB Factions installation is now complete. Be sure to read and follow the instructions found in install.xml to make the proper file changes to your phpBB core. You may now delete the install directory.
<br /><br />
Thank you for choosing phpBB Factions,
A.I. BOT',
	'INVITE_ONLY'					=> 'Invitation Only',
	'INVITED_CLANS'					=> 'Invited Clan IDs (one per line)',
	'INSTALLER_FOUNDER'				=> 'Sorry, you must be the board founder to run this installation script.',
	'INSTALLER_MF'					=> 'One or more modules failed to install. Please remove any phpBB Factions modules from your phpBB ACP.',
	'INSTALL_OR_UPGRADE'			=> 'Do you wish to install or upgrade Factions? Click Yes for "Install" and No for "Upgrade".',
	'INVITE_USER'					=> 'Invite a User',
	'ISSUE_A_TICKET'				=> 'Issue a Ticket',

	'JOINED_GROUP'					=> 'You are now a part of this clan. Welcome!',
	'JOINED_WITH_LADDER'			=> 'Your clan is now joined with this ladder.',
	'JOIN_LADDER'					=> 'Join Ladder?',

	'LADDER_STRING_FORMAT'			=> 'P: %s, L: %, S: %',
	'LAST_RANK'						=> 'Last Rank',
	'LADDER_RANKING'				=> 'Ladder Ranking System',
	'LADDER'						=> 'Ladder',
	'LADDER_JOIN_LOCKED'			=> 'Sorry, you can not leave this ladder. It has been locked by the administrator.',
	'LADDERS'						=> 'Ladders',
	'LADDER_ADDED'					=> 'The ladder has been added.',
	'LADDER_GROUP_ID'				=> 'ID',
	'LADDER_CL'						=> 'Show Challenge Link in Ladder?',
	'LADDER_TYPE'					=> 'Ladder Type',
	'LADDER_RESET_STATS'			=> 'Reset Statistics?',
	'LADDER_RM'						=> 'Required Members',
	'LADDER_GROUP_LOSSES'			=> 'Losses',
	'LADDER_GROUP_NAME'				=> 'Clan Name',
	'LADDER_GROUP_SCORE'			=> 'Score',
	'LADDER_GROUP_STREAK'			=> 'Streak',
	'LADDER_GROUP_WINS'				=> 'Wins',
	'LADDER_MOVED'					=> 'The ladder\'s position has been moved.',
	'LADDER_NAME'					=> 'Ladder Name',
	'REQUIRED_MEMBERS_FAILED'		=> 'Sorry, your clan does not meet the required members of %s.',
	'LADDER_PARENT'					=> 'Parent Ladder',
	'LADDER_PLATFORM'				=> 'Ladder Platform',
	'LADDER_RULES'					=> 'Ladder Rules',
	'LADDER_UPDATED'				=> 'The ladder has been updated.',
	'LEAVE_LADDER'					=> 'Leave Ladder?',
	'LEFT_LADDER'					=> 'Your clan has left the ladder.',
	'LEFT_TO_RIGHT'					=> 'Left to Right',
	'LOSER'							=> 'Looser',
	'LOSER_BRACKET'					=> 'Loser Bracket',
	'LOSS'							=> 'Loss',
	'LADDER_RADIO_LOCKED'			=> 'Unlocked',
	'LADDER_RADIO_LOCKED2'			=> 'Locked',
	'LADDER_LOCKED'					=> 'Ladder Locked',

	'MANAGE_MEMBERS'				=> 'Manage Members',
	'MANAGE_TOURNAMENTS'			=> 'Manage Tournaments',
	'MATCHCOMM'						=> 'MatchComm',
	'MATCHCOMM_MESSAGE'				=> 'Message',
	'MATCHCOMM_NOTE'				=> 'MatchComm updates automatically every 5 seconds. Be patient when posting a message.',
	'MATCHCOMM_UNREAD'				=> 'Unread Messages',
	'MATCHCOMM_WRONG_MATCH'			=> 'Your clan is not a part of this match. You can not send a message.',
	'MATCHES'						=> 'Matches',
	'MATCH_FINDER'					=> 'Match Finder',
	'MATCH_FINDER_ADDED'			=> 'Your clan has been added to the match finder. Any clan who challenges you will show up in your "Manage Challenges" page of the Clan CP.',
	'MATCH_HISTORY'					=> 'Match History',
	'MATCH_REPORTED'				=> 'The match has been reported.',
	'MATCH_RESULTS'					=> 'Match Results',
	'MATCH_WITHIN'					=> 'Match Within Next',
	'MEMBER_ASSIGNED_AS_BACKUP'		=> 'The member has been assigned as a backup leader.',
	'MEMBER_ASSIGNED_AS_LEADER'		=> 'The member has been assigned as the new leader.',
	'MEMBER_REMOVED'				=> 'The member has been removed.',
	'MOVE_DOWN'						=> 'Swap Down',
	'MOVE_RIGHT'					=> 'Move Forward',
	'MOVE_LEFT'						=> 'Move Back',
	'MOVE_UP'						=> 'Swap Up',
	'MUST_ADD_PLATFORM'				=> 'Sorry, you must first add a platform before you can add a ladder.',
	'MOVE_STATS'					=> 'Move all stats as well?',
	'MOVE_GROUP_LADDER'				=> 'Move Clan to Ladder',

	'NO_REPORTED_MATCHES'			=> 'There are no reported matches.',
	'NO_UNREPORTED_MATCHES'			=> 'There are no unreported matches.',
	'NONEXISTANT_GROUP'				=> 'The clan you have requested does not exist.',
	'NONEXISTANT_GROUP2'			=> 'The clan you have requested does not exist in the chosen ladder.',
	'NOT_READY'						=> 'Not Ready',
	'NO_ADMIN'						=> 'Sorry, you can not access this page because you are not an administrator of this site.',
	'NO_ARCHIVED_TOURNAMENTS'		=> 'There are no archived tournaments.',
	'NO_GROUPSIN_LADDER'			=> 'There are no clans currently joined with this ladder.',
	'NO_GROUPS_FOUND'				=> 'Sorry, no clans have been found for that input query.',
	'NO_GROUPS_MATCH_FINDER'		=> 'There are no clans open for a challenge for this time slot.',
	'NO_MATCHCOMMS'					=> 'There are currently no MatchComms. Your clan is not a part of any on-going matches.',
	'NO_MATCHES'					=> 'This clan has not yet participated in any matches.',
	'NO_MEMBERS'					=> 'No members are a part of this clan.',
	'NO_REPORT_READY'				=> 'You can not report yet.',
	'NO_ONGOING_MATCHES'			=> 'There are currently no on-going matches.',
	'NO_OTHER_GROUPS'				=> 'You have no other clans.',
	'NO_PENDING_MATCHES'			=> 'There are currently no pending challenges.',
	'NO_PENDING_MEMBERS'			=> 'No pending members.',
	'NO_SHOW'						=> 'No Show',
	'NO_SUBLADDERS'					=> 'There are no sub-ladders joined with this ladder.',
	'NO_TOURNAMENTS'				=> 'No tournaments are currently running.',
	'NUMBER_OF_GROUPS'				=> 'Number of Clans',
	'NUM_GROUPS'					=> 'Clans',

	'ONGOING'						=> 'On-Going',
	'ONGOING_MATCHES'				=> 'On-Going Matches',
	'OTHER'							=> 'Other',
	'OTHER_TYPE'					=> 'Other',

	'PENDING'						=> 'Pending',
	'PENDING_MATCHES'				=> 'Pending Challenges',
	'PENDING_MEMBERS'				=> 'Pending Members',
	'PLATFORM'						=> 'Platform',
	'PLATFORMS'						=> 'Platforms',
	'PLATFORM_ADDED'				=> 'The platform has been added.',
	'PLATFORM_NAME'					=> 'Platform Name',
	'PLATFORM_UPDATE'				=> 'The platform has been deleted.',
	'PMWINCONFIRMED'				=> '[SYSTEM] Win Confirmed',
	'PMWINCONFIRMEDTXT'				=> 'This is an automated message from the system.

[b]%s[/b] confirmed your win.

Do not reply to this username,
Thanks.',
	'PM_TOURNAMENTINVITE'			=> '[SYSTEM] Tournament Invitation',
	'PM_TOURNAMENTINVITETXT'		=> 'This is an automated message from the system.

Your clan has been invited to join the [b]%s[/b] tournament. If you accept, click [url=%s%s%s/%s]Yes[/url]

Do not reply to this username,
Thanks.',

	'PMCONFIRMWIN'					=> '[SYSTEM] Confirm Win',
	'PMCONFIRMWINTXT'				=> 'This is an automated message from the system.

[b]%s[/b] reported a win against you. You need to confirm this win in Matches Manager under the Clan Control Panel or, if they did not win, you may contest the result.

Do not reply to this username,
Thanks.',
	'PMPENDINGMEMBERTXT'			=> 'This is an automated message from the system.

[b]%s[/b] is requesting to join you clan, %s. You can approve or deny this request in the Clan Control Panel under Manage Members.

Do not reply to this username,
Thanks.',
	'PMPENDINGMEMBER'				=> '[SYSTEM] Member Request',
	'PMINTVITETXT'					=> 'This is an automated message from the system.

[b]%s[/b] has invited you to join their clan. Do you accept ?
[url=%s%s%s/%s]Yes[/url] or [url=%s%s%s/%s]No[/url]

Do not reply to this username,
Thanks.',
	'PMINVITE'						=> '[SYSTEM] Clan Invitation',
	'PMREQUEST_APPROVED'			=> '[SYSTEM] Request Approved',
	'PMREQUEST_APPROVEDTXT'			=> 'This is an automated message from the system.

[b]%s[/b] has approved your request to join their clan. Welcome :).

Do not reply to this username,
Thank you.',
	'PMREQUEST_DECLINED'			=> '[SYSTEM] Request Declined',
	'PMREQUEST_DECLINEDTXT'			=> 'This is an automated message from the system.

[b]%s[/b] has declined your request to join their clan. Sorry :(.

Do not reply to this username,
Thank you.',
	'PMTICKET'						=> '[SYSTEM] Ticket',
	'PMTICKETTXT'					=> 'This is an automated message from the system.

[url=%s%s%s/factions.php?action=group_profile&amp;clan_id=%s]%s[/url] has sent a ticket.

[quote]%s[/quote]

[url]%s%s%s/%s[/url]',
	'PM_TREPORTED'					=> '[SYSTEM] Tournament Match Confirmed',
	'PM_TREPORTEDTXT'				=> 'This is an automated message from the system.

[b]%s[/b] has confirmed that you have won in the tournament, [b]%s[/b]. Congradulations, you have moved forward in the brackets.

Do not reply to this username,
Thank you.',
	'PM_TREPORT'					=> '[SYSTEM] Confirm Win',
	'PM_TREPORTTXT'					=> 'This is an automated message from the system.

[b]%s[/b] has reported a win against your clan in the tournament, [b]%s[/b].

You must confirm that [b]%s[/b] won or contest the result to complete the report.

Do not reply to this username,
Thank you.',
	'PM_CHALLENGEDELETED'			=> '[SYSTEM] Challenge Deleted',
	'PM_CHALLENGEDELETEDTXT'		=> 'This is an automated message from the system.

The challenge you made to [b]%s[/b] has been deleted because it was not accepted or declined by [b]%s[/b] within 24 hours.

Do not reply to this username,
Thank you.',
	'PM_CHALLENGE'					=> '[SYSTEM] Challenge Issued by %s',
	'PM_CHALLENGEACCEPTED'			=> '[SYSTEM] Challenge Accepted',
	'PM_CHALLENGEACCEPTEDTXT'		=> 'This is an automated message from the system.

[b]%s[/b] has accepted your challenge.

Do not reply to this username,
Thank you.',
	'PM_CHALLENGEDECLINED'			=> '[SYSTEM] Challenge Declined',
	'PM_CHALLENGEDECLINEDTXT'		=> 'This is an automated message from the system.

[b]%s[/b] has declined your challenge.

Do not reply to this username,
Thank you.',
	'PM_CHALLENGETXT'				=> 'This is an automated message from the system.

[b][url=%s%s%s/factions.php?action=group_profile&clan_id=%s]%s[/url][/b] (P: %s, L: %s, S: %s) has issued you a challenge. Please login to your Clan CP and either accept or decline the challenge when ready.

Do not reply to this username,
Thank you.',
	'PM_CHALLENGETXT2'				=> 'This is an automated message from the system.

[b][url=%s%s%s/factions.php?action=group_profile&clan_id=%s]%s[/url][/b] (P: %s, L: %s, S: %s) has issued you a [b]unranked[/b] challenge. Please login to your Clan CP and either accept or decline the challenge when ready.

Do not reply to this username,
Thank you.',
	'PM_TOURNAMENT'					=> '[SYSTEM] Tournament',
	'PM_TOURNAMENTMSG'				=> 'This is an automated message from the system.

Congratulations, you have advanced in the tournament: %s.

Do not reply to this username,
Thank you.',
	'PM_TOURNAMENTMSG2'				=> 'This is an automated message from the system.

Sorry, you have not advanced in the tournament: %s.

Do not reply to this username,
Thank you.',
	'POS'							=> 'POS',
	'POSTED'						=> 'posted',

	'QUIT'							=> 'Quit',

	'REPORTED_TOURNAMENTS'			=> 'Reported Tournaments',
	'REPORTED_MATCHES'				=> 'Reported Matches',
	'REPORT_WIN'					=> 'Report a Win',
	'RANKING_RANGE'					=> 'Sorry, but the clan you wish to challenge is out of your ranking range. The clan must rank either 3 above or below your clan\'s rank.',
	'READY'							=> 'Ready',
	'REMOVE_GROUP_TOURNAMENT'		=> 'The clan has been removed from the tournament.',
	'REPORT_MATCH'					=> 'Report a Match',
	'REQUEST_DECLINED'				=> 'You have declined the request.',
	'REQUEST_SENT'					=> 'Your request to join this clan has been submitted for review.',
	'REPORT_TOURNAMENT'				=> 'Report a Tournament Match',
	'REQUEST_TO_JOIN'				=> 'Request to Join',
	'RIGHT_TO_LEFT'					=> 'Right to Left',
	'FACTIONS_DATETIME'				=> 'Time/Date',
	'FACTIONS_DISALLOWED_EXTENSION'	=> 'The extension %s is not allowed.',
	'FACTIONS_EMPTY_FILEUPLOAD'		=> 'The uploaded file is empty.',
	'FACTIONS_INVALID_FILENAME'		=> '%s is an invalid filename',
	'FACTIONS_NOT_UPLOADED'			=> 'File could not be uploaded.',
	'FACTIONS_PARTIAL_UPLOAD'			=> 'The uploaded file was only partially uploaded',
	'FACTIONS_PHP_SIZE_NA'			=> 'The uploaded file\'s filesize is too large.<br />Could not determine the maximum size defined by PHP in php.ini.',
	'FACTIONS_PHP_SIZE_OVERRUN'		=> 'The uploaded file\'s filesize is too large, the maximum upload size is %d MB.<br />Please note this is set in php.ini and cannot be overridden.',
	'FACTIONS_TITLE'					=> 'Factions',
	'REPORTED_TOURNAMRNTS'			=> 'Reported Tournament Matches',
	'ROUND'							=> 'Round %d',

	'SPOTS'							=> 'Spots',
	'SEASON'						=> 'Season',
	'SEASON_EDITTED'				=> 'The season has been edited.',
	'SEASON_NAME'					=> 'Season Name',
	'SEASON_STARTED'				=> 'The season has been started for this ladder.',
	'SEASON_ENDED'					=> 'The season has ended and has been archived. You may now start a new season for this ladder.',
	'SEARCH_AVAILABLE_GROUPS'		=> 'Search Available Clans',
	'SEED_OR_RANDOM'				=> 'Do you wish to seed the tournament randomly or manually? Click Yes for "Random" and No for "Manual".',
	'SEED_TOURNAMENT'				=> 'Seed Tournament',
	'SIGNUP'						=> 'Sign Up',
	'SIGN_UP'						=> 'Sign-up',
	'STARTED'						=> 'Started',
	'START_TOURNAMENT'				=> 'Start Tournament',
	'STATISTICS'					=> 'Statistics',
	'START_SEASON'					=> 'Start Season',
	'SUBLADDER'						=> 'Sub-ladder',
	'SWAP'							=> 'Swap',

	'TOURNAMENT_INVITE'				=> 'Invitational Only',
	'TICKET_FILE'					=> 'Screenshot/Video (Optional)',
	'TICKET_RECEIVER'				=> 'Ticket Receiver',
	'TICKET_SENT'					=> 'The ticket has been sent. Be patient and it will be reviewed in time.',
	'TICKET_TYPE'					=> 'Type of Issue',
	'TOURNAMENT'					=> 'Tournament',
	'TOURNAMENT_ADDED'				=> 'The tournament has been added.',
	'TOURNAMENT_BRACKETS'			=> 'Tournament Brackets',
	'TOURNAMENT_DIRECTION'			=> 'Tournament Direction',
	'TOURNAMENT_DOUBLEELIM'			=> 'Double Elimination',
	'TOURNAMENT_FULL'				=> 'The tournament spots have been filled. You can not sign up.',
	'TOURNAMENT_STARTS'				=> 'Starts',
	'TOURNAMENT_STARTDATE'			=> 'Tournament Starting Date',
	'TOURNAMENT_INFO'				=> 'Tournament Information',
	'TOURNAMENT_LADDER'				=> 'Tournament Ladder',
	'TOURNAMENT_NAME'				=> 'Tournament Name',
	'TOURNAMENT_QUITTED'			=> 'Your clan has quit the tournament.',
	'TOURNAMENT_REPORTED'			=> 'The tournament report has been sent.',
	'TOURNAMENT_REPORT_INFO'		=> 'You are reporting for the "%s" tournament and your opponent is %s in the %s bracket.',
	'TOURNAMENT_REPORTS'			=> 'Tournament Reports',
	'TOURNAMENT_SINGLEELIM'			=> 'Single Elimination',
	'TOURNAMENT_SPOTS'				=> 'Spots open: %d<br />
Information: %s',
	'TOURNAMENT_TYPE'				=> 'Tournament Type',
	'TOURNAMENT_UPDATED'			=> 'The tournament has been updated.',

	'UNASSIGNED'					=> 'Unassigned',
	'UNSTARTED'						=> 'Unstarted',
	'UNREPORTED_MATCHES'			=> 'Unreported Matches',
	'UPGRADE_COMPLETE'				=> 'Your version has now been upgraded.',
	'UPGRADE_NA'					=> 'This version is not upgradeable.',
	'USER_ADDED_TO_GROUP'			=> 'The user has been added to the members.',
	'USER_INVITED'					=> 'The user has been invited via PM.',
	'USER_REMOVED_FROM_PENDING'		=> 'The user\'s request has been declined.',

	'VIEW_BRACKETS'					=> 'View Brackets',
	'VIEW_PROFILE'					=> 'View Profile',

	'WELCOME_CCP'					=> 'Welcome to the Clan Control Panel',
	'WELCOME_CCPTXT'				=> 'You are currently logged into the clan <b>%s</b>. This screen will give you a quick overview of various statistics. Use the links on the left to control the aspects of your clan experience.',
	'WELCOME_FACTIONS'				=> 'Welcome to phpBB Factions',
	'WELCOME_FACTIONSTXT'				=> 'Thank you for choosing phpBB Factions for your gaming solution. This screen will give you a quick overview of various statistics. Use the links on the left to control the aspects of your phpBB Factions experience.',
	'WIN'							=> 'Win',
	'WINNER'						=> 'Winner',
	'WINNER_BRACKET'				=> 'Winner Bracket',
	'WINNER_ROUND'					=> 'Winner!',
	'WORST_RANK'					=> 'Worst Rank',

	'YOUR_APART_OF_GROUP'			=> 'You are already a part of this clan.',
	'YOUR_OTHER_GROUPS'				=> 'Your Other Clans',

	'USER_NOT_FOUND'				=> 'The username or ID you have entered is incorrect. The user was not found.',
	'UNREPORTED_TOURNAMENTS'		=> 'Unreported Tournament Matches' )
);

?>
