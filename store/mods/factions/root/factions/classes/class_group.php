<?php
##############################################################
# FILENAME  : class_group.php
# COPYRIGHT : (c) 2008, Tyler N. King <aibotca@yahoo.ca>
# http://opensource.org/licenses/gpl-license.php GNU Public License
##############################################################
if ( !defined ( 'IN_PHPBB' ) )
{
	exit;
}

/**
 * Group Class
 * This takes group information from the user's group in session, or takes information from the DB for a specific group.
 */
class group
{
	/**
	 * Contains the group's information.
	 *
	 * @var array
	 */
	var $data;

	/**
	 * Contains the group's ID.
	 *
	 * @var integer
	 */
	var $group_id;

	/**
	 * Gets the user's group information.
	 */
	function group ( )
	{
		global	$db;
		global	$user;

		// Get the group the user is logged into and grab it's data.
		$sql		= "SELECT group_session FROM " . USERS_TABLE . " WHERE user_id = " . $user->data[ 'user_id' ];
		$result		= $db->sql_query ( $sql );
		$row		= $db->sql_fetchrow ( $result );

		$this->group_id	= intval ( $row[ 'group_session' ] );
		$this->data		= $this->data ( );
	}

	/**
	 * Populates the array of data based on information from the arguments.
	 *
	 * @param string $feild
	 * @param integer $group_id
	 * @param integer $ladder_id
	 * @return array
	 */
	function data ( $field = '*', $group_id = 0, $ladder_id = 0 )
	{
		global	$db;

		// Are we dealing with a request or default request?
		$type	= ( $group_id != 0 ) ? $group_id : $this->group_id;

		if ( $ladder_id != 0 )
		{
			// Get the group's information for a specific ladder.
			$sql	= "SELECT gd.*, ud.user_id FROM " . GROUPDATA_TABLE . " gd, " . USER_GROUP_TABLE . " ud WHERE gd.group_id = $type AND gd.group_ladder = $ladder_id AND gd.group_id = ud.group_id AND ud.group_leader = 1";
			$result	= $db->sql_query ( $sql );
			$row	= $db->sql_fetchrow ( $result );

			if ( $field != '*' )
			{
				// Return the specific feild.
				return	$row[ ( $field != 'user_id' ) ? $field : 'user_id'  ];
			}
			else
			{
				return	$row;
			}
		}
		else
		{
			if ( $type != 0 )
			{
				// Get the group's information.
				$sql		= "SELECT gd.*, ud.user_id FROM " . GROUPS_TABLE . " gd, " . USER_GROUP_TABLE . " ud WHERE gd.group_id = $type AND ud.group_id = gd.group_id AND ud.group_leader = 1";
				$result		= $db->sql_query ( $sql );
				$row		= (array) $db->sql_fetchrow ( $result );

				if ( $field != '*' )
				{
					// Return the specific feild.
					return	$row[ ( $field != 'user_id' ) ? $field : 'user_id'  ];
				}
				else
				{
					// Get the ladders the group is joined to as well.
					$sql	= "SELECT group_ladder FROM " . GROUPDATA_TABLE . " WHERE group_id = " . $type;
					$result	= $db->sql_query ( $sql );

					$ladders	= array ( );
					while ( $rows = $db->sql_fetchrow ( $result ) )
					{
						$ladders[ ]	= $rows[ 'group_ladder' ];
					}

					$db->sql_freeresult ( $result );

					// Return the group's data and the group's ladder list.
					return	array_merge ( $row, array ( 'group_ladders' => $ladders ) );
				}
			}
			else
			{
				// Return an empty array set.
				return	array ( );
			}
		}
	}

	/**
	 * Creates a group.
	 * The group name has a unique ID to keep group names different.
	 *
	 * @param array $data
	 * @return null
	 */
	function add_group ( $data )
	{
		// Set the group ID to zero for reference.
		$group_id	= 0;

		// Create the unique ID for the group name.
		$group_name	= unique_id ( ) . '::' . $data[ 'group_name' ];

		// Create the group.
		group_create ( $group_id, GROUP_HIDDEN, $group_name, $data[ 'group_desc' ], array ( 'group_founder_manage' => 1, 'group_legend' => 0, 'group_avatar' => $data[ 'group_avatar' ], 'group_avatar_type' => $data[ 'group_avatar_type' ], 'group_avatar_width' => $data[ 'group_avatar_width' ], 'group_avatar_height' => $data[ 'group_avatar_height' ] ), true, true, true );
	}

	/**
	 * Edits a group.
	 * The group name has a unique ID to keep group names different.
	 *
	 * @param integer $group_id
	 * @param array $data
	 * @return null
	 */
	function edit_group ( $group_id, $data )
	{
		// Gets the group name from the group ID.
		$group_name	= get_group_name ( $group_id );
		$group_name	= explode ( '::', $group_name );

		// Updates the group's data.
		group_create ( $group_id, GROUP_HIDDEN, $group_name[ 0 ] . '::' . $data[ 'group_name' ], $data[ 'group_desc' ], array ( 'group_founder_manage' => 1, 'group_legend' => 0, 'group_avatar' => $data[ 'group_avatar' ], 'group_avatar_type' => $data[ 'group_avatar_type' ], 'group_avatar_width' => $data[ 'group_avatar_width' ], 'group_avatar_height' => $data[ 'group_avatar_height' ] ), true, true, true );
	}

	/**
	 * Fixes the group name for display.
	 *
	 * @param string $group_name
	 * @return string
	 */
	function group_name ( $group_name )
	{
		// Remove the unquie ID.
		$explode	= explode ( '::', $group_name );

		return	$explode[ 1 ];
	}

	/**
	 * Handles all the functions for the members.
	 *
	 * @param string $action
	 * @param integer $group_id
	 * @param integer $user_id
	 * @param integer $leader
	 * @return array
	 */
	function members ( $action, $group_id, $user_id = 0, $leader = 0, $pending = 0 )
	{
		global	$db;

		// Switch between the actions.
		switch ( $action )
		{
			case 'add' :
				// Adds a user to the group. Leader is set if given.
				group_user_add ( $group_id, array ( $user_id ), false, false, false, ( $leader != 0 ) ? 1 : 0, $pending );
			break;
			case 'demote' :
			case 'promote' :
				// Promotes or demotes a member.
				group_user_attributes ( $action, $group_id, array ( $user_id ) );
			break;
			case 'approve' :
				// Approves a pending member. Adds them to the group.
				group_user_attributes ( 'approve', $group_id, array ( $user_id ) );
			break;
			case 'remove' :
				// Removes a member from the group.
				group_user_del ( $group_id, array ( $user_id ) );
			break;
			case 'get_members' :
				// Gets all members. No pending members.
				$sql	= "SELECT user_id FROM " . USER_GROUP_TABLE . " WHERE user_pending = 0 AND group_id = " . $group_id;
				$result	= $db->sql_query ( $sql );

				$users	= array ( );
				while ( $row = $db->sql_fetchrow ( $result ) )
				{
					$users[ ]	= $row[ 'user_id' ];
				}

				$db->sql_freeresult ( );

				return	$users;
			case 'get_pending' :
				// Gets all pending members.
				$sql	= "SELECT user_id FROM " . USER_GROUP_TABLE . " WHERE user_pending = 1 AND group_id = " . $group_id;
				$result	= $db->sql_query ( $sql );

				$users	= array ( );
				while ( $row = $db->sql_fetchrow ( $result ) )
				{
					$users[ ]	= $row[ 'user_id' ];
				}

				$db->sql_freeresult ( );

				return	$users;
			break;
		}
	}
}

?>
