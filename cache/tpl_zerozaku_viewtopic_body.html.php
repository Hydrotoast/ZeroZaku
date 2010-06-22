<?php if (!defined('IN_PHPBB')) exit; $this->_tpldata['DEFINE']['.']['CA_PAGE'] = 'viewtopic'; $this->_tpl_include('overall_header.html'); $this->_tpl_include('portal/_block_config.html'); $this->_tpl_include('quickedit.html'); ?><!-- NOTE: remove the style="display: none" when you want to have the forum description on the topic body --><?php if ($this->_rootref['FORUM_DESC']) {  ?><div class="panel smooth info"><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/info.png" alt="Information" /><p><?php echo (isset($this->_rootref['FORUM_DESC'])) ? $this->_rootref['FORUM_DESC'] : ''; ?></p></div><?php } if ($this->_rootref['MODERATORS'] || $this->_rootref['U_MCP']) {  ?>

	<p>
		<?php if ($this->_rootref['MODERATORS']) {  ?>

			<strong><?php if ($this->_rootref['S_SINGLE_MODERATOR']) {  echo ((isset($this->_rootref['L_MODERATOR'])) ? $this->_rootref['L_MODERATOR'] : ((isset($user->lang['MODERATOR'])) ? $user->lang['MODERATOR'] : '{ MODERATOR }')); } else { echo ((isset($this->_rootref['L_MODERATORS'])) ? $this->_rootref['L_MODERATORS'] : ((isset($user->lang['MODERATORS'])) ? $user->lang['MODERATORS'] : '{ MODERATORS }')); } ?>:</strong> <?php echo (isset($this->_rootref['MODERATORS'])) ? $this->_rootref['MODERATORS'] : ''; ?>

		<?php } ?>


	</p>
<?php } if ($this->_rootref['S_FORUM_RULES']) {  ?>

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
<?php } ?>


<div class="topic-actions">

	<div class="buttons">
	<?php if (! $this->_rootref['S_IS_BOT'] && $this->_rootref['S_DISPLAY_REPLY_INFO']) {  ?>

		<div class="<?php if ($this->_rootref['S_IS_LOCKED']) {  ?>locked-icon<?php } else { ?>reply-icon<?php } ?>"><a href="<?php echo (isset($this->_rootref['U_POST_REPLY_TOPIC'])) ? $this->_rootref['U_POST_REPLY_TOPIC'] : ''; ?>" title="<?php if ($this->_rootref['S_IS_LOCKED']) {  echo ((isset($this->_rootref['L_TOPIC_LOCKED'])) ? $this->_rootref['L_TOPIC_LOCKED'] : ((isset($user->lang['TOPIC_LOCKED'])) ? $user->lang['TOPIC_LOCKED'] : '{ TOPIC_LOCKED }')); } else { echo ((isset($this->_rootref['L_POST_REPLY'])) ? $this->_rootref['L_POST_REPLY'] : ((isset($user->lang['POST_REPLY'])) ? $user->lang['POST_REPLY'] : '{ POST_REPLY }')); } ?>"><span></span><?php if ($this->_rootref['S_IS_LOCKED']) {  echo ((isset($this->_rootref['L_TOPIC_LOCKED_SHORT'])) ? $this->_rootref['L_TOPIC_LOCKED_SHORT'] : ((isset($user->lang['TOPIC_LOCKED_SHORT'])) ? $user->lang['TOPIC_LOCKED_SHORT'] : '{ TOPIC_LOCKED_SHORT }')); } else { echo ((isset($this->_rootref['L_REPLY'])) ? $this->_rootref['L_REPLY'] : ((isset($user->lang['REPLY'])) ? $user->lang['REPLY'] : '{ REPLY }')); } ?></a></div>
	<?php } ?>

	</div>

	<?php if ($this->_rootref['S_DISPLAY_SEARCHBOX']) {  ?>

		<div class="search-box">
			<form method="post" id="topic-search" action="<?php echo (isset($this->_rootref['S_SEARCHBOX_ACTION'])) ? $this->_rootref['S_SEARCHBOX_ACTION'] : ''; ?>">
			<fieldset>
				<input class="inputbox search tiny"  type="text" name="keywords" id="search_keywords" size="20" value="<?php echo ((isset($this->_rootref['L_SEARCH_TOPIC'])) ? $this->_rootref['L_SEARCH_TOPIC'] : ((isset($user->lang['SEARCH_TOPIC'])) ? $user->lang['SEARCH_TOPIC'] : '{ SEARCH_TOPIC }')); ?>" onclick="if(this.value=='<?php echo ((isset($this->_rootref['LA_SEARCH_TOPIC'])) ? $this->_rootref['LA_SEARCH_TOPIC'] : ((isset($this->_rootref['L_SEARCH_TOPIC'])) ? addslashes($this->_rootref['L_SEARCH_TOPIC']) : ((isset($user->lang['SEARCH_TOPIC'])) ? addslashes($user->lang['SEARCH_TOPIC']) : '{ SEARCH_TOPIC }'))); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo ((isset($this->_rootref['LA_SEARCH_TOPIC'])) ? $this->_rootref['LA_SEARCH_TOPIC'] : ((isset($this->_rootref['L_SEARCH_TOPIC'])) ? addslashes($this->_rootref['L_SEARCH_TOPIC']) : ((isset($user->lang['SEARCH_TOPIC'])) ? addslashes($user->lang['SEARCH_TOPIC']) : '{ SEARCH_TOPIC }'))); ?>';" />
				<input class="button2" type="submit" value="<?php echo ((isset($this->_rootref['L_SEARCH'])) ? $this->_rootref['L_SEARCH'] : ((isset($user->lang['SEARCH'])) ? $user->lang['SEARCH'] : '{ SEARCH }')); ?>" />
				<input type="hidden" value="<?php echo (isset($this->_rootref['TOPIC_ID'])) ? $this->_rootref['TOPIC_ID'] : ''; ?>" name="t" />
				<input type="hidden" value="msgonly" name="sf" />
			</fieldset>
			</form>
		</div>
	<?php } if ($this->_rootref['PAGINATION'] || $this->_rootref['TOTAL_POSTS']) {  ?>

		<div class="pagination">
			<?php if ($this->_rootref['U_VIEW_UNREAD_POST'] && ! $this->_rootref['S_IS_BOT']) {  ?><a href="<?php echo (isset($this->_rootref['U_VIEW_UNREAD_POST'])) ? $this->_rootref['U_VIEW_UNREAD_POST'] : ''; ?>"><?php echo ((isset($this->_rootref['L_VIEW_UNREAD_POST'])) ? $this->_rootref['L_VIEW_UNREAD_POST'] : ((isset($user->lang['VIEW_UNREAD_POST'])) ? $user->lang['VIEW_UNREAD_POST'] : '{ VIEW_UNREAD_POST }')); ?></a> &bull; <?php } echo (isset($this->_rootref['TOTAL_POSTS'])) ? $this->_rootref['TOTAL_POSTS'] : ''; ?>

			<?php if ($this->_rootref['PAGE_NUMBER']) {  if ($this->_rootref['PAGINATION']) {  ?> &bull; <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { ?> &bull; <?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } } ?>

		</div>
	<?php } ?>


</div>
<div class="clear"></div>

<?php if ($this->_rootref['S_HAS_POLL']) {  ?>

	<form method="post" action="<?php echo (isset($this->_rootref['S_POLL_ACTION'])) ? $this->_rootref['S_POLL_ACTION'] : ''; ?>">

	
	<div class="panel">
		<h2 class="polltitle"><?php echo (isset($this->_rootref['POLL_QUESTION'])) ? $this->_rootref['POLL_QUESTION'] : ''; ?></h2>
		<div class="inner">

		<div class="content">
			<p class="author"><?php echo ((isset($this->_rootref['L_POLL_LENGTH'])) ? $this->_rootref['L_POLL_LENGTH'] : ((isset($user->lang['POLL_LENGTH'])) ? $user->lang['POLL_LENGTH'] : '{ POLL_LENGTH }')); if ($this->_rootref['S_CAN_VOTE'] && $this->_rootref['L_POLL_LENGTH']) {  ?><br /><?php } if ($this->_rootref['S_CAN_VOTE']) {  echo ((isset($this->_rootref['L_MAX_VOTES'])) ? $this->_rootref['L_MAX_VOTES'] : ((isset($user->lang['MAX_VOTES'])) ? $user->lang['MAX_VOTES'] : '{ MAX_VOTES }')); } ?></p>

			<fieldset class="polls">
			<?php $_poll_option_count = (isset($this->_tpldata['poll_option'])) ? sizeof($this->_tpldata['poll_option']) : 0;if ($_poll_option_count) {for ($_poll_option_i = 0; $_poll_option_i < $_poll_option_count; ++$_poll_option_i){$_poll_option_val = &$this->_tpldata['poll_option'][$_poll_option_i]; ?>

				<dl class="<?php if ($_poll_option_val['POLL_OPTION_VOTED']) {  ?>voted<?php } ?>"<?php if ($_poll_option_val['POLL_OPTION_VOTED']) {  ?> title="<?php echo ((isset($this->_rootref['L_POLL_VOTED_OPTION'])) ? $this->_rootref['L_POLL_VOTED_OPTION'] : ((isset($user->lang['POLL_VOTED_OPTION'])) ? $user->lang['POLL_VOTED_OPTION'] : '{ POLL_VOTED_OPTION }')); ?>"<?php } ?>>
					<dt><?php if ($this->_rootref['S_CAN_VOTE']) {  ?><label for="vote_<?php echo $_poll_option_val['POLL_OPTION_ID']; ?>"><?php echo $_poll_option_val['POLL_OPTION_CAPTION']; ?></label><?php } else { echo $_poll_option_val['POLL_OPTION_CAPTION']; } ?></dt>
					<?php if ($this->_rootref['S_CAN_VOTE']) {  ?><dd style="width: auto;"><?php if ($this->_rootref['S_IS_MULTI_CHOICE']) {  ?><input type="checkbox" name="vote_id[]" id="vote_<?php echo $_poll_option_val['POLL_OPTION_ID']; ?>" value="<?php echo $_poll_option_val['POLL_OPTION_ID']; ?>"<?php if ($_poll_option_val['POLL_OPTION_VOTED']) {  ?> checked="checked"<?php } ?> /><?php } else { ?><input type="radio" name="vote_id[]" id="vote_<?php echo $_poll_option_val['POLL_OPTION_ID']; ?>" value="<?php echo $_poll_option_val['POLL_OPTION_ID']; ?>"<?php if ($_poll_option_val['POLL_OPTION_VOTED']) {  ?> checked="checked"<?php } ?> /><?php } ?></dd><?php } if ($this->_rootref['S_DISPLAY_RESULTS']) {  ?><dd class="resultbar"><div class="<?php if ($_poll_option_val['POLL_OPTION_PCT'] < (20)) {  ?>pollbar1<?php } else if ($_poll_option_val['POLL_OPTION_PCT'] < (40)) {  ?>pollbar2<?php } else if ($_poll_option_val['POLL_OPTION_PCT'] < (60)) {  ?>pollbar3<?php } else if ($_poll_option_val['POLL_OPTION_PCT'] < (80)) {  ?>pollbar4<?php } else { ?>pollbar5<?php } ?>" style="width:<?php echo $_poll_option_val['POLL_OPTION_PERCENT']; ?>;"><?php echo $_poll_option_val['POLL_OPTION_RESULT']; ?></div></dd>
					<dd><?php if ($_poll_option_val['POLL_OPTION_RESULT'] == 0) {  echo ((isset($this->_rootref['L_NO_VOTES'])) ? $this->_rootref['L_NO_VOTES'] : ((isset($user->lang['NO_VOTES'])) ? $user->lang['NO_VOTES'] : '{ NO_VOTES }')); } else { echo $_poll_option_val['POLL_OPTION_PERCENT']; } if ($this->_rootref['S_SHOW_VOTERS']) {  if (! $this->_rootref['S_CAN_VOTE']) {  ?><dt>&nbsp;</dt><?php } ?><dd class="resultbar"><?php echo $_poll_option_val['POLL_OPTION_VOTERS']; ?></dd><?php } ?></dd><?php } ?>

				</dl>
			<?php }} if ($this->_rootref['S_DISPLAY_RESULTS']) {  ?>

				<dl>
					<dt>&nbsp;</dt>
					<dd class="resultbar"><?php echo ((isset($this->_rootref['L_TOTAL_VOTES'])) ? $this->_rootref['L_TOTAL_VOTES'] : ((isset($user->lang['TOTAL_VOTES'])) ? $user->lang['TOTAL_VOTES'] : '{ TOTAL_VOTES }')); ?> : <?php echo (isset($this->_rootref['TOTAL_VOTES'])) ? $this->_rootref['TOTAL_VOTES'] : ''; ?></dd>
				</dl>
			<?php } if ($this->_rootref['S_CAN_VOTE']) {  ?>

				<dl style="border-top: none;">
					<dt>&nbsp;</dt>
					<dd class="resultbar"><input type="submit" name="update" value="<?php echo ((isset($this->_rootref['L_SUBMIT_VOTE'])) ? $this->_rootref['L_SUBMIT_VOTE'] : ((isset($user->lang['SUBMIT_VOTE'])) ? $user->lang['SUBMIT_VOTE'] : '{ SUBMIT_VOTE }')); ?>" class="button1" /></dd>
				</dl>
			<?php } if (! $this->_rootref['S_DISPLAY_RESULTS']) {  ?>

				<dl style="border-top: none;">
					<dt>&nbsp;</dt>
					<dd class="resultbar"><a href="<?php echo (isset($this->_rootref['U_VIEW_RESULTS'])) ? $this->_rootref['U_VIEW_RESULTS'] : ''; ?>"><?php echo ((isset($this->_rootref['L_VIEW_RESULTS'])) ? $this->_rootref['L_VIEW_RESULTS'] : ((isset($user->lang['VIEW_RESULTS'])) ? $user->lang['VIEW_RESULTS'] : '{ VIEW_RESULTS }')); ?></a></dd>
				</dl>
			<?php } ?>

			</fieldset>
		</div>

		</div>
		<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

		<?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?>

	</div>


	</form>
<?php } ?>


<h1 class="topictitle">
	<a href="<?php echo (isset($this->_rootref['U_VIEW_TOPIC'])) ? $this->_rootref['U_VIEW_TOPIC'] : ''; ?>"><?php echo (isset($this->_rootref['TOPIC_TITLE'])) ? $this->_rootref['TOPIC_TITLE'] : ''; ?></a>
	<?php if ($this->_rootref['U_PRINT_TOPIC']) {  ?><a href="<?php echo (isset($this->_rootref['U_PRINT_TOPIC'])) ? $this->_rootref['U_PRINT_TOPIC'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_PRINT_TOPIC'])) ? $this->_rootref['L_PRINT_TOPIC'] : ((isset($user->lang['PRINT_TOPIC'])) ? $user->lang['PRINT_TOPIC'] : '{ PRINT_TOPIC }')); ?>" accesskey="p" class="topicactions print"><?php echo ((isset($this->_rootref['L_PRINT_TOPIC'])) ? $this->_rootref['L_PRINT_TOPIC'] : ((isset($user->lang['PRINT_TOPIC'])) ? $user->lang['PRINT_TOPIC'] : '{ PRINT_TOPIC }')); ?></a><?php } if ($this->_rootref['U_PRINT_PM']) {  ?><a href="<?php echo (isset($this->_rootref['U_PRINT_PM'])) ? $this->_rootref['U_PRINT_PM'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_PRINT_PM'])) ? $this->_rootref['L_PRINT_PM'] : ((isset($user->lang['PRINT_PM'])) ? $user->lang['PRINT_PM'] : '{ PRINT_PM }')); ?>" accesskey="p" class="topicactions print"><?php echo ((isset($this->_rootref['L_PRINT_PM'])) ? $this->_rootref['L_PRINT_PM'] : ((isset($user->lang['PRINT_PM'])) ? $user->lang['PRINT_PM'] : '{ PRINT_PM }')); ?></a><?php } ?>

</h1>
<?php $_postrow_count = (isset($this->_tpldata['postrow'])) ? sizeof($this->_tpldata['postrow']) : 0;if ($_postrow_count) {for ($_postrow_i = 0; $_postrow_i < $_postrow_count; ++$_postrow_i){$_postrow_val = &$this->_tpldata['postrow'][$_postrow_i]; if ($_postrow_val['S_FIRST_UNREAD']) {  ?><a id="unread"></a><?php } ?>

	<div id="p<?php echo $_postrow_val['POST_ID']; ?>" class="post bg1<?php if ($_postrow_val['S_POST_DELETED']) {  ?> reported<?php } ?>">
		<div class="inner">
			
		<div class="postmeta">
			<div class="dropdown">
				<span class="username"><?php if ($_postrow_val['S_IS_BANNED']) {  ?><span class="banned"><?php echo $_postrow_val['POST_AUTHOR_FULL']; ?></span><?php } else { echo $_postrow_val['POST_AUTHOR_FULL']; } ?> <img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/dropdown_arrow.png" alt="Arrow" /></span>
				<?php if (! $this->_rootref['S_IS_BOT']) {  if ($_postrow_val['U_PM'] || $_postrow_val['U_EMAIL'] || $_postrow_val['U_WWW'] || $_postrow_val['U_MSN'] || $_postrow_val['U_ICQ'] || $_postrow_val['U_YIM'] || $_postrow_val['U_AIM'] || $_postrow_val['U_JABBER']) {  ?>

					<ul>
						<?php if ($_postrow_val['U_PM']) {  ?><li class="pm-icon"><a href="<?php echo $_postrow_val['U_PM']; ?>" title="<?php echo ((isset($this->_rootref['L_PRIVATE_MESSAGE'])) ? $this->_rootref['L_PRIVATE_MESSAGE'] : ((isset($user->lang['PRIVATE_MESSAGE'])) ? $user->lang['PRIVATE_MESSAGE'] : '{ PRIVATE_MESSAGE }')); ?>"><span><?php echo ((isset($this->_rootref['L_PRIVATE_MESSAGE'])) ? $this->_rootref['L_PRIVATE_MESSAGE'] : ((isset($user->lang['PRIVATE_MESSAGE'])) ? $user->lang['PRIVATE_MESSAGE'] : '{ PRIVATE_MESSAGE }')); ?></span></a></li><?php } if ($_postrow_val['U_EMAIL']) {  ?><li class="email-icon"><a href="<?php echo $_postrow_val['U_EMAIL']; ?>" title="<?php echo ((isset($this->_rootref['L_SEND_EMAIL_USER'])) ? $this->_rootref['L_SEND_EMAIL_USER'] : ((isset($user->lang['SEND_EMAIL_USER'])) ? $user->lang['SEND_EMAIL_USER'] : '{ SEND_EMAIL_USER }')); ?> <?php echo $_postrow_val['POST_AUTHOR']; ?>"><span><?php echo ((isset($this->_rootref['L_SEND_EMAIL_USER'])) ? $this->_rootref['L_SEND_EMAIL_USER'] : ((isset($user->lang['SEND_EMAIL_USER'])) ? $user->lang['SEND_EMAIL_USER'] : '{ SEND_EMAIL_USER }')); ?> <?php echo $_postrow_val['POST_AUTHOR']; ?></span></a></li><?php } if ($_postrow_val['U_WWW']) {  ?><li class="web-icon"><a href="<?php echo $_postrow_val['U_WWW']; ?>" title="<?php echo ((isset($this->_rootref['L_VISIT_WEBSITE'])) ? $this->_rootref['L_VISIT_WEBSITE'] : ((isset($user->lang['VISIT_WEBSITE'])) ? $user->lang['VISIT_WEBSITE'] : '{ VISIT_WEBSITE }')); ?>: <?php echo $_postrow_val['U_WWW']; ?>"><span><?php echo ((isset($this->_rootref['L_WEBSITE'])) ? $this->_rootref['L_WEBSITE'] : ((isset($user->lang['WEBSITE'])) ? $user->lang['WEBSITE'] : '{ WEBSITE }')); ?></span></a></li><?php } if ($_postrow_val['U_MSN']) {  ?><li class="msnm-icon"><a href="<?php echo $_postrow_val['U_MSN']; ?>" onclick="popup(this.href, 550, 320); return false;" title="<?php echo ((isset($this->_rootref['L_MSNM'])) ? $this->_rootref['L_MSNM'] : ((isset($user->lang['MSNM'])) ? $user->lang['MSNM'] : '{ MSNM }')); ?>"><span><?php echo ((isset($this->_rootref['L_MSNM'])) ? $this->_rootref['L_MSNM'] : ((isset($user->lang['MSNM'])) ? $user->lang['MSNM'] : '{ MSNM }')); ?></span></a></li><?php } if ($_postrow_val['U_ICQ']) {  ?><li class="icq-icon"><a href="<?php echo $_postrow_val['U_ICQ']; ?>" onclick="popup(this.href, 550, 320); return false;" title="<?php echo ((isset($this->_rootref['L_ICQ'])) ? $this->_rootref['L_ICQ'] : ((isset($user->lang['ICQ'])) ? $user->lang['ICQ'] : '{ ICQ }')); ?>"><span><?php echo ((isset($this->_rootref['L_ICQ'])) ? $this->_rootref['L_ICQ'] : ((isset($user->lang['ICQ'])) ? $user->lang['ICQ'] : '{ ICQ }')); ?></span></a></li><?php } if ($_postrow_val['U_YIM']) {  ?><li class="yahoo-icon"><a href="<?php echo $_postrow_val['U_YIM']; ?>" onclick="popup(this.href, 780, 550); return false;" title="<?php echo ((isset($this->_rootref['L_YIM'])) ? $this->_rootref['L_YIM'] : ((isset($user->lang['YIM'])) ? $user->lang['YIM'] : '{ YIM }')); ?>"><span><?php echo ((isset($this->_rootref['L_YIM'])) ? $this->_rootref['L_YIM'] : ((isset($user->lang['YIM'])) ? $user->lang['YIM'] : '{ YIM }')); ?></span></a></li><?php } if ($_postrow_val['U_AIM']) {  ?><li class="aim-icon"><a href="<?php echo $_postrow_val['U_AIM']; ?>" onclick="popup(this.href, 550, 320); return false;" title="<?php echo ((isset($this->_rootref['L_AIM'])) ? $this->_rootref['L_AIM'] : ((isset($user->lang['AIM'])) ? $user->lang['AIM'] : '{ AIM }')); ?>"><span><?php echo ((isset($this->_rootref['L_AIM'])) ? $this->_rootref['L_AIM'] : ((isset($user->lang['AIM'])) ? $user->lang['AIM'] : '{ AIM }')); ?></span></a></li><?php } if ($_postrow_val['U_JABBER']) {  ?><li class="jabber-icon"><a href="<?php echo $_postrow_val['U_JABBER']; ?>" onclick="popup(this.href, 550, 320); return false;" title="<?php echo ((isset($this->_rootref['L_JABBER'])) ? $this->_rootref['L_JABBER'] : ((isset($user->lang['JABBER'])) ? $user->lang['JABBER'] : '{ JABBER }')); ?>"><span><?php echo ((isset($this->_rootref['L_JABBER'])) ? $this->_rootref['L_JABBER'] : ((isset($user->lang['JABBER'])) ? $user->lang['JABBER'] : '{ JABBER }')); ?></span></a></li><?php } ?>

					</ul>
				<?php } } ?>

			</div>
			<span class="date"><?php echo $_postrow_val['POST_DATE']; ?> <a href="<?php echo $_postrow_val['U_MINI_POST']; ?>" title="<?php echo ((isset($this->_rootref['L_PERMALINK'])) ? $this->_rootref['L_PERMALINK'] : ((isset($user->lang['PERMALINK'])) ? $user->lang['PERMALINK'] : '{ PERMALINK }')); ?> to post #<?php echo $_postrow_val['POST_ID']; ?>"><?php echo $_postrow_val['MINI_POST_IMG']; echo $_postrow_val['POST_ID']; ?></a></span>
		</div>

		<div class="postbody">
			<?php if ($_postrow_val['S_IGNORE_POST']) {  ?>

				<div class="ignore"><?php echo $_postrow_val['L_IGNORE_POST']; ?></div>
			<?php } else { if ($_postrow_val['S_POST_UNAPPROVED'] || $_postrow_val['S_POST_REPORTED']) {  ?>

				<p class="rules">
					<?php if ($_postrow_val['S_POST_UNAPPROVED']) {  echo (isset($this->_rootref['UNAPPROVED_IMG'])) ? $this->_rootref['UNAPPROVED_IMG'] : ''; ?> <a href="<?php echo $_postrow_val['U_MCP_APPROVE']; ?>"><strong><?php echo ((isset($this->_rootref['L_POST_UNAPPROVED'])) ? $this->_rootref['L_POST_UNAPPROVED'] : ((isset($user->lang['POST_UNAPPROVED'])) ? $user->lang['POST_UNAPPROVED'] : '{ POST_UNAPPROVED }')); ?></strong></a><br /><?php } if ($_postrow_val['S_POST_REPORTED']) {  echo (isset($this->_rootref['REPORTED_IMG'])) ? $this->_rootref['REPORTED_IMG'] : ''; ?> <a href="<?php echo $_postrow_val['U_MCP_REPORT']; ?>"><strong><?php echo ((isset($this->_rootref['L_POST_REPORTED'])) ? $this->_rootref['L_POST_REPORTED'] : ((isset($user->lang['POST_REPORTED'])) ? $user->lang['POST_REPORTED'] : '{ POST_REPORTED }')); ?></strong></a><?php } ?>

				</p>
			<?php } ?>


			<div class="content" id="postdiv<?php echo $_postrow_val['POST_ID']; ?>"><?php echo $_postrow_val['MESSAGE']; ?></div>

			<?php if ($_postrow_val['S_HAS_ATTACHMENTS']) {  ?>

				<dl class="attachbox" style="width: 97%;">
					<dt><?php echo ((isset($this->_rootref['L_ATTACHMENTS'])) ? $this->_rootref['L_ATTACHMENTS'] : ((isset($user->lang['ATTACHMENTS'])) ? $user->lang['ATTACHMENTS'] : '{ ATTACHMENTS }')); ?></dt>
					<?php $_attachment_count = (isset($_postrow_val['attachment'])) ? sizeof($_postrow_val['attachment']) : 0;if ($_attachment_count) {for ($_attachment_i = 0; $_attachment_i < $_attachment_count; ++$_attachment_i){$_attachment_val = &$_postrow_val['attachment'][$_attachment_i]; ?>

						<dd><?php echo $_attachment_val['DISPLAY_ATTACHMENT']; ?></dd>
					<?php }} ?>

				</dl>
			<?php } if ($_postrow_val['S_DISPLAY_NOTICE']) {  ?><div class="rules"><?php echo ((isset($this->_rootref['L_DOWNLOAD_NOTICE'])) ? $this->_rootref['L_DOWNLOAD_NOTICE'] : ((isset($user->lang['DOWNLOAD_NOTICE'])) ? $user->lang['DOWNLOAD_NOTICE'] : '{ DOWNLOAD_NOTICE }')); ?></div><?php } if ($_postrow_val['EDITED_MESSAGE'] || $_postrow_val['EDIT_REASON']) {  ?>

				<div class="notice"><?php echo $_postrow_val['EDITED_MESSAGE']; ?>

					<?php if ($_postrow_val['EDIT_REASON']) {  ?><br /><strong><?php echo ((isset($this->_rootref['L_REASON'])) ? $this->_rootref['L_REASON'] : ((isset($user->lang['REASON'])) ? $user->lang['REASON'] : '{ REASON }')); ?>:</strong> <em><?php echo $_postrow_val['EDIT_REASON']; ?></em><?php } ?>

				</div>
			<?php } if ($_postrow_val['S_POST_DELETED']) {  ?><div class="notice"><?php echo $_postrow_val['DELETED_MESSAGE']; ?><br/></div><?php } if ($_postrow_val['BUMPED_MESSAGE']) {  ?><div class="notice"><br /><br /><?php echo $_postrow_val['BUMPED_MESSAGE']; ?></div><?php } if ($_postrow_val['SIGNATURE']) {  ?><div id="sig<?php echo $_postrow_val['POST_ID']; ?>" class="signature"><?php echo $_postrow_val['SIGNATURE']; ?></div><?php } ?>

		
		</div>
		<?php } if (! $_postrow_val['S_IGNORE_POST']) {  ?>

		<dl class="postprofile" id="profile<?php echo $_postrow_val['POST_ID']; ?>">
			<dt>
				<?php if ($_postrow_val['POSTER_AVATAR']) {  if ($_postrow_val['U_POST_AUTHOR']) {  ?><a href="<?php echo $_postrow_val['U_POST_AUTHOR']; ?>"><?php echo $_postrow_val['POSTER_AVATAR']; ?></a><?php } else { echo $_postrow_val['POSTER_AVATAR']; } ?><br />
				<?php } else { ?>

					<img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/no-avatar.png" height="100px" width="100px" alt="Default Avatar" />
				<?php } ?>

			</dt>
			
			<?php $_custom_fields_count = (isset($_postrow_val['custom_fields'])) ? sizeof($_postrow_val['custom_fields']) : 0;if ($_custom_fields_count) {for ($_custom_fields_i = 0; $_custom_fields_i < $_custom_fields_count; ++$_custom_fields_i){$_custom_fields_val = &$_postrow_val['custom_fields'][$_custom_fields_i]; if ($_custom_fields_val['PROFILE_FIELD_NAME'] == ("Custom Title")) {  ?>

					<dd class="center"><?php echo $_custom_fields_val['PROFILE_FIELD_VALUE']; ?></dd>
				<?php } }} ?>

			
			<br />
			
			<?php if ($this->_rootref['S_REPUTATION'] && $_postrow_val['S_USER_REPUTATION']) {  ?>

			<dd class="reputation">
				<?php if ($this->_rootref['S_REP_DISPLAY'] != ('block')) {  ?><strong><?php echo ((isset($this->_rootref['L_RP_TOTAL_POINTS'])) ? $this->_rootref['L_RP_TOTAL_POINTS'] : ((isset($user->lang['RP_TOTAL_POINTS'])) ? $user->lang['RP_TOTAL_POINTS'] : '{ RP_TOTAL_POINTS }')); ?>:</strong> <?php echo $_postrow_val['REPUTATION_TEXT']; } if ($this->_rootref['S_REP_DISPLAY'] != ('text')) {  if ($_postrow_val['U_VIEW_REP']) {  ?><a href="<?php echo $_postrow_val['U_VIEW_REP']; ?>" onclick="popup(this.href, 780, 550); return false;" ><?php } echo $_postrow_val['REPUTATION_BLOCK']; if ($_postrow_val['U_VIEW_REP']) {  ?></a><?php } } ?>

				<br /><?php if ($_postrow_val['S_GIVE_REPUTATION']) {  ?><a href="<?php echo $_postrow_val['U_ADD_POS']; ?>"><img src="<?php echo (isset($this->_rootref['T_IMAGES_PATH'])) ? $this->_rootref['T_IMAGES_PATH'] : ''; ?>reputation/add.png" title="<?php echo ((isset($this->_rootref['L_RP_ADD_POINTS'])) ? $this->_rootref['L_RP_ADD_POINTS'] : ((isset($user->lang['RP_ADD_POINTS'])) ? $user->lang['RP_ADD_POINTS'] : '{ RP_ADD_POINTS }')); ?> <?php echo $_postrow_val['POST_AUTHOR']; ?>" alt="<?php echo ((isset($this->_rootref['L_RP_ADD_POINTS'])) ? $this->_rootref['L_RP_ADD_POINTS'] : ((isset($user->lang['RP_ADD_POINTS'])) ? $user->lang['RP_ADD_POINTS'] : '{ RP_ADD_POINTS }')); ?> <?php echo $_postrow_val['POST_AUTHOR']; ?>" /></a> <?php if ($_postrow_val['S_GIVE_NEGATIVE']) {  ?><a href="<?php echo $_postrow_val['U_ADD_NEG']; ?>"><img src="<?php echo (isset($this->_rootref['T_IMAGES_PATH'])) ? $this->_rootref['T_IMAGES_PATH'] : ''; ?>reputation/subtract.png" title="<?php echo ((isset($this->_rootref['L_RP_SUBTRACT_POINTS'])) ? $this->_rootref['L_RP_SUBTRACT_POINTS'] : ((isset($user->lang['RP_SUBTRACT_POINTS'])) ? $user->lang['RP_SUBTRACT_POINTS'] : '{ RP_SUBTRACT_POINTS }')); ?> <?php echo $_postrow_val['POST_AUTHOR']; ?>" alt="<?php echo ((isset($this->_rootref['L_RP_SUBTRACT_POINTS'])) ? $this->_rootref['L_RP_SUBTRACT_POINTS'] : ((isset($user->lang['RP_SUBTRACT_POINTS'])) ? $user->lang['RP_SUBTRACT_POINTS'] : '{ RP_SUBTRACT_POINTS }')); ?> <?php echo $_postrow_val['POST_AUTHOR']; ?>" /></a><?php } } ?>

			</dd>
			<?php } if ($_postrow_val['RANK_TITLE'] || $_postrow_val['RANK_IMG']) {  ?><dd><strong><?php echo ((isset($this->_rootref['L_RANK_TITLE'])) ? $this->_rootref['L_RANK_TITLE'] : ((isset($user->lang['RANK_TITLE'])) ? $user->lang['RANK_TITLE'] : '{ RANK_TITLE }')); ?></strong> <?php echo $_postrow_val['RANK_TITLE']; if ($_postrow_val['RANK_TITLE'] && $_postrow_val['RANK_IMG']) {  ?><br /><?php } echo $_postrow_val['RANK_IMG']; ?></dd><?php } if ($_postrow_val['POSTER_POSTS'] != ('')) {  ?><dd><strong><?php echo ((isset($this->_rootref['L_POSTS'])) ? $this->_rootref['L_POSTS'] : ((isset($user->lang['POSTS'])) ? $user->lang['POSTS'] : '{ POSTS }')); ?></strong> <?php echo $_postrow_val['POSTER_POSTS']; ?></dd><?php } if ($_postrow_val['POSTER_JOINED']) {  ?><dd><strong><?php echo ((isset($this->_rootref['L_JOINED'])) ? $this->_rootref['L_JOINED'] : ((isset($user->lang['JOINED'])) ? $user->lang['JOINED'] : '{ JOINED }')); ?></strong> <?php echo $_postrow_val['POSTER_JOINED']; ?></dd><?php } if ($_postrow_val['POSTER_FROM']) {  ?><dd><strong><?php echo ((isset($this->_rootref['L_LOCATION'])) ? $this->_rootref['L_LOCATION'] : ((isset($user->lang['LOCATION'])) ? $user->lang['LOCATION'] : '{ LOCATION }')); ?></strong> <?php echo $_postrow_val['POSTER_FROM']; ?></dd><?php } if ($_postrow_val['S_PROFILE_FIELD1']) {  ?><!-- Use a construct like this to include admin defined profile fields. Replace FIELD1 with the name of your field. -->
			<dd><strong><?php echo $_postrow_val['PROFILE_FIELD1_NAME']; ?></strong> <?php echo $_postrow_val['PROFILE_FIELD1_VALUE']; ?></dd>
		<?php } $_custom_fields_count = (isset($_postrow_val['custom_fields'])) ? sizeof($_postrow_val['custom_fields']) : 0;if ($_custom_fields_count) {for ($_custom_fields_i = 0; $_custom_fields_i < $_custom_fields_count; ++$_custom_fields_i){$_custom_fields_val = &$_postrow_val['custom_fields'][$_custom_fields_i]; if (! $_custom_fields_val['PROFILE_FIELD_NAME'] == ("Custom Title")) {  ?>

				<dd><strong><?php echo $_custom_fields_val['PROFILE_FIELD_NAME']; ?></strong> <?php echo $_custom_fields_val['PROFILE_FIELD_VALUE']; ?></dd>
			<?php } }} ?>


		</dl>
		<?php } ?>


		<div class="back2top"><a href="#wrap" class="top" title="<?php echo ((isset($this->_rootref['L_BACK_TO_TOP'])) ? $this->_rootref['L_BACK_TO_TOP'] : ((isset($user->lang['BACK_TO_TOP'])) ? $user->lang['BACK_TO_TOP'] : '{ BACK_TO_TOP }')); ?>"><?php echo ((isset($this->_rootref['L_BACK_TO_TOP'])) ? $this->_rootref['L_BACK_TO_TOP'] : ((isset($user->lang['BACK_TO_TOP'])) ? $user->lang['BACK_TO_TOP'] : '{ BACK_TO_TOP }')); ?></a></div>

		<ul class="profile-icons">
		<?php if (! $this->_rootref['S_IS_BOT']) {  if ($_postrow_val['U_EDIT'] || $_postrow_val['U_DELETE'] || $_postrow_val['U_REPORT'] || $_postrow_val['U_WARN'] || $_postrow_val['U_INFO'] || $_postrow_val['U_QUOTE']) {  if ($_postrow_val['U_EDIT']) {  ?><li class="edit-icon profile-icon"><a href="<?php echo $_postrow_val['U_EDIT']; ?>" title="<?php echo ((isset($this->_rootref['L_EDIT_POST'])) ? $this->_rootref['L_EDIT_POST'] : ((isset($user->lang['EDIT_POST'])) ? $user->lang['EDIT_POST'] : '{ EDIT_POST }')); ?>"><span><?php echo ((isset($this->_rootref['L_ADVANCEDEDIT'])) ? $this->_rootref['L_ADVANCEDEDIT'] : ((isset($user->lang['ADVANCEDEDIT'])) ? $user->lang['ADVANCEDEDIT'] : '{ ADVANCEDEDIT }')); ?></span></a></li><?php } if ($_postrow_val['U_EDIT']) {  ?><li class="quick-edit-icon"><a href="#" id="quick_edit<?php echo $_postrow_val['POST_ID']; ?>" class="quick-edit" rel="<?php echo $_postrow_val['POST_ID']; ?>" onclick="quick_edit(<?php echo $_postrow_val['POST_ID']; ?>); return false;" title="<?php echo ((isset($this->_rootref['L_QUICKEDIT_POST'])) ? $this->_rootref['L_QUICKEDIT_POST'] : ((isset($user->lang['QUICKEDIT_POST'])) ? $user->lang['QUICKEDIT_POST'] : '{ QUICKEDIT_POST }')); ?>"><span><?php echo ((isset($this->_rootref['L_QUICKEDIT_POST'])) ? $this->_rootref['L_QUICKEDIT_POST'] : ((isset($user->lang['QUICKEDIT_POST'])) ? $user->lang['QUICKEDIT_POST'] : '{ QUICKEDIT_POST }')); ?></span></a></li><?php } if ($_postrow_val['U_DELETE']) {  ?><li class="delete-icon profile-icon"><a href="<?php echo $_postrow_val['U_DELETE']; ?>" title="<?php echo ((isset($this->_rootref['L_DELETE_POST'])) ? $this->_rootref['L_DELETE_POST'] : ((isset($user->lang['DELETE_POST'])) ? $user->lang['DELETE_POST'] : '{ DELETE_POST }')); ?>"><span><?php echo ((isset($this->_rootref['L_DELETE'])) ? $this->_rootref['L_DELETE'] : ((isset($user->lang['DELETE'])) ? $user->lang['DELETE'] : '{ DELETE }')); ?></span></a></li><?php } if ($_postrow_val['U_REPORT']) {  ?><li class="report-icon profile-icon"><a href="<?php echo $_postrow_val['U_REPORT']; ?>" title="<?php echo ((isset($this->_rootref['L_REPORT_POST'])) ? $this->_rootref['L_REPORT_POST'] : ((isset($user->lang['REPORT_POST'])) ? $user->lang['REPORT_POST'] : '{ REPORT_POST }')); ?>"><span><?php echo ((isset($this->_rootref['L_REPORT'])) ? $this->_rootref['L_REPORT'] : ((isset($user->lang['REPORT'])) ? $user->lang['REPORT'] : '{ REPORT }')); ?></span></a></li><?php } if ($_postrow_val['U_WARN']) {  ?><li class="warn-icon profile-icon"><a href="<?php echo $_postrow_val['U_WARN']; ?>" title="<?php echo ((isset($this->_rootref['L_WARN_USER'])) ? $this->_rootref['L_WARN_USER'] : ((isset($user->lang['WARN_USER'])) ? $user->lang['WARN_USER'] : '{ WARN_USER }')); ?>"><span><?php echo ((isset($this->_rootref['L_WARN_USER'])) ? $this->_rootref['L_WARN_USER'] : ((isset($user->lang['WARN_USER'])) ? $user->lang['WARN_USER'] : '{ WARN_USER }')); ?></span></a></li><?php } if ($_postrow_val['U_INFO']) {  ?><li class="info-icon profile-icon"><a href="<?php echo $_postrow_val['U_INFO']; ?>" title="<?php echo ((isset($this->_rootref['L_INFORMATION'])) ? $this->_rootref['L_INFORMATION'] : ((isset($user->lang['INFORMATION'])) ? $user->lang['INFORMATION'] : '{ INFORMATION }')); ?>"><span><?php echo ((isset($this->_rootref['L_INFORMATION'])) ? $this->_rootref['L_INFORMATION'] : ((isset($user->lang['INFORMATION'])) ? $user->lang['INFORMATION'] : '{ INFORMATION }')); ?></span></a></li><?php } if ($_postrow_val['U_QUOTE']) {  ?><li class="quote-icon profile-icon"><a href="<?php echo $_postrow_val['U_QUOTE']; ?>" title="<?php echo ((isset($this->_rootref['L_REPLY_WITH_QUOTE'])) ? $this->_rootref['L_REPLY_WITH_QUOTE'] : ((isset($user->lang['REPLY_WITH_QUOTE'])) ? $user->lang['REPLY_WITH_QUOTE'] : '{ REPLY_WITH_QUOTE }')); ?>"><span><?php echo ((isset($this->_rootref['L_QUOTE'])) ? $this->_rootref['L_QUOTE'] : ((isset($user->lang['QUOTE'])) ? $user->lang['QUOTE'] : '{ QUOTE }')); ?></span></a></li><?php } } } ?>

		</ul>
		
		</div>
	</div>
<?php }} ?>


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

<?php if ($this->_rootref['S_NUM_POSTS'] > (1) || $this->_rootref['PREVIOUS_PAGE']) {  ?>

	<form id="viewtopic" method="post" action="<?php echo (isset($this->_rootref['S_TOPIC_ACTION'])) ? $this->_rootref['S_TOPIC_ACTION'] : ''; ?>">

	<fieldset class="display-options">
		<?php if ($this->_rootref['PREVIOUS_PAGE']) {  ?><a href="<?php echo (isset($this->_rootref['PREVIOUS_PAGE'])) ? $this->_rootref['PREVIOUS_PAGE'] : ''; ?>" class="left-box <?php echo (isset($this->_rootref['S_CONTENT_FLOW_BEGIN'])) ? $this->_rootref['S_CONTENT_FLOW_BEGIN'] : ''; ?>"><?php echo ((isset($this->_rootref['L_PREVIOUS'])) ? $this->_rootref['L_PREVIOUS'] : ((isset($user->lang['PREVIOUS'])) ? $user->lang['PREVIOUS'] : '{ PREVIOUS }')); ?></a><?php } if ($this->_rootref['NEXT_PAGE']) {  ?><a href="<?php echo (isset($this->_rootref['NEXT_PAGE'])) ? $this->_rootref['NEXT_PAGE'] : ''; ?>" class="right-box <?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>"><?php echo ((isset($this->_rootref['L_NEXT'])) ? $this->_rootref['L_NEXT'] : ((isset($user->lang['NEXT'])) ? $user->lang['NEXT'] : '{ NEXT }')); ?></a><?php } if (! $this->_rootref['S_IS_BOT']) {  ?>

		<label><?php echo ((isset($this->_rootref['L_DISPLAY_POSTS'])) ? $this->_rootref['L_DISPLAY_POSTS'] : ((isset($user->lang['DISPLAY_POSTS'])) ? $user->lang['DISPLAY_POSTS'] : '{ DISPLAY_POSTS }')); ?>: <?php echo (isset($this->_rootref['S_SELECT_SORT_DAYS'])) ? $this->_rootref['S_SELECT_SORT_DAYS'] : ''; ?></label>
		<label><?php echo ((isset($this->_rootref['L_SORT_BY'])) ? $this->_rootref['L_SORT_BY'] : ((isset($user->lang['SORT_BY'])) ? $user->lang['SORT_BY'] : '{ SORT_BY }')); ?> <?php echo (isset($this->_rootref['S_SELECT_SORT_KEY'])) ? $this->_rootref['S_SELECT_SORT_KEY'] : ''; ?></label> <label><?php echo (isset($this->_rootref['S_SELECT_SORT_DIR'])) ? $this->_rootref['S_SELECT_SORT_DIR'] : ''; ?> <input type="submit" name="sort" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" class="button2" /></label>
		<?php } ?>

	</fieldset>

	</form>
<?php } ?>


<div class="topic-actions">
	<div class="buttons">
	<?php if (! $this->_rootref['S_IS_BOT'] && $this->_rootref['S_DISPLAY_REPLY_INFO']) {  ?>

		<div class="<?php if ($this->_rootref['S_IS_LOCKED']) {  ?>locked-icon<?php } else { ?>reply-icon<?php } ?>"><a href="<?php echo (isset($this->_rootref['U_POST_REPLY_TOPIC'])) ? $this->_rootref['U_POST_REPLY_TOPIC'] : ''; ?>"  title="<?php if ($this->_rootref['S_IS_LOCKED']) {  echo ((isset($this->_rootref['L_TOPIC_LOCKED'])) ? $this->_rootref['L_TOPIC_LOCKED'] : ((isset($user->lang['TOPIC_LOCKED'])) ? $user->lang['TOPIC_LOCKED'] : '{ TOPIC_LOCKED }')); } else { echo ((isset($this->_rootref['L_POST_REPLY'])) ? $this->_rootref['L_POST_REPLY'] : ((isset($user->lang['POST_REPLY'])) ? $user->lang['POST_REPLY'] : '{ POST_REPLY }')); } ?>"><span></span><?php if ($this->_rootref['S_IS_LOCKED']) {  echo ((isset($this->_rootref['L_TOPIC_LOCKED_SHORT'])) ? $this->_rootref['L_TOPIC_LOCKED_SHORT'] : ((isset($user->lang['TOPIC_LOCKED_SHORT'])) ? $user->lang['TOPIC_LOCKED_SHORT'] : '{ TOPIC_LOCKED_SHORT }')); } else { echo ((isset($this->_rootref['L_REPLY'])) ? $this->_rootref['L_REPLY'] : ((isset($user->lang['REPLY'])) ? $user->lang['REPLY'] : '{ REPLY }')); } ?></a></div>
	<?php } ?>

	</div>

	<?php if ($this->_rootref['PAGINATION'] || $this->_rootref['TOTAL_POSTS']) {  ?>

		<div class="pagination">
			<?php echo (isset($this->_rootref['TOTAL_POSTS'])) ? $this->_rootref['TOTAL_POSTS'] : ''; ?>

			<?php if ($this->_rootref['PAGE_NUMBER']) {  if ($this->_rootref['PAGINATION']) {  ?> &bull; <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { ?> &bull; <?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } } ?>

		</div>
	<?php } ?>

</div>

<?php if ($this->_rootref['QUICK_REPLY']) {  $this->_tpl_include('quick_reply.html'); } if ($this->_rootref['S_DISPLAY_RECENT']) {  $this->_tpl_include('portal/block/recent.html'); } $this->_tpl_include('jumpbox.html'); if ($this->_rootref['S_TOPIC_MOD']) {  ?>

	<form method="post" action="<?php echo (isset($this->_rootref['S_MOD_ACTION'])) ? $this->_rootref['S_MOD_ACTION'] : ''; ?>">
	<fieldset class="quickmod">
		<label for="quick-mod-select"><?php echo ((isset($this->_rootref['L_QUICK_MOD'])) ? $this->_rootref['L_QUICK_MOD'] : ((isset($user->lang['QUICK_MOD'])) ? $user->lang['QUICK_MOD'] : '{ QUICK_MOD }')); ?>:</label> <?php echo (isset($this->_rootref['S_TOPIC_MOD'])) ? $this->_rootref['S_TOPIC_MOD'] : ''; ?> <input type="submit" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" class="button2" />
		<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

	</fieldset>
	</form>
<?php } ?>


<div id="board-statistics">
<?php if ($this->_rootref['S_DISPLAY_ONLINE_LIST']) {  ?>

	<h3><?php if ($this->_rootref['U_VIEWONLINE']) {  ?><a href="<?php echo (isset($this->_rootref['U_VIEWONLINE'])) ? $this->_rootref['U_VIEWONLINE'] : ''; ?>"><?php echo ((isset($this->_rootref['L_WHO_IS_ONLINE'])) ? $this->_rootref['L_WHO_IS_ONLINE'] : ((isset($user->lang['WHO_IS_ONLINE'])) ? $user->lang['WHO_IS_ONLINE'] : '{ WHO_IS_ONLINE }')); ?></a><?php } else { echo ((isset($this->_rootref['L_WHO_IS_ONLINE'])) ? $this->_rootref['L_WHO_IS_ONLINE'] : ((isset($user->lang['WHO_IS_ONLINE'])) ? $user->lang['WHO_IS_ONLINE'] : '{ WHO_IS_ONLINE }')); } ?></h3>
	<p><?php echo (isset($this->_rootref['LOGGED_IN_USER_LIST'])) ? $this->_rootref['LOGGED_IN_USER_LIST'] : ''; ?></p>
<?php } ?>

</div>

<!-- image slider --> 
<div class="simple_overlay" id="gallerySlider"> 
 
    <!-- "previous image" action --> 
    <a class="prev">prev</a> 
 
    <!-- "next image" action --> 
    <a class="next">next</a> 
 
    <!-- image information --> 
    <div class="info"></div> 
 
    <!-- load indicator (animated gif) --> 
    <img class="progress" src="http://static.flowplayer.org/tools/img/overlay/loading.gif" /> 
</div>
<!-- image slider --><!-- one single tooltip element --> 
<div id="tooltipSlider"></div>

<?php $this->_tpl_include('overall_footer.html'); ?>