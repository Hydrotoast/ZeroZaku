<?php exit; ?>
1278018411
SELECT s.style_id, t.template_storedb, t.template_path, t.template_id, t.bbcode_bitfield, t.template_inherits_id, t.template_inherit_path, c.theme_path, c.theme_name, c.theme_storedb, c.theme_id, i.imageset_path, i.imageset_id, i.imageset_name FROM phpbb_styles s, phpbb_styles_template t, phpbb_styles_theme c, phpbb_styles_imageset i WHERE s.style_id = 4 AND t.template_id = s.template_id AND c.theme_id = s.theme_id AND i.imageset_id = s.imageset_id
470
a:1:{i:0;a:14:{s:8:"style_id";s:1:"4";s:16:"template_storedb";s:1:"0";s:13:"template_path";s:8:"zerozaku";s:11:"template_id";s:1:"4";s:15:"bbcode_bitfield";s:4:"lNg=";s:20:"template_inherits_id";s:1:"0";s:21:"template_inherit_path";s:0:"";s:10:"theme_path";s:8:"zerozaku";s:10:"theme_name";s:13:"Zerozaku v2.0";s:13:"theme_storedb";s:1:"1";s:8:"theme_id";s:1:"5";s:13:"imageset_path";s:8:"zerozaku";s:11:"imageset_id";s:1:"5";s:13:"imageset_name";s:13:"Zerozaku v2.0";}}