<?php if (!defined('IN_PHPBB')) exit; ?><!--version $Id: recent.html 479 2009-03-15 11:19:27Z kevin74 $ //-->
<?php if (sizeof($this->_tpldata['latest_announcements']) || sizeof($this->_tpldata['latest_hot_topics']) || sizeof($this->_tpldata['latest_topics'])) {  ?>

<table id="recent" class="table1" width="100%">
	<tr class="meta">
		<?php if (sizeof($this->_tpldata['latest_announcements'])) {  ?><th class="row1"><?php echo ((isset($this->_rootref['L_RECENT_ANN'])) ? $this->_rootref['L_RECENT_ANN'] : ((isset($user->lang['RECENT_ANN'])) ? $user->lang['RECENT_ANN'] : '{ RECENT_ANN }')); ?></th><?php } if (sizeof($this->_tpldata['latest_hot_topics'])) {  ?><th class="row1"><?php echo ((isset($this->_rootref['L_RECENT_HOT_TOPIC'])) ? $this->_rootref['L_RECENT_HOT_TOPIC'] : ((isset($user->lang['RECENT_HOT_TOPIC'])) ? $user->lang['RECENT_HOT_TOPIC'] : '{ RECENT_HOT_TOPIC }')); ?></th><?php } if (sizeof($this->_tpldata['latest_topics'])) {  ?><th class="row1"><?php echo ((isset($this->_rootref['L_RECENT_TOPIC'])) ? $this->_rootref['L_RECENT_TOPIC'] : ((isset($user->lang['RECENT_TOPIC'])) ? $user->lang['RECENT_TOPIC'] : '{ RECENT_TOPIC }')); ?></th><?php } ?>
	</tr>
	<tr>
		<?php if (sizeof($this->_tpldata['latest_announcements'])) {  ?>
		<td class="row1" style="width: 33%;" valign="top">
			<span class="gensmall">
			<?php $_latest_announcements_count = (isset($this->_tpldata['latest_announcements'])) ? sizeof($this->_tpldata['latest_announcements']) : 0;if ($_latest_announcements_count) {for ($_latest_announcements_i = 0; $_latest_announcements_i < $_latest_announcements_count; ++$_latest_announcements_i){$_latest_announcements_val = &$this->_tpldata['latest_announcements'][$_latest_announcements_i]; ?>
						<a href="<?php echo $_latest_announcements_val['U_VIEW_TOPIC']; ?>" title="<?php echo $_latest_announcements_val['FULL_TITLE']; ?>"><?php echo $_latest_announcements_val['TITLE']; ?></a><br />
			<?php }} ?>
			</span>
		</td>
		<?php } if (sizeof($this->_tpldata['latest_hot_topics'])) {  ?>
		<td class="row1" style="width: 33%;" valign="top">
			<span class="gensmall">
			<?php $_latest_hot_topics_count = (isset($this->_tpldata['latest_hot_topics'])) ? sizeof($this->_tpldata['latest_hot_topics']) : 0;if ($_latest_hot_topics_count) {for ($_latest_hot_topics_i = 0; $_latest_hot_topics_i < $_latest_hot_topics_count; ++$_latest_hot_topics_i){$_latest_hot_topics_val = &$this->_tpldata['latest_hot_topics'][$_latest_hot_topics_i]; ?>
				<a href="<?php echo $_latest_hot_topics_val['U_VIEW_TOPIC']; ?>" title="<?php echo $_latest_hot_topics_val['FULL_TITLE']; ?>"><?php echo $_latest_hot_topics_val['TITLE']; ?></a><br />
			<?php }} ?>
			</span>
		</td>
		<?php } if (sizeof($this->_tpldata['latest_topics'])) {  ?>
		<td class="row1" style="width: 33%;" valign="top">
			<span class="gensmall">
			<?php $_latest_topics_count = (isset($this->_tpldata['latest_topics'])) ? sizeof($this->_tpldata['latest_topics']) : 0;if ($_latest_topics_count) {for ($_latest_topics_i = 0; $_latest_topics_i < $_latest_topics_count; ++$_latest_topics_i){$_latest_topics_val = &$this->_tpldata['latest_topics'][$_latest_topics_i]; ?>
				<a href="<?php echo $_latest_topics_val['U_VIEW_TOPIC']; ?>" title="<?php echo $_latest_topics_val['FULL_TITLE']; ?>"><?php echo $_latest_topics_val['TITLE']; ?></a><br />
			<?php }} ?>
			</span>
		</td>
		<?php } ?>
	</tr>
</table>

<?php } ?>