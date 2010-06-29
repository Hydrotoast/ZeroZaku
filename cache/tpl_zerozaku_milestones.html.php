<?php if (!defined('IN_PHPBB')) exit; echo (isset($this->_tpldata['DEFINE']['.']['TBL_BLOCK_H_L'])) ? $this->_tpldata['DEFINE']['.']['TBL_BLOCK_H_L'] : ''; ?><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/globe.png" width="16px" height="16px" alt=""/>&nbsp;<?php echo ((isset($this->_rootref['L_MILESTONE_HISTORY'])) ? $this->_rootref['L_MILESTONE_HISTORY'] : ((isset($user->lang['MILESTONE_HISTORY'])) ? $user->lang['MILESTONE_HISTORY'] : '{ MILESTONE_HISTORY }')); echo (isset($this->_tpldata['DEFINE']['.']['TBL_BLOCK_H_R'])) ? $this->_tpldata['DEFINE']['.']['TBL_BLOCK_H_R'] : ''; ?>

<?php $_milestone_count = (isset($this->_tpldata['milestone'])) ? sizeof($this->_tpldata['milestone']) : 0;if ($_milestone_count) {for ($_milestone_i = 0; $_milestone_i < $_milestone_count; ++$_milestone_i){$_milestone_val = &$this->_tpldata['milestone'][$_milestone_i]; if ($_milestone_val['NEWTYPE']) {  if (! $_milestone_val['S_FIRST_ROW']) {  ?>
	</tbody>
	</table>

<p></p>
<?php } ?>

	<table class="table1" cellspacing="1">
	<thead>
		<tr>
			<th class="name" style="text-align: left;"><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?></th>
			<th class="active" style="width: 10%; text-align: center;"><?php echo $_milestone_val['TYPE']; ?></th>
		</tr>
	</thead>
	<tbody>
<?php } ?>
		<tr class="<?php if (($_milestone_val['S_ROW_COUNT'] & 1)  ) {  ?>bg1<?php } else { ?>bg2<?php } ?>">
			<td><?php echo $_milestone_val['USER']; ?></td>
			<td class="active" style="width: 10%; text-align: center;"><?php echo $_milestone_val['NUMBER']; ?></td>
		</tr>
<?php }} ?>
	</tbody>
	</table>
<?php echo (isset($this->_tpldata['DEFINE']['.']['TBL_BLOCK_F_L'])) ? $this->_tpldata['DEFINE']['.']['TBL_BLOCK_F_L'] : ''; echo (isset($this->_tpldata['DEFINE']['.']['TBL_BLOCK_F_R'])) ? $this->_tpldata['DEFINE']['.']['TBL_BLOCK_F_R'] : ''; ?>