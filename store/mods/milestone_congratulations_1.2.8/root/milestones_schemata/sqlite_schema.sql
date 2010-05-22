#
# $Id: $
#

BEGIN TRANSACTION;

# Table: 'phpbb_milestones'
CREATE TABLE phpbb_milestones (
	user_id INTEGER UNSIGNED NOT NULL DEFAULT '0',
	milestone INTEGER UNSIGNED NOT NULL DEFAULT '0',
	type INTEGER UNSIGNED NOT NULL DEFAULT '0'
);

CREATE INDEX phpbb_milestones_user_id ON phpbb_milestones (user_id);
CREATE INDEX phpbb_milestones_milestone ON phpbb_milestones (milestone);
CREATE INDEX phpbb_milestones_type ON phpbb_milestones (type);


COMMIT;