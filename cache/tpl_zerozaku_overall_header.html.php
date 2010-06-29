<?php if (!defined('IN_PHPBB')) exit; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>" lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>" xml:lang="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>">
<head>

<meta http-equiv="content-type" content="text/html; charset=<?php echo (isset($this->_rootref['S_CONTENT_ENCODING'])) ? $this->_rootref['S_CONTENT_ENCODING'] : ''; ?>" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-language" content="<?php echo (isset($this->_rootref['S_USER_LANG'])) ? $this->_rootref['S_USER_LANG'] : ''; ?>" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="resource-type" content="document" />
<meta name="distribution" content="global" />
<meta name="copyright" content="2009, 2010 ZeroZaku" />
<meta name="keywords" content="<?php if ($this->_rootref['SCRIPT_NAME'] == ("viewforum")) {  echo (isset($this->_rootref['FORUM_SEO_KEY'])) ? $this->_rootref['FORUM_SEO_KEY'] : ''; } else { ?>gaiaonline, rally client, world of warcraft, anime, code geass, online games, abstract signatures<?php } ?>" />
<meta name="description" content="<?php if ($this->_rootref['SCRIPT_NAME'] == ("viewforum")) {  echo (isset($this->_rootref['FORUM_SEO_DESC'])) ? $this->_rootref['FORUM_SEO_DESC'] : ''; } else { ?>Community for hacking life and online games. We have programs, scripts, anime, and online games. Man, we're cool.<?php } ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<?php echo (isset($this->_rootref['META'])) ? $this->_rootref['META'] : ''; ?>

<title><?php if ($this->_rootref['S_IN_MCP']) {  echo ((isset($this->_rootref['L_MCP'])) ? $this->_rootref['L_MCP'] : ((isset($user->lang['MCP'])) ? $user->lang['MCP'] : '{ MCP }')); ?> &bull; <?php } else if ($this->_rootref['S_IN_UCP']) {  echo ((isset($this->_rootref['L_UCP'])) ? $this->_rootref['L_UCP'] : ((isset($user->lang['UCP'])) ? $user->lang['UCP'] : '{ UCP }')); ?> &bull; <?php } echo (isset($this->_rootref['PAGE_TITLE'])) ? $this->_rootref['PAGE_TITLE'] : ''; ?> - <?php echo (isset($this->_rootref['SITENAME'])) ? $this->_rootref['SITENAME'] : ''; ?></title>

<link rel="shortcut icon" href="favicon.ico" /> 
<link rel="icon" type="image/ico" href="favicon.ico" />

<?php if ($this->_rootref['S_ENABLE_FEEDS']) {  if ($this->_rootref['S_ENABLE_FEEDS_OVERALL']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo (isset($this->_rootref['SITENAME'])) ? $this->_rootref['SITENAME'] : ''; ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>" /><?php } if ($this->_rootref['S_ENABLE_FEEDS_NEWS']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_FEED_NEWS'])) ? $this->_rootref['L_FEED_NEWS'] : ((isset($user->lang['FEED_NEWS'])) ? $user->lang['FEED_NEWS'] : '{ FEED_NEWS }')); ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>?mode=news" /><?php } if ($this->_rootref['S_ENABLE_FEEDS_FORUMS']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_ALL_FORUMS'])) ? $this->_rootref['L_ALL_FORUMS'] : ((isset($user->lang['ALL_FORUMS'])) ? $user->lang['ALL_FORUMS'] : '{ ALL_FORUMS }')); ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>?mode=forums" /><?php } if ($this->_rootref['S_ENABLE_FEEDS_TOPICS']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_FEED_TOPICS_NEW'])) ? $this->_rootref['L_FEED_TOPICS_NEW'] : ((isset($user->lang['FEED_TOPICS_NEW'])) ? $user->lang['FEED_TOPICS_NEW'] : '{ FEED_TOPICS_NEW }')); ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>?mode=topics" /><?php } if ($this->_rootref['S_ENABLE_FEEDS_TOPICS_ACTIVE']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_FEED_TOPICS_ACTIVE'])) ? $this->_rootref['L_FEED_TOPICS_ACTIVE'] : ((isset($user->lang['FEED_TOPICS_ACTIVE'])) ? $user->lang['FEED_TOPICS_ACTIVE'] : '{ FEED_TOPICS_ACTIVE }')); ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>?mode=topics_active" /><?php } if ($this->_rootref['S_ENABLE_FEEDS_FORUM'] && $this->_rootref['S_FORUM_ID']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_FORUM'])) ? $this->_rootref['L_FORUM'] : ((isset($user->lang['FORUM'])) ? $user->lang['FORUM'] : '{ FORUM }')); ?> - <?php echo (isset($this->_rootref['FORUM_NAME'])) ? $this->_rootref['FORUM_NAME'] : ''; ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>?f=<?php echo (isset($this->_rootref['S_FORUM_ID'])) ? $this->_rootref['S_FORUM_ID'] : ''; ?>" /><?php } if ($this->_rootref['S_ENABLE_FEEDS_TOPIC'] && $this->_rootref['S_TOPIC_ID']) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_TOPIC'])) ? $this->_rootref['L_TOPIC'] : ((isset($user->lang['TOPIC'])) ? $user->lang['TOPIC'] : '{ TOPIC }')); ?> - <?php echo (isset($this->_rootref['TOPIC_TITLE'])) ? $this->_rootref['TOPIC_TITLE'] : ''; ?>" href="<?php echo (isset($this->_rootref['U_FEED'])) ? $this->_rootref['U_FEED'] : ''; ?>?f=<?php echo (isset($this->_rootref['S_FORUM_ID'])) ? $this->_rootref['S_FORUM_ID'] : ''; ?>&amp;t=<?php echo (isset($this->_rootref['S_TOPIC_ID'])) ? $this->_rootref['S_TOPIC_ID'] : ''; ?>" /><?php } } ?>


<!--
	phpBB style name: Zerozaku v2.0
	Original author:  Gio Borje (http://www.zerozaku.com/)
-->

<script type="text/javascript">
// <![CDATA[
	var jump_page = '<?php echo ((isset($this->_rootref['LA_JUMP_PAGE'])) ? $this->_rootref['LA_JUMP_PAGE'] : ((isset($this->_rootref['L_JUMP_PAGE'])) ? addslashes($this->_rootref['L_JUMP_PAGE']) : ((isset($user->lang['JUMP_PAGE'])) ? addslashes($user->lang['JUMP_PAGE']) : '{ JUMP_PAGE }'))); ?>:';
	var on_page = '<?php echo (isset($this->_rootref['ON_PAGE'])) ? $this->_rootref['ON_PAGE'] : ''; ?>';
	var per_page = '<?php echo (isset($this->_rootref['PER_PAGE'])) ? $this->_rootref['PER_PAGE'] : ''; ?>';
	var base_url = '<?php echo (isset($this->_rootref['A_BASE_URL'])) ? $this->_rootref['A_BASE_URL'] : ''; ?>';
	var style_cookie = 'phpBBstyle';
	var style_cookie_settings = '<?php echo (isset($this->_rootref['A_COOKIE_SETTINGS'])) ? $this->_rootref['A_COOKIE_SETTINGS'] : ''; ?>';
	var onload_functions = new Array();
	var onunload_functions = new Array();

	<?php if ($this->_rootref['S_USER_PM_POPUP']) {  ?>

		if (<?php echo (isset($this->_rootref['S_NEW_PM'])) ? $this->_rootref['S_NEW_PM'] : ''; ?>)
		{
			var url = '<?php echo (isset($this->_rootref['UA_POPUP_PM'])) ? $this->_rootref['UA_POPUP_PM'] : ''; ?>';
			window.open(url.replace(/&amp;/g, '&'), '_phpbbprivmsg', 'height=225,resizable=yes,scrollbars=yes, width=400');
		}
	<?php } ?>


	/**
	* Find a member
	*/
	function find_username(url)
	{
		popup(url, 760, 570, '_usersearch');
		return false;
	}
	
	onload_functions.push("load_startIM({rootPath: '<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>', themePath: '<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>', rtl: '<?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>'})");

	/**
	* New function for handling multiple calls to window.onload and window.unload by pentapenguin
	*/
	window.onload = function()
	{
		for (var i = 0; i < onload_functions.length; i++)
		{
			eval(onload_functions[i]);
		}
	}

	window.onunload = function()
	{
		for (var i = 0; i < onunload_functions.length; i++)
		{
			eval(onunload_functions[i]);
		}
	}

// ]]>
</script>
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/jquery.js"></script>
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/jquery.tools.min.js"></script>
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/xs_bbcode_fn.js"></script>
<script type="text/javascript" src="./classes/scripts/select_expand_bbcodes.js"></script>
<script type="text/javascript" src="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>mchat/jquery_cookie_mini.js"></script>
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/jquery.nivo.slider.packed.js"></script>
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/highlight.pack.js"></script>

<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/default.js"></script>

<?php if ($this->_rootref['S_USER_ALLOW_IM']) {  if ($this->_rootref['S_USER_LOGGED_IN'] && ! $this->_rootref['S_IS_BOT']) {  ?><script type="text/javascript" src="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>styles/instant_messenger/instant_messenger.js"></script><?php } if (! $this->_rootref['S_IS_BOT']) {  ?><script type="text/javascript" src="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>styles/instant_messenger/instant_messenger_buttons.js"></script><?php } } ?>


<!--[if lt IE 7]>
  <link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/instant_messenger_ie.css" rel="stylesheet" media="all" type="text/css"  />
<![endif]-->

<?php $this->_tpl_include('reimg_content.html'); ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/normal.css" rel="stylesheet" type="text/css" title="A" />
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/medium.css" rel="alternate stylesheet" type="text/css" title="A+" />
<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/large.css" rel="alternate stylesheet" type="text/css" title="A++" />

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/print.css" rel="stylesheet" type="text/css" media="print" title="printonly" />
<link href="<?php echo (isset($this->_rootref['T_STYLESHEET_LINK'])) ? $this->_rootref['T_STYLESHEET_LINK'] : ''; ?>" rel="stylesheet" type="text/css" media="screen, projection" />

<?php if ($this->_rootref['S_CONTENT_DIRECTION'] == ('rtl')) {  ?>

<link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/bidi.css" rel="stylesheet" type="text/css" media="screen, projection" />
<?php if ($this->_rootref['S_USER_ALLOW_IM']) {  ?><link href="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/instant_messenger_bidi.css" rel="stylesheet" type="text/css" media="screen, projection" /><?php } } ?>

</head>

<body id="phpbb" class="section-<?php echo (isset($this->_rootref['SCRIPT_NAME'])) ? $this->_rootref['SCRIPT_NAME'] : ''; ?> <?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>">
	
<?php if ($this->_rootref['S_USER_ALLOW_IM'] && ! $this->_rootref['S_IS_BOT']) {  $this->_tpl_include('instant_messenger_bar.html'); } ?> 
	
<div id="page-header">
	<div class="inner">	
		<div id="site-description">
			<a href="<?php echo (isset($this->_rootref['U_INDEX'])) ? $this->_rootref['U_INDEX'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_INDEX'])) ? $this->_rootref['L_INDEX'] : ((isset($user->lang['INDEX'])) ? $user->lang['INDEX'] : '{ INDEX }')); ?>" id="logo"><?php echo (isset($this->_rootref['SITE_LOGO_IMG'])) ? $this->_rootref['SITE_LOGO_IMG'] : ''; ?></a>
		</div>
		
		<ul class="navbar">
			<li<?php if ($this->_tpldata['DEFINE']['.']['CA_PAGE'] == ('index')) {  ?> class="current"<?php } ?>><a href="<?php echo (isset($this->_rootref['U_INDEX'])) ? $this->_rootref['U_INDEX'] : ''; ?>" accesskey="h" title="Forums"><?php echo ((isset($this->_rootref['L_FORUMS'])) ? $this->_rootref['L_FORUMS'] : ((isset($user->lang['FORUMS'])) ? $user->lang['FORUMS'] : '{ FORUMS }')); ?> <span>debate &amp; discuss</span></a></li>
			<li<?php if ($this->_tpldata['DEFINE']['.']['CA_PAGE'] == ('kb')) {  ?> class="current"<?php } ?>><a href="<?php echo (isset($this->_rootref['U_KB'])) ? $this->_rootref['U_KB'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_KB_EXPLAIN'])) ? $this->_rootref['L_KB_EXPLAIN'] : ((isset($user->lang['KB_EXPLAIN'])) ? $user->lang['KB_EXPLAIN'] : '{ KB_EXPLAIN }')); ?>"><?php echo ((isset($this->_rootref['L_KB'])) ? $this->_rootref['L_KB'] : ((isset($user->lang['KB'])) ? $user->lang['KB'] : '{ KB }')); ?> <span><?php echo ((isset($this->_rootref['L_KB_EXPLAIN'])) ? $this->_rootref['L_KB_EXPLAIN'] : ((isset($user->lang['KB_EXPLAIN'])) ? $user->lang['KB_EXPLAIN'] : '{ KB_EXPLAIN }')); ?></span></a></li>
			<li<?php if ($this->_tpldata['DEFINE']['.']['CA_PAGE'] == ('support')) {  ?> class="current"<?php } ?>><a href="<?php echo (isset($this->_rootref['U_SUPPORT'])) ? $this->_rootref['U_SUPPORT'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_SUPPORT_EXPLAIN'])) ? $this->_rootref['L_SUPPORT_EXPLAIN'] : ((isset($user->lang['SUPPORT_EXPLAIN'])) ? $user->lang['SUPPORT_EXPLAIN'] : '{ SUPPORT_EXPLAIN }')); ?>"><?php echo ((isset($this->_rootref['L_SUPPORT'])) ? $this->_rootref['L_SUPPORT'] : ((isset($user->lang['SUPPORT'])) ? $user->lang['SUPPORT'] : '{ SUPPORT }')); ?> <span><?php echo ((isset($this->_rootref['L_SUPPORT_EXPLAIN'])) ? $this->_rootref['L_SUPPORT_EXPLAIN'] : ((isset($user->lang['SUPPORT_EXPLAIN'])) ? $user->lang['SUPPORT_EXPLAIN'] : '{ SUPPORT_EXPLAIN }')); ?></span></a></li>
			<li<?php if ($this->_tpldata['DEFINE']['.']['CA_PAGE'] == ('search')) {  ?> class="current"<?php } ?>><a href="<?php echo (isset($this->_rootref['U_SEARCH'])) ? $this->_rootref['U_SEARCH'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_SEARCH_KEYWORDS'])) ? $this->_rootref['L_SEARCH_KEYWORDS'] : ((isset($user->lang['SEARCH_KEYWORDS'])) ? $user->lang['SEARCH_KEYWORDS'] : '{ SEARCH_KEYWORDS }')); ?>"><?php echo ((isset($this->_rootref['L_SEARCH'])) ? $this->_rootref['L_SEARCH'] : ((isset($user->lang['SEARCH'])) ? $user->lang['SEARCH'] : '{ SEARCH }')); ?> <span><?php echo ((isset($this->_rootref['L_SEARCH_KEYWORDS'])) ? $this->_rootref['L_SEARCH_KEYWORDS'] : ((isset($user->lang['SEARCH_KEYWORDS'])) ? $user->lang['SEARCH_KEYWORDS'] : '{ SEARCH_KEYWORDS }')); ?></span></a></li>
		</ul>
	</div>
</div>

<?php if (! $this->_rootref['S_USER_LOGGED_IN'] && ! $this->_rootref['S_IS_BOT']) {  ?>

<div id="quickpanel">
	<div class="inner">
		<div id="quicklogin" class="hide">
			<form method="post" action="<?php echo (isset($this->_rootref['S_QUICK_LOGIN_ACTION'])) ? $this->_rootref['S_QUICK_LOGIN_ACTION'] : ''; ?>">
				<fieldset class="quick-login">
					<label for="username"><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?></label>&nbsp;<input type="text" name="username" id="username" size="10" class="inputbox" title="<?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>" />
					<label for="password"><?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?></label>&nbsp;<input type="password" name="password" id="password" size="10" class="inputbox" title="<?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?>" />
					
					<?php if ($this->_rootref['S_AUTOLOGIN_ENABLED']) {  ?>

					<label for="autologin"><?php echo ((isset($this->_rootref['L_REMEMBER_ME'])) ? $this->_rootref['L_REMEMBER_ME'] : ((isset($user->lang['REMEMBER_ME'])) ? $user->lang['REMEMBER_ME'] : '{ REMEMBER_ME }')); ?> <input type="checkbox" name="autologin" id="autologin" /></label>
					<?php } ?><input type="submit" name="login" value="<?php echo ((isset($this->_rootref['L_LOGIN'])) ? $this->_rootref['L_LOGIN'] : ((isset($user->lang['LOGIN'])) ? $user->lang['LOGIN'] : '{ LOGIN }')); ?>" class="button2" />
					<?php echo (isset($this->_rootref['S_LOGIN_REDIRECT'])) ? $this->_rootref['S_LOGIN_REDIRECT'] : ''; ?>

				</fieldset>
			</form>
		</div>
	</div>
</div>
<?php } ?>


<div class="breadcrumbs">
	<div class="inner">
		<ul class="navlinks">
			<?php if (! $this->_rootref['S_IS_BOT']) {  ?>

			<li id="usernav-box">
				<?php if ($this->_rootref['S_USER_LOGGED_IN']) {  ?>

				<div class="dropdown">
					<span><?php echo (isset($this->_rootref['S_USERNAME_FULL'])) ? $this->_rootref['S_USERNAME_FULL'] : ''; ?> <img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/dropdown_arrow.png" alt="Arrow" /></span>
					<ul>
						<li><a href="<?php echo (isset($this->_rootref['U_UM_MAIN_SUBSCRIBED'])) ? $this->_rootref['U_UM_MAIN_SUBSCRIBED'] : ''; ?>"><?php echo ((isset($this->_rootref['L_UM_MAIN_SUBSCRIBED'])) ? $this->_rootref['L_UM_MAIN_SUBSCRIBED'] : ((isset($user->lang['UM_MAIN_SUBSCRIBED'])) ? $user->lang['UM_MAIN_SUBSCRIBED'] : '{ UM_MAIN_SUBSCRIBED }')); ?></a></li>
						<?php if ($this->_rootref['U_MCP']) {  ?>

							<li><a href="<?php echo (isset($this->_rootref['U_MCP'])) ? $this->_rootref['U_MCP'] : ''; ?>"><?php echo ((isset($this->_rootref['L_MCP'])) ? $this->_rootref['L_MCP'] : ((isset($user->lang['MCP'])) ? $user->lang['MCP'] : '{ MCP }')); ?></a></li>
						<?php } if ($this->_rootref['U_ACP']) {  ?>

							<li><a href="<?php echo (isset($this->_rootref['U_ACP'])) ? $this->_rootref['U_ACP'] : ''; ?>"><?php echo ((isset($this->_rootref['L_M_ACP'])) ? $this->_rootref['L_M_ACP'] : ((isset($user->lang['M_ACP'])) ? $user->lang['M_ACP'] : '{ M_ACP }')); ?></a></li>
						<?php } ?>

						<li><a href="<?php echo (isset($this->_rootref['U_LOGIN_LOGOUT'])) ? $this->_rootref['U_LOGIN_LOGOUT'] : ''; ?>"><?php echo ((isset($this->_rootref['L_LOGIN_LOGOUT'])) ? $this->_rootref['L_LOGIN_LOGOUT'] : ((isset($user->lang['LOGIN_LOGOUT'])) ? $user->lang['LOGIN_LOGOUT'] : '{ LOGIN_LOGOUT }')); ?></a></li>
					</ul>
				</div>
				<?php } else if (! $this->_rootref['S_USER_LOGGED_IN']) {  ?>

				<ul id="account-actions">
					<li><a href="<?php echo (isset($this->_rootref['U_LOGIN_LOGOUT'])) ? $this->_rootref['U_LOGIN_LOGOUT'] : ''; ?>" class="quick" title="<?php echo ((isset($this->_rootref['L_LOGIN'])) ? $this->_rootref['L_LOGIN'] : ((isset($user->lang['LOGIN'])) ? $user->lang['LOGIN'] : '{ LOGIN }')); ?>" accesskey="l" rel="#quicklogin"><?php echo ((isset($this->_rootref['L_LOGIN'])) ? $this->_rootref['L_LOGIN'] : ((isset($user->lang['LOGIN'])) ? $user->lang['LOGIN'] : '{ LOGIN }')); ?></a><?php if ($this->_rootref['S_REGISTER_ENABLED']) {  ?> or <a href="<?php echo (isset($this->_rootref['U_REGISTER'])) ? $this->_rootref['U_REGISTER'] : ''; ?>"><?php echo ((isset($this->_rootref['L_REGISTER'])) ? $this->_rootref['L_REGISTER'] : ((isset($user->lang['REGISTER'])) ? $user->lang['REGISTER'] : '{ REGISTER }')); ?></a><?php } ?></li>
				</ul>
				<?php } ?>

			</li>
			<?php } ?>

			
			<li class="icon-home"><a href="<?php echo (isset($this->_rootref['U_INDEX'])) ? $this->_rootref['U_INDEX'] : ''; ?>" accesskey="h" class="index"><?php echo ((isset($this->_rootref['L_INDEX'])) ? $this->_rootref['L_INDEX'] : ((isset($user->lang['INDEX'])) ? $user->lang['INDEX'] : '{ INDEX }')); ?></a> <?php $_navlinks_count = (isset($this->_tpldata['navlinks'])) ? sizeof($this->_tpldata['navlinks']) : 0;if ($_navlinks_count) {for ($_navlinks_i = 0; $_navlinks_i < $_navlinks_count; ++$_navlinks_i){$_navlinks_val = &$this->_tpldata['navlinks'][$_navlinks_i]; ?> <strong>&laquo;</strong> <a href="<?php echo $_navlinks_val['U_VIEW_FORUM']; ?>"><?php echo $_navlinks_val['FORUM_NAME']; ?></a><?php }} ?></li>
		</ul>
	</div>
</div>


<div id="wrap">
	<a id="top" name="top" accesskey="t"></a>

	<a name="start_here"></a>
	
	<?php if ($this->_tpldata['DEFINE']['.']['SIDEBAR'] == ('1')) {  ?>

	<div id="page-body">
	<?php } else { } if ($this->_rootref['S_BOARD_DISABLED'] && $this->_rootref['S_USER_LOGGED_IN'] && ( $this->_rootref['U_MCP'] || $this->_rootref['U_ACP'] )) {  ?>

		<div id="information" class="rules">
			<div class="inner">
				<strong><?php echo ((isset($this->_rootref['L_INFORMATION'])) ? $this->_rootref['L_INFORMATION'] : ((isset($user->lang['INFORMATION'])) ? $user->lang['INFORMATION'] : '{ INFORMATION }')); ?>:</strong> <?php echo ((isset($this->_rootref['L_BOARD_DISABLED'])) ? $this->_rootref['L_BOARD_DISABLED'] : ((isset($user->lang['BOARD_DISABLED'])) ? $user->lang['BOARD_DISABLED'] : '{ BOARD_DISABLED }')); ?>

			</div>
		</div>
		<?php } if (! $this->_rootref['S_IS_BOT'] && $this->_rootref['S_USER_LOGGED_IN']) {  if ($this->_rootref['NEW_REQUESTS']) {  ?>

				<div class="panel info">
					<img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/info.png" /><p><a href="<?php echo (isset($this->_rootref['U_REQUESTS_LIST'])) ? $this->_rootref['U_REQUESTS_LIST'] : ''; ?>"><?php echo (isset($this->_rootref['NEW_REQUESTS'])) ? $this->_rootref['NEW_REQUESTS'] : ''; ?></a></p>
				</div>
			<?php } if ($this->_rootref['SIMPLE_COMMENT_ENABLED'] && ! $this->_rootref['S_NO_NEW_COMMENTS']) {  ?>

				<div class="panel info">
					<img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/comments.png" alt="<?php echo ((isset($this->_rootref['L_UNREAD_MESSAGES'])) ? $this->_rootref['L_UNREAD_MESSAGES'] : ((isset($user->lang['UNREAD_MESSAGES'])) ? $user->lang['UNREAD_MESSAGES'] : '{ UNREAD_MESSAGES }')); ?>" /><p><a href="<?php echo (isset($this->_rootref['U_COMMENTS'])) ? $this->_rootref['U_COMMENTS'] : ''; ?>"><?php echo ((isset($this->_rootref['L_TOTAL_COMMENT'])) ? $this->_rootref['L_TOTAL_COMMENT'] : ((isset($user->lang['TOTAL_COMMENT'])) ? $user->lang['TOTAL_COMMENT'] : '{ TOTAL_COMMENT }')); ?></a></p>
				</div>
			<?php } if ($this->_rootref['S_USER_NEW_PRIVMSG'] && $this->_rootref['S_DISPLAY_PM']) {  ?>

				<div class="panel info">
					<img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/mail_receive.png" alt="<?php echo ((isset($this->_rootref['L_UNREAD_MESSAGES'])) ? $this->_rootref['L_UNREAD_MESSAGES'] : ((isset($user->lang['UNREAD_MESSAGES'])) ? $user->lang['UNREAD_MESSAGES'] : '{ UNREAD_MESSAGES }')); ?>" /><p><a href="<?php echo (isset($this->_rootref['U_PRIVATEMSGS'])) ? $this->_rootref['U_PRIVATEMSGS'] : ''; ?>"><?php echo ((isset($this->_rootref['L_YOU_NEW_PM'])) ? $this->_rootref['L_YOU_NEW_PM'] : ((isset($user->lang['YOU_NEW_PM'])) ? $user->lang['YOU_NEW_PM'] : '{ YOU_NEW_PM }')); ?></a></p>
				</div>
			<?php } } ?>