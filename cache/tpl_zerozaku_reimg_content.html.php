<?php if (!defined('IN_PHPBB')) exit; ?><script type="text/javascript">
// <![CDATA[
	/**
	* Resize too large images
	*/
<?php if ($this->_rootref['S_REIMG']) {  ?>
	var reimg_maxWidth = <?php echo (isset($this->_rootref['REIMG_MAX_WIDTH'])) ? $this->_rootref['REIMG_MAX_WIDTH'] : ''; ?>, reimg_maxHeight = <?php echo (isset($this->_rootref['REIMG_MAX_HEIGHT'])) ? $this->_rootref['REIMG_MAX_HEIGHT'] : ''; ?>, reimg_relWidth = <?php echo (isset($this->_rootref['REIMG_REL_WIDTH'])) ? $this->_rootref['REIMG_REL_WIDTH'] : ''; ?>;
	<?php if ($this->_rootref['S_REIMG_SWAP_PORTRAIT']) {  ?>
		var reimg_swapPortrait = true;
	<?php } ?>
	var reimg_loadingImg = "<?php echo (isset($this->_rootref['T_IMAGES_PATH'])) ? $this->_rootref['T_IMAGES_PATH'] : ''; ?>spacer.gif";
	var reimg_loadingStyle = "<?php if ($this->_rootref['REIMG_LOADING_IMG_SRC']) {  if ($this->_rootref['REIMG_LOADING_IMG_WIDTH']) {  ?>width: <?php echo (isset($this->_rootref['REIMG_LOADING_IMG_WIDTH'])) ? $this->_rootref['REIMG_LOADING_IMG_WIDTH'] : ''; ?>px; <?php } if ($this->_rootref['REIMG_LOADING_IMG_HEIGHT']) {  ?>height: <?php echo (isset($this->_rootref['REIMG_LOADING_IMG_HEIGHT'])) ? $this->_rootref['REIMG_LOADING_IMG_HEIGHT'] : ''; ?>px; <?php } ?>background: url(<?php echo (isset($this->_rootref['REIMG_LOADING_IMG_SRC'])) ? $this->_rootref['REIMG_LOADING_IMG_SRC'] : ''; ?>) top left no-repeat; <?php } else { ?>width: 20px; height: 20px; background: orange; <?php } ?>filter: Alpha(Opacity=50); opacity: .50;";
	var reimg_loadingAlt = "<?php echo ((isset($this->_rootref['LA_LOADING_TEXT'])) ? $this->_rootref['LA_LOADING_TEXT'] : ((isset($this->_rootref['L_LOADING_TEXT'])) ? addslashes($this->_rootref['L_LOADING_TEXT']) : ((isset($user->lang['LOADING_TEXT'])) ? addslashes($user->lang['LOADING_TEXT']) : '{ LOADING_TEXT }'))); ?>";
	<?php if ($this->_rootref['S_REIMG_ZOOM']) {  if ($this->_rootref['S_REIMG_LINK']) {  ?>
			var reimg_autoLink = true;
		<?php } if ($this->_rootref['S_REIMG_BUTTON']) {  ?>
			var reimg_zoomImg = reimg_loadingImg;
			var reimg_zoomStyle = "<?php if ($this->_rootref['REIMG_ZOOM_IN_IMG_SRC']) {  if ($this->_rootref['REIMG_ZOOM_IN_IMG_WIDTH']) {  ?>width: <?php echo (isset($this->_rootref['REIMG_ZOOM_IN_IMG_WIDTH'])) ? $this->_rootref['REIMG_ZOOM_IN_IMG_WIDTH'] : ''; ?>px; <?php } if ($this->_rootref['REIMG_ZOOM_IN_IMG_HEIGHT']) {  ?>height: <?php echo (isset($this->_rootref['REIMG_ZOOM_IN_IMG_HEIGHT'])) ? $this->_rootref['REIMG_ZOOM_IN_IMG_HEIGHT'] : ''; ?>px; <?php } ?>background: url(<?php echo (isset($this->_rootref['REIMG_ZOOM_IN_IMG_SRC'])) ? $this->_rootref['REIMG_ZOOM_IN_IMG_SRC'] : ''; ?>) top left no-repeat; <?php } else { ?>width: 20px; height: 20px; background: green; <?php } ?>filter: Alpha(Opacity=50); opacity: .50;";
			var reimg_zoomHover = "background-position: 0 100%; cursor: pointer; filter: Alpha(Opacity=100); opacity: 1.00;";
		<?php } ?>
		var reimg_zoomAlt = "<?php echo ((isset($this->_rootref['LA_REIMG_ZOOM_IN'])) ? $this->_rootref['LA_REIMG_ZOOM_IN'] : ((isset($this->_rootref['L_REIMG_ZOOM_IN'])) ? addslashes($this->_rootref['L_REIMG_ZOOM_IN']) : ((isset($user->lang['REIMG_ZOOM_IN'])) ? addslashes($user->lang['REIMG_ZOOM_IN']) : '{ REIMG_ZOOM_IN }'))); ?>";
		var reimg_zoomTarget = "<?php echo (isset($this->_rootref['S_REIMG_ZOOM'])) ? $this->_rootref['S_REIMG_ZOOM'] : ''; ?>";
	<?php } } ?>
		
	function reimg(img, width, height)
	{
		if (window.reimg_version)
		{
			reimg_resize(img, width, height);
		}
	}
// ]]>
</script>

<?php if ($this->_rootref['S_REIMG']) {  ?>
	<script type="text/javascript" src="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>reimg/reimg.js"></script>

	<?php if ($this->_rootref['S_REIMG_ZOOM']) {  ?>
		<style type="text/css" media="screen, projection">
		<!--
			#topicreview .reimg-zoom { display: none; }
		-->
		</style>
	<?php } } if ($this->_rootref['S_REIMG_LITEBOX']) {  if ($this->_rootref['S_REIMG_LITEBOX'] == ('_highslide')) {  ?>
		<script type="text/javascript" src="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>reimg/highslide/highslide-full.packed.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>reimg/highslide/highslide.css" />
	<?php } ?>

	<script type="text/javascript">
	// <![CDATA[
		/**
		* Light box for resized images
		*/
	<?php if ($this->_rootref['S_REIMG_LITEBOX'] == ('_highslide')) {  ?>
		if (window.hs)
		{
			hs.graphicsDir = "<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>reimg/highslide/graphics/";
			// Language settings for Highslide JS
			hs.lang.cssDirection = "<?php echo (isset($this->_rootref['S_CONTENT_DIRECTION'])) ? $this->_rootref['S_CONTENT_DIRECTION'] : ''; ?>";
			hs.lang.loadingText = "<?php echo ((isset($this->_rootref['LA_LOADING_TEXT'])) ? $this->_rootref['LA_LOADING_TEXT'] : ((isset($this->_rootref['L_LOADING_TEXT'])) ? addslashes($this->_rootref['L_LOADING_TEXT']) : ((isset($user->lang['LOADING_TEXT'])) ? addslashes($user->lang['LOADING_TEXT']) : '{ LOADING_TEXT }'))); ?>";
			hs.lang.loadingTitle = "<?php echo ((isset($this->_rootref['LA_LOADING_TITLE'])) ? $this->_rootref['LA_LOADING_TITLE'] : ((isset($this->_rootref['L_LOADING_TITLE'])) ? addslashes($this->_rootref['L_LOADING_TITLE']) : ((isset($user->lang['LOADING_TITLE'])) ? addslashes($user->lang['LOADING_TITLE']) : '{ LOADING_TITLE }'))); ?>";
			hs.lang.focusTitle = "<?php echo ((isset($this->_rootref['LA_FOCUS_TITLE'])) ? $this->_rootref['LA_FOCUS_TITLE'] : ((isset($this->_rootref['L_FOCUS_TITLE'])) ? addslashes($this->_rootref['L_FOCUS_TITLE']) : ((isset($user->lang['FOCUS_TITLE'])) ? addslashes($user->lang['FOCUS_TITLE']) : '{ FOCUS_TITLE }'))); ?>";
			hs.lang.fullExpandTitle = "<?php echo ((isset($this->_rootref['LA_FULL_EXPAND_TITLE'])) ? $this->_rootref['LA_FULL_EXPAND_TITLE'] : ((isset($this->_rootref['L_FULL_EXPAND_TITLE'])) ? addslashes($this->_rootref['L_FULL_EXPAND_TITLE']) : ((isset($user->lang['FULL_EXPAND_TITLE'])) ? addslashes($user->lang['FULL_EXPAND_TITLE']) : '{ FULL_EXPAND_TITLE }'))); ?>";
			hs.lang.creditsText = "<?php echo ((isset($this->_rootref['LA_CREDITS_TEXT'])) ? $this->_rootref['LA_CREDITS_TEXT'] : ((isset($this->_rootref['L_CREDITS_TEXT'])) ? addslashes($this->_rootref['L_CREDITS_TEXT']) : ((isset($user->lang['CREDITS_TEXT'])) ? addslashes($user->lang['CREDITS_TEXT']) : '{ CREDITS_TEXT }'))); ?>";
			hs.lang.creditsTitle = "<?php echo ((isset($this->_rootref['LA_CREDITS_TITLE'])) ? $this->_rootref['LA_CREDITS_TITLE'] : ((isset($this->_rootref['L_CREDITS_TITLE'])) ? addslashes($this->_rootref['L_CREDITS_TITLE']) : ((isset($user->lang['CREDITS_TITLE'])) ? addslashes($user->lang['CREDITS_TITLE']) : '{ CREDITS_TITLE }'))); ?>";
			hs.lang.previousText = "<?php echo ((isset($this->_rootref['LA_PREVIOUS_TEXT'])) ? $this->_rootref['LA_PREVIOUS_TEXT'] : ((isset($this->_rootref['L_PREVIOUS_TEXT'])) ? addslashes($this->_rootref['L_PREVIOUS_TEXT']) : ((isset($user->lang['PREVIOUS_TEXT'])) ? addslashes($user->lang['PREVIOUS_TEXT']) : '{ PREVIOUS_TEXT }'))); ?>";
			hs.lang.nextText = "<?php echo ((isset($this->_rootref['LA_NEXT_TEXT'])) ? $this->_rootref['LA_NEXT_TEXT'] : ((isset($this->_rootref['L_NEXT_TEXT'])) ? addslashes($this->_rootref['L_NEXT_TEXT']) : ((isset($user->lang['NEXT_TEXT'])) ? addslashes($user->lang['NEXT_TEXT']) : '{ NEXT_TEXT }'))); ?>";
			hs.lang.moveText = "<?php echo ((isset($this->_rootref['LA_MOVE_TEXT'])) ? $this->_rootref['LA_MOVE_TEXT'] : ((isset($this->_rootref['L_MOVE_TEXT'])) ? addslashes($this->_rootref['L_MOVE_TEXT']) : ((isset($user->lang['MOVE_TEXT'])) ? addslashes($user->lang['MOVE_TEXT']) : '{ MOVE_TEXT }'))); ?>";
			hs.lang.closeText = "<?php echo ((isset($this->_rootref['LA_CLOSE_TEXT'])) ? $this->_rootref['LA_CLOSE_TEXT'] : ((isset($this->_rootref['L_CLOSE_TEXT'])) ? addslashes($this->_rootref['L_CLOSE_TEXT']) : ((isset($user->lang['CLOSE_TEXT'])) ? addslashes($user->lang['CLOSE_TEXT']) : '{ CLOSE_TEXT }'))); ?>";
			hs.lang.closeTitle = "<?php echo ((isset($this->_rootref['LA_CLOSE_TITLE'])) ? $this->_rootref['LA_CLOSE_TITLE'] : ((isset($this->_rootref['L_CLOSE_TITLE'])) ? addslashes($this->_rootref['L_CLOSE_TITLE']) : ((isset($user->lang['CLOSE_TITLE'])) ? addslashes($user->lang['CLOSE_TITLE']) : '{ CLOSE_TITLE }'))); ?>";
			hs.lang.resizeTitle = "<?php echo ((isset($this->_rootref['LA_RESIZE_TITLE'])) ? $this->_rootref['LA_RESIZE_TITLE'] : ((isset($this->_rootref['L_RESIZE_TITLE'])) ? addslashes($this->_rootref['L_RESIZE_TITLE']) : ((isset($user->lang['RESIZE_TITLE'])) ? addslashes($user->lang['RESIZE_TITLE']) : '{ RESIZE_TITLE }'))); ?>";
			hs.lang.playText = "<?php echo ((isset($this->_rootref['LA_PLAY_TEXT'])) ? $this->_rootref['LA_PLAY_TEXT'] : ((isset($this->_rootref['L_PLAY_TEXT'])) ? addslashes($this->_rootref['L_PLAY_TEXT']) : ((isset($user->lang['PLAY_TEXT'])) ? addslashes($user->lang['PLAY_TEXT']) : '{ PLAY_TEXT }'))); ?>";
			hs.lang.playTitle = "<?php echo ((isset($this->_rootref['LA_PLAY_TITLE'])) ? $this->_rootref['LA_PLAY_TITLE'] : ((isset($this->_rootref['L_PLAY_TITLE'])) ? addslashes($this->_rootref['L_PLAY_TITLE']) : ((isset($user->lang['PLAY_TITLE'])) ? addslashes($user->lang['PLAY_TITLE']) : '{ PLAY_TITLE }'))); ?>";
			hs.lang.pauseText = "<?php echo ((isset($this->_rootref['LA_PAUSE_TEXT'])) ? $this->_rootref['LA_PAUSE_TEXT'] : ((isset($this->_rootref['L_PAUSE_TEXT'])) ? addslashes($this->_rootref['L_PAUSE_TEXT']) : ((isset($user->lang['PAUSE_TEXT'])) ? addslashes($user->lang['PAUSE_TEXT']) : '{ PAUSE_TEXT }'))); ?>";
			hs.lang.pauseTitle = "<?php echo ((isset($this->_rootref['LA_PAUSE_TITLE'])) ? $this->_rootref['LA_PAUSE_TITLE'] : ((isset($this->_rootref['L_PAUSE_TITLE'])) ? addslashes($this->_rootref['L_PAUSE_TITLE']) : ((isset($user->lang['PAUSE_TITLE'])) ? addslashes($user->lang['PAUSE_TITLE']) : '{ PAUSE_TITLE }'))); ?>";
			hs.lang.previousTitle = "<?php echo ((isset($this->_rootref['LA_PREVIOUS_TITLE'])) ? $this->_rootref['LA_PREVIOUS_TITLE'] : ((isset($this->_rootref['L_PREVIOUS_TITLE'])) ? addslashes($this->_rootref['L_PREVIOUS_TITLE']) : ((isset($user->lang['PREVIOUS_TITLE'])) ? addslashes($user->lang['PREVIOUS_TITLE']) : '{ PREVIOUS_TITLE }'))); ?>";
			hs.lang.nextTitle = "<?php echo ((isset($this->_rootref['LA_NEXT_TITLE'])) ? $this->_rootref['LA_NEXT_TITLE'] : ((isset($this->_rootref['L_NEXT_TITLE'])) ? addslashes($this->_rootref['L_NEXT_TITLE']) : ((isset($user->lang['NEXT_TITLE'])) ? addslashes($user->lang['NEXT_TITLE']) : '{ NEXT_TITLE }'))); ?>";
			hs.lang.moveTitle = "<?php echo ((isset($this->_rootref['LA_MOVE_TITLE'])) ? $this->_rootref['LA_MOVE_TITLE'] : ((isset($this->_rootref['L_MOVE_TITLE'])) ? addslashes($this->_rootref['L_MOVE_TITLE']) : ((isset($user->lang['MOVE_TITLE'])) ? addslashes($user->lang['MOVE_TITLE']) : '{ MOVE_TITLE }'))); ?>";
			hs.lang.number = "<?php echo ((isset($this->_rootref['LA_IMAGE_NUMBER'])) ? $this->_rootref['LA_IMAGE_NUMBER'] : ((isset($this->_rootref['L_IMAGE_NUMBER'])) ? addslashes($this->_rootref['L_IMAGE_NUMBER']) : ((isset($user->lang['IMAGE_NUMBER'])) ? addslashes($user->lang['IMAGE_NUMBER']) : '{ IMAGE_NUMBER }'))); ?>";
			hs.lang.restoreTitle = "<?php echo ((isset($this->_rootref['LA_RESTORE_TITLE'])) ? $this->_rootref['LA_RESTORE_TITLE'] : ((isset($this->_rootref['L_RESTORE_TITLE'])) ? addslashes($this->_rootref['L_RESTORE_TITLE']) : ((isset($user->lang['RESTORE_TITLE'])) ? addslashes($user->lang['RESTORE_TITLE']) : '{ RESTORE_TITLE }'))); ?>";
		}
	<?php } else { ?>
		var litebox_alt = "<?php if ($this->_rootref['S_REIMG_LINK']) {  echo ((isset($this->_rootref['LA_REIMG_ZOOM_OUT'])) ? $this->_rootref['LA_REIMG_ZOOM_OUT'] : ((isset($this->_rootref['L_REIMG_ZOOM_OUT'])) ? addslashes($this->_rootref['L_REIMG_ZOOM_OUT']) : ((isset($user->lang['REIMG_ZOOM_OUT'])) ? addslashes($user->lang['REIMG_ZOOM_OUT']) : '{ REIMG_ZOOM_OUT }'))); } else { echo ((isset($this->_rootref['LA_IMAGE'])) ? $this->_rootref['LA_IMAGE'] : ((isset($this->_rootref['L_IMAGE'])) ? addslashes($this->_rootref['L_IMAGE']) : ((isset($user->lang['IMAGE'])) ? addslashes($user->lang['IMAGE']) : '{ IMAGE }'))); } ?>";
		<?php if ($this->_rootref['S_REIMG_LITEBOX'] == ('_litebox')) {  ?>
			var litebox_zoomImg = reimg_loadingImg;
			<?php if ($this->_rootref['S_REIMG_BUTTON']) {  ?>
				var litebox_zoomStyle = reimg_zoomStyle;
				var litebox_zoomHover = reimg_zoomHover;
			<?php } else { ?>
				var litebox_zoomStyle = "<?php if ($this->_rootref['REIMG_ZOOM_IN_IMG_SRC']) {  if ($this->_rootref['REIMG_ZOOM_IN_IMG_WIDTH']) {  ?>width: <?php echo (isset($this->_rootref['REIMG_ZOOM_IN_IMG_WIDTH'])) ? $this->_rootref['REIMG_ZOOM_IN_IMG_WIDTH'] : ''; ?>px; <?php } if ($this->_rootref['REIMG_ZOOM_IN_IMG_HEIGHT']) {  ?>height: <?php echo (isset($this->_rootref['REIMG_ZOOM_IN_IMG_HEIGHT'])) ? $this->_rootref['REIMG_ZOOM_IN_IMG_HEIGHT'] : ''; ?>px; <?php } ?>background: url(<?php echo (isset($this->_rootref['REIMG_ZOOM_IN_IMG_SRC'])) ? $this->_rootref['REIMG_ZOOM_IN_IMG_SRC'] : ''; ?>) top left no-repeat; <?php } else { ?>width: 20px; height: 20px; background: green; <?php } ?>filter: Alpha(Opacity=50); opacity: .50;";
				var litebox_zoomHover = "background-position: 0 100%; cursor: pointer; filter: Alpha(Opacity=100); opacity: 1.00;";
			<?php } ?>
			var litebox_zoomAlt = reimg_zoomAlt;
		<?php } else if ($this->_rootref['S_REIMG_LITEBOX'] == ('_litebox1')) {  ?>
			var reimg_zoomLevel = 100;
		<?php } if ($this->_rootref['S_REIMG_LINK']) {  ?>
			var litebox_style = "cursor: pointer;"
		<?php } if ($this->_rootref['S_REIMG_BUTTON']) {  ?>
			var litebox_closeImg = reimg_loadingImg;
			var litebox_closeStyle = "<?php if ($this->_rootref['REIMG_ZOOM_OUT_IMG_SRC']) {  if ($this->_rootref['REIMG_ZOOM_OUT_IMG_WIDTH']) {  ?>width: <?php echo (isset($this->_rootref['REIMG_ZOOM_OUT_IMG_WIDTH'])) ? $this->_rootref['REIMG_ZOOM_OUT_IMG_WIDTH'] : ''; ?>px; <?php } if ($this->_rootref['REIMG_ZOOM_OUT_IMG_HEIGHT']) {  ?>height: <?php echo (isset($this->_rootref['REIMG_ZOOM_OUT_IMG_HEIGHT'])) ? $this->_rootref['REIMG_ZOOM_OUT_IMG_HEIGHT'] : ''; ?>px; <?php } ?>background: url(<?php echo (isset($this->_rootref['REIMG_ZOOM_OUT_IMG_SRC'])) ? $this->_rootref['REIMG_ZOOM_OUT_IMG_SRC'] : ''; ?>) top left no-repeat; <?php } else { ?>width: 20px; height: 20px; background: red; <?php } ?>filter: Alpha(Opacity=50); opacity: .50;";
			var litebox_closeHover = reimg_zoomHover;
			var litebox_closeAlt = <?php if ($this->_rootref['S_REIMG_LINK']) {  ?>litebox_alt<?php } else { ?>"<?php echo ((isset($this->_rootref['LA_REIMG_ZOOM_OUT'])) ? $this->_rootref['LA_REIMG_ZOOM_OUT'] : ((isset($this->_rootref['L_REIMG_ZOOM_OUT'])) ? addslashes($this->_rootref['L_REIMG_ZOOM_OUT']) : ((isset($user->lang['REIMG_ZOOM_OUT'])) ? addslashes($user->lang['REIMG_ZOOM_OUT']) : '{ REIMG_ZOOM_OUT }'))); ?>"<?php } ?>;
		<?php } ?>
		var litebox_rtl = <?php if ($this->_rootref['S_CONTENT_DIRECTION'] == ('rtl')) {  ?>true<?php } else { ?>false<?php } ?>;
	<?php } ?>
	// ]]>
	</script>

	<?php if ($this->_rootref['S_REIMG_LITEBOX'] != ('_highslide')) {  ?>
		<script type="text/javascript" src="<?php echo (isset($this->_rootref['ROOT_PATH'])) ? $this->_rootref['ROOT_PATH'] : ''; ?>reimg/litebox.js"></script>
	<?php } } ?>