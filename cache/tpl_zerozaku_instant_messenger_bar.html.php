<?php if (!defined('IN_PHPBB')) exit; ?><div id="site-bottom-bar" class="fixed-position">&nbsp;</div>
<div id="site-bottom-bar-frame" class="fixed-position">

<?php if (! $this->_rootref['S_USER_LOGGED_IN']) {  ?>
	<div class="block-box" id="im-login">
		<div class="button"><?php echo ((isset($this->_rootref['L_LOGIN'])) ? $this->_rootref['L_LOGIN'] : ((isset($user->lang['LOGIN'])) ? $user->lang['LOGIN'] : '{ LOGIN }')); ?></div>
		<div class="block">
			<h3><a href="<?php echo (isset($this->_rootref['U_LOGIN_LOGOUT'])) ? $this->_rootref['U_LOGIN_LOGOUT'] : ''; ?>"><?php echo ((isset($this->_rootref['L_LOGIN'])) ? $this->_rootref['L_LOGIN'] : ((isset($user->lang['LOGIN'])) ? $user->lang['LOGIN'] : '{ LOGIN }')); ?></a><?php if ($this->_rootref['S_REGISTER_ENABLED']) {  ?> &bull; <a href="<?php echo (isset($this->_rootref['U_REGISTER'])) ? $this->_rootref['U_REGISTER'] : ''; ?>"><?php echo ((isset($this->_rootref['L_REGISTER'])) ? $this->_rootref['L_REGISTER'] : ((isset($user->lang['REGISTER'])) ? $user->lang['REGISTER'] : '{ REGISTER }')); ?></a><?php } ?></h3>
			<div class="bcontent">
        <form method="post" action="<?php echo (isset($this->_rootref['S_LOGIN_ACTION'])) ? $this->_rootref['S_LOGIN_ACTION'] : ''; ?>">
          <fieldset>
            <dl>
            	<dt><label for="username"><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?></label></dt>
							<dd><input type="text" name="username" id="username" size="10" title="<?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>" class="loginbox_input inputbox" /></dd>
            </dl>
            <dl>
            	<dt><label for="password"><?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?></label></dt>
							<dd><input type="password" name="password" id="password" size="10" title="<?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?>" class="loginbox_input inputbox" /></dd>
            </dl>
          	<?php if ($this->_rootref['S_AUTOLOGIN_ENABLED']) {  ?>
				<dl>
					<dt><label for="autologin"><input type="checkbox" name="autologin" id="autologin" /> <?php echo ((isset($this->_rootref['L_REMEMBER_ME'])) ? $this->_rootref['L_REMEMBER_ME'] : ((isset($user->lang['REMEMBER_ME'])) ? $user->lang['REMEMBER_ME'] : '{ REMEMBER_ME }')); ?></label></dt>
				</dl>
			<?php } ?>
				<span>
		          <input type="submit" name="login" value="<?php echo ((isset($this->_rootref['L_LOGIN'])) ? $this->_rootref['L_LOGIN'] : ((isset($user->lang['LOGIN'])) ? $user->lang['LOGIN'] : '{ LOGIN }')); ?>" class="button1" />
				</span>								
          </fieldset>
        </form>
			</div>
		</div>
	</div>

	<div class="block-box rightside" id="im-online-list">
		<div class="button"><?php echo ((isset($this->_rootref['L_IM_NOT_LOGGED_IN'])) ? $this->_rootref['L_IM_NOT_LOGGED_IN'] : ((isset($user->lang['IM_NOT_LOGGED_IN'])) ? $user->lang['IM_NOT_LOGGED_IN'] : '{ IM_NOT_LOGGED_IN }')); ?></div>
	</div>
<?php } else { ?>
	<div class="block-box" id="im-login">
		<div class="button"><?php echo ((isset($this->_rootref['L_ACCOUNT'])) ? $this->_rootref['L_ACCOUNT'] : ((isset($user->lang['ACCOUNT'])) ? $user->lang['ACCOUNT'] : '{ ACCOUNT }')); ?></div>
		<div class="block">
      <h3><a href="<?php echo (isset($this->_rootref['U_PROFILE'])) ? $this->_rootref['U_PROFILE'] : ''; ?>"><?php echo (isset($this->_rootref['S_USERNAME'])) ? $this->_rootref['S_USERNAME'] : ''; ?></a></h3>
			<div class="bcontent links">
		    <ul>
					<li><a href="<?php echo (isset($this->_rootref['U_MANAGE_FRIENDS'])) ? $this->_rootref['U_MANAGE_FRIENDS'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_MANAGE_FRIENDS'])) ? $this->_rootref['L_MANAGE_FRIENDS'] : ((isset($user->lang['MANAGE_FRIENDS'])) ? $user->lang['MANAGE_FRIENDS'] : '{ MANAGE_FRIENDS }')); ?>">&raquo; <?php echo ((isset($this->_rootref['L_MANAGE_FRIENDS'])) ? $this->_rootref['L_MANAGE_FRIENDS'] : ((isset($user->lang['MANAGE_FRIENDS'])) ? $user->lang['MANAGE_FRIENDS'] : '{ MANAGE_FRIENDS }')); ?></a></li>
					<li><a href="<?php echo (isset($this->_rootref['U_ACCOUNT_SETTINGS'])) ? $this->_rootref['U_ACCOUNT_SETTINGS'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_ACCOUNT_SETTINGS'])) ? $this->_rootref['L_ACCOUNT_SETTINGS'] : ((isset($user->lang['ACCOUNT_SETTINGS'])) ? $user->lang['ACCOUNT_SETTINGS'] : '{ ACCOUNT_SETTINGS }')); ?>">&raquo; <?php echo ((isset($this->_rootref['L_ACCOUNT_SETTINGS'])) ? $this->_rootref['L_ACCOUNT_SETTINGS'] : ((isset($user->lang['ACCOUNT_SETTINGS'])) ? $user->lang['ACCOUNT_SETTINGS'] : '{ ACCOUNT_SETTINGS }')); ?></a></li>                    
					<li><a href="<?php echo (isset($this->_rootref['U_MANAGE_BOOKMARKS'])) ? $this->_rootref['U_MANAGE_BOOKMARKS'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_MANAGE_BOOKMARKS'])) ? $this->_rootref['L_MANAGE_BOOKMARKS'] : ((isset($user->lang['MANAGE_BOOKMARKS'])) ? $user->lang['MANAGE_BOOKMARKS'] : '{ MANAGE_BOOKMARKS }')); ?>">&raquo; <?php echo ((isset($this->_rootref['L_MANAGE_BOOKMARKS'])) ? $this->_rootref['L_MANAGE_BOOKMARKS'] : ((isset($user->lang['MANAGE_BOOKMARKS'])) ? $user->lang['MANAGE_BOOKMARKS'] : '{ MANAGE_BOOKMARKS }')); ?></a></li>
					<li><a href="<?php echo (isset($this->_rootref['U_SEARCH_SELF'])) ? $this->_rootref['U_SEARCH_SELF'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_SEARCH_SELF'])) ? $this->_rootref['L_SEARCH_SELF'] : ((isset($user->lang['SEARCH_SELF'])) ? $user->lang['SEARCH_SELF'] : '{ SEARCH_SELF }')); ?>">&raquo; <?php echo ((isset($this->_rootref['L_SEARCH_SELF'])) ? $this->_rootref['L_SEARCH_SELF'] : ((isset($user->lang['SEARCH_SELF'])) ? $user->lang['SEARCH_SELF'] : '{ SEARCH_SELF }')); ?></a></li>
					<li><a href="<?php echo (isset($this->_rootref['U_LOGIN_LOGOUT'])) ? $this->_rootref['U_LOGIN_LOGOUT'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_LOGIN_LOGOUT'])) ? $this->_rootref['L_LOGIN_LOGOUT'] : ((isset($user->lang['LOGIN_LOGOUT'])) ? $user->lang['LOGIN_LOGOUT'] : '{ LOGIN_LOGOUT }')); ?>">&raquo; <?php echo ((isset($this->_rootref['L_LOGIN_LOGOUT'])) ? $this->_rootref['L_LOGIN_LOGOUT'] : ((isset($user->lang['LOGIN_LOGOUT'])) ? $user->lang['LOGIN_LOGOUT'] : '{ LOGIN_LOGOUT }')); ?></a></li>
		    </ul>
			</div>
		</div>
	</div>
	
	<div class="block-box" id="im-status">
		<div class="button"><?php echo ((isset($this->_rootref['L_UPDATE_STATUS'])) ? $this->_rootref['L_UPDATE_STATUS'] : ((isset($user->lang['UPDATE_STATUS'])) ? $user->lang['UPDATE_STATUS'] : '{ UPDATE_STATUS }')); ?></div>
		<div class="block">
			<h3><?php echo ((isset($this->_rootref['L_UPDATE_STATUS'])) ? $this->_rootref['L_UPDATE_STATUS'] : ((isset($user->lang['UPDATE_STATUS'])) ? $user->lang['UPDATE_STATUS'] : '{ UPDATE_STATUS }')); ?></h3>
			<div class="bcontent">
				<div class="bubble down">
					<blockquote class="bubble_status">
						<?php if ($this->_rootref['S_USER_STATUS'] != ('')) {  echo (isset($this->_rootref['S_USER_STATUS'])) ? $this->_rootref['S_USER_STATUS'] : ''; } else { ?>&nbsp;<?php } ?>
					</blockquote>
					<cite>&nbsp;</cite>
				</div>
				<fieldset>
					<dl>
						<dt><label for="status_text"><?php echo ((isset($this->_rootref['L_UPDATE_STATUS'])) ? $this->_rootref['L_UPDATE_STATUS'] : ((isset($user->lang['UPDATE_STATUS'])) ? $user->lang['UPDATE_STATUS'] : '{ UPDATE_STATUS }')); ?></label></dt>
						<dd><input maxlength="1024" id="status_text" name="status_text" type="text" class="inputbox" /></dd>
					</dl>
					<p>
						<input name="add" type="submit" class="button2" disabled="disabled" value="<?php echo ((isset($this->_rootref['L_UPDATE_STATUS'])) ? $this->_rootref['L_UPDATE_STATUS'] : ((isset($user->lang['UPDATE_STATUS'])) ? $user->lang['UPDATE_STATUS'] : '{ UPDATE_STATUS }')); ?>" />
					<?php if ($this->_rootref['S_USER_STATUS'] != ('0')) {  ?>
						<input name="delete" type="submit" class="button2" value="<?php echo ((isset($this->_rootref['L_REMOVE'])) ? $this->_rootref['L_REMOVE'] : ((isset($user->lang['REMOVE'])) ? $user->lang['REMOVE'] : '{ REMOVE }')); ?>" />
					<?php } ?>
					</p>
				</fieldset>
			</div>
			<div class="overlay"></div>
			<div class="overlay-text add"><?php echo ((isset($this->_rootref['L_STATUS_ADDED'])) ? $this->_rootref['L_STATUS_ADDED'] : ((isset($user->lang['STATUS_ADDED'])) ? $user->lang['STATUS_ADDED'] : '{ STATUS_ADDED }')); ?></div>
			<div class="overlay-text delete"><?php echo ((isset($this->_rootref['L_STATUS_DELETED'])) ? $this->_rootref['L_STATUS_DELETED'] : ((isset($user->lang['STATUS_DELETED'])) ? $user->lang['STATUS_DELETED'] : '{ STATUS_DELETED }')); ?></div>
		</div>
	</div>
	<?php if ($this->_rootref['S_DISPLAY_PM']) {  ?>
	
	<div class="block-box" id="im-pms">
		<div class="button"><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/Mail<?php if ($this->_rootref['S_USER_UNREAD_PRIVMSG']) {  ?>_new<?php } ?>.png" width="24" height="24" alt="<?php echo ((isset($this->_rootref['L_PRIVATE_MESSAGE'])) ? $this->_rootref['L_PRIVATE_MESSAGE'] : ((isset($user->lang['PRIVATE_MESSAGE'])) ? $user->lang['PRIVATE_MESSAGE'] : '{ PRIVATE_MESSAGE }')); ?>" /></div>
		<div class="block">
			<h3><a href="<?php echo (isset($this->_rootref['U_PRIVATEMSGS'])) ? $this->_rootref['U_PRIVATEMSGS'] : ''; ?>"><?php echo (isset($this->_rootref['PRIVATE_MESSAGE_INFO'])) ? $this->_rootref['PRIVATE_MESSAGE_INFO'] : ''; ?></a></h3>
			<div class="bcontent links">
				<ul>
					<li><a href="<?php echo (isset($this->_rootref['U_COMPOSE_NEW'])) ? $this->_rootref['U_COMPOSE_NEW'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_COMPOSE_MESSAGE'])) ? $this->_rootref['L_COMPOSE_MESSAGE'] : ((isset($user->lang['COMPOSE_MESSAGE'])) ? $user->lang['COMPOSE_MESSAGE'] : '{ COMPOSE_MESSAGE }')); ?>">&raquo; <?php echo ((isset($this->_rootref['L_COMPOSE_MESSAGE'])) ? $this->_rootref['L_COMPOSE_MESSAGE'] : ((isset($user->lang['COMPOSE_MESSAGE'])) ? $user->lang['COMPOSE_MESSAGE'] : '{ COMPOSE_MESSAGE }')); ?></a></li>
					<li><a href="<?php echo (isset($this->_rootref['U_PRIVATEMSGS'])) ? $this->_rootref['U_PRIVATEMSGS'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_INBOX'])) ? $this->_rootref['L_INBOX'] : ((isset($user->lang['INBOX'])) ? $user->lang['INBOX'] : '{ INBOX }')); ?>">&raquo; <?php echo ((isset($this->_rootref['L_INBOX'])) ? $this->_rootref['L_INBOX'] : ((isset($user->lang['INBOX'])) ? $user->lang['INBOX'] : '{ INBOX }')); ?></a></li>                    
					<li><a href="<?php echo (isset($this->_rootref['U_OUTBOX'])) ? $this->_rootref['U_OUTBOX'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_OUTBOX'])) ? $this->_rootref['L_OUTBOX'] : ((isset($user->lang['OUTBOX'])) ? $user->lang['OUTBOX'] : '{ OUTBOX }')); ?>">&raquo; <?php echo ((isset($this->_rootref['L_OUTBOX'])) ? $this->_rootref['L_OUTBOX'] : ((isset($user->lang['OUTBOX'])) ? $user->lang['OUTBOX'] : '{ OUTBOX }')); ?></a></li>
					<li><a href="<?php echo (isset($this->_rootref['U_SENT_MESSAGES'])) ? $this->_rootref['U_SENT_MESSAGES'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_SENT_MESSAGES'])) ? $this->_rootref['L_SENT_MESSAGES'] : ((isset($user->lang['SENT_MESSAGES'])) ? $user->lang['SENT_MESSAGES'] : '{ SENT_MESSAGES }')); ?>">&raquo; <?php echo ((isset($this->_rootref['L_SENT_MESSAGES'])) ? $this->_rootref['L_SENT_MESSAGES'] : ((isset($user->lang['SENT_MESSAGES'])) ? $user->lang['SENT_MESSAGES'] : '{ SENT_MESSAGES }')); ?></a></li>
				</ul>
			</div>
		</div>
	</div>
	<?php } ?>
	
	<div class="block-box" id="im-news">
		<div class="button"><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/News.png" width="24" height="24" alt="<?php echo ((isset($this->_rootref['L_POSTS'])) ? $this->_rootref['L_POSTS'] : ((isset($user->lang['POSTS'])) ? $user->lang['POSTS'] : '{ POSTS }')); ?>" /></div>
		<div class="block">
			<h3><a href="<?php echo (isset($this->_rootref['U_SEARCH_NEW'])) ? $this->_rootref['U_SEARCH_NEW'] : ''; ?>"><?php echo ((isset($this->_rootref['L_SEARCH_NEW'])) ? $this->_rootref['L_SEARCH_NEW'] : ((isset($user->lang['SEARCH_NEW'])) ? $user->lang['SEARCH_NEW'] : '{ SEARCH_NEW }')); ?></a></h3>
			<div class="bcontent links">
				<ul></ul>
			</div>
		</div>
	</div>
	
	<div class="block-box" id="im-search">
		<div class="button"><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/Glass.png" width="24" height="24" alt="<?php echo ((isset($this->_rootref['L_SEARCH'])) ? $this->_rootref['L_SEARCH'] : ((isset($user->lang['SEARCH'])) ? $user->lang['SEARCH'] : '{ SEARCH }')); ?>" /></div>
		<div class="block">
			<h3><?php echo ((isset($this->_rootref['L_SEARCH'])) ? $this->_rootref['L_SEARCH'] : ((isset($user->lang['SEARCH'])) ? $user->lang['SEARCH'] : '{ SEARCH }')); ?></h3>
			<div class="bcontent">
				<form method="get" action="http://www.google.com/search">
					<fieldset>
						<dl>
							<dt>
								<input type="text" name="q" maxlength="128" class="inputbox search" value="<?php echo ((isset($this->_rootref['L_GOOGLE_SEARCH'])) ? $this->_rootref['L_GOOGLE_SEARCH'] : ((isset($user->lang['GOOGLE_SEARCH'])) ? $user->lang['GOOGLE_SEARCH'] : '{ GOOGLE_SEARCH }')); ?>" onclick="if(this.value=='<?php echo ((isset($this->_rootref['L_GOOGLE_SEARCH'])) ? $this->_rootref['L_GOOGLE_SEARCH'] : ((isset($user->lang['GOOGLE_SEARCH'])) ? $user->lang['GOOGLE_SEARCH'] : '{ GOOGLE_SEARCH }')); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo ((isset($this->_rootref['L_GOOGLE_SEARCH'])) ? $this->_rootref['L_GOOGLE_SEARCH'] : ((isset($user->lang['GOOGLE_SEARCH'])) ? $user->lang['GOOGLE_SEARCH'] : '{ GOOGLE_SEARCH }')); ?>';" />
							</dt>
						</dl>
						<p>
							<input type="submit" value="<?php echo ((isset($this->_rootref['L_GOOGLE_SEARCH'])) ? $this->_rootref['L_GOOGLE_SEARCH'] : ((isset($user->lang['GOOGLE_SEARCH'])) ? $user->lang['GOOGLE_SEARCH'] : '{ GOOGLE_SEARCH }')); ?>" class="button2" style="margin-bottom:3px;" />
							<input type="radio" name="sitesearch" value="<?php echo (isset($this->_rootref['S_SERVER_NAME'])) ? $this->_rootref['S_SERVER_NAME'] : ''; ?>" style="display:none" checked="checked" />
						</p>
					</fieldset>
				</form>
			<?php if ($this->_rootref['S_DISPLAY_SEARCH'] && ! $this->_rootref['S_IN_SEARCH']) {  ?>
				<form action="<?php echo (isset($this->_rootref['U_SEARCH'])) ? $this->_rootref['U_SEARCH'] : ''; ?>" method="post" id="search">
					<fieldset>
						<dl>
							<dt>
								<input name="keywords" type="text" maxlength="128" class="inputbox search" value="<?php echo ((isset($this->_rootref['L_BOARD_SEARCH'])) ? $this->_rootref['L_BOARD_SEARCH'] : ((isset($user->lang['BOARD_SEARCH'])) ? $user->lang['BOARD_SEARCH'] : '{ BOARD_SEARCH }')); ?>" onclick="if(this.value=='<?php echo ((isset($this->_rootref['L_BOARD_SEARCH'])) ? $this->_rootref['L_BOARD_SEARCH'] : ((isset($user->lang['BOARD_SEARCH'])) ? $user->lang['BOARD_SEARCH'] : '{ BOARD_SEARCH }')); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo ((isset($this->_rootref['L_BOARD_SEARCH'])) ? $this->_rootref['L_BOARD_SEARCH'] : ((isset($user->lang['BOARD_SEARCH'])) ? $user->lang['BOARD_SEARCH'] : '{ BOARD_SEARCH }')); ?>';" />
							</dt>
						</dl>
						<p>
							<input class="button2" value="<?php echo ((isset($this->_rootref['L_BOARD_SEARCH'])) ? $this->_rootref['L_BOARD_SEARCH'] : ((isset($user->lang['BOARD_SEARCH'])) ? $user->lang['BOARD_SEARCH'] : '{ BOARD_SEARCH }')); ?>" type="submit" />
							<?php echo (isset($this->_rootref['S_SEARCH_HIDDEN_FIELDS'])) ? $this->_rootref['S_SEARCH_HIDDEN_FIELDS'] : ''; ?>
						</p>
					</fieldset>
				</form>
			<?php } ?>
			</div>
		</div>
	</div>
	
	<div class="block-box rightside" id="im-online-list">
		<div class="button"><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/im_list_<?php if ($this->_rootref['S_REG_USERS_ONLINE'] != ('0')) {  ?>online<?php } else { ?>offline<?php } ?>.gif" alt="<?php echo ((isset($this->_rootref['L_IM'])) ? $this->_rootref['L_IM'] : ((isset($user->lang['IM'])) ? $user->lang['IM'] : '{ IM }')); ?>" /> <?php echo ((isset($this->_rootref['L_IM'])) ? $this->_rootref['L_IM'] : ((isset($user->lang['IM'])) ? $user->lang['IM'] : '{ IM }')); ?> (<strong><?php echo (isset($this->_rootref['S_REG_USERS_ONLINE'])) ? $this->_rootref['S_REG_USERS_ONLINE'] : ''; ?></strong>)</div>
		<div class="block">
			<h3><?php echo ((isset($this->_rootref['L_ONLINE'])) ? $this->_rootref['L_ONLINE'] : ((isset($user->lang['ONLINE'])) ? $user->lang['ONLINE'] : '{ ONLINE }')); ?></h3>
			<div class="bcontent links">
				<ul></ul>
			</div>
		</div>
	</div>
<?php } ?>

  <!--[if lt IE 7 ]>
  	<div class="block-box rightside" id="im-browser-update">
  		<div class="button"><?php echo ((isset($this->_rootref['L_IM_UPDATE_BROSWER'])) ? $this->_rootref['L_IM_UPDATE_BROSWER'] : ((isset($user->lang['IM_UPDATE_BROSWER'])) ? $user->lang['IM_UPDATE_BROSWER'] : '{ IM_UPDATE_BROSWER }')); ?></div>
  		<div class="block" style="width:500px !important;">
  			<h3><?php echo ((isset($this->_rootref['L_IM_UPDATE_BROSWER'])) ? $this->_rootref['L_IM_UPDATE_BROSWER'] : ((isset($user->lang['IM_UPDATE_BROSWER'])) ? $user->lang['IM_UPDATE_BROSWER'] : '{ IM_UPDATE_BROSWER }')); ?></h3>
  			<div class="bcontent" style="width:500px !important;height:300px;display: block;overflow-x:scroll;overflow-y:hidden;">
  				<?php $this->_tpl_include('instant_messenger_update_browser.html'); ?>
  			</div>
  		</div>
  	</div>
  <script type="text/javascript">
  	function move_bottom_bar()
  	{
  		var element1 = document.getElementById('site-bottom-bar');
  		var element2 = document.getElementById('site-bottom-bar-frame');
  		var offset = document.documentElement.offsetHeight - element1.offsetHeight - 3;
  		
  		element1.style.top = (document.documentElement.scrollTop + offset) + 'px';
  		element2.style.top = (document.documentElement.scrollTop + offset) + 'px';
  		
  		setTimeout( 'move_bottom_bar()', 200);
  	}
  	
  	$(document).ready( function(){
  		move_bottom_bar();
  	});
  	
  </script>
  <![endif]-->
  
  <a id="im_msg_arrived" href="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>styles/instant_messenger/im-new-message.mp3" style="display:none"></a> 
</div>