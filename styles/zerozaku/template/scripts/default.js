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
				width: '75%'
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
		[ 'au3', 'autoit',					templatePath + '/scripts/languages/shBrushAutoit.js' ],
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
function popup(url,width,height,name){if(!name){name="_popup"}window.open(url.replace(/&amp;/g,"&"),name,"height="+height+",resizable=yes,scrollbars=yes, width="+width);return false}function jumpto(){var page=prompt(jump_page,on_page);if(page!==null&&!isNaN(page)&&page==Math.floor(page)&&page>0){if(base_url.indexOf("?")==-1){document.location.href=base_url+"?start="+((page-1)*per_page)}else{document.location.href=base_url.replace(/&amp;/g,"&")+"&start="+((page-1)*per_page)}}}function marklist(id,name,state){var parent=document.getElementById(id);if(!parent){eval("parent = document."+id)}if(!parent){return}var rb=parent.getElementsByTagName("input");for(var r=0;r<rb.length;r++){if(rb[r].name.substr(0,name.length)==name){rb[r].checked=state}}}function viewableArea(e,itself){if(!e){return}if(!itself){e=e.parentNode}if(!e.vaHeight){e.vaHeight=e.offsetHeight;e.vaMaxHeight=e.style.maxHeight;e.style.height="auto";e.style.maxHeight="none";e.style.overflow="visible"}else{e.style.height=e.vaHeight+"px";e.style.overflow="auto";e.style.maxHeight=e.vaMaxHeight;e.vaHeight=false}}function dE(n,s){var e=document.getElementById(n);if(!s){s=(e.style.display==""||e.style.display=="block")?-1:1}e.style.display=(s==1)?"block":"none"}function subPanels(p){var i,e,t;if(typeof(p)=="string"){show_panel=p}for(i=0;i<panels.length;i++){e=document.getElementById(panels[i]);t=document.getElementById(panels[i]+"-tab");if(e){if(panels[i]==show_panel){e.style.display="block";if(t){t.className="activetab"}}else{e.style.display="none";if(t){t.className=""}}}}}function printPage(){if(is_ie){printPreview()}else{window.print()}}function displayBlocks(c,e,t){var s=(e.checked==true)?1:-1;if(t){s*=-1}var divs=document.getElementsByTagName("DIV");for(var d=0;d<divs.length;d++){if(divs[d].className.indexOf(c)==0){divs[d].style.display=(s==1)?"none":"block"}}}function selectCode(a){var e=a.parentNode.parentNode.getElementsByTagName("CODE")[0];if(window.getSelection){var s=window.getSelection();if(s.setBaseAndExtent){s.setBaseAndExtent(e,0,e,e.innerText.length-1)}else{if(window.opera&&e.innerHTML.substring(e.innerHTML.length-4)=="<BR>"){e.innerHTML=e.innerHTML+"&nbsp;"}var r=document.createRange();r.selectNodeContents(e);s.removeAllRanges();s.addRange(r)}}else{if(document.getSelection){var s=document.getSelection();var r=document.createRange();r.selectNodeContents(e);s.removeAllRanges();s.addRange(r)}else{if(document.selection){var r=document.body.createTextRange();r.moveToElementText(e);r.select()}}}}function play_qt_file(obj){var rectangle=obj.GetRectangle();if(rectangle){rectangle=rectangle.split(",");var x1=parseInt(rectangle[0]);var x2=parseInt(rectangle[2]);var y1=parseInt(rectangle[1]);var y2=parseInt(rectangle[3]);var width=(x1<0)?(x1*-1)+x2:x2-x1;var height=(y1<0)?(y1*-1)+y2:y2-y1}else{var width=200;var height=0}obj.width=width;obj.height=height+16;obj.SetControllerVisible(true);obj.Play()}function display(action,id){if(action=="show"){document.getElementById("explanation"+id).style.display="block";document.getElementById("link"+id).href="javascript:display('hide', "+id+")"}if(action=="hide"){document.getElementById("explanation"+id).style.display="none";document.getElementById("link"+id).href="javascript:display('show', "+id+")"}}function is_node_name(elem,name){return elem.nodeName&&elem.nodeName.toUpperCase()==name.toUpperCase()}function is_in_array(elem,array){for(var i=0,length=array.length;i<length;i++){if(array[i]===elem){return i}}return -1}function find_in_tree(node,tag,type,class_name){var result,element,i=0,length=node.childNodes.length;for(element=node.childNodes[0];i<length;element=node.childNodes[++i]){if(!element||element.nodeType!=1){continue}if((!tag||is_node_name(element,tag))&&(!type||element.type==type)&&(!class_name||is_in_array(class_name,(element.className||element).toString().split(/\s+/))>-1)){return element}if(element.childNodes.length){result=find_in_tree(element,tag,type,class_name)}if(result){return result}}}var in_autocomplete=false;var last_key_entered="";function phpbb_check_key(event){if(event.keyCode&&(event.keyCode==40||event.keyCode==38)){in_autocomplete=true}if(in_autocomplete){if(!last_key_entered||last_key_entered==event.which){in_autocompletion=false;return true}}if(event.which!=13){last_key_entered=event.which;return true}return false}function submit_default_button(event,selector,class_name){if(!event.which&&((event.charCode||event.charCode===0)?event.charCode:event.keyCode)){event.which=event.charCode||event.keyCode}if(phpbb_check_key(event)){return true}var current=selector.parentNode;while(current&&(!current.nodeName||current.nodeType!=1||!is_node_name(current,"form"))&&current!=document){current=current.parentNode}var input_tags=current.getElementsByTagName("input");current=false;for(var i=0,element=input_tags[0];i<input_tags.length;element=input_tags[++i]){if(element.type=="submit"&&is_in_array(class_name,(element.className||element).toString().split(/\s+/))>-1){current=element}}if(!current){return true}current.focus();current.click();return false}function apply_onkeypress_event(){if(jquery_present){jQuery("form input[type=text], form input[type=password]").live("keypress",function(e){var default_button=jQuery(this).parents("form").find("input[type=submit].default-submit-action");if(!default_button||default_button.length<=0){return true}if(phpbb_check_key(e)){return true}if((e.which&&e.which==13)||(e.keyCode&&e.keyCode==13)){default_button.click();return false}return true});return}var input_tags=document.getElementsByTagName("input");for(var i=0,element=input_tags[0];i<input_tags.length;element=input_tags[++i]){if(element.type=="text"||element.type=="password"){element.onkeypress=function(evt){submit_default_button((evt||window.event),this,"default-submit-action")}}}}var jquery_present=typeof jQuery=="function";
/*
var cookie = readCookie("style");
var title = cookie ? cookie : getPreferredStyleSheet();
setActiveStyleSheet(title);
*/