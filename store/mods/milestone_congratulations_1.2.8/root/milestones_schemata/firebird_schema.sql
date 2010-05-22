#
# $Id: $
#


# Table: 'phpbb_milestones'
CREATE TABLE phpbb_milestones (
	user_id INTEGER DEFAULT 0 NOT NULL,
	milestone INTEGER DEFAULT 0 NOT NULL,
	type INTEGER DEFAULT 0 NOT NULL
);;

CREATE INDEX phpbb_milestones_user_id ON phpbb_milestones(user_id);;
CREATE INDEX phpbb_milestones_milestone ON phpbb_milestones(milestone);;
CREATE INDEX phpbb_milestones_type ON phpbb_milestones(type);;

