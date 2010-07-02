<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('mcp_header.html'); ?>


<h2><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></h2>
<div class="panel">
	<div class="inner"><span class="corners-top"><span></span></span>

	<p><?php echo ((isset($this->_rootref['L_KB_ARTICLES_EXPLAIN'])) ? $this->_rootref['L_KB_ARTICLES_EXPLAIN'] : ((isset($user->lang['KB_ARTICLES_EXPLAIN'])) ? $user->lang['KB_ARTICLES_EXPLAIN'] : '{ KB_ARTICLES_EXPLAIN }')); ?></p>
	
	<?php if (sizeof($this->_tpldata['articlerow'])) {  ?>

		<ul class="topiclist">
			<li class="header">
				<dl class="icon">
					<dt><?php echo ((isset($this->_rootref['L_APPROVED_ARTICLES'])) ? $this->_rootref['L_APPROVED_ARTICLES'] : ((isset($user->lang['APPROVED_ARTICLES'])) ? $user->lang['APPROVED_ARTICLES'] : '{ APPROVED_ARTICLES }')); ?></dt>
					<dd class="lastpost"><?php echo ((isset($this->_rootref['L_AUTHOR'])) ? $this->_rootref['L_AUTHOR'] : ((isset($user->lang['AUTHOR'])) ? $user->lang['AUTHOR'] : '{ AUTHOR }')); ?></dd>
					<dd class="mark"><?php echo ((isset($this->_rootref['L_OPTIONS'])) ? $this->_rootref['L_OPTIONS'] : ((isset($user->lang['OPTIONS'])) ? $user->lang['OPTIONS'] : '{ OPTIONS }')); ?></dd>
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
					<dd class="mark"><a href="<?php echo $_articlerow_val['U_STATUS']; ?>" title="<?php echo ((isset($this->_rootref['L_ALTER_STATUS'])) ? $this->_rootref['L_ALTER_STATUS'] : ((isset($user->lang['ALTER_STATUS'])) ? $user->lang['ALTER_STATUS'] : '{ ALTER_STATUS }')); ?>"><?php echo ((isset($this->_rootref['L_ALTER_STATUS'])) ? $this->_rootref['L_ALTER_STATUS'] : ((isset($user->lang['ALTER_STATUS'])) ? $user->lang['ALTER_STATUS'] : '{ ALTER_STATUS }')); ?></a></dd>
				</dl>
			</li>
		<?php }} ?>

		</ul>
	<?php } else { ?>

		<p><strong><?php echo ((isset($this->_rootref['L_NO_APPROVED_ARTICLES'])) ? $this->_rootref['L_NO_APPROVED_ARTICLES'] : ((isset($user->lang['NO_APPROVED_ARTICLES'])) ? $user->lang['NO_APPROVED_ARTICLES'] : '{ NO_APPROVED_ARTICLES }')); ?></strong></p>
	<?php } ?>

	
<span class="corners-bottom"><span></span></span></div>
</div>

<?php $this->_tpl_include('mcp_footer.html'); ?>