<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('ucp_header.html'); ?>

<form id="ucp" method="post" action="<?php echo (isset($this->_rootref['S_UCP_ACTION'])) ? $this->_rootref['S_UCP_ACTION'] : ''; ?>"<?php echo (isset($this->_rootref['S_FORM_ENCTYPE'])) ? $this->_rootref['S_FORM_ENCTYPE'] : ''; ?>>

<h2><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></h2>

<div class="panel">
	<div class="inner">

	<p><?php echo ((isset($this->_rootref['L_REQUESTS_EXPLAIN'])) ? $this->_rootref['L_REQUESTS_EXPLAIN'] : ((isset($user->lang['REQUESTS_EXPLAIN'])) ? $user->lang['REQUESTS_EXPLAIN'] : '{ REQUESTS_EXPLAIN }')); ?></p>

	<fieldset class="fields2">
	<?php if ($this->_rootref['ERROR']) {  ?><p class="error"><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></p><?php } ?>
	</fieldset>
	
	<ul class="topiclist">
		<li class="header">
			<dl class="meta">
				<dt class="no-icon"><div class="inner"><?php echo ((isset($this->_rootref['L_FRIENDS'])) ? $this->_rootref['L_FRIENDS'] : ((isset($user->lang['FRIENDS'])) ? $user->lang['FRIENDS'] : '{ FRIENDS }')); ?></div></dt>
				<dd class="mark"><?php echo ((isset($this->_rootref['L_ADD'])) ? $this->_rootref['L_ADD'] : ((isset($user->lang['ADD'])) ? $user->lang['ADD'] : '{ ADD }')); ?></dd>
			</dl>
		</li>
	</ul>
	<ul class="topiclist cplist">
		<?php if ((zebra)) {  $_zebra_count = (isset($this->_tpldata['zebra'])) ? sizeof($this->_tpldata['zebra']) : 0;if ($_zebra_count) {for ($_zebra_i = 0; $_zebra_i < $_zebra_count; ++$_zebra_i){$_zebra_val = &$this->_tpldata['zebra'][$_zebra_i]; ?>
		<li class="row<?php if (($_zebra_val['S_ROW_COUNT'] & 1)  ) {  ?> bg1<?php } else { ?> bg2<?php } ?>">
			<dl>
				<dt class="no-icon"><div class="inner">
					<span><?php echo $_zebra_val['USERNAME']; ?></span>
				</div></dt>
				<dd class="mark"><input type="radio" name="add" value="<?php echo $_zebra_val['USERNAME_CLEAN']; ?>" /></dd>
			</dl>
		</li>
		<?php }} } else { ?>
			<strong><?php echo ((isset($this->_rootref['L_NO_FRIENDS'])) ? $this->_rootref['L_NO_FRIENDS'] : ((isset($user->lang['NO_FRIENDS'])) ? $user->lang['NO_FRIENDS'] : '{ NO_FRIENDS }')); ?></strong>
		<?php } ?>
	</ul>

	</div>
</div>

<fieldset class="submit-buttons">
	<?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?><input type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" class="button1" />&nbsp; 
	<input type="reset" value="<?php echo ((isset($this->_rootref['L_RESET'])) ? $this->_rootref['L_RESET'] : ((isset($user->lang['RESET'])) ? $user->lang['RESET'] : '{ RESET }')); ?>" name="reset" class="button2" />
	<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>
</fieldset>
</form>

<?php $this->_tpl_include('ucp_footer.html'); ?>