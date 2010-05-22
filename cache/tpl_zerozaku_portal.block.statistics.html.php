<?php if (!defined('IN_PHPBB')) exit; ?><!--version $Id: statistics.html 481 2009-03-15 23:16:32Z Christian_N $ //-->
<?php echo (isset($this->_tpldata['DEFINE']['.']['LR_BLOCK_H_L'])) ? $this->_tpldata['DEFINE']['.']['LR_BLOCK_H_L'] : ''; ?><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/portal/sidebar_chart.png" width="16px" height="16px" alt=""/>&nbsp;<?php echo ((isset($this->_rootref['L_STATISTICS'])) ? $this->_rootref['L_STATISTICS'] : ((isset($user->lang['STATISTICS'])) ? $user->lang['STATISTICS'] : '{ STATISTICS }')); echo (isset($this->_tpldata['DEFINE']['.']['LR_BLOCK_H_R'])) ? $this->_tpldata['DEFINE']['.']['LR_BLOCK_H_R'] : ''; ?>
	<strong><?php echo ((isset($this->_rootref['L_ST_TOP'])) ? $this->_rootref['L_ST_TOP'] : ((isset($user->lang['ST_TOP'])) ? $user->lang['ST_TOP'] : '{ ST_TOP }')); ?></strong><br />
	<?php echo (isset($this->_rootref['TOTAL_POSTS'])) ? $this->_rootref['TOTAL_POSTS'] : ''; ?><br />
	<?php echo (isset($this->_rootref['TOTAL_TOPICS'])) ? $this->_rootref['TOTAL_TOPICS'] : ''; ?><br />
	<?php echo ((isset($this->_rootref['L_ST_TOP_ANNS'])) ? $this->_rootref['L_ST_TOP_ANNS'] : ((isset($user->lang['ST_TOP_ANNS'])) ? $user->lang['ST_TOP_ANNS'] : '{ ST_TOP_ANNS }')); ?> <strong><?php echo (isset($this->_rootref['S_ANN'])) ? $this->_rootref['S_ANN'] : ''; ?></strong><br />
	<?php echo ((isset($this->_rootref['L_ST_TOP_STICKYS'])) ? $this->_rootref['L_ST_TOP_STICKYS'] : ((isset($user->lang['ST_TOP_STICKYS'])) ? $user->lang['ST_TOP_STICKYS'] : '{ ST_TOP_STICKYS }')); ?> <strong><?php echo (isset($this->_rootref['S_SCT'])) ? $this->_rootref['S_SCT'] : ''; ?></strong><br />
	<?php echo ((isset($this->_rootref['L_ST_TOT_ATTACH'])) ? $this->_rootref['L_ST_TOT_ATTACH'] : ((isset($user->lang['ST_TOT_ATTACH'])) ? $user->lang['ST_TOT_ATTACH'] : '{ ST_TOT_ATTACH }')); ?> <strong><?php echo (isset($this->_rootref['S_TOT_ATTACH'])) ? $this->_rootref['S_TOT_ATTACH'] : ''; ?></strong><br />
		
	<hr class="dashed" />
	<?php echo (isset($this->_rootref['TOTAL_USERS'])) ? $this->_rootref['TOTAL_USERS'] : ''; ?><br />
	<?php echo (isset($this->_rootref['NEWEST_USER'])) ? $this->_rootref['NEWEST_USER'] : ''; ?>
	
	<hr class="dashed" />
	<strong><?php echo ((isset($this->_rootref['L_24HOUR_STATS'])) ? $this->_rootref['L_24HOUR_STATS'] : ((isset($user->lang['24HOUR_STATS'])) ? $user->lang['24HOUR_STATS'] : '{ 24HOUR_STATS }')); ?></strong><br />
	<?php echo (isset($this->_rootref['24HOUR_POSTS'])) ? $this->_rootref['24HOUR_POSTS'] : ''; ?><br />
	<?php echo (isset($this->_rootref['24HOUR_TOPICS'])) ? $this->_rootref['24HOUR_TOPICS'] : ''; ?><br />
	<?php echo (isset($this->_rootref['24HOUR_USERS'])) ? $this->_rootref['24HOUR_USERS'] : ''; ?><br />
<?php echo (isset($this->_tpldata['DEFINE']['.']['LR_BLOCK_F_L'])) ? $this->_tpldata['DEFINE']['.']['LR_BLOCK_F_L'] : ''; echo (isset($this->_tpldata['DEFINE']['.']['LR_BLOCK_F_R'])) ? $this->_tpldata['DEFINE']['.']['LR_BLOCK_F_R'] : ''; ?>