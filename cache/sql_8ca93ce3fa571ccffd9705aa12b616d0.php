<?php exit; ?>
1278060082
SELECT * FROM phpbb_bbcodes WHERE bbcode_id IN (15, 18, 19, 20, 21, 23, 26, 27, 28, 29, 31)
7176
a:8:{i:0;a:10:{s:9:"bbcode_id";s:2:"15";s:10:"bbcode_tag";s:5:"Hide=";s:15:"bbcode_helpline";s:0:"";s:18:"display_on_posting";s:1:"0";s:12:"bbcode_match";s:28:"[Hide={NUMBER}]{TEXT}[/Hide]";s:10:"bbcode_tpl";s:35:"<div class="adapthide">{TEXT}</div>";s:16:"first_pass_match";s:37:"!\[hide\=([0-9]+)\](.*?)\[/hide\]!ies";s:18:"first_pass_replace";s:141:"'[hide=${1}:$uid]'.str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim('${2}')).'[/hide:$uid]'";s:17:"second_pass_match";s:45:"!\[hide\=([0-9]+):$uid\](.*?)\[/hide:$uid\]!s";s:19:"second_pass_replace";s:33:"<div class="adapthide">${2}</div>";}i:1;a:10:{s:9:"bbcode_id";s:2:"18";s:10:"bbcode_tag";s:9:"Googlevid";s:15:"bbcode_helpline";s:81:"Copy and paste the Google URL (Link to the video) into [Googlevid]URL[/Googlevid]";s:18:"display_on_posting";s:1:"0";s:12:"bbcode_match";s:72:"[Googlevid]http://video.google.com/videoplay?docid=-{NUMBER}[/Googlevid]";s:10:"bbcode_tpl";s:187:"<embed style="width:400px; height:326px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId={NUMBER}&hl=en" flashvars=""></embed>";s:16:"first_pass_match";s:84:"!\[googlevid\]http\://video\.google\.com/videoplay\?docid\=-([0-9]+)\[/googlevid\]!i";s:18:"first_pass_replace";s:78:"[googlevid:$uid]http://video.google.com/videoplay?docid=-${1}[/googlevid:$uid]";s:17:"second_pass_match";s:94:"!\[googlevid:$uid\]http\://video\.google\.com/videoplay\?docid\=-([0-9]+)\[/googlevid:$uid\]!s";s:19:"second_pass_replace";s:183:"<embed style="width:400px; height:326px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId=${1}&hl=en" flashvars=""></embed>";}i:2;a:10:{s:9:"bbcode_id";s:2:"19";s:10:"bbcode_tag";s:5:"Right";s:15:"bbcode_helpline";s:30:"Aligns your text to the right.";s:18:"display_on_posting";s:1:"1";s:12:"bbcode_match";s:21:"[Right]{TEXT}[/Right]";s:10:"bbcode_tpl";s:31:"<div align="right">{TEXT}</div>";s:16:"first_pass_match";s:29:"!\[right\](.*?)\[/right\]!ies";s:18:"first_pass_replace";s:138:"'[right:$uid]'.str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim('${1}')).'[/right:$uid]'";s:17:"second_pass_match";s:37:"!\[right:$uid\](.*?)\[/right:$uid\]!s";s:19:"second_pass_replace";s:29:"<div align="right">${1}</div>";}i:3;a:10:{s:9:"bbcode_id";s:2:"20";s:10:"bbcode_tag";s:4:"Left";s:15:"bbcode_helpline";s:29:"Aligns your text to the left.";s:18:"display_on_posting";s:1:"1";s:12:"bbcode_match";s:19:"[Left]{TEXT}[/Left]";s:10:"bbcode_tpl";s:30:"<div align="left">{TEXT}</div>";s:16:"first_pass_match";s:27:"!\[left\](.*?)\[/left\]!ies";s:18:"first_pass_replace";s:136:"'[left:$uid]'.str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim('${1}')).'[/left:$uid]'";s:17:"second_pass_match";s:35:"!\[left:$uid\](.*?)\[/left:$uid\]!s";s:19:"second_pass_replace";s:28:"<div align="left">${1}</div>";}i:4;a:10:{s:9:"bbcode_id";s:2:"21";s:10:"bbcode_tag";s:2:"HR";s:15:"bbcode_helpline";s:43:"Create a horizontal rule (horizontal line).";s:18:"display_on_posting";s:1:"0";s:12:"bbcode_match";s:9:"[HR][/HR]";s:10:"bbcode_tpl";s:6:"<hr />";s:16:"first_pass_match";s:16:"!\[hr\]\[/hr\]!i";s:18:"first_pass_replace";s:19:"[hr:$uid][/hr:$uid]";s:17:"second_pass_match";s:19:"[hr:$uid][/hr:$uid]";s:19:"second_pass_replace";s:0:"";}i:5;a:10:{s:9:"bbcode_id";s:2:"27";s:10:"bbcode_tag";s:8:"syntaxer";s:15:"bbcode_helpline";s:0:"";s:18:"display_on_posting";s:1:"1";s:12:"bbcode_match";s:27:"[syntaxer]{TEXT}[/syntaxer]";s:10:"bbcode_tpl";s:30:"<pre><code>{TEXT}</code></pre>";s:16:"first_pass_match";s:35:"!\[syntaxer\](.*?)\[/syntaxer\]!ies";s:18:"first_pass_replace";s:144:"'[syntaxer:$uid]'.str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim('${1}')).'[/syntaxer:$uid]'";s:17:"second_pass_match";s:43:"!\[syntaxer:$uid\](.*?)\[/syntaxer:$uid\]!s";s:19:"second_pass_replace";s:28:"<pre><code>${1}</code></pre>";}i:6;a:10:{s:9:"bbcode_id";s:2:"23";s:10:"bbcode_tag";s:6:"Slide=";s:15:"bbcode_helpline";s:87:"A slide within the image slider where [slide={IMAGE_DESCRIPTION}]{URL_TO_IMAGE}[/slide]";s:18:"display_on_posting";s:1:"0";s:12:"bbcode_match";s:33:"[Slide={SIMPLETEXT}]{URL}[/Slide]";s:10:"bbcode_tpl";s:77:"<a href="{URL}" title="{SIMPLETEXT}"><img src="{URL}" alt="{SIMPLETEXT}"></a>";s:16:"first_pass_match";s:563:"!\[slide\=([a-zA-Z0-9-+.,_ ]+)\](?:([a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(www\.(?:[a-z0-9\-._~\!$&'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))\[/slide\]!ie";s:18:"first_pass_replace";s:97:"'[slide=${1}:$uid]'.$this->bbcode_specialchars(('${2}') ? '${2}' : 'http://${3}').'[/slide:$uid]'";s:17:"second_pass_match";s:583:"!\[slide\=([a-zA-Z0-9-+.,_ ]+):$uid\](?i)((?:[a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(?:www\.(?:[a-z0-9\-._~\!$&'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))(?-i)\[/slide:$uid\]!s";s:19:"second_pass_replace";s:59:"<a href="${2}" title="${1}"><img src="${2}" alt="${1}"></a>";}i:7;a:10:{s:9:"bbcode_id";s:2:"26";s:10:"bbcode_tag";s:7:"Ytmusic";s:15:"bbcode_helpline";s:78:"Copy and paste the Youtube URL (Link to the video) into [Ytmusic]URL[/Ytmusic]";s:18:"display_on_posting";s:1:"0";s:12:"bbcode_match";s:62:"[Ytmusic]http://www.youtube.com/watch?v={SIMPLETEXT}[/Ytmusic]";s:10:"bbcode_tpl";s:305:"<object width="425" height="25"><param name="movie" value="http://www.youtube.com/v/{SIMPLETEXT}"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/{SIMPLETEXT}" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>a";s:16:"first_pass_match";s:82:"!\[ytmusic\]http\://www\.youtube\.com/watch\?v\=([a-zA-Z0-9-+.,_ ]+)\[/ytmusic\]!i";s:18:"first_pass_replace";s:64:"[ytmusic:$uid]http://www.youtube.com/watch?v=${1}[/ytmusic:$uid]";s:17:"second_pass_match";s:92:"!\[ytmusic:$uid\]http\://www\.youtube\.com/watch\?v\=([a-zA-Z0-9-+.,_ ]+)\[/ytmusic:$uid\]!s";s:19:"second_pass_replace";s:289:"<object width="425" height="25"><param name="movie" value="http://www.youtube.com/v/${1}"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/${1}" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>a";}}