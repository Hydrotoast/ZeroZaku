<?php if (!defined('IN_PHPBB')) exit; $this->_tpldata['DEFINE']['.']['S_IN_PORTAL'] = 1; $this->_tpl_include('portal/_block_config.html'); $this->_tpl_include('portal/block/additional_blocks_right.html'); if (! $this->_rootref['S_IS_BOT'] && $this->_rootref['S_USER_LOGGED_IN'] && $this->_rootref['S_ZEBRA_ENABLED'] && $this->_rootref['S_DISPLAY_FRIENDS']) {  $this->_tpl_include('portal/block/online_friends.html'); } if ($this->_rootref['S_DISPLAY_TOP_POSTERS']) {  $this->_tpl_include('portal/block/top_poster.html'); } ?>
	
	<div id="user_statuses">
		<h2><?php echo ((isset($this->_rootref['L_USER_STATUS'])) ? $this->_rootref['L_USER_STATUS'] : ((isset($user->lang['USER_STATUS'])) ? $user->lang['USER_STATUS'] : '{ USER_STATUS }')); ?></h2>
		<ul>
		<?php $_user_statuses_count = (isset($this->_tpldata['user_statuses'])) ? sizeof($this->_tpldata['user_statuses']) : 0;if ($_user_statuses_count) {for ($_user_statuses_i = 0; $_user_statuses_i < $_user_statuses_count; ++$_user_statuses_i){$_user_statuses_val = &$this->_tpldata['user_statuses'][$_user_statuses_i]; if ($_user_statuses_val['STATUS'] != ('')) {  ?><li><div class="inner"><span><?php echo $_user_statuses_val['USERNAME']; ?></span> &nbsp; <?php echo $_user_statuses_val['STATUS']; ?></div></li><?php } }} ?>
		</ul>
	</div>
	
	<?php if ($this->_rootref['REC_FRIEND_TOTAL'] > 0) {  ?>
	<div class="leaderboard rec_friend">
		<h2><?php echo ((isset($this->_rootref['L_MFR_PEOPLE_LIKE'])) ? $this->_rootref['L_MFR_PEOPLE_LIKE'] : ((isset($user->lang['MFR_PEOPLE_LIKE'])) ? $user->lang['MFR_PEOPLE_LIKE'] : '{ MFR_PEOPLE_LIKE }')); ?></h2>
		<ul>
		<?php $_rec_friend_count = (isset($this->_tpldata['rec_friend'])) ? sizeof($this->_tpldata['rec_friend']) : 0;if ($_rec_friend_count) {for ($_rec_friend_i = 0; $_rec_friend_i < $_rec_friend_count; ++$_rec_friend_i){$_rec_friend_val = &$this->_tpldata['rec_friend'][$_rec_friend_i]; ?>
			<li><div class="inner"><?php echo $_rec_friend_val['USERNAME']; ?> <a href="<?php echo $_rec_friend_val['ADD_URL']; ?>" rel="add_rec" alt="<?php echo $_rec_friend_val['USER_ID']; ?>"><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/round_plus.png" alt="Add Friend" /></a></div></li>
		<?php }} ?>
		</ul>
	</div>
	<?php } if ($this->_rootref['S_DISPLAY_LINKS']) {  $this->_tpl_include('portal/block/links.html'); } if ($this->_rootref['S_DISPLAY_LEADERS_EXT']) {  $this->_tpl_include('portal/block/leaders_ext.html'); } else if ($this->_rootref['S_DISPLAY_LEADERS']) {  $this->_tpl_include('portal/block/leaders.html'); } if ($this->_rootref['S_DISPLAY_PAY_S']) {  $this->_tpl_include('portal/block/donation_small.html'); } if ($this->_rootref['S_DISPLAY_PAY_C']) {  $this->_tpl_include('portal/block/donation.html'); } ?>