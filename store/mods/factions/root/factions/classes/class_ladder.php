<?php
##############################################################
# FILENAME  : class_ladder.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Ladder Class
 * This gets ladder information based on requests.
 */
class ladder
{
	/**
	 * Contains the group's information.
	 *
	 * @var array
	 */
	var $data;

	/**
	 * Inits the class and populates the data object.
	 */
	function ladder ( )
	{
		$this->data	= $this->data ( );
	}

	/**
	 * Populates the array of data based on information from the arguments.
	 *
	 * @param string $feild
	 * @param integer $ladder_id
	 * @return array
	 */
	function data ( $feild = '*', $ladder_id = 0 )
	{
		global	$db;

		// Are we dealing with a request or default request?
		if ( $ladder_id != 0 )
		{
			// Request.
			$type	= $ladder_id;
		}
		else
		{
			$check	= request_var ( 'ladder_id', 0 );
			if ( $check != 0 )
			{
				// Default.
				$type	= $check;
			}
			else
			{
				$type	= 0;
			}
		}

		// Get the ladder's information.
		$sql		= "SELECT $feild FROM " . LADDERS_TABLE . " WHERE ladder_id = " . $type;
		$result		= $db->sql_query ( $sql );
		$row		= $db->sql_fetchrow ( $result );

		return	( $feild != '*' ) ? $row[ $feild ] : $row;
	}

	/**
	 * Gets the ladders in the form of an array with most of their details.
	 *
	 * @param integer $platform
	 * @return array
	 */
	function ladder_list ( $platform = 0 )
	{
		global	$db;

		$ladder_list	= array ( );

		// Get the parent ladders and order them.
		if ( !empty ( $platform ) )
		{
			// Add the platform clause.
			$sql	= "SELECT * FROM " . LADDERS_TABLE . " WHERE ladder_parent = 0 AND ladder_platform = $platform ORDER BY ladder_order ASC";
			$result	= $db->sql_query ( $sql );
		}
		else
		{
			// Don't add the platform clause.
			$sql	= "SELECT * FROM " . LADDERS_TABLE . " WHERE ladder_parent = 0 ORDER BY ladder_order ASC";
			$result	= $db->sql_query ( $sql );
		}

		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			// Assign the ladders to the array.
			$ladder_list[ $row[ 'ladder_id' ] ]	= array (
				'NAME' => $row[ 'ladder_name' ],
				'PLATFORM' => $row[ 'ladder_platform' ],
				'SUBLADDERS' => array ( )
			);

			// Get the sub-ladders and order them.
			$sql_2		= "SELECT * FROM " . LADDERS_TABLE . " WHERE ladder_parent = {$row[ 'ladder_id' ]} ORDER BY subladder_order ASC";
			$result_2	= $db->sql_query ( $sql_2 );

			while ( $row_2 = $db->sql_fetchrow ( $result_2 ) )
			{
				// Assign the ladders to the array.
				$ladder_list[ $row_2[ 'ladder_parent' ] ][ 'SUBLADDERS' ][ $row_2[ 'ladder_id' ] ]	= array (
					'NAME' => $row_2[ 'ladder_name' ],
					'DESC' => $row_2[ 'ladder_desc' ]
				);
			}
		}

		return	$ladder_list;
	}

	/**
	 * Get the sub-ladder's roots.
	 *
	 * @param integer $subladder_id
	 * @return array
	 */
	function get_roots ( $subladder_id )
	{
		global	$db;

		// Get the subladder's name.
		$subladder			= $this->data ( 'ladder_name', $subladder_id );
		$subladder_locked	= $this->data ( 'ladder_locked', $subladder_id );
		$parent				= $this->data ( 'ladder_parent', $subladder_id );

		// Get the ladder for the sub-ladder.
		$sql		= "SELECT * FROM " . LADDERS_TABLE . " WHERE ladder_id = " . $parent;
		$result		= $db->sql_query ( $sql );
		$row		= $db->sql_fetchrow ( $result );
		$ladder_id	= $row[ 'ladder_id' ];
		$ladder		= $row[ 'ladder_name' ];

		// Get the platform for the ladder selected.
		$sql			= "SELECT * FROM " . PLATFORMS_TABLE . " WHERE platform_id = " . $row[ 'ladder_platform' ];
		$result			= $db->sql_query ( $sql );
		$row			= $db->sql_fetchrow ( $result );
		$platform_id	= $row[ 'platform_id' ];
		$platform		= $row[ 'platform_name' ];

		return	array (
			'PLATFORM_ID' => $platform_id,
			'PLATFORM_NAME' => $platform,
			'LADDER_ID' => $ladder_id,
			'LADDER_NAME' => $ladder,
			'SUBLADDER_ID' => $subladder_id,
			'SUBLADDER_NAME' => $subladder,
			'SUBLADDER_LOCKED' => $subladder_locked
		);
	}

	/**
	 * Update the group's ranks via a swap.
	 *
	 * @param integer $winner_group
	 * @param integer $loser_group
	 * @return null
	 */
	function update_ranks ( $winner_group, $loser_group, $ladder_id )
	{
		global	$db;

		$group	= new group ( );

		// Get the group's data for this ladder
		$sql	= "SELECT * FROM " . GROUPDATA_TABLE . " WHERE group_id = $winner_group AND group_ladder = " . $ladder_id;
		$result	= $db->sql_query ( $sql );
		$winner	= $db->sql_fetchrow ( $result );

		$sql	= "SELECT * FROM " . GROUPDATA_TABLE . " WHERE group_id = $loser_group AND group_ladder = " . $ladder_id;
		$result	= $db->sql_query ( $sql );
		$loser	= $db->sql_fetchrow ( $result );

		// Check if a swap will take place.
		if ( $winner[ 'group_current_rank' ] > $loser[ 'group_current_rank' ] )
		{
			// Winner's current rank is less than the loser's current rank.
			// A swap must take place.
			$winner_current_rank	= $loser[ 'group_current_rank' ];
			$winner_last_rank		= $winner[ 'group_current_rank' ];

			$loser_current_rank		= $winner[ 'group_current_rank' ];
			$loser_last_rank		= $loser[ 'group_current_rank' ];

			// Calculate the best and worst rank changes.
			if ( $winner_current_rank < $winner[ 'group_best_rank' ] )
			{
				// Current rank is better.
				$winner_best_rank	= $winner_current_rank;
			}
			else
			{
				$winner_best_rank	= $winner[ 'group_best_rank' ];
			}

			if ( $loser_current_rank > $loser[ 'group_worst_rank' ] )
			{
				// Current rank is worse.
				$loser_worst_rank	= $loser_current_rank;
			}
			else
			{
				$loser_worst_rank	= $loser[ 'group_worst_rank' ];
			}

			// Finally, update the rankings.
			$sql	= "UPDATE " . GROUPDATA_TABLE . " SET group_current_rank = $winner_current_rank, group_best_rank = $winner_best_rank, group_last_rank = $winner_last_rank WHERE group_id = {$winner[ 'group_id' ]} AND group_ladder = " . $ladder_id;
			$db->sql_query ( $sql );

			$sql	= "UPDATE " . GROUPDATA_TABLE . " SET group_current_rank = $loser_current_rank, group_worst_rank = $loser_worst_rank, group_last_rank = $loser_last_rank WHERE group_id = {$loser[ 'group_id' ]} AND group_ladder = " . $ladder_id;
			$db->sql_query ( $sql );
		}
	}
}

?>
