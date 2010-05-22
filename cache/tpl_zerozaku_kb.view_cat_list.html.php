<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('kb/kb_header.html'); if (sizeof($this->_tpldata['catrow'])) {  if ($this->_rootref['S_CAT_STYLE']) {  $this->_tpl_include('kb/cat_list_modern.html'); } else { $this->_tpl_include('kb/cat_list_classic.html'); } } else if ($this->_rootref['S_ON_INDEX']) {  ?>

			<div class="panel">
				<div class="inner">
				<strong><?php echo ((isset($this->_rootref['L_NO_CATS'])) ? $this->_rootref['L_NO_CATS'] : ((isset($user->lang['NO_CATS'])) ? $user->lang['NO_CATS'] : '{ NO_CATS }')); ?></strong>
				</div>
			</div>
			<?php } if (sizeof($this->_tpldata['articlerow'])) {  ?>

			<div class="topic-actions">
				<?php if ($this->_rootref['U_ADD_NEW_ARTICLE']) {  ?>

				<div class="buttons">
					<div class="article-icon"><a href="<?php echo (isset($this->_rootref['U_ADD_NEW_ARTICLE'])) ? $this->_rootref['U_ADD_NEW_ARTICLE'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_KB_ADD_ARTICLE'])) ? $this->_rootref['L_KB_ADD_ARTICLE'] : ((isset($user->lang['KB_ADD_ARTICLE'])) ? $user->lang['KB_ADD_ARTICLE'] : '{ KB_ADD_ARTICLE }')); ?>"><span></span><?php echo ((isset($this->_rootref['L_KB_ADD_ARTICLE'])) ? $this->_rootref['L_KB_ADD_ARTICLE'] : ((isset($user->lang['KB_ADD_ARTICLE'])) ? $user->lang['KB_ADD_ARTICLE'] : '{ KB_ADD_ARTICLE }')); ?></a></div>
				</div>
				<?php } ?>

				
				<div class="pagination">
					<?php echo (isset($this->_rootref['TOTAL_ARTICLES'])) ? $this->_rootref['TOTAL_ARTICLES'] : ''; ?> <?php echo ((isset($this->_rootref['L_ARTICLES_LC'])) ? $this->_rootref['L_ARTICLES_LC'] : ((isset($user->lang['ARTICLES_LC'])) ? $user->lang['ARTICLES_LC'] : '{ ARTICLES_LC }')); ?>

					<?php if ($this->_rootref['PAGE_NUMBER']) {  if ($this->_rootref['PAGINATION']) {  ?> &bull; <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { ?> &bull; <?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } } ?>

				</div>
			</div>
			
			<h2 class="cattitle"><span><?php echo ((isset($this->_rootref['L_CATEGORY_NAME'])) ? $this->_rootref['L_CATEGORY_NAME'] : ((isset($user->lang['CATEGORY_NAME'])) ? $user->lang['CATEGORY_NAME'] : '{ CATEGORY_NAME }')); ?></span></h2>
			<div class="forumbg">
				<div class="inner">
				<ul class="topiclist">
					<li class="header">
						<dl class="meta">
							<dt><?php echo ((isset($this->_rootref['L_ARTICLES'])) ? $this->_rootref['L_ARTICLES'] : ((isset($user->lang['ARTICLES'])) ? $user->lang['ARTICLES'] : '{ ARTICLES }')); ?></dt>
							<dd class="stats"><div class="inner"><?php echo ((isset($this->_rootref['L_STATS'])) ? $this->_rootref['L_STATS'] : ((isset($user->lang['STATS'])) ? $user->lang['STATS'] : '{ STATS }')); ?></div></dd>
							<dd class="lastpost"><div class="inner"><?php echo ((isset($this->_rootref['L_AUTHOR'])) ? $this->_rootref['L_AUTHOR'] : ((isset($user->lang['AUTHOR'])) ? $user->lang['AUTHOR'] : '{ AUTHOR }')); ?></div></dd>
						</dl>
					</li>
				</ul>
				<ul class="topiclist topics">
					<?php $_articlerow_count = (isset($this->_tpldata['articlerow'])) ? sizeof($this->_tpldata['articlerow']) : 0;if ($_articlerow_count) {for ($_articlerow_i = 0; $_articlerow_i < $_articlerow_count; ++$_articlerow_i){$_articlerow_val = &$this->_tpldata['articlerow'][$_articlerow_i]; ?>

					<li class="row<?php if (!($_articlerow_val['S_ROW_COUNT'] & 1)  ) {  ?> bg1<?php } else { ?> bg2<?php } ?>">
						<dl class="icon" style="background-image: url(<?php echo $_articlerow_val['ARTICLE_FOLDER_IMG_SRC']; ?>); background-repeat: no-repeat; background-position: 10px center;">
							<dt>
								<div class="inner">
									<?php if ($_articlerow_val['ARTICLE_TYPE_IMG']) {  ?><span class="forum-image"><img src="<?php echo $_articlerow_val['ARTICLE_TYPE_IMG']; ?>" width="<?php echo $_articlerow_val['ARTICLE_TYPE_IMG_WIDTH']; ?>" height="<?php echo $_articlerow_val['ARTICLE_TYPE_IMG_HEIGHT']; ?>" alt="" /></span><?php } ?><a href="<?php echo $_articlerow_val['U_VIEW_ARTICLE']; ?>" class="topictitle"><?php echo $_articlerow_val['ARTICLE_TITLE']; ?></a>
									<?php if ($_articlerow_val['ARTICLE_UNAPPROVED']) {  ?><a href="<?php echo $_articlerow_val['U_MCP_QUEUE']; ?>"><?php echo (isset($this->_rootref['UNAPPROVED_IMG'])) ? $this->_rootref['UNAPPROVED_IMG'] : ''; ?></a> <?php } ?>

									<br /><?php if ($_articlerow_val['ARTICLE_DESC']) {  echo $_articlerow_val['ARTICLE_DESC']; } ?>

								</div>
							</dt>
							<dd class="stats">
								<div class="inner">
									<dfn><?php echo $_articlerow_val['VIEWS']; ?> <?php echo ((isset($this->_rootref['L_VIEWS'])) ? $this->_rootref['L_VIEWS'] : ((isset($user->lang['VIEWS'])) ? $user->lang['VIEWS'] : '{ VIEWS }')); ?></dfn>
									<br /><dfn><?php echo $_articlerow_val['COMMENTS']; ?> <?php echo ((isset($this->_rootref['L_COMMENTS'])) ? $this->_rootref['L_COMMENTS'] : ((isset($user->lang['COMMENTS'])) ? $user->lang['COMMENTS'] : '{ COMMENTS }')); ?></dfn>
								</div>
							</dd>
							<dd class="lastpost">
									<div class="inner"><span><?php echo ((isset($this->_rootref['L_POST_BY_AUTHOR'])) ? $this->_rootref['L_POST_BY_AUTHOR'] : ((isset($user->lang['POST_BY_AUTHOR'])) ? $user->lang['POST_BY_AUTHOR'] : '{ POST_BY_AUTHOR }')); ?> <?php echo $_articlerow_val['ARTICLE_AUTHOR_FULL']; ?>

									<br /><span class="date"><?php if ($_articlerow_val['ATTACH_ICON_IMG']) {  echo $_articlerow_val['ATTACH_ICON_IMG']; ?> <?php } echo $_articlerow_val['FIRST_POST_TIME']; ?>	</span></div></span>
							</dd>
						</dl>
					</li>
					<?php }} ?>

				</ul>
				</div>
			</div>
			
			<form id="sort_cat" method="post" action="<?php echo (isset($this->_rootref['S_ARTICLE_ACTION'])) ? $this->_rootref['S_ARTICLE_ACTION'] : ''; ?>">
			<fieldset class="display-options" style="margin-top: 0; ">
				<?php if ($this->_rootref['PREVIOUS_PAGE']) {  ?><a href="<?php echo (isset($this->_rootref['PREVIOUS_PAGE'])) ? $this->_rootref['PREVIOUS_PAGE'] : ''; ?>" class="left-box <?php echo (isset($this->_rootref['S_CONTENT_FLOW_BEGIN'])) ? $this->_rootref['S_CONTENT_FLOW_BEGIN'] : ''; ?>"><?php echo ((isset($this->_rootref['L_PREVIOUS'])) ? $this->_rootref['L_PREVIOUS'] : ((isset($user->lang['PREVIOUS'])) ? $user->lang['PREVIOUS'] : '{ PREVIOUS }')); ?></a><?php } if ($this->_rootref['NEXT_PAGE']) {  ?><a href="<?php echo (isset($this->_rootref['NEXT_PAGE'])) ? $this->_rootref['NEXT_PAGE'] : ''; ?>" class="right-box <?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>"><?php echo ((isset($this->_rootref['L_NEXT'])) ? $this->_rootref['L_NEXT'] : ((isset($user->lang['NEXT'])) ? $user->lang['NEXT'] : '{ NEXT }')); ?></a><?php } if (! $this->_rootref['S_IS_BOT']) {  ?>

				<label><?php echo ((isset($this->_rootref['L_KB_SORT_BY'])) ? $this->_rootref['L_KB_SORT_BY'] : ((isset($user->lang['KB_SORT_BY'])) ? $user->lang['KB_SORT_BY'] : '{ KB_SORT_BY }')); ?> <?php echo (isset($this->_rootref['S_SORT_OPTIONS'])) ? $this->_rootref['S_SORT_OPTIONS'] : ''; ?></label> <label><?php echo (isset($this->_rootref['S_SORT_DIRECTION'])) ? $this->_rootref['S_SORT_DIRECTION'] : ''; ?> <input type="submit" name="gosort" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" class="button2" /></label>
				<?php } ?>

			</fieldset>
		
			</form>
			<hr />
			<div class="topic-actions">
				<?php if ($this->_rootref['U_ADD_NEW_ARTICLE']) {  ?>

				<div class="buttons">
					<div class="article-icon"><a href="<?php echo (isset($this->_rootref['U_ADD_NEW_ARTICLE'])) ? $this->_rootref['U_ADD_NEW_ARTICLE'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_KB_ADD_ARTICLE'])) ? $this->_rootref['L_KB_ADD_ARTICLE'] : ((isset($user->lang['KB_ADD_ARTICLE'])) ? $user->lang['KB_ADD_ARTICLE'] : '{ KB_ADD_ARTICLE }')); ?>"><span></span><?php echo ((isset($this->_rootref['L_KB_ADD_ARTICLE'])) ? $this->_rootref['L_KB_ADD_ARTICLE'] : ((isset($user->lang['KB_ADD_ARTICLE'])) ? $user->lang['KB_ADD_ARTICLE'] : '{ KB_ADD_ARTICLE }')); ?></a></div>
				</div>
				<?php } ?>

				
				<div class="pagination">
					<?php echo (isset($this->_rootref['TOTAL_ARTICLES'])) ? $this->_rootref['TOTAL_ARTICLES'] : ''; ?> <?php echo ((isset($this->_rootref['L_ARTICLES_LC'])) ? $this->_rootref['L_ARTICLES_LC'] : ((isset($user->lang['ARTICLES_LC'])) ? $user->lang['ARTICLES_LC'] : '{ ARTICLES_LC }')); ?>

					<?php if ($this->_rootref['PAGE_NUMBER']) {  if ($this->_rootref['PAGINATION']) {  ?> &bull; <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { ?> &bull; <?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } } ?>

				</div>
			</div>
			<?php } else { if (! $this->_rootref['S_NO_TOPIC']) {  ?>

			<table width="100%">
				<tr>
					<td style="vertical-align: top;">
						<div class="topic-actions">
							<?php if ($this->_rootref['U_ADD_NEW_ARTICLE']) {  ?>

							<div class="buttons">
								<div class="article-icon"><a href="<?php echo (isset($this->_rootref['U_ADD_NEW_ARTICLE'])) ? $this->_rootref['U_ADD_NEW_ARTICLE'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_KB_ADD_ARTICLE'])) ? $this->_rootref['L_KB_ADD_ARTICLE'] : ((isset($user->lang['KB_ADD_ARTICLE'])) ? $user->lang['KB_ADD_ARTICLE'] : '{ KB_ADD_ARTICLE }')); ?>" class="button1"><span></span><?php echo ((isset($this->_rootref['L_KB_ADD_ARTICLE'])) ? $this->_rootref['L_KB_ADD_ARTICLE'] : ((isset($user->lang['KB_ADD_ARTICLE'])) ? $user->lang['KB_ADD_ARTICLE'] : '{ KB_ADD_ARTICLE }')); ?></a></div>
							</div>
							<?php } ?>

							
							<div class="pagination">
								<?php echo (isset($this->_rootref['TOTAL_ARTICLES'])) ? $this->_rootref['TOTAL_ARTICLES'] : ''; ?> <?php echo ((isset($this->_rootref['L_ARTICLES_LC'])) ? $this->_rootref['L_ARTICLES_LC'] : ((isset($user->lang['ARTICLES_LC'])) ? $user->lang['ARTICLES_LC'] : '{ ARTICLES_LC }')); ?>

								<?php if ($this->_rootref['PAGE_NUMBER']) {  if ($this->_rootref['PAGINATION']) {  ?> &bull; <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { ?> &bull; <?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } } ?>

							</div>
						</div>
						
						<div class="panel">
							<div class="inner">
							<strong><?php echo ((isset($this->_rootref['L_NO_ARTICLES'])) ? $this->_rootref['L_NO_ARTICLES'] : ((isset($user->lang['NO_ARTICLES'])) ? $user->lang['NO_ARTICLES'] : '{ NO_ARTICLES }')); ?></strong>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<?php } } $this->_tpl_include('kb/kb_footer.html'); ?>