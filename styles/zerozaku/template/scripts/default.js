/* ZeroZaku Initialization
 * Copyright (c) 2009, 2010 Gio Borje (http://www.zerozaku.com)
 */
var config = {
	root_path: '',
	template_path: '',
	theme_path: '',
	im_started: false
};

function init(t_root_path, t_template_path, t_theme_path) {
	config.root_path = t_root_path;
	config.template_path = t_template_path;
	config.theme_path = t_theme_path;
	
	collapse();
	shConfig();
};

$(function() {
	$.jGrowl.defaults.pool = 5; 
	
	$('textarea#message').growing({maxHeight: 540, buffer: 0});
	$('textarea').tabby();
	
	// Handle ad clicks
	$('a.ad').click(function() {
		var ad_id = $(this).attr('rel');
		$.get(config.root_path + 'affiliate.php?mode=click&a=' + ad_id);
	});
	
	if(localStorage.getItem('sidebar_side') == 'left')
		$('#page-sidebar').addClass('left');
	
	// Starts IM
	if(localStorage.getItem('im_open') == null || localStorage.getItem('im_open') == 'true')
	{
		$('#site-bottom-bar').hide();
		$('#site-bottom-bar-frame').hide();
		$('#im_open').show();
	}
	else load_startIM({rootPath: config.root_path, themePath: config.theme_path, started: true});
	
	// Closes IM
	$('.button[rel=im_close]').click(function() {
		localStorage.setItem('im_open', 'true');
		$('#site-bottom-bar').hide();
		$('#site-bottom-bar-frame').hide();
		$('#im_open').show();
		$.jGrowl('Instant Messenger has been closed. You will not receive IMs during this time, but your site performance will increase');
	});
	
	// Opens IM
	$('#im_open').click(function() {
		if (config.im_started == false)
		{
			load_startIM({rootPath: config.root_path, themePath: config.theme_path});
			config.im_started = true;
		}
		
		localStorage.setItem('im_open', 'false');
		$(this).hide();
		$('#site-bottom-bar').show();
		$('#site-bottom-bar-frame').show();
		$.jGrowl('Instant Messenger has been opened. You will receive IMs again, but your site performance will decrease');
	});
	
	// Toggles the quick login panel
	var quickpanel = $('#quickpanel');
	$('a.quick').toggle(function() {
		quickpanel.slideDown();
		return false;
	}, function() {
		quickpanel.slideUp();
		return false;
	});
	
	$('a[rel*=add_rec]').click(function() {
		var user_id = $(this).attr('alt');
		$.ajax({
			url: config.root_path + 'ucp.php?i=ajax&mode=add_rec&rec_id=' + user_id,
			type: 'GET',
			success: function(data) {
				if(data == 'true') 
					$.jGrowl('Friend request sent to user');
				else if(data == 'false')
					$.jGrowl('Request already sent or user is already friend');
			}
		});
		return false;
	});
	
	$("a.collapse").click(function() {
		var forum_id = $(this).attr("rel");
		var collapsed = localStorage.getItem(forum_id);
		
		if(!collapsed)
		{
			localStorage.setItem(forum_id, "true");
			var parent = $(this).parent("h2.cattitle");
			$(parent).next(".forabg").slideUp();
			$(parent).addClass("collapsed");
			$(this).children("img").attr("src", config.theme_path + "/images/plus_alt_24x24.png");
			$.jGrowl('Forum collapsed');
		}
		else
		{
			if(collapsed == "true")
			{
				localStorage.setItem(forum_id, "false");
				var parent = $(this).parent("h2.cattitle");
				$(parent).next(".forabg").slideDown();
				$(parent).removeClass("collapsed");;
				$(this).children("img").attr("src", config.theme_path + "/images/minus_alt_24x24.png");
				$.jGrowl('Forum opened');
			}
			else
			{
				localStorage.setItem(forum_id, "true");
				var parent = $(this).parent("h2.cattitle");
				$(parent).next(".forabg").slideUp();
				$(parent).addClass("collapsed");
				$(this).children("img").attr("src", config.theme_path + "/images/plus_alt_24x24.png");
				$.jGrowl('Forum collapsed');
			}
		}

		return false;
	});
	
	/* Window resize event handler
	$(window).resize(function(){
		var window_width = $(window).width();
		
		if (window_width > 1000) {
			$('#page-body').stop().animate({
				width: '72%'
			}, 600, 'swing', function()
			{
				$('#page-sidebar').show();
			});
		}
		else
		{
			$('#page-sidebar').fadeOut(function(){
				$('#page-body').animate({
					width: '100%'
				}, 600, 'swing');
			});
		}
	});*/
});

function collapse() {
	// Collapses forums
	$('a.collapse').each(function(index) {
		var forum_id = $(this).attr('rel');
		
		if(localStorage.getItem(forum_id) == 'true')
		{
			var parent = $(this).parent('h2.cattitle');
			$(parent).next('.forabg').hide();
			$(parent).addClass('collapsed');
			$(this).children('img').attr('src', config.theme_path + '/images/plus_alt_24x24.png');
		}
	});
}

function shConfig() {
	SyntaxHighlighter.config.bloggerMode = true;
	SyntaxHighlighter.defaults['toolbar'] = false;
	SyntaxHighlighter.autoloader(
		[ 'applescript',					config.template_path + '/scripts/languages/shBrushAppleScript.js' ],
		[ 'actionscript', 'as',				config.template_path + '/scripts/languages/shBrushAS3.js' ],
		[ 'au', 'autoit',					config.template_path + '/scripts/languages/shBrushAutoit.js' ],
		[ 'bash', 'shell',					config.template_path + '/scripts/languages/shBrushBash.js' ],
		[ 'coldfusion', 'cf',				config.template_path + '/scripts/languages/shBrushColdFusion.js' ],
		[ 'cpp', 'c',						config.template_path + '/scripts/languages/shBrushCpp.js' ],
		[ 'c#', 'c-sharp', 'csharp',		config.template_path + '/scripts/languages/shBrushCSharp.js' ],
		[ 'css',							config.template_path + '/scripts/languages/shBrushCss.js' ],
		[ 'delphi', 'pascal',				config.template_path + '/scripts/languages/shBrushDelphi.js' ],
		[ 'diff', 'patch', 'pas',			config.template_path + '/scripts/languages/shBrushDiff.js' ],
		[ 'erl', 'erlang',					config.template_path + '/scripts/languages/shBrushErlang.js' ],
		[ 'groovy',							config.template_path + '/scripts/languages/shBrushGroovy.js' ],
		[ 'java',							config.template_path + '/scripts/languages/shBrushJava.js' ],
		[ 'jfx', 'javafx',					config.template_path + '/scripts/languages/shBrushJavaFX.js' ],
		[ 'js', 'jscript', 'javascript',	config.template_path + '/scripts/languages/shBrushJScript.js' ],
		[ 'perl', 'pl',						config.template_path + '/scripts/languages/shBrushPerl.js' ],
		[ 'php',							config.template_path + '/scripts/languages/shBrushPhp.js' ],
		[ 'text', 'plain',					config.template_path + '/scripts/languages/shBrushPlain.js' ],
		[ 'py', 'python',					config.template_path + '/scripts/languages/shBrushPython.js' ],
		[ 'ruby', 'rails', 'ror', 'rb',		config.template_path + '/scripts/languages/shBrushRuby.js' ],
		[ 'scala',							config.template_path + '/scripts/languages/shBrushScala.js' ],
		[ 'sql',							config.template_path + '/scripts/languages/shBrushSql.js' ],
		[ 'vb', 'vbnet',					config.template_path + '/scripts/languages/shBrushVb.js' ],
		[ 'xml', 'xhtml', 'xslt', 'html',	config.template_path + '/scripts/languages/shBrushXml.js' ]
	);
	SyntaxHighlighter.all();
}

/**
* phpBB3 forum functions
*/
function popup(url,width,height,name){if(!name){name="_popup"}window.open(url.replace(/&amp;/g,"&"),name,"height="+height+",resizable=yes,scrollbars=yes, width="+width);return false}function jumpto(){var page=prompt(jump_page,on_page);if(page!==null&&!isNaN(page)&&page==Math.floor(page)&&page>0){if(base_url.indexOf("?")==-1){document.location.href=base_url+"?start="+((page-1)*per_page)}else{document.location.href=base_url.replace(/&amp;/g,"&")+"&start="+((page-1)*per_page)}}}function marklist(id,name,state){var parent=document.getElementById(id);if(!parent){eval("parent = document."+id)}if(!parent){return}var rb=parent.getElementsByTagName("input");for(var r=0;r<rb.length;r++){if(rb[r].name.substr(0,name.length)==name){rb[r].checked=state}}}function viewableArea(e,itself){if(!e){return}if(!itself){e=e.parentNode}if(!e.vaHeight){e.vaHeight=e.offsetHeight;e.vaMaxHeight=e.style.maxHeight;e.style.height="auto";e.style.maxHeight="none";e.style.overflow="visible"}else{e.style.height=e.vaHeight+"px";e.style.overflow="auto";e.style.maxHeight=e.vaMaxHeight;e.vaHeight=false}}function dE(n,s){var e=document.getElementById(n);if(!s){s=(e.style.display==""||e.style.display=="block")?-1:1}e.style.display=(s==1)?"block":"none"}function subPanels(p){var i,e,t;if(typeof(p)=="string"){show_panel=p}for(i=0;i<panels.length;i++){e=document.getElementById(panels[i]);t=document.getElementById(panels[i]+"-tab");if(e){if(panels[i]==show_panel){e.style.display="block";if(t){t.className="activetab"}}else{e.style.display="none";if(t){t.className=""}}}}}function printPage(){if(is_ie){printPreview()}else{window.print()}}function displayBlocks(c,e,t){var s=(e.checked==true)?1:-1;if(t){s*=-1}var divs=document.getElementsByTagName("DIV");for(var d=0;d<divs.length;d++){if(divs[d].className.indexOf(c)==0){divs[d].style.display=(s==1)?"none":"block"}}}function selectCode(a){var e=a.parentNode.parentNode.getElementsByTagName("CODE")[0];if(window.getSelection){var s=window.getSelection();if(s.setBaseAndExtent){s.setBaseAndExtent(e,0,e,e.innerText.length-1)}else{if(window.opera&&e.innerHTML.substring(e.innerHTML.length-4)=="<BR>"){e.innerHTML=e.innerHTML+"&nbsp;"}var r=document.createRange();r.selectNodeContents(e);s.removeAllRanges();s.addRange(r)}}else{if(document.getSelection){var s=document.getSelection();var r=document.createRange();r.selectNodeContents(e);s.removeAllRanges();s.addRange(r)}else{if(document.selection){var r=document.body.createTextRange();r.moveToElementText(e);r.select()}}}}function play_qt_file(obj){var rectangle=obj.GetRectangle();if(rectangle){rectangle=rectangle.split(",");var x1=parseInt(rectangle[0]);var x2=parseInt(rectangle[2]);var y1=parseInt(rectangle[1]);var y2=parseInt(rectangle[3]);var width=(x1<0)?(x1*-1)+x2:x2-x1;var height=(y1<0)?(y1*-1)+y2:y2-y1}else{var width=200;var height=0}obj.width=width;obj.height=height+16;obj.SetControllerVisible(true);obj.Play()}function display(action,id){if(action=="show"){document.getElementById("explanation"+id).style.display="block";document.getElementById("link"+id).href="javascript:display('hide', "+id+")"}if(action=="hide"){document.getElementById("explanation"+id).style.display="none";document.getElementById("link"+id).href="javascript:display('show', "+id+")"}}function is_node_name(elem,name){return elem.nodeName&&elem.nodeName.toUpperCase()==name.toUpperCase()}function is_in_array(elem,array){for(var i=0,length=array.length;i<length;i++){if(array[i]===elem){return i}}return -1}function find_in_tree(node,tag,type,class_name){var result,element,i=0,length=node.childNodes.length;for(element=node.childNodes[0];i<length;element=node.childNodes[++i]){if(!element||element.nodeType!=1){continue}if((!tag||is_node_name(element,tag))&&(!type||element.type==type)&&(!class_name||is_in_array(class_name,(element.className||element).toString().split(/\s+/))>-1)){return element}if(element.childNodes.length){result=find_in_tree(element,tag,type,class_name)}if(result){return result}}}var in_autocomplete=false;var last_key_entered="";function phpbb_check_key(event){if(event.keyCode&&(event.keyCode==40||event.keyCode==38)){in_autocomplete=true}if(in_autocomplete){if(!last_key_entered||last_key_entered==event.which){in_autocompletion=false;return true}}if(event.which!=13){last_key_entered=event.which;return true}return false}function submit_default_button(event,selector,class_name){if(!event.which&&((event.charCode||event.charCode===0)?event.charCode:event.keyCode)){event.which=event.charCode||event.keyCode}if(phpbb_check_key(event)){return true}var current=selector.parentNode;while(current&&(!current.nodeName||current.nodeType!=1||!is_node_name(current,"form"))&&current!=document){current=current.parentNode}var input_tags=current.getElementsByTagName("input");current=false;for(var i=0,element=input_tags[0];i<input_tags.length;element=input_tags[++i]){if(element.type=="submit"&&is_in_array(class_name,(element.className||element).toString().split(/\s+/))>-1){current=element}}if(!current){return true}current.focus();current.click();return false}function apply_onkeypress_event(){if(jquery_present){jQuery("form input[type=text], form input[type=password]").live("keypress",function(e){var default_button=jQuery(this).parents("form").find("input[type=submit].default-submit-action");if(!default_button||default_button.length<=0){return true}if(phpbb_check_key(e)){return true}if((e.which&&e.which==13)||(e.keyCode&&e.keyCode==13)){default_button.click();return false}return true});return}var input_tags=document.getElementsByTagName("input");for(var i=0,element=input_tags[0];i<input_tags.length;element=input_tags[++i]){if(element.type=="text"||element.type=="password"){element.onkeypress=function(evt){submit_default_button((evt||window.event),this,"default-submit-action")}}}}var jquery_present=typeof jQuery=="function";
/*
var cookie = readCookie("style");
var title = cookie ? cookie : getPreferredStyleSheet();
setActiveStyleSheet(title);
*/