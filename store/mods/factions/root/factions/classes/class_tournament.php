<?php
##############################################################
# FILENAME  : class_tournament.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

define ( 'MOVE_RIGHT', 1 );
define ( 'MOVE_LEFT', 2 );
define ( 'MOVE_UP', 3 );
define ( 'MOVE_DOWN', 4 );

/**
 * Tournament Class
 * This does all the complex calculations for generating brackets and displaying them.
 */
class tournament
{
	/**
	 * Contains the tournament's information.
	 *
	 * @var array
	 */
	var $data;

	/**
	 * Contains the tournament's table widths.
	 *
	 * @var array
	 */
	var $rounds_widths;

	/**
	 * Contains the tournament's round names.
	 *
	 * @var array
	 */
	var $rounds_list;

	/**
	 * Contains the tournament's round numbers.
	 *
	 * @var array
	 */
	var $rounds_array;

	/**
	 * Inits the class, populating the data object.
	 */
	function tournament ( )
	{
		// Populate the data object.
		$this->data	= $this->data ( );
	}

	/**
	 * Populates the array of data based on information from the arguments.
	 *
	 * @param string $grab
	 * @param integer $tournament_id
	 * @return array
	 */
	function data ( $grab = '', $tournament_id = 0 )
	{
		global	$db;

		// Are we dealing with a request or default request?
		if ( $tournament_id != 0 )
		{
			// Request.
			$type	= $tournament_id;
		}
		else
		{
			$check	= request_var ( 'tournament_id', 0 );
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

		// Get the tournament's information.
		$sql	= "SELECT * FROM " . TOURNAMENTS_TABLE . " WHERE tournament_id = " . $type;
		$result	= $db->sql_query ( $sql );
		$row	= $db->sql_fetchrow ( $result );

		return ( !empty ( $grab ) ) ? $row[ $grab ] : $row;
	}


	/**
	 * This generates both the single and double elimination brackets.
	 *
	 * @param boolean $double_elimination
	 */
	function generate_brackets ( $double_elimination = false )
	{
		global	$user;

		// If double_elimination is true, then take 1 away from the total brackets.
		$brackets		= ( $double_elimination == true ) ? ( $this->data[ 'tournament_brackets' ] - 1 ) : $this->data[ 'tournament_brackets' ];
		$spots			= $brackets * 2 - 1;
		$temp_rows		= $brackets;

		// Keep counting until the rows/columes are filled.
		$rows		= 0;
		$row_count	= 1;
		while ( $temp_rows > 1 )
		{
			$row_count++;

			// Add a new colume.
			$temp_rows	= ( $temp_rows / 2 );
			$rows		= $row_count;
		}

		$counter	= $brackets;
		$finals		= ( $rows - 1 );
		$winner		= $rows;
		$round		= 0;

		$rounds_array	= array ( );
		$rounds_list	= array ( );
		while ( $counter > 1 )
		{
			if ( $round > 0 )
			{
				// Starts a new bracket essentially.
				$counter	= $counter / 2;
			}

			$round++;
			if ( $round == $winner )
			{
				// This is the last round (Winners Round).
				$round_games	= $user->lang[ 'WINNER_ROUND' ];
			}
			else if ( $round == $finals )
			{
				// This is the second last round (Finals Round).
				$round_games	= $user->lang[ 'FINAL_ROUND' ];
			}
			else
			{
				// This is a regular round.
				$round_games	= sprintf ( $user->lang[ 'ROUND' ], $round );
			}

			// Add the rounds and round names to the arrays for processing;
			$rounds_list[ ]					= $round_games;
			$rounds_array[ $round_games ]	= array ( );

			$position	= 0;
			while ( $counter > $position )
			{
				$position++;

				// Give each bracket a ID.
				$rounds_array[ $round_games ][ ]	= $round . '_' . $position;
			}
		}

		// Inserts the "Game x" into the proper position in the brackets.
		// Thanks to Thomas Jollans for this :).
		$x	= 1;
		foreach ( $rounds_array AS $key => $value )
		{
			$i	= 1;
			while ( $i < sizeof ( $rounds_array[ $key ] ) )
			{
				array_splice ( $rounds_array[ $key ], $i, 0, 'Game ' . $x );
				$i	+= 3;
				$x++;
			}
		}

		$this->rounds_list	= $rounds_list;
		$this->rounds_array	= $rounds_array;
	}

	/**
	 * Fixes up the brackets to make them run smooth, using BYE groups.
	 *
	 * @param integer $tournament_id
	 * @return null
	 */
	function add_byes ( $tournament_id )
	{
		global	$db, $config;

		// Get the groups for this tournament.
		$sql	= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_tournament = " . $tournament_id;
		$result	= $db->sql_query ( $sql );

		// Setup the group array. Loop through the signed-up groups.
		$groups	= array ( );
		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			$groups[ ]	= $row[ 'group_id' ];
		}

		shuffle ( $groups );
		$db->sql_freeresult ( $result );

		/* Upscales the group array to a power of 2 by inserting BYE groups. This fixes up the brackets to make them run smoothly. Thanks to Thomas Jollans for the math help :) */
		$i	= 1;
		while ( $i < sizeof ( $groups ) )
		{
			$exponent	= log ( sizeof ( $groups ), 2 );
			if ( (float)(int)($exponent) != $exponent )
			{
					// Add a bye.
					array_splice ( $groups, $i, 0, $config[ 'factions_byegroup' ] );
			}

			// Jump two positions to add the next bye.
			$i	+= 2;
		}

		// Randomize the matches (group in pairs).
		$pairs	= array ( );
		$i		= 0;
		while ( $i < sizeof ( $groups ) )
		{
			// Set the matches.
			$pairs[ ]	= array ( $groups[ $i ], $groups[ $i + 1 ] );
			$i	+= 2;
		}

		shuffle ( $pairs );

		// Lets fix the positions for this tournament to add-in the bye groups.
		$sql	= "DELETE FROM " . TGROUPS_TABLE . " WHERE group_tournament = " . $tournament_id;
		$db->sql_query ( $sql );

		$i	= 1;
		foreach ( $pairs AS $key => $value )
		{
			foreach ( $value AS $key_2 => $value_2 )
			{
				// Set the match, bracket and position.
				$sql_array	= array (
					'group_tournament' => $tournament_id,
					'group_id' => $value_2,
					'group_position' => $i,
					'group_bracket' => 1
				);
				$sql	= "INSERT INTO " . TGROUPS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
				$db->sql_query ( $sql );

				// Since bye groups are not groups. Lets move the bye group's opponent to the next bracket (if they have a bye group).
				if ( $value_2 == $config[ 'factions_byegroup' ] )
				{
					// Move the bye group's opponent to the next bracket.
					$sql	= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_tournament = $tournament_id AND group_bracket = 1 AND group_position = " . ( $i - 1 );
					$result	= $db->sql_query ( $sql );
					$row	= $db->sql_fetchrow ( $result );

					$sql_array	= array (
						'group_tournament' => $tournament_id,
						'group_id' => $row[ 'group_id' ],
						'group_position' => round ( $row[ 'group_position' ] / 2 ),
						'group_bracket' => 2
					);
					$sql	= "INSERT INTO " . TGROUPS_TABLE . " " . $db->sql_build_array ( 'INSERT', $sql_array );
					$db->sql_query ( $sql );
				}

				$i++;
			}
		}

		// Update the number of clans for the tournament.
		$new_clans	= $i - 1;
		$sql		= "UPDATE " . TOURNAMENTS_TABLE . " SET tournament_brackets = $new_clans WHERE tournament_id = " . $tournament_id;
		$db->sql_query ( $sql );
	}

	/**
	 * Checks if a group has a matchup in a tournament.
	 * If the group's position in the bracket is odd,
	 * it gets the position ahead. If the group's
	 * position is even, it gets the position behind.
	 *
	 * @param integer $bracket
	 * @param integer $position
	 * @param integer $tournament_id
	 * @param boolean $loser
	 * @return integer
	 */
	function get_matchup ( $bracket, $position, $tournament_id = 0, $loser = false )
	{
		global	$db;

		$loser			= ( $loser == true ) ? " AND group_loser = 1" : " AND group_loser != 1";
		$position		= ( $position % 2 ) ? ( $position + 1 ) : ( $position - 1 );
		$tournament_id	= ( $tournament_id != 0 ) ? $tournament_id : $this->data[ 'tournament_id' ];

		$sql	= "SELECT group_id FROM " . TGROUPS_TABLE . " WHERE group_tournament = $tournament_id AND group_bracket = $bracket AND group_position = " . $position . $loser;
		$result	= $db->sql_query ( $sql );
		$row	= $db->sql_fetchrow ( $result );
		$db->sql_freeresult ( $result );

		return	( !empty ( $row[ 'group_id' ] ) && $row[ 'group_id' ] != 0 ) ? $row[ 'group_id' ] : false;
	}

	/**
	 * This takes the data from generate_brackets
	 * and puts it into a graphical perspective
	 * for both admins and users.
	 *
	 * @param $admin boolean
 	 * @param $u_action object
	 * @return object
	 */
	function generate_tournament ( $admin = false, $u_action = '' )
	{
		global	$db;
		global	$user;
		global	$template;
		global	$phpEx;
		global	$phpbb_root_path;

		$group	= new group ( );

		// Do the calculations.
		$this->generate_brackets ( );

		$i			= 0;
		$rounds		= 0;
		$move_on	= '';
		foreach ( $this->rounds_array AS $round )
		{
			// Add a new colume/round with the table widths, round name and round number.
			$template->assign_block_vars ( 'block_rounds', array (
				'S_ROUND' => $this->rounds_list[ $i ] )
			);
			$rounds++;

			$x	= 0;
			foreach ( $round AS $round_value )
			{
				$x++;
				// Is this a group or game?
				if ( empty ( $round_value ) || strstr ( $round_value, 'Game' ) )
				{
					// Game, italics it.
					$template->assign_block_vars ( 'block_rounds.block_data', array (
						'S_DATA' => '<i>' . $round_value . '</i>',
						'S_COLOR' => 'row1',
						'S_BGCOLOR' => 'bg2' )
					);
				}
				else
				{
					// Get the group for this bracket and position.
					$bap	= explode ( '_', $round_value );

					$sql	= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_tournament = {$this->data[ 'tournament_id' ]} AND group_bracket = {$bap[ 0 ]} AND group_position = {$bap[ 1 ]} AND group_loser <> 1";
					$result	= $db->sql_query ( $sql );
					$row	= $db->sql_fetchrow ( $result );

					// Admin mode?
					if ( $admin == true )
					{
						// Test and see if they have a matchup.
						$test		= $this->get_matchup ( $bap[ 0 ], $bap[ 1 ] );
						$move_on	= '(<a href="' . $u_action . '&amp;group_1=' . $row[ 'group_id' ] . '&amp;group_2=' . $test . '&amp;bracket=' . $bap[ 0 ] . '&amp;position=' . $bap[ 1 ] . '&amp;move=' . MOVE_RIGHT . '&amp;where=1&amp;tournament_id=' . $this->data[ 'tournament_id' ] . '&amp;submit=1"><img src="' . $phpbb_root_path . 'factions/images/icon_right.gif" /></a> | <a href="' . $u_action . '&amp;group_1=' . $row[ 'group_id' ] . '&amp;group_2=' . $test . '&amp;bracket=' . $bap[ 0 ] . '&amp;position=' . $bap[ 1 ] . '&amp;move=' . MOVE_LEFT . '&amp;where=1&amp;tournament_id=' . $this->data[ 'tournament_id' ] . '&amp;submit=1"><img src="' . $phpbb_root_path . 'factions/images/icon_left.gif" /></a> | <a href="' . $u_action . '&amp;group_1=' . $row[ 'group_id' ] . '&amp;group_2=' . $test . '&amp;bracket=' . $bap[ 0 ] . '&amp;position=' . $bap[ 1 ] . '&amp;move=' . MOVE_UP . '&amp;where=1&amp;tournament_id=' . $this->data[ 'tournament_id' ] . '&amp;submit=1"><img src="' . $phpbb_root_path . 'factions/images/icon_up.gif" /></a> | <a href="' . $u_action . '&amp;group_1=' . $row[ 'group_id' ] . '&amp;group_2=' . $test . '&amp;bracket=' . $bap[ 0 ] . '&amp;position=' . $bap[ 1 ] . '&amp;move=' . MOVE_DOWN . '&amp;where=1&amp;tournament_id=' . $this->data[ 'tournament_id' ] . '&amp;submit=1"><img src="' . $phpbb_root_path . 'factions/images/icon_down.gif" /></a>) <a href="' . $u_action . '&amp;remove_group=' . $row[ 'group_id' ] . '&amp;tournament_id=' . $this->data[ 'tournament_id' ] . '&amp;submit=1">' . $user->lang[ 'DELETE' ] . '</a>';
					}

					// Get the group's name and ID.
					if ( !empty ( $row[ 'group_id' ] ) )
					{
						$sql	= "SELECT * FROM " . GROUPS_TABLE . " WHERE group_id = " . $row[ 'group_id' ];
						$result	= $db->sql_query ( $sql );
						$row	= $db->sql_fetchrow ( $result );
					}

					// group, bold it.
					$template->assign_block_vars ( 'block_rounds.block_data', array (
						'S_DATA' => '<strong><a href="' . append_sid ( $phpbb_root_path . 'factions.' . $phpEx, 'action=group_profile&amp;group_id=' . $row[ 'group_id' ] ) . '">' . $group->group_name ( $row[ 'group_name' ] ) . '</a></strong>',
						'S_MOVEON' => ( !empty ( $row[ 'group_id' ] ) ) ? $move_on : '',
						'S_COLOR' => 'row2',
						'S_BGCOLOR' => 'bg2' )
					);
				}

				// This adds a "spacer" to beautify the brackets.
				// count ( $round ) = number of groups in this bracket.
				if ( ( $x % 3 == 0 ) && $x != count ( $round ) )
				{
					// Assign dummy data to the template. S_DATA will contain a spacer, to make the brackets look nice.
					$template->assign_block_vars ( 'block_rounds.block_data', array (
						'S_DATA' => ( $rounds != 1 ) ? str_repeat ( '<br />', ( $rounds * 4 ) ) : '',
						'S_COLOR' => '',
						'S_BGCOLOR' => '' )
					);
				}
			}

			$i++;
		}

		$has_doubleelim	= false;

		// Are we dealing with double elimination?
		if ( $this->data[ 'tournament_type' ] == 2 )
		{
			$has_doubleelim	= true;

			// Do the calculations again for the loser bracket.
			$this->generate_brackets ( true );

			// Based on tournament direction, will this go from left to right or right to left?
			$this->rounds_widths	= ( $this->data[ 'tournament_direction' ] == 0 ) ? $this->rounds_widths : array_reverse ( $this->rounds_widths );
			$this->rounds_list		= ( $this->data[ 'tournament_direction' ] == 0 ) ? $this->rounds_list : array_reverse ( $this->rounds_list );
			$this->rounds_array		= ( $this->data[ 'tournament_direction' ] == 0 ) ? $this->rounds_array : array_reverse ( $this->rounds_array );

			$i			= 0;
			$rounds		= 0;
			foreach ( $this->rounds_array AS $round )
			{
				// Add a new colume/round with the table widths, round name and round number.
				$template->assign_block_vars ( 'block_rounds2', array (
					'S_ROUND' => $this->rounds_list[ $i ] )
				);
				$rounds++;

				foreach ( $round AS $round_value )
				{
					// Is this a group or game?
					if ( empty ( $round_value ) || strstr ( $round_value, 'Game' ) )
					{
						// Game, italics it.
						$template->assign_block_vars ( 'block_rounds2.block_data2', array (
							'S_DATA' => '<i>' . $round_value . '</i>',
							'S_COLOR' => 'row1',
							'S_BGCOLOR' => 'bg2' )
						);
					}
					else
					{
						// Get the group for this bracket and position.
						$bap	= explode ( '_', $round_value );

						$sql	= "SELECT * FROM " . TGROUPS_TABLE . " WHERE group_tournament = {$this->data[ 'tournament_id' ]} AND group_bracket = {$bap[ 0 ]} AND group_position = {$bap[ 1 ]} AND group_loser = 1";
						$result	= $db->sql_query ( $sql );
						$row	= $db->sql_fetchrow ( $result );

						// Admin mode?
						if ( $admin == true )
						{
							// Test and see if they have a matchup.
							$test		= $this->get_matchup ( $bap[ 0 ], $bap[ 1 ], $this->data[ 'tournament_id' ], 1 );
							$move_on	= '(<a href="' . $u_action . '&amp;group_1=' . $row[ 'group_id' ] . '&amp;group_2=' . $test . '&amp;bracket=' . $bap[ 0 ] . '&amp;position=' . $bap[ 1 ] . '&amp;move=' . MOVE_RIGHT . '&amp;where=2&amp;tournament_id=' . $this->data[ 'tournament_id' ] . '&amp;submit=1"><img src="' . $phpbb_root_path . 'factions/images/icon_right.gif" /></a> | <a href="' . $u_action . '&amp;group_1=' . $row[ 'group_id' ] . '&amp;group_2=' . $test . '&amp;bracket=' . $bap[ 0 ] . '&amp;position=' . $bap[ 1 ] . '&amp;move=' . MOVE_LEFT . '&amp;where=2&amp;tournament_id=' . $this->data[ 'tournament_id' ] . '&amp;submit=1"><img src="' . $phpbb_root_path . 'factions/images/icon_left.gif" /></a> | <a href="' . $u_action . '&amp;group_1=' . $row[ 'group_id' ] . '&amp;group_2=' . $test . '&amp;bracket=' . $bap[ 0 ] . '&amp;position=' . $bap[ 1 ] . '&amp;move=' . MOVE_UP . '&amp;where=2&amp;tournament_id=' . $this->data[ 'tournament_id' ] . '&amp;submit=1"><img src="' . $phpbb_root_path . 'factions/images/icon_up.gif" /></a> | <a href="' . $u_action . '&amp;group_1=' . $row[ 'group_id' ] . '&amp;group_2=' . $test . '&amp;bracket=' . $bap[ 0 ] . '&amp;position=' . $bap[ 1 ] . '&amp;move=' . MOVE_DOWN . '&amp;where=2&amp;tournament_id=' . $this->data[ 'tournament_id' ] . '&amp;submit=1"><img src="' . $phpbb_root_path . 'factions/images/icon_down.gif" /></a>) <a href="' . $u_action . '&amp;remove_group=' . $row[ 'group_id' ] . '&amp;tournament_id=' . $this->data[ 'tournament_id' ] . '&amp;submit=1">' . $user->lang[ 'DELETE' ] . '</a>';
						}

						// Get the group's name and ID.
						if ( !empty ( $row[ 'group_id' ] ) )
						{
							$sql	= "SELECT * FROM " . GROUPS_TABLE . " WHERE group_id = " . $row[ 'group_id' ];
							$result	= $db->sql_query ( $sql );
							$row	= $db->sql_fetchrow ( $result );
						}

						// Group, bold it.
						$template->assign_block_vars ( 'block_rounds2.block_data2', array (
							'S_DATA' => '<strong><a href="' . append_sid ( $phpbb_root_path . 'factions.' . $phpEx, 'action=group_profile&amp;group_id=' . $row[ 'group_id' ] ) . '">' . $group->group_name ( $row [ 'group_name' ] ) . '</a></strong>',
							'S_MOVEON' => '[' . $move_on . ']',
							'S_COLOR' => 'row2',
							'S_BGCOLOR' => 'bg2' )
						);
					}

					// This adds a "spacer" every 3rd position to beautify the brackets.
					// count ( $round ) = number of groups in this bracket.
					if ( ( $x % 3 == 0 ) && $x != count ( $round ) )
					{
						// Assign dummy data to the template. S_DATA will contain a spacer, to make the brackets look nice.
						$template->assign_block_vars ( 'block_rounds.block_data', array (
							'S_DATA' => ( $rounds != 1 ) ? str_repeat ( '<br />', ( $rounds * 4 ) ) : '',
							'S_COLOR' => '',
							'S_BGCOLOR' => '' )
						);
					}
				}

				$i++;
			}

			$template->assign_vars ( array (
				'HAS_DOUBLEELIM' => $has_doubleelim )
			);
		}
	}

	/**
	 * Removes the group from a tournament.
	 *
	 * @param integer $group_id
	 * @param integer $tournament_id
	 * @return null
	 */
	function remove_group ( $group_id, $tournament_id = 0 )
	{
		global	$db;
		global	$user;
		global	$group;
		global	$template;
		global	$phpEx;
		global	$phpbb_root_path;

		$tournament_id	= ( $tournament_id == 0 ) ? $this->data[ 'tournament_id' ] : $tournament_id;

		// Remove the group from the brackets.
		$sql	= "DELETE FROM " . TGROUPS_TABLE . " WHERE group_id = $group_id AND group_tournament = " . $tournament_id;
		$db->sql_query ( $sql );

		$group	= new group ( );

		$tournaments	= unserialize ( $group->data ( 'group_tournaments', $group_id ) );
		foreach ( $tournaments AS $key => $value )
		{
			if ( $value == $tournament_id )
			{
				// Tournament IDs match, remove it.
				unset ( $tournaments[ $key ] );
			}
		}

		// Re-serialize the array for the database.
		$tournaments	= serialize ( $tournaments );

		// Update the group's data.
		$sql	= "UPDATE " . GROUPS_TABLE . " SET group_tournaments = '$tournaments' WHERE group_id = " . $group_id;
		$db->sql_query ( $result );
	}
}

?>
