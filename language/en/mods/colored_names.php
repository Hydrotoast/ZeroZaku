<?php
/**
*
* IGN Colored Names [English]
*
* @package language
* @version $Id: ucp.php 8479 2008-03-29 00:22:48Z naderman $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine



// Colored Name Entrees
$lang = array_merge($lang, array(

    //Admin Section
	'USER_STYLE_ALLOWED' => 'Allowed to customize name color',
	'LOG_USER_UPDATE_STYLE_ALLOWED' => '<strong>Changed user allowed style permission</strong><br />» %s',

    //PRofile Section
	'USER_STYLE_PREVIEW' 			=> 'Name Style Preview:',
	'USER_STYLE_COLOR' 				=> 'Name Color:',
	'USER_STYLE_BACKGROUND' 	=> 'Background Color:',
	'USER_STYLE_BORDER' 			=> 'Border Color:',
	'USER_STYLE_FONTWEIGHT' 	=> 'Font Weight:',
	'USER_STYLE_FONTSTYLE'		=> 'Font Style:',
	'USER_STYLE_DECORATION' 	=> 'Text Decoration:',
	'USER_COLOR_LIST' => array(
        'USER_COLOR__NONE_'     => '- None -',
        'USER_COLOR_ALICEBLUE'     => 'AliceBlue',
        'USER_COLOR_ANTIQUEWHITE'     => 'AntiqueWhite',
        'USER_COLOR_CYAN'     => 'Cyan',
        'USER_COLOR_AQUAMARINE'     => 'Aquamarine',
        'USER_COLOR_AZURE'     => 'Azure',
        'USER_COLOR_BEIGE'     => 'Beige',
        'USER_COLOR_BISQUE'     => 'Bisque',
        'USER_COLOR_BLACK'     => 'Black',
        'USER_COLOR_BLANCHEDALMOND'     => 'BlanchedAlmond',
        'USER_COLOR_BLUE'     => 'Blue',
        'USER_COLOR_BLUEVIOLET'     => 'BlueViolet',
        'USER_COLOR_BROWN'     => 'Brown',
        'USER_COLOR_BURLYWOOD'     => 'BurlyWood',
        'USER_COLOR_CADETBLUE'     => 'CadetBlue',
        'USER_COLOR_CHARTREUSE'     => 'Chartreuse',
        'USER_COLOR_CHOCOLATE'     => 'Chocolate',
        'USER_COLOR_CORAL'     => 'Coral',
        'USER_COLOR_CORNFLOWERBLUE'     => 'CornflowerBlue',
        'USER_COLOR_CORNSILK'     => 'Cornsilk',
        'USER_COLOR_CRIMSON'     => 'Crimson',
        'USER_COLOR_DARKBLUE'     => 'DarkBlue',
        'USER_COLOR_DARKCYAN'     => 'DarkCyan',
        'USER_COLOR_DARKGOLDENROD'     => 'DarkGoldenRod',
        'USER_COLOR_DARKGRAY'     => 'DarkGray',
        'USER_COLOR_DARKGREEN'     => 'DarkGreen',
        'USER_COLOR_DARKKHAKI'     => 'DarkKhaki',
        'USER_COLOR_DARKMAGENTA'     => 'DarkMagenta',
        'USER_COLOR_DARKOLIVEGREEN'     => 'DarkOliveGreen',
        'USER_COLOR_DARKORANGE'     => 'Darkorange',
        'USER_COLOR_DARKORCHID'     => 'DarkOrchid',
        'USER_COLOR_DARKRED'     => 'DarkRed',
        'USER_COLOR_DARKSALMON'     => 'DarkSalmon',
        'USER_COLOR_DARKSEAGREEN'     => 'DarkSeaGreen',
        'USER_COLOR_DARKSLATEBLUE'     => 'DarkSlateBlue',
        'USER_COLOR_DARKSLATEGRAY'     => 'DarkSlateGray',
        'USER_COLOR_DARKTURQUOISE'     => 'DarkTurquoise',
        'USER_COLOR_DARKVIOLET'     => 'DarkViolet',
        'USER_COLOR_DEEPPINK'     => 'DeepPink',
        'USER_COLOR_DEEPSKYBLUE'     => 'DeepSkyBlue',
        'USER_COLOR_DIMGRAY'     => 'DimGray',
        'USER_COLOR_DODGERBLUE'     => 'DodgerBlue',
        'USER_COLOR_FELDSPAR'     => 'Feldspar',
        'USER_COLOR_FIREBRICK'     => 'FireBrick',
        'USER_COLOR_FLORALWHITE'     => 'FloralWhite',
        'USER_COLOR_FORESTGREEN'     => 'ForestGreen',
        'USER_COLOR_MAGENTA'     => 'Magenta',
        'USER_COLOR_GAINSBORO'     => 'Gainsboro',
        'USER_COLOR_GHOSTWHITE'     => 'GhostWhite',
        'USER_COLOR_GOLD'     => 'Gold',
        'USER_COLOR_GOLDENROD'     => 'GoldenRod',
        'USER_COLOR_GRAY'     => 'Gray',
        'USER_COLOR_GREEN'     => 'Green',
        'USER_COLOR_GREENYELLOW'     => 'GreenYellow',
        'USER_COLOR_HONEYDEW'     => 'HoneyDew',
        'USER_COLOR_HOTPINK'     => 'HotPink',
        'USER_COLOR_INDIANRED'     => 'IndianRed',
        'USER_COLOR_INDIGO'     => 'Indigo',
        'USER_COLOR_IVORY'     => 'Ivory',
        'USER_COLOR_KHAKI'     => 'Khaki',
        'USER_COLOR_LAVENDER'     => 'Lavender',
        'USER_COLOR_LAVENDERBLUSH'     => 'LavenderBlush',
        'USER_COLOR_LAWNGREEN'     => 'LawnGreen',
        'USER_COLOR_LEMONCHIFFON'     => 'LemonChiffon',
        'USER_COLOR_LIGHTBLUE'     => 'LightBlue',
        'USER_COLOR_LIGHTCORAL'     => 'LightCoral',
        'USER_COLOR_LIGHTCYAN'     => 'LightCyan',
        'USER_COLOR_LIGHTGOLDENRODYELLOW'     => 'LightGoldenRodYellow',
        'USER_COLOR_LIGHTGREY'     => 'LightGrey',
        'USER_COLOR_LIGHTGREEN'     => 'LightGreen',
        'USER_COLOR_LIGHTPINK'     => 'LightPink',
        'USER_COLOR_LIGHTSALMON'     => 'LightSalmon',
        'USER_COLOR_LIGHTSEAGREEN'     => 'LightSeaGreen',
        'USER_COLOR_LIGHTSKYBLUE'     => 'LightSkyBlue',
        'USER_COLOR_LIGHTSLATEBLUE'     => 'LightSlateBlue',
        'USER_COLOR_LIGHTSLATEGRAY'     => 'LightSlateGray',
        'USER_COLOR_LIGHTSTEELBLUE'     => 'LightSteelBlue',
        'USER_COLOR_LIGHTYELLOW'     => 'LightYellow',
        'USER_COLOR_LIME'     => 'Lime',
        'USER_COLOR_LIMEGREEN'     => 'LimeGreen',
        'USER_COLOR_LINEN'     => 'Linen',
        'USER_COLOR_MAROON'     => 'Maroon',
        'USER_COLOR_MEDIUMAQUAMARINE'     => 'MediumAquaMarine',
        'USER_COLOR_MEDIUMBLUE'     => 'MediumBlue',
        'USER_COLOR_MEDIUMORCHID'     => 'MediumOrchid',
        'USER_COLOR_MEDIUMPURPLE'     => 'MediumPurple',
        'USER_COLOR_MEDIUMSEAGREEN'     => 'MediumSeaGreen',
        'USER_COLOR_MEDIUMSLATEBLUE'     => 'MediumSlateBlue',
        'USER_COLOR_MEDIUMSPRINGGREEN'     => 'MediumSpringGreen',
        'USER_COLOR_MEDIUMTURQUOISE'     => 'MediumTurquoise',
        'USER_COLOR_MEDIUMVIOLETRED'     => 'MediumVioletRed',
        'USER_COLOR_MIDNIGHTBLUE'     => 'MidnightBlue',
        'USER_COLOR_MINTCREAM'     => 'MintCream',
        'USER_COLOR_MISTYROSE'     => 'MistyRose',
        'USER_COLOR_MOCCASIN'     => 'Moccasin',
        'USER_COLOR_NAVAJOWHITE'     => 'NavajoWhite',
        'USER_COLOR_NAVY'     => 'Navy',
        'USER_COLOR_OLDLACE'     => 'OldLace',
        'USER_COLOR_OLIVE'     => 'Olive',
        'USER_COLOR_OLIVEDRAB'     => 'OliveDrab',
        'USER_COLOR_ORANGE'     => 'Orange',
        'USER_COLOR_ORANGERED'     => 'OrangeRed',
        'USER_COLOR_ORCHID'     => 'Orchid',
        'USER_COLOR_PALEGOLDENROD'     => 'PaleGoldenRod',
        'USER_COLOR_PALEGREEN'     => 'PaleGreen',
        'USER_COLOR_PALETURQUOISE'     => 'PaleTurquoise',
        'USER_COLOR_PALEVIOLETRED'     => 'PaleVioletRed',
        'USER_COLOR_PAPAYAWHIP'     => 'PapayaWhip',
        'USER_COLOR_PEACHPUFF'     => 'PeachPuff',
        'USER_COLOR_PERU'     => 'Peru',
        'USER_COLOR_PINK'     => 'Pink',
        'USER_COLOR_PLUM'     => 'Plum',
        'USER_COLOR_POWDERBLUE'     => 'PowderBlue',
        'USER_COLOR_PURPLE'     => 'Purple',
        'USER_COLOR_RED'     => 'Red',
        'USER_COLOR_ROSYBROWN'     => 'RosyBrown',
        'USER_COLOR_ROYALBLUE'     => 'RoyalBlue',
        'USER_COLOR_SADDLEBROWN'     => 'SaddleBrown',
        'USER_COLOR_SALMON'     => 'Salmon',
        'USER_COLOR_SANDYBROWN'     => 'SandyBrown',
        'USER_COLOR_SEAGREEN'     => 'SeaGreen',
        'USER_COLOR_SEASHELL'     => 'SeaShell',
        'USER_COLOR_SIENNA'     => 'Sienna',
        'USER_COLOR_SILVER'     => 'Silver',
        'USER_COLOR_SKYBLUE'     => 'SkyBlue',
        'USER_COLOR_SLATEBLUE'     => 'SlateBlue',
        'USER_COLOR_SLATEGRAY'     => 'SlateGray',
        'USER_COLOR_SNOW'     => 'Snow',
        'USER_COLOR_SPRINGGREEN'     => 'SpringGreen',
        'USER_COLOR_STEELBLUE'     => 'SteelBlue',
        'USER_COLOR_TAN'     => 'Tan',
        'USER_COLOR_TEAL'     => 'Teal',
        'USER_COLOR_THISTLE'     => 'Thistle',
        'USER_COLOR_TOMATO'     => 'Tomato',
        'USER_COLOR_TURQUOISE'     => 'Turquoise',
        'USER_COLOR_VIOLET'     => 'Violet',
        'USER_COLOR_VIOLETRED'     => 'VioletRed',
        'USER_COLOR_WHEAT'     => 'Wheat',
        'USER_COLOR_WHITE'     => 'White',
        'USER_COLOR_WHITESMOKE'     => 'WhiteSmoke',
        'USER_COLOR_YELLOW'     => 'Yellow',
        'USER_COLOR_YELLOWGREEN'     => 'YellowGreen',
    ),
    
    //Installer Section
    'ADDED_PERMISSIONS'    => 'You have successfully added colored name permission options to your database.',
));

?>