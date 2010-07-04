function SXBB_IsIEMac(){var ua=String(navigator.userAgent).toLowerCase();if(document.all&&ua.indexOf("mac")>=0){return true}return false}function SXBB_IsOverflowAble(){if(document.getElementById&&document.childNodes&&!SXBB_IsIEMac()){return true}return false}function _SXBB(id){this.id=id;this.size=this.min=70;this.extra=5;this.margin=20;this.T=[]}_SXBB.prototype.genCmd=function(cmd,txt){return'&nbsp;[&nbsp;<a href="javascript:void(0)" onclick="SXBB[\''+this.id+"']."+cmd+"('"+txt+'\');" onfocus="this.blur();">'+txt+"</a>&nbsp;]"};_SXBB.prototype.writeCmd=function(){var s="";if((document.selection&&!SXBB_IsIEMac())||(document.createRange&&(document.getSelection||window.getSelection))){s+=this.genCmd("select",this.T.select)}if(SXBB_IsOverflowAble()){s+='<span id="'+this.id+'x"></span>'}document.write(s)};_SXBB.prototype.writeDiv=function(){var s=(SXBB_IsOverflowAble()?'style="margin: 0px; padding: 0px; overflow: auto; height: '+this.min+'px;"':'style="padding: 0px; margin: 0px;"');document.write('<div id="'+this.id+'" '+s+">")};_SXBB.prototype.getObj=function(id){return(document.getElementById?document.getElementById(id):null)};_SXBB.prototype.select=function(){var o=this.getObj(this.id);if(!o){return}var r,s;if(document.selection&&!SXBB_IsIEMac()){r=document.body.createTextRange();r.moveToElementText(o);r.select()}else{if(document.createRange&&(document.getSelection||window.getSelection)){r=document.createRange();r.selectNodeContents(o);s=window.getSelection?window.getSelection():document.getSelection();s.removeAllRanges();s.addRange(r)}}};_SXBB.prototype.resize=function(cmd){var o=this.getObj(this.id);if(!o){return}var x=this.getObj(this.id+"x");if(!x){return}if(cmd=="onload"||cmd=="onresize"){if(o.scrollHeight<=this.min){x.innerHTML="";return}if(x.innerHTML!=""){return}if(cmd=="onload"){x.innerHTML=this.genCmd("resize",this.T.expand);return}cmd=this.T.contract}if(cmd==this.T.expand){this.size=o.scrollHeight+this.extra;o.style.height="auto";o.style.overflow="visible";x.innerHTML=((o.scrollHeight-this.margin)>this.min?this.genCmd("resize",this.T.contract):"")}else{this.size=this.min;o.style.height=this.size+"px";o.style.overflow="auto";x.innerHTML=this.genCmd("resize",this.T.expand)}if(cmd!="onresize"){if(o.parentNode){for(o=o.parentNode;o.parentNode;o=o.parentNode){if(o.tagName&&o.tagName=="DIV"&&o.id&&o.id.indexOf("SXBB")==0){if(!document.all){SXBB[o.id].resize(this.T.contract)}SXBB[o.id].resize(this.T.expand)}}}}return false};if(typeof(SXBB)=="undefined"){var SXBB=[];if(SXBB_IsOverflowAble()){var SXBB_oldOnLoad=null;var SXBB_oldOnResize=null;function SXBB_onLoad(){if(SXBB_oldOnLoad){SXBB_oldOnLoad();SXBB_oldOnLoad=null}SXBB_evalSize("onload")}function SXBB_onResize(){if(SXBB_oldOnResize){SXBB_oldOnResize();SXBB_oldOnResize=null}SXBB_evalSize("onresize")}function SXBB_evalSize(cmd){for(var id in SXBB){SXBB[id].resize(cmd)}}if(window.addEventListener){window.addEventListener("load",SXBB_onLoad,false);window.addEventListener("resize",SXBB_onResize,false)}else{if(window.attachEvent){window.attachEvent("onload",SXBB_onLoad);window.attachEvent("onresize",SXBB_onResize)}else{SXBB_oldOnLoad=window.onload;SXBB_oldOnResize=window.onresize;window.onload=SXBB_onLoad;window.onresize=SXBB_onResize}}}};

/*
 * Required for the BBCode (Hooker)
 */
function xs_show_hide(id1, id2, id3) 
{
	var res = xs_exp_menu(id1);
	if (id2 != '') xs_exp_menu(id2);
//	if (id3 != '') ca_cookie_set(id3, res, exp);
}
	
function xs_exp_menu(id) 
{
	var itm = null;
	if (document.getElementById) 
	{
		itm = document.getElementById(id);
	}
	else if (document.all)
	{
		itm = document.all[id];
	} 
	else if (document.layers)
	{
		itm = document.layers[id];
	}
	if (!itm) 
	{
		// do nothing
	}
	else if (itm.style) 
	{
		if (itm.style.display == "none")
		{ 
			itm.style.display = ""; 
			return 1;
		}
		else
		{
			itm.style.display = "none"; 
			return 2;
		}
	}
	else 
	{
		itm.visibility = "show"; 
		return 1;
	}
}
