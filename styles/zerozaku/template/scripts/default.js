/* Copyright (c) 2009 Jon Rohan (http://dinnermint.org)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 * Written with jQuery 1.3.2
 */
(function($){$.fn.growing=function(options){var settings=$.extend({maxHeight:400,minHeight:40,buffer:0},options);return this.each(function(){var textarea=$(this);var minh=textarea.height()>settings.minHeight?textarea.height():settings.minHeight;var w=parseInt(textarea.width()||textarea.css("width"));var div=$("<div class='faketextarea' style='position:absolute;left:-10000px;width:"+w+"px;'></div>");textarea.after(div);var resizeBox=function(){var html=textarea.val().replace(/(<|>)/g,'').replace(/\n/g,"<br>|");if(html!=div.html()){div.html(html);var h=div.height();prevh=textarea.height();var newh=h<=minh?minh:(h>settings.maxHeight?settings.maxHeight:h);newh+=settings.buffer;if(newh>=settings.maxHeight){textarea.css("overflow","auto")}else{textarea.css("overflow","hidden")}textarea.css({"height":newh+"px"})}};textarea.keydown(resizeBox);textarea.keyup(resizeBox);resizeBox()})}})(jQuery);


/* ZeroZaku Initialization
 * Copyright (c) 2009, 2010 Gio Borje (http://www.zerozaku.com)
 */
$(function() {
	var quickpanel = $("#quickpanel");
	$("textarea#message").growing({maxHeight: 540, buffer: 1});
	
	// Toggles the quick login panel
	$("a.quick").toggle(function() {
		var module = $(this).attr("rel");
		
		$(module).stop().show();
		quickpanel.stop().slideDown();
		
		return false;
	}, function() {
		var module = $(this).attr("rel");
		
		$(module).stop().hide();
		quickpanel.stop().slideUp();
		
		return false;
	});
	
	// Window resize event handler
	$(window).resize(function(){
		var window_width = $(window).width();
		
		if (window_width > 950) {
			$("#page-body").stop().animate({
				width: '80%'
			}, 600, 'swing', function()
			{
				$("#page-sidebar").show();
			});
		}
		else
		{
			$("#page-sidebar").fadeOut(function(){
				$("#page-body").animate({
					width: '100%'
				}, 600, 'swing');
			});
		}
	});
});

/**
* phpBB3 forum functions
*/
(function($){$.fn.growing=function(options){var settings=$.extend({maxHeight:400,minHeight:40,buffer:0},options);return this.each(function(){var textarea=$(this);var minh=textarea.height()>settings.minHeight?textarea.height():settings.minHeight;var w=parseInt(textarea.width()||textarea.css("width"));var div=$("<div class='faketextarea' style='position:absolute;left:-10000px;width:"+w+"px;'></div>");textarea.after(div);var resizeBox=function(){var html=textarea.val().replace(/(<|>)/g,'').replace(/\n/g,"<br>|");if(html!=div.html()){div.html(html);var h=div.height();prevh=textarea.height();var newh=h<=minh?minh:(h>settings.maxHeight?settings.maxHeight:h);newh+=settings.buffer;if(newh>=settings.maxHeight){textarea.css("overflow","auto")}else{textarea.css("overflow","hidden")}textarea.css({"height":newh+"px"})}};textarea.keydown(resizeBox);textarea.keyup(resizeBox);resizeBox()})}})(jQuery);

/*
var cookie = readCookie("style");
var title = cookie ? cookie : getPreferredStyleSheet();
setActiveStyleSheet(title);
*/