<?php if (!defined('IN_PHPBB')) exit; ?><h2 class="cattitle"><span><?php echo ((isset($this->_rootref['L_QUICK_REPLY'])) ? $this->_rootref['L_QUICK_REPLY'] : ((isset($user->lang['QUICK_REPLY'])) ? $user->lang['QUICK_REPLY'] : '{ QUICK_REPLY }')); ?></span></h2>
<form id="postform" method="post" action="<?php echo (isset($this->_rootref['S_POST_ACTION'])) ? $this->_rootref['S_POST_ACTION'] : ''; ?>" onsubmit="return checkForm(this);" name="postform"<?php echo (isset($this->_rootref['S_FORM_ENCTYPE'])) ? $this->_rootref['S_FORM_ENCTYPE'] : ''; ?>>

	<div class="panel" id="postingbox">
		<div class="inner">
		
	<fieldset class="fields1">
		<?php if ($this->_rootref['ERROR']) {  ?><p class="error"><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></p><?php } if ($this->_rootref['S_SHOW_TOPIC_ICONS']) {  ?>

		<dl>
			<dt><label for="icon"><?php echo ((isset($this->_rootref['L_ICON'])) ? $this->_rootref['L_ICON'] : ((isset($user->lang['ICON'])) ? $user->lang['ICON'] : '{ ICON }')); ?>:</label></dt>
			<dd>
				<label for="icon"><input type="radio" name="icon" id="icon" value="0" checked="checked" /> <?php echo ((isset($this->_rootref['L_NO_TOPIC_ICON'])) ? $this->_rootref['L_NO_TOPIC_ICON'] : ((isset($user->lang['NO_TOPIC_ICON'])) ? $user->lang['NO_TOPIC_ICON'] : '{ NO_TOPIC_ICON }')); ?></label>
				<?php $_topic_icon_count = (isset($this->_tpldata['topic_icon'])) ? sizeof($this->_tpldata['topic_icon']) : 0;if ($_topic_icon_count) {for ($_topic_icon_i = 0; $_topic_icon_i < $_topic_icon_count; ++$_topic_icon_i){$_topic_icon_val = &$this->_tpldata['topic_icon'][$_topic_icon_i]; ?><label for="icon-<?php echo $_topic_icon_val['ICON_ID']; ?>"><input type="radio" name="icon" id="icon-<?php echo $_topic_icon_val['ICON_ID']; ?>" value="<?php echo $_topic_icon_val['ICON_ID']; ?>" <?php echo $_topic_icon_val['S_ICON_CHECKED']; ?> /><img src="<?php echo $_topic_icon_val['ICON_IMG']; ?>" width="<?php echo $_topic_icon_val['ICON_WIDTH']; ?>" height="<?php echo $_topic_icon_val['ICON_HEIGHT']; ?>" alt="" title="" /></label> <?php }} ?>

			</dd>
		</dl>
		<?php } if ($this->_rootref['S_DISPLAY_USERNAME']) {  ?>

		<dl>
			<dt><label for="username"><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>:</label></dt>
			<dd><input type="text" tabindex="1" name="username" id="username" size="25" value="<?php echo (isset($this->_rootref['USERNAME'])) ? $this->_rootref['USERNAME'] : ''; ?>" class="inputbox" /></dd>
		</dl>
		<?php } if ($this->_rootref['S_POST_ACTION']) {  if ($this->_rootref['S_CONFIRM_CODE']) {  ?>

			<dl>
				<dt><label for="confirm_code"><?php echo ((isset($this->_rootref['L_CONFIRM_CODE'])) ? $this->_rootref['L_CONFIRM_CODE'] : ((isset($user->lang['CONFIRM_CODE'])) ? $user->lang['CONFIRM_CODE'] : '{ CONFIRM_CODE }')); ?>:</label><br /><span><?php echo ((isset($this->_rootref['L_CONFIRM_CODE_EXPLAIN'])) ? $this->_rootref['L_CONFIRM_CODE_EXPLAIN'] : ((isset($user->lang['CONFIRM_CODE_EXPLAIN'])) ? $user->lang['CONFIRM_CODE_EXPLAIN'] : '{ CONFIRM_CODE_EXPLAIN }')); ?></span></dt>
					<dd><input type="hidden" name="confirm_id" value="<?php echo (isset($this->_rootref['CONFIRM_ID'])) ? $this->_rootref['CONFIRM_ID'] : ''; ?>" /><?php echo (isset($this->_rootref['CONFIRM_IMAGE'])) ? $this->_rootref['CONFIRM_IMAGE'] : ''; ?></dd>
					<dd><input type="text" name="confirm_code" id="confirm_code" size="8" maxlength="8" tabindex="3" class="inputbox narrow" title="<?php echo ((isset($this->_rootref['L_CONFIRM_CODE'])) ? $this->_rootref['L_CONFIRM_CODE'] : ((isset($user->lang['CONFIRM_CODE'])) ? $user->lang['CONFIRM_CODE'] : '{ CONFIRM_CODE }')); ?>" /></dd>
			</dl>
			<?php } } $this->_tpl_include('posting_buttons.html'); ?>


		<div id="smiley-box">
			<?php if ($this->_rootref['S_SMILIES_ALLOWED'] && sizeof($this->_tpldata['smiley'])) {  ?>

				<strong><?php echo ((isset($this->_rootref['L_SMILIES'])) ? $this->_rootref['L_SMILIES'] : ((isset($user->lang['SMILIES'])) ? $user->lang['SMILIES'] : '{ SMILIES }')); ?></strong><br />
				<?php $_smiley_count = (isset($this->_tpldata['smiley'])) ? sizeof($this->_tpldata['smiley']) : 0;if ($_smiley_count) {for ($_smiley_i = 0; $_smiley_i < $_smiley_count; ++$_smiley_i){$_smiley_val = &$this->_tpldata['smiley'][$_smiley_i]; ?>

					<a href="#" onclick="insert_text('<?php echo $_smiley_val['A_SMILEY_CODE']; ?>', true); return false;"><img src="<?php echo $_smiley_val['SMILEY_IMG']; ?>" width="<?php echo $_smiley_val['SMILEY_WIDTH']; ?>" height="<?php echo $_smiley_val['SMILEY_HEIGHT']; ?>" alt="<?php echo $_smiley_val['SMILEY_CODE']; ?>" title="<?php echo $_smiley_val['SMILEY_DESC']; ?>" /></a>
				<?php }} } if ($this->_rootref['S_SHOW_SMILEY_LINK'] && $this->_rootref['S_SMILIES_ALLOWED']) {  ?>

				<br /><a href="<?php echo (isset($this->_rootref['U_MORE_SMILIES'])) ? $this->_rootref['U_MORE_SMILIES'] : ''; ?>" onclick="popup(this.href, 300, 350, '_phpbbsmilies'); return false;"><?php echo ((isset($this->_rootref['L_MORE_SMILIES'])) ? $this->_rootref['L_MORE_SMILIES'] : ((isset($user->lang['MORE_SMILIES'])) ? $user->lang['MORE_SMILIES'] : '{ MORE_SMILIES }')); ?></a>
			<?php } if ($this->_rootref['BBCODE_STATUS']) {  if (sizeof($this->_tpldata['smiley'])) {  ?><hr /><?php } ?>

			<?php echo (isset($this->_rootref['BBCODE_STATUS'])) ? $this->_rootref['BBCODE_STATUS'] : ''; ?><br />
			<?php if ($this->_rootref['S_BBCODE_ALLOWED']) {  ?>

				<?php echo (isset($this->_rootref['IMG_STATUS'])) ? $this->_rootref['IMG_STATUS'] : ''; ?><br />
				<?php echo (isset($this->_rootref['FLASH_STATUS'])) ? $this->_rootref['FLASH_STATUS'] : ''; ?><br />
				<?php echo (isset($this->_rootref['URL_STATUS'])) ? $this->_rootref['URL_STATUS'] : ''; ?><br />
				<?php echo (isset($this->_rootref['SMILIES_STATUS'])) ? $this->_rootref['SMILIES_STATUS'] : ''; ?>

			<?php } } ?>

		</div>

		<div id="message-box">
			<textarea <?php if ($this->_rootref['S_UCP_ACTION']) {  ?>name="signature" id="signature" style="height: 9em;"<?php } else { ?>name="message" id="message"<?php } ?> rows="8" cols="76" tabindex="3" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);" class="inputbox"><?php echo (isset($this->_rootref['MESSAGE'])) ? $this->_rootref['MESSAGE'] : ''; ?></textarea>
		</div>
	</fieldset>

			</div>
		</div>

		<?php if (! $this->_rootref['S_SHOW_DRAFTS'] && ! $this->_tpldata['DEFINE']['.']['SIG_EDIT'] == (1)) {  ?>

		<div class="panel bg2">
			<div class="inner">
			<fieldset class="submit-buttons">
				<?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?>

				<input type="submit" accesskey="s" tabindex="6" name="post" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" class="button1" />&nbsp;
				<input type="submit" tabindex="5" name="preview" value="<?php echo ((isset($this->_rootref['L_PREVIEW'])) ? $this->_rootref['L_PREVIEW'] : ((isset($user->lang['PREVIEW'])) ? $user->lang['PREVIEW'] : '{ PREVIEW }')); ?>" class="button2" onclick="document.getElementById('postform').action += '#preview';" />&nbsp;

				</fieldset>

			</div>
		</div>
		<?php } if (! $this->_tpldata['DEFINE']['.']['SIG_EDIT'] == (1)) {  ?>

			<div id="tabs">
				<ul>
					<li id="options-panel-tab" class="activetab" style="display: <?php echo (isset($this->_rootref['EXTRA_OPTIONS_DISPLAY'])) ? $this->_rootref['EXTRA_OPTIONS_DISPLAY'] : ''; ?>;"><a href="#tabs" onclick="subPanels('options-panel'); return false;"><span><?php echo ((isset($this->_rootref['L_OPTIONS'])) ? $this->_rootref['L_OPTIONS'] : ((isset($user->lang['OPTIONS'])) ? $user->lang['OPTIONS'] : '{ OPTIONS }')); ?></span></a></li>
					<?php if ($this->_rootref['S_SHOW_ATTACH_BOX']) {  ?><li id="attach-panel-tab" <?php if (! $this->_rootref['EXTRA_OPTIONS']) {  ?>class="activetab"<?php } ?>><a href="#tabs" onclick="subPanels('attach-panel'); return false;"><span><?php echo ((isset($this->_rootref['L_ADD_ATTACHMENT'])) ? $this->_rootref['L_ADD_ATTACHMENT'] : ((isset($user->lang['ADD_ATTACHMENT'])) ? $user->lang['ADD_ATTACHMENT'] : '{ ADD_ATTACHMENT }')); ?></span></a></li><?php } ?>

				</ul>
			</div>
		<?php } if (! $this->_rootref['S_SHOW_DRAFTS'] && ! $this->_tpldata['DEFINE']['.']['SIG_EDIT'] == (1)) {  ?>

		<div class="panel bg3" id="options-panel" style="display: <?php echo (isset($this->_rootref['EXTRA_OPTIONS_DISPLAY'])) ? $this->_rootref['EXTRA_OPTIONS_DISPLAY'] : ''; ?>;">
			<div class="inner">

			<fieldset class="fields1">
				<?php if ($this->_rootref['S_BBCODE_ALLOWED']) {  ?>

					<div><label for="disable_bbcode"><input type="checkbox" name="disable_bbcode" id="disable_bbcode"<?php echo (isset($this->_rootref['S_BBCODE_CHECKED'])) ? $this->_rootref['S_BBCODE_CHECKED'] : ''; ?> /> <?php echo ((isset($this->_rootref['L_DISABLE_BBCODE'])) ? $this->_rootref['L_DISABLE_BBCODE'] : ((isset($user->lang['DISABLE_BBCODE'])) ? $user->lang['DISABLE_BBCODE'] : '{ DISABLE_BBCODE }')); ?></label></div>
				<?php } if ($this->_rootref['S_SMILIES_ALLOWED']) {  ?>

					<div><label for="disable_smilies"><input type="checkbox" name="disable_smilies" id="disable_smilies"<?php echo (isset($this->_rootref['S_SMILIES_CHECKED'])) ? $this->_rootref['S_SMILIES_CHECKED'] : ''; ?> /> <?php echo ((isset($this->_rootref['L_DISABLE_SMILIES'])) ? $this->_rootref['L_DISABLE_SMILIES'] : ((isset($user->lang['DISABLE_SMILIES'])) ? $user->lang['DISABLE_SMILIES'] : '{ DISABLE_SMILIES }')); ?></label></div>
				<?php } if ($this->_rootref['S_LINKS_ALLOWED']) {  ?>

					<div><label for="disable_magic_url"><input type="checkbox" name="disable_magic_url" id="disable_magic_url"<?php echo (isset($this->_rootref['S_MAGIC_URL_CHECKED'])) ? $this->_rootref['S_MAGIC_URL_CHECKED'] : ''; ?> /> <?php echo ((isset($this->_rootref['L_DISABLE_MAGIC_URL'])) ? $this->_rootref['L_DISABLE_MAGIC_URL'] : ((isset($user->lang['DISABLE_MAGIC_URL'])) ? $user->lang['DISABLE_MAGIC_URL'] : '{ DISABLE_MAGIC_URL }')); ?></label></div>
				<?php } if ($this->_rootref['S_SIG_ALLOWED']) {  ?>

					<div><label for="attach_sig"><input type="checkbox" name="attach_sig" id="attach_sig"<?php echo (isset($this->_rootref['S_SIGNATURE_CHECKED'])) ? $this->_rootref['S_SIGNATURE_CHECKED'] : ''; ?> /> <?php echo ((isset($this->_rootref['L_ATTACH_SIG'])) ? $this->_rootref['L_ATTACH_SIG'] : ((isset($user->lang['ATTACH_SIG'])) ? $user->lang['ATTACH_SIG'] : '{ ATTACH_SIG }')); ?></label></div>
				<?php } if ($this->_rootref['S_NOTIFY_ALLOWED']) {  ?>

					<div><label for="notify"><input type="checkbox" name="notify" id="notify"<?php echo (isset($this->_rootref['S_NOTIFY_CHECKED'])) ? $this->_rootref['S_NOTIFY_CHECKED'] : ''; ?> /> <?php echo ((isset($this->_rootref['L_NOTIFY_REPLY'])) ? $this->_rootref['L_NOTIFY_REPLY'] : ((isset($user->lang['NOTIFY_REPLY'])) ? $user->lang['NOTIFY_REPLY'] : '{ NOTIFY_REPLY }')); ?></label></div>
				<?php } if ($this->_rootref['S_LOCK_TOPIC_ALLOWED']) {  ?>

					<div><label for="lock_topic"><input type="checkbox" name="lock_topic" id="lock_topic"<?php echo (isset($this->_rootref['S_LOCK_TOPIC_CHECKED'])) ? $this->_rootref['S_LOCK_TOPIC_CHECKED'] : ''; ?> /> <?php echo ((isset($this->_rootref['L_LOCK_TOPIC'])) ? $this->_rootref['L_LOCK_TOPIC'] : ((isset($user->lang['LOCK_TOPIC'])) ? $user->lang['LOCK_TOPIC'] : '{ LOCK_TOPIC }')); ?></label></div>
				<?php } if ($this->_rootref['S_LOCK_POST_ALLOWED']) {  ?>

					<div><label for="lock_post"><input type="checkbox" name="lock_post" id="lock_post"<?php echo (isset($this->_rootref['S_LOCK_POST_CHECKED'])) ? $this->_rootref['S_LOCK_POST_CHECKED'] : ''; ?> /> <?php echo ((isset($this->_rootref['L_LOCK_POST'])) ? $this->_rootref['L_LOCK_POST'] : ((isset($user->lang['LOCK_POST'])) ? $user->lang['LOCK_POST'] : '{ LOCK_POST }')); ?> [<?php echo ((isset($this->_rootref['L_LOCK_POST_EXPLAIN'])) ? $this->_rootref['L_LOCK_POST_EXPLAIN'] : ((isset($user->lang['LOCK_POST_EXPLAIN'])) ? $user->lang['LOCK_POST_EXPLAIN'] : '{ LOCK_POST_EXPLAIN }')); ?>]</label></div>
				<?php } if ($this->_rootref['S_TYPE_TOGGLE'] || $this->_rootref['S_TOPIC_TYPE_ANNOUNCE'] || $this->_rootref['S_TOPIC_TYPE_STICKY']) {  ?>

				<hr class="dashed" />
				<?php } ?>

			</fieldset>
			<?php } ?>


		</div>

	</div>

	<?php if ($this->_rootref['S_SHOW_ATTACH_BOX']) {  $this->_tpl_include('posting_attach_body.html'); } ?>

	<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

</form>

<?php if ($this->_rootref['EXTRA_OPTIONS_DISPLAY'] == ('show')) {  ?>

<script type="text/javascript">
// <![CDATA[
	subPanels(show_panel);
// ]]>
</script>
<?php } ?>