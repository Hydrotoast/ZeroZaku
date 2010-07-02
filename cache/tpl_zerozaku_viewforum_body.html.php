<?php if (!defined('IN_PHPBB')) exit; $this->_tpldata['DEFINE']['.']['CA_PAGE'] = 'viewforum'; $this->_tpl_include('overall_header.html'); if ($this->_rootref['FORUM_DESC'] || $this->_rootref['FORUM_SEO_DESC']) {  ?>

	<div class="panel smooth <?php if ($this->_rootref['FORUM_SEO_DESC']) {  ?>tag<?php } ?>">
			<?php if ($this->_rootref['FORUM_SEO_DESC']) {  ?><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/tags/speechbubble_2.png" alt="<?php echo (isset($this->_rootref['FORUM_SEO_KEY'])) ? $this->_rootref['FORUM_SEO_KEY'] : ''; ?>" /><h2 class="infotitle"><?php echo (isset($this->_rootref['FORUM_SEO_KEY'])) ? $this->_rootref['FORUM_SEO_KEY'] : ''; ?></h2><p><span><?php echo (isset($this->_rootref['FORUM_SEO_DESC'])) ? $this->_rootref['FORUM_SEO_DESC'] : ''; ?></span></p>
			<?php } else if ($this->_rootref['FORUM_DESC']) {  ?><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/info.png" alt="Forum Description" /><p><?php echo (isset($this->_rootref['FORUM_DESC'])) ? $this->_rootref['FORUM_DESC'] : ''; ?></p><?php } ?>

	</div>
<?php } if ($this->_rootref['S_HAS_SUBFORUM']) {  if (! $this->_rootref['S_IS_BOT'] && $this->_rootref['U_MARK_FORUMS']) {  ?>

<ul class="linklist">
	<?php if ($this->_rootref['MODERATORS']) {  ?><li class="moderators"><strong><?php if ($this->_rootref['S_SINGLE_MODERATOR']) {  echo ((isset($this->_rootref['L_MODERATOR'])) ? $this->_rootref['L_MODERATOR'] : ((isset($user->lang['MODERATOR'])) ? $user->lang['MODERATOR'] : '{ MODERATOR }')); } else { echo ((isset($this->_rootref['L_MODERATORS'])) ? $this->_rootref['L_MODERATORS'] : ((isset($user->lang['MODERATORS'])) ? $user->lang['MODERATORS'] : '{ MODERATORS }')); } ?>:</strong> <?php echo (isset($this->_rootref['MODERATORS'])) ? $this->_rootref['MODERATORS'] : ''; ?></li><?php } ?>

	<li class="rightside"><a class="button2 mark-read" href="<?php echo (isset($this->_rootref['U_MARK_FORUMS'])) ? $this->_rootref['U_MARK_FORUMS'] : ''; ?>"><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/eye.png" /> <?php echo ((isset($this->_rootref['L_MARK_FORUMS_READ'])) ? $this->_rootref['L_MARK_FORUMS_READ'] : ((isset($user->lang['MARK_FORUMS_READ'])) ? $user->lang['MARK_FORUMS_READ'] : '{ MARK_FORUMS_READ }')); ?></a></li>
</ul>
<?php } $this->_tpl_include('forumlist_body.html'); } if ($this->_rootref['S_FORUM_RULES']) {  ?>

	<div class="rules">
		<div class="inner">

		<?php if ($this->_rootref['U_FORUM_RULES']) {  ?>

			<a href="<?php echo (isset($this->_rootref['U_FORUM_RULES'])) ? $this->_rootref['U_FORUM_RULES'] : ''; ?>"><?php echo ((isset($this->_rootref['L_FORUM_RULES'])) ? $this->_rootref['L_FORUM_RULES'] : ((isset($user->lang['FORUM_RULES'])) ? $user->lang['FORUM_RULES'] : '{ FORUM_RULES }')); ?></a>
		<?php } else { ?>

			<strong><?php echo ((isset($this->_rootref['L_FORUM_RULES'])) ? $this->_rootref['L_FORUM_RULES'] : ((isset($user->lang['FORUM_RULES'])) ? $user->lang['FORUM_RULES'] : '{ FORUM_RULES }')); ?></strong><br />
			<?php echo (isset($this->_rootref['FORUM_RULES'])) ? $this->_rootref['FORUM_RULES'] : ''; ?>

		<?php } ?>


		</div>
	</div>
<?php } if ($this->_rootref['S_DISPLAY_POST_INFO'] || $this->_rootref['PAGINATION'] || $this->_rootref['TOTAL_POSTS'] || $this->_rootref['TOTAL_TOPICS']) {  ?>

	<div class="topic-actions" <?php if ($this->_rootref['S_HAS_SUBFORUM']) {  ?>style="margin-top: 10px;"<?php } ?>>

	<?php if (! $this->_rootref['S_IS_BOT'] && $this->_rootref['S_DISPLAY_POST_INFO']) {  ?>

		<div class="buttons">
			<div class="<?php if ($this->_rootref['S_IS_LOCKED']) {  ?>locked-icon<?php } else { ?>post-icon<?php } ?>"><a href="<?php echo (isset($this->_rootref['U_POST_NEW_TOPIC'])) ? $this->_rootref['U_POST_NEW_TOPIC'] : ''; ?>" title="<?php if ($this->_rootref['S_IS_LOCKED']) {  echo ((isset($this->_rootref['L_FORUM_LOCKED'])) ? $this->_rootref['L_FORUM_LOCKED'] : ((isset($user->lang['FORUM_LOCKED'])) ? $user->lang['FORUM_LOCKED'] : '{ FORUM_LOCKED }')); } else { echo ((isset($this->_rootref['L_POST_TOPIC'])) ? $this->_rootref['L_POST_TOPIC'] : ((isset($user->lang['POST_TOPIC'])) ? $user->lang['POST_TOPIC'] : '{ POST_TOPIC }')); } ?>"><span></span><?php if ($this->_rootref['S_IS_LOCKED']) {  echo ((isset($this->_rootref['L_FORUM_LOCKED'])) ? $this->_rootref['L_FORUM_LOCKED'] : ((isset($user->lang['FORUM_LOCKED'])) ? $user->lang['FORUM_LOCKED'] : '{ FORUM_LOCKED }')); } else { echo ((isset($this->_rootref['L_NEW_TOPIC'])) ? $this->_rootref['L_NEW_TOPIC'] : ((isset($user->lang['NEW_TOPIC'])) ? $user->lang['NEW_TOPIC'] : '{ NEW_TOPIC }')); } ?></a></div>
		</div>
	<?php } if ($this->_rootref['S_DISPLAY_SEARCHBOX']) {  ?>

		<div class="search-box">
			<form method="post" id="forum-search" action="<?php echo (isset($this->_rootref['S_SEARCHBOX_ACTION'])) ? $this->_rootref['S_SEARCHBOX_ACTION'] : ''; ?>">
			<fieldset>
				<input class="inputbox search tiny" type="text" name="keywords" id="search_keywords" size="20" value="<?php echo ((isset($this->_rootref['L_SEARCH_FORUM'])) ? $this->_rootref['L_SEARCH_FORUM'] : ((isset($user->lang['SEARCH_FORUM'])) ? $user->lang['SEARCH_FORUM'] : '{ SEARCH_FORUM }')); ?>" onclick="if (this.value == '<?php echo ((isset($this->_rootref['LA_SEARCH_FORUM'])) ? $this->_rootref['LA_SEARCH_FORUM'] : ((isset($this->_rootref['L_SEARCH_FORUM'])) ? addslashes($this->_rootref['L_SEARCH_FORUM']) : ((isset($user->lang['SEARCH_FORUM'])) ? addslashes($user->lang['SEARCH_FORUM']) : '{ SEARCH_FORUM }'))); ?>') this.value = '';" onblur="if (this.value == '') this.value = '<?php echo ((isset($this->_rootref['LA_SEARCH_FORUM'])) ? $this->_rootref['LA_SEARCH_FORUM'] : ((isset($this->_rootref['L_SEARCH_FORUM'])) ? addslashes($this->_rootref['L_SEARCH_FORUM']) : ((isset($user->lang['SEARCH_FORUM'])) ? addslashes($user->lang['SEARCH_FORUM']) : '{ SEARCH_FORUM }'))); ?>';" />
				<input class="button2" type="submit" value="<?php echo ((isset($this->_rootref['L_SEARCH'])) ? $this->_rootref['L_SEARCH'] : ((isset($user->lang['SEARCH'])) ? $user->lang['SEARCH'] : '{ SEARCH }')); ?>" />
				<input type="hidden" value="<?php echo (isset($this->_rootref['FORUM_ID'])) ? $this->_rootref['FORUM_ID'] : ''; ?>" name="fid[]" />
			</fieldset>
			</form>
		</div>
	<?php } if ($this->_rootref['PAGINATION'] || $this->_rootref['TOTAL_POSTS'] || $this->_rootref['TOTAL_TOPICS']) {  ?>

		<div class="pagination">
			<?php if (! $this->_rootref['S_IS_BOT'] && $this->_rootref['U_MARK_TOPICS']) {  ?><a class="button2 mark-read" href="<?php echo (isset($this->_rootref['U_MARK_TOPICS'])) ? $this->_rootref['U_MARK_TOPICS'] : ''; ?>" accesskey="m"><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/eye.png" /> <?php echo ((isset($this->_rootref['L_MARK_TOPICS_READ'])) ? $this->_rootref['L_MARK_TOPICS_READ'] : ((isset($user->lang['MARK_TOPICS_READ'])) ? $user->lang['MARK_TOPICS_READ'] : '{ MARK_TOPICS_READ }')); ?></a> &bull; <?php } if ($this->_rootref['TOTAL_TOPICS']) {  echo (isset($this->_rootref['TOTAL_TOPICS'])) ? $this->_rootref['TOTAL_TOPICS'] : ''; } if ($this->_rootref['PAGE_NUMBER']) {  if ($this->_rootref['PAGINATION']) {  ?> &bull; <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { ?> &bull; <?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } } ?>

		</div>
	<?php } ?>


	</div>
<?php } if ($this->_rootref['S_NO_READ_ACCESS']) {  ?>


	<div class="panel">
		<div class="inner">
		<strong><?php echo ((isset($this->_rootref['L_NO_READ_ACCESS'])) ? $this->_rootref['L_NO_READ_ACCESS'] : ((isset($user->lang['NO_READ_ACCESS'])) ? $user->lang['NO_READ_ACCESS'] : '{ NO_READ_ACCESS }')); ?></strong>
		</div>
	</div>

	<?php if (! $this->_rootref['S_USER_LOGGED_IN'] && ! $this->_rootref['S_IS_BOT']) {  ?>


		<form action="<?php echo (isset($this->_rootref['S_LOGIN_ACTION'])) ? $this->_rootref['S_LOGIN_ACTION'] : ''; ?>" method="post">

		<div class="panel">
			<div class="inner">

			<div class="content">
				<h3><a href="<?php echo (isset($this->_rootref['U_LOGIN_LOGOUT'])) ? $this->_rootref['U_LOGIN_LOGOUT'] : ''; ?>"><?php echo ((isset($this->_rootref['L_LOGIN_LOGOUT'])) ? $this->_rootref['L_LOGIN_LOGOUT'] : ((isset($user->lang['LOGIN_LOGOUT'])) ? $user->lang['LOGIN_LOGOUT'] : '{ LOGIN_LOGOUT }')); ?></a><?php if ($this->_rootref['S_REGISTER_ENABLED']) {  ?>&nbsp; &bull; &nbsp;<a href="<?php echo (isset($this->_rootref['U_REGISTER'])) ? $this->_rootref['U_REGISTER'] : ''; ?>"><?php echo ((isset($this->_rootref['L_REGISTER'])) ? $this->_rootref['L_REGISTER'] : ((isset($user->lang['REGISTER'])) ? $user->lang['REGISTER'] : '{ REGISTER }')); ?></a><?php } ?></h3>

				<fieldset class="fields1">
				<dl>
					<dt><label for="username"><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>:</label></dt>
					<dd><input type="text" tabindex="1" name="username" id="username" size="25" value="<?php echo (isset($this->_rootref['USERNAME'])) ? $this->_rootref['USERNAME'] : ''; ?>" class="inputbox autowidth" /></dd>
				</dl>
				<dl>
					<dt><label for="password"><?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?>:</label></dt>
					<dd><input type="password" tabindex="2" id="password" name="password" size="25" class="inputbox autowidth" /></dd>
					<?php if ($this->_rootref['S_AUTOLOGIN_ENABLED']) {  ?><dd><label for="autologin"><input type="checkbox" name="autologin" id="autologin" tabindex="3" /> <?php echo ((isset($this->_rootref['L_LOG_ME_IN'])) ? $this->_rootref['L_LOG_ME_IN'] : ((isset($user->lang['LOG_ME_IN'])) ? $user->lang['LOG_ME_IN'] : '{ LOG_ME_IN }')); ?></label></dd><?php } ?>

					<dd><label for="viewonline"><input type="checkbox" name="viewonline" id="viewonline" tabindex="4" /> <?php echo ((isset($this->_rootref['L_HIDE_ME'])) ? $this->_rootref['L_HIDE_ME'] : ((isset($user->lang['HIDE_ME'])) ? $user->lang['HIDE_ME'] : '{ HIDE_ME }')); ?></label></dd>
				</dl>
				<dl>
					<dt>&nbsp;</dt>
					<dd><input type="submit" name="login" tabindex="5" value="<?php echo ((isset($this->_rootref['L_LOGIN'])) ? $this->_rootref['L_LOGIN'] : ((isset($user->lang['LOGIN'])) ? $user->lang['LOGIN'] : '{ LOGIN }')); ?>" class="button1" /></dd>
				</dl>
				<?php echo (isset($this->_rootref['S_LOGIN_REDIRECT'])) ? $this->_rootref['S_LOGIN_REDIRECT'] : ''; ?>

				</fieldset>
			</div>

			</div>
		</div>

		</form>

	<?php } } if ((topicrow) && $this->_rootref['S_IS_POSTABLE'] && ! $this->_rootref['S_IS_LOCKED']) {  ?>

<h2 class="cattitle"><a href="<?php echo (isset($this->_rootref['U_VIEW_FORUM'])) ? $this->_rootref['U_VIEW_FORUM'] : ''; ?>"><?php echo (isset($this->_rootref['FORUM_NAME'])) ? $this->_rootref['FORUM_NAME'] : ''; ?></a></h2>
<div class="forumbg<?php if ($_topicrow_val['S_TOPIC_TYPE_SWITCH']) {  ?> announcement<?php } ?>">
<?php } $this->_tpldata['DEFINE']['.']['STICKY'] = 0; $_topicrow_count = (isset($this->_tpldata['topicrow'])) ? sizeof($this->_tpldata['topicrow']) : 0;if ($_topicrow_count) {for ($_topicrow_i = 0; $_topicrow_i < $_topicrow_count; ++$_topicrow_i){$_topicrow_val = &$this->_tpldata['topicrow'][$_topicrow_i]; if (! $_topicrow_val['S_TOPIC_TYPE_SWITCH'] && ! $_topicrow_val['S_FIRST_ROW']) {  ?>

	</ul></li></ul>
<?php } if ($_topicrow_val['S_FIRST_ROW'] && ! $_topicrow_val['S_POST_STICKY'] || ! $_topicrow_val['S_TOPIC_TYPE_SWITCH']) {  ?>

	<ul class="topiclist forums">
	<li class="row">
		<dl class="meta">
			<dt class="forum"><?php if ($this->_rootref['S_DISPLAY_ACTIVE']) {  echo ((isset($this->_rootref['L_ACTIVE_TOPICS'])) ? $this->_rootref['L_ACTIVE_TOPICS'] : ((isset($user->lang['ACTIVE_TOPICS'])) ? $user->lang['ACTIVE_TOPICS'] : '{ ACTIVE_TOPICS }')); } else if ($_topicrow_val['S_TOPIC_TYPE_SWITCH'] && $_topicrow_val['S_TOPIC_TYPE'] > (1)) {  echo ((isset($this->_rootref['L_ANNOUNCEMENTS'])) ? $this->_rootref['L_ANNOUNCEMENTS'] : ((isset($user->lang['ANNOUNCEMENTS'])) ? $user->lang['ANNOUNCEMENTS'] : '{ ANNOUNCEMENTS }')); } else { echo ((isset($this->_rootref['L_TOPICS'])) ? $this->_rootref['L_TOPICS'] : ((isset($user->lang['TOPICS'])) ? $user->lang['TOPICS'] : '{ TOPICS }')); } ?></dt>
			<dd class="stats"><?php echo ((isset($this->_rootref['L_STATS'])) ? $this->_rootref['L_STATS'] : ((isset($user->lang['STATS'])) ? $user->lang['STATS'] : '{ STATS }')); ?></dd>
			<dd class="lastpost"><?php echo ((isset($this->_rootref['L_LAST_POST'])) ? $this->_rootref['L_LAST_POST'] : ((isset($user->lang['LAST_POST'])) ? $user->lang['LAST_POST'] : '{ LAST_POST }')); ?></dd>
		</dl>
	</li>
	<li><ul class="topiclist topics">	
<?php } else if ($_topicrow_val['S_TOPIC_TYPE_SWITCH'] && $_topicrow_val['S_POST_STICKY'] && $this->_tpldata['DEFINE']['.']['STICKY'] == 0) {  $this->_tpldata['DEFINE']['.']['STICKY'] = 1; ?>

	<ul class="topiclist forums">
	<li class="row">
		<dl class="meta">
			<dt class="forum"><?php if ($this->_rootref['S_DISPLAY_ACTIVE']) {  echo ((isset($this->_rootref['L_ACTIVE_TOPICS'])) ? $this->_rootref['L_ACTIVE_TOPICS'] : ((isset($user->lang['ACTIVE_TOPICS'])) ? $user->lang['ACTIVE_TOPICS'] : '{ ACTIVE_TOPICS }')); } else if ($_topicrow_val['S_TOPIC_TYPE_SWITCH'] && $_topicrow_val['S_TOPIC_TYPE'] == (1)) {  echo ((isset($this->_rootref['L_POST_STICKY'])) ? $this->_rootref['L_POST_STICKY'] : ((isset($user->lang['POST_STICKY'])) ? $user->lang['POST_STICKY'] : '{ POST_STICKY }')); } else { echo ((isset($this->_rootref['L_TOPICS'])) ? $this->_rootref['L_TOPICS'] : ((isset($user->lang['TOPICS'])) ? $user->lang['TOPICS'] : '{ TOPICS }')); } ?></dt>
			<dd class="stats"><?php echo ((isset($this->_rootref['L_STATS'])) ? $this->_rootref['L_STATS'] : ((isset($user->lang['STATS'])) ? $user->lang['STATS'] : '{ STATS }')); ?></dd>
			<dd class="lastpost"><?php echo ((isset($this->_rootref['L_LAST_POST'])) ? $this->_rootref['L_LAST_POST'] : ((isset($user->lang['LAST_POST'])) ? $user->lang['LAST_POST'] : '{ LAST_POST }')); ?></dd>
		</dl>
	</li>
	<li><ul class="topiclist topics">
<?php } ?>



	<li class="row<?php if (!($_topicrow_val['S_ROW_COUNT'] & 1)  ) {  ?> bg1<?php } else { ?> bg2<?php } if ($_topicrow_val['S_POST_ANNOUNCE']) {  ?> announce<?php } if ($_topicrow_val['S_POST_STICKY']) {  ?> sticky<?php } if ($_topicrow_val['S_TOPIC_REPORTED'] || $_topicrow_val['S_TOPIC_DELETED']) {  ?> reported<?php } ?>">
		<dl class="icon">
			<dt<?php if ($_topicrow_val['TOPIC_ICON_IMG'] && $this->_rootref['S_TOPIC_ICONS']) {  ?> style="background-image: url(<?php echo (isset($this->_rootref['T_ICONS_PATH'])) ? $this->_rootref['T_ICONS_PATH'] : ''; echo $_topicrow_val['TOPIC_ICON_IMG']; ?>); background-repeat: no-repeat;"<?php } else { ?> style="background-image: url(<?php echo $_topicrow_val['TOPIC_FOLDER_IMG_SRC']; ?>); background-repeat: no-repeat; background-position: 10px center"<?php } ?> title="<?php echo $_topicrow_val['TOPIC_FOLDER_IMG_ALT']; ?>">
				<?php if ($_topicrow_val['S_UNREAD_TOPIC']) {  ?><a href="<?php echo $_topicrow_val['U_NEWEST_POST']; ?>"><?php echo (isset($this->_rootref['NEWEST_POST_IMG'])) ? $this->_rootref['NEWEST_POST_IMG'] : ''; ?></a> <?php } ?>

				<a href="<?php echo $_topicrow_val['U_VIEW_TOPIC']; ?>" class="topictitle"><?php if ($_topicrow_val['S_TOPIC_REPORTED']) {  ?><span class="meta">[reported]</span><?php } ?><h3><?php echo $_topicrow_val['TOPIC_TITLE']; ?></h3></a>
				<?php if ($_topicrow_val['S_TOPIC_UNAPPROVED'] || $_topicrow_val['S_POSTS_UNAPPROVED']) {  ?><a href="<?php echo $_topicrow_val['U_MCP_QUEUE']; ?>"><?php echo $_topicrow_val['UNAPPROVED_IMG']; ?></a> <?php } if ($_topicrow_val['S_TOPIC_REPORTED']) {  ?><a href="<?php echo $_topicrow_val['U_MCP_REPORT']; ?>"><?php echo (isset($this->_rootref['REPORTED_IMG'])) ? $this->_rootref['REPORTED_IMG'] : ''; ?></a><?php } if ($_topicrow_val['PAGINATION']) {  ?><strong class="pagination"><span><?php echo $_topicrow_val['PAGINATION']; ?></span></strong><?php } ?>

				<br /><span class="author"><?php if ($_topicrow_val['ATTACH_ICON_IMG']) {  echo $_topicrow_val['ATTACH_ICON_IMG']; ?> <?php } echo ((isset($this->_rootref['L_POST_BY_AUTHOR'])) ? $this->_rootref['L_POST_BY_AUTHOR'] : ((isset($user->lang['POST_BY_AUTHOR'])) ? $user->lang['POST_BY_AUTHOR'] : '{ POST_BY_AUTHOR }')); ?> <?php echo $_topicrow_val['TOPIC_AUTHOR_FULL']; ?></span>
			</dt>
			<dd class="stats"><?php echo $_topicrow_val['VIEWS']; ?> <dfn><?php echo ((isset($this->_rootref['L_VIEWS'])) ? $this->_rootref['L_VIEWS'] : ((isset($user->lang['VIEWS'])) ? $user->lang['VIEWS'] : '{ VIEWS }')); ?></dfn><br /><?php echo $_topicrow_val['REPLIES']; ?> <dfn><?php echo ((isset($this->_rootref['L_REPLIES'])) ? $this->_rootref['L_REPLIES'] : ((isset($user->lang['REPLIES'])) ? $user->lang['REPLIES'] : '{ REPLIES }')); ?></dfn></dd>
			<dd class="lastpost">
					<?php echo ((isset($this->_rootref['L_POST_BY_AUTHOR'])) ? $this->_rootref['L_POST_BY_AUTHOR'] : ((isset($user->lang['POST_BY_AUTHOR'])) ? $user->lang['POST_BY_AUTHOR'] : '{ POST_BY_AUTHOR }')); ?> <?php echo $_topicrow_val['LAST_POST_AUTHOR_FULL']; ?>

					<?php if (! $this->_rootref['S_IS_BOT']) {  ?><a href="<?php echo $_topicrow_val['U_LAST_POST']; ?>"><?php echo (isset($this->_rootref['LAST_POST_IMG'])) ? $this->_rootref['LAST_POST_IMG'] : ''; ?></a> <?php } ?><br /><span class="date"><?php echo $_topicrow_val['LAST_POST_TIME']; ?></span>
			</dd>
		</dl>
	</li>

<?php if ($_topicrow_val['S_LAST_ROW']) {  ?>

	</ul></li></ul>
</div>
<?php } }} else { if ($this->_rootref['S_IS_POSTABLE'] && ! $this->_rootref['S_IS_LOCKED']) {  ?>

	<div class="panel info">
		<img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/info.png" alt="<?php echo ((isset($this->_rootref['L_NO_TOPICS'])) ? $this->_rootref['L_NO_TOPICS'] : ((isset($user->lang['NO_TOPICS'])) ? $user->lang['NO_TOPICS'] : '{ NO_TOPICS }')); ?>" /><p><strong><?php echo ((isset($this->_rootref['L_NO_TOPICS'])) ? $this->_rootref['L_NO_TOPICS'] : ((isset($user->lang['NO_TOPICS'])) ? $user->lang['NO_TOPICS'] : '{ NO_TOPICS }')); ?></strong>
	</div>
	
			</ul>
		</div>
	</div>
	<?php } } ?>


<div id="bottom-ad">
	<div class="adbrite"><!-- Begin: AdBrite, Generated: 2010-02-18 8:59:23  -->
		<script type="text/javascript">
		var AdBrite_Title_Color = '2D4054';
		var AdBrite_Text_Color = '212121';
		var AdBrite_Background_Color = 'FFFFFF';
		var AdBrite_Border_Color = 'D0D0D0';
		var AdBrite_URL_Color = 'FF530D';
		try{var AdBrite_Iframe=window.top!=window.self?2:1;var AdBrite_Referrer=document.referrer==''?document.location:document.referrer;AdBrite_Referrer=encodeURIComponent(AdBrite_Referrer);}catch(e){var AdBrite_Iframe='';var AdBrite_Referrer='';}
		</script>
		<span style="white-space:nowrap;"><script type="text/javascript">document.write(String.fromCharCode(60,83,67,82,73,80,84));document.write(' src="http://ads.adbrite.com/mb/text_group.php?sid=1535215&amp;zs=3732385f3930&amp;ifr='+AdBrite_Iframe+'&amp;ref='+AdBrite_Referrer+'" type="text/javascript">');document.write(String.fromCharCode(60,47,83,67,82,73,80,84,62));</script>
		<a href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=1535215&amp;afsid=1"><img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-leaderboard.gif" style="background-color:#D0D0D0;border:none;padding:0;margin:0;" alt="Your Ad Here" width="14" height="90" /></a></span>
		<!-- End: AdBrite -->
	</div>
</div>

<?php if ($this->_rootref['S_SELECT_SORT_DAYS'] && ! $this->_rootref['S_DISPLAY_ACTIVE']) {  ?>

	<form method="post" action="<?php echo (isset($this->_rootref['S_FORUM_ACTION'])) ? $this->_rootref['S_FORUM_ACTION'] : ''; ?>">
		<fieldset class="display-options">
			<?php if ($this->_rootref['PREVIOUS_PAGE']) {  ?><a href="<?php echo (isset($this->_rootref['PREVIOUS_PAGE'])) ? $this->_rootref['PREVIOUS_PAGE'] : ''; ?>" class="left-box <?php echo (isset($this->_rootref['S_CONTENT_FLOW_BEGIN'])) ? $this->_rootref['S_CONTENT_FLOW_BEGIN'] : ''; ?>"><?php echo ((isset($this->_rootref['L_PREVIOUS'])) ? $this->_rootref['L_PREVIOUS'] : ((isset($user->lang['PREVIOUS'])) ? $user->lang['PREVIOUS'] : '{ PREVIOUS }')); ?></a><?php } if ($this->_rootref['NEXT_PAGE']) {  ?><a href="<?php echo (isset($this->_rootref['NEXT_PAGE'])) ? $this->_rootref['NEXT_PAGE'] : ''; ?>" class="right-box <?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>"><?php echo ((isset($this->_rootref['L_NEXT'])) ? $this->_rootref['L_NEXT'] : ((isset($user->lang['NEXT'])) ? $user->lang['NEXT'] : '{ NEXT }')); ?></a><?php } if (! $this->_rootref['S_IS_BOT']) {  ?>

			<label><?php echo ((isset($this->_rootref['L_DISPLAY_TOPICS'])) ? $this->_rootref['L_DISPLAY_TOPICS'] : ((isset($user->lang['DISPLAY_TOPICS'])) ? $user->lang['DISPLAY_TOPICS'] : '{ DISPLAY_TOPICS }')); ?>: <?php echo (isset($this->_rootref['S_SELECT_SORT_DAYS'])) ? $this->_rootref['S_SELECT_SORT_DAYS'] : ''; ?></label>
			<label><?php echo ((isset($this->_rootref['L_SORT_BY'])) ? $this->_rootref['L_SORT_BY'] : ((isset($user->lang['SORT_BY'])) ? $user->lang['SORT_BY'] : '{ SORT_BY }')); ?> <?php echo (isset($this->_rootref['S_SELECT_SORT_KEY'])) ? $this->_rootref['S_SELECT_SORT_KEY'] : ''; ?></label>
			<label><?php echo (isset($this->_rootref['S_SELECT_SORT_DIR'])) ? $this->_rootref['S_SELECT_SORT_DIR'] : ''; ?> <input type="submit" name="sort" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" class="button2" /></label>
	<?php } ?>

		</fieldset>
	</form>
<?php } if (sizeof($this->_tpldata['topicrow']) && ! $this->_rootref['S_DISPLAY_ACTIVE']) {  ?>

	<div class="topic-actions">
		<?php if (! $this->_rootref['S_IS_BOT'] && $this->_rootref['S_DISPLAY_POST_INFO']) {  ?>

		<div class="buttons">
			<div class="<?php if ($this->_rootref['S_IS_LOCKED']) {  ?>locked-icon<?php } else { ?>post-icon<?php } ?>" title="<?php if ($this->_rootref['S_IS_LOCKED']) {  echo ((isset($this->_rootref['L_FORUM_LOCKED'])) ? $this->_rootref['L_FORUM_LOCKED'] : ((isset($user->lang['FORUM_LOCKED'])) ? $user->lang['FORUM_LOCKED'] : '{ FORUM_LOCKED }')); } else { echo ((isset($this->_rootref['L_POST_TOPIC'])) ? $this->_rootref['L_POST_TOPIC'] : ((isset($user->lang['POST_TOPIC'])) ? $user->lang['POST_TOPIC'] : '{ POST_TOPIC }')); } ?>">
				<a href="<?php echo (isset($this->_rootref['U_POST_NEW_TOPIC'])) ? $this->_rootref['U_POST_NEW_TOPIC'] : ''; ?>"><span></span><?php if ($this->_rootref['S_IS_LOCKED']) {  echo ((isset($this->_rootref['L_FORUM_LOCKED'])) ? $this->_rootref['L_FORUM_LOCKED'] : ((isset($user->lang['FORUM_LOCKED'])) ? $user->lang['FORUM_LOCKED'] : '{ FORUM_LOCKED }')); } else { echo ((isset($this->_rootref['L_NEW_TOPIC'])) ? $this->_rootref['L_NEW_TOPIC'] : ((isset($user->lang['NEW_TOPIC'])) ? $user->lang['NEW_TOPIC'] : '{ NEW_TOPIC }')); } ?></a>
			</div>
		</div>
		<?php } if ($this->_rootref['PAGINATION'] || $this->_rootref['TOTAL_POSTS'] || $this->_rootref['TOTAL_TOPICS']) {  ?>

		<div class="pagination">
			<?php if ($this->_rootref['TOTAL_TOPICS'] && ! $this->_rootref['S_IS_BOT'] && $this->_rootref['U_MARK_TOPICS']) {  ?><a href="<?php echo (isset($this->_rootref['U_MARK_TOPICS'])) ? $this->_rootref['U_MARK_TOPICS'] : ''; ?>"><?php echo ((isset($this->_rootref['L_MARK_TOPICS_READ'])) ? $this->_rootref['L_MARK_TOPICS_READ'] : ((isset($user->lang['MARK_TOPICS_READ'])) ? $user->lang['MARK_TOPICS_READ'] : '{ MARK_TOPICS_READ }')); ?></a> &bull;  <?php } if ($this->_rootref['TOTAL_POSTS'] && ! $this->_rootref['NEWEST_USER']) {  ?> <?php echo (isset($this->_rootref['TOTAL_POSTS'])) ? $this->_rootref['TOTAL_POSTS'] : ''; } else if ($this->_rootref['TOTAL_TOPICS'] && ! $this->_rootref['NEWEST_USER']) {  ?> <?php echo (isset($this->_rootref['TOTAL_TOPICS'])) ? $this->_rootref['TOTAL_TOPICS'] : ''; } if ($this->_rootref['TOTAL_USERS']) {  echo (isset($this->_rootref['TOTAL_USERS'])) ? $this->_rootref['TOTAL_USERS'] : ''; } if ($this->_rootref['PAGINATION']) {  ?> &bull;  <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a>
			 &bull;  <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { ?> &bull; <?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } ?>

		</div>
		<?php } ?>

	</div>
<?php } if ($this->_rootref['QUICK_REPLY']) {  $this->_tpl_include('quick_reply.html'); } if ($this->_rootref['FORUM_SEO_BOTTOM']) {  ?><br /><div><span><?php echo (isset($this->_rootref['FORUM_SEO_BOTTOM'])) ? $this->_rootref['FORUM_SEO_BOTTOM'] : ''; ?></span></div><?php } $this->_tpl_include('jumpbox.html'); ?>


<div id="board-statistics">
	<?php if ($this->_rootref['S_DISPLAY_ONLINE_LIST']) {  ?>

		<h3><?php if ($this->_rootref['U_VIEWONLINE']) {  ?><a href="<?php echo (isset($this->_rootref['U_VIEWONLINE'])) ? $this->_rootref['U_VIEWONLINE'] : ''; ?>"><?php echo ((isset($this->_rootref['L_WHO_IS_ONLINE'])) ? $this->_rootref['L_WHO_IS_ONLINE'] : ((isset($user->lang['WHO_IS_ONLINE'])) ? $user->lang['WHO_IS_ONLINE'] : '{ WHO_IS_ONLINE }')); ?></a><?php } else { echo ((isset($this->_rootref['L_WHO_IS_ONLINE'])) ? $this->_rootref['L_WHO_IS_ONLINE'] : ((isset($user->lang['WHO_IS_ONLINE'])) ? $user->lang['WHO_IS_ONLINE'] : '{ WHO_IS_ONLINE }')); } ?></h3>
		<p><?php echo (isset($this->_rootref['LOGGED_IN_USER_LIST'])) ? $this->_rootref['LOGGED_IN_USER_LIST'] : ''; ?></p>
	<?php } if ($this->_rootref['S_DISPLAY_POST_INFO']) {  ?>

		<h3><?php echo ((isset($this->_rootref['L_FORUM_PERMISSIONS'])) ? $this->_rootref['L_FORUM_PERMISSIONS'] : ((isset($user->lang['FORUM_PERMISSIONS'])) ? $user->lang['FORUM_PERMISSIONS'] : '{ FORUM_PERMISSIONS }')); ?></h3>
		<p><?php $_rules_count = (isset($this->_tpldata['rules'])) ? sizeof($this->_tpldata['rules']) : 0;if ($_rules_count) {for ($_rules_i = 0; $_rules_i < $_rules_count; ++$_rules_i){$_rules_val = &$this->_tpldata['rules'][$_rules_i]; echo $_rules_val['RULE']; ?><br /><?php }} ?></p>
	<?php } ?>

</div>
<?php $this->_tpl_include('overall_footer.html'); ?>