<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('overall_header.html'); ?>

<div id="center">
	<div id="profile">
		<form method="post" action="<?php echo (isset($this->_rootref['S_PROFILE_ACTION'])) ? $this->_rootref['S_PROFILE_ACTION'] : ''; ?>" id="viewprofile">
		<div id="profile-sidebar">
			
			<div class="pro-box <?php if ($this->_rootref['S_ONLINE']) {  ?> online<?php } ?>">
				<h2 class="pro-header">
					<div class="dropdown">
						<span><a class="username-coloured <?php if ($this->_rootref['S_IS_BANNED']) {  ?>banned<?php } ?>" <?php if ($this->_rootref['USER_COLOR']) {  ?>style="color: <?php echo (isset($this->_rootref['USER_COLOR'])) ? $this->_rootref['USER_COLOR'] : ''; ?>;"<?php } ?>><?php echo (isset($this->_rootref['USERNAME'])) ? $this->_rootref['USERNAME'] : ''; ?></a> <img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/dropdown_arrow.png" alt="Arrow" /></span>
						<ul>
							<?php if ($this->_rootref['U_USER_ADMIN']) {  ?><li><a href="<?php echo (isset($this->_rootref['U_USER_ADMIN'])) ? $this->_rootref['U_USER_ADMIN'] : ''; ?>"><?php echo ((isset($this->_rootref['L_USER_ADMIN'])) ? $this->_rootref['L_USER_ADMIN'] : ((isset($user->lang['USER_ADMIN'])) ? $user->lang['USER_ADMIN'] : '{ USER_ADMIN }')); ?></a></li><?php } if ($this->_rootref['U_USER_BAN']) {  ?><li><a href="<?php echo (isset($this->_rootref['U_USER_BAN'])) ? $this->_rootref['U_USER_BAN'] : ''; ?>"><?php echo ((isset($this->_rootref['L_USER_BAN'])) ? $this->_rootref['L_USER_BAN'] : ((isset($user->lang['USER_BAN'])) ? $user->lang['USER_BAN'] : '{ USER_BAN }')); ?></a></li><?php } if ($this->_rootref['U_SWITCH_PERMISSIONS']) {  ?><li><a href="<?php echo (isset($this->_rootref['U_SWITCH_PERMISSIONS'])) ? $this->_rootref['U_SWITCH_PERMISSIONS'] : ''; ?>"><?php echo ((isset($this->_rootref['L_USE_PERMISSIONS'])) ? $this->_rootref['L_USE_PERMISSIONS'] : ((isset($user->lang['USE_PERMISSIONS'])) ? $user->lang['USE_PERMISSIONS'] : '{ USE_PERMISSIONS }')); ?></a></li><?php } ?>

						</ul>
					</div>
				</h2>
				<div class="inner">
				
				<dl>
					<dt class="center"><?php if ($this->_rootref['AVATAR_IMG']) {  echo (isset($this->_rootref['AVATAR_IMG'])) ? $this->_rootref['AVATAR_IMG'] : ''; } else { ?><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/no-avatar.png" height="100px" width="100px" alt="Default Avatar" /><?php } ?></dt>
					<?php $_custom_fields_count = (isset($this->_tpldata['custom_fields'])) ? sizeof($this->_tpldata['custom_fields']) : 0;if ($_custom_fields_count) {for ($_custom_fields_i = 0; $_custom_fields_i < $_custom_fields_count; ++$_custom_fields_i){$_custom_fields_val = &$this->_tpldata['custom_fields'][$_custom_fields_i]; if ($_custom_fields_val['PROFILE_FIELD_NAME'] == ("Custom Title")) {  ?><dd class="center"><?php echo $_custom_fields_val['PROFILE_FIELD_VALUE']; ?></dd><?php } }} ?>

				</dl>
			
				<dl class="details">
					<?php if ($this->_rootref['RANK_TITLE']) {  ?><dt><?php echo ((isset($this->_rootref['L_RANK'])) ? $this->_rootref['L_RANK'] : ((isset($user->lang['RANK'])) ? $user->lang['RANK'] : '{ RANK }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['RANK_TITLE'])) ? $this->_rootref['RANK_TITLE'] : ''; ?></dd><?php } if ($this->_rootref['RANK_IMG']) {  ?><dt><?php if ($this->_rootref['RANK_TITLE']) {  ?>&nbsp;<?php } else { echo ((isset($this->_rootref['L_RANK'])) ? $this->_rootref['L_RANK'] : ((isset($user->lang['RANK'])) ? $user->lang['RANK'] : '{ RANK }')); ?>:<?php } ?></dt> <dd><?php echo (isset($this->_rootref['RANK_IMG'])) ? $this->_rootref['RANK_IMG'] : ''; ?></dd><?php } if ($this->_rootref['S_USER_INACTIVE']) {  ?><dt><?php echo ((isset($this->_rootref['L_USER_IS_INACTIVE'])) ? $this->_rootref['L_USER_IS_INACTIVE'] : ((isset($user->lang['USER_IS_INACTIVE'])) ? $user->lang['USER_IS_INACTIVE'] : '{ USER_IS_INACTIVE }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['USER_INACTIVE_REASON'])) ? $this->_rootref['USER_INACTIVE_REASON'] : ''; ?></dd><?php } if ($this->_rootref['LOCATION']) {  ?><dt><?php echo ((isset($this->_rootref['L_LOCATION'])) ? $this->_rootref['L_LOCATION'] : ((isset($user->lang['LOCATION'])) ? $user->lang['LOCATION'] : '{ LOCATION }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['LOCATION'])) ? $this->_rootref['LOCATION'] : ''; ?></dd><?php } if ($this->_rootref['AGE']) {  ?><dt><?php echo ((isset($this->_rootref['L_AGE'])) ? $this->_rootref['L_AGE'] : ((isset($user->lang['AGE'])) ? $user->lang['AGE'] : '{ AGE }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['AGE'])) ? $this->_rootref['AGE'] : ''; ?></dd><?php } if ($this->_rootref['OCCUPATION']) {  ?><dt><?php echo ((isset($this->_rootref['L_OCCUPATION'])) ? $this->_rootref['L_OCCUPATION'] : ((isset($user->lang['OCCUPATION'])) ? $user->lang['OCCUPATION'] : '{ OCCUPATION }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['OCCUPATION'])) ? $this->_rootref['OCCUPATION'] : ''; ?></dd><?php } if ($this->_rootref['INTERESTS']) {  ?><dt><?php echo ((isset($this->_rootref['L_INTERESTS'])) ? $this->_rootref['L_INTERESTS'] : ((isset($user->lang['INTERESTS'])) ? $user->lang['INTERESTS'] : '{ INTERESTS }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['INTERESTS'])) ? $this->_rootref['INTERESTS'] : ''; ?></dd><?php } if ($this->_rootref['S_GROUP_OPTIONS']) {  ?><dt><?php echo ((isset($this->_rootref['L_USERGROUPS'])) ? $this->_rootref['L_USERGROUPS'] : ((isset($user->lang['USERGROUPS'])) ? $user->lang['USERGROUPS'] : '{ USERGROUPS }')); ?>:</dt> <dd><select name="g"><?php echo (isset($this->_rootref['S_GROUP_OPTIONS'])) ? $this->_rootref['S_GROUP_OPTIONS'] : ''; ?></select> <input type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" class="button2" /></dd><?php } $_custom_fields_count = (isset($this->_tpldata['custom_fields'])) ? sizeof($this->_tpldata['custom_fields']) : 0;if ($_custom_fields_count) {for ($_custom_fields_i = 0; $_custom_fields_i < $_custom_fields_count; ++$_custom_fields_i){$_custom_fields_val = &$this->_tpldata['custom_fields'][$_custom_fields_i]; ?><dt><?php echo $_custom_fields_val['PROFILE_FIELD_NAME']; ?>:</dt> <dd><?php echo $_custom_fields_val['PROFILE_FIELD_VALUE']; ?></dd><?php }} ?>

					
				</dl>
			
				</div>
			</div>
				
			<div class="pro-box">
				<h3 class="pro-header"><?php echo ((isset($this->_rootref['L_STATISTICS'])) ? $this->_rootref['L_STATISTICS'] : ((isset($user->lang['STATISTICS'])) ? $user->lang['STATISTICS'] : '{ STATISTICS }')); ?></h3>
				<div class="inner">
		
				<dl class="details">
					<dt><?php echo ((isset($this->_rootref['L_JOINED'])) ? $this->_rootref['L_JOINED'] : ((isset($user->lang['JOINED'])) ? $user->lang['JOINED'] : '{ JOINED }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['JOINED'])) ? $this->_rootref['JOINED'] : ''; ?></dd>
					<dt><?php echo ((isset($this->_rootref['L_VISITED'])) ? $this->_rootref['L_VISITED'] : ((isset($user->lang['VISITED'])) ? $user->lang['VISITED'] : '{ VISITED }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['VISITED'])) ? $this->_rootref['VISITED'] : ''; ?></dd>
					<?php if ($this->_rootref['S_WARNINGS']) {  ?>

					<dt><?php echo ((isset($this->_rootref['L_WARNINGS'])) ? $this->_rootref['L_WARNINGS'] : ((isset($user->lang['WARNINGS'])) ? $user->lang['WARNINGS'] : '{ WARNINGS }')); ?>: </dt>
					<dd><strong><?php echo (isset($this->_rootref['WARNINGS'])) ? $this->_rootref['WARNINGS'] : ''; ?></strong><?php if ($this->_rootref['U_NOTES'] || $this->_rootref['U_WARN']) {  ?> [ <?php if ($this->_rootref['U_NOTES']) {  ?><a href="<?php echo (isset($this->_rootref['U_NOTES'])) ? $this->_rootref['U_NOTES'] : ''; ?>"><?php echo ((isset($this->_rootref['L_VIEW_NOTES'])) ? $this->_rootref['L_VIEW_NOTES'] : ((isset($user->lang['VIEW_NOTES'])) ? $user->lang['VIEW_NOTES'] : '{ VIEW_NOTES }')); ?></a><?php } if ($this->_rootref['U_WARN']) {  if ($this->_rootref['U_NOTES']) {  ?> | <?php } ?><a href="<?php echo (isset($this->_rootref['U_WARN'])) ? $this->_rootref['U_WARN'] : ''; ?>"><?php echo ((isset($this->_rootref['L_WARN_USER'])) ? $this->_rootref['L_WARN_USER'] : ((isset($user->lang['WARN_USER'])) ? $user->lang['WARN_USER'] : '{ WARN_USER }')); ?></a><?php } ?> ]<?php } ?></dd>
					<?php } ?>

					<dt><?php echo ((isset($this->_rootref['L_TOTAL_POSTS'])) ? $this->_rootref['L_TOTAL_POSTS'] : ((isset($user->lang['TOTAL_POSTS'])) ? $user->lang['TOTAL_POSTS'] : '{ TOTAL_POSTS }')); ?>:</dt>
						<dd><?php echo (isset($this->_rootref['POSTS'])) ? $this->_rootref['POSTS'] : ''; ?> <?php if ($this->_rootref['S_DISPLAY_SEARCH']) {  ?>| <strong><a href="<?php echo (isset($this->_rootref['U_SEARCH_USER'])) ? $this->_rootref['U_SEARCH_USER'] : ''; ?>"><?php echo ((isset($this->_rootref['L_SEARCH_USER_POSTS'])) ? $this->_rootref['L_SEARCH_USER_POSTS'] : ((isset($user->lang['SEARCH_USER_POSTS'])) ? $user->lang['SEARCH_USER_POSTS'] : '{ SEARCH_USER_POSTS }')); ?></a></strong><?php } if ($this->_rootref['POSTS_PCT']) {  ?><br />(<?php echo (isset($this->_rootref['POSTS_PCT'])) ? $this->_rootref['POSTS_PCT'] : ''; ?> / <?php echo (isset($this->_rootref['POSTS_DAY'])) ? $this->_rootref['POSTS_DAY'] : ''; ?>)<?php } if ($this->_rootref['POSTS_IN_QUEUE'] && $this->_rootref['U_MCP_QUEUE']) {  ?><br />(<a href="<?php echo (isset($this->_rootref['U_MCP_QUEUE'])) ? $this->_rootref['U_MCP_QUEUE'] : ''; ?>"><?php echo ((isset($this->_rootref['L_POSTS_IN_QUEUE'])) ? $this->_rootref['L_POSTS_IN_QUEUE'] : ((isset($user->lang['POSTS_IN_QUEUE'])) ? $user->lang['POSTS_IN_QUEUE'] : '{ POSTS_IN_QUEUE }')); ?></a>)<?php } else if ($this->_rootref['POSTS_IN_QUEUE']) {  ?><br />(<?php echo ((isset($this->_rootref['L_POSTS_IN_QUEUE'])) ? $this->_rootref['L_POSTS_IN_QUEUE'] : ((isset($user->lang['POSTS_IN_QUEUE'])) ? $user->lang['POSTS_IN_QUEUE'] : '{ POSTS_IN_QUEUE }')); ?>)<?php } ?>

						</dd>
						<?php if ($this->_rootref['S_REPUTATION']) {  ?>

						<dt><?php echo ((isset($this->_rootref['L_RP_TOTAL_POINTS'])) ? $this->_rootref['L_RP_TOTAL_POINTS'] : ((isset($user->lang['RP_TOTAL_POINTS'])) ? $user->lang['RP_TOTAL_POINTS'] : '{ RP_TOTAL_POINTS }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['REPUTATION'])) ? $this->_rootref['REPUTATION'] : ''; ?></dd>
						<dt><?php echo ((isset($this->_rootref['L_RP_POWER'])) ? $this->_rootref['L_RP_POWER'] : ((isset($user->lang['RP_POWER'])) ? $user->lang['RP_POWER'] : '{ RP_POWER }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['REP_POWER'])) ? $this->_rootref['REP_POWER'] : ''; ?></dd>
						<?php } if ($this->_rootref['S_SHOW_ACTIVITY'] && $this->_rootref['POSTS']) {  ?>

						<dt><?php echo ((isset($this->_rootref['L_ACTIVE_IN_FORUM'])) ? $this->_rootref['L_ACTIVE_IN_FORUM'] : ((isset($user->lang['ACTIVE_IN_FORUM'])) ? $user->lang['ACTIVE_IN_FORUM'] : '{ ACTIVE_IN_FORUM }')); ?>:</dt> <dd><?php if ($this->_rootref['ACTIVE_FORUM']) {  ?><strong><a href="<?php echo (isset($this->_rootref['U_ACTIVE_FORUM'])) ? $this->_rootref['U_ACTIVE_FORUM'] : ''; ?>"><?php echo (isset($this->_rootref['ACTIVE_FORUM'])) ? $this->_rootref['ACTIVE_FORUM'] : ''; ?></a></strong><br />(<?php echo (isset($this->_rootref['ACTIVE_FORUM_POSTS'])) ? $this->_rootref['ACTIVE_FORUM_POSTS'] : ''; ?> / <?php echo (isset($this->_rootref['ACTIVE_FORUM_PCT'])) ? $this->_rootref['ACTIVE_FORUM_PCT'] : ''; ?>)<?php } else { ?> - <?php } ?></dd>
						<dt><?php echo ((isset($this->_rootref['L_ACTIVE_IN_TOPIC'])) ? $this->_rootref['L_ACTIVE_IN_TOPIC'] : ((isset($user->lang['ACTIVE_IN_TOPIC'])) ? $user->lang['ACTIVE_IN_TOPIC'] : '{ ACTIVE_IN_TOPIC }')); ?>:</dt> <dd><?php if ($this->_rootref['ACTIVE_TOPIC']) {  ?><strong><a href="<?php echo (isset($this->_rootref['U_ACTIVE_TOPIC'])) ? $this->_rootref['U_ACTIVE_TOPIC'] : ''; ?>"><?php echo (isset($this->_rootref['ACTIVE_TOPIC'])) ? $this->_rootref['ACTIVE_TOPIC'] : ''; ?></a></strong><br />(<?php echo (isset($this->_rootref['ACTIVE_TOPIC_POSTS'])) ? $this->_rootref['ACTIVE_TOPIC_POSTS'] : ''; ?> / <?php echo (isset($this->_rootref['ACTIVE_TOPIC_PCT'])) ? $this->_rootref['ACTIVE_TOPIC_PCT'] : ''; ?>)<?php } else { ?> - <?php } ?></dd>
					<?php } ?>

				</dl>
				
				</div>
			</div>
			
			<div class="pro-box">
				<h3 class="pro-header"><?php echo ((isset($this->_rootref['L_CONTACT_USER'])) ? $this->_rootref['L_CONTACT_USER'] : ((isset($user->lang['CONTACT_USER'])) ? $user->lang['CONTACT_USER'] : '{ CONTACT_USER }')); ?></h3>	
				<div class="inner">
			
					<dl class="details">
					<?php if ($this->_rootref['U_EMAIL']) {  ?><dt><?php echo ((isset($this->_rootref['L_EMAIL_ADDRESS'])) ? $this->_rootref['L_EMAIL_ADDRESS'] : ((isset($user->lang['EMAIL_ADDRESS'])) ? $user->lang['EMAIL_ADDRESS'] : '{ EMAIL_ADDRESS }')); ?>:</dt> <dd><a href="<?php echo (isset($this->_rootref['U_EMAIL'])) ? $this->_rootref['U_EMAIL'] : ''; ?>"><?php echo ((isset($this->_rootref['L_SEND_EMAIL_USER'])) ? $this->_rootref['L_SEND_EMAIL_USER'] : ((isset($user->lang['SEND_EMAIL_USER'])) ? $user->lang['SEND_EMAIL_USER'] : '{ SEND_EMAIL_USER }')); ?> <?php echo (isset($this->_rootref['USERNAME'])) ? $this->_rootref['USERNAME'] : ''; ?></a></dd><?php } if ($this->_rootref['U_WWW']) {  ?><dt><?php echo ((isset($this->_rootref['L_WEBSITE'])) ? $this->_rootref['L_WEBSITE'] : ((isset($user->lang['WEBSITE'])) ? $user->lang['WEBSITE'] : '{ WEBSITE }')); ?>:</dt> <dd><a href="<?php echo (isset($this->_rootref['U_WWW'])) ? $this->_rootref['U_WWW'] : ''; ?>" title="<?php echo ((isset($this->_rootref['L_VISIT_WEBSITE'])) ? $this->_rootref['L_VISIT_WEBSITE'] : ((isset($user->lang['VISIT_WEBSITE'])) ? $user->lang['VISIT_WEBSITE'] : '{ VISIT_WEBSITE }')); ?>: <?php echo (isset($this->_rootref['U_WWW'])) ? $this->_rootref['U_WWW'] : ''; ?>"><?php echo (isset($this->_rootref['U_WWW'])) ? $this->_rootref['U_WWW'] : ''; ?></a></dd><?php } if ($this->_rootref['U_PM']) {  ?><dt><?php echo ((isset($this->_rootref['L_PM'])) ? $this->_rootref['L_PM'] : ((isset($user->lang['PM'])) ? $user->lang['PM'] : '{ PM }')); ?>:</dt> <dd><a href="<?php echo (isset($this->_rootref['U_PM'])) ? $this->_rootref['U_PM'] : ''; ?>"><?php echo ((isset($this->_rootref['L_SEND_PRIVATE_MESSAGE'])) ? $this->_rootref['L_SEND_PRIVATE_MESSAGE'] : ((isset($user->lang['SEND_PRIVATE_MESSAGE'])) ? $user->lang['SEND_PRIVATE_MESSAGE'] : '{ SEND_PRIVATE_MESSAGE }')); ?></a></dd>
					<?php } if ($this->_rootref['U_MSN'] || $this->_rootref['USER_MSN']) {  ?><dt><?php echo ((isset($this->_rootref['L_MSNM'])) ? $this->_rootref['L_MSNM'] : ((isset($user->lang['MSNM'])) ? $user->lang['MSNM'] : '{ MSNM }')); ?>:</dt> <dd><?php if ($this->_rootref['U_MSN']) {  ?><a href="<?php echo (isset($this->_rootref['U_MSN'])) ? $this->_rootref['U_MSN'] : ''; ?>" onclick="popup(this.href, 550, 320); return false;"><?php echo ((isset($this->_rootref['L_SEND_MSNM_MESSAGE'])) ? $this->_rootref['L_SEND_MSNM_MESSAGE'] : ((isset($user->lang['SEND_MSNM_MESSAGE'])) ? $user->lang['SEND_MSNM_MESSAGE'] : '{ SEND_MSNM_MESSAGE }')); ?></a><?php } else { echo (isset($this->_rootref['USER_MSN'])) ? $this->_rootref['USER_MSN'] : ''; } ?></dd><?php } if ($this->_rootref['U_YIM'] || $this->_rootref['USER_YIM']) {  ?><dt><?php echo ((isset($this->_rootref['L_YIM'])) ? $this->_rootref['L_YIM'] : ((isset($user->lang['YIM'])) ? $user->lang['YIM'] : '{ YIM }')); ?>:</dt> <dd><?php if ($this->_rootref['U_YIM']) {  ?><a href="<?php echo (isset($this->_rootref['U_YIM'])) ? $this->_rootref['U_YIM'] : ''; ?>" onclick="popup(this.href, 780, 550); return false;"><?php echo ((isset($this->_rootref['L_SEND_YIM_MESSAGE'])) ? $this->_rootref['L_SEND_YIM_MESSAGE'] : ((isset($user->lang['SEND_YIM_MESSAGE'])) ? $user->lang['SEND_YIM_MESSAGE'] : '{ SEND_YIM_MESSAGE }')); ?></a><?php } else { echo (isset($this->_rootref['USER_YIM'])) ? $this->_rootref['USER_YIM'] : ''; } ?></dd><?php } if ($this->_rootref['U_AIM'] || $this->_rootref['USER_AIM']) {  ?><dt><?php echo ((isset($this->_rootref['L_AIM'])) ? $this->_rootref['L_AIM'] : ((isset($user->lang['AIM'])) ? $user->lang['AIM'] : '{ AIM }')); ?>:</dt> <dd><?php if ($this->_rootref['U_AIM']) {  ?><a href="<?php echo (isset($this->_rootref['U_AIM'])) ? $this->_rootref['U_AIM'] : ''; ?>" onclick="popup(this.href, 550, 320); return false;"><?php echo ((isset($this->_rootref['L_SEND_AIM_MESSAGE'])) ? $this->_rootref['L_SEND_AIM_MESSAGE'] : ((isset($user->lang['SEND_AIM_MESSAGE'])) ? $user->lang['SEND_AIM_MESSAGE'] : '{ SEND_AIM_MESSAGE }')); ?></a><?php } else { echo (isset($this->_rootref['USER_AIM'])) ? $this->_rootref['USER_AIM'] : ''; } ?></dd><?php } if ($this->_rootref['U_ICQ'] || $this->_rootref['USER_ICQ']) {  ?><dt><?php echo ((isset($this->_rootref['L_ICQ'])) ? $this->_rootref['L_ICQ'] : ((isset($user->lang['ICQ'])) ? $user->lang['ICQ'] : '{ ICQ }')); ?>:</dt> <dd><?php if ($this->_rootref['U_ICQ']) {  ?><a href="<?php echo (isset($this->_rootref['U_ICQ'])) ? $this->_rootref['U_ICQ'] : ''; ?>" onclick="popup(this.href, 550, 320); return false;"><?php echo ((isset($this->_rootref['L_SEND_ICQ_MESSAGE'])) ? $this->_rootref['L_SEND_ICQ_MESSAGE'] : ((isset($user->lang['SEND_ICQ_MESSAGE'])) ? $user->lang['SEND_ICQ_MESSAGE'] : '{ SEND_ICQ_MESSAGE }')); ?></a><?php } else { echo (isset($this->_rootref['USER_ICQ'])) ? $this->_rootref['USER_ICQ'] : ''; } ?></dd><?php } if ($this->_rootref['U_JABBER'] && $this->_rootref['S_JABBER_ENABLED']) {  ?><dt><?php echo ((isset($this->_rootref['L_JABBER'])) ? $this->_rootref['L_JABBER'] : ((isset($user->lang['JABBER'])) ? $user->lang['JABBER'] : '{ JABBER }')); ?>:</dt> <dd><a href="<?php echo (isset($this->_rootref['U_JABBER'])) ? $this->_rootref['U_JABBER'] : ''; ?>" onclick="popup(this.href, 550, 320); return false;"><?php echo ((isset($this->_rootref['L_SEND_JABBER_MESSAGE'])) ? $this->_rootref['L_SEND_JABBER_MESSAGE'] : ((isset($user->lang['SEND_JABBER_MESSAGE'])) ? $user->lang['SEND_JABBER_MESSAGE'] : '{ SEND_JABBER_MESSAGE }')); ?></a></dd><?php } else if ($this->_rootref['USER_JABBER']) {  ?><dt><?php echo ((isset($this->_rootref['L_JABBER'])) ? $this->_rootref['L_JABBER'] : ((isset($user->lang['JABBER'])) ? $user->lang['JABBER'] : '{ JABBER }')); ?>:</dt> <dd><?php echo (isset($this->_rootref['USER_JABBER'])) ? $this->_rootref['USER_JABBER'] : ''; ?></dd><?php } if ($this->_rootref['S_PROFILE_FIELD_1']) {  ?><!-- NOTE: Use a construct like this to include admin defined profile fields. Replace FIELD1 with the name of your field. -->
						<dt><?php echo $_postrow_val['PROFILE_FIELD1_NAME']; ?>:</dt> <dd><?php echo $_postrow_val['PROFILE_FIELD1_VALUE']; ?></dd>
					<?php } ?>

					</dl>
				
				</div>
			</div>
		</div>
		</form>
		
		<div id="profile-body">
			
		<?php if (! $this->_rootref['S_NO_FRIENDS']) {  ?>

		<div id="pro-friends" class="pro-box">
			<h3 class="pro-header"><?php echo ((isset($this->_rootref['L_FRIEND_LIST'])) ? $this->_rootref['L_FRIEND_LIST'] : ((isset($user->lang['FRIEND_LIST'])) ? $user->lang['FRIEND_LIST'] : '{ FRIEND_LIST }')); ?>&nbsp;(<a href="<?php echo (isset($this->_rootref['U_VIEW_ALL'])) ? $this->_rootref['U_VIEW_ALL'] : ''; ?>"><?php echo ((isset($this->_rootref['L_VIEW_ALL'])) ? $this->_rootref['L_VIEW_ALL'] : ((isset($user->lang['VIEW_ALL'])) ? $user->lang['VIEW_ALL'] : '{ VIEW_ALL }')); ?></a>)</h3>
			<div class="inner">
				<?php $_fri_count = (isset($this->_tpldata['fri'])) ? sizeof($this->_tpldata['fri']) : 0;if ($_fri_count) {for ($_fri_i = 0; $_fri_i < $_fri_count; ++$_fri_i){$_fri_val = &$this->_tpldata['fri'][$_fri_i]; ?>

				<div class="friend">
					<a class="thumbnail" href="<?php echo $_fri_val['AV_LINK']; ?>" style="text-decoration:none">
						<span><?php if ($_fri_val['USER_COLOR']) {  ?><b style="color:#<?php echo $_fri_val['USER_COLOR']; ?>"> <?php } else { ?><b style="color:#000;"><?php } echo $_fri_val['USERNAME']; ?></b><?php if ($_fri_val['ONLINE_USER']) {  ?>(<strong><?php echo ((isset($this->_rootref['L_ONLINE'])) ? $this->_rootref['L_ONLINE'] : ((isset($user->lang['ONLINE'])) ? $user->lang['ONLINE'] : '{ ONLINE }')); ?></strong>)<?php } ?>

						<br /><?php if ($_fri_val['FRI_AV']) {  ?></span><?php echo $_fri_val['FRI_AV_THUMB']; ?> <?php } else { ?></span><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/no-avatar.png" height="<?php echo $_fri_val['WIDTH']; ?>" width="<?php echo $_fri_val['WIDTH']; ?>" alt="Default Avatar" /><?php } ?>

					</a>
				</div>
				<?php }} ?>

				
			<ul class="linklist">
			    <li class="rightside pagination"><?php echo (isset($this->_rootref['TOTAL_FRIENDS'])) ? $this->_rootref['TOTAL_FRIENDS'] : ''; ?> &bull; <?php if ($this->_rootref['FRINATION']) {  ?><a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER_F'])) ? $this->_rootref['PAGE_NUMBER_F'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['FRINATION'])) ? $this->_rootref['FRINATION'] : ''; ?></span><?php } else { echo (isset($this->_rootref['PAGE_NUMBER_F'])) ? $this->_rootref['PAGE_NUMBER_F'] : ''; } ?></li>
			</ul>
		
			</div>
		</div>
		<?php } ?>


		
		<div class="topic-actions">
			<div class="buttons"><a href="#postingbox" id="add_comment" class="button2" title="Add Comment"><?php echo ((isset($this->_rootref['L_ADD_COMMENT'])) ? $this->_rootref['L_ADD_COMMENT'] : ((isset($user->lang['ADD_COMMENT'])) ? $user->lang['ADD_COMMENT'] : '{ ADD_COMMENT }')); ?></a></div>
			<div class="pagination"><?php echo (isset($this->_rootref['TOTAL_COMMENT'])) ? $this->_rootref['TOTAL_COMMENT'] : ''; ?> &bull; <?php if ($this->_rootref['PAGINATION']) {  ?><a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?></a> &bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span><?php } else { echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; } ?></div>
		</div>
		
		<?php if ($this->_rootref['SIMPLE_COMMENT_ENABLED'] && $this->_rootref['ALLOW_ALL_COMMENT'] && ! $this->_rootref['FOE']) {  if ($this->_rootref['ALLOW_FRIEND_ONLY']) {  ?>

				<?php echo ((isset($this->_rootref['L_FRIEND_COMMENT'])) ? $this->_rootref['L_FRIEND_COMMENT'] : ((isset($user->lang['FRIEND_COMMENT'])) ? $user->lang['FRIEND_COMMENT'] : '{ FRIEND_COMMENT }')); ?> - <a href="<?php echo (isset($this->_rootref['U_ADD_FRIEND'])) ? $this->_rootref['U_ADD_FRIEND'] : ''; ?>"><strong><?php echo ((isset($this->_rootref['L_ADD_FRIEND'])) ? $this->_rootref['L_ADD_FRIEND'] : ((isset($user->lang['ADD_FRIEND'])) ? $user->lang['ADD_FRIEND'] : '{ ADD_FRIEND }')); ?></strong></a><br />
		<?php } else { ?>

		<form action="<?php echo (isset($this->_rootref['NEW_COMMENT'])) ? $this->_rootref['NEW_COMMENT'] : ''; ?>" method="post" id="postform" name="comment">
			<div class="pro-box" id="postingbox">
				<h3 class="pro-header"><?php echo ((isset($this->_rootref['L_PROFILE_COMMENTS'])) ? $this->_rootref['L_PROFILE_COMMENTS'] : ((isset($user->lang['PROFILE_COMMENTS'])) ? $user->lang['PROFILE_COMMENTS'] : '{ PROFILE_COMMENTS }')); ?></h3>
				<fieldset class="fields1">
					<?php $this->_tpl_include('posting_buttons.html'); if (sizeof($this->_tpldata['smiley'])) {  ?><div id="smiley-box"><?php $_smiley_count = (isset($this->_tpldata['smiley'])) ? sizeof($this->_tpldata['smiley']) : 0;if ($_smiley_count) {for ($_smiley_i = 0; $_smiley_i < $_smiley_count; ++$_smiley_i){$_smiley_val = &$this->_tpldata['smiley'][$_smiley_i]; ?><a href="#" onclick="insert_text('<?php echo $_smiley_val['A_SMILEY_CODE']; ?>', true); return false;"><img src="<?php echo $_smiley_val['SMILEY_IMG']; ?>" width="<?php echo $_smiley_val['SMILEY_WIDTH']; ?>" height="<?php echo $_smiley_val['SMILEY_HEIGHT']; ?>" alt="<?php echo $_smiley_val['SMILEY_CODE']; ?>" title="<?php echo $_smiley_val['SMILEY_DESC']; ?>" /></a><?php }} ?></div><?php } ?>

					<div id="message-box">
						<textarea name="comment_text" id="message" cols="40" rows="6"></textarea>
						<input name="comment_to_id" type="hidden" value="<?php echo (isset($this->_rootref['COMMENT_TO_ID'])) ? $this->_rootref['COMMENT_TO_ID'] : ''; ?>" />
					</div>
				</fieldset>
				<div class="submit-button"><input name="Submit " type="submit" id="Submit" class="button1" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" /></div>
			</div>
		</form>
		<?php } ?>

		
		<div class="pro-box" id="comment">
			
			<?php if ($this->_rootref['ALLOW_FRIEND_VIEW']) {  ?>

				<?php echo ((isset($this->_rootref['L_ONLY_FRIEND'])) ? $this->_rootref['L_ONLY_FRIEND'] : ((isset($user->lang['ONLY_FRIEND'])) ? $user->lang['ONLY_FRIEND'] : '{ ONLY_FRIEND }')); ?> - <a href="<?php echo (isset($this->_rootref['U_ADD_FRIEND'])) ? $this->_rootref['U_ADD_FRIEND'] : ''; ?>"><strong><?php echo ((isset($this->_rootref['L_ADD_FRIEND'])) ? $this->_rootref['L_ADD_FRIEND'] : ((isset($user->lang['ADD_FRIEND'])) ? $user->lang['ADD_FRIEND'] : '{ ADD_FRIEND }')); ?></strong></a><br />
			<?php } else { if ($this->_rootref['TOTAL_COMMENT'] == 0) {  ?> <?php echo ((isset($this->_rootref['L_NO_COMMENT'])) ? $this->_rootref['L_NO_COMMENT'] : ((isset($user->lang['NO_COMMENT'])) ? $user->lang['NO_COMMENT'] : '{ NO_COMMENT }')); ?> <?php } $_comment_count = (isset($this->_tpldata['comment'])) ? sizeof($this->_tpldata['comment']) : 0;if ($_comment_count) {for ($_comment_i = 0; $_comment_i < $_comment_count; ++$_comment_i){$_comment_val = &$this->_tpldata['comment'][$_comment_i]; ?>

				<div class="commentrow<?php if (!($_comment_val['S_ROW_COUNT'] & 1)  ) {  ?> bg1<?php } else { ?> bg2<?php } ?> hb_container">
					<dl class="commentprofile">
						<dt class="author"><?php if ($_comment_val['COMMENT_AVATAR_THUMB']) {  echo $_comment_val['COMMENT_AVATAR_THUMB']; } else { ?><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/no-avatar.png" height="40px" width="40px" alt="Default Avatar" /><?php } ?></dt>
					</dl>
					<div class="commentbody">
						<div class="content">
							<div class="username"><?php echo $_comment_val['COMMENT_AUTHOR']; ?>

								<ul class="hb">
									<li><a href="<?php echo $_comment_val['U_USER_URL']; ?>#postform"><?php echo ((isset($this->_rootref['L_REPLY'])) ? $this->_rootref['L_REPLY'] : ((isset($user->lang['REPLY'])) ? $user->lang['REPLY'] : '{ REPLY }')); ?></a></li><?php if ($_comment_val['CAN_DELETE'] || ( $this->_rootref['U_MCP'] || $this->_rootref['U_ACP'] )) {  ?><li class="delete-icon"><a href="<?php echo $_comment_val['U_DELETE_URL']; ?>"><span><?php echo ((isset($this->_rootref['L_DELETE'])) ? $this->_rootref['L_DELETE'] : ((isset($user->lang['DELETE'])) ? $user->lang['DELETE'] : '{ DELETE }')); ?></span></a></li><?php } ?>

								</ul>
							</div>
							<div class="message">
								<?php echo $_comment_val['COMMENT_TEXT']; ?>

								<span class="date"><?php echo $_comment_val['COMMENT_DATE']; ?></span>
							</div>
						</div>
					</div>	
				</div>
			<?php }} } ?>

		</div>
		<?php } if ($this->_rootref['SIGNATURE']) {  ?>

		<div class="pro-box">
			<h3 class="pro-header"><?php echo ((isset($this->_rootref['L_SIGNATURE'])) ? $this->_rootref['L_SIGNATURE'] : ((isset($user->lang['SIGNATURE'])) ? $user->lang['SIGNATURE'] : '{ SIGNATURE }')); ?></h3>
			<div class="inner">
				<?php echo (isset($this->_rootref['SIGNATURE'])) ? $this->_rootref['SIGNATURE'] : ''; ?>

			</div>
		</div>
		<?php } ?>

		
		</div>
	</div>
</div>

<script type="text/javascript">
$(function() {
	$("#postingbox").hide();
	
	$("#add_comment").toggle(function() {
		$(this).html("Hide comment");
		$("#postingbox").stop().show();
	}, function() {
		$(this).html("Add comment");
		$("#postingbox").stop().fadeOut();
	});
});
</script>