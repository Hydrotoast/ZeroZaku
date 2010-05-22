<?php
##############################################################
# FILENAME  : factions_umil.php
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
	'INSTALL_PHPBB_FACTIONS'				=> 'Install phpBB Factions',
	'INSTALL__PHPBB_FACTIONS_CONFIRM'		=> 'Are you ready to install phpBB Factions?',
	'PHPBB_FACTIONS'						=> 'phpBB Factions',
	'PHPBB_FACTIONS_EXPLAIN'				=> 'An all-in-one clan, ladder &amp; tournament script for phpBB.',
	'UNINSTALL_PHPBB_FACTIONS'			=> 'Uninstall phpBB Factions',
	'UNINSTALL_PHPBB_FACTIONS_CONFIRM'	=> 'Are you ready to uninstall phpBB Factions? All settings and data saved by this mod will be removed!',
	'UPDATE_PHPBB_FACTIONS'				=> 'Update phpBB Factions',
	'UPDATE_PHPBB_FACTIONS_CONFIRM'		=> 'Are you ready to update phpBB Factions?' )
);

?>
