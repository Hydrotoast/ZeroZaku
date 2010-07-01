<?php if (!defined('IN_PHPBB')) exit; $this->_tpldata['DEFINE']['.']['S_IN_PORTAL'] = 1; $this->_tpl_include('portal/_block_config.html'); ?>
<div class="stats">
	<p><h4><?php echo ((isset($this->_rootref['L_ST_TOP'])) ? $this->_rootref['L_ST_TOP'] : ((isset($user->lang['ST_TOP'])) ? $user->lang['ST_TOP'] : '{ ST_TOP }')); ?></h4>
	<dl>
	<?php echo ((isset($this->_rootref['L_TOTAL_POSTS'])) ? $this->_rootref['L_TOTAL_POSTS'] : ((isset($user->lang['TOTAL_POSTS'])) ? $user->lang['TOTAL_POSTS'] : '{ TOTAL_POSTS }')); ?> <?php echo (isset($this->_rootref['TOTAL_POSTS'])) ? $this->_rootref['TOTAL_POSTS'] : ''; ?><br />
	<?php echo ((isset($this->_rootref['L_TOTAL_TOPICS'])) ? $this->_rootref['L_TOTAL_TOPICS'] : ((isset($user->lang['TOTAL_TOPICS'])) ? $user->lang['TOTAL_TOPICS'] : '{ TOTAL_TOPICS }')); ?> <?php echo (isset($this->_rootref['TOTAL_TOPICS'])) ? $this->_rootref['TOTAL_TOPICS'] : ''; ?><br />
	<?php echo ((isset($this->_rootref['L_ST_TOP_ANNS'])) ? $this->_rootref['L_ST_TOP_ANNS'] : ((isset($user->lang['ST_TOP_ANNS'])) ? $user->lang['ST_TOP_ANNS'] : '{ ST_TOP_ANNS }')); ?> <strong><?php echo (isset($this->_rootref['S_ANN'])) ? $this->_rootref['S_ANN'] : ''; ?></strong><br />
	<?php echo ((isset($this->_rootref['L_ST_TOP_STICKYS'])) ? $this->_rootref['L_ST_TOP_STICKYS'] : ((isset($user->lang['ST_TOP_STICKYS'])) ? $user->lang['ST_TOP_STICKYS'] : '{ ST_TOP_STICKYS }')); ?> <strong><?php echo (isset($this->_rootref['S_SCT'])) ? $this->_rootref['S_SCT'] : ''; ?></strong><br />
	<?php echo ((isset($this->_rootref['L_ST_TOT_ATTACH'])) ? $this->_rootref['L_ST_TOT_ATTACH'] : ((isset($user->lang['ST_TOT_ATTACH'])) ? $user->lang['ST_TOT_ATTACH'] : '{ ST_TOT_ATTACH }')); ?> <strong><?php echo (isset($this->_rootref['S_TOT_ATTACH'])) ? $this->_rootref['S_TOT_ATTACH'] : ''; ?></strong><br />
	<?php echo ((isset($this->_rootref['L_TOTAL_USERS'])) ? $this->_rootref['L_TOTAL_USERS'] : ((isset($user->lang['TOTAL_USERS'])) ? $user->lang['TOTAL_USERS'] : '{ TOTAL_USERS }')); ?> <?php echo (isset($this->_rootref['TOTAL_USERS'])) ? $this->_rootref['TOTAL_USERS'] : ''; ?><br />
	<?php echo (isset($this->_rootref['NEWEST_USER'])) ? $this->_rootref['NEWEST_USER'] : ''; ?></p>
	
	<p><h4><?php echo ((isset($this->_rootref['L_24HOUR_STATS'])) ? $this->_rootref['L_24HOUR_STATS'] : ((isset($user->lang['24HOUR_STATS'])) ? $user->lang['24HOUR_STATS'] : '{ 24HOUR_STATS }')); ?></h4>
	<?php echo (isset($this->_rootref['24HOUR_POSTS'])) ? $this->_rootref['24HOUR_POSTS'] : ''; ?><br />
	<?php echo (isset($this->_rootref['24HOUR_TOPICS'])) ? $this->_rootref['24HOUR_TOPICS'] : ''; ?><br />
	<?php echo (isset($this->_rootref['24HOUR_USERS'])) ? $this->_rootref['24HOUR_USERS'] : ''; ?><br /></p>
</div>