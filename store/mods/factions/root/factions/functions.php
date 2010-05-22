<?php
##############################################################
# FILENAME  : functions.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Adds the English ordinal suffixes. Used for ranks.
 * From php.net
 *
 * @param integer $number
 * @return mixed
 */
function ordinal ( $number )
{
	$test_c	= abs ( $number ) % 10;
    $ext	= ( ( abs ( $number ) %100 < 21 && abs ( $number ) %100 > 4 ) ? 'th'
			: ( ( $test_c < 4 ) ? ( $test_c < 3 ) ? ( $test_c < 2 ) ? ( $test_c < 1 )
			? 'th' : 'st' : 'nd' : 'rd' : 'th' ) );

	return	$number . '<sup>' . $ext . '<sup>';
}

/**
 * Calculate the ELO constant based on the group's score.
 *
 * @param integer $score
 * @return integer
 */
function determine_constant ( $score )
{
	if ( $score < 2000 )
	{
		$constant	= 30;
	}
	else if ( $score >= 2000 && $score < 2400 )
	{
		$constant	= 20;
	}
	else
	{
		$constant	= 10;
	}

	return	$constant;
}

/**
 * Calculate the ELO rating (scoring in this case).
 *
 * @param integer $group1_score
 * @param integer $group2_score
 * @param boolean $group1_win
 * @return integer
 */
function calculate_elo ( $group1_score, $group2_score, $group1_win )
{
	$outcome			= ( $group1_win == true ) ? 1 : 0;
	$difference			= $group1_score - $group2_score;
	$exponent			= -$difference / 400;
	$expected_outcome	= 1 / ( 1 + pow ( 10, $exponent ) );

	$constant	= determine_constant ( $group1_score );
	$new_score	= round ( $group1_score + $constant * ( $outcome - $expected_outcome ) );

	return	$new_score;
}

/**
 * From phpBB code. Re-order the ladders
 *
 * @param string $move
 * @param integer $ladder_id
 */
function re_order ( $move, $ladder_id )
{
	global	$db;

	// Get the ladder information.
	$sql	= "SELECT * FROM " . LADDERS_TABLE . " WHERE ladder_id = " . $ladder_id;
	$result	= $db->sql_query ( $sql );
	$row	= $db->sql_fetchrow ( $result );

	if ( $row[ 'ladder_parent' ] == '' || $row[ 'ladder_parent' ] == '0' )
	{
		// This is ladder.
		$field	= 'ladder_order';

		// Get the ladder information.
		$sql	= "SELECT * FROM " . LADDERS_TABLE . "  WHERE ladder_parent = 0 ORDER BY ladder_order ASC";
		$result	= $db->sql_query ( $sql );
	}
	else
	{
		// This is a sub-ladder.
		$field	= 'subladder_order';

		// Get the ladder information.
		$sql	= "SELECT * FROM " . LADDERS_TABLE . "  WHERE ladder_parent = {$row[ 'ladder_parent' ]} ORDER BY subladder_order ASC";
		$result	= $db->sql_query ( $sql );
	}

	// Put the ladder IDs and ladder order into an array.
	$order	= array ( );
	while ( $row = $db->sql_fetchrow ( $result ) )
	{
		$order[ ]	= array ( '0' => $row[ 'ladder_id' ], '1' => $row[ $field ] );
	}

	$db->sql_freeresult ( $result );

	$i	= 0;
	foreach ( $order AS $key => $value )
	{
		foreach ( $value AS $key_2 => $value_2 )
		{
			if ( $order[ $i ][ 0 ] == $ladder_id )
			{
				$current	= $order[ $i ][ 1 ];

				if ( $move == 'up' )
				{
					// We are moving up.
					$new	= $order[ $i - 1 ][ 1 ];
					$from	= $order[ $i - 1 ][ 0 ];
				}
				else
				{
					// We are moving down.
					$new	= $order[ $i + 1 ][ 1 ];
					$from	= $order[ $i + 1 ][ 0 ];
				}

				// Switch the two ladder orders.
				$sql	= "UPDATE " . LADDERS_TABLE . " SET $field = $new WHERE ladder_id = " . $ladder_id;
				$db->sql_query ( $sql );

				$sql	= "UPDATE " . LADDERS_TABLE . " SET $field = $current WHERE ladder_id = " . $from;
				$db->sql_query ( $sql );
			}
		}

		$i++;
	}
}

/**
 * Sends a PM to a user.
 *
 * @param integer $to
 * @param integer $from
 * @param string $subject
 * @param string $message
 * @return array
 */
function insert_pm ( $to, $from, $subject, $message )
{
	global	$$phpbb_root_path, $phpEx;
	$uid	= $bitfield = $options = 1;

	generate_text_for_storage ( $message, $uid, $bitfield, $options, true, true, true );

	$data	= array (
		'address_list' => array ( 'u' => array ( $to => 'to' ) ),
		'from_user_id' => $from[ 'user_id' ],
		'from_username' => $from[ 'username' ],
		'icon_id' => 0,
		'from_user_ip' => $from[ 'user_ip' ],
		'enable_bbcode' => true,
		'enable_smilies' => true,
		'enable_urls' => true,
		'enable_sig' => true,
		'message' => $message,
		'bbcode_bitfield' => $bitfield,
		'bbcode_uid' => $uid
	);

	submit_pm ( 'post', $subject, $data, false );
}

?>
