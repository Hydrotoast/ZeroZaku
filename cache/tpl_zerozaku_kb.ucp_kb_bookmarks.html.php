<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('ucp_header.html'); ?>


<form id="ucp" method="post" action="<?php echo (isset($this->_rootref['S_UCP_ACTION'])) ? $this->_rootref['S_UCP_ACTION'] : ''; ?>"<?php echo (isset($this->_rootref['S_FORM_ENCTYPE'])) ? $this->_rootref['S_FORM_ENCTYPE'] : ''; ?>>

<h2><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></h2>
<div class="panel">
	<div class="inner"><span class="corners-top"><span></span></span>

	<p><?php echo ((isset($this->_rootref['L_KB_BOOKMARKS_EXPLAIN'])) ? $this->_rootref['L_KB_BOOKMARKS_EXPLAIN'] : ((isset($user->lang['KB_BOOKMARKS_EXPLAIN'])) ? $user->lang['KB_BOOKMARKS_EXPLAIN'] : '{ KB_BOOKMARKS_EXPLAIN }')); ?></p>
	
	<?php if (sizeof($this->_tpldata['articlerow'])) {  ?>

		<ul class="topiclist">
			<li class="header">
				<dl class="icon">
					<dt><?php echo ((isset($this->_rootref['L_BOOKMARKED_ARTICLES'])) ? $this->_rootref['L_BOOKMARKED_ARTICLES'] : ((isset($user->lang['BOOKMARKED_ARTICLES'])) ? $user->lang['BOOKMARKED_ARTICLES'] : '{ BOOKMARKED_ARTICLES }')); ?></dt>
					<dd class="lastpost"><?php echo ((isset($this->_rootref['L_AUTHOR'])) ? $this->_rootref['L_AUTHOR'] : ((isset($user->lang['AUTHOR'])) ? $user->lang['AUTHOR'] : '{ AUTHOR }')); ?></dd>
					<dd class="mark"><?php echo ((isset($this->_rootref['L_MARK'])) ? $this->_rootref['L_MARK'] : ((isset($user->lang['MARK'])) ? $user->lang['MARK'] : '{ MARK }')); ?></dd>
				</dl>
			</li>
		</ul>
		<ul class="topiclist cplist">
	
		<?php $_articlerow_count = (isset($this->_tpldata['articlerow'])) ? sizeof($this->_tpldata['articlerow']) : 0;if ($_articlerow_count) {for ($_articlerow_i = 0; $_articlerow_i < $_articlerow_count; ++$_articlerow_i){$_articlerow_val = &$this->_tpldata['articlerow'][$_articlerow_i]; ?>

			<li class="row<?php if (!($_articlerow_val['S_ROW_COUNT'] & 1)  ) {  ?> bg1<?php } else { ?> bg2<?php } ?>">
				<dl class="icon" style="background-image: url(<?php echo $_articlerow_val['ARTICLE_FOLDER_IMG_SRC']; ?>); background-repeat: no-repeat;">
					<dt><?php if ($_articlerow_val['ARTICLE_TYPE_IMG']) {  ?><img src="<?php echo $_articlerow_val['ARTICLE_TYPE_IMG']; ?>" width="<?php echo $_articlerow_val['ARTICLE_TYPE_IMG_WIDTH']; ?>" height="<?php echo $_articlerow_val['ARTICLE_TYPE_IMG_HEIGHT']; ?>" alt="" /><?php } ?><a href="<?php echo $_articlerow_val['U_VIEW_ARTICLE']; ?>" class="topictitle"><?php echo $_articlerow_val['ARTICLE_TITLE']; ?></a>
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

		<p><strong><?php echo ((isset($this->_rootref['L_NO_BOOKMARKED_ARTICLES'])) ? $this->_rootref['L_NO_BOOKMARKED_ARTICLES'] : ((isset($user->lang['NO_BOOKMARKED_ARTICLES'])) ? $user->lang['NO_BOOKMARKED_ARTICLES'] : '{ NO_BOOKMARKED_ARTICLES }')); ?></strong></p>
	<?php } ?>

	
<span class="corners-bottom"><span></span></span></div>
</div>

<fieldset class="display-actions">
	<input type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_UNBOOKMARK_MARKED'])) ? $this->_rootref['L_UNBOOKMARK_MARKED'] : ((isset($user->lang['UNBOOKMARK_MARKED'])) ? $user->lang['UNBOOKMARK_MARKED'] : '{ UNBOOKMARK_MARKED }')); ?>" class="button2" />
	<div><a href="#" onclick="marklist('ucp', 'a', true); return false;"><?php echo ((isset($this->_rootref['L_MARK_ALL'])) ? $this->_rootref['L_MARK_ALL'] : ((isset($user->lang['MARK_ALL'])) ? $user->lang['MARK_ALL'] : '{ MARK_ALL }')); ?></a> &bull; <a href="#" onclick="marklist('ucp', 'a', false); return false;"><?php echo ((isset($this->_rootref['L_UNMARK_ALL'])) ? $this->_rootref['L_UNMARK_ALL'] : ((isset($user->lang['UNMARK_ALL'])) ? $user->lang['UNMARK_ALL'] : '{ UNMARK_ALL }')); ?></a></div>
	<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?>

</fieldset>
</form>

<?php $this->_tpl_include('ucp_footer.html'); ?>