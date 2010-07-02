<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('ucp_header.html'); ?>


<form id="ucp" method="post" action="<?php echo (isset($this->_rootref['S_UCP_ACTION'])) ? $this->_rootref['S_UCP_ACTION'] : ''; ?>"<?php echo (isset($this->_rootref['S_FORM_ENCTYPE'])) ? $this->_rootref['S_FORM_ENCTYPE'] : ''; ?>>

<h2><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></h2>
<div class="panel">
	<div class="inner"><span class="corners-top"><span></span></span>

	<p><?php echo ((isset($this->_rootref['L_KB_SUBSCRIBE_EXPLAIN'])) ? $this->_rootref['L_KB_SUBSCRIBE_EXPLAIN'] : ((isset($user->lang['KB_SUBSCRIBE_EXPLAIN'])) ? $user->lang['KB_SUBSCRIBE_EXPLAIN'] : '{ KB_SUBSCRIBE_EXPLAIN }')); if ($this->_rootref['L_STATUS_STRING']) {  ?><br /><b><?php echo ((isset($this->_rootref['L_STATUS_STRING'])) ? $this->_rootref['L_STATUS_STRING'] : ((isset($user->lang['STATUS_STRING'])) ? $user->lang['STATUS_STRING'] : '{ STATUS_STRING }')); ?></b><?php } ?></p>
	
	<?php if ($this->_rootref['S_SHOW_FORM']) {  ?>

	<fieldset class="fields1">
		<dl>
			<dt><label for="notify_on"><?php echo ((isset($this->_rootref['L_NOTIFY_ON'])) ? $this->_rootref['L_NOTIFY_ON'] : ((isset($user->lang['NOTIFY_ON'])) ? $user->lang['NOTIFY_ON'] : '{ NOTIFY_ON }')); ?>:</label></dt>
			<dd><select name="notify_on" id="notify_on" class="inputbox"><?php echo (isset($this->_rootref['NOTIFY_ON_OPTIONS'])) ? $this->_rootref['NOTIFY_ON_OPTIONS'] : ''; ?></select></dd>
		</dl>
		<dl>
			<dt><label for="notify_by"><?php echo ((isset($this->_rootref['L_NOTIFY_BY'])) ? $this->_rootref['L_NOTIFY_BY'] : ((isset($user->lang['NOTIFY_BY'])) ? $user->lang['NOTIFY_BY'] : '{ NOTIFY_BY }')); ?>:</label></dt>
			<dd><select name="notify_by" id="notify_by" class="inputbox"><?php echo (isset($this->_rootref['NOTIFY_BY_OPTIONS'])) ? $this->_rootref['NOTIFY_BY_OPTIONS'] : ''; ?></select></dd>
		</dl>
	</fieldset>
	<?php } else { if (sizeof($this->_tpldata['articlerow'])) {  ?>

			<ul class="topiclist">
				<li class="header">
					<dl class="icon">
						<dt><?php echo ((isset($this->_rootref['L_SUBSCRIBED_ARTICLES'])) ? $this->_rootref['L_SUBSCRIBED_ARTICLES'] : ((isset($user->lang['SUBSCRIBED_ARTICLES'])) ? $user->lang['SUBSCRIBED_ARTICLES'] : '{ SUBSCRIBED_ARTICLES }')); ?></dt>
						<dd class="lastpost"><?php echo ((isset($this->_rootref['L_AUTHOR'])) ? $this->_rootref['L_AUTHOR'] : ((isset($user->lang['AUTHOR'])) ? $user->lang['AUTHOR'] : '{ AUTHOR }')); ?></dd>
						<dd class="mark"><?php echo ((isset($this->_rootref['L_MARK'])) ? $this->_rootref['L_MARK'] : ((isset($user->lang['MARK'])) ? $user->lang['MARK'] : '{ MARK }')); ?></dd>
					</dl>
				</li>
			</ul>
			<ul class="topiclist cplist">
		
			<?php $_articlerow_count = (isset($this->_tpldata['articlerow'])) ? sizeof($this->_tpldata['articlerow']) : 0;if ($_articlerow_count) {for ($_articlerow_i = 0; $_articlerow_i < $_articlerow_count; ++$_articlerow_i){$_articlerow_val = &$this->_tpldata['articlerow'][$_articlerow_i]; ?>

				<li class="row<?php if (!($_articlerow_val['S_ROW_COUNT'] & 1)  ) {  ?> bg1<?php } else { ?> bg2<?php } ?>">
					<dl class="icon" style="background-image: url(<?php echo $_articlerow_val['ARTICLE_FOLDER_IMG_SRC']; ?>); background-repeat: no-repeat;">
						<dt><?php if ($_articlerow_val['ARTICLE_TYPE_IMG']) {  ?><img src="<?php echo $_articlerow_val['ARTICLE_TYPE_IMG']; ?>" width="articlerow.<?php echo (isset($this->_rootref['ARTICLE_TYPE_IMG_WIDTH'])) ? $this->_rootref['ARTICLE_TYPE_IMG_WIDTH'] : ''; ?>" height="<?php echo $_articlerow_val['ARTICLE_TYPE_IMG_HEIGHT']; ?>" alt="" /><?php } ?><a href="<?php echo $_articlerow_val['U_VIEW_ARTICLE']; ?>" class="topictitle"><?php echo $_articlerow_val['ARTICLE_TITLE']; ?></a>
							<?php if ($_articlerow_val['ARTICLE_LAST_EDIT']) {  ?><br /><?php echo $_articlerow_val['ARTICLE_LAST_EDIT']; } ?>

						</dt>
						<dd class="lastpost"><span><?php echo ((isset($this->_rootref['L_POST_BY_AUTHOR'])) ? $this->_rootref['L_POST_BY_AUTHOR'] : ((isset($user->lang['POST_BY_AUTHOR'])) ? $user->lang['POST_BY_AUTHOR'] : '{ POST_BY_AUTHOR }')); ?> <?php echo $_articlerow_val['ARTICLE_AUTHOR_FULL']; ?><br /><?php if ($_articlerow_val['ATTACH_ICON_IMG']) {  echo $_articlerow_val['ATTACH_ICON_IMG']; ?> <?php } echo $_articlerow_val['FIRST_POST_TIME']; ?>	</span>
						</dd>
						<dd class="mark"><input type="checkbox" name="a[<?php echo $_articlerow_val['ARTICLE_ID']; ?>]" id="a<?php echo $_articlerow_val['ARTICLE_ID']; ?>" /></dd>
					</dl>
				</li>
			<?php }} ?>

			</ul>
		<?php } else { ?>

			<p><strong><?php echo ((isset($this->_rootref['L_NO_SUBSCRIBED_ARTICLES'])) ? $this->_rootref['L_NO_SUBSCRIBED_ARTICLES'] : ((isset($user->lang['NO_SUBSCRIBED_ARTICLES'])) ? $user->lang['NO_SUBSCRIBED_ARTICLES'] : '{ NO_SUBSCRIBED_ARTICLES }')); ?></strong></p>
		<?php } } ?>

	
<span class="corners-bottom"><span></span></span></div>
</div>

<?php if ($this->_rootref['S_SHOW_FORM']) {  ?>

<div class="panel bg2">
	<div class="inner"><span class="corners-top"><span></span></span>
	<fieldset class="submit-buttons">
		<input type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" class="button1" />
		<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?>

	</fieldset>
	<span class="corners-bottom"><span></span></span></div>
</div>
<?php } else { ?>

<fieldset class="display-actions">
	<input type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_UNSUBSCRIBE_MARKED'])) ? $this->_rootref['L_UNSUBSCRIBE_MARKED'] : ((isset($user->lang['UNSUBSCRIBE_MARKED'])) ? $user->lang['UNSUBSCRIBE_MARKED'] : '{ UNSUBSCRIBE_MARKED }')); ?>" class="button2" />
	<div><a href="#" onclick="marklist('ucp', 'a', true); return false;"><?php echo ((isset($this->_rootref['L_MARK_ALL'])) ? $this->_rootref['L_MARK_ALL'] : ((isset($user->lang['MARK_ALL'])) ? $user->lang['MARK_ALL'] : '{ MARK_ALL }')); ?></a> &bull; <a href="#" onclick="marklist('ucp', 'a', false); return false;"><?php echo ((isset($this->_rootref['L_UNMARK_ALL'])) ? $this->_rootref['L_UNMARK_ALL'] : ((isset($user->lang['UNMARK_ALL'])) ? $user->lang['UNMARK_ALL'] : '{ UNMARK_ALL }')); ?></a></div>
	<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?>

</fieldset>
<?php } ?>

</form>

<?php $this->_tpl_include('ucp_footer.html'); ?>