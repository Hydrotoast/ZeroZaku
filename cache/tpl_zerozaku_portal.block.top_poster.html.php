<?php if (!defined('IN_PHPBB')) exit; if (sizeof($this->_tpldata['top_poster'])) {  ?>
<div class="leaderboard">
	<h2><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/portal/sidebar_users.png" alt="<?php echo ((isset($this->_rootref['L_TOP_POSTER'])) ? $this->_rootref['L_TOP_POSTER'] : ((isset($user->lang['TOP_POSTER'])) ? $user->lang['TOP_POSTER'] : '{ TOP_POSTER }')); ?>" />&nbsp;<?php echo ((isset($this->_rootref['L_TOP_POSTER'])) ? $this->_rootref['L_TOP_POSTER'] : ((isset($user->lang['TOP_POSTER'])) ? $user->lang['TOP_POSTER'] : '{ TOP_POSTER }')); ?></h2>
	<ul>
	<?php $_top_poster_count = (isset($this->_tpldata['top_poster'])) ? sizeof($this->_tpldata['top_poster']) : 0;if ($_top_poster_count) {for ($_top_poster_i = 0; $_top_poster_i < $_top_poster_count; ++$_top_poster_i){$_top_poster_val = &$this->_tpldata['top_poster'][$_top_poster_i]; ?>
		<li>
			<div><span><a href="<?php echo $_top_poster_val['S_SEARCH_ACTION']; ?>" class="posts"><?php echo $_top_poster_val['POSTER_POSTS']; ?></a> <?php echo ((isset($this->_rootref['L_POSTS'])) ? $this->_rootref['L_POSTS'] : ((isset($user->lang['POSTS'])) ? $user->lang['POSTS'] : '{ POSTS }')); ?></span> <?php echo $_top_poster_val['USERNAME_FULL']; ?></div>
		</li>
	<?php }} ?>
	</ul>
</div>
<?php } ?>