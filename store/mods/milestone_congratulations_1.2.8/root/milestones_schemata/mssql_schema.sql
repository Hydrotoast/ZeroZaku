/*

 $Id: $

*/

BEGIN TRANSACTION
GO

/*
	Table: 'phpbb_milestones'
*/
CREATE TABLE [phpbb_milestones] (
	[user_id] [int] DEFAULT (0) NOT NULL ,
	[milestone] [int] DEFAULT (0) NOT NULL ,
	[type] [int] DEFAULT (0) NOT NULL 
) ON [PRIMARY]
GO

CREATE  INDEX [user_id] ON [phpbb_milestones]([user_id]) ON [PRIMARY]
GO

CREATE  INDEX [milestone] ON [phpbb_milestones]([milestone]) ON [PRIMARY]
GO

CREATE  INDEX [type] ON [phpbb_milestones]([type]) ON [PRIMARY]
GO



COMMIT
GO

