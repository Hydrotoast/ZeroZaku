/* Copyright (c) 2009 Jon Rohan (http://dinnermint.org)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 * Written with jQuery 1.3.2
 */
(function($){
  $.fn.growing = function(options){
    var settings = $.extend({
       maxHeight: 400,
       minHeight: 40,
       buffer: 0
    }, options);
    return this.each(function(){
      var textarea = $(this); //cache the textarea
      var minh = textarea.height()>settings.minHeight?textarea.height():settings.minHeight;
      var w = parseInt(textarea.width()||textarea.css("width")); //get the width of the textarea
      var div = $("<div class='faketextarea' style='position:absolute;left:-10000px;width:" + w + "px;'></div>");
      textarea.after(div);
      var resizeBox = function(){
        var html = textarea.val().replace(/(<|>)/g, '').replace(/\n/g,"<br>|");
        if(html!=div.html()) {
          div.html(html);
          var h = div.height();
          prevh = textarea.height();
          var newh = h<=minh?minh:(h>settings.maxHeight?settings.maxHeight:h);
          newh += settings.buffer;
          if(newh>=settings.maxHeight) {
            textarea.css("overflow","auto");
          } else {
            textarea.css("overflow","hidden");
          }
          textarea.css({"height":newh+"px"});
        }
      };
      textarea.keydown(resizeBox);
      textarea.keyup(resizeBox);
      resizeBox();
    });
  };
})(jQuery);

$(function() {
	$.tools.overlay.conf.effect = "apple";
	var quickpanel = $("#quickpanel");
	$("textarea#message").growing({maxHeight: 540, buffer: 1});
	
	// Toggles the quick login panel
	$("a.quick").toggle(function() {
		var module = $(this).attr("rel");
		
		$(module).stop().show();
		quickpanel.stop().slideDown();
		
		return false; // Progressive enhancement
	}, function() {
		var module = $(this).attr("rel");
		
		$(module).stop().hide();
		quickpanel.stop().slideUp();
		
		return false; // Progressive enhancement
	});
	
	$(window).resize(function(){
		var window_width = $(window).width();
		
		if (window_width > 950) {
			$("#page-body").stop().animate({
				width: '82%'
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
	
	$(".slider").children("br").remove();
	$(".slider").nivoSlider();
});

function popup(url,width,height,name){if(!name){name='_popup'}window.open(url.replace(/&amp;/g,'&'),name,'height='+height+',resizable=yes,scrollbars=yes, width='+width);return false}function jumpto(){var page=prompt(jump_page,on_page);if(page!==null&&!isNaN(page)&&page==Math.floor(page)&&page>0){if(base_url.indexOf('?')==-1){document.location.href=base_url+'?start='+((page-1)*per_page)}else{document.location.href=base_url.replace(/&amp;/g,'&')+'&start='+((page-1)*per_page)}}}function marklist(id,name,state){var parent=document.getElementById(id);if(!parent){eval('parent = document.'+id)}if(!parent){return}var rb=parent.getElementsByTagName('input');for(var r=0;r<rb.length;r++){if(rb[r].name.substr(0,name.length)==name){rb[r].checked=state}}}function viewableArea(e,itself){if(!e)return;if(!itself){e=e.parentNode}if(!e.vaHeight){e.vaHeight=e.offsetHeight;e.vaMaxHeight=e.style.maxHeight;e.style.height='auto';e.style.maxHeight='none';e.style.overflow='visible'}else{e.style.height=e.vaHeight+'px';e.style.overflow='auto';e.style.maxHeight=e.vaMaxHeight;e.vaHeight=false}}function dE(n,s){var e=document.getElementById(n);if(!s){s=(e.style.display==''||e.style.display=='block')?-1:1}e.style.display=(s==1)?'block':'none'}function subPanels(p){var i,e,t;if(typeof(p)=='string'){show_panel=p}for(i=0;i<panels.length;i++){e=document.getElementById(panels[i]);t=document.getElementById(panels[i]+'-tab');if(e){if(panels[i]==show_panel){e.style.display='block';if(t){t.className='activetab'}}else{e.style.display='none';if(t){t.className=''}}}}}function printPage(){if(is_ie){printPreview()}else{window.print()}}function displayBlocks(c,e,t){var s=(e.checked==true)?1:-1;if(t){s*=-1}var divs=document.getElementsByTagName("DIV");for(var d=0;d<divs.length;d++){if(divs[d].className.indexOf(c)==0){divs[d].style.display=(s==1)?'none':'block'}}}function selectCode(a){var e=a.parentNode.parentNode.getElementsByTagName('CODE')[0];if(window.getSelection){var s=window.getSelection();if(s.setBaseAndExtent){s.setBaseAndExtent(e,0,e,e.innerText.length-1)}else{if(window.opera&&e.innerHTML.substring(e.innerHTML.length-4)=='<BR>'){e.innerHTML=e.innerHTML+'&nbsp;'}var r=document.createRange();r.selectNodeContents(e);s.removeAllRanges();s.addRange(r)}}else if(document.getSelection){var s=document.getSelection();var r=document.createRange();r.selectNodeContents(e);s.removeAllRanges();s.addRange(r)}else if(document.selection){var r=document.body.createTextRange();r.moveToElementText(e);r.select()}}function play_qt_file(obj){var rectangle=obj.GetRectangle();if(rectangle){rectangle=rectangle.split(',');var x1=parseInt(rectangle[0]);var x2=parseInt(rectangle[2]);var y1=parseInt(rectangle[1]);var y2=parseInt(rectangle[3]);var width=(x1<0)?(x1*-1)+x2:x2-x1;var height=(y1<0)?(y1*-1)+y2:y2-y1}else{var width=200;var height=0}obj.width=width;obj.height=height+16;obj.SetControllerVisible(true);obj.Play()}var imageTag=false;var theSelection=false;var clientPC=navigator.userAgent.toLowerCase();var clientVer=parseInt(navigator.appVersion);var is_ie=((clientPC.indexOf('msie')!=-1)&&(clientPC.indexOf('opera')==-1));var is_win=((clientPC.indexOf('win')!=-1)||(clientPC.indexOf('16bit')!=-1));var baseHeight;function helpline(help){document.forms[form_name].helpbox.value=help_line[help]}function initInsertions(){var doc;if(document.forms[form_name]){doc=document}else{doc=opener.document}var textarea=doc.forms[form_name].elements[text_name];if(is_ie&&typeof(baseHeight)!='number'){textarea.focus();baseHeight=doc.selection.createRange().duplicate().boundingHeight;if(!document.forms[form_name]){document.body.focus()}}}function bbstyle(bbnumber){if(bbnumber!=-1){bbfontstyle(bbtags[bbnumber],bbtags[bbnumber+1])}else{insert_text('[*]');document.forms[form_name].elements[text_name].focus()}}function bbfontstyle(bbopen,bbclose){theSelection=false;var textarea=document.forms[form_name].elements[text_name];textarea.focus();if((clientVer>=4)&&is_ie&&is_win){theSelection=document.selection.createRange().text;if(theSelection){document.selection.createRange().text=bbopen+theSelection+bbclose;document.forms[form_name].elements[text_name].focus();theSelection='';return}}else if(document.forms[form_name].elements[text_name].selectionEnd&&(document.forms[form_name].elements[text_name].selectionEnd-document.forms[form_name].elements[text_name].selectionStart>0)){mozWrap(document.forms[form_name].elements[text_name],bbopen,bbclose);document.forms[form_name].elements[text_name].focus();theSelection='';return}var caret_pos=getCaretPosition(textarea).start;var new_pos=caret_pos+bbopen.length;insert_text(bbopen+bbclose);if(!isNaN(textarea.selectionStart)){textarea.selectionStart=new_pos;textarea.selectionEnd=new_pos}else if(document.selection){var range=textarea.createTextRange();range.move("character",new_pos);range.select();storeCaret(textarea)}textarea.focus();return}function insert_text(text,spaces,popup){var textarea;if(!popup){textarea=document.forms[form_name].elements[text_name]}else{textarea=opener.document.forms[form_name].elements[text_name]}if(spaces){text=' '+text+' '}if(!isNaN(textarea.selectionStart)){var sel_start=textarea.selectionStart;var sel_end=textarea.selectionEnd;mozWrap(textarea,text,'')textarea.selectionStart=sel_start+text.length;textarea.selectionEnd=sel_end+text.length}else if(textarea.createTextRange&&textarea.caretPos){if(baseHeight!=textarea.caretPos.boundingHeight){textarea.focus();storeCaret(textarea)}var caret_pos=textarea.caretPos;caret_pos.text=caret_pos.text.charAt(caret_pos.text.length-1)==' '?caret_pos.text+text+' ':caret_pos.text+text}else{textarea.value=textarea.value+text}if(!popup){textarea.focus()}}function attach_inline(index,filename){insert_text('[attachment='+index+']'+filename+'[/attachment]');document.forms[form_name].elements[text_name].focus()}function addquote(post_id,username){var message_name='message_'+post_id;var theSelection='';var divarea=false;if(document.all){divarea=document.all[message_name]}else{divarea=document.getElementById(message_name)}if(window.getSelection){theSelection=window.getSelection().toString()}else if(document.getSelection){theSelection=document.getSelection()}else if(document.selection){theSelection=document.selection.createRange().text}if(theSelection==''||typeof theSelection=='undefined'||theSelection==null){if(divarea.innerHTML){theSelection=divarea.innerHTML.replace(/<br>/ig,'\n');theSelection=theSelection.replace(/<br\/>/ig,'\n');theSelection=theSelection.replace(/&lt\;/ig,'<');theSelection=theSelection.replace(/&gt\;/ig,'>');theSelection=theSelection.replace(/&amp\;/ig,'&');theSelection=theSelection.replace(/&nbsp\;/ig,' ')}else if(document.all){theSelection=divarea.innerText}else if(divarea.textContent){theSelection=divarea.textContent}else if(divarea.firstChild.nodeValue){theSelection=divarea.firstChild.nodeValue}}if(theSelection){insert_text('[quote="'+username+'"]'+theSelection+'[/quote]')}return}function mozWrap(txtarea,open,close){var selLength=txtarea.textLength;var selStart=txtarea.selectionStart;var selEnd=txtarea.selectionEnd;var scrollTop=txtarea.scrollTop;if(selEnd==1||selEnd==2){selEnd=selLength}var s1=(txtarea.value).substring(0,selStart);var s2=(txtarea.value).substring(selStart,selEnd)var s3=(txtarea.value).substring(selEnd,selLength);txtarea.value=s1+open+s2+close+s3;txtarea.selectionStart=selEnd+open.length+close.length;txtarea.selectionEnd=txtarea.selectionStart;txtarea.focus();txtarea.scrollTop=scrollTop;return}function storeCaret(textEl){if(textEl.createTextRange){textEl.caretPos=document.selection.createRange().duplicate()}}function colorPalette(dir,width,height){var r=0,g=0,b=0;var numberList=new Array(6);var color='';numberList[0]='00';numberList[1]='40';numberList[2]='80';numberList[3]='BF';numberList[4]='FF';document.writeln('<table cellspacing="1" cellpadding="0" border="0">');for(r=0;r<5;r++){if(dir=='h'){document.writeln('<tr>')}for(g=0;g<5;g++){if(dir=='v'){document.writeln('<tr>')}for(b=0;b<5;b++){color=String(numberList[r])+String(numberList[g])+String(numberList[b]);document.write('<td bgcolor="#'+color+'" style="width: '+width+'px; height: '+height+'px;">');document.write('<a href="#" onclick="bbfontstyle(\'[color=#'+color+']\', \'[/color]\'); return false;"><img src="images/spacer.gif" width="'+width+'" height="'+height+'" alt="#'+color+'" title="#'+color+'" /></a>');document.writeln('</td>')}if(dir=='v'){document.writeln('</tr>')}}if(dir=='h'){document.writeln('</tr>')}}document.writeln('</table>')}function caretPosition(){var start=null;var end=null}function getCaretPosition(txtarea){var caretPos=new caretPosition();if(txtarea.selectionStart||txtarea.selectionStart==0){caretPos.start=txtarea.selectionStart;caretPos.end=txtarea.selectionEnd}else if(document.selection){var range=document.selection.createRange();var range_all=document.body.createTextRange();range_all.moveToElementText(txtarea);var sel_start;for(sel_start=0;range_all.compareEndPoints('StartToStart',range)<0;sel_start++){range_all.moveStart('character',1)}txtarea.sel_start=sel_start;caretPos.start=txtarea.sel_start;caretPos.end=txtarea.sel_start}return caretPos}function fontsizeup(){var active=getActiveStyleSheet();switch(active){case'A--':setActiveStyleSheet('A-');break;case'A-':setActiveStyleSheet('A');break;case'A':setActiveStyleSheet('A+');break;case'A+':setActiveStyleSheet('A++');break;case'A++':setActiveStyleSheet('A');break;default:setActiveStyleSheet('A');break}}function fontsizedown(){active=getActiveStyleSheet();switch(active){case'A++':setActiveStyleSheet('A+');break;case'A+':setActiveStyleSheet('A');break;case'A':setActiveStyleSheet('A-');break;case'A-':setActiveStyleSheet('A--');break;case'A--':break;default:setActiveStyleSheet('A--');break}}function setActiveStyleSheet(title){var i,a,main;for(i=0;(a=document.getElementsByTagName('link')[i]);i++){if(a.getAttribute('rel').indexOf('style')!=-1&&a.getAttribute('title')){a.disabled=true;if(a.getAttribute('title')==title){a.disabled=false}}}}function getActiveStyleSheet(){var i,a;for(i=0;(a=document.getElementsByTagName('link')[i]);i++){if(a.getAttribute('rel').indexOf('style')!=-1&&a.getAttribute('title')&&!a.disabled){return a.getAttribute('title')}}return null}function getPreferredStyleSheet(){return('A-')}function createCookie(name,value,days){if(days){var date=new Date();date.setTime(date.getTime()+(days*24*60*60*1000));var expires='; expires='+date.toGMTString()}else{expires=''}document.cookie=name+'='+value+expires+style_cookie_settings}function readCookie(name){var nameEQ=name+'=';var ca=document.cookie.split(';');for(var i=0;i<ca.length;i++){var c=ca[i];while(c.charAt(0)==' '){c=c.substring(1,c.length)}if(c.indexOf(nameEQ)==0){return c.substring(nameEQ.length,c.length)}}return null}function load_cookie(){var cookie=readCookie('style_cookie');var title=cookie?cookie:getPreferredStyleSheet();setActiveStyleSheet(title)}function unload_cookie(){var title=getActiveStyleSheet();createCookie('style_cookie',title,365)}onload_functions.push('load_cookie()');onunload_functions.push('unload_cookie()');