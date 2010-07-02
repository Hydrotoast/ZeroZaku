<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('overall_header.html'); ?>
<h1><?php echo ((isset($this->_rootref['L_COMMENT_TITLE'])) ? $this->_rootref['L_COMMENT_TITLE'] : ((isset($user->lang['COMMENT_TITLE'])) ? $user->lang['COMMENT_TITLE'] : '{ COMMENT_TITLE }')); ?></h1>
<p><?php echo ((isset($this->_rootref['L_DATABASE_HAS'])) ? $this->_rootref['L_DATABASE_HAS'] : ((isset($user->lang['DATABASE_HAS'])) ? $user->lang['DATABASE_HAS'] : '{ DATABASE_HAS }')); ?> <?php echo (isset($this->_rootref['TOTAL_STATUS'])) ? $this->_rootref['TOTAL_STATUS'] : ''; ?> <?php echo ((isset($this->_rootref['L_STORED_COMMENTS'])) ? $this->_rootref['L_STORED_COMMENTS'] : ((isset($user->lang['STORED_COMMENTS'])) ? $user->lang['STORED_COMMENTS'] : '{ STORED_COMMENTS }')); ?></p>
<form method="post" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
<fieldset>
<dl>
	<dt><label for="enable_comment"><?php echo ((isset($this->_rootref['L_ENABLE_COMMENT'])) ? $this->_rootref['L_ENABLE_COMMENT'] : ((isset($user->lang['ENABLE_COMMENT'])) ? $user->lang['ENABLE_COMMENT'] : '{ ENABLE_COMMENT }')); ?></label></dt>
	<dd><input type="radio" class="radio" name="enable_comment"
		value="1"<?php if ($this->_rootref['ENABLE_COMMENT']) {  ?>checked="checked"<?php } ?>/>
	<?php echo ((isset($this->_rootref['L_YES'])) ? $this->_rootref['L_YES'] : ((isset($user->lang['YES'])) ? $user->lang['YES'] : '{ YES }')); ?> &nbsp; <input type="radio" class="radio" name="enable_comment"
		value="0"<?php if (! $this->_rootref['ENABLE_COMMENT']) {  ?>checked="checked"<?php } ?>
	/> <?php echo ((isset($this->_rootref['L_NO'])) ? $this->_rootref['L_NO'] : ((isset($user->lang['NO'])) ? $user->lang['NO'] : '{ NO }')); ?></dd>
</dl>
<dl>
	<dt><label for="enable_qc"><?php echo ((isset($this->_rootref['L_ENABLE_QC'])) ? $this->_rootref['L_ENABLE_QC'] : ((isset($user->lang['ENABLE_QC'])) ? $user->lang['ENABLE_QC'] : '{ ENABLE_QC }')); ?></label></dt>
	<dd><input type="radio" class="radio" name="enable_qc" value="1"<?php if ($this->_rootref['ENABLE_QC']) {  ?>checked="checked"<?php } ?>/>
	<?php echo ((isset($this->_rootref['L_YES'])) ? $this->_rootref['L_YES'] : ((isset($user->lang['YES'])) ? $user->lang['YES'] : '{ YES }')); ?> &nbsp; <input type="radio" class="radio" name="enable_qc"
		value="0"<?php if (! $this->_rootref['ENABLE_QC']) {  ?>checked="checked"<?php } ?>
	/> <?php echo ((isset($this->_rootref['L_NO'])) ? $this->_rootref['L_NO'] : ((isset($user->lang['NO'])) ? $user->lang['NO'] : '{ NO }')); ?></dd>
</dl>
</fieldset>

<fieldset>
<dl>
	<dt><label for="comments_per_page"><?php echo ((isset($this->_rootref['L_COMM_PER_PAGE'])) ? $this->_rootref['L_COMM_PER_PAGE'] : ((isset($user->lang['COMM_PER_PAGE'])) ? $user->lang['COMM_PER_PAGE'] : '{ COMM_PER_PAGE }')); ?></label><br />
	<span><?php echo ((isset($this->_rootref['L_COMM_PER_PAGE_EXPLAIN'])) ? $this->_rootref['L_COMM_PER_PAGE_EXPLAIN'] : ((isset($user->lang['COMM_PER_PAGE_EXPLAIN'])) ? $user->lang['COMM_PER_PAGE_EXPLAIN'] : '{ COMM_PER_PAGE_EXPLAIN }')); ?></span></dt>
	<dd><span><input class="post" type="text" maxlength="2"
		size="2" name="comm_per_page" value="<?php echo (isset($this->_rootref['COMM_PER_PAGE'])) ? $this->_rootref['COMM_PER_PAGE'] : ''; ?>" /></dd>
</dl>
<dl>
	<dt><label for="avatar_size"><?php echo ((isset($this->_rootref['L_AVATAR_SIZE'])) ? $this->_rootref['L_AVATAR_SIZE'] : ((isset($user->lang['AVATAR_SIZE'])) ? $user->lang['AVATAR_SIZE'] : '{ AVATAR_SIZE }')); ?></label><br />
	<span><?php echo ((isset($this->_rootref['L_AVATAR_SIZE_EXPLAIN'])) ? $this->_rootref['L_AVATAR_SIZE_EXPLAIN'] : ((isset($user->lang['AVATAR_SIZE_EXPLAIN'])) ? $user->lang['AVATAR_SIZE_EXPLAIN'] : '{ AVATAR_SIZE_EXPLAIN }')); ?></span></dt>

	<dd><span><input class="post" type="text" maxlength="3"
		size="2" name="sc_av_size" value="<?php echo (isset($this->_rootref['AVATAR_SIZE'])) ? $this->_rootref['AVATAR_SIZE'] : ''; ?>" /></dd>
</dl>
</fieldset>

<input class="button1" type="submit" id="submit" name="submit"
	value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" /></form>
<form method="post" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>&action=deleteall">
<fieldset>
<dl>
	<dt><label for="mass_delete"><?php echo ((isset($this->_rootref['L_MASS_DELETE'])) ? $this->_rootref['L_MASS_DELETE'] : ((isset($user->lang['MASS_DELETE'])) ? $user->lang['MASS_DELETE'] : '{ MASS_DELETE }')); ?></label><br />
	<span><?php echo ((isset($this->_rootref['L_MASS_DELETE_EXPLAIN'])) ? $this->_rootref['L_MASS_DELETE_EXPLAIN'] : ((isset($user->lang['MASS_DELETE_EXPLAIN'])) ? $user->lang['MASS_DELETE_EXPLAIN'] : '{ MASS_DELETE_EXPLAIN }')); ?></span></dt>

	<dd><span><input class="post" type="text" maxlength="10"
		size="2" name="mass_delete" /></dd>
	<dt>
	<dd><input class="button1" type="submit" id="submited"
		name="submited" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" /></dd>
	</dt>
</dl>

</fieldset>
</form>

<ul class="linklist">

	<li class="rightside pagination"><?php if ($this->_rootref['PAGINATION']) {  ?><a href="#"
		onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a>
	&bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } ?></li>
</ul>

<table cellspacing="1">
	<thead>

		<tr>
			<th width="15%"><?php echo ((isset($this->_rootref['L_COMMENT_AUTHOR'])) ? $this->_rootref['L_COMMENT_AUTHOR'] : ((isset($user->lang['COMMENT_AUTHOR'])) ? $user->lang['COMMENT_AUTHOR'] : '{ COMMENT_AUTHOR }')); ?></th>
			<th width="60%"><?php echo ((isset($this->_rootref['L_COMMENT'])) ? $this->_rootref['L_COMMENT'] : ((isset($user->lang['COMMENT'])) ? $user->lang['COMMENT'] : '{ COMMENT }')); ?></th>
			<th width="20%"><?php echo ((isset($this->_rootref['L_COMMENT_DATE'])) ? $this->_rootref['L_COMMENT_DATE'] : ((isset($user->lang['COMMENT_DATE'])) ? $user->lang['COMMENT_DATE'] : '{ COMMENT_DATE }')); ?></th>
			<th width="5%"><?php echo ((isset($this->_rootref['L_COMMENT_DELETE'])) ? $this->_rootref['L_COMMENT_DELETE'] : ((isset($user->lang['COMMENT_DELETE'])) ? $user->lang['COMMENT_DELETE'] : '{ COMMENT_DELETE }')); ?></th>
		</tr>
	</thead>
	<tbody>

		<?php $_comment_count = (isset($this->_tpldata['comment'])) ? sizeof($this->_tpldata['comment']) : 0;if ($_comment_count) {for ($_comment_i = 0; $_comment_i < $_comment_count; ++$_comment_i){$_comment_val = &$this->_tpldata['comment'][$_comment_i]; ?>
		<form id="status" method="post" action="<?php echo $_comment_val['U_ACTION']; ?>">
		<tr>
			<td bgcolor="#DCEBFE" style="text-align: center;" width="15%"><span><?php echo $_comment_val['COMMENT_AUTHOR']; ?>
			<b>to</b> <?php echo $_comment_val['COMMENT_TO']; ?></span></td>
			<td bgcolor="#F9F9F9" width="60%"><?php echo $_comment_val['COMMENT_TEXT']; ?></td>
			<td bgcolor="#DCEBFE" style="text-align: center;" width="20%">
			<?php echo $_comment_val['COMMENT_DATE']; ?></td>
			<td bgcolor="#F9F9F9" width="5%"><input class="button2"
				type="submit" value="<?php echo ((isset($this->_rootref['L_STATUS_DELETE'])) ? $this->_rootref['L_STATUS_DELETE'] : ((isset($user->lang['STATUS_DELETE'])) ? $user->lang['STATUS_DELETE'] : '{ STATUS_DELETE }')); ?>" name="delete" /></td>
		</tr>
		</form>
		<?php }} ?>

	</tbody>
</table>
<ul class="linklist">
	<li class="rightside pagination"><?php if ($this->_rootref['PAGINATION']) {  ?><a href="#"
		onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a>
	&bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } ?></li>
</ul>
<?php $this->_tpl_include('overall_footer.html'); ?>