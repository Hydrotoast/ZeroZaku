<?php
##############################################################
# FILENAME  : factions.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
define ( 'IN_PHPBB', true );
$phpbb_root_path	= ( defined ( 'PHPBB_ROOT_PATH' ) ) ? PHPBB_ROOT_PATH : './';
$phpEx				= substr ( strrchr ( __FILE__, '.' ), 1 );
include ( $phpbb_root_path . 'common.' . $phpEx );

// Initilize the phpBB sessions.
$user->session_begin ( );
$auth->acl ( $user->data );
$user->setup ( 'mods/lang_factions' );

// Include Factions' classes.
include ( $phpbb_root_path . 'includes/functions_user.' . $phpEx );
include ( $phpbb_root_path . 'includes/functions_privmsgs.' . $phpEx );
include ( $phpbb_root_path . 'factions/classes/class_group.' . $phpEx );
include ( $phpbb_root_path . 'factions/classes/class_tournament.' . $phpEx );
include ( $phpbb_root_path . 'factions/classes/class_ladder.' . $phpEx );
include ( $phpbb_root_path . 'factions/functions.' . $phpEx );

// Start the output.
$action	= request_var ( 'action', '' );
page_header ( $user->lang[ 'FACTIONS_TITLE' ] );

// Include the file for the action called.
$basename	= basename ( $action, '.' . $phpEx );
include ( $phpbb_root_path . 'factions/' . $basename . '.' . $phpEx );

page_footer ( );
?>
