<?php if (!defined('IN_PHPBB')) exit; ?><!--version $Id: links.html 481 2009-03-15 23:16:32Z Christian_N $ //-->
<?php echo (isset($this->_tpldata['DEFINE']['.']['LR_BLOCK_H_L'])) ? $this->_tpldata['DEFINE']['.']['LR_BLOCK_H_L'] : ''; ?><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/portal/portal_links.png" width="16px" height="16px" alt=""/>&nbsp;<?php echo ((isset($this->_rootref['L_LINKS'])) ? $this->_rootref['L_LINKS'] : ((isset($user->lang['LINKS'])) ? $user->lang['LINKS'] : '{ LINKS }')); echo (isset($this->_tpldata['DEFINE']['.']['LR_BLOCK_H_R'])) ? $this->_tpldata['DEFINE']['.']['LR_BLOCK_H_R'] : ''; ?>
	<ul class="portal-navigation">
	<?php if (sizeof($this->_tpldata['link'])) {  $_link_count = (isset($this->_tpldata['link'])) ? sizeof($this->_tpldata['link']) : 0;if ($_link_count) {for ($_link_i = 0; $_link_i < $_link_count; ++$_link_i){$_link_val = &$this->_tpldata['link'][$_link_i]; ?>
			<li><a href="<?php echo $_link_val['URL']; ?>" title="<?php echo $_link_val['TEXT']; ?>"><?php echo $_link_val['TEXT']; ?></a></li>
		<?php }} } else { ?>
		<span style="float:left;" class="gensmall"><strong><?php echo ((isset($this->_rootref['L_NO_LINKS'])) ? $this->_rootref['L_NO_LINKS'] : ((isset($user->lang['NO_LINKS'])) ? $user->lang['NO_LINKS'] : '{ NO_LINKS }')); ?></strong></span><br />
	<?php } ?>
	</ul>
<?php echo (isset($this->_tpldata['DEFINE']['.']['LR_BLOCK_F_L'])) ? $this->_tpldata['DEFINE']['.']['LR_BLOCK_F_L'] : ''; echo (isset($this->_tpldata['DEFINE']['.']['LR_BLOCK_F_R'])) ? $this->_tpldata['DEFINE']['.']['LR_BLOCK_F_R'] : ''; ?>