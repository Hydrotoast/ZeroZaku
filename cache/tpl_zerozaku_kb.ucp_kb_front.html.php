<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('ucp_header.html'); ?>


<h2><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></h2>

<div class="panel">
	<div class="inner"><span class="corners-top"><span></span></span>

	<p><?php echo ((isset($this->_rootref['L_UCP_KB_WELCOME'])) ? $this->_rootref['L_UCP_KB_WELCOME'] : ((isset($user->lang['UCP_KB_WELCOME'])) ? $user->lang['UCP_KB_WELCOME'] : '{ UCP_KB_WELCOME }')); ?></p>

	<h3 class="sub"><?php echo ((isset($this->_rootref['L_YOUR_KB_DETAILS'])) ? $this->_rootref['L_YOUR_KB_DETAILS'] : ((isset($user->lang['YOUR_KB_DETAILS'])) ? $user->lang['YOUR_KB_DETAILS'] : '{ YOUR_KB_DETAILS }')); ?></h3>

	<dl class="details">
		<dt><?php echo ((isset($this->_rootref['L_APPROVED_ARTICLES'])) ? $this->_rootref['L_APPROVED_ARTICLES'] : ((isset($user->lang['APPROVED_ARTICLES'])) ? $user->lang['APPROVED_ARTICLES'] : '{ APPROVED_ARTICLES }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['ARTICLES'])) ? $this->_rootref['ARTICLES'] : ''; ?> | <strong><a href="<?php echo (isset($this->_rootref['U_SEARCH_ARTICLES'])) ? $this->_rootref['U_SEARCH_ARTICLES'] : ''; ?>"><?php echo ((isset($this->_rootref['L_SEARCH_ARTICLES'])) ? $this->_rootref['L_SEARCH_ARTICLES'] : ((isset($user->lang['SEARCH_ARTICLES'])) ? $user->lang['SEARCH_ARTICLES'] : '{ SEARCH_ARTICLES }')); ?></a></strong></dd>
		<dt><?php echo ((isset($this->_rootref['L_WAITING_ARTICLES'])) ? $this->_rootref['L_WAITING_ARTICLES'] : ((isset($user->lang['WAITING_ARTICLES'])) ? $user->lang['WAITING_ARTICLES'] : '{ WAITING_ARTICLES }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['WAITING_ARTICLES'])) ? $this->_rootref['WAITING_ARTICLES'] : ''; ?> | <strong><a href="<?php echo (isset($this->_rootref['U_UCP_ARTICLES'])) ? $this->_rootref['U_UCP_ARTICLES'] : ''; ?>"><?php echo ((isset($this->_rootref['L_ARTICLE_STATUS_PAGE'])) ? $this->_rootref['L_ARTICLE_STATUS_PAGE'] : ((isset($user->lang['ARTICLE_STATUS_PAGE'])) ? $user->lang['ARTICLE_STATUS_PAGE'] : '{ ARTICLE_STATUS_PAGE }')); ?></a></strong></dd>
		<dt><?php echo ((isset($this->_rootref['L_COMMENTS'])) ? $this->_rootref['L_COMMENTS'] : ((isset($user->lang['COMMENTS'])) ? $user->lang['COMMENTS'] : '{ COMMENTS }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['COMMENTS'])) ? $this->_rootref['COMMENTS'] : ''; ?></dd>
		<dt><?php echo ((isset($this->_rootref['L_WAITING_MOD_COMMENTS'])) ? $this->_rootref['L_WAITING_MOD_COMMENTS'] : ((isset($user->lang['WAITING_MOD_COMMENTS'])) ? $user->lang['WAITING_MOD_COMMENTS'] : '{ WAITING_MOD_COMMENTS }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['MOD_COMMENTS'])) ? $this->_rootref['MOD_COMMENTS'] : ''; ?></dd>
	</dl>
	<span class="corners-bottom"><span></span></span></div>
</div>

<?php $this->_tpl_include('ucp_footer.html'); ?>