var s_root_path = '';
var s_theme_path = '';
var enableSound = false;
document.write( '<' + 'script type="text\/javascript" src="styles/instant_messenger/jquery.dbj_sound.js"><'+'\/'+'script>');
document.write( '<' + 'script type="text\/javascript" src="styles/instant_messenger/jquery.hoverIntent.min.js"><'+'\/'+'script>');

/** Online list - function - start **/
var load_onlinelist = function(){
	$.ajax({
		type	: 'post',
		cache	: false,
		async	: false,
		url		: s_root_path + 'instant_messenger.php',
		data	: { action: 'onlinelist' },
		dataType: 'html',
		error	: function(XMLHttpRequest, textStatus, errorThrown) {
			$('#online_list ul').html('<li>AJAX Error<br />Online list users load</li>');
		},
		success : function (data) {
			$('#im-online-list ul').html(data);
			
		}
	});
	$('#im-online-list strong:last-child').html( $('#im-online-list ul').children('li').length);
	
	if ( $('#im-online-list ul').children('li').length == 0 ) {
		s_src = s_theme_path + '/images/im_list_offline.gif';
	} else {
		s_src = s_theme_path + '/images/im_list_online.gif';
	}
	$('#im-online-list .button img').attr('src', s_src);
	
	
	if ( $('div#im-online-list .block:visible')) {
		setTimeout( 'load_onlinelist()', 30 * 1000);
	}
}

/** News - load news **/
var load_news = function() {
	$('#im-news ul' ).html($.ajax({
		type	: 'post',
		cache	: false,
		async	: false,
		url		: s_root_path + 'instant_messenger.php',
		error	: function(){
			alert( 'AJAX Error:\nLoading News');
		},
		data	: { action: 'newposts' },
		dataType: 'html'
		
	}).responseText);
	
}

/** Effects - hoverIntent **/
var effect_hoverIntent = function(){
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
	
}

/** Effects - click **/
var effect_clicks = function() {
	$('#site-bottom-bar-frame .button').click( function(){
		s_id = $(this).parents('.block-box').attr('id');

		if (!$(this).hasClass('hovering')) {
			$('#site-bottom-bar-frame .button.hovering').removeClass('hovering');
			$('#site-bottom-bar-frame .block:visible').slideUp();
		}
		
		if ( s_id == 'im-news') {
			load_news();
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
	
}

/** START - assign all event **/
var load_startIM = function( root_path, theme_path) {
//$(document).ready( function() {
	s_root_path = root_path;
	s_theme_path = theme_path;
	
	$.ajaxSetup({
		type: 'post',
		cache: false,
		dataType: 'json',
		url: s_root_path + 'instant_messenger.php'
	});
		
	if ( enableSound)
		$.dbj_sound.url('#im_msg_arrived');

	// Rightside position of right side block
	$(window).resize( function(){
		$('#site-bottom-bar-frame .rightside').each( function(){
			pos = $(this).position();
			offset = $(this).outerWidth();
			o_block = $('> .block', this);
			
			o_block.css('left', pos.left + offset - o_block.outerWidth()-1);
			
		});
	});

	
	originalTitle = document.title;
	$([window, document]).blur(function(){
		windowFocus = false;
	}).focus(function(){
		windowFocus = true;
		document.title = originalTitle;
	});

	// To allow hoverIntent effect uncomment next line
	//effect_hoverIntent();
	// To allow click effect uncomment next line
	effect_clicks();
		
	if ( typeof startChatSession != 'function' ){
		return true;
	}
	
	if ( $('meta[http-equiv=refresh]').length > 0) {
		$.ajax({
			async: false,
			data: {action: 'nothingtoreturn'},
			/*error: function(){
				alert( 'AJAX Error:\nInitialization');
			},*/
			success: function(data) {
				username = data.username;
			}
		});
		
		return true;
	}
	
	startChatSession();

	
	//
	// First load of ONLINE LIST
	//
	load_onlinelist();


	// Online List Chat Start
	$('#im-online-list ul li a').live( 'click', function(){
		i_uid = $(this).attr('userid');
		s_username = $(this).attr('title');
		chatWith(i_uid, s_username);
		$('#im-online-list.block-box .block:visible').slideToggle();
		$('#im-nline-list.block-box .button.hovering').removeClass('hovering');
		
	});
	
	//
	// STATUS BUTTONS
	//
	$('#im-status input[type=text]').keyup( function(){
		if ( $(this).val().length == 0 ) {
			$('#im-status input[name=add]:not(:disabled)').attr( 'disabled', 'disabled').css('opacity', '0.5');
		} else {
			$('#im-status input[name=add]:disabled').removeAttr('disabled').css('opacity', '1.0');
		}
	});
	
	$('#im-status input:disabled').css('opacity', '0.5');
	$('#im-status .overlay-text').css({	lineHeight: parseInt($('#im-status .block').height())+'px'});

	
	$('#im-status input[type=submit]').click( function() {
		/*$('#im-status .block').css('overflow', 'hidden');*/
		$('#im-status .overlay').show().fadeOut(2500);
		s_this = $(this).attr('name');
		$.ajax({
			url: s_root_path + 'instant_messenger.php',
			cache: false,
			dataType: 'html',
			data: { action: 'userstatus', mode: s_this, status_text: $('#status_text').val()},
			error: function(){
				alert( 'AJAX Error\nUpdate status');
			},
			success: function( data){
				if( data === false ){
					alert( 'Status update error');
				} else {
					if ( s_this == 'add') {
						s_new_status = $('#status_text').val();
						$('#im-status input[type=text]').val('');
						$('#im-status input[name=delete]').fadeIn();
					} else {
						s_new_status = '&nbsp;';
						$('#im-status input[name=delete]').fadeOut();
					}
					$('.bubble_status').html( s_new_status);
					$('#im-status .block .overlay').show().fadeOut(2300);
					$('#im-status .block .overlay-text.'+s_this).show().fadeOut(2300);
				}
			}
		});
		return false;
	});

}