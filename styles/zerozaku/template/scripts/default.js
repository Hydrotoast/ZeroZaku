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

function shConfig(templatePath) {
	SyntaxHighlighter.config.bloggerMode = true;
	SyntaxHighlighter.defaults['toolbar'] = false;
	SyntaxHighlighter.autoloader(
		[ 'applescript',					templatePath + '/scripts/languages/shBrushAppleScript.js' ],
		[ 'actionscript3', 'as3',			templatePath + '/scripts/languages/shBrushAS3.js' ],
		[ 'bash', 'shell',					templatePath + '/scripts/languages/shBrushBash.js' ],
		[ 'coldfusion', 'cf',				templatePath + '/scripts/languages/shBrushColdFusion.js' ],
		[ 'cpp', 'c',						templatePath + '/scripts/languages/shBrushCpp.js' ],
		[ 'c#', 'c-sharp', 'csharp',		templatePath + '/scripts/languages/shBrushCSharp.js' ],
		[ 'css',							templatePath + '/scripts/languages/shBrushCss.js' ],
		[ 'delphi', 'pascal',				templatePath + '/scripts/languages/shBrushDelphi.js' ],
		[ 'diff', 'patch', 'pas',			templatePath + '/scripts/languages/shBrushDiff.js' ],
		[ 'erl', 'erlang',					templatePath + '/scripts/languages/shBrushErlang.js' ],
		[ 'groovy',							templatePath + '/scripts/languages/shBrushGroovy.js' ],
		[ 'java',							templatePath + '/scripts/languages/shBrushJava.js' ],
		[ 'jfx', 'javafx',					templatePath + '/scripts/languages/shBrushJavaFX.js' ],
		[ 'js', 'jscript', 'javascript',	templatePath + '/scripts/languages/shBrushJScript.js' ],
		[ 'perl', 'pl',						templatePath + '/scripts/languages/shBrushPerl.js' ],
		[ 'php',							templatePath + '/scripts/languages/shBrushPhp.js' ],
		[ 'text', 'plain',					templatePath + '/scripts/languages/shBrushPlain.js' ],
		[ 'py', 'python',					templatePath + '/scripts/languages/shBrushPython.js' ],
		[ 'ruby', 'rails', 'ror', 'rb',		templatePath + '/scripts/languages/shBrushRuby.js' ],
		[ 'scala',							templatePath + '/scripts/languages/shBrushScala.js' ],
		[ 'sql',							templatePath + '/scripts/languages/shBrushSql.js' ],
		[ 'vb', 'vbnet',					templatePath + '/scripts/languages/shBrushVb.js' ],
		[ 'xml', 'xhtml', 'xslt', 'html',	templatePath + '/scripts/languages/shBrushXml.js' ]
	);
	SyntaxHighlighter.all();
}

/**
* phpBB3 forum functions
*/
(function($){$.fn.growing=function(options){var settings=$.extend({maxHeight:400,minHeight:40,buffer:0},options);return this.each(function(){var textarea=$(this);var minh=textarea.height()>settings.minHeight?textarea.height():settings.minHeight;var w=parseInt(textarea.width()||textarea.css("width"));var div=$("<div class='faketextarea' style='position:absolute;left:-10000px;width:"+w+"px;'></div>");textarea.after(div);var resizeBox=function(){var html=textarea.val().replace(/(<|>)/g,'').replace(/\n/g,"<br>|");if(html!=div.html()){div.html(html);var h=div.height();prevh=textarea.height();var newh=h<=minh?minh:(h>settings.maxHeight?settings.maxHeight:h);newh+=settings.buffer;if(newh>=settings.maxHeight){textarea.css("overflow","auto")}else{textarea.css("overflow","hidden")}textarea.css({"height":newh+"px"})}};textarea.keydown(resizeBox);textarea.keyup(resizeBox);resizeBox()})}})(jQuery);

/*
var cookie = readCookie("style");
var title = cookie ? cookie : getPreferredStyleSheet();
setActiveStyleSheet(title);
*/