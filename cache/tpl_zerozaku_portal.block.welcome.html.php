<?php if (!defined('IN_PHPBB')) exit; ?><!--version $Id: welcome.html 479 2009-03-15 11:19:27Z kevin74 $ //-->
<div id="news">
	<div class="inner">
		<strong><?php echo ((isset($this->_rootref['L_ANNOUNCEMENT'])) ? $this->_rootref['L_ANNOUNCEMENT'] : ((isset($user->lang['ANNOUNCEMENT'])) ? $user->lang['ANNOUNCEMENT'] : '{ ANNOUNCEMENT }')); ?>:</strong> <?php echo (isset($this->_rootref['PORTAL_WELCOME_INTRO'])) ? $this->_rootref['PORTAL_WELCOME_INTRO'] : ''; ?>
	</div>
</div>