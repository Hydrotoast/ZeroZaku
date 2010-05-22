<?php if (!defined('IN_PHPBB')) exit; ?><div class="panel smooth">
	<div class="inner">
		<div class="left_menu_title"><?php echo ((isset($this->_rootref['L_KB_STATS'])) ? $this->_rootref['L_KB_STATS'] : ((isset($user->lang['KB_STATS'])) ? $user->lang['KB_STATS'] : '{ KB_STATS }')); ?></div>
		<div style="padding-bottom: 3px;" class="user_menu">
			<div><strong><?php echo ((isset($this->_rootref['L_TOTAL_CATS'])) ? $this->_rootref['L_TOTAL_CATS'] : ((isset($user->lang['TOTAL_CATS'])) ? $user->lang['TOTAL_CATS'] : '{ TOTAL_CATS }')); ?>: </strong><?php echo (isset($this->_rootref['TOTAL_KB_CAT'])) ? $this->_rootref['TOTAL_KB_CAT'] : ''; ?></div>
			<div><strong><?php echo ((isset($this->_rootref['L_TOTAL_ARTICLES'])) ? $this->_rootref['L_TOTAL_ARTICLES'] : ((isset($user->lang['TOTAL_ARTICLES'])) ? $user->lang['TOTAL_ARTICLES'] : '{ TOTAL_ARTICLES }')); ?>: </strong><?php echo (isset($this->_rootref['TOTAL_KB_ARTICLES'])) ? $this->_rootref['TOTAL_KB_ARTICLES'] : ''; ?></div>
			<div><strong><?php echo ((isset($this->_rootref['L_TOTAL_COMMENTS'])) ? $this->_rootref['L_TOTAL_COMMENTS'] : ((isset($user->lang['TOTAL_COMMENTS'])) ? $user->lang['TOTAL_COMMENTS'] : '{ TOTAL_COMMENTS }')); ?>: </strong><?php echo (isset($this->_rootref['TOTAL_KB_COMMENTS'])) ? $this->_rootref['TOTAL_KB_COMMENTS'] : ''; ?></div>
			<div><strong><?php echo ((isset($this->_rootref['L_KB_LAST_UPDATE'])) ? $this->_rootref['L_KB_LAST_UPDATE'] : ((isset($user->lang['KB_LAST_UPDATE'])) ? $user->lang['KB_LAST_UPDATE'] : '{ KB_LAST_UPDATE }')); ?>: </strong><?php echo (isset($this->_rootref['LAST_UPDATED'])) ? $this->_rootref['LAST_UPDATED'] : ''; ?></div>
		</div>
	</div>
</div>