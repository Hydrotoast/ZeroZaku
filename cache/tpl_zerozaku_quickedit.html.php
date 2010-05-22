<?php if (!defined('IN_PHPBB')) exit; if ($this->_rootref['EDIT_FORM']) {  ?>

<div id="message-box" style="width: 95%;">
	<textarea name="quickedit-textarea" id="quickedit-textarea" class="inputbox" rows="15" cols="76" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);" onfocus="initInsertions();" style="font-size: 1.0em;" ><?php echo (isset($this->_rootref['POST_TEXT'])) ? $this->_rootref['POST_TEXT'] : ''; ?></textarea><br />
</div><br />
<div class="center">
	<input class="button1" type="button" onclick="submit_changes(<?php echo (isset($this->_rootref['POST_ID'])) ? $this->_rootref['POST_ID'] : ''; ?>);" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" style="font-size:1.2em;" />
	<input class="button2" type="button" onclick="cancel_changes(<?php echo (isset($this->_rootref['POST_ID'])) ? $this->_rootref['POST_ID'] : ''; ?>);" value="<?php echo ((isset($this->_rootref['L_CANCEL'])) ? $this->_rootref['L_CANCEL'] : ((isset($user->lang['CANCEL'])) ? $user->lang['CANCEL'] : '{ CANCEL }')); ?>" style="font-size:1.2em;" />
</div>
<?php } else if ($this->_rootref['SEND_TEXT']) {  ?>

<?php echo (isset($this->_rootref['TEXT'])) ? $this->_rootref['TEXT'] : ''; ?>

<?php } else { ?>

<script type="text/javascript">
// <![CDATA[
var http_request = getHTTPObject();
var divname = '';
var open_quick_edit = 0;

// Check for Browser & Platform for PC & IE specific bits
// More details from: http://www.mozilla.org/docs/web-developer/sniffer/browser_type.html
var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version

var is_ie = ((clientPC.indexOf('msie') != -1) && (clientPC.indexOf('opera') == -1));
var is_win = ((clientPC.indexOf('win') != -1) || (clientPC.indexOf('16bit') != -1));

var baseHeight;

// Define the bbCode tags
var bbcode = new Array();
var bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[quote]','[/quote]','[code]','[/code]','[list]','[/list]','[list=]','[/list]','[img]','[/img]','[url]','[/url]','[flash=]', '[/flash]','[size=]','[/size]'<?php $_custom_tags_count = (isset($this->_tpldata['custom_tags'])) ? sizeof($this->_tpldata['custom_tags']) : 0;if ($_custom_tags_count) {for ($_custom_tags_i = 0; $_custom_tags_i < $_custom_tags_count; ++$_custom_tags_i){$_custom_tags_val = &$this->_tpldata['custom_tags'][$_custom_tags_i]; ?>, <?php echo $_custom_tags_val['BBCODE_NAME']; }} ?>);


function quick_edit(post_id)
{
	if (open_quick_edit != 1)
	{
		divname = 'postdiv' + post_id;
		get_text(post_id);
		contents = document.getElementById('quick_edit' + post_id).style.display = 'none';
		open_quick_edit = 1;
	}
}

function submit_changes(post_id)
{
   contents = document.getElementById('quickedit-textarea').value;
   get_text(post_id, contents);
   contents = document.getElementById('quick_edit' + post_id).style.display = '';
   editando = '';
   open_quick_edit = 0;
}

function cancel_changes(post_id)
{
	contents = 'cancel';
	get_text(post_id, contents);
	contents = document.getElementById('quick_edit' + post_id).style.display = '';
	open_quick_edit = 0;
}

function get_text(post_id, contents)
{
	if (contents)
	{
		contents = '&contents=' + encodeURIComponent(contents) + '&submit=true';
	}
	else
	{
		contents = '';
	}
	param = 'post_id=' + post_id + contents;	
	http_request.open("POST", '<?php echo (isset($this->_rootref['U_QUICKEDIT'])) ? $this->_rootref['U_QUICKEDIT'] : ''; ?>', true);
	http_request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  	http_request.onreadystatechange = handle_text;
  	http_request.send(param);
}

function handle_text()
{
	if (http_request.readyState == 4)
	{
		if (http_request.status == 200)
		{
			result = http_request.responseText;
			document.getElementById(divname).innerHTML = result;
		}
		else
		{
			alert('There was a problem with the request.');
		}
	}
}

function getHTTPObject()
{
	if (window.XMLHttpRequest)
	{
		return new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		document.getElementById('p_status').innerHTML = 'Status: Cound not create XmlHttpRequest Object.  Consider upgrading your browser.';
	}
}


/**	Below are all functions regarding BBCodes and the way they are inserted into the textbox
*	Please do not change anything as this might cause major problems with AJAX Quick Edit
*	Functions are based on the functions in editor.js of prosilver
*	bbCode control by subBlue design [ www.subBlue.com ]
*	Includes unixsafe colour palette selector by SHS`
*	modified by Marc Alexander to fit AJAX Quick Edit
*/



var text_name = 'quickedit-textarea';



/**
* Fix a bug involving the TextRange object. From
* http://www.frostjedi.com/terra/scripts/demo/caretBug.html
*/ 
function initInsertions() 
{
	var textarea = document.getElementById(text_name);

	if (is_ie && typeof(baseHeight) != 'number')
	{
		textarea.focus();
		baseHeight = document.selection.createRange().duplicate().boundingHeight;
	}
}

/**
* bbstyle
*/
function bbstyle(bbnumber, bbnumber2)
{	
	if (typeof(bbnumber2) == 'undefined' && bbnumber != -1)
	{
		bbfontstyle(bbtags[bbnumber], bbtags[bbnumber+1]);
	} 
	else if (typeof(bbnumber2) != 'undefined')
	{
		bbfontstyle(bbnumber, bbnumber2);
	}
	else
	{
		insert_text('[*]');
		document.getElementById(text_name).focus();
	}
}

/**
* Apply bbcodes
*/
function bbfontstyle(bbopen, bbclose)
{
	theSelection = false;

	var textarea = document.getElementById(text_name);

	textarea.focus();

	if ((clientVer >= 4) && is_ie && is_win)
	{
		// Get text selection
		theSelection = document.selection.createRange().text;

		if (theSelection)
		{
			// Add tags around selection
			document.selection.createRange().text = bbopen + theSelection + bbclose;
			document.getElementById(text_name).focus();
			theSelection = '';
			return;
		}
	}
	else if (document.getElementById(text_name).selectionEnd && (document.getElementById(text_name).selectionEnd - document.getElementById(text_name).selectionStart > 0))
	{
		mozWrap(document.getElementById(text_name), bbopen, bbclose);
		document.getElementById(text_name).focus();
		theSelection = '';
		return;
	}
	
	//The new position for the cursor after adding the bbcode
	var caret_pos = getCaretPosition(textarea).start;
	var new_pos = caret_pos + bbopen.length;		

	// Open tag
	insert_text(bbopen + bbclose);

	// Center the cursor when we don't have a selection
	// Gecko and proper browsers
	if (!isNaN(textarea.selectionStart))
	{
		textarea.selectionStart = new_pos;
		textarea.selectionEnd = new_pos;
	}	
	// IE
	else if (document.selection)
	{
		var range = textarea.createTextRange(); 
		range.move("character", new_pos); 
		range.select();
		storeCaret(textarea);
	}

	textarea.focus();
	return;
}

/**
* Insert text at position
*/
function insert_text(text, spaces, popup)
{
	var textarea;
	
	if (!popup) 
	{
		textarea = document.getElementById(text_name);
	} 
	else 
	{
		textarea = opener.document.getElementById(text_name);
	}
	if (spaces) 
	{
		text = ' ' + text + ' ';
	}
	
	if (!isNaN(textarea.selectionStart))
	{
		var sel_start = textarea.selectionStart;
		var sel_end = textarea.selectionEnd;

		mozWrap(textarea, text, '')
		textarea.selectionStart = sel_start + text.length;
		textarea.selectionEnd = sel_end + text.length;
	}
	else if (textarea.createTextRange && textarea.caretPos)
	{
		if (baseHeight != textarea.caretPos.boundingHeight) 
		{
			textarea.focus();
			storeCaret(textarea);
		}

		var caret_pos = textarea.caretPos;
		caret_pos.text = caret_pos.text.charAt(caret_pos.text.length - 1) == ' ' ? caret_pos.text + text + ' ' : caret_pos.text + text;
	}
	else
	{
		textarea.value = textarea.value + text;
	}
	if (!popup) 
	{
		textarea.focus();
	}
}

/**
* From http://www.massless.org/mozedit/
*/
function mozWrap(txtarea, open, close)
{
	var selLength = txtarea.textLength;
	var selStart = txtarea.selectionStart;
	var selEnd = txtarea.selectionEnd;
	var scrollTop = txtarea.scrollTop;

	if (selEnd == 1 || selEnd == 2) 
	{
		selEnd = selLength;
	}

	var s1 = (txtarea.value).substring(0,selStart);
	var s2 = (txtarea.value).substring(selStart, selEnd)
	var s3 = (txtarea.value).substring(selEnd, selLength);

	txtarea.value = s1 + open + s2 + close + s3;
	txtarea.selectionStart = selEnd + open.length + close.length;
	txtarea.selectionEnd = txtarea.selectionStart;
	txtarea.focus();
	txtarea.scrollTop = scrollTop;

	return;
}

/**
* Insert at Caret position. Code from
* http://www.faqts.com/knowledge_base/view.phtml/aid/1052/fid/130
*/
function storeCaret(textEl)
{
	if (textEl.createTextRange)
	{
		textEl.caretPos = document.selection.createRange().duplicate();
	}
}

/**
* Caret Position object
*/
function caretPosition()
{
	var start = null;
	var end = null;
}

/**
* Get the caret position in an textarea
*/
function getCaretPosition(txtarea)
{
	var caretPos = new caretPosition();
	
	// simple Gecko/Opera way
	if(txtarea.selectionStart || txtarea.selectionStart == 0)
	{
		caretPos.start = txtarea.selectionStart;
		caretPos.end = txtarea.selectionEnd;
	}
	// dirty and slow IE way
	else if(document.selection)
	{
	
		// get current selection
		var range = document.selection.createRange();

		// a new selection of the whole textarea
		var range_all = document.body.createTextRange();
		range_all.moveToElementText(txtarea);
		
		// calculate selection start point by moving beginning of range_all to beginning of range
		var sel_start;
		for (sel_start = 0; range_all.compareEndPoints('StartToStart', range) < 0; sel_start++)
		{		
			range_all.moveStart('character', 1);
		}
	
		txtarea.sel_start = sel_start;
	
		// we ignore the end value for IE, this is already dirty enough and we don't need it
		caretPos.start = txtarea.sel_start;
		caretPos.end = txtarea.sel_start;			
	}

	return caretPos;
}
// ]]>
</script>
<?php } ?>