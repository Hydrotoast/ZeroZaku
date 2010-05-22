<?php
##############################################################
# FILENAME  : class_league.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * League Class
 * This class handles generating the round robins, divisions and getting league data.
 */
class league
{
	/**
	 * Contains the league's information.
	 *
	 * @var array
	 */
	var $data;

	/**
	 * Gets the league's information.
	 */
	function league ( )
	{
		$this->data	= $this->data ( );
	}

	/**
	 * Populates the array of data based on information from the arguments.
	 *
	 * @param string $grab
	 * @param integer $league_id
	 * @return array
	 */
	function data ( $grab = '', $league_id = 0 )
	{
		global	$db;

		// Are we dealing with a request or default request?
		$type	= request_var ( 'league_id', 0 );

		// Get the league's information.
		$sql	= "SELECT * FROM " . LEAGUES_TABLE . " WHERE league_id = " . $type;
		$result	= $db->sql_query ( $sql );
		$row	= $db->sql_fetchrow ( $result );

		return ( !empty ( $grab ) ) ? $row[ $grab ] : $row;
	}

	/**
	 * Generate the round robins.
	 *
	 * @param string $division
	 * @param boolean $get_schedule
	 * @return object
	 */
	function round_robin ( $division, $get_schedule = false )
	{
		global	$db;
		global	$template;
		global	$lang;

		// Get the division's data.
		$sql	= "SELECT * FROM " . LEAGUEDIVS_TABLE . " WHERE division_id = " . $division;
		$result	= $db->sql_query ( $sql );
		$row	= $db->sql_fetchrow ( $result );

		$units	= explode ( '|', $row[ 'division_clans' ] );
		if ( count ( $units ) % 2 )
		{
			// Even units, so add a "Bye" clan.
			$units[ count ( $units ) + 1 ]	= 'Bye';
		}

		$count	= count ( $units );
		$sets	= ( $count - 1 );
		$half	= $count / 2;

		for ( $i = 0; $i < $sets; $i++ )
		{
			// Generate the sets or "rounds".
			$new_sets[ ]	= $i;
		}

		$schedule	= array ( );
		foreach ( $new_sets AS $turns )
		{
			// Now pair the clans. It should pair them the same way every time! :@
			$pairing	= array ( );
			for ( $i = 0; $i < $half; $i++ )
			{
				$pairing[ ]	= array ( $units[ $i ], ( $units[ $count - $i - 1 ] ) ? $units[ $count - $i - 1 ] : 'Bye' );
			}

			array_splice ( $units, 1, 0, array_pop ( $units ) );
			$schedule[ ]	= $pairing;
		}

		// Now to show the round robin graphically.
		for ( $i = 0; $i < count ( $schedule[ 0 ] ); $i++ )
		{
			// Shows the matches.
			$template->assign_block_vars ( 'block_matches', array (
				'S_MATCH' => ( $i + 1 ) )
			);
		}

		// Show the rounds and the matchups.
		$i	= 0;
		foreach ( $schedule AS $thing )
		{
			$template->assign_block_vars ( 'block_rounds', array (
				'S_ROUND' => ( $i + 1 ) )
			);

			foreach ( $thing AS $thing_2 )
			{
				// Assign the pairs to the template.
				$template->assign_block_vars ( 'block_rounds.block_matchups', array (
					'S_CLAN1' => $thing_2[ 0 ],
					'S_CLAN2' => $thing_2[ 1 ] )
				);
			}

			$i++;
		}

		// Are we grabbing the schedule ?
		if ( $get_schedule == true )
		{
			// Yes. Return it.
			return	$schedule;
		}
	}
}

?>
