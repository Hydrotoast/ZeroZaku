<?php if (!defined('IN_PHPBB')) exit; ?><!--version $Id: welcome.html 479 2009-03-15 11:19:27Z kevin74 $ //-->
<div class="panel smooth info">
	<img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/rss.png" alt="<?php echo ((isset($this->_rootref['L_INFORMATION'])) ? $this->_rootref['L_INFORMATION'] : ((isset($user->lang['INFORMATION'])) ? $user->lang['INFORMATION'] : '{ INFORMATION }')); ?>" /><p>
	<strong><?php echo ((isset($this->_rootref['L_ANNOUNCEMENT'])) ? $this->_rootref['L_ANNOUNCEMENT'] : ((isset($user->lang['ANNOUNCEMENT'])) ? $user->lang['ANNOUNCEMENT'] : '{ ANNOUNCEMENT }')); ?>:</strong> <?php echo (isset($this->_rootref['PORTAL_WELCOME_INTRO'])) ? $this->_rootref['PORTAL_WELCOME_INTRO'] : ''; ?></p>
</div>