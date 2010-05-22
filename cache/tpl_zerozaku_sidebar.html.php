<?php if (!defined('IN_PHPBB')) exit; $this->_tpldata['DEFINE']['.']['S_IN_PORTAL'] = 1; $this->_tpl_include('portal/_block_config.html'); if ($this->_rootref['S_DISPLAY_SEARCH'] && ! $this->_rootref['S_IN_SEARCH'] && $this->_rootref['S_USER_LOGGED_IN']) {  ?>
	<div id="search-box">
		<form action="<?php echo (isset($this->_rootref['U_SEARCH'])) ? $this->_rootref['U_SEARCH'] : ''; ?>" method="post" id="search">
		<fieldset>
			<input name="keywords" id="keywords" type="text" maxlength="128" title="<?php echo ((isset($this->_rootref['L_SEARCH_KEYWORDS'])) ? $this->_rootref['L_SEARCH_KEYWORDS'] : ((isset($user->lang['SEARCH_KEYWORDS'])) ? $user->lang['SEARCH_KEYWORDS'] : '{ SEARCH_KEYWORDS }')); ?>" class="inputbox search" value="<?php if ($this->_rootref['SEARCH_WORDS']) {  echo (isset($this->_rootref['SEARCH_WORDS'])) ? $this->_rootref['SEARCH_WORDS'] : ''; } else { echo ((isset($this->_rootref['L_SEARCH_MINI'])) ? $this->_rootref['L_SEARCH_MINI'] : ((isset($user->lang['SEARCH_MINI'])) ? $user->lang['SEARCH_MINI'] : '{ SEARCH_MINI }')); } ?>" onclick="if(this.value=='<?php echo ((isset($this->_rootref['LA_SEARCH_MINI'])) ? $this->_rootref['LA_SEARCH_MINI'] : ((isset($this->_rootref['L_SEARCH_MINI'])) ? addslashes($this->_rootref['L_SEARCH_MINI']) : ((isset($user->lang['SEARCH_MINI'])) ? addslashes($user->lang['SEARCH_MINI']) : '{ SEARCH_MINI }'))); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo ((isset($this->_rootref['LA_SEARCH_MINI'])) ? $this->_rootref['LA_SEARCH_MINI'] : ((isset($this->_rootref['L_SEARCH_MINI'])) ? addslashes($this->_rootref['L_SEARCH_MINI']) : ((isset($user->lang['SEARCH_MINI'])) ? addslashes($user->lang['SEARCH_MINI']) : '{ SEARCH_MINI }'))); ?>';" /> 
			<input class="button1" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" type="submit" /><?php echo (isset($this->_rootref['S_SEARCH_HIDDEN_FIELDS'])) ? $this->_rootref['S_SEARCH_HIDDEN_FIELDS'] : ''; ?>
		</fieldset>
		</form>
	</div>
	<?php } $this->_tpl_include('portal/block/additional_blocks_right.html'); if (! $this->_rootref['S_IS_BOT'] && $this->_rootref['S_USER_LOGGED_IN'] && $this->_rootref['S_ZEBRA_ENABLED'] && $this->_rootref['S_DISPLAY_FRIENDS']) {  $this->_tpl_include('portal/block/online_friends.html'); } if ($this->_rootref['S_DISPLAY_TOP_POSTERS']) {  $this->_tpl_include('portal/block/top_poster.html'); } $this->_tpl_include('milestones.html'); if ($this->_rootref['S_DISPLAY_ADVANCED_STAT']) {  $this->_tpl_include('portal/block/statistics.html'); } if ($this->_rootref['S_DISPLAY_LINKS']) {  $this->_tpl_include('portal/block/links.html'); } if ($this->_rootref['S_DISPLAY_LEADERS_EXT']) {  $this->_tpl_include('portal/block/leaders_ext.html'); } else if ($this->_rootref['S_DISPLAY_LEADERS']) {  $this->_tpl_include('portal/block/leaders.html'); } if ($this->_rootref['S_DISPLAY_PAY_S']) {  $this->_tpl_include('portal/block/donation_small.html'); } if ($this->_rootref['S_DISPLAY_PAY_C']) {  $this->_tpl_include('portal/block/donation.html'); } ?><!-- Begin: AdBrite, Generated: 2009-11-30 0:38:32  -->
	<div style="text-align: center;">
	<script type="text/javascript">
	var AdBrite_Title_Color = '2D4054';
	var AdBrite_Text_Color = '212121';
	var AdBrite_Background_Color = 'FFFFFF';
	var AdBrite_Border_Color = 'D0D0D0';
	var AdBrite_URL_Color = 'FF530D';
	try{var AdBrite_Iframe=window.top!=window.self?2:1;var AdBrite_Referrer=document.referrer==''?document.location:document.referrer;AdBrite_Referrer=encodeURIComponent(AdBrite_Referrer);}catch(e){var AdBrite_Iframe='';var AdBrite_Referrer='';}
	</script>
	<script type="text/javascript">document.write(String.fromCharCode(60,83,67,82,73,80,84));document.write(' src="http://ads.adbrite.com/mb/text_group.php?sid=1434695&amp;zs=3136305f363030&amp;ifr='+AdBrite_Iframe+'&amp;ref='+AdBrite_Referrer+'" type="text/javascript">');document.write(String.fromCharCode(60,47,83,67,82,73,80,84,62));</script>
	<div><a href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=1434695&amp;afsid=1" style="font-weight:bold;font-family:Arial;font-size:13px;">Your Ad Here</a></div>
	</div>
	<!-- End: AdBrite -->