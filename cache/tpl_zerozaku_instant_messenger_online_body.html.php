<?php if (!defined('IN_PHPBB')) exit; if (sizeof($this->_tpldata['online_row'])) {  $_online_row_count = (isset($this->_tpldata['online_row'])) ? sizeof($this->_tpldata['online_row']) : 0;if ($_online_row_count) {for ($_online_row_i = 0; $_online_row_i < $_online_row_count; ++$_online_row_i){$_online_row_val = &$this->_tpldata['online_row'][$_online_row_i]; ?>
		<li><a href="#" userid="<?php echo $_online_row_val['USER_ID']; ?>"><span style="background-image: url('<?php echo $_online_row_val['IMG_STATUS']; ?>');"><?php echo $_online_row_val['AVATAR']; ?> <?php echo $_online_row_val['USERNAME']; ?> </a></li>
	<?php }} } ?>