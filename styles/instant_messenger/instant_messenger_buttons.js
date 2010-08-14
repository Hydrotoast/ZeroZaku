document.write( '<' + 'script type="text\/javascript" src="styles/instant_messenger/jquery.hoverIntent.min.js"><'+'\/'+'script>');

var im_cfg = {
	rootPath: '',
	themePath: '',
	rtl: 'ltr',
};

/** Online list - function - start **/
function showOnlineStatus(){jQuery(function($){
	$('#im-online-list strong:last-child').html( $('#im-online-list ul').children('li').length);
	
	if ( $('#im-online-list ul').children('li').length == 0 ) {
		s_src = '/images/im_list_offline.gif';
	} else {
		s_src = '/images/im_list_online.gif';
	}
	$('#im-online-list .button img').attr('src', im_cfg.themePath + s_src);
	
});}

function load_onlinelist(){jQuery(function($){
	$.ajax({
		type	: 'post',
		cache	: false,
		async	: false,
		url		: im_cfg.rootPath + 'instant_messenger.php',
		data	: { action: 'onlinelist' },
		dataType: 'html',
		success : function (data) {
			$('#im-online-list ul').html(data);
			$('#im-online-list ul li a').removeAttr('href').css('cursor', 'pointer');
			
		}
	});
	
	showOnlineStatus();
	
	if ( $('div#im-online-list .block:visible')) {
		setTimeout( 'load_onlinelist()', 600 * 1000);
	}
});}

/** News - load news **/
function load_news() {jQuery(function($){
	$('#im-news ul' ).html($.ajax({
		type	: 'post',
		cache	: false,
		async	: false,
		url		: im_cfg.rootPath + 'instant_messenger.php',
		data	: { action: 'newposts' },
		dataType: 'html'
		
	}).responseText);
});}

/** Effects - hoverIntent **/
function effect_hoverIntent(){jQuery(function($){
	$('#site-bottom-bar-frame .block-box').hoverIntent( {
		sensitivity: 3,
		interval: 0,
		timeout: 300,
		over: function(){
			s_id = $(this).attr('id');
			
			if ( s_id == 'im-news') {
				load_news();
			}
			
			if (s_id != 'im-online-list') {
				$('> .block', this).slideDown();
				$('> .button', this).addClass('hovering');
			}
		},
		out: function(){
			s_id = $(this).attr('id');

			if (s_id != 'im-online-list') {
				$('> .block', this).slideUp();
				$('> .button', this).removeClass('hovering');
			}
		}
	});
	
	$('#im-online-list .button').click( function(){
		$('+ .block', this).slideToggle();
		$(this).toggleClass( 'hovering');
		load_onlinelist();
	});
});}

/** Effects - click **/
function effect_clicks() {jQuery(function($){
	$('#site-bottom-bar-frame .button').click( function(){
		s_id = $(this).parents('.block-box').attr('id');

		if (!$(this).hasClass('hovering')) {
			$('#site-bottom-bar-frame .button.hovering').removeClass('hovering');
			$('#site-bottom-bar-frame .block:visible').slideUp();
		}
		
		if ( s_id == 'im-news') {
			load_news();
		}
		if ( s_id == 'im-online-list') {
			load_onlinelist();
		}
		
		$('+ .block', this).slideToggle();
		$(this).toggleClass('hovering');
		return false;
	});
	
	$( document ).click( function( event ){
		// Check to see if this came from the menu.
		s_obj = $('#site-bottom-bar-frame .block-box .block:visible').parents('.block-box').attr('id');
		if ($('#'+s_obj+' .block').is(':visible') && !$(event.target).closest('#' + s_obj).size()) {
			$('#site-bottom-bar-frame .block-box .block:visible').slideToggle();
			$('#site-bottom-bar-frame .block-box .button.hovering').removeClass('hovering');
		}
	});
});}

function window_resize() {jQuery(function($){
	if (im_cfg.rtl == 'ltr') {
		$('.ltr #site-bottom-bar-frame .block-box.rightside').each(function(){
			pos = $(this).position();
			offset = $(this).outerWidth();
			o_block = $('> .block', this);
			o_block.css('left', pos.left + offset - o_block.outerWidth() - 1);
		});
	}
	else {
		$('.rtl #site-bottom-bar-frame .block-box.rightside').each(function(){
			pos = $(this).position();
			offset = $(this).outerWidth();
			o_block = $('> .block', this);
			
			o_block.css('left', pos.left + 'px');
		});
		$('.rtl #site-bottom-bar-frame .block-box:not(.rightside)').each(function(){
			pos = $(this).position();
			offset = $(this).outerWidth();
			o_block = $('> .block', this);
			
			o_block.css('left', (pos.left + offset - $(o_block).outerWidth() - 1) + 'px');
			
		});
	}
});}


/** START - assign all event **/
function load_startIM( im_config) {

	// Taking ownership over $ function, map $ as jQuery;
	jQuery(function($){
		
		$.extend(im_cfg, im_config);

		//$('#site-bottom-bar-frame a').removeAttr('href');
		$('body').css('padding-bottom', (parseInt($('body').css('padding-bottom')) + 26 )+ 'px' );
		$.ajaxSetup({
			type: 'post',
			cache: false,
			dataType: 'json',
			url: im_cfg.rootPath + 'instant_messenger.php'
		});
		
		// Stupid loading of CSS
		$('#site-bottom-bar').removeAttr('style');
		$('#site-bottom-bar-frame').removeAttr('style');
		// Rightside position of right side block
		// To allow hoverIntent effect uncomment next line
		//effect_hoverIntent();
		// To allow click effect uncomment next line
		effect_clicks();
		
		if (typeof startChatSession != 'function') {
			return true;
		}
		
		if ($('meta[http-equiv=refresh]').length > 0) {
			var r_content = $('meta[http-equiv=refresh]').attr('content');
		
			if (r_content.match(/^[0-9]{1,};url=.+$/i) !== null) {
				$.ajax({
					async: false,
					data: {
						action: 'nothingtoreturn'
					},
					success: function(data){
						username = data.username;
					}
				});
				
				return true;
			}
		}
		
		startChatSession();
		//
		// First load of ONLINE LIST
		//
		load_onlinelist();
		
		
		// Online List Chat Start
		$('#im-online-list ul li a').live('click', function(){
			i_uid = $(this).attr('userid');
			s_username = $(this).attr('title');
			chatWith(i_uid, s_username);
			$('#im-online-list.block-box .block:visible').slideToggle();
			$('#im-nline-list.block-box .button.hovering').removeClass('hovering');
			
		});
			
		//
		// STATUS BUTTONS
		//
		$('#im-status input[type=text]').keyup(function(){
			if ($(this).val().length == 0) {
				$('#im-status input[name=add]:not(:disabled)').attr('disabled', 'disabled').css('opacity', '0.5');
			}
			else {
				$('#im-status input[name=add]:disabled').removeAttr('disabled').css('opacity', '1.0');
			}
		});
		
		$('#im-status input:disabled').css('opacity', '0.5');
		$('#im-status .overlay-text').css({
			lineHeight: parseInt($('#im-status .block').height()) + 'px'
		});
		
		
		$('#im-status input[type=submit]').click(function(){
			/*$('#im-status .block').css('overflow', 'hidden');*/
			$('#im-status .overlay').show().fadeOut(2500);
			s_this = $(this).attr('name');
			$.ajax({
				url: im_cfg.rootPath + 'instant_messenger.php',
				cache: false,
				dataType: 'html',
				data: {
					action: 'userstatus',
					mode: s_this,
					status_text: $('#status_text').val()
				},
				error: function(){
					alert('AJAX Error\nUpdate status');
				},
				success: function(data){
					if (data === false) {
						alert('Status update error');
					}
					else {
						if (s_this == 'add') {
							s_new_status = $('#status_text').val();
							$('#im-status input[type=text]').val('');
							$('#im-status input[name=delete]').fadeIn();
						}
						else {
							s_new_status = '&nbsp;';
							$('#im-status input[name=delete]').fadeOut();
						}
						$('.bubble_status').html(s_new_status);
						$('#im-status .block .overlay').show().fadeOut(2300);
						$('#im-status .block .overlay-text.' + s_this).show().fadeOut(2300);
					}
				}
			});
			return false;
		});

		originalTitle = document.title;
		$([window, document]).blur(function(){
			windowFocus = false;
		}).focus(function(){
			windowFocus = true;
			document.title = originalTitle;
		});
		
		showOnlineStatus();
	});
}