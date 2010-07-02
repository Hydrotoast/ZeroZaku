var windowFocus = true;
var username;      
var chatHeartbeatCount = 0;
var minChatHeartbeat = 1000;
var maxChatHeartbeat = 33000;
var chatHeartbeatTime = minChatHeartbeat;
var originalTitle;
var blinkOrder = 0;

var siteBottomBar_height = 0;

var chatboxFocus = new Array();
var newMessages = new Array();
var newMessagesWin = new Array();
var chatBoxes = new Array();


function restructureChatBoxes() {jQuery(function($){
	align = 0;
	for (x in chatBoxes) {
		chatboxtitle = chatBoxes[x];

		if ($("#chatbox_"+chatboxtitle).css('display') != 'none') {
			if (align == 0) {
				$("#chatbox_"+chatboxtitle).css('right', '20px');     
			} else {
				width = (align)*(216+7)+20;
				$("#chatbox_"+chatboxtitle).css('right', width+'px');          
			}
			align++;
		}
	}
});}

function chatWith( i_uid, s_username) {jQuery( function($){
	createChatBox( i_uid, s_username);
	$("#chatbox_"+i_uid+" .chatboxtextarea").focus();

  // hide online list when chat box opened 
	$('#online_list').slideUp();
});}

function createChatBox( chatboxtitle, s_username, minimizeChatBox) {jQuery(function($){      
	if ($("#chatbox_"+chatboxtitle).length > 0) {
		if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
			$("#chatbox_"+chatboxtitle).fadeIn();
			restructureChatBoxes();
		}
		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
		return;
	}

	$(" <div />" ).attr("id","chatbox_"+chatboxtitle).css('display', 'none')
	.addClass("chatbox")
	.html('<div class="chatboxhead"><div class="chatboxtitle">'+s_username+'</div><div class="chatboxoptions"><a href="javascript:toggleChatBoxGrowth( \''+chatboxtitle+'\');">_</a> <a href="javascript:closeChatBox(\''+chatboxtitle+'\');">X</a></div><br clear="all"/></div><div class="chatboxcontent"></div><div class="chatboxinput"><textarea class="chatboxtextarea" onkeydown="javascript:return checkChatBoxInputKey(event,this,\''+chatboxtitle+'\',\''+s_username+'\');"></textarea></div>')
	.appendTo($( "body" ));
	
	$("#chatbox_"+chatboxtitle).fadeIn();
	
	chatBoxeslength = 0;

	for (x in chatBoxes) {
		if ($("#chatbox_"+chatBoxes[x]).css('display') != 'none') {
			chatBoxeslength++;
		}
	}

	if (chatBoxeslength == 0) {
		$("#chatbox_"+chatboxtitle).css('right', '20px');
	} else {
		width = (chatBoxeslength)*(225+7)+20;
		$("#chatbox_"+chatboxtitle).css('right', width+'px');
	}
	
	chatBoxes.push(chatboxtitle);

	if (minimizeChatBox == 1) {
		minimizedChatBoxes = new Array();

		if ($.cookie('chatbox_minimized')) {
			minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
		}
		minimize = 0;
		for (j=0;j<minimizedChatBoxes.length;j++) {
			if (minimizedChatBoxes[j] == chatboxtitle) {
				minimize = 1;
			}
		}

		if (minimize == 1) {
			$('#chatbox_'+chatboxtitle+' .chatboxcontent').hide();
			$('#chatbox_'+chatboxtitle+' .chatboxinput').hide();
		}
	}

	chatboxFocus[chatboxtitle] = false;

	$("#chatbox_"+chatboxtitle+" .chatboxtextarea").blur(function(){
		chatboxFocus[chatboxtitle] = false;
		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").removeClass('chatboxtextareaselected');
	}).focus(function(){
		chatboxFocus[chatboxtitle] = true;
		newMessages[chatboxtitle] = false;
		$('#chatbox_'+chatboxtitle+' .chatboxhead').removeClass('chatboxblink');
		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").addClass('chatboxtextareaselected');
	});

	$("#chatbox_"+chatboxtitle).click(function() {
		if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') != 'none') {
			$("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
		}
	});

	$("#chatbox_"+chatboxtitle).show();
});}

function chatHeartbeat() {jQuery(function($){

	var itemsfound = 0;
	
	if (windowFocus == false) {
 
		var blinkNumber = 0;
		var titleChanged = 0;
		for (x in newMessagesWin) {
			if (newMessagesWin[x] == true) {
				++blinkNumber;
				if (blinkNumber >= blinkOrder) {
					document.title = $('#chatbox_'+x+' .chatboxtitle').html() +' says...';
					titleChanged = 1;
					break;	
				}
			}
		}
		
		if (titleChanged == 0) {
			document.title = originalTitle;
			blinkOrder = 0;
		} else {
			++blinkOrder;
		}

	} else {
		for (x in newMessagesWin) {
			newMessagesWin[x] = false;
		}
	}

	for (x in newMessages) {
		if (newMessages[x] == true) {
			if (chatboxFocus[x] == false) {
				//FIXME: add toggle all or none policy, otherwise it looks funny
				$('#chatbox_'+x+' .chatboxhead').toggleClass('chatboxblink');
			}
		}
	}
	
	$.ajax({
	  url: im_cfg.rootPath + "instant_messenger.php",
	  data: {action: 'chatheartbeat'},
	  success: function(data) {

		$.each(data.items, function(i,item){
			if (item)	{ // fix strange ie bug

				chatboxtitle = item.f;

				if ($("#chatbox_"+chatboxtitle).length <= 0) {
					createChatBox(chatboxtitle, item.f_name);
				}
				if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
					$("#chatbox_"+chatboxtitle).css('display','block');
					restructureChatBoxes();
				}

				if (item.s == 1) {
					item.f = username;
				} else {
					item.f = item.f_name;
				}

				if (item.s == 2) {
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxinfo"><span class="chatboxinfo">'+item.m+'</span></div>');
				} else {
					newMessages[chatboxtitle] = true;
					newMessagesWin[chatboxtitle] = true;
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+item.f+' : &nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');
					if ( im_cfg.enableSound)
						$.dbj_sound.play('#im_msg_arrived');
				}

				$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
				itemsfound += 1;
			}
		});

		chatHeartbeatCount++;

		if (itemsfound > 0) {
			chatHeartbeatTime = minChatHeartbeat;
			chatHeartbeatCount = 1;
		} else if (chatHeartbeatCount >= 10) {
			chatHeartbeatTime *= 2;
			chatHeartbeatCount = 1;
			if (chatHeartbeatTime > maxChatHeartbeat) {
				chatHeartbeatTime = maxChatHeartbeat;
			}
		}
		
		setTimeout('chatHeartbeat();',chatHeartbeatTime);
	}});
});}

function closeChatBox(chatboxtitle) {jQuery(function($){               
	//$('#chatbox_'+chatboxtitle).css('display','none');
	$('#chatbox_'+chatboxtitle).fadeOut('slow');
	restructureChatBoxes();

	$.ajax({
		data: { action: 'closechat', chatbox: chatboxtitle},
		error: function(){
			alert( 'AJAX Error: closeChatBox()');
		},
		success: function( data){
		}
	});
});}

function toggleChatBoxGrowth(chatboxtitle) {jQuery(function($){
	if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') == 'none') {  
		
		var minimizedChatBoxes = new Array();
		
		if ($.cookie('chatbox_minimized')) {
			minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
		}
	
		var newCookie = '';
	
		for (i=0;i<minimizedChatBoxes.length;i++) {
			if (minimizedChatBoxes[i] != chatboxtitle) {
				newCookie += chatboxtitle+'|';
			}
		}
	
		newCookie = newCookie.slice(0, -1)
	
	
		$.cookie('chatbox_minimized', newCookie);
		//$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','block');
		//$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','block');
		$('#chatbox_'+chatboxtitle+' .chatboxcontent').slideDown();
		$('#chatbox_'+chatboxtitle+' .chatboxinput').slideDown();
		
		$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
	} else {
		
		var newCookie = chatboxtitle;
	
		if ($.cookie('chatbox_minimized')) {
			newCookie += '|'+$.cookie('chatbox_minimized');
		}
	
	
		$.cookie('chatbox_minimized',newCookie);
		//$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
		//$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
		$('#chatbox_'+chatboxtitle+' .chatboxcontent').slideUp();
		$('#chatbox_'+chatboxtitle+' .chatboxinput').slideUp();
	}
});}

function checkChatBoxInputKey(event,chatboxtextarea,chatboxtitle, s_username) {jQuery(function($){
	if(event.keyCode == 13 && event.shiftKey == 0)  {
		s_message = $(chatboxtextarea).val();
		s_message = s_message.replace(/^\s+|\s+$/g,"");

		$(chatboxtextarea).val('');
		$(chatboxtextarea).focus();
		$(chatboxtextarea).css('height','16px');

		if (s_message != '') {
			
			$.ajax({
				type: 'post',
				cache: false,
				dataType: 'json',
				url: im_cfg.rootPath + 'instant_messenger.php',
				data: { action: 'sendchat', uid: chatboxtitle, uname: s_username, message: s_message},
				error: function(){
					alert( 'AJAX Error: checkChatBoxInputKey()');
				},
				success: function( data){
					
					if ( data === true) {
						s_message = s_message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");
						$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+username+' : &nbsp;</span><span class="chatboxmessagecontent">'+s_message+'</span></div>');
						$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
					}
				}
			});
		}
		chatHeartbeatTime = minChatHeartbeat;
		chatHeartbeatCount = 1;

		return false;
	}

	var adjustedHeight = chatboxtextarea.clientHeight;
	var maxHeight = 60;

	if (maxHeight > adjustedHeight) {
		adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);
		if (maxHeight)
			adjustedHeight = Math.min(maxHeight, adjustedHeight);
		if (adjustedHeight > chatboxtextarea.clientHeight)
			$(chatboxtextarea).css('height',adjustedHeight+8 +'px');
	} else {
		$(chatboxtextarea).css('overflow','auto');
	}
});}

function startChatSession(){jQuery(function($){
	$.ajax({
		async: false,
		data: {action: 'startchatsession'},
		error: function (xhr, ajaxOptions, thrownError){
			alert( 'AJAX Error: startChatSession();\n'+xhr.status+'\n'+thrownError);
		},
		success: function(data) {
			username = data.username;

			$.each(data.items, function(i,item){
				if (item)	{ // fix strange ie bug
	
					chatboxtitle = item.f;
	
					if ($("#chatbox_"+chatboxtitle).length <= 0) {
						createChatBox(chatboxtitle,item.f_name,1);
					}
					
					if (item.s == 1) {
						item.f = username;
					} else {
						item.f = item.f_name;
					}
	
					if (item.s == 2) {
						$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxinfo"><span class="chatboxinfo">'+item.m+'</span></div>');
					} else {
						$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+item.f+' : &nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');
					}
				}
			});
			
			for (i=0;i<chatBoxes.length;i++) {
				chatboxtitle = chatBoxes[i];
				$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
				setTimeout('jQuery(function($){$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);});', 100); // yet another strange ie bug
			}
		
		setTimeout('chatHeartbeat();',chatHeartbeatTime);
		}
	});
});}

/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};                             