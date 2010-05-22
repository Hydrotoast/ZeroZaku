<?php if (!defined('IN_PHPBB')) exit; if (! $this->_rootref['S_IS_MCP'] && ! $this->_rootref['S_IS_UCP']) {  ?>

		</td>
			
		<?php if (sizeof($this->_tpldata['right_menu'])) {  ?>

		<td id="right_menu" style="width: <?php echo (isset($this->_rootref['RIGHT_MENU_WIDTH'])) ? $this->_rootref['RIGHT_MENU_WIDTH'] : ''; ?>; vertical-align: top; margin-left: 10px;">
			<?php $_right_menu_count = (isset($this->_tpldata['right_menu'])) ? sizeof($this->_tpldata['right_menu']) : 0;if ($_right_menu_count) {for ($_right_menu_i = 0; $_right_menu_i < $_right_menu_count; ++$_right_menu_i){$_right_menu_val = &$this->_tpldata['right_menu'][$_right_menu_i]; ?>

			<?php echo $_right_menu_val['CONTENT']; ?>

			<?php }} ?>

		</td>
		<?php } ?>

		
	</tr>
</table>

<div id="board-statistics">
	<?php if ($this->_rootref['S_DISPLAY_ONLINE_LIST']) {  ?>

		<h3><a href="<?php echo (isset($this->_rootref['U_VIEWONLINE'])) ? $this->_rootref['U_VIEWONLINE'] : ''; ?>"><?php echo ((isset($this->_rootref['L_WHO_IS_ONLINE'])) ? $this->_rootref['L_WHO_IS_ONLINE'] : ((isset($user->lang['WHO_IS_ONLINE'])) ? $user->lang['WHO_IS_ONLINE'] : '{ WHO_IS_ONLINE }')); ?></a></h3>
		<p><?php echo (isset($this->_rootref['LOGGED_IN_USER_LIST'])) ? $this->_rootref['LOGGED_IN_USER_LIST'] : ''; ?></p>
	<?php } if (sizeof($this->_tpldata['articlerow']) && ! $this->_rootref['IN_TAG']) {  ?>

		<h3><?php echo ((isset($this->_rootref['L_KB_PERMISSIONS'])) ? $this->_rootref['L_KB_PERMISSIONS'] : ((isset($user->lang['KB_PERMISSIONS'])) ? $user->lang['KB_PERMISSIONS'] : '{ KB_PERMISSIONS }')); ?></h3>
		<p><?php $_rules_count = (isset($this->_tpldata['rules'])) ? sizeof($this->_tpldata['rules']) : 0;if ($_rules_count) {for ($_rules_i = 0; $_rules_i < $_rules_count; ++$_rules_i){$_rules_val = &$this->_tpldata['rules'][$_rules_i]; echo $_rules_val['RULE']; ?><br /><?php }} ?></p>
	<?php } ?>

</div>
<?php if ($this->_rootref['U_MODCP']) {  ?>[&nbsp;<a href="<?php echo (isset($this->_rootref['U_MODCP'])) ? $this->_rootref['U_MODCP'] : ''; ?>"><?php echo ((isset($this->_rootref['L_MCP'])) ? $this->_rootref['L_MCP'] : ((isset($user->lang['MCP'])) ? $user->lang['MCP'] : '{ MCP }')); ?></a>&nbsp;] <br /><br /><?php } $this->_tpl_include('overall_footer.html'); } else if ($this->_rootref['S_IS_MCP']) {  $this->_tpl_include('mcp_footer.html'); } else { $this->_tpl_include('ucp_footer.html'); } ?>