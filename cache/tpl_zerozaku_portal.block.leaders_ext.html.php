<?php if (!defined('IN_PHPBB')) exit; ?><!--version $Id: leaders.html 236 2008-05-18 15:50:06Z kevin74 $ //-->
<?php echo (isset($this->_tpldata['DEFINE']['.']['LR_BLOCK_H_L'])) ? $this->_tpldata['DEFINE']['.']['LR_BLOCK_H_L'] : ''; ?><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/portal/portal_team.png" width="16px" height="16px" alt=""/>&nbsp;<?php echo ((isset($this->_rootref['L_THE_TEAM'])) ? $this->_rootref['L_THE_TEAM'] : ((isset($user->lang['THE_TEAM'])) ? $user->lang['THE_TEAM'] : '{ THE_TEAM }')); echo (isset($this->_tpldata['DEFINE']['.']['LR_BLOCK_H_R'])) ? $this->_tpldata['DEFINE']['.']['LR_BLOCK_H_R'] : ''; ?>
	<?php $_group_count = (isset($this->_tpldata['group'])) ? sizeof($this->_tpldata['group']) : 0;if ($_group_count) {for ($_group_i = 0; $_group_i < $_group_count; ++$_group_i){$_group_val = &$this->_tpldata['group'][$_group_i]; ?>
		<strong><a href="<?php echo $_group_val['U_GROUP']; ?>" style="color: #<?php echo $_group_val['GROUP_COLOUR']; ?>;" class="username-coloured"><?php echo $_group_val['GROUP_NAME']; ?></a></strong><br />
	<?php $_member_count = (isset($_group_val['member'])) ? sizeof($_group_val['member']) : 0;if ($_member_count) {for ($_member_i = 0; $_member_i < $_member_count; ++$_member_i){$_member_val = &$_group_val['member'][$_member_i]; ?>
		<span style="float:left;"><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/portal/portal_user.png" width="16px" height="16px" alt="" /></span><span style="float:left; padding-left:5px; padding-top:2px;"><strong><?php echo $_member_val['USERNAME_FULL']; ?></strong></span><br style="clear:both" />
	<?php }} ?>
	<br style="clear:both" />
	<?php }} else { ?>
		<?php echo ((isset($this->_rootref['L_NO_GROUPS_P'])) ? $this->_rootref['L_NO_GROUPS_P'] : ((isset($user->lang['NO_GROUPS_P'])) ? $user->lang['NO_GROUPS_P'] : '{ NO_GROUPS_P }')); ?>
	<?php } ?>
<?php echo (isset($this->_tpldata['DEFINE']['.']['LR_BLOCK_F_L'])) ? $this->_tpldata['DEFINE']['.']['LR_BLOCK_F_L'] : ''; echo (isset($this->_tpldata['DEFINE']['.']['LR_BLOCK_F_R'])) ? $this->_tpldata['DEFINE']['.']['LR_BLOCK_F_R'] : ''; ?>