<?php if (!defined('IN_PHPBB')) exit; ?><!--version $Id: top_poster.html 481 2009-03-15 23:16:32Z Christian_N $ //-->
<?php if (sizeof($this->_tpldata['top_poster'])) {  ?>
<?php echo (isset($this->_tpldata['DEFINE']['.']['TBL_BLOCK_H_L'])) ? $this->_tpldata['DEFINE']['.']['TBL_BLOCK_H_L'] : ''; ?><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/portal/sidebar_users.png" width="16px" height="16px" alt=""/>&nbsp;<?php echo ((isset($this->_rootref['L_TOP_POSTER'])) ? $this->_rootref['L_TOP_POSTER'] : ((isset($user->lang['TOP_POSTER'])) ? $user->lang['TOP_POSTER'] : '{ TOP_POSTER }')); echo (isset($this->_tpldata['DEFINE']['.']['TBL_BLOCK_H_R'])) ? $this->_tpldata['DEFINE']['.']['TBL_BLOCK_H_R'] : ''; ?>
	<table class="table1" cellspacing="1">
		<thead>
			<tr>
				<th style="width: 80%"><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?></th>
				<th style="width: 10%"><?php echo ((isset($this->_rootref['L_POSTS'])) ? $this->_rootref['L_POSTS'] : ((isset($user->lang['POSTS'])) ? $user->lang['POSTS'] : '{ POSTS }')); ?></th>
			</tr>
		</thead>
	<?php $_top_poster_count = (isset($this->_tpldata['top_poster'])) ? sizeof($this->_tpldata['top_poster']) : 0;if ($_top_poster_count) {for ($_top_poster_i = 0; $_top_poster_i < $_top_poster_count; ++$_top_poster_i){$_top_poster_val = &$this->_tpldata['top_poster'][$_top_poster_i]; ?>
		<tr class="<?php if (($_top_poster_val['S_ROW_COUNT'] & 1)  ) {  ?>bg1<?php } else { ?>bg2<?php } ?>">
			<td style="width: 85%"><?php echo $_top_poster_val['USERNAME_FULL']; ?></td>
			<td style="width: 15%"><a href="<?php echo $_top_poster_val['S_SEARCH_ACTION']; ?>"><?php echo $_top_poster_val['POSTER_POSTS']; ?></a></td>
		</tr>
	<?php }} ?>
	</table>
<?php echo (isset($this->_tpldata['DEFINE']['.']['TBL_BLOCK_F_L'])) ? $this->_tpldata['DEFINE']['.']['TBL_BLOCK_F_L'] : ''; echo (isset($this->_tpldata['DEFINE']['.']['TBL_BLOCK_F_R'])) ? $this->_tpldata['DEFINE']['.']['TBL_BLOCK_F_R'] : ''; ?>
<?php } ?>