<?php if (!defined('IN_PHPBB')) exit; ?></div>
	
	<?php if ($this->_tpldata['DEFINE']['.']['CA_PAGE'] == ('index')) {  ?>

	<div id="board-statistics">	
		<div class="stats">
			<h3><?php echo ((isset($this->_rootref['L_ST_TOT'])) ? $this->_rootref['L_ST_TOT'] : ((isset($user->lang['ST_TOT'])) ? $user->lang['ST_TOT'] : '{ ST_TOT }')); ?></h3>
			<dl>
				<dt><?php echo (isset($this->_rootref['TOTAL_POSTS'])) ? $this->_rootref['TOTAL_POSTS'] : ''; ?></dt> <dd><?php echo ((isset($this->_rootref['L_TOTAL_POSTS'])) ? $this->_rootref['L_TOTAL_POSTS'] : ((isset($user->lang['TOTAL_POSTS'])) ? $user->lang['TOTAL_POSTS'] : '{ TOTAL_POSTS }')); ?></dd>
				<dt><?php echo (isset($this->_rootref['TOTAL_TOPICS'])) ? $this->_rootref['TOTAL_TOPICS'] : ''; ?></dt> <dd><?php echo ((isset($this->_rootref['L_TOTAL_TOPICS'])) ? $this->_rootref['L_TOTAL_TOPICS'] : ((isset($user->lang['TOTAL_TOPICS'])) ? $user->lang['TOTAL_TOPICS'] : '{ TOTAL_TOPICS }')); ?></dd>
				<dt><?php echo (isset($this->_rootref['S_ANN'])) ? $this->_rootref['S_ANN'] : ''; ?></dt> <dd><?php echo ((isset($this->_rootref['L_ST_TOT_ANNS'])) ? $this->_rootref['L_ST_TOT_ANNS'] : ((isset($user->lang['ST_TOT_ANNS'])) ? $user->lang['ST_TOT_ANNS'] : '{ ST_TOT_ANNS }')); ?></dd>
				<dt><?php echo (isset($this->_rootref['S_SCT'])) ? $this->_rootref['S_SCT'] : ''; ?></dt> <dd><?php echo ((isset($this->_rootref['L_ST_TOT_STICKYS'])) ? $this->_rootref['L_ST_TOT_STICKYS'] : ((isset($user->lang['ST_TOT_STICKYS'])) ? $user->lang['ST_TOT_STICKYS'] : '{ ST_TOT_STICKYS }')); ?></dd>
				<dt><?php echo (isset($this->_rootref['S_TOT_ATTACH'])) ? $this->_rootref['S_TOT_ATTACH'] : ''; ?></dt> <dd><?php echo ((isset($this->_rootref['L_ST_TOT_ATTACH'])) ? $this->_rootref['L_ST_TOT_ATTACH'] : ((isset($user->lang['ST_TOT_ATTACH'])) ? $user->lang['ST_TOT_ATTACH'] : '{ ST_TOT_ATTACH }')); ?></dd>
				<dt><?php echo (isset($this->_rootref['TOTAL_USERS'])) ? $this->_rootref['TOTAL_USERS'] : ''; ?></dt> <dd><?php echo ((isset($this->_rootref['L_TOTAL_USERS'])) ? $this->_rootref['L_TOTAL_USERS'] : ((isset($user->lang['TOTAL_USERS'])) ? $user->lang['TOTAL_USERS'] : '{ TOTAL_USERS }')); ?></dd>
			</dl>
			
			<h3><?php echo ((isset($this->_rootref['L_24HOUR_STATS'])) ? $this->_rootref['L_24HOUR_STATS'] : ((isset($user->lang['24HOUR_STATS'])) ? $user->lang['24HOUR_STATS'] : '{ 24HOUR_STATS }')); ?></h3>
			<dl>
			<dt><?php echo (isset($this->_rootref['24HOUR_POSTS'])) ? $this->_rootref['24HOUR_POSTS'] : ''; ?></dt> <dd><?php echo ((isset($this->_rootref['L_24HOUR_POSTS'])) ? $this->_rootref['L_24HOUR_POSTS'] : ((isset($user->lang['24HOUR_POSTS'])) ? $user->lang['24HOUR_POSTS'] : '{ 24HOUR_POSTS }')); ?></dd>
			<dt><?php echo (isset($this->_rootref['24HOUR_TOPICS'])) ? $this->_rootref['24HOUR_TOPICS'] : ''; ?></dt> <dd><?php echo ((isset($this->_rootref['L_24HOUR_TOPICS'])) ? $this->_rootref['L_24HOUR_TOPICS'] : ((isset($user->lang['24HOUR_TOPICS'])) ? $user->lang['24HOUR_TOPICS'] : '{ 24HOUR_TOPICS }')); ?></dd>
			<dt><?php echo (isset($this->_rootref['24HOUR_USERS'])) ? $this->_rootref['24HOUR_USERS'] : ''; ?></dt> <dd><?php echo ((isset($this->_rootref['L_24HOUR_TOPICS'])) ? $this->_rootref['L_24HOUR_TOPICS'] : ((isset($user->lang['24HOUR_TOPICS'])) ? $user->lang['24HOUR_TOPICS'] : '{ 24HOUR_TOPICS }')); ?></dd>
			</dl>
		</div>
		
		<?php if ($this->_rootref['S_DISPLAY_ONLINE_LIST']) {  if ($this->_rootref['U_VIEWONLINE']) {  ?><h3><a href="<?php echo (isset($this->_rootref['U_VIEWONLINE'])) ? $this->_rootref['U_VIEWONLINE'] : ''; ?>"><?php echo ((isset($this->_rootref['L_WHO_IS_ONLINE'])) ? $this->_rootref['L_WHO_IS_ONLINE'] : ((isset($user->lang['WHO_IS_ONLINE'])) ? $user->lang['WHO_IS_ONLINE'] : '{ WHO_IS_ONLINE }')); ?></a></h3><?php } else { ?><h3><?php echo ((isset($this->_rootref['L_WHO_IS_ONLINE'])) ? $this->_rootref['L_WHO_IS_ONLINE'] : ((isset($user->lang['WHO_IS_ONLINE'])) ? $user->lang['WHO_IS_ONLINE'] : '{ WHO_IS_ONLINE }')); ?></h3><?php } ?>

			<p><?php echo (isset($this->_rootref['TOTAL_USERS_ONLINE'])) ? $this->_rootref['TOTAL_USERS_ONLINE'] : ''; ?> (<?php echo ((isset($this->_rootref['L_ONLINE_EXPLAIN'])) ? $this->_rootref['L_ONLINE_EXPLAIN'] : ((isset($user->lang['ONLINE_EXPLAIN'])) ? $user->lang['ONLINE_EXPLAIN'] : '{ ONLINE_EXPLAIN }')); ?>)<br /><?php echo (isset($this->_rootref['RECORD_USERS'])) ? $this->_rootref['RECORD_USERS'] : ''; ?><br /> <br /><?php echo (isset($this->_rootref['LOGGED_IN_USER_LIST'])) ? $this->_rootref['LOGGED_IN_USER_LIST'] : ''; ?></p>
			<?php if (! $this->_rootref['S_IS_BOT']) {  ?>

			<p><?php echo (isset($this->_rootref['USERS_24HOUR_TOTAL'])) ? $this->_rootref['USERS_24HOUR_TOTAL'] : ''; ?>: <?php $_lastvisit_count = (isset($this->_tpldata['lastvisit'])) ? sizeof($this->_tpldata['lastvisit']) : 0;if ($_lastvisit_count) {for ($_lastvisit_i = 0; $_lastvisit_i < $_lastvisit_count; ++$_lastvisit_i){$_lastvisit_val = &$this->_tpldata['lastvisit'][$_lastvisit_i]; echo $_lastvisit_val['USERNAME_FULL']; if (! $_lastvisit_val['S_LAST_ROW']) {  ?>, <?php } }} } ?><br />
			<p><?php echo (isset($this->_rootref['NEWEST_USER'])) ? $this->_rootref['NEWEST_USER'] : ''; ?></p>
			<?php if ($this->_rootref['LEGEND']) {  ?><h4><?php echo ((isset($this->_rootref['L_LEGEND'])) ? $this->_rootref['L_LEGEND'] : ((isset($user->lang['LEGEND'])) ? $user->lang['LEGEND'] : '{ LEGEND }')); ?>:</h4> <?php echo (isset($this->_rootref['LEGEND'])) ? $this->_rootref['LEGEND'] : ''; } ?></p>
		<?php } if ($this->_rootref['S_DISPLAY_BIRTHDAY_LIST'] && $this->_rootref['BIRTHDAY_LIST']) {  ?>

			<h3><?php echo ((isset($this->_rootref['L_BIRTHDAYS'])) ? $this->_rootref['L_BIRTHDAYS'] : ((isset($user->lang['BIRTHDAYS'])) ? $user->lang['BIRTHDAYS'] : '{ BIRTHDAYS }')); ?></h3>
			<p><?php if ($this->_rootref['BIRTHDAY_LIST']) {  echo ((isset($this->_rootref['L_CONGRATULATIONS'])) ? $this->_rootref['L_CONGRATULATIONS'] : ((isset($user->lang['CONGRATULATIONS'])) ? $user->lang['CONGRATULATIONS'] : '{ CONGRATULATIONS }')); ?>: <h4><?php echo (isset($this->_rootref['BIRTHDAY_LIST'])) ? $this->_rootref['BIRTHDAY_LIST'] : ''; ?></h4><?php } else { echo ((isset($this->_rootref['L_NO_BIRTHDAYS'])) ? $this->_rootref['L_NO_BIRTHDAYS'] : ((isset($user->lang['NO_BIRTHDAYS'])) ? $user->lang['NO_BIRTHDAYS'] : '{ NO_BIRTHDAYS }')); } ?></p>
		<?php } ?>

	</div>
	<?php } ?>


<div id="page-footer">

	<div id="footer-utilities">
		<ul class="linklist">
			<li class="icon-home"><a href="<?php echo (isset($this->_rootref['U_INDEX'])) ? $this->_rootref['U_INDEX'] : ''; ?>" accesskey="h"><?php echo ((isset($this->_rootref['L_INDEX'])) ? $this->_rootref['L_INDEX'] : ((isset($user->lang['INDEX'])) ? $user->lang['INDEX'] : '{ INDEX }')); ?></a></li>
				<?php if (! $this->_rootref['S_IS_BOT']) {  if ($this->_rootref['S_WATCH_FORUM_LINK']) {  ?><li <?php if ($this->_rootref['S_WATCHING_FORUM']) {  ?>class="icon-unsubscribe"<?php } else { ?>class="icon-subscribe"<?php } ?>><a href="<?php echo (isset($this->_rootref['S_WATCH_FORUM_LINK'])) ? $this->_rootref['S_WATCH_FORUM_LINK'] : ''; ?>" title="<?php echo (isset($this->_rootref['S_WATCH_FORUM_TITLE'])) ? $this->_rootref['S_WATCH_FORUM_TITLE'] : ''; ?>"><?php echo (isset($this->_rootref['S_WATCH_FORUM_TITLE'])) ? $this->_rootref['S_WATCH_FORUM_TITLE'] : ''; ?></a></li><?php } if ($this->_rootref['U_WATCH_TOPIC']) {  ?><li <?php if ($this->_rootref['S_WATCHING_TOPIC']) {  ?>class="icon-unsubscribe"<?php } else { ?>class="icon-subscribe"<?php } ?>><a href="<?php echo (isset($this->_rootref['U_WATCH_TOPIC'])) ? $this->_rootref['U_WATCH_TOPIC'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_WATCH_TOPIC'])) ? $this->_rootref['L_WATCH_TOPIC'] : ((isset($user->lang['WATCH_TOPIC'])) ? $user->lang['WATCH_TOPIC'] : '{ WATCH_TOPIC }')); ?>"><?php echo ((isset($this->_rootref['L_WATCH_TOPIC'])) ? $this->_rootref['L_WATCH_TOPIC'] : ((isset($user->lang['WATCH_TOPIC'])) ? $user->lang['WATCH_TOPIC'] : '{ WATCH_TOPIC }')); ?></a></li><?php } if ($this->_rootref['U_BOOKMARK_TOPIC']) {  ?><li class="icon-bookmark"><a href="<?php echo (isset($this->_rootref['U_BOOKMARK_TOPIC'])) ? $this->_rootref['U_BOOKMARK_TOPIC'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_BOOKMARK_TOPIC'])) ? $this->_rootref['L_BOOKMARK_TOPIC'] : ((isset($user->lang['BOOKMARK_TOPIC'])) ? $user->lang['BOOKMARK_TOPIC'] : '{ BOOKMARK_TOPIC }')); ?>"><?php echo ((isset($this->_rootref['L_BOOKMARK_TOPIC'])) ? $this->_rootref['L_BOOKMARK_TOPIC'] : ((isset($user->lang['BOOKMARK_TOPIC'])) ? $user->lang['BOOKMARK_TOPIC'] : '{ BOOKMARK_TOPIC }')); ?></a></li><?php } if ($this->_rootref['U_BUMP_TOPIC']) {  ?><li class="icon-bump"><a href="<?php echo (isset($this->_rootref['U_BUMP_TOPIC'])) ? $this->_rootref['U_BUMP_TOPIC'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_BUMP_TOPIC'])) ? $this->_rootref['L_BUMP_TOPIC'] : ((isset($user->lang['BUMP_TOPIC'])) ? $user->lang['BUMP_TOPIC'] : '{ BUMP_TOPIC }')); ?>"><?php echo ((isset($this->_rootref['L_BUMP_TOPIC'])) ? $this->_rootref['L_BUMP_TOPIC'] : ((isset($user->lang['BUMP_TOPIC'])) ? $user->lang['BUMP_TOPIC'] : '{ BUMP_TOPIC }')); ?></a></li><?php } } ?>

				
			<li class="rightside"><?php if ($this->_rootref['S_DISPLAY_MEMBERLIST']) {  ?><a href="<?php echo (isset($this->_rootref['U_MEMBERLIST'])) ? $this->_rootref['U_MEMBERLIST'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_MEMBERLIST_EXPLAIN'])) ? $this->_rootref['L_MEMBERLIST_EXPLAIN'] : ((isset($user->lang['MEMBERLIST_EXPLAIN'])) ? $user->lang['MEMBERLIST_EXPLAIN'] : '{ MEMBERLIST_EXPLAIN }')); ?>"><?php echo ((isset($this->_rootref['L_MEMBERLIST'])) ? $this->_rootref['L_MEMBERLIST'] : ((isset($user->lang['MEMBERLIST'])) ? $user->lang['MEMBERLIST'] : '{ MEMBERLIST }')); ?></a> &bull; <?php } if ($this->_rootref['S_MCHAT_ENABLE'] && $this->_rootref['U_MCHAT']) {  ?><a href="<?php echo (isset($this->_rootref['U_MCHAT'])) ? $this->_rootref['U_MCHAT'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_MCHAT'])) ? $this->_rootref['L_MCHAT'] : ((isset($user->lang['MCHAT'])) ? $user->lang['MCHAT'] : '{ MCHAT }')); ?>"><?php echo ((isset($this->_rootref['L_MCHAT'])) ? $this->_rootref['L_MCHAT'] : ((isset($user->lang['MCHAT'])) ? $user->lang['MCHAT'] : '{ MCHAT }')); ?></a> &bull; <?php } if (! $this->_rootref['S_IS_BOT']) {  ?><a href="<?php echo (isset($this->_rootref['U_DELETE_COOKIES'])) ? $this->_rootref['U_DELETE_COOKIES'] : ''; ?>"><?php echo ((isset($this->_rootref['L_DELETE_COOKIES'])) ? $this->_rootref['L_DELETE_COOKIES'] : ((isset($user->lang['DELETE_COOKIES'])) ? $user->lang['DELETE_COOKIES'] : '{ DELETE_COOKIES }')); ?></a> &bull; <?php } echo (isset($this->_rootref['S_TIMEZONE'])) ? $this->_rootref['S_TIMEZONE'] : ''; ?></li>
		</ul>
	</div>
	
<!--
	We request you retain the full copyright notice below including the link to www.phpbb.com.
	This not only gives respect to the large amount of time given freely by the developers
	but also helps build interest, traffic and use of phpBB3. If you (honestly) cannot retain
	the full copyright we ask you at least leave in place the "Powered by phpBB" line, with
	"phpBB" linked to www.phpbb.com. If you refuse to include even this then support on our
	forums may be affected.

	The phpBB Group : 2006
//-->

	<div class="copyright">Copyright &copy; 2009, 2010 ZeroZaku. All rights reserved.<br /> Powered by <a href="http://www.phpbb.com/">phpBB</a>
	
		<?php if ($this->_rootref['DEBUG_OUTPUT']) {  ?><br /><?php echo (isset($this->_rootref['DEBUG_OUTPUT'])) ? $this->_rootref['DEBUG_OUTPUT'] : ''; } ?>

	</div>
	<div class="util_links">
		<?php if ($this->_rootref['U_ACP']) {  ?><a href="<?php echo (isset($this->_rootref['U_ACP'])) ? $this->_rootref['U_ACP'] : ''; ?>"><?php echo ((isset($this->_rootref['L_ACP'])) ? $this->_rootref['L_ACP'] : ((isset($user->lang['ACP'])) ? $user->lang['ACP'] : '{ ACP }')); ?></a> &bull; <?php } if ($this->_rootref['U_TEAM']) {  ?><a href="<?php echo (isset($this->_rootref['U_TEAM'])) ? $this->_rootref['U_TEAM'] : ''; ?>"><?php echo ((isset($this->_rootref['L_THE_TEAM'])) ? $this->_rootref['L_THE_TEAM'] : ((isset($user->lang['THE_TEAM'])) ? $user->lang['THE_TEAM'] : '{ THE_TEAM }')); ?></a>  &bull; <?php } ?>

		<a href="<?php echo (isset($this->_rootref['U_FAQ'])) ? $this->_rootref['U_FAQ'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_FAQ_EXPLAIN'])) ? $this->_rootref['L_FAQ_EXPLAIN'] : ((isset($user->lang['FAQ_EXPLAIN'])) ? $user->lang['FAQ_EXPLAIN'] : '{ FAQ_EXPLAIN }')); ?>"><?php echo ((isset($this->_rootref['L_FAQ'])) ? $this->_rootref['L_FAQ'] : ((isset($user->lang['FAQ'])) ? $user->lang['FAQ'] : '{ FAQ }')); ?></a>
	</div>
</div>

</div>

<div><a id="bottom" name="bottom" accesskey="z"></a><?php if (! $this->_rootref['S_IS_BOT']) {  echo (isset($this->_rootref['RUN_CRON_TASK'])) ? $this->_rootref['RUN_CRON_TASK'] : ''; } ?></div>
<script type="text/javascript">var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));</script>
<script type="text/javascript">try {var pageTracker = _gat._getTracker("UA-6596797-2");pageTracker._trackPageview();} catch(err) {}</script>
<!-- Start Quantcast tag -->
<script type="text/javascript">_qoptions={qacct:"p-11CKqyQY5DO9Q"};</script>
<script type="text/javascript" src="http://edge.quantserve.com/quant.js"></script>
<noscript><img src="http://pixel.quantserve.com/pixel/p-11CKqyQY5DO9Q.gif" style="display: none;" height="1" width="1" alt="Quantcast"/></noscript>
<!-- End Quantcast tag -->
</body>
</html>