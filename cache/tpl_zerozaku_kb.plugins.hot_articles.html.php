<?php if (!defined('IN_PHPBB')) exit; if (sizeof($this->_tpldata['hotrow'])) {  ?>

<div class="panel smooth">
	<div class="inner">
		<div class="left_menu_title"><?php echo ((isset($this->_rootref['L_MOST_VIEWED_ARTICLES'])) ? $this->_rootref['L_MOST_VIEWED_ARTICLES'] : ((isset($user->lang['MOST_VIEWED_ARTICLES'])) ? $user->lang['MOST_VIEWED_ARTICLES'] : '{ MOST_VIEWED_ARTICLES }')); ?></div>
		<div style="padding-bottom: 3px;">
			<div>
			<?php $_hotrow_count = (isset($this->_tpldata['hotrow'])) ? sizeof($this->_tpldata['hotrow']) : 0;if ($_hotrow_count) {for ($_hotrow_i = 0; $_hotrow_i < $_hotrow_count; ++$_hotrow_i){$_hotrow_val = &$this->_tpldata['hotrow'][$_hotrow_i]; ?>

				<a href="<?php echo $_hotrow_val['U_VIEW_ARTICLE']; ?>"><?php echo $_hotrow_val['ARTICLE_TITLE']; ?> [<?php echo $_hotrow_val['ARTICLE_VIEWS']; ?>]</a><br />
			<?php }} ?>	
			</div>
		</div>
	</div>
</div>
<?php } ?>