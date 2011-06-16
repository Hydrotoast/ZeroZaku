<?php
/*
	 Class: Syntax Highlighter
	Author: CyberAlien (http://www.stsoftware.biz)
	Author: UseLess (http://www.phpbbstyles.co.uk)
	
	 Notes: CyberAlien (aka CA ;) ) released the enhanced bbcode parser to the public
	 		on the 31 May 2005 @ 7:38 am (for more information see the following post
	 		http://www.phpbbstyles.com/viewtopic.php?t=6107 )
	 				
	 		This Syntax Highlighter is based on the BBCode parser mentioned above, it's just
	 		been trimmed here and there and altered a little.	 	

	Version: 1.0.12
       
	Modifed: UseLess
	   Date: 9 July 2009
       
	Release: 1
       
	  Build: 32

This Header: It would be nice if this header was left intact.. anything you feel you want
			 to add can be added below this or the following comment block.
   		
			 It would be nice and also appreciated. ;)
*/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/**
* @ignore
*/
if ( !defined('IN_PHPBB') )
{
	exit;
}

define('BBCODE_NOSMILIES_START', '<!-- no smilies start -->');
define('BBCODE_NOSMILIES_END', '<!-- no smilies end -->');
define('IN_XS_BBCODE', true);
define('AUTOURL', time());

//
// Start Class definition
//
class SyntaxHighlighter {
	//
	// Syntax Highlighter Version information as used by [version] BBCode tag
	//
	var $bbcode_version = array(
			'version'	=> '1.0.12',
			'release'	=> 1,
			'build'		=> 32,
			'comment'	=> 'XS_SH_INFO_VERSION',
		);

	// Flags
	var $debug_enable = false;
	var $allow_bbcode = true;
	var $allow_html = false;
	var $is_sig = false;
	var $pm = false;
	/*
		Change the following flag to true to enable the use of the programming language
		as a BBCode tag. i.e. it will allow the use of [php] .. [/php] or [delphi] .. [/delphi]
		NOTE: It will add a little load to the class creation as the GeSHi dir where the language
			  files are will be scanned and added to the BBCode array every time the class is
			  initialised, this means every page
	*/
	var $auto_add_tags = true;
	// Arrays
	var $data = array();
	var $params = array();
	var $geshi_syntax = array();
	// Counters
	var $code_counter = 0;
	var $nest_level = 1;
	// Strings
	var $tag = '';
	var $text = '';
	var $html = '';
	var $text_only_sig = '';
	var $text_not_sig = '';
	var $text_once_sig = '';
	// Globals
	var $code_post_id = 0;
	var $code_text = '';
	var $code_filename = '';
	// Array of allowed BBCodes
	var $allowed_bbcode = array(
		'version' => array(
			'nested'	=> false,
			'inurl'		=> false,
			'allow_empty'	=> true,
			'in_sig'	=> false,
			'bbcode_helpline' => 'XS_SH_TAG_VERSION',
			'display_on_posting' => 0,
			'bbcode_match' => '',
			'bbcode_tpl' => '',
		),
		// syntax
		'syntax'	=> array(
			'nested'	=> false,
			'inurl'		=> false,
			'allow_empty'	=> false,
			'in_sig'	=> false,
			'bbcode_helpline' => 'XS_SH_TAG_SYNTAX',
			'display_on_posting' => 0,
			'bbcode_match' => '',
			'bbcode_tpl' => '',
		),
	);
	
	/**
	 *	Constructor
	 */
	function SyntaxHighlighter()
	{
		if( $this->auto_add_tags )
		{
			$this->geshi_syntax = $this->get_geshi_syntaxes();
		}
	}
	
	/**
	 *	Process bbcode/html tag. 
	 *	This is the only function you would want to modify to add your own bbcode/html
	 *	tags.
	 *	Note: this bbcode parser doesn't make any difference of bbcode and html, so <b>
	 *	and [b] are treated exactly same way
	 */
	function process_tag(&$item)
	{
		global $config, $user, $auth;
		global $phpbb_root_path, $phpEx;
		
		$user->add_lang('mods/useless_xs_bbcode');

		$tag = $item['tag'];

		if( $this->debug_enable )
		{
			echo 'process_tag(' . $tag . ')<br />';
		}
		
		$start = substr($this->text, $item['start'], $item['start_len']);
		$end = substr($this->text, $item['end'], $item['end_len']);
		$content = substr($this->text, $item['start'] + $item['start_len'], $item['end'] - $item['start'] - $item['start_len']);
		$error = array(
			'valid'		=> false,
			'start'		=> $this->process_text($start),
			'end'		=> $this->process_text($end)
			);

		if( $this->debug_enable )
		{
			echo '<pre>';
			echo $user->lang['XS_BBC_DEBUG_CONTENT'] . ': ' . $content;
			echo '<br />------------------------------------------------<br />';
			echo $this->text;
			echo '<br />------------------------------------------------<br />';
			print_r($item);
			echo '</pre>';
		}

		// Clean up the Parameters
		if( isset($item['params']) && count($item['params']) )
		{
			foreach($item['params'] as $key => $value)
			{
				$item['params'][$key] = str_replace('&quot;' ,'', $value);
			}
		}
		
		if(isset($item['valid']) && $item['valid'] == false)
		{
			return $error;
		}
		// check if empty item is allowed
		if(!strlen($content))
		{
			$allow_empty = true;
			if(!$item['is_html'] && isset($this->allowed_bbcode[$tag]['allow_empty']) && !$this->allowed_bbcode[$tag]['allow_empty'])
			{
				$allow_empty = false;
			}
			if(!$allow_empty)
			{
				return array(
						'valid'	=> true,
						'html'	=> '',
						'end'	=> '',
						'allow_nested' => false,
					);
			}
		}
		// check if nested item is allowed
		if($item['iteration'])
		{
			if(!$item['is_html'] && !$this->allowed_bbcode[$tag]['nested'])
			{
				return $error;
			}
			if( isset($this->allowed_bbcode[$tag]['nest_level']) && $this->allowed_bbcode[$tag]['nested'])
			{
				$this->nest_level = intval($this->allowed_bbcode[$tag]['nest_level']);
			}
		}

		/*
		 *	Start Tag Processing
		 */
		/**
		 *  Output Version information
		 */
		if($tag === 'version')
		{
			if($this->is_sig && !$this->allowed_bbcode[$tag]['in_sig'])  
			{  
				return $error;  
			}  
			if($item['iteration'] > $this->nest_level)  
			{  
				return $error;  
			}  
			// title  
			$title = sprintf($user->lang['XS_BBCODE_VERSION'], $this->bbcode_version['version'], $this->bbcode_version['release'], $this->bbcode_version['build']);  
			// generate html  
			$table_id = substr(md5($content . mt_rand()), 0, 8);
			$str = '<div class="minitable">';
			$str .= '<div class="minitable-header" id="tablehdr_' . $table_id . '" style="position: relative;"><div class="minitable-hideme">[ <a href="javascript:void(0)" onclick="dE(\'table_' . $table_id . '\', 0);">' . $user->lang['XS_BBC_HIDE'] . '</a> ]</div>' . ( !empty($title) ? $title : '' ) . '</div>';
			$str .= '<div class="minitable-contents" id="table_' . $table_id . '" style="position: relative;">';
			// header
			$str .= ( (!empty($user->lang[$this->bbcode_version['comment']])) ? '<div style="text-align: left; width: 100%; font-family: Verdana, Arial, sans-serif; color: #000; font-size: 12px; font-weight: normal; background-color: #f0f0ff; border-bottom: 1px solid #d0d0d0; padding: 2px;">' . $user->lang[$this->bbcode_version['comment']] . '</div>' : '');
			$str .= '<b>' . $user->lang['XS_BBC_TAGS_TITLE'] . '</b>: ';
			// output allowed BBCode tags
			foreach($this->allowed_bbcode as $row_item => $item_prop)
			{
				$str .= ( $row_item != '*' ? $row_item . ', ' : '');
			}
			$str = substr($str, 0, strlen($str)-2);
			$str .= '<br />';
			list($major_ver, $minor_ver, $revision) = explode('.', $this->bbcode_version['version']);
			if( $major_ver >= 0 && $revision >= 1)
			{
				if ($handle = @opendir($phpbb_root_path . 'includes/geshi/'))
				{
					$file_list = array();
					$exclude = array('.', '..');
					while (false !== ($file = @readdir($handle)))
					{ 
						$fileinfo = pathinfo($file);
						if( !in_array($file, $exclude) && strtolower($fileinfo['extension']) == $phpEx )
						{ 
							$file_list[] = substr($file, 0, strpos($file, '.'));
						}
					}
					@closedir($handle);
					sort($file_list);
					$str .= '<br />(<span style="color: #f00;">' . count($file_list) . '</span>) <b>' . $user->lang['XS_BBC_SUPPORTED_SYNTAX'] . '</b>: ';
					for($i = 0, $file_count = count($file_list); $i < $file_count; $i++)
					{
						$str .= $file_list[$i] . ( ($i < $file_count-1) ? ', ' : '');
					}
				}
			}
			//
			// Grab the version of GeSHi used
			//
			$text = $syntax = 'php';
			if( !class_exists('GeSHi') )
			{
				include($phpbb_root_path . 'includes/geshi.'.$phpEx);
			}
			$geshi =& new GeSHi($text, $syntax);
			$footer = '<div style="text-align: left; width: 100%; font-family: Verdana, Arial, sans-serif; color: #808080; font-size: 10px; font-weight: bold; background-color: #f0f0ff; border-bottom: 1px solid #d0d0d0; padding: 2px;">' . sprintf($user->lang['XS_BBC_GESHI_VERSION'], '<span style="color: #900;">' . $geshi->get_version() . '</span>') . '</div>';
			//
			// end Geshi version
			//
			$str .= $footer . '</div></div>';
			return array(  
				'valid'		=> true,  
				'html'		=> $str,  
				'allow_nested'	=> false
			);  
		}

		/**  
		 *  BBCode: syntax
		 *
		 *  Allowed attributes:
		 *	- start = " x "
		 *	- filename = " filename for code when downloaded "
		 *	- highlight = " line numbers to highlight seperated with , or - for consecutive lines "
		 *	- syntax = " php | asp | css " - over 126 syntax files included
		 *
		 */
		if($tag === 'syntax' || in_array($tag, $this->geshi_syntax))
		{
			if($this->is_sig && !$this->allowed_bbcode[$tag]['in_sig'])
			{
				return $error;
			}
			$search = array('<br />', '&lt;br /&gt;');
			$replace = array("\n", '<br />');
			$content = str_replace($search, $replace, $content);
			// Check if the code is to be downloaded?
			if(!defined('EXTRACT_CODE'))
			{
				$search = array(
						'  ',
						"\t"
					);
				$replace = array(
						'&nbsp;',
						'&nbsp;&nbsp;&nbsp;&nbsp;'
					);
				// If a language is specified then don't replace anything
				// otherwise a language is not specified then replace spaces and tabs with $nbsp;
				if( isset($item['params']['param']) || isset($item['params']['lang']) || in_array($tag, $this->geshi_syntax) )
				{
					$text = $content;
				}
				else
				{
					$text = str_replace($search, $replace, $content);
				}
				$text = $this->process_text($text, false, false);
				$temp_text = explode("\n", $text);
				// Check to see how many lines there are... if <= 4 then don't load the
				// expand/contract javascript
				$load_expand = ( (count($temp_text) <= 4) ? false : true);
				unset($temp_text);
			}
			else
			{
				$text = $this->process_text($content, true, false);
				$search = array('[highlight]', '[/highlight]');
				$replace = array('', '');
				$text = str_replace($search, $replace, $text);
				$load_expand = false;
			}
			// Has a filename been specified?
			if(isset($item['params']['filename']))
			{
				$item['params']['file'] = str_replace('&quot;', '', $item['params']['filename']);
			}
			if(defined('EXTRACT_CODE') && $this->code_counter == EXTRACT_CODE)
			{
				$this->code_text = $text;
				if(!empty($item['params']['file']))
				{
						$this->code_filename = $item['params']['file'];
				}
			}
			if(substr($text, 0, 1) === "\n")
			{
				$text = substr($text, 1);
			}
			elseif(substr($text, 0, 2) === "\r\n")
			{
				$text = substr($text, 2);
			}
			$header = '';
			$footer = '';
			$line_type = '';
			if(isset($item['params']['param']) && !defined('EXTRACT_CODE'))
			{
				$syntax = trim(htmlspecialchars($item['params']['param']));
			}
			elseif(isset($item['params']['lang']) && !defined('EXTRACT_CODE'))
			{
				$syntax = trim(htmlspecialchars($item['params']['lang']));
			}
			elseif( in_array($tag, $this->geshi_syntax) && !defined('EXTRACT_CODE'))
			{
				$syntax = $tag;
			}
			else
			{
				$syntax = '';
			}
			if(!empty($syntax) && !defined('EXTRACT_CODE'))
			{
				//
				// check to see if a syntax file for the specified syntax
				// actually exists... if not set $syntax to an empty string
				//
				if( !file_exists($phpbb_root_path . 'includes/geshi/' . $syntax . '.' . $phpEx) )
				{
					$syntax = '';
				}
				if( !empty($syntax) )
				{
					//
					// GeSHi Syntax Highlighter
					//
					$text = strtr($text, array_flip(get_html_translation_table(HTML_ENTITIES, ENT_COMPAT)));
					if( !class_exists('GeSHi') )
					{
						$geshi_class = $phpbb_root_path . 'includes/geshi.' . $phpEx;
						if( !file_exists($geshi_class) )
						{
							trigger_error('XS_BBC_GESHI_MISSING', E_USER_ERROR);
						}
						include($geshi_class);
					}
					$text = $this->undo_phpbb_urls($text);
					$geshi =& new GeSHi($text, $syntax);
					$geshi->set_link_target('_blank');
					$geshi->set_header_type(GESHI_HEADER_DIV);
					if( isset($item['params']['lines']) )
					{
						$line_type = trim(htmlspecialchars($item['params']['lines']));
						switch( strtolower($line_type) )
						{
							case 'geshi-n':
							case 'n':
								$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
							break;

							case 'geshi-f':
							case 'f':
								$fancy = ( isset($item['params']['fancy']) ? trim(htmlspecialchars($item['params']['fancy'])) : 5);
								$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, $fancy);
							break;
							
							default:
								$geshi->enable_line_numbers(GESHI_NO_LINE_NUMBERS);
							break;
						}
					}
					else
					{							
						// Make line type not empty as a syntax is specified
						$line_type = 'not empty';
						$geshi->enable_line_numbers(GESHI_NO_LINE_NUMBERS);
					}
					$geshi->set_line_style('font: normal normal 95% \'Courier New\', Courier, monospace; color: #003030; border-bottom: 1px #E0E0E0 solid;', 'font-weight: bold; color: #006060;', true);
					$geshi->set_link_styles(GESHI_LINK, 'color: #000060;');
					$geshi->set_link_styles(GESHI_HOVER, 'background-color: #f0f000;');
					$geshi->set_footer_content($user->lang['XS_BBC_GESHI_TIME']);
					$geshi->set_footer_content_style('width: auto; font-family: Verdana, Arial, sans-serif; color: #000; font-size: 70%; font-weight: bold; background-color: #f0f0ff; border-top: 1px solid #d0d0d0; padding: 2px;');
					$geshi->enable_keyword_links(false);
					$html = $geshi->parse_code();
					$header = '<div style="text-align: center; width: auto; font-family: Verdana, Arial, sans-serif; color: #808080; font-size: 12px; font-weight: bold; background-color: #f0f0ff; border-bottom: 1px solid #d0d0d0; padding: 2px;">' . sprintf($user->lang['XS_BBC_USING_SYNTAX'], '<span style="color: #900;">' . $syntax . '</span>') . '</div>';
				}
				else
				{
					// Invalid syntax specified so convert to list
					$search = array("\n", '[highlight]', '[/highlight]');
					$replace = array('&nbsp;</span></li><li class="syntax-row"><span class="syntax-row-text">', '<span class="syntax-row-highlight">', '</span>');
					$html = '<li class="syntax-row syntax-row-first"><span class="syntax-row-text">' . str_replace($search, $replace, $text) . '&nbsp;</span></li>';
				}
			}
			else
			{
				// No syntax specified or downloading code so convert to list
				$search = array("\n", '[highlight]', '[/highlight]');
				$replace = array('&nbsp;</span></li><li class="syntax-row"><span class="syntax-row-text">', '<span class="syntax-row-highlight">', '</span>');
				$html = '<li class="syntax-row syntax-row-first"><span class="syntax-row-text">' . str_replace($search, $replace, $text) . '&nbsp;</span></li>';
			}
			$str = '<li class="syntax-row"><span class="syntax-row-text">&nbsp;</span></li>';
			if(substr($html, strlen($html) - strlen($str)) === $str)
			{
				$html = substr($html, 0, strlen($html) - strlen($str));
			}
			$start = isset($item['params']['start']) ? intval($item['params']['start']) : 1;
			$can_download = (($this->code_post_id != 0) ? $this->code_post_id : 0);
			if($can_download)
			{
				$download_text = ' [ <a href="bbc_download.' . $phpEx . '?p=' . $can_download;
				if($this->code_counter)
				{
					$download_text .= '&item=' . $this->code_counter;
				}
				if( $this->pm )
				{
					$download_text .= '&mode=pm';
				}
				$download_text .= '">' . $user->lang['XS_BBC_DOWNLOAD'] . '</a> ]';
			}
			else
			{
				$download_text = '';
			}
			$code_id = substr(md5($content . mt_rand()), 0, 8);
			$str = BBCODE_NOSMILIES_START . '<div class="syntax">';
			$str .= ( ($load_expand == true) ? "\n<script type=\"text/javascript\">\n<!--\nvar id = 'SXBB_" . $this->code_counter . '_' . $code_id ."';\nSXBB[id] = new _SXBB(id);\nSXBB[id].T['select'] = '" . $user->lang['XS_BBC_SELECT'] . "';\nSXBB[id].T['expand'] = '" . $user->lang['XS_BBC_EXPAND'] . "';\nSXBB[id].T['contract'] = '" . $user->lang['XS_BBC_CONTRACT'] . "';\n//-->\n</script>\n" : '');
// By default 'show' the contents of the code block
// to change the default to hide comment the following 4 lines and uncomment the 4 lines below
			$str .= '<div class="syntax-header" id="codehdr2_' . $code_id . '" style="position: relative;"><b>' . $user->lang['XS_BBC_SYNTAX'] . '</b>:' . (empty($item['params']['file']) ? '' : ' (' . htmlspecialchars($item['params']['file']) . ')') . $download_text . ' [ <a href="javascript:void(0)" onclick="xs_show_hide(\'code_' . $code_id . '\', \'code2_' . $code_id . '\', \'\'); xs_show_hide(\'codehdr_' . $code_id . '\', \'codehdr2_' . $code_id . '\', \'\')">' . $user->lang['XS_BBC_HIDE'] . '</a> ]' . ( ($load_expand == true) ? '<script type="text/javascript">SXBB[id].writeCmd();</script>' : '') . '</div>';
			$str .= '<div class="syntax-header" id="codehdr_' . $code_id . '" style="position: relative; display: none;"><b>' . $user->lang['XS_BBC_SYNTAX'] . '</b>:' . (empty($item['params']['file']) ? '' : ' (' . htmlspecialchars($item['params']['file']) . ')') . $download_text . ' [ <a href="javascript:void(0)" onclick="xs_show_hide(\'code_' . $code_id . '\', \'code2_' . $code_id . '\', \'\'); xs_show_hide(\'codehdr_' . $code_id . '\', \'codehdr2_' . $code_id . '\', \'\')">' . $user->lang['XS_BBC_SHOW'] . '</a> ]</div>';
			$str .= $header;
			$str .= '<div class="syntax-content" id="code_' . $code_id . '">';
// By default 'hide' the contents of the code block
/*
			$str .= '<div class="syntax-header" id="codehdr2_' . $code_id . '" style="position: relative; display: none;"><b>' . $user->lang['XS_BBC_SYNTAX'] . '</b>:' . (empty($item['params']['file']) ? '' : ' (' . htmlspecialchars($item['params']['file']) . ')') . $download_text . ' [ <a href="javascript:void(0)" onclick="xs_show_hide(\'code_' . $code_id . '\', \'code2_' . $code_id . '\', \'\'); xs_show_hide(\'codehdr_' . $code_id . '\', \'codehdr2_' . $code_id . '\', \'\')">' . $user->lang['XS_BBC_HIDE'] . '</a> ]' . ( ($load_expand == true) ? '<script type="text/javascript">SXBB[id].writeCmd();</script>' : '') . '</div>';
			$str .= '<div class="syntax-header" id="codehdr_' . $code_id . '" style="position: relative;"><b>' . $user->lang['XS_BBC_SYNTAX'] . '</b>:' . (empty($item['params']['file']) ? '' : ' (' . htmlspecialchars($item['params']['file']) . ')') . $download_text . ' [ <a href="javascript:void(0)" onclick="xs_show_hide(\'code_' . $code_id . '\', \'code2_' . $code_id . '\', \'\'); xs_show_hide(\'codehdr_' . $code_id . '\', \'codehdr2_' . $code_id . '\', \'\')">' . $user->lang['XS_BBC_SHOW'] . '</a> ]</div>';
			$str .= $header;
			$str .= '<div class="syntax-content" id="code_' . $code_id . '" style="display: none;">';
*/
			$str .= ( ($load_expand == true) ? "<script type=\"text/javascript\">\n<!--\nSXBB[id].writeDiv();\n//-->\n</script>\n" : '');
			if( empty($line_type) )
			{
				$html = $str . '<ol class="syntax-list" ' . ($start == 1 ? '' : 'start="' . $start . '"') . '>' . $html . '</ol>';
			}
			else
			{
				if( $start != 1 )
				{
					$html = str_replace('<ol>', '<ol start="' . $start . '">', $html);
				}
				$html = $str . $html;
			}
			// close jscript generated div
			$html .= ( ($load_expand == true) ? "<script type=\"text/javascript\">\n<!--\ndocument.write('</div>');\n//-->\n</script>\n" : '');
			$html .= '</div>'; // closing code-content div
			$html .= '</div>' . BBCODE_NOSMILIES_END;
			// Check if Highlight parameter specified, Only use if line_type is empty
			// format: highlight="1,2,3-10"
			if(isset($item['params']['highlight']) && empty($line_type))
			{
				$search = '<li class="syntax-row';
				$replace = '<li class="syntax-row syntax-row-highlight';
				$search_len = strlen($search);
				$replace_len = strlen($replace);
				// get highlight string
				$items = array();
				$str = $item['params']['highlight'];
				$list = explode(',', $str);
				for($i=0, $end = count($list); $i < $end; $i++)
				{
					$str = trim($list[$i]);
					if(strpos($str, '-'))
					{
						$row = explode('-', $str);
						if(count($row) == 2)
						{
							$num1 = intval($row[0]);
							if($num1 == 0)
							{
								$num1 = 1;
							}
							$num2 = intval($row[1]);
							if($num1 > 0 && $num2 > $num1 && ($num2 - $num1) < 256)
							{
								for($j=$num1; $j<=$num2; $j++)
								{
									$items['row' . $j] = true;
								}
							}
						}
					}
					else
					{
						$num = intval($str);
						if($num)
						{
							$items['row' . $num] = true;
						}
					}
				}
				if(count($items))
				{
					// process all lines
					$num = $start - 1;
					$pos = strpos($html, $search);
					$total = count($items);
					$found = 0;
					while($pos !== false)
					{
						$num ++;
						if(isset($items['row' . $num]))
						{
							$found ++;
							$html = substr($html, 0, $pos) . $replace . substr($html, $pos + $search_len);
							$pos += $replace_len;
						}
						else
						{
							$pos += $search_len;
						}
						$pos = $found < $total ? strpos($html, $search, $pos) : false;
					}
				}
			}
			$this->code_counter++;
			return array(
				'valid'	=> true,
				'html'	=> $html,
				'allow_nested' => false
				);
		}

		/**
		*	Invalid tag
		*/
		return $error;
	}

	/**
	 *	Get the current list of supported GeSHi syntaxes
	 */
	function get_geshi_syntaxes()
	{
		global $phpbb_root_path, $phpEx;
		
		if( !count($this->geshi_syntax) )
		{
			if ($handle = @opendir($phpbb_root_path . 'includes/geshi/'))
			{
				$file_list = array();
				$exclude = array('.', '..');
				while (false !== ($file = @readdir($handle)))
				{ 
					$fileinfo = pathinfo($file);
					if( !in_array($file, $exclude) && strtolower($fileinfo['extension']) == $phpEx )
					{ 
						$file_list[] = substr($file, 0, strpos($file, '.'));
					}
				}
				@closedir($handle);
				sort($file_list);
				for($i = 0, $file_count = count($file_list); $i < $file_count; $i++)
				{
						$this->allowed_bbcode[$file_list[$i]] = array(
									'nested'	=> false,
									'inurl'		=> false,
									'allow_empty'	=> false,
									'in_sig'	=> false,
									'bbcode_helpline' => '',
									'display_on_posting' => 0,
									'bbcode_match' => '',
									'bbcode_tpl' => '',
								);
				}
				return $file_list;
			}
		}
	}

	/**
	 *	Check if bbcode tag is valid
	 */
	function valid_tag($tag, $is_html)
	{
		if($is_html)
		{
			return false;
		}
		else
		{
			return (isset($this->allowed_bbcode[$tag]) && (preg_match('/^[a-z0-9]+$/', $tag) || $tag === '*')) ? true : false;
		}
	}

	/**
	 *	Check if parameter name is valid
	 */
	function valid_param($param)
	{
		return preg_match('/^[a-z]+$/', $param);
	}

	/**
	 *	Splits string to tag and parameters
	 */
	function extract_params($tag, $is_html)
	{
		$this->tag = $tag;
		$this->params = array();
		$tag = str_replace("\t", ' ', $tag);
		// get parameters
		$pos_eq = strpos($tag, '=');
		$pos_space = strpos($tag, ' ');
		if($pos_space !== false && $pos_eq !== false && $pos_space < $pos_eq)
		{
			// mutiple parameters
			$param_start = 0;
			$param_str = substr($tag, $pos_space + 1);
			$param_len = strlen($param_str);
			$this->tag = strtolower(substr($tag, 0, $pos_space));
			if(!$this->valid_tag($this->tag, $is_html))
			{
				return false;
			}
			while($param_start < $param_len)
			{
				// find entry for '='
				$pos = strpos($param_str, '=', $param_start);
				if($pos === false)
				{
					return false;
				}
				else
				{
					// get parameter name
					$str = substr($param_str, $param_start, $pos - $param_start);
					if(!$this->valid_param($str))
					{
						return false;
					}
					// get value
					$pos++;
					$quoted = false;
					if(substr($param_str, $pos, 1) === '"')
					{
						$pos2 = strpos($param_str, '"', $pos + 1);
						if($pos2 === false)
						{
							// invalid quote. search for space instead
							$pos2 = strpos($param_str, ' ', $pos + 1);
						}
 						else
						{
							$pos++;
							$quoted = true;
						}
					}
					else
					{
						$pos2 = strpos($param_str, ' ', $pos);
					}
					// end not found. counting until end of expression
					if($pos2 === false)
					{
						$pos2 = $param_len;
					}
					$this->params[$str] = substr($param_str, $pos, $pos2 - $pos);
					$param_start = $pos2 + 1;
					if($quoted)
					{
						$param_start ++;
					}
				}
			}
		}
		elseif($pos_eq !== false)
		{
			// single parameter
			$str = substr($tag, $pos_eq + 1);
			$this->tag = strtolower(substr($tag, 0, $pos_eq));
			if(!$this->valid_tag($this->tag, $is_html))
			{
				return false;
			}
			if(strlen($str) > 1 && substr($str, 0, 1) === '"' && substr($str, strlen($str) - 1) === '"')
			{
				$str = substr($str, 1, strlen($str) - 2);
			}
			if(trim($str) !== $str)
			{
				return false;
			}
			$this->params['param'] = $str;
		}
		else
		{
			// no parameters
			$this->tag = strtolower($tag);
			if(!$this->valid_tag($this->tag, $is_html))
			{
				return false;
			}
		}
		return true;
	}

	/**
	 *	Recusive function that converts text to bbcode tree
	 */
	function push($start, $level, $prev_tags)
	{
		$items = array();
		$pos_start_bbcode = $this->allow_bbcode ? strpos($this->text, '[', $start) : false;
		$pos_start_html = $this->allow_html ? strpos($this->text, '<', $start) : false;
		while($pos_start_bbcode !== false || $pos_start_html !== false)
		{
			$pos_start = $pos_start_bbcode === false ? $pos_start_html : ($pos_start_html === false ? $pos_start_bbcode : min($pos_start_bbcode, $pos_start_html));
			$is_html = $pos_start_html === $pos_start ? true : false;
			$prev_start = $start;
			// found tag. get data.
			$pos_end = strpos($this->text, $is_html ? '>' : ']', $pos_start);
			if($pos_end === false)
			{
				$tag_valid = false;
			}
			else
			{
				$code = substr($this->text, $pos_start, $pos_end - $pos_start + 1);
				// check if tag is valid and get type of tag
				$tag_valid = true;
				$tag_closing = false;
				$tag_self_closing = false;
				if(strlen($code) < 3)
				{
					$tag_valid = false;
				}
				elseif(!$is_html && strpos($code, '[', 1) !== false)
				{
					$tag_valid = false;
				}
				elseif($is_html && strpos($code, '<', 1) !== false)
				{
					$tag_valid = false;
				}
				elseif(!$is_html && strpos($code, "\n") !== false)
				{
					$tag_valid = false;
				}
				elseif(substr($code, 0, 2) === ($is_html ? '</' : '[/'))
				{
					$tag_closing = true;
					$tag = substr($code, 2, strlen($code) - 3);
				}
				elseif(substr($code, strlen($code) - 3) === ($is_html ? ' />' : ' /]'))
				{
					$tag_self_closing = true;
					$tag = substr($code, 1, strlen($code) - 4);
				}
				else
				{
					$tag = substr($code, 1, strlen($code) - 2);
				}
				// do not process tag if it requires too much recursion
				if($level > 10 && (!$tag_closing && !$tag_self_closing))
				{
					$tag_valid = false;
				}
				// special tags
				if($code === '[*]')
				{
					$tag_self_closing = true;
				}
			}
			if($tag_valid)
			{
				$start = $pos_end;
				$params = array();
				if(!$tag_closing)
				{
					if(!$this->extract_params($tag, $is_html))
					{
						$tag_valid = false;
					}
					else
					{
						$tag = $this->tag;
						$params = $this->params;
					}
				}
				else
				{
					if(strpos($tag, ' autourl=' . AUTOURL))
					{
						$tag = str_replace(' autourl=' . AUTOURL, '', $tag);
					}
					$tag = strtolower($tag);
					if(!$this->valid_tag($tag, $is_html))
					{
						$tag_valid = false;
					}
				}
			}
			if($tag_valid)
			{
				if($tag_closing)
				{
					// check if this is correct closing tag
					if(in_array($tag, $prev_tags))
					{
						return array(
							'items'	=> $items,
							'tag'	=> $tag,
							'pos'	=> $pos_end,
							'start'	=> $pos_start,
							'len'	=> strlen($code)
							);
					}
				}
				elseif($tag_self_closing)
				{
					// found self-closing tag
					$items[] = array(
						'tag'		=> $tag,
						'code'		=> $code,
						'params'	=> $params,
						'start'		=> $pos_start,
						'start_len'	=> strlen($code),
						'end'		=> $pos_end + 1,
						'end_len'	=> 0,
						'level'		=> $level + 1,
						'iteration'	=> 0,
						'self_closing'	=> 1,
						'prev'		=> array(),
						'next'		=> array(),
						'is_html'	=> $is_html,
						'in_sig'	=> $this->allowed_bbcode[$tag]['in_sig'],
						'items'		=> array()
						);
				}
				else
				{
					// found correct tag. call recursive search
					$result = $this->push($pos_end, $level + 1, array_merge($prev_tags, array($tag)));
					if($result['tag'] === $tag)
					{
						// found correctly finished tag
						$items[] = array(
							'tag'		=> $tag,
							'code'		=> $code,
							'params'	=> $params,
							'start'		=> $pos_start,
							'start_len'	=> strlen($code),
							'end'		=> $result['start'],
							'end_len'	=> $result['len'],
							'level'		=> $level + 1,
							'iteration'	=> 0,
							'self_closing'	=> 2,
							'prev'		=> array(),
							'next'		=> array(),
							'is_html'	=> $is_html,
							'in_sig'	=> $this->allowed_bbcode[$tag]['in_sig'],
							'items'		=> $result['items']
							);
						$start = $result['pos'];
					}
					else
					{
						// pos, start and len resulted in errors if debug mode was enabled and you
						// forgot to close the tag... Bigwebmaster.. yet again
						$items = array_merge($items, $result['items']);
						return array(
							'items'	=> $items,
							'tag'	=> $result['tag'],
							'pos'	=> ( isset($result['pos']) ? $result['pos'] : 0),
							'start'	=> ( isset($result['start']) ? $result['start'] : 0),
							'len'	=> ( isset($result['len']) ? $result['len'] : 0),
							);
					}
				}
			}
			else
			{
				$start = $pos_start + 1;
			}
			$pos_start_bbcode = $this->allow_bbcode ? strpos($this->text, '[', $start) : false;
			$pos_start_html = $this->allow_html ? strpos($this->text, '<', $start) : false;
		}
		return array(
			'items'	=> $items,
			'tag'	=> false,
			);
	}

	/**
	 *	Debug function. Prints tree of bbcode
	 */
	function debug($items)
	{
		for($i=0, $end = count($items); $i < $end; $i++)
		{
			$item = $items[$i];
			if($item['tag'])
			{
				for($j=0; $j<$item['level']; $j++)
				{
					echo '-';
				}
				echo ' ', $item['tag'], ' (';
				$first = true;
				foreach($item['params'] as $var => $value)
				{
					if(!$first) echo ', ';
					$first = false;
					echo $var, '="', htmlspecialchars($value), '"';
				}
				echo ")<br />\n";
				$this->debug($item['items']);
			}
		}
	}

	/**
	 *	Process text
	 */
	function process_text($text, $br = true, $chars = true)
	{
		$search = array(
			'[url autourl=' . AUTOURL . ']',
			'[/url autourl=' . AUTOURL  .']',
			'[email autourl=' . AUTOURL . ']',
			'[/email autourl=' . AUTOURL  .']'
		);
		$replace = array('','','','');
		$text = str_replace($search, $replace, $text);
		if($chars)
		{
			$text = str_replace('&quot;','"', $text);
			$text = str_replace('&amp;#', '&#', $text);
		}
		else
		{
			$text = str_replace('&quot;','"', $text);
		}
		if($br)
		{
			$text = str_replace('&lt;br /&gt;', '<br />', $text);
		}
		return $text;
	}

	/**
	 *	Process tree
	 */
	function process($start, $end, &$items)
	{
		$html = '';
		for($i=0, $i_end = count($items); $i < $i_end; $i++)
		{
			$item = &$items[$i];
			// check code before item
			if($item['start'] > $start)
			{
				$html .= $this->process_text(substr($this->text, $start, $item['start'] - $start));
			}
			// process tag
			$result = $this->process_tag($item);
			if($result['valid'] && !isset($result['html']))
			{
				$html .= $result['start'];
				if(!isset($result['allow_nested']) || $result['allow_nested'])
				{
					// process code inside tag
					$html .= $this->process($item['start'] + $item['start_len'], $item['end'], $item['items']);
				}
				$html .= $result['end'];
			}
			elseif($result['valid'])
			{
				$html .= $result['html'];
			}
			else
			{
				// invalid tag. show html code for it and process nested tags
				$item['valid'] = false;
				if($item['start_len'])
				{
					$html .= $this->process_text(substr($this->text, $item['start'], $item['start_len']));
				}
				$html .= $this->process($item['start'] + $item['start_len'], $item['end'], $item['items']);
				if($item['end_len'])
				{	
					$html .= $this->process_text(substr($this->text, $item['end'], $item['end_len']));
				}
				if( $this->is_sig && $item['in_sig'] && !$item['valid'] )
				{
					if( ($item['tag'] === 'rquote') && ($this->rquote_counter >= $this->rquote_limit) )
					{
						$html .= $this->text_once_sig;
					}
					else
					{
						$html .= $this->text_only_sig;
					}
				}
				elseif( $this->is_sig && !$item['in_sig'] && !$item['valid'] )
				{
					$html .= $this->text_not_sig;
				}

			}
			$start = $item['end'] + $item['end_len'];
		}
		// process code after item
		if($start < $end)
		{
			$html .= $this->process_text(substr($this->text, $start, $end - $start));
		}
		return $html;
	}

	/**
	 *	Make urls clickable
	 */
	function undo_phpbb_urls($message)
	{
		// Remove the <!-- [lmve] --><a ... > link </a><!-- [lmve] --> added by phpBB
		// And replace it with the URL or email address...
		$search = "/(<\!-- . -->)(<a(.*?)\>(.*?)<\/a>)(<\!-- . -->)/si";
		$replace = "\\4";
	 	$message = preg_replace($search, $replace, ' ' . $message . ' ');
		$message = substr($message, 1, strlen($message) - 2);
		return $message;
	}

	/**
	 *	Converts text to html code
	 */
	function parse($text, $id = false)
	{
		if(defined('IN_PHPBB'))
		{
			$search = array(
				$id ? ':' . $id : '',
				'code:1]',
				'list:o]',
				);
			$replace = array(
				'',
				'code]',
				'list]',
				);
			$text = str_replace($search, $replace, $text);
		}
		// reset variables
		$this->text = $text;
		$this->data = array();
		$this->html = '';
		$this->code_counter = 0;
		$this->img_counter = 0;
		$this->rquote_counter = 0;
		$this->code_text = '';
		$this->code_filename = '';
		// if bbcode and html are disabled then return unprocessed text
		if(!$this->allow_bbcode && !$this->allow_html)
		{
			$this->html = $this->text;
			return $this->html;
		}
		// convert to tree structure
		$result = $this->push(0, 0, array());
		$this->data = $result['items'];
		// Dump debug info if enabled
		if( $this->debug_enable )
		{
			global $user;
			ob_start();
			$this->debug($this->data);
			$str = ob_get_contents();
			ob_end_clean();
			$this->html = $user->lang['XS_BBC_DEBUG_DEBUG'] . ':<br />' . $str;
			return $this->html;
		}
		// convert to html
		$this->html = $this->process(0, strlen($this->text), $this->data);
		return $this->html;
	}
}
//
// End Class Definition
//

function undo_htmlspecialchars($input, $full_undo = false)
{
	if($full_undo)
	{
		$input = str_replace('&nbsp;', '', $input);
	}
	$input = preg_replace("/&gt;/i", ">", $input);
	$input = preg_replace("/&lt;/i", "<", $input);
	$input = preg_replace("/&quot;/i", "\"", $input);
	$input = preg_replace("/&amp;/i", "&", $input);
	if($full_undo)
	{
		if(preg_match_all('/&\#([0-9]+);/', $input, $matches) && count($matches))
		{
			$list = array();
			for($i=0, $end = count($matches[1]); $i < $end; $i++)
			{
				$list[$matches[1][$i]] = true;
			}
			$search = array();
			$replace = array();
			foreach($list as $var => $value)
			{
				$search[] = '&#' . $var . ';';
				$replace[] = chr($var);
			}
			$input = str_replace($search, $replace, $input);
		}
	}
	return $input;
}

/**
* The function the hooked function below calls
*
* @param array $item The template item (an array) currently being parsed
* @param int $key The key/index from the array
* @param bool $preview If set to false (default) a post preview is not being viewed, true if a preview is being viewed.
*
* @return nothing as directly alters the array as it's passed by ref
*/
function parse_me(&$item, $key, $preview = false)
{
	global $sh_bbcode, $user;

	$debug = false;
	if( $debug )
	{
		echo '<pre>';
		print_r($item);
		echo '</pre>';
//		exit;
	}
	//
	// XS BBCode Flags
	//
	$sh_bbcode->allow_bbcode = true;
	$sh_bbcode->pm = false;
	// Error strings
	$sh_bbcode->text_once_sig = '&nbsp;- <b style="color: #f00;">' . $user->lang['XS_SH_NOTE'] . '</b>: ' . $user->lang['XS_SH_TAG_ONCE'];
	$sh_bbcode->text_only_sig = '&nbsp;- <b style="color: #f00;">' . $user->lang['XS_SH_NOTE'] . '</b>: ' . $user->lang['XS_SH_TAG_SIG'];
	$sh_bbcode->text_not_sig = '&nbsp;- <b style="color: #f00;">' . $user->lang['XS_SH_NOTE'] . '</b>: ' . $user->lang['XS_SH_TAG_NOSIG'];

	if( $preview )
	{
		if( !$sh_bbcode->in_ucp )
		{
			$sh_bbcode->is_sig = false;
			$message = $sh_bbcode->parse($item['PREVIEW_MESSAGE']);
			$item['PREVIEW_MESSAGE'] = $message;
			$sh_bbcode->is_sig = true;
			$message = $sh_bbcode->parse($item['PREVIEW_SIGNATURE']);
			$item['PREVIEW_SIGNATURE'] = $message;
		}
		else
		{
			if( isset($item['S_PRIVMSGS']) && isset($item['S_DISPLAY_PREVIEW']) )
			{
				$sh_bbcode->is_sig = false;
				$message = $sh_bbcode->parse($item['PREVIEW_MESSAGE']);
				$item['PREVIEW_MESSAGE'] = $message;
				$sh_bbcode->is_sig = true;
				$message = $sh_bbcode->parse($item['PREVIEW_SIGNATURE']);
				$item['PREVIEW_SIGNATURE'] = $message;
			}
			elseif( isset($item['S_PRIVMSGS']) )
			{
				$sh_bbcode->is_sig = false;
				$sh_bbcode->pm = true;
				$sh_bbcode->code_post_id = (isset($item['MSG_ID'])) ? $item['MSG_ID'] : '';
				$message = (isset($item['MESSAGE'])) ? $sh_bbcode->parse($item['MESSAGE']) : '';
				$sh_bbcode->code_post_id = 0;
				$item['MESSAGE'] = $message;
				$sh_bbcode->is_sig = true;
				$message = (isset($item['SIGNATURE'])) ? $sh_bbcode->parse($item['SIGNATURE']) : '';
				$item['SIGNATURE'] = $message;
			}
			elseif ( isset($item['SIGNATURE_PREVIEW']) )
			{
				$sh_bbcode->is_sig = true;
				$message = $sh_bbcode->parse($item['SIGNATURE_PREVIEW']);
				$item['SIGNATURE_PREVIEW'] = $message;
			}
		}
	}
	else
	{
		if( isset($item['MESSAGE']) )
		{
			$sh_bbcode->is_sig = false;
			$sh_bbcode->code_post_id = (isset($item['POST_ID'])) ? $item['POST_ID'] : '';
			$message = $sh_bbcode->parse($item['MESSAGE']);
			$sh_bbcode->code_post_id = 0;
			if( $sh_bbcode->in_search )
			{
				$search = '&lt;span class=&quot;posthilit&quot;&gt;';
				$replace = '<span class="posthilit">';
				$message = str_replace($search, $replace, $message);
			}
			$item['MESSAGE'] = $message;
		}
		elseif( isset($item['topic_review_row']) )
		{
			for( $i = 0; $i < count($item['topic_review_row']); $i++)
			{
				$sh_bbcode->is_sig = false;
				$message = $sh_bbcode->parse($item['topic_review_row'][$i]['MESSAGE']);
				$item['topic_review_row'][$i]['MESSAGE'] = $message;
			}
		}
		elseif( isset($item['history_row']) )
		{
			for( $i = 0; $i < count($item['history_row']); $i++)
			{
				$sh_bbcode->is_sig = false;
				$message = $sh_bbcode->parse($item['history_row'][$i]['MESSAGE']);
				$item['history_row'][$i]['MESSAGE'] = $message;
			}
		}
		if( isset($item['POST_PREVIEW']) )
		{
			// MCP Post Preview
			$sh_bbcode->is_sig = false;
			$message = $sh_bbcode->parse($item['POST_PREVIEW']);
			$item['POST_PREVIEW'] = $message;
		}
		if( isset($item['SIGNATURE']) && !empty($item['SIGNATURE']) )
		{
			//
			// Check the signature for custom tags
			//
			$sh_bbcode->is_sig = true;
			$message = $sh_bbcode->parse($item['SIGNATURE']);
			$item['SIGNATURE'] = $message;
		}
	}
}	

/**
* This is the main (hooked) function
*/
function parse_it()
{
	global $template, $sh_bbcode;

	$debug = false;
	if( $debug )
	{
		echo '<pre>';
		print_r($template->_tpldata['.']);
		echo '</pre>';
//		exit;
	}

	$sh_bbcode->in_search = false;
	$sh_bbcode->in_ucp = false;
	$sh_bbcode->pm = false;
  
	if( isset($template->_tpldata['postrow']) )
	{
		// posts in viewtopic
		array_walk($template->_tpldata['postrow'],'parse_me');
	}
	elseif( isset($template->_tpldata['searchresults']) )
	{
		// Search Results
		$sh_bbcode->in_search = true;  		
		array_walk($template->_tpldata['searchresults'],'parse_me');
	}  	
	elseif( isset($template->_tpldata['topic_review_row']) )
	{
		// Topic Review
		array_walk($template->_tpldata['topic_review_row'],'parse_me');
		if( isset($template->_tpldata['.'][0]['PREVIEW_MESSAGE']) && !empty($template->_tpldata['.'][0]['PREVIEW_MESSAGE']) )
		{
			// Previewing Message
			array_walk($template->_tpldata['.'],'parse_me', true);
		}  	
		elseif( isset($template->_tpldata['.'][0]['S_IN_MCP']) && isset($template->_tpldata['.'][0]['S_TOPIC_REVIEW']) )
		{
			// In MCP
			array_walk($template->_tpldata['.'],'parse_me');
		}  	
	}  	
	elseif( isset($template->_tpldata['.'][0]['S_IN_UCP']) && isset($template->_tpldata['.'][0]['S_PRIVMSGS']) )
	{
		// In UCP - PM
		$sh_bbcode->in_ucp = true;
		array_walk($template->_tpldata['.'],'parse_me', true);
		if( isset($template->_tpldata['history_row']) )
		{
			// PM History
			array_walk($template->_tpldata['history_row'],'parse_me');
		}
	}  	
	elseif( isset($template->_tpldata['.'][0]['PREVIEW_MESSAGE']) && !empty($template->_tpldata['.'][0]['PREVIEW_MESSAGE']) )
	{
		// Previewing Message
		array_walk($template->_tpldata['.'],'parse_me', true);
	}  	
	elseif( isset($template->_tpldata['.'][0]['S_IN_UCP']) )
	{
		// In UCP previewing Signature
		$sh_bbcode->in_ucp = true;
		array_walk($template->_tpldata['.'],'parse_me', true);
	}  	
	elseif( isset($template->_tpldata['.'][0]['SIGNATURE']) )
	{
		// Viewing Profile
		array_walk($template->_tpldata['.'],'parse_me');
	}  	

}
//
// End function Block
//

// Init bbcode class
$sh_bbcode = new SyntaxHighlighter();

$phpbb_hook->register(array('template','display'), 'parse_it');

?>