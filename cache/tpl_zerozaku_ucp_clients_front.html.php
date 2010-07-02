<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('ucp_header.html'); ?>


<form id="postform" method="post" action="<?php echo (isset($this->_rootref['S_UCP_ACTION'])) ? $this->_rootref['S_UCP_ACTION'] : ''; ?>"<?php echo (isset($this->_rootref['S_FORM_ENCTYPE'])) ? $this->_rootref['S_FORM_ENCTYPE'] : ''; ?>>

<h2><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></h2>

<div class="panel">
	<div class="inner">

	<p><?php echo ((isset($this->_rootref['L_CLIENTS_EXPLAIN'])) ? $this->_rootref['L_CLIENTS_EXPLAIN'] : ((isset($user->lang['CLIENTS_EXPLAIN'])) ? $user->lang['CLIENTS_EXPLAIN'] : '{ CLIENTS_EXPLAIN }')); ?></p>

<?php if ($this->_rootref['S_EDIT_CLIENT']) {  if ($this->_rootref['ERROR']) {  ?><div class="error"><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></div><br /><br /><?php } ?>

			
			<fieldset>
				<h3 class="sub"><?php echo ((isset($this->_rootref['L_CLIENT_DETAILS'])) ? $this->_rootref['L_CLIENT_DETAILS'] : ((isset($user->lang['CLIENT_DETAILS'])) ? $user->lang['CLIENT_DETAILS'] : '{ CLIENT_DETAILS }')); ?></h3>
				<dl>
					<dt><label for="client_name"><?php echo ((isset($this->_rootref['L_CLIENT_NAME'])) ? $this->_rootref['L_CLIENT_NAME'] : ((isset($user->lang['CLIENT_NAME'])) ? $user->lang['CLIENT_NAME'] : '{ CLIENT_NAME }')); ?>:</label><br /><span><?php echo ((isset($this->_rootref['L_CLIENT_NAME_EXPLAIN'])) ? $this->_rootref['L_CLIENT_NAME_EXPLAIN'] : ((isset($user->lang['CLIENT_NAME_EXPLAIN'])) ? $user->lang['CLIENT_NAME_EXPLAIN'] : '{ CLIENT_NAME_EXPLAIN }')); ?></span></dt>
					<dd><input type="text" name="client_name" id="client_name" value="<?php echo (isset($this->_rootref['CLIENT_NAME'])) ? $this->_rootref['CLIENT_NAME'] : ''; ?>" class="inputbox autowidth" /></dd>
				</dl>
				<dl>
					<dt><label for="client_desc"><?php echo ((isset($this->_rootref['L_CLIENT_DESC'])) ? $this->_rootref['L_CLIENT_DESC'] : ((isset($user->lang['CLIENT_DESC'])) ? $user->lang['CLIENT_DESC'] : '{ CLIENT_DESC }')); ?>:</label><br /><span><?php echo ((isset($this->_rootref['L_CLIENT_DESC_EXPLAIN'])) ? $this->_rootref['L_CLIENT_DESC_EXPLAIN'] : ((isset($user->lang['CLIENT_DESC_EXPLAIN'])) ? $user->lang['CLIENT_DESC_EXPLAIN'] : '{ CLIENT_DESC_EXPLAIN }')); ?></span></td>
					<dd><textarea rows="2" cols="30" name="client_desc" id="client_desc" class="inputbox narrow"><?php echo (isset($this->_rootref['CLIENT_DESC'])) ? $this->_rootref['CLIENT_DESC'] : ''; ?></textarea></dd>
				</dl>
				<dl>
					<dt><label for="client_new_pass"><?php echo ((isset($this->_rootref['L_CLIENT_NEW_PASS'])) ? $this->_rootref['L_CLIENT_NEW_PASS'] : ((isset($user->lang['CLIENT_NEW_PASS'])) ? $user->lang['CLIENT_NEW_PASS'] : '{ CLIENT_NEW_PASS }')); ?>:</label><br /><span><?php echo ((isset($this->_rootref['L_CLIENT_NEW_PASS_EXPLAIN'])) ? $this->_rootref['L_CLIENT_NEW_PASS_EXPLAIN'] : ((isset($user->lang['CLIENT_NEW_PASS_EXPLAIN'])) ? $user->lang['CLIENT_NEW_PASS_EXPLAIN'] : '{ CLIENT_NEW_PASS_EXPLAIN }')); ?></span></td>
					<dd><input type="password" name="client_new_pass" id="client_new_pass" class="inputbox autowidth" value="<?php echo (isset($this->_rootref['CLIENT_NEW_PASS'])) ? $this->_rootref['CLIENT_NEW_PASS'] : ''; ?>" /></dd>
				</dl>
				<dl>
					<dt><label for="client_passconf"><?php echo ((isset($this->_rootref['L_CLIENT_PASSCONF'])) ? $this->_rootref['L_CLIENT_PASSCONF'] : ((isset($user->lang['CLIENT_PASSCONF'])) ? $user->lang['CLIENT_PASSCONF'] : '{ CLIENT_PASSCONF }')); ?>:</label></td>
					<dd><input type="password" name="client_passconf" id="client_passconf" class="inputbox autowidth" value="<?php echo (isset($this->_rootref['CLIENT_PASSCONF'])) ? $this->_rootref['CLIENT_PASSCONF'] : ''; ?>" /></dd>
				</dl>
			</fieldset>
			
		</div>
	</div>
	
	<div class="panel">
		<div class="inner">
			<fieldset>
				<dl>
					<dt><label for="client_passcur"><?php echo ((isset($this->_rootref['L_CLIENT_PASSCUR'])) ? $this->_rootref['L_CLIENT_PASSCUR'] : ((isset($user->lang['CLIENT_PASSCUR'])) ? $user->lang['CLIENT_PASSCUR'] : '{ CLIENT_PASSCUR }')); ?>:</label><br /><span><?php echo ((isset($this->_rootref['L_CLIENT_PASSCUR_EXPLAIN'])) ? $this->_rootref['L_CLIENT_PASSCUR_EXPLAIN'] : ((isset($user->lang['CLIENT_PASSCUR_EXPLAIN'])) ? $user->lang['CLIENT_PASSCUR_EXPLAIN'] : '{ CLIENT_PASSCUR_EXPLAIN }')); ?></span></td>
					<dd><input type="password" name="client_passcur" id="client_passcur" class="inputbox autowidth" value="<?php echo (isset($this->_rootref['CLIENT_PASSCUR'])) ? $this->_rootref['CLIENT_PASSCUR'] : ''; ?>" /></dd>
				</dl>
			</fieldset>
		</div>
	</div>
	
	<fieldset class="submit-buttons">
		<?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?><input type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" class="button1" />
		<input type="reset" name="reset" value="<?php echo ((isset($this->_rootref['L_RESET'])) ? $this->_rootref['L_RESET'] : ((isset($user->lang['RESET'])) ? $user->lang['RESET'] : '{ RESET }')); ?>" class="button2" />
		<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

	</fieldset>


<?php } else { if (sizeof($this->_tpldata['clientrow'])) {  ?>

		<ul class="topiclist">
			<li class="header">
				<dl class="meta">
					<dt class="no-icon" style="width: 5%"><div class="inner"><?php echo ((isset($this->_rootref['L_CLIENT_ID'])) ? $this->_rootref['L_CLIENT_ID'] : ((isset($user->lang['CLIENT_ID'])) ? $user->lang['CLIENT_ID'] : '{ CLIENT_ID }')); ?></div></dt>
					<dd class="info" style="width: 60%"><span><?php echo ((isset($this->_rootref['L_CLIENT_NAME'])) ? $this->_rootref['L_CLIENT_NAME'] : ((isset($user->lang['CLIENT_NAME'])) ? $user->lang['CLIENT_NAME'] : '{ CLIENT_NAME }')); ?></span></dd>
					<dd class="extra" style="width: 20%"><span><?php echo ((isset($this->_rootref['L_CLIENT_USES'])) ? $this->_rootref['L_CLIENT_USES'] : ((isset($user->lang['CLIENT_USES'])) ? $user->lang['CLIENT_USES'] : '{ CLIENT_USES }')); ?></span></dd>
					<dd class="mark"><div class="inner"><?php echo ((isset($this->_rootref['L_MARK'])) ? $this->_rootref['L_MARK'] : ((isset($user->lang['MARK'])) ? $user->lang['MARK'] : '{ MARK }')); ?></div></dd>
				</dl>
			</li>
		</ul>
		<ul class="topiclist cplist">

		<?php $_clientrow_count = (isset($this->_tpldata['clientrow'])) ? sizeof($this->_tpldata['clientrow']) : 0;if ($_clientrow_count) {for ($_clientrow_i = 0; $_clientrow_i < $_clientrow_count; ++$_clientrow_i){$_clientrow_val = &$this->_tpldata['clientrow'][$_clientrow_i]; ?>

			<li class="row<?php if (($_clientrow_val['S_ROW_COUNT'] & 1)  ) {  ?> bg1<?php } else { ?> bg2<?php } ?>">
				<dl>
					<dt class="no-icon" style="width: 5%">
						<div class="inner">
							<a href="<?php echo $_clientrow_val['U_CLIENT_PERMA']; ?>" title="<?php echo $_clientrow_val['CLIENT_NAME']; ?>" target="_blank"><?php echo (isset($this->_rootref['TEST_PAGE_IMG'])) ? $this->_rootref['TEST_PAGE_IMG'] : ''; echo $_clientrow_val['CLIENT_ID']; ?></a>
						</div>
					</dt>
					<dd class="info" style="width: 60%"><div class="inner"><a class="topictitle" href="<?php echo $_clientrow_val['U_VIEW_EDIT']; ?>"><?php echo $_clientrow_val['CLIENT_NAME']; ?></a><br /><?php echo $_clientrow_val['CLIENT_DESC']; ?></div></dd>
					<dd class="extra" style="width: 20%"><div class="inner"><?php echo $_clientrow_val['CLIENT_USES']; ?></div></dd>
					<dd class="mark"><div class="inner"><input type="checkbox" name="d[<?php echo $_clientrow_val['CLIENT_ID']; ?>]" id="d<?php echo $_clientrow_val['CLIENT_ID']; ?>" /></div></dd>
				</dl>
			</li>
		<?php }} ?>

		</ul>
	<?php } else { ?>

		<p><strong><?php echo ((isset($this->_rootref['L_NO_CLIENTS'])) ? $this->_rootref['L_NO_CLIENTS'] : ((isset($user->lang['NO_CLIENTS'])) ? $user->lang['NO_CLIENTS'] : '{ NO_CLIENTS }')); ?></strong></p>
	<?php } ?>


	</div>
</div>

	<?php if (sizeof($this->_tpldata['clientrow'])) {  ?>

		<fieldset class="display-actions">
			<input class="button2" type="submit" name="delete" value="<?php echo ((isset($this->_rootref['L_DELETE_MARKED'])) ? $this->_rootref['L_DELETE_MARKED'] : ((isset($user->lang['DELETE_MARKED'])) ? $user->lang['DELETE_MARKED'] : '{ DELETE_MARKED }')); ?>" />
			<div><a href="#" onclick="marklist('postform', '', true); return false;"><?php echo ((isset($this->_rootref['L_MARK_ALL'])) ? $this->_rootref['L_MARK_ALL'] : ((isset($user->lang['MARK_ALL'])) ? $user->lang['MARK_ALL'] : '{ MARK_ALL }')); ?></a> &bull; <a href="#" onclick="marklist('postform', '', false); return false;"><?php echo ((isset($this->_rootref['L_UNMARK_ALL'])) ? $this->_rootref['L_UNMARK_ALL'] : ((isset($user->lang['UNMARK_ALL'])) ? $user->lang['UNMARK_ALL'] : '{ UNMARK_ALL }')); ?></a></div>
			<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

		</fieldset>
	<?php } } ?>


</form>

<?php $this->_tpl_include('ucp_footer.html'); ?>