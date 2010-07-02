<?php if (!defined('IN_PHPBB')) exit; ?><div class="panel smooth bg2">
<div class="inner">
		<table style="width: 100%;">
			<?php $_catrow_count = (isset($this->_tpldata['catrow'])) ? sizeof($this->_tpldata['catrow']) : 0;if ($_catrow_count) {for ($_catrow_i = 0; $_catrow_i < $_catrow_count; ++$_catrow_i){$_catrow_val = &$this->_tpldata['catrow'][$_catrow_i]; ?>

			<tr>
				<?php $_cat_count = (isset($_catrow_val['cat'])) ? sizeof($_catrow_val['cat']) : 0;if ($_cat_count) {for ($_cat_i = 0; $_cat_i < $_cat_count; ++$_cat_i){$_cat_val = &$_catrow_val['cat'][$_cat_i]; ?>

				<td style="vertical-align: top; width: <?php echo (isset($this->_rootref['S_COL_WIDTH'])) ? $this->_rootref['S_COL_WIDTH'] : ''; ?>%;">
					<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr>
							<td><h3 class="kb_cat"><?php echo $_cat_val['CAT_IMAGE']; ?> <a href="<?php echo $_cat_val['U_VIEWCAT']; ?>"><?php echo $_cat_val['CAT_NAME']; ?> (<?php echo $_cat_val['ARTICLES']; ?>)</a> <a href="<?php echo $_cat_val['U_RSS_CAT']; ?>"><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/feed.gif" width="14" height="14" alt="<?php echo ((isset($this->_rootref['L_RSS_CAT'])) ? $this->_rootref['L_RSS_CAT'] : ((isset($user->lang['RSS_CAT'])) ? $user->lang['RSS_CAT'] : '{ RSS_CAT }')); ?>" title="<?php echo ((isset($this->_rootref['L_RSS_CAT'])) ? $this->_rootref['L_RSS_CAT'] : ((isset($user->lang['RSS_CAT'])) ? $user->lang['RSS_CAT'] : '{ RSS_CAT }')); ?>" /></a></h3></td>
						</tr>
						
						<tr>
							<td>
								<div class="kb_cat_desc">
									<?php if ($_cat_val['CAT_DESC']) {  ?><span class="genmed"><?php echo $_cat_val['CAT_DESC']; ?></span><?php } if ($_cat_val['SUBCATS']) {  if ($_cat_val['LATEST_ARTICLE']) {  ?><br /><?php } ?><div class="kb_subcats"><strong ><?php echo $_cat_val['L_SUBCAT']; ?>:</strong> <?php echo $_cat_val['SUBCATS']; ?></div><?php } ?>

								</div>
								<div class="kb_latest_articles">
									<?php if ($_cat_val['LATEST_ARTICLE']) {  ?><strong><?php echo ((isset($this->_rootref['L_LATEST_ARTICLES'])) ? $this->_rootref['L_LATEST_ARTICLES'] : ((isset($user->lang['LATEST_ARTICLES'])) ? $user->lang['LATEST_ARTICLES'] : '{ LATEST_ARTICLES }')); ?>:</strong> <?php echo $_cat_val['LATEST_ARTICLE']; } ?>

								</div>
							</td>
						</tr>
					</table>
				</td>
				<?php }} $_dummy_count = (isset($_catrow_val['dummy'])) ? sizeof($_catrow_val['dummy']) : 0;if ($_dummy_count) {for ($_dummy_i = 0; $_dummy_i < $_dummy_count; ++$_dummy_i){$_dummy_val = &$_catrow_val['dummy'][$_dummy_i]; ?> 
				<td style="vertical-align: top; width: <?php echo (isset($this->_rootref['S_COL_WIDTH'])) ? $this->_rootref['S_COL_WIDTH'] : ''; ?>%;">&nbsp;</td> 
				<?php }} ?>

			</tr>	
			<?php }} ?>

		</table>
</div>
</div>