<?php if (!defined('IN_PHPBB')) exit; ?><div class="forabg">
	<div class="inner">
	<ul class="topiclist">
		<li class="header">
			<dl class="icon">
				<dt><?php echo ((isset($this->_rootref['L_KB_CATS'])) ? $this->_rootref['L_KB_CATS'] : ((isset($user->lang['KB_CATS'])) ? $user->lang['KB_CATS'] : '{ KB_CATS }')); ?></dt>
				<dd class="topics"><?php echo ((isset($this->_rootref['L_KB_FEED_CAT'])) ? $this->_rootref['L_KB_FEED_CAT'] : ((isset($user->lang['KB_FEED_CAT'])) ? $user->lang['KB_FEED_CAT'] : '{ KB_FEED_CAT }')); ?></dd>
				<dd class="posts"><?php echo ((isset($this->_rootref['L_ARTICLES'])) ? $this->_rootref['L_ARTICLES'] : ((isset($user->lang['ARTICLES'])) ? $user->lang['ARTICLES'] : '{ ARTICLES }')); ?></dd>
				<dd class="lastpost"><span><?php echo ((isset($this->_rootref['L_LATEST_ARTICLES'])) ? $this->_rootref['L_LATEST_ARTICLES'] : ((isset($user->lang['LATEST_ARTICLES'])) ? $user->lang['LATEST_ARTICLES'] : '{ LATEST_ARTICLES }')); ?></span></dd>
			</dl>
		</li>
	</ul>
	<ul class="topiclist forums">
	
	<?php $_catrow_count = (isset($this->_tpldata['catrow'])) ? sizeof($this->_tpldata['catrow']) : 0;if ($_catrow_count) {for ($_catrow_i = 0; $_catrow_i < $_catrow_count; ++$_catrow_i){$_catrow_val = &$this->_tpldata['catrow'][$_catrow_i]; $_cat_count = (isset($_catrow_val['cat'])) ? sizeof($_catrow_val['cat']) : 0;if ($_cat_count) {for ($_cat_i = 0; $_cat_i < $_cat_count; ++$_cat_i){$_cat_val = &$_catrow_val['cat'][$_cat_i]; ?>

	<li class="row">
		<dl class="icon" style="background-image: url(<?php echo $_cat_val['CAT_FOLDER_IMG_SRC']; ?>); background-repeat: no-repeat;">
			<dt title="<?php echo $_cat_val['CAT_FOLDER_IMG_ALT']; ?>">
				<div class="inner">
					<?php if ($_cat_val['CAT_IMAGE']) {  ?><span class="forum-image"><?php echo $_cat_val['CAT_IMAGE']; ?></span><?php } ?>

					<a href="<?php echo $_cat_val['U_VIEWCAT']; ?>"><?php echo $_cat_val['CAT_NAME']; ?></a>
					<?php if ($_cat_val['CAT_DESC']) {  ?><br /><?php echo $_cat_val['CAT_DESC']; } if ($_cat_val['SUBCATS']) {  ?><br /><strong><?php echo $_cat_val['L_SUBCAT']; ?>:</strong> <?php echo $_cat_val['SUBCATS']; } ?>

				</div>
			</dt>
			<dd class="topics"><a href="<?php echo $_cat_val['U_RSS_CAT']; ?>"><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/feed.gif" width="14" height="14" alt="<?php echo ((isset($this->_rootref['L_RSS_CAT'])) ? $this->_rootref['L_RSS_CAT'] : ((isset($user->lang['RSS_CAT'])) ? $user->lang['RSS_CAT'] : '{ RSS_CAT }')); ?>" title="<?php echo ((isset($this->_rootref['L_RSS_CAT'])) ? $this->_rootref['L_RSS_CAT'] : ((isset($user->lang['RSS_CAT'])) ? $user->lang['RSS_CAT'] : '{ RSS_CAT }')); ?>" /></a> <dfn><?php echo ((isset($this->_rootref['L_KB_FEED_CAT'])) ? $this->_rootref['L_KB_FEED_CAT'] : ((isset($user->lang['KB_FEED_CAT'])) ? $user->lang['KB_FEED_CAT'] : '{ KB_FEED_CAT }')); ?></dfn></dd>
			<dd class="posts"><?php echo $_cat_val['ARTICLES']; ?> <dfn><?php echo ((isset($this->_rootref['L_ARTICLES'])) ? $this->_rootref['L_ARTICLES'] : ((isset($user->lang['ARTICLES'])) ? $user->lang['ARTICLES'] : '{ ARTICLES }')); ?></dfn></dd>
			<dd class="lastpost"><span>
				<?php if ($_cat_val['LATEST_ARTICLE']) {  ?><strong><?php echo ((isset($this->_rootref['L_LATEST_ARTICLES'])) ? $this->_rootref['L_LATEST_ARTICLES'] : ((isset($user->lang['LATEST_ARTICLES'])) ? $user->lang['LATEST_ARTICLES'] : '{ LATEST_ARTICLES }')); ?>:</strong> <?php echo $_cat_val['LATEST_ARTICLE']; } else { echo ((isset($this->_rootref['L_KB_NO_LATEST'])) ? $this->_rootref['L_KB_NO_LATEST'] : ((isset($user->lang['KB_NO_LATEST'])) ? $user->lang['KB_NO_LATEST'] : '{ KB_NO_LATEST }')); } ?></span>
			</dd>
		</dl>
	</li>
	<?php }} }} ?>

	</ul>
	</div>
</div>