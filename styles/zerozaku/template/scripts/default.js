/* ZeroZaku Initialization
 * Copyright (c) 2009, 2010 Gio Borje (http://www.zerozaku.com)
 */
var config = {
    root_path : '',
    template_path : '',
    theme_path : '',
    aid : '',
    im_started : false
};

function init(p_root_path, p_template_path, p_theme_path, p_aid) {
    config.root_path = p_root_path;
    config.template_path = p_template_path;
    config.theme_path = p_theme_path;
    config.aid = p_aid;

    collapse();
    shConfig();
}

function collapse() {
    // Collapses forums
    $('a.collapse').each(function(index) {
        var forum_id = $(this).attr('rel');
	
        if (localStorage.getItem(forum_id) == 'true') {
            var parent = $(this).parent('h2.cattitle');
            $(parent).next('.forabg').hide();
            $(parent).addClass('collapsed');
            $(this).children('img').attr('src',
                config.theme_path + '/images/plus_alt_24x24.png');
        }
    });
}

function equalHeight(group) {
    var tallest = 0;
    group.each(function() {
        var thisHeight = $(this).height();
        if (thisHeight > tallest) {
            tallest = thisHeight;
        }
    });
    group.height(tallest);
}

function shConfig() {
    SyntaxHighlighter.config.bloggerMode = true;
    SyntaxHighlighter.defaults['toolbar'] = false;
    SyntaxHighlighter
    .autoloader(
        ['applescript', config.template_path + '/scripts/languages/shBrushAppleScript.js' ],
        ['actionscript', 'as', config.template_path + '/scripts/languages/shBrushAS3.js' ],
        ['au', 'autoit', config.template_path + '/scripts/languages/shBrushAutoit.js' ],
        ['bash', 'shell', config.template_path + '/scripts/languages/shBrushBash.js' ],
        ['coldfusion', 'cf', config.template_path + '/scripts/languages/shBrushColdFusion.js' ],
        ['cpp', 'c', config.template_path + '/scripts/languages/shBrushCpp.js' ],
        ['c#', 'c-sharp', 'csharp', config.template_path + '/scripts/languages/shBrushCSharp.js' ],
        ['css', config.template_path + '/scripts/languages/shBrushCss.js' ],
        ['delphi', 'pascal', config.template_path + '/scripts/languages/shBrushDelphi.js' ],
        ['diff', 'patch', 'pas', config.template_path + '/scripts/languages/shBrushDiff.js' ],
        ['erl', 'erlang', config.template_path + '/scripts/languages/shBrushErlang.js' ],
        ['groovy', config.template_path + '/scripts/languages/shBrushGroovy.js' ],
        ['java', config.template_path + '/scripts/languages/shBrushJava.js' ],
        ['jfx', 'javafx', config.template_path + '/scripts/languages/shBrushJavaFX.js' ],
        ['js', 'jscript', 'javascript', config.template_path + '/scripts/languages/shBrushJScript.js' ],
        ['perl', 'pl', config.template_path + '/scripts/languages/shBrushPerl.js' ],
        ['php', config.template_path + '/scripts/languages/shBrushPhp.js' ],
        ['text', 'plain', config.template_path + '/scripts/languages/shBrushPlain.js' ],
        ['py', 'python', config.template_path + '/scripts/languages/shBrushPython.js' ],
        ['ruby', 'rails', 'ror', 'rb', config.template_path + '/scripts/languages/shBrushRuby.js' ],
        ['scala', config.template_path + '/scripts/languages/shBrushScala.js' ],
        ['sql', config.template_path + '/scripts/languages/shBrushSql.js' ],
        ['vb', 'vbnet', config.template_path + '/scripts/languages/shBrushVb.js' ],
        ['xml', 'xhtml', 'xslt', 'html', config.template_path + '/scripts/languages/shBrushXml.js' ]);
    SyntaxHighlighter.all();
}

$(function() {
    $.jGrowl.defaults.pool = 5;

    // Handle textare growth and tabs
    $('textarea#message').growing({maxHeight : 540, buffer : 0});
    $('textarea').tabby();

    // Handle reputation
    $('a[rel=colorbox]').click(function() {
        $.colorbox({width: '400px', height: '260px', href: $(this).attr('href') + '&ajax=true'});
        return false;
    });

    // Handle ad clicks
    $('a.ad').click(function() {
        var ad_id = $(this).attr('rel');
        $.get(config.root_path + 'affiliate.php?mode=click&a=' + ad_id);
    });

    // Set equal heights
    equalHeight($('.user_column'));

    if (localStorage.getItem('sidebar_side') == 'left')
        $('#page-sidebar').addClass('left');

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
            url : config.root_path
            + 'ucp.php?i=ajax&mode=add_rec&rec_id='
            + user_id,
            type : 'GET',
            success : function(data) {
                if (data == 'true')
                    $.jGrowl('Friend request sent to user');
                else if (data == 'false')
                    $.jGrowl('Request already sent or user is already friend');
            }
        });
        return false;
    });

    $("a.collapse").click(function() {
        var forum_id = $(this).attr("rel");
        var collapsed = localStorage.getItem(forum_id);

        if (!collapsed) {
            localStorage.setItem(forum_id, "true");
            var parent = $(this).parent("h2.cattitle");
            $(parent).next(".forabg").slideUp();
            $(parent).addClass("collapsed");
            $(this).children("img").attr("src",
                config.theme_path + "/images/plus_alt_24x24.png");
            $.jGrowl('Forum collapsed');
        } else {
            if (collapsed == "true") {
                localStorage.setItem(forum_id, "false");
                var parent = $(this).parent("h2.cattitle");
                $(parent).next(".forabg").slideDown();
                $(parent).removeClass("collapsed");
                ;
                $(this).children("img").attr(
                    "src",
                    config.theme_path
                    + "/images/minus_alt_24x24.png");
                $.jGrowl('Forum opened');
            } else {
                localStorage.setItem(forum_id, "true");
                var parent = $(this).parent("h2.cattitle");
                $(parent).next(".forabg").slideUp();
                $(parent).addClass("collapsed");
                $(this).children("img").attr(
                    "src",
                    config.theme_path
                    + "/images/plus_alt_24x24.png");
                $.jGrowl('Forum collapsed');
            }
        }

        return false;
    });
});

/**
 * phpBB3 forum functions
 */
function popup(c,d,a,b){if(!b){b="_popup"}window.open(c.replace(/&amp;/g,"&"),b,"height="+a+",resizable=yes,scrollbars=yes, width="+d);return false}function jumpto(){var a=prompt(jump_page,on_page);if(a!==null&&!isNaN(a)&&a==Math.floor(a)&&a>0){if(base_url.indexOf("?")==-1){document.location.href=base_url+"?start="+((a-1)*per_page)}else{document.location.href=base_url.replace(/&amp;/g,"&")+"&start="+((a-1)*per_page)}}}function marklist(id,name,state){var parent=document.getElementById(id);if(!parent){eval("parent = document."+id)}if(!parent){return}var rb=parent.getElementsByTagName("input");for(var r=0;r<rb.length;r++){if(rb[r].name.substr(0,name.length)==name){rb[r].checked=state}}}function viewableArea(b,a){if(!b){return}if(!a){b=b.parentNode}if(!b.vaHeight){b.vaHeight=b.offsetHeight;b.vaMaxHeight=b.style.maxHeight;b.style.height="auto";b.style.maxHeight="none";b.style.overflow="visible"}else{b.style.height=b.vaHeight+"px";b.style.overflow="auto";b.style.maxHeight=b.vaMaxHeight;b.vaHeight=false}}function dE(c,a){var b=document.getElementById(c);if(!a){a=(b.style.display==""||b.style.display=="block")?-1:1}b.style.display=(a==1)?"block":"none"}function subPanels(d){var b,c,a;if(typeof(d)=="string"){show_panel=d}for(b=0;b<panels.length;b++){c=document.getElementById(panels[b]);a=document.getElementById(panels[b]+"-tab");if(c){if(panels[b]==show_panel){c.style.display="block";if(a){a.className="activetab"}}else{c.style.display="none";if(a){a.className=""}}}}}function printPage(){if(is_ie){printPreview()}else{window.print()}}function displayBlocks(i,g,a){var f=(g.checked==true)?1:-1;if(a){f*=-1}var b=document.getElementsByTagName("DIV");for(var h=0;h<b.length;h++){if(b[h].className.indexOf(i)==0){b[h].style.display=(f==1)?"none":"block"}}}function selectCode(b){var f=b.parentNode.parentNode.getElementsByTagName("CODE")[0];if(window.getSelection){var c=window.getSelection();if(c.setBaseAndExtent){c.setBaseAndExtent(f,0,f,f.innerText.length-1)}else{if(window.opera&&f.innerHTML.substring(f.innerHTML.length-4)=="<BR>"){f.innerHTML=f.innerHTML+"&nbsp;"}var d=document.createRange();d.selectNodeContents(f);c.removeAllRanges();c.addRange(d)}}else{if(document.getSelection){var c=document.getSelection();var d=document.createRange();d.selectNodeContents(f);c.removeAllRanges();c.addRange(d)}else{if(document.selection){var d=document.body.createTextRange();d.moveToElementText(f);d.select()}}}}function play_qt_file(h){var e=h.GetRectangle();if(e){e=e.split(",");var c=parseInt(e[0]);var b=parseInt(e[2]);var g=parseInt(e[1]);var d=parseInt(e[3]);var f=(c<0)?(c*-1)+b:b-c;var a=(g<0)?(g*-1)+d:d-g}else{var f=200;var a=0}h.width=f;h.height=a+16;h.SetControllerVisible(true);h.Play()}function display(a,b){if(a=="show"){document.getElementById("explanation"+b).style.display="block";document.getElementById("link"+b).href="javascript:display('hide', "+b+")"}if(a=="hide"){document.getElementById("explanation"+b).style.display="none";document.getElementById("link"+b).href="javascript:display('show', "+b+")"}}function is_node_name(b,a){return b.nodeName&&b.nodeName.toUpperCase()==a.toUpperCase()}function is_in_array(c,d){for(var a=0,b=d.length;a<b;a++){if(d[a]===c){return a}}return -1}function find_in_tree(g,b,e,h){var a,d,c=0,f=g.childNodes.length;for(d=g.childNodes[0];c<f;d=g.childNodes[++c]){if(!d||d.nodeType!=1){continue}if((!b||is_node_name(d,b))&&(!e||d.type==e)&&(!h||is_in_array(h,(d.className||d).toString().split(/\s+/))>-1)){return d}if(d.childNodes.length){a=find_in_tree(d,b,e,h)}if(a){return a}}}var in_autocomplete=false;var last_key_entered="";function phpbb_check_key(a){if(a.keyCode&&(a.keyCode==40||a.keyCode==38)){in_autocomplete=true}if(in_autocomplete){if(!last_key_entered||last_key_entered==a.which){in_autocompletion=false;return true}}if(a.which!=13){last_key_entered=a.which;return true}return false}function submit_default_button(d,a,e){if(!d.which&&((d.charCode||d.charCode===0)?d.charCode:d.keyCode)){d.which=d.charCode||d.keyCode}if(phpbb_check_key(d)){return true}var f=a.parentNode;while(f&&(!f.nodeName||f.nodeType!=1||!is_node_name(f,"form"))&&f!=document){f=f.parentNode}var g=f.getElementsByTagName("input");f=false;for(var c=0,b=g[0];c<g.length;b=g[++c]){if(b.type=="submit"&&is_in_array(e,(b.className||b).toString().split(/\s+/))>-1){f=b}}if(!f){return true}f.focus();f.click();return false}function apply_onkeypress_event(){if(jquery_present){jQuery("form input[type=text], form input[type=password]").live("keypress",function(f){var d=jQuery(this).parents("form").find("input[type=submit].default-submit-action");if(!d||d.length<=0){return true}if(phpbb_check_key(f)){return true}if((f.which&&f.which==13)||(f.keyCode&&f.keyCode==13)){d.click();return false}return true});return}var c=document.getElementsByTagName("input");for(var b=0,a=c[0];b<c.length;a=c[++b]){if(a.type=="text"||a.type=="password"){a.onkeypress=function(d){submit_default_button((d||window.event),this,"default-submit-action")}}}}var jquery_present=typeof jQuery=="function";
/*
 var cookie = readCookie("style");
 var title = cookie ? cookie : getPreferredStyleSheet();
 setActiveStyleSheet(title);
 */