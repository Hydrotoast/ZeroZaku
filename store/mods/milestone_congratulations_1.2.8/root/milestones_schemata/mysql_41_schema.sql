#
# $Id: $
#

# Table: 'phpbb_milestones'
CREATE TABLE phpbb_milestones (
	user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	milestone mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	type smallint(4) UNSIGNED DEFAULT '0' NOT NULL,
	KEY user_id (user_id),
	KEY milestone (milestone),
	KEY type (type)
) CHARACTER SET `utf8` COLLATE `utf8_bin`;


