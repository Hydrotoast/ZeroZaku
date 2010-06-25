<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('ucp_header.html'); ?>


<form id="ucp" method="post" action="<?php echo (isset($this->_rootref['S_UCP_ACTION'])) ? $this->_rootref['S_UCP_ACTION'] : ''; ?>"<?php echo (isset($this->_rootref['S_FORM_ENCTYPE'])) ? $this->_rootref['S_FORM_ENCTYPE'] : ''; ?>>

<h2><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></h2>

<div class="panel">
	<div class="inner">

	<p><?php echo ((isset($this->_rootref['L_FOES_EXPLAIN'])) ? $this->_rootref['L_FOES_EXPLAIN'] : ((isset($user->lang['FOES_EXPLAIN'])) ? $user->lang['FOES_EXPLAIN'] : '{ FOES_EXPLAIN }')); ?></p>

	<fieldset class="fields2">
	<?php if ($this->_rootref['ERROR']) {  ?><p class="error"><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></p><?php } ?>

	<dl>
		<dt><label for="add"><?php echo ((isset($this->_rootref['L_ADD_FOES'])) ? $this->_rootref['L_ADD_FOES'] : ((isset($user->lang['ADD_FOES'])) ? $user->lang['ADD_FOES'] : '{ ADD_FOES }')); ?>:</label><br /><span><?php echo ((isset($this->_rootref['L_ADD_FOES_EXPLAIN'])) ? $this->_rootref['L_ADD_FOES_EXPLAIN'] : ((isset($user->lang['ADD_FOES_EXPLAIN'])) ? $user->lang['ADD_FOES_EXPLAIN'] : '{ ADD_FOES_EXPLAIN }')); ?></span></dt>
		<dd><textarea name="add" id="add" rows="3" cols="30" class="inputbox"><?php echo (isset($this->_rootref['USERNAMES'])) ? $this->_rootref['USERNAMES'] : ''; ?></textarea></dd>
		<dd><strong><a href="<?php echo (isset($this->_rootref['U_FIND_USERNAME'])) ? $this->_rootref['U_FIND_USERNAME'] : ''; ?>" onclick="find_username(this.href); return false;"><?php echo ((isset($this->_rootref['L_FIND_USERNAME'])) ? $this->_rootref['L_FIND_USERNAME'] : ((isset($user->lang['FIND_USERNAME'])) ? $user->lang['FIND_USERNAME'] : '{ FIND_USERNAME }')); ?></a></strong></dd>
		<dd><input type="submit" class="button2" value="Add Foe" name="submit" /></dd>
	</dl>
	</fieldset>
	
	<ul class="topiclist">
		<li class="header">
			<dl class="meta">
				<dt class="no-icon"><div class="inner"><?php echo ((isset($this->_rootref['L_FOES'])) ? $this->_rootref['L_FOES'] : ((isset($user->lang['FOES'])) ? $user->lang['FOES'] : '{ FOES }')); ?></div></dt>
				<dd class="mark"><?php echo ((isset($this->_rootref['L_DELETE'])) ? $this->_rootref['L_DELETE'] : ((isset($user->lang['DELETE'])) ? $user->lang['DELETE'] : '{ DELETE }')); ?></dd>
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
				<dd class="mark"><input type="checkbox" name="usernames[]" value="<?php echo $_zebra_val['USER_ID']; ?>" /></dd>
			</dl>
		</li>
		<?php }} } else { ?>

			<strong><?php echo ((isset($this->_rootref['L_NO_FOES'])) ? $this->_rootref['L_NO_FOES'] : ((isset($user->lang['NO_FOES'])) ? $user->lang['NO_FOES'] : '{ NO_FOES }')); ?></strong>
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