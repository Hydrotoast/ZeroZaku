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
	'ALL'							=> 'All',
	'ACCEPT'						=> 'Accept',
	'ADD_GROUP'						=> 'Create a Faction',
	'ASSIGN_AS_BACKUP'				=> 'Assign as Backup Leader',
	'ASSIGN_AS_LEADER'				=> 'Assign as Leader',

	'CANT_INVITE_YOURSELF'			=> 'You can not invite yourself!',

	'FACTION_ADDED'					    => 'The clan has been created, you may now login to the clan.',
	'FACTION_DESC'					    => 'Faction Information',
	'FACTION_ID'						=> 'Faction ID',
	'FACTION_INFORMATION'				=> 'Faction Information',
	'FACTION_LEADER'					=> 'Faction Leader',
	'FACTION_LOGIN'					    => 'Faction Login',
	'FACTION_LOGO'					    => 'Faction Logo',
	'FACTION_MEMBERS'					=> 'Faction Members',
	'FACTION_NAME'					    => 'Faction Name',
	'FACTION_TAG'						=> 'Faction Tag',
	'FACTION_UPDATED'					=> 'The clan has been updated.',

	'DECLINE'						=> 'Decline',
	'DETAILS'						=> 'Details',

	'ENTER_FACTION_NAME'				=> 'You must enter a clan name before creating your clan.',
	'EXTENSION_NOT_ALLOWED'			=> 'The extension of the file you are trying to upload is not allowed.',
	'EXTRA'							=> 'Details',

	'INVITE_USER'					=> 'Invite a User',
	'ISSUE_A_TICKET'				=> 'Issue a Ticket',

	'JOINED_GROUP'					=> 'You are now a part of this clan. Welcome!',

	'REQUIRED_MEMBERS_FAILED'		=> 'Sorry, your clan does not meet the required members of %s.',

	'MANAGE_MEMBERS'				=> 'Manage Members',
	'MEMBER_ASSIGNED_AS_BACKUP'		=> 'The member has been assigned as a backup leader.',
	'MEMBER_ASSIGNED_AS_LEADER'		=> 'The member has been assigned as the new leader.',
	'MEMBER_REMOVED'				=> 'The member has been removed.',

	'NO_REPORTED_MATCHES'			=> 'There are no reported matches.',
	'NO_UNREPORTED_MATCHES'			=> 'There are no unreported matches.',
	'NONEXISTANT_GROUP'				=> 'The clan you have requested does not exist.',
	'NONEXISTANT_GROUP2'			=> 'The clan you have requested does not exist in the chosen ladder.',
	'NOT_READY'						=> 'Not Ready',
	'NO_ADMIN'						=> 'Sorry, you can not access this page because you are not an administrator of this site.',
	'NUMBER_OF_GROUPS'				=> 'Number of Factions',
	'NUM_GROUPS'					=> 'Factions',

	'PENDING'						=> 'Pending',
	'PENDING_MATCHES'				=> 'Pending Challenges',
	'PENDING_MEMBERS'				=> 'Pending Members',
	'PMPENDINGMEMBERTXT'			=> 'This is an automated message from the system.

[b]%s[/b] is requesting to join you clan, %s. You can approve or deny this request in the Faction Control Panel under Manage Members.

Do not reply to this username,
Thanks.',
	'PMPENDINGMEMBER'				=> '[SYSTEM] Member Request',
	'PMINTVITETXT'					=> 'This is an automated message from the system.

[b]%s[/b] has invited you to join their clan. Do you accept ?
[url=%s%s%s/%s]Yes[/url] or [url=%s%s%s/%s]No[/url]

Do not reply to this username,
Thanks.',
	'PMINVITE'						=> '[SYSTEM] Faction Invitation',
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

	'QUIT'							=> 'Quit',

	'READY'							    => 'Ready',
	'REQUEST_DECLINED'				    => 'You have declined the request.',
	'REQUEST_SENT'					    => 'Your request to join this clan has been submitted for review.',
	'REQUEST_TO_JOIN'				    => 'Request to Join',
	'FACTIONS_DATETIME'				    => 'Time/Date',
	'FACTIONS_DISALLOWED_EXTENSION'	    => 'The extension %s is not allowed.',
	'FACTIONS_EMPTY_FILEUPLOAD'		    => 'The uploaded file is empty.',
	'FACTIONS_INVALID_FILENAME'		    => '%s is an invalid filename',
	'FACTIONS_NOT_UPLOADED'			    => 'File could not be uploaded.',
	'FACTIONS_PARTIAL_UPLOAD'			=> 'The uploaded file was only partially uploaded',
	'FACTIONS_PHP_SIZE_NA'			    => 'The uploaded file\'s filesize is too large.<br />Could not determine the maximum size defined by PHP in php.ini.',
	'FACTIONS_PHP_SIZE_OVERRUN'		    => 'The uploaded file\'s filesize is too large, the maximum upload size is %d MB.<br />Please note this is set in php.ini and cannot be overridden.',
	'FACTIONS_TITLE'					=> 'Factions',

	'SPOTS'							=> 'Spots',
	'STATISTICS'					=> 'Statistics',
	'SWAP'							=> 'Swap',

	'TICKET_FILE'					=> 'Screenshot/Video (Optional)',
	'TICKET_RECEIVER'				=> 'Ticket Receiver',
	'TICKET_SENT'					=> 'The ticket has been sent. Be patient and it will be reviewed in time.',
	'TICKET_TYPE'					=> 'Type of Issue',

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

	'USER_NOT_FOUND'				=> 'The username or ID you have entered is incorrect. The user was not found.',
));

?>
