<?php if (!defined('IN_PHPBB')) exit; if ($this->_rootref['MCHAT_ARCHIVE_MODE'] || $this->_rootref['MCHAT_CUSTOM_PAGE']) {  $this->_tpl_include('overall_header.html'); } if ($this->_rootref['MCHAT_ARCHIVE_MODE']) {  ?>
<ul class="linklist">
	<li class="rightside pagination"><?php echo (isset($this->_rootref['MCHAT_TOTAL_MESSAGES'])) ? $this->_rootref['MCHAT_TOTAL_MESSAGES'] : ''; ?> &bull; <?php if ($this->_rootref['MCHAT_PAGINATION']) {  ?><a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['MCHAT_PAGE_NUMBER'])) ? $this->_rootref['MCHAT_PAGE_NUMBER'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['MCHAT_PAGINATION'])) ? $this->_rootref['MCHAT_PAGINATION'] : ''; ?></span><?php } else { echo (isset($this->_rootref['MCHAT_PAGE_NUMBER'])) ? $this->_rootref['MCHAT_PAGE_NUMBER'] : ''; } ?></li>
</ul>
<?php } if (! $this->_rootref['MCHAT_READ_MODE']) {  ?>
<h2 class="cattitle"><?php if ($this->_rootref['MCHAT_ARCHIVE_MODE']) {  echo ((isset($this->_rootref['L_MCHAT_ARCHIVE_PAGE'])) ? $this->_rootref['L_MCHAT_ARCHIVE_PAGE'] : ((isset($user->lang['MCHAT_ARCHIVE_PAGE'])) ? $user->lang['MCHAT_ARCHIVE_PAGE'] : '{ MCHAT_ARCHIVE_PAGE }')); } else { if ($this->_rootref['S_MCHAT_ENABLE'] && $this->_rootref['U_MCHAT']) {  ?><a href="<?php echo (isset($this->_rootref['U_MCHAT'])) ? $this->_rootref['U_MCHAT'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_MCHAT'])) ? $this->_rootref['L_MCHAT'] : ((isset($user->lang['MCHAT'])) ? $user->lang['MCHAT'] : '{ MCHAT }')); ?>"><?php echo ((isset($this->_rootref['L_MCHAT_TITLE'])) ? $this->_rootref['L_MCHAT_TITLE'] : ((isset($user->lang['MCHAT_TITLE'])) ? $user->lang['MCHAT_TITLE'] : '{ MCHAT_TITLE }')); ?></a><?php } } ?></h2>
<div class="forabg">
		<div class="mChatBodyFix">
<?php } if ($this->_rootref['MCHAT_ENABLE']) {  if (! $this->_rootref['MCHAT_READ_MODE']) {  ?>
<script type="text/javascript">
// <![CDATA[
// Define mChat setting
var mChatFile = '<?php echo (isset($this->_rootref['MCHAT_FILE_NAME'])) ? $this->_rootref['MCHAT_FILE_NAME'] : ''; ?>';
var mChatForumRoot = '<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>';
<?php if (! $this->_rootref['MCHAT_ARCHIVE_MODE']) {  ?>
var mChatRefresh = '<?php echo (isset($this->_rootref['MCHAT_REFRESH_JS'])) ? $this->_rootref['MCHAT_REFRESH_JS'] : ''; ?>';
<?php } else { ?>
var mChatRefresh = false;
<?php } ?>
var mChatNoMessageInput = '<?php echo ((isset($this->_rootref['LA_MCHAT_NOMESSAGEINPUT'])) ? $this->_rootref['LA_MCHAT_NOMESSAGEINPUT'] : ((isset($this->_rootref['L_MCHAT_NOMESSAGEINPUT'])) ? addslashes($this->_rootref['L_MCHAT_NOMESSAGEINPUT']) : ((isset($user->lang['MCHAT_NOMESSAGEINPUT'])) ? addslashes($user->lang['MCHAT_NOMESSAGEINPUT']) : '{ MCHAT_NOMESSAGEINPUT }'))); ?>';
var mChatNoMessage = '<?php echo ((isset($this->_rootref['LA_MCHAT_NOMESSAGE'])) ? $this->_rootref['LA_MCHAT_NOMESSAGE'] : ((isset($this->_rootref['L_MCHAT_NOMESSAGE'])) ? addslashes($this->_rootref['L_MCHAT_NOMESSAGE']) : ((isset($user->lang['MCHAT_NOMESSAGE'])) ? addslashes($user->lang['MCHAT_NOMESSAGE']) : '{ MCHAT_NOMESSAGE }'))); ?>';
var mChatEditInfo = '<?php echo ((isset($this->_rootref['LA_MCHAT_EDITINFO'])) ? $this->_rootref['LA_MCHAT_EDITINFO'] : ((isset($this->_rootref['L_MCHAT_EDITINFO'])) ? addslashes($this->_rootref['L_MCHAT_EDITINFO']) : ((isset($user->lang['MCHAT_EDITINFO'])) ? addslashes($user->lang['MCHAT_EDITINFO']) : '{ MCHAT_EDITINFO }'))); ?>';
var mChatNoAccess = '<?php echo ((isset($this->_rootref['LA_MCHAT_NOACCESS'])) ? $this->_rootref['LA_MCHAT_NOACCESS'] : ((isset($this->_rootref['L_MCHAT_NOACCESS'])) ? addslashes($this->_rootref['L_MCHAT_NOACCESS']) : ((isset($user->lang['MCHAT_NOACCESS'])) ? addslashes($user->lang['MCHAT_NOACCESS']) : '{ MCHAT_NOACCESS }'))); ?>';
var mChatFlood = '<?php echo ((isset($this->_rootref['LA_MCHAT_FLOOD'])) ? $this->_rootref['LA_MCHAT_FLOOD'] : ((isset($this->_rootref['L_MCHAT_FLOOD'])) ? addslashes($this->_rootref['L_MCHAT_FLOOD']) : ((isset($user->lang['MCHAT_FLOOD'])) ? addslashes($user->lang['MCHAT_FLOOD']) : '{ MCHAT_FLOOD }'))); ?>';
var mChatDelConfirm = '<?php echo ((isset($this->_rootref['LA_MCHAT_DELCONFIRM'])) ? $this->_rootref['LA_MCHAT_DELCONFIRM'] : ((isset($this->_rootref['L_MCHAT_DELCONFIRM'])) ? addslashes($this->_rootref['L_MCHAT_DELCONFIRM']) : ((isset($user->lang['MCHAT_DELCONFIRM'])) ? addslashes($user->lang['MCHAT_DELCONFIRM']) : '{ MCHAT_DELCONFIRM }'))); ?>';
<?php if ($this->_rootref['MCHAT_CUSTOM_PAGE_WHOIS'] && $this->_rootref['MCHAT_CUSTOM_PAGE']) {  ?>
var mChatCustomWhois = true;
var mChatWhoisRefresh = '<?php echo (isset($this->_rootref['MCHAT_WHOIS_REFRESH'])) ? $this->_rootref['MCHAT_WHOIS_REFRESH'] : ''; ?>';
<?php } else { ?>
var mChatCustomWhois = false;
var mChatWhoisRefresh = false;
<?php } if ($this->_rootref['MCHAT_ARCHIVE_MODE']) {  ?>
var mChatArchiveMode = true;
<?php } else { ?>
var mChatArchiveMode = false;
// Define the bbCode tags
var bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[quote]','[/quote]','[code]','[/code]','[list]','[/list]','[list=]','[/list]','[img]','[/img]','[url]','[/url]','[flash=]', '[/flash]','[size=]','[/size]');
var form_name = 'mChatForm';
var text_name = 'message';
var mChatFocusFix = true;
<?php } ?>
// ]]>
</script>

		<?php if (! $this->_rootref['MCHAT_ARCHIVE_MODE']) {  ?>
		<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/editor.js"></script>
		<div <?php if ($this->_rootref['MCHAT_CUSTOM_PAGE']) {  ?>class="mChatRowLimitCustom"<?php } else { ?>class="mChatRowLimit"<?php } ?>>
			<?php } ?>
			<div id="mChatData">
				<?php } $_mchatrow_count = (isset($this->_tpldata['mchatrow'])) ? sizeof($this->_tpldata['mchatrow']) : 0;if ($_mchatrow_count) {for ($_mchatrow_i = 0; $_mchatrow_i < $_mchatrow_count; ++$_mchatrow_i){$_mchatrow_val = &$this->_tpldata['mchatrow'][$_mchatrow_i]; ?>
				<div id="mess<?php echo $_mchatrow_val['MCHAT_MESSAGE_ID']; ?>" class="mChatBG<?php echo $_mchatrow_val['MCHAT_CLASS']; ?> mChatHover hb_container">
					<?php if ($_mchatrow_val['MCHAT_AVATAR']) {  echo $_mchatrow_val['MCHAT_AVATAR']; } else { ?><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/no-avatar.png" height="40px" width="40px" alt="Default Avatar" /><?php } ?>
					<div class="body">
						<div class="meta">
							<span class="username"><?php echo $_mchatrow_val['MCHAT_USERNAME_FULL']; ?></span> &nbsp;<?php if ($this->_rootref['MCHAT_ALLOW_IP']) {  ?>(<a href="<?php echo $_mchatrow_val['MCHAT_U_WHOIS']; ?>" onclick="popup(this.href, 750, 500); return false;"><?php echo $_mchatrow_val['MCHAT_USER_IP']; ?></a>)<?php } ?>					
						</div>
						
						<div class="hb">
							<?php if (! $this->_rootref['MCHAT_ARCHIVE_MODE'] && $this->_rootref['MCHAT_ADD_MESSAGE']) {  if ($this->_rootref['MCHAT_ALLOW_BBCODES']) {  if ($_mchatrow_val['MCHAT_USERNAME_COLOR']) {  ?> <a href="javascript://" onclick="insert_text('[b][color=<?php echo $_mchatrow_val['MCHAT_USERNAME_COLOR']; ?>]<?php echo $_mchatrow_val['MCHAT_USERNAME']; ?>[/color][/b], ', false);"> <img src="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>mchat/copy_paste.png" alt="<?php echo $_mchatrow_val['MCHAT_USERNAME']; ?>" title="<?php echo $_mchatrow_val['MCHAT_USERNAME']; ?>" style="margin-bottom: -3px;" /></a><?php } else { ?> <a href="javascript://" onclick="insert_text('[b]<?php echo $_mchatrow_val['MCHAT_USERNAME']; ?>[/b], ', false);"> <img src="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>mchat/copy_paste.png" title="<?php echo $_mchatrow_val['MCHAT_USERNAME']; ?>" style="margin-bottom: -3px;" /></a><?php } } else { ?> <a href="javascript://" onclick="insert_text('<?php echo $_mchatrow_val['MCHAT_USERNAME']; ?>, ', false);"> <img src="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>mchat/copy_paste.png" title="<?php echo $_mchatrow_val['MCHAT_USERNAME']; ?>" style="margin-bottom: -3px;" /></a><?php } } if ($_mchatrow_val['MCHAT_ALLOW_EDIT']) {  ?> <a href="javascript://" onclick="mChat.edit('<?php echo $_mchatrow_val['MCHAT_MESSAGE_ID']; ?>');"><img src="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>mchat/edit.png" alt="<?php echo ((isset($this->_rootref['L_MCHAT_EDIT'])) ? $this->_rootref['L_MCHAT_EDIT'] : ((isset($user->lang['MCHAT_EDIT'])) ? $user->lang['MCHAT_EDIT'] : '{ MCHAT_EDIT }')); ?>" title="<?php echo ((isset($this->_rootref['L_MCHAT_EDIT'])) ? $this->_rootref['L_MCHAT_EDIT'] : ((isset($user->lang['MCHAT_EDIT'])) ? $user->lang['MCHAT_EDIT'] : '{ MCHAT_EDIT }')); ?>" style="vertical-align: middle;" /></a><?php } ?><input type="hidden" id="edit<?php echo $_mchatrow_val['MCHAT_MESSAGE_ID']; ?>" value="<?php echo $_mchatrow_val['MCHAT_MESSAGE_EDIT']; ?>" />
							<?php if ($_mchatrow_val['MCHAT_ALLOW_DEL']) {  ?> <a href="javascript://" onclick="mChat.del('<?php echo $_mchatrow_val['MCHAT_MESSAGE_ID']; ?>');"><img src="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>mchat/del.png" alt="<?php echo ((isset($this->_rootref['L_MCHAT_DELITE'])) ? $this->_rootref['L_MCHAT_DELITE'] : ((isset($user->lang['MCHAT_DELITE'])) ? $user->lang['MCHAT_DELITE'] : '{ MCHAT_DELITE }')); ?>" title="<?php echo ((isset($this->_rootref['L_MCHAT_DELITE'])) ? $this->_rootref['L_MCHAT_DELITE'] : ((isset($user->lang['MCHAT_DELITE'])) ? $user->lang['MCHAT_DELITE'] : '{ MCHAT_DELITE }')); ?>" style="vertical-align: middle;" /></a><?php } if ($_mchatrow_val['MCHAT_ALLOW_BAN']) {  ?> <a href="<?php echo $_mchatrow_val['MCHAT_U_BAN']; ?>"><img src="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>mchat/ban.png" alt="<?php echo ((isset($this->_rootref['L_MCHAT_PERMISSIONS'])) ? $this->_rootref['L_MCHAT_PERMISSIONS'] : ((isset($user->lang['MCHAT_PERMISSIONS'])) ? $user->lang['MCHAT_PERMISSIONS'] : '{ MCHAT_PERMISSIONS }')); ?>" title="<?php echo ((isset($this->_rootref['L_MCHAT_PERMISSIONS'])) ? $this->_rootref['L_MCHAT_PERMISSIONS'] : ((isset($user->lang['MCHAT_PERMISSIONS'])) ? $user->lang['MCHAT_PERMISSIONS'] : '{ MCHAT_PERMISSIONS }')); ?>" style="vertical-align: middle;" /></a><?php } ?>
						</div>
						
						<?php echo $_mchatrow_val['MCHAT_MESSAGE']; ?>
					<span class="date"><?php echo $_mchatrow_val['MCHAT_TIME']; ?></span>
					</div>
				</div>
				<?php }} if (! $this->_rootref['MCHAT_READ_MODE']) {  ?>
				<div id="mChatNoMessage"<?php if (! $this->_rootref['MCHAT_NOMESSAGE_MODE']) {  ?> style="display: none;"<?php } ?>><?php echo ((isset($this->_rootref['L_MCHAT_NOMESSAGE'])) ? $this->_rootref['L_MCHAT_NOMESSAGE'] : ((isset($user->lang['MCHAT_NOMESSAGE'])) ? $user->lang['MCHAT_NOMESSAGE'] : '{ MCHAT_NOMESSAGE }')); ?></div>
				<?php if ($this->_rootref['MCHAT_ARCHIVE_MODE'] && ! $this->_rootref['MCHAT_NOMESSAGE_MODE']) {  ?>
				<div id="mChatArchiveNoMessage" style="display: none;"><?php echo ((isset($this->_rootref['L_MCHAT_ARCHIVENOMESSAGE'])) ? $this->_rootref['L_MCHAT_ARCHIVENOMESSAGE'] : ((isset($user->lang['MCHAT_ARCHIVENOMESSAGE'])) ? $user->lang['MCHAT_ARCHIVENOMESSAGE'] : '{ MCHAT_ARCHIVENOMESSAGE }')); ?></div>
				<?php } ?>
			</div>
			<?php if (! $this->_rootref['MCHAT_ARCHIVE_MODE']) {  ?>
		</div>
		
		<form method="post" action="javascript://" onsubmit="mChat.add();" id="mChatForm">
			<div class="mChatPanel">
				<noscript><div style="color: #FF0000;"><?php echo ((isset($this->_rootref['L_MCHAT_NOJAVASCRIPT'])) ? $this->_rootref['L_MCHAT_NOJAVASCRIPT'] : ((isset($user->lang['MCHAT_NOJAVASCRIPT'])) ? $user->lang['MCHAT_NOJAVASCRIPT'] : '{ MCHAT_NOJAVASCRIPT }')); ?></div></noscript>
				
				<?php if ($this->_rootref['MCHAT_ALLOW_BBCODES']) {  ?>
				<div id="mChatBBCodes" style="padding: 5px; display: none;">
				<input type="button" class="button2" accesskey="b" value=" B " style="font-weight:bold; width: 30px" onclick="bbstyle(0);" />
				<input type="button" class="button2" accesskey="i" value=" i " style="font-style:italic; width: 30px" onclick="bbstyle(2);" />
				<input type="button" class="button2" accesskey="u" value=" u " style="text-decoration: underline; width: 30px" onclick="bbstyle(4);" />
				<input type="button" class="button2" accesskey="q" value="Quote" style="width: 50px" onclick="bbstyle(6);" />
				<input type="button" class="button2" accesskey="l" value="List" style="width: 40px" onclick="bbstyle(10);" />
				<input type="button" class="button2" accesskey="t" value="[*]" style="width: 40px" onclick="bbstyle(-1);" />
				<input type="button" class="button2" accesskey="w" value="URL" style="text-decoration: underline; width: 40px" onclick="bbstyle(16);" />
				<span class="genmed nowrap"><?php echo ((isset($this->_rootref['L_MCHAT_FONTSIZE'])) ? $this->_rootref['L_MCHAT_FONTSIZE'] : ((isset($user->lang['MCHAT_FONTSIZE'])) ? $user->lang['MCHAT_FONTSIZE'] : '{ MCHAT_FONTSIZE }')); ?><select class="gensmall" onchange="bbfontstyle('[size=' + this.options[this.selectedIndex].value + ']', '[/size]'); this.selectedIndex = 2;">
				<option value="50"><?php echo ((isset($this->_rootref['L_MCHAT_FONTTINY'])) ? $this->_rootref['L_MCHAT_FONTTINY'] : ((isset($user->lang['MCHAT_FONTTINY'])) ? $user->lang['MCHAT_FONTTINY'] : '{ MCHAT_FONTTINY }')); ?></option>
				<option value="85"><?php echo ((isset($this->_rootref['L_MCHAT_FONTSMALL'])) ? $this->_rootref['L_MCHAT_FONTSMALL'] : ((isset($user->lang['MCHAT_FONTSMALL'])) ? $user->lang['MCHAT_FONTSMALL'] : '{ MCHAT_FONTSMALL }')); ?></option>
				<option value="100" selected="selected"><?php echo ((isset($this->_rootref['L_MCHAT_FONTNORMAL'])) ? $this->_rootref['L_MCHAT_FONTNORMAL'] : ((isset($user->lang['MCHAT_FONTNORMAL'])) ? $user->lang['MCHAT_FONTNORMAL'] : '{ MCHAT_FONTNORMAL }')); ?></option>
				<option value="150"><?php echo ((isset($this->_rootref['L_MCHAT_FONTLARGE'])) ? $this->_rootref['L_MCHAT_FONTLARGE'] : ((isset($user->lang['MCHAT_FONTLARGE'])) ? $user->lang['MCHAT_FONTLARGE'] : '{ MCHAT_FONTLARGE }')); ?></option>
				<option value="200"><?php echo ((isset($this->_rootref['L_MCHAT_FONTHUGE'])) ? $this->_rootref['L_MCHAT_FONTHUGE'] : ((isset($user->lang['MCHAT_FONTHUGE'])) ? $user->lang['MCHAT_FONTHUGE'] : '{ MCHAT_FONTHUGE }')); ?></option>
				</select></span>
				</div>
				<?php } if ($this->_rootref['MCHAT_ADD_MESSAGE']) {  ?>
				<input type="hidden" name="mode" value="add" />
				<input type="text" tabindex="1" name="message" class="mChatText" id="mChatMessage" />
				<input type="button" tabindex="2" class="button1" onclick="mChat.add();" value="<?php echo ((isset($this->_rootref['L_MCHAT_ADD'])) ? $this->_rootref['L_MCHAT_ADD'] : ((isset($user->lang['MCHAT_ADD'])) ? $user->lang['MCHAT_ADD'] : '{ MCHAT_ADD }')); ?>" />
				<?php } ?>
			
				<br />
							
				<?php if ($this->_rootref['MCHAT_ALLOW_SMILES']) {  ?>
				<div id="mChatSmiles" style="padding: 5px; display: none;">
				<?php if ($this->_rootref['MCHAT_NO_SMILE']) {  ?>
				<?php echo ((isset($this->_rootref['L_MCHAT_NOSMILE'])) ? $this->_rootref['L_MCHAT_NOSMILE'] : ((isset($user->lang['MCHAT_NOSMILE'])) ? $user->lang['MCHAT_NOSMILE'] : '{ MCHAT_NOSMILE }')); ?>
				<?php } $_mchatsmilerow_count = (isset($this->_tpldata['mchatsmilerow'])) ? sizeof($this->_tpldata['mchatsmilerow']) : 0;if ($_mchatsmilerow_count) {for ($_mchatsmilerow_i = 0; $_mchatsmilerow_i < $_mchatsmilerow_count; ++$_mchatsmilerow_i){$_mchatsmilerow_val = &$this->_tpldata['mchatsmilerow'][$_mchatsmilerow_i]; ?>
				<a href="javascript://" onclick="insert_text('<?php echo $_mchatsmilerow_val['MCHAT_SMILE_CODE']; ?>', true);"><img src="<?php echo $_mchatsmilerow_val['MCHAT_SMILE_IMG']; ?>" width="<?php echo $_mchatsmilerow_val['MCHAT_SMILE_WIDTH']; ?>" height="<?php echo $_mchatsmilerow_val['MCHAT_SMILE_HEIGHT']; ?>" alt="<?php echo $_mchatsmilerow_val['MCHAT_SMILE_CODE']; ?>" title="<?php echo $_mchatsmilerow_val['MCHAT_SMILE_EMOTION']; ?>" /></a>
				<?php }} ?>
				</div>
				<?php } ?>
				
				<div style="padding: 3px;">
					<label for="mChatUseSound"><?php echo ((isset($this->_rootref['L_MCHAT_USESOUND'])) ? $this->_rootref['L_MCHAT_USESOUND'] : ((isset($user->lang['MCHAT_USESOUND'])) ? $user->lang['MCHAT_USESOUND'] : '{ MCHAT_USESOUND }')); ?> <input type="checkbox" id="mChatUseSound" checked="checked" /></label>
					
					<?php if ($this->_rootref['MCHAT_ALLOW_SMILES']) {  ?>
					<input type="button" tabindex="3" class="button2" onclick="mChat.toggle('Smiles');" value="<?php echo ((isset($this->_rootref['L_MCHAT_SMILES'])) ? $this->_rootref['L_MCHAT_SMILES'] : ((isset($user->lang['MCHAT_SMILES'])) ? $user->lang['MCHAT_SMILES'] : '{ MCHAT_SMILES }')); ?>" />
					<?php } if ($this->_rootref['MCHAT_ALLOW_BBCODES']) {  ?>
					<input type="button" tabindex="4" class="button2" onclick="mChat.toggle('BBCodes');" value="<?php echo ((isset($this->_rootref['L_MCHAT_BBCODES'])) ? $this->_rootref['L_MCHAT_BBCODES'] : ((isset($user->lang['MCHAT_BBCODES'])) ? $user->lang['MCHAT_BBCODES'] : '{ MCHAT_BBCODES }')); ?>" />
					<?php } if ($this->_rootref['MCHAT_READ_ARCHIVE_BUTTON']) {  ?>
					<input type="button" tabindex="5" class="button2" onclick="window.location.href = '<?php echo (isset($this->_rootref['MCHAT_ARCHIVE_URL'])) ? $this->_rootref['MCHAT_ARCHIVE_URL'] : ''; ?>';" value="<?php echo ((isset($this->_rootref['L_MCHAT_ARCHIVE'])) ? $this->_rootref['L_MCHAT_ARCHIVE'] : ((isset($user->lang['MCHAT_ARCHIVE'])) ? $user->lang['MCHAT_ARCHIVE'] : '{ MCHAT_ARCHIVE }')); ?>" />
					<?php } if ($this->_rootref['MCHAT_FOUNDER']) {  ?>
					<input type="button" class="button2" onclick="window.location.href = '<?php echo (isset($this->_rootref['MCHAT_CLEAN_URL'])) ? $this->_rootref['MCHAT_CLEAN_URL'] : ''; ?>';" value="<?php echo ((isset($this->_rootref['L_MCHAT_CLEAN'])) ? $this->_rootref['L_MCHAT_CLEAN'] : ((isset($user->lang['MCHAT_CLEAN'])) ? $user->lang['MCHAT_CLEAN'] : '{ MCHAT_CLEAN }')); ?>" />
					<?php } if ($this->_rootref['MCHAT_ADD_MESSAGE']) {  ?>
					<input type="button" class="button2" onclick="alert('<?php echo ((isset($this->_rootref['L_MCHAT_HELP_INFO'])) ? $this->_rootref['L_MCHAT_HELP_INFO'] : ((isset($user->lang['MCHAT_HELP_INFO'])) ? $user->lang['MCHAT_HELP_INFO'] : '{ MCHAT_HELP_INFO }')); ?>');" value="<?php echo ((isset($this->_rootref['L_MCHAT_HELP'])) ? $this->_rootref['L_MCHAT_HELP'] : ((isset($user->lang['MCHAT_HELP'])) ? $user->lang['MCHAT_HELP'] : '{ MCHAT_HELP }')); ?>" />
				<?php } ?>
				</div>
			</div>
		</form>
		
		<?php } ?>
		<div id="mChatSound" style="position: absolute; left: -1000px; top: -1000px;"></div>
		<script type="text/javascript" src="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>mchat/mchat_ajax_mini.js"></script>
		<?php } } else { ?>
		<div style="color: #FF0000; padding: 10px;"><?php echo ((isset($this->_rootref['L_MCHAT_ENABLE'])) ? $this->_rootref['L_MCHAT_ENABLE'] : ((isset($user->lang['MCHAT_ENABLE'])) ? $user->lang['MCHAT_ENABLE'] : '{ MCHAT_ENABLE }')); ?></div>
		<?php } if (! $this->_rootref['MCHAT_READ_MODE']) {  ?>
		
		</div>
</div>

<?php } if ($this->_rootref['MCHAT_ARCHIVE_MODE']) {  ?>
<ul class="linklist">
	<li class="rightside pagination"><?php echo (isset($this->_rootref['MCHAT_TOTAL_MESSAGES'])) ? $this->_rootref['MCHAT_TOTAL_MESSAGES'] : ''; ?> &bull; <?php if ($this->_rootref['MCHAT_PAGINATION']) {  ?><a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['MCHAT_PAGE_NUMBER'])) ? $this->_rootref['MCHAT_PAGE_NUMBER'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['MCHAT_PAGINATION'])) ? $this->_rootref['MCHAT_PAGINATION'] : ''; ?></span><?php } else { echo (isset($this->_rootref['MCHAT_PAGE_NUMBER'])) ? $this->_rootref['MCHAT_PAGE_NUMBER'] : ''; } ?></li>
</ul>
<?php } if ($this->_rootref['MCHAT_CUSTOM_PAGE']) {  ?>
<div class="adbrite"><!-- Begin: AdBrite, Generated: 2010-02-18 8:59:23  -->
	<script type="text/javascript">
	var AdBrite_Title_Color = '2D4054';
	var AdBrite_Text_Color = '212121';
	var AdBrite_Background_Color = 'FFFFFF';
	var AdBrite_Border_Color = 'D0D0D0';
	var AdBrite_URL_Color = 'FF530D';
	try{var AdBrite_Iframe=window.top!=window.self?2:1;var AdBrite_Referrer=document.referrer==''?document.location:document.referrer;AdBrite_Referrer=encodeURIComponent(AdBrite_Referrer);}catch(e){var AdBrite_Iframe='';var AdBrite_Referrer='';}
	</script>
	<span style="white-space:nowrap;"><script type="text/javascript">document.write(String.fromCharCode(60,83,67,82,73,80,84));document.write(' src="http://ads.adbrite.com/mb/text_group.php?sid=1535215&zs=3732385f3930&ifr='+AdBrite_Iframe+'&ref='+AdBrite_Referrer+'" type="text/javascript">');document.write(String.fromCharCode(60,47,83,67,82,73,80,84,62));</script>
	<a target="_top" href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=1535215&afsid=1"><img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-leaderboard.gif" style="background-color:#D0D0D0;border:none;padding:0;margin:0;" alt="Your Ad Here" width="14" height="90" border="0" /></a></span>
	<!-- End: AdBrite -->
</div>
<?php } if ($this->_rootref['MCHAT_CUSTOM_PAGE'] && $this->_rootref['MCHAT_CUSTOM_PAGE_WHOIS']) {  ?>
<div id="board-statistics">
	<h3><?php echo ((isset($this->_rootref['L_WHO_IS_CHATTING'])) ? $this->_rootref['L_WHO_IS_CHATTING'] : ((isset($user->lang['WHO_IS_CHATTING'])) ? $user->lang['WHO_IS_CHATTING'] : '{ WHO_IS_CHATTING }')); ?></h3>
	<div id="mChatStats" style="display:block"><p><?php echo (isset($this->_rootref['MCHAT_TOTAL_USERS_ONLINE'])) ? $this->_rootref['MCHAT_TOTAL_USERS_ONLINE'] : ''; ?> (<?php echo ((isset($this->_rootref['L_ONLINE_EXPLAIN'])) ? $this->_rootref['L_ONLINE_EXPLAIN'] : ((isset($user->lang['ONLINE_EXPLAIN'])) ? $user->lang['ONLINE_EXPLAIN'] : '{ ONLINE_EXPLAIN }')); ?>) <br /><?php echo (isset($this->_rootref['MCHAT_LOGGED_IN_USER_LIST'])) ? $this->_rootref['MCHAT_LOGGED_IN_USER_LIST'] : ''; ?></p></div>
	<p><span id="mChatRefresh"><?php echo (isset($this->_rootref['MCHAT_WHOIS_REFRESH_EXPLAIN'])) ? $this->_rootref['MCHAT_WHOIS_REFRESH_EXPLAIN'] : ''; ?></span><span id="mChatRefreshN" style="display: none;"><?php echo ((isset($this->_rootref['L_WHO_IS_REFRESHING'])) ? $this->_rootref['L_WHO_IS_REFRESHING'] : ((isset($user->lang['WHO_IS_REFRESHING'])) ? $user->lang['WHO_IS_REFRESHING'] : '{ WHO_IS_REFRESHING }')); ?></span>
	<?php if ($this->_rootref['LEGEND']) {  ?><br /><em><?php echo ((isset($this->_rootref['L_LEGEND'])) ? $this->_rootref['L_LEGEND'] : ((isset($user->lang['LEGEND'])) ? $user->lang['LEGEND'] : '{ LEGEND }')); ?>: <?php echo (isset($this->_rootref['LEGEND'])) ? $this->_rootref['LEGEND'] : ''; ?></em><?php } ?></p>
</div>
<?php } if ($this->_rootref['MCHAT_ARCHIVE_MODE'] || $this->_rootref['MCHAT_CUSTOM_PAGE']) {  $this->_tpl_include('overall_footer.html'); } ?>