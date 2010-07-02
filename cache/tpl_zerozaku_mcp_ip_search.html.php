<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('mcp_header.html'); ?>


<h2><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></h2>

<div class="panel">
	<div class="inner">
		<p><?php echo ((isset($this->_rootref['L_MCP_IP_SEARCH_EXPLAIN'])) ? $this->_rootref['L_MCP_IP_SEARCH_EXPLAIN'] : ((isset($user->lang['MCP_IP_SEARCH_EXPLAIN'])) ? $user->lang['MCP_IP_SEARCH_EXPLAIN'] : '{ MCP_IP_SEARCH_EXPLAIN }')); ?></p>
		
		<ul class="linklist">
			<li class="leftside">
				<form action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>"  method="post">
					<label for="ip"><?php echo ((isset($this->_rootref['L_MCP_IP_SEARCH'])) ? $this->_rootref['L_MCP_IP_SEARCH'] : ((isset($user->lang['MCP_IP_SEARCH'])) ? $user->lang['MCP_IP_SEARCH'] : '{ MCP_IP_SEARCH }')); ?>:</label>
					<input id="ip" class="inputbox autowidth" name="ip" type="text" size="25" name="ip" value="<?php echo (isset($this->_rootref['IP'])) ? $this->_rootref['IP'] : ''; ?>" />
					&nbsp;<label for="type"><?php echo ((isset($this->_rootref['L_MCP_IP_SEARCH_TYPE'])) ? $this->_rootref['L_MCP_IP_SEARCH_TYPE'] : ((isset($user->lang['MCP_IP_SEARCH_TYPE'])) ? $user->lang['MCP_IP_SEARCH_TYPE'] : '{ MCP_IP_SEARCH_TYPE }')); ?>:</label>
					<select name="type">
						<option value="users"<?php if ($this->_rootref['TYPE'] == ('users')) {  ?> selected="selected"<?php } ?>><?php echo ((isset($this->_rootref['L_MCP_IP_SEARCH_USERS'])) ? $this->_rootref['L_MCP_IP_SEARCH_USERS'] : ((isset($user->lang['MCP_IP_SEARCH_USERS'])) ? $user->lang['MCP_IP_SEARCH_USERS'] : '{ MCP_IP_SEARCH_USERS }')); ?></option>
						<option value="posts"<?php if ($this->_rootref['TYPE'] == ('posts')) {  ?> selected="selected"<?php } ?>><?php echo ((isset($this->_rootref['L_MCP_IP_SEARCH_POSTS'])) ? $this->_rootref['L_MCP_IP_SEARCH_POSTS'] : ((isset($user->lang['MCP_IP_SEARCH_POSTS'])) ? $user->lang['MCP_IP_SEARCH_POSTS'] : '{ MCP_IP_SEARCH_POSTS }')); ?></option>
						<option value="privmsgs"<?php if ($this->_rootref['TYPE'] == ('privmsgs')) {  ?> selected="selected"<?php } ?>><?php echo ((isset($this->_rootref['L_MCP_IP_SEARCH_PRIVMSGS'])) ? $this->_rootref['L_MCP_IP_SEARCH_PRIVMSGS'] : ((isset($user->lang['MCP_IP_SEARCH_PRIVMSGS'])) ? $user->lang['MCP_IP_SEARCH_PRIVMSGS'] : '{ MCP_IP_SEARCH_PRIVMSGS }')); ?></option>
						<option value="poll_votes"<?php if ($this->_rootref['TYPE'] == ('poll_votes')) {  ?> selected="selected"<?php } ?>><?php echo ((isset($this->_rootref['L_MCP_IP_SEARCH_POLL_VOTES'])) ? $this->_rootref['L_MCP_IP_SEARCH_POLL_VOTES'] : ((isset($user->lang['MCP_IP_SEARCH_POLL_VOTES'])) ? $user->lang['MCP_IP_SEARCH_POLL_VOTES'] : '{ MCP_IP_SEARCH_POLL_VOTES }')); ?></option>
						<option value="bot_check"<?php if ($this->_rootref['TYPE'] == ('bot_check')) {  ?> selected="selected"<?php } ?>><?php echo ((isset($this->_rootref['L_MCP_IP_SEARCH_BOT_CHECK'])) ? $this->_rootref['L_MCP_IP_SEARCH_BOT_CHECK'] : ((isset($user->lang['MCP_IP_SEARCH_BOT_CHECK'])) ? $user->lang['MCP_IP_SEARCH_BOT_CHECK'] : '{ MCP_IP_SEARCH_BOT_CHECK }')); ?></option>
					</select>
					<input class="button2" type="submit" id="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" /><?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

				</form>
			</li>
			
			<?php if ($this->_rootref['PAGINATION']) {  ?>

			<li class="rightside pagination">
				<?php if ($this->_rootref['TOTAL']) {  ?><span><?php echo (isset($this->_rootref['TOTAL'])) ? $this->_rootref['TOTAL'] : ''; ?> </span><?php } ?>

				&bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span>
			</li>
			<?php } ?>

		</ul>
		
		<?php if ($this->_rootref['S_DATA_OUTPUT']) {  $_data_output_count = (isset($this->_tpldata['data_output'])) ? sizeof($this->_tpldata['data_output']) : 0;if ($_data_output_count) {for ($_data_output_i = 0; $_data_output_i < $_data_output_count; ++$_data_output_i){$_data_output_val = &$this->_tpldata['data_output'][$_data_output_i]; ?>

				<table cellspacing="1" class="table1">
					<?php echo $_data_output_val['DATA']; ?>

				</table>
			<?php }} if ($this->_rootref['PAGINATION']) {  ?>

			<ul>
				<li class="rightside pagination">
					<?php if ($this->_rootref['TOTAL']) {  ?><span><?php echo (isset($this->_rootref['TOTAL'])) ? $this->_rootref['TOTAL'] : ''; ?></span><?php } ?>

					&bull; <span><?php echo (isset($this->_rootref['PAGINATION'])) ? $this->_rootref['PAGINATION'] : ''; ?></span>
				</li>
			</ul>
		<?php } } ?>	
	</div>
</div>

<?php $this->_tpl_include('mcp_footer.html'); ?>