<?php if (!defined('IN_PHPBB')) exit; $this->_tpldata['DEFINE']['.']['CA_PAGE'] = 'kb'; if ($this->_rootref['S_IS_MCP']) {  $this->_tpl_include('mcp_header.html'); } else if ($this->_rootref['S_IS_UCP']) {  $this->_tpl_include('ucp_header.html'); } else { $this->_tpl_include('overall_header.html'); } if (! $this->_rootref['S_IS_MCP'] && ! $this->_rootref['S_IS_UCP']) {  ?>


<table style="width: 100%">
	<tr>
		<?php if (sizeof($this->_tpldata['left_menu'])) {  ?>

		<td id="left_menu" style="width: <?php echo (isset($this->_rootref['LEFT_MENU_WIDTH'])) ? $this->_rootref['LEFT_MENU_WIDTH'] : ''; ?>; vertical-align: top;">
			<?php $_left_menu_count = (isset($this->_tpldata['left_menu'])) ? sizeof($this->_tpldata['left_menu']) : 0;if ($_left_menu_count) {for ($_left_menu_i = 0; $_left_menu_i < $_left_menu_count; ++$_left_menu_i){$_left_menu_val = &$this->_tpldata['left_menu'][$_left_menu_i]; ?>

			<?php echo $_left_menu_val['CONTENT']; ?>

			<?php }} ?>

		</td>
		<?php } ?>

		
		<td style="vertical-align: top;<?php if (sizeof($this->_tpldata['left_menu'])) {  ?> padding-left: 10px;<?php } if (sizeof($this->_tpldata['right_menu'])) {  ?> padding-right: 10px;<?php } ?>"><?php } ?>