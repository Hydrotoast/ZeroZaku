<?php if (!defined('IN_PHPBB')) exit; if ($this->_rootref['S_SHOW_REQ_LIST']) {  ?>

<div class="panel smooth">
	<div class="inner">
		<div class="left_menu_title"><?php echo ((isset($this->_rootref['L_KB_REQS'])) ? $this->_rootref['L_KB_REQS'] : ((isset($user->lang['KB_REQS'])) ? $user->lang['KB_REQS'] : '{ KB_REQS }')); ?></div>
		
		<div style="padding-bottom: 3px;" class="user_menu">
		<?php if (sizeof($this->_tpldata['req_list'])) {  ?>

			<hr />
			<?php $_req_list_count = (isset($this->_tpldata['req_list'])) ? sizeof($this->_tpldata['req_list']) : 0;if ($_req_list_count) {for ($_req_list_i = 0; $_req_list_i < $_req_list_count; ++$_req_list_i){$_req_list_val = &$this->_tpldata['req_list'][$_req_list_i]; ?>

				<a href="<?php echo $_req_list_val['U_VIEW_REQ']; ?>"><?php echo $_req_list_val['REQ_TITLE']; ?></a><br />
			<?php }} } else { ?>

		<strong><?php echo ((isset($this->_rootref['L_KB_NO_REQS'])) ? $this->_rootref['L_KB_NO_REQS'] : ((isset($user->lang['KB_NO_REQS'])) ? $user->lang['KB_NO_REQS'] : '{ KB_NO_REQS }')); ?></strong>
		<?php } if ($this->_rootref['U_ADD_REQ'] || $this->_rootref['U_VIEW_ALL']) {  ?>

			<hr /><?php if ($this->_rootref['U_ADD_REQ']) {  ?><a href="<?php echo (isset($this->_rootref['U_ADD_REQ'])) ? $this->_rootref['U_ADD_REQ'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_KB_ADD_REQUEST'])) ? $this->_rootref['L_KB_ADD_REQUEST'] : ((isset($user->lang['KB_ADD_REQUEST'])) ? $user->lang['KB_ADD_REQUEST'] : '{ KB_ADD_REQUEST }')); ?>"><?php echo ((isset($this->_rootref['L_KB_ADD_REQUEST'])) ? $this->_rootref['L_KB_ADD_REQUEST'] : ((isset($user->lang['KB_ADD_REQUEST'])) ? $user->lang['KB_ADD_REQUEST'] : '{ KB_ADD_REQUEST }')); ?></a><?php if ($this->_rootref['U_VIEW_ALL']) {  ?> || <?php } } if ($this->_rootref['U_VIEW_ALL']) {  ?><a href="<?php echo (isset($this->_rootref['U_VIEW_ALL'])) ? $this->_rootref['U_VIEW_ALL'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_VIEW_ALL'])) ? $this->_rootref['L_VIEW_ALL'] : ((isset($user->lang['VIEW_ALL'])) ? $user->lang['VIEW_ALL'] : '{ VIEW_ALL }')); ?>"><?php echo ((isset($this->_rootref['L_VIEW_ALL'])) ? $this->_rootref['L_VIEW_ALL'] : ((isset($user->lang['VIEW_ALL'])) ? $user->lang['VIEW_ALL'] : '{ VIEW_ALL }')); ?></a><?php } } ?>

		</div>
	</div>
</div>
<?php } ?>