<?php exit; ?>
1274570470
SELECT s.style_id, c.theme_id, c.theme_data, c.theme_path, c.theme_name, c.theme_mtime, i.*, t.template_path FROM phpbb_styles s, phpbb_styles_template t, phpbb_styles_theme c, phpbb_styles_imageset i WHERE s.style_id = 4 AND t.template_id = s.template_id AND c.theme_id = s.theme_id AND i.imageset_id = s.imageset_id
96277
a:1:{i:0;a:11:{s:8:"style_id";s:1:"4";s:8:"theme_id";s:1:"5";s:10:"theme_data";s:95880:"/*  phpBB 3.0 Style Sheet
    --------------------------------------------------------------
	Style name:		proSilver
	Based on style:	proSilver (this is the default phpBB 3 style)
	Original author:	subBlue ( http://www.subBlue.com/ )
	Modified by:		
	
	Copyright 2006 phpBB Group ( http://www.phpbb.com/ )
    --------------------------------------------------------------
*/

/* General proSilver Markup Styles
---------------------------------------- */

* {
	/* Reset browsers default margin, padding and font sizes */
	margin: 0;
	padding: 0;
}
body {
	font: 12px/1.5 "Helvetica Neue", Helvetica, Arial, sans-serif;
	margin: 0;
	padding: 0 0 12px 0;
	background-color: #FFFFFF;
}

hr {
	border-style: solid none none;
	border-width: 1px 0 0;
	margin: 0.5em 0;
	clear: both;
}

a {
	text-decoration: none;
}

a:hover {
	text-decoration: underline;
}

a img {
	border: none;
}

.inner {
	clear: both;
}

/* Main blocks
---------------------------------------- */
#page-header {
	border-top: 6px solid;
	height: 84px;
	width: 100%;
	min-width: 980px;
}

#page-header .inner {
	margin: 0 auto;
	padding: 0 20px;
	min-width: 960px;
	max-width: 1275px;
}

#wrap {
	margin: 0 auto;
	padding: 0 20px;
	min-width: 960px;
	max-width: 1275px;
}

#page-body {
	min-width: 787.2px;
	width: 82%;
	float: left;
	text-align: left;
}

#page-sidebar {
	margin-left: 1%;
	min-width: 163.2px;
	width: 17%;
	float: right;
	text-align: left;
}

#profile {
	text-align: left;
	margin: 0 auto;
	width: 960px;
	overflow: hidden;
}

#profile-body {
	margin-left: 10px;
	min-width: 623.6px;
	width: 623.6px;
	float: left;
}

#profile-sidebar {
	min-width: 316.8px;
	width: 316.8px;
	float: left;
}

#board-statistics {
	border: 1px solid;
	margin: 0 0 10px 0;
	padding: 10px;
	clear: both;
}

#sidebar-ads {
	text-align: center;
}

#page-footer {
	min-width: 960px;
	clear: both;
}

#page-footer h3 {
	margin-top: 20px;
}

/* Quickpanel block
--------------------------------------------- */
#quickpanel {
	border-top: 1px solid;
	border-bottom: 1px solid;
	display: none;
	width: 100%;
	padding: 6px 0;
	overflow: hidden;
}

#quickpanel .inner {
	margin: 0 auto;
	min-width: 960px;
	max-width: 1275px;
	text-align: right;
}

#quickpanel h3 {
	text-transform: uppercase;
}

/* User Menu box
--------------------------------------------- */
#usernav-box {
	line-height: 1.5em;
	float: right;
	margin: 2px 0;
	height: inherit;
	max-width: 175px;
	width: auto;
	white-space: nowrap; /* For Opera */
	z-index: 9999;
}

#usernav-box a {
	text-decoration: none;
}

#usernav-box .dropdown {
	float: right;
}

#usernav-box .dropdown li {
	line-height: 2em;
	width: 100%;
}

/* Account actions box
--------------------------------------------- */
#account-actions {
	text-align: right;
	clear: both;
}

#account-actions li {
	line-height: 22px;
	word-spacing: 10px;
	list-style-type: none;
	display: inline;
	float: left;
}

#account-actions li a {
	word-spacing: normal;
}

/* Search box
--------------------------------------------- */
#search-box {
	text-align: left;
	white-space: nowrap; /* For Opera */
	position: relative;
	margin-bottom: 10px;
	padding: 6px 5%;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;
	border-radius: 5px;
}

#search-box fieldset {
	border: none;
}

#search-box li {
	text-align: right;
}

#search-box #keywords {
	width: auto;
}

#search-box .button1 {
	min-width: 35px;
}

/* .button1 style defined later, just a few tweaks for the search button version */
#search-box input.button2 {}

#search-box img {
	vertical-align: middle;
	margin-right: 3px;
}

/* Site description and logo */
#site-description {
	float: left;
	width: 27%;
}

#logo {
	float: left;
	padding: 15px 1%;
}

#site-description h1 {
	margin-right: 0;
}

/* Breadcrumbs box
--------------------------------------------- */
.breadcrumbs {
	height: 26px;
	line-height: 26px;
	margin-bottom: 10px;
	padding: 2px 0;
	min-width: 980px;
	clear: both;
}

.breadcrumbs .inner {
	margin: 0 auto;
	padding: 0 20px;
	min-width: 960px;
	max-width: 1275px;
}


.breadcrumbs strong {
	font-size: 1.1666em;
}

/* Navbar
--------------------------------------------- */
.navbar {
	position: relative;
	float: right;
	height: 84px;
	overflow: hidden;
}

.navbar li {
	float: left;
	list-style-type: none;
	height: 100%;
}

.navbar li a {
	border-left: 1px solid;
	font-size: 1.1666em;
	font-weight: bold;
	line-height: 1.4em;
	text-decoration: none;
	display: block;
	padding: 20px 20px 0 20px;
	height: 84px;
	box-sizing: border-box;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
}

.navbar li a span {
	font-size: 0.6428em;
	line-height: 1.3em;
	text-transform: uppercase;
	display: block;
	width: 100px;
}

/* Profile blocks
---------------------------------------- */
h2.pro-header, h3.pro-header {
	font-size: 1.1666em;
	font-weight: bold;
	text-transform: uppercase;
	margin: 0 -10px 0.3333em -10px; /* Negative margins */
	padding: 0.3333em 10px;
}

#comment {padding: 0;}

#comment .commentbody {
	padding: 0;
}

#comment .commentrow:first-child {border-top: 1px dotted;}
#comment .commentrow {
	border-bottom: 1px dotted;
	width: auto;
	padding: 5px 5px 5px 50px;
	overflow: hidden;
}

#comment .content {
	font-family: Arial, Helvetica, sans-serif;
	line-height: normal;
}

#comment .message {margin: 4px 0;}
#comment .date {
	font-size: 0.9166em;
	margin-left: 0.5em;
}

#comment .commentprofile {
	/* Also see tweaks.css */
	min-height: 40px;
	min-width: 40px;
	width: 40px;
	margin-right: -30px;
	float: left;
	position: relative;
	left: -40px;
}

#pro-friends .friend {
	margin: 0 10px 10px 0;
	float: left;
}

#pro-friends ul.linklist {
	float: right;
}

.pro-box {
	margin-bottom: 10px;
	padding: 0 10px;
	overflow: hidden;
	clear: both;
}

.pro-box .inner {
	padding-bottom: 10px;
	overflow: hidden;
}

.pro-box dl.details {
	/*font-family: "Lucida Grande", Verdana, Helvetica, Arial, sans-serif;*/
	font-size: 1em;
}

.pro-box dl.details dt {
	font-weight: bold;
	float: left;
	clear: left;
	width: 30%;
	text-align: left;
	display: block;
}

.pro-box dl.details dd {
	margin-left: 0;
	margin-bottom: 4px;
	padding-left: 5%;
	float: left;
	width: 65%;
}

/* Message box
 * ---------------------------------------- */
textarea#message {
	font-family: Verdana, "Verdana Ref", Geneva, Helvetica, Arial, sans-serif;
}
#message, #confirm {text-align: center;}
#message .inner, #confirm .inner {padding: 20px 0;}

#message p.message, #confirm p.message {
	font-size: 1.166em;
	margin-bottom: 0.5em;
}

#message p.message a #confirm p.message a {
	font-size: 0.8571em;
	font-weight: bold;
}

#message p.link, #confirm p.link {
	color: #D31141;
	font-size: 1.166em;
}

/* Round cornered boxes and backgrounds
---------------------------------------- */

#footer-utilities {
	padding: 10px 20px;
	clear: both;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;
	border-radius: 5px;
}

#footer-utilities ul.linklist {margin: 0;}

.forabg li.header, .forumbg li.header {
	-moz-border-radius: 5px 5px 0 0;
	-webkit-border-radius: 5px 5px 0 0;
	-khtml-border-radius: 5px 5px 0 0;
	border-radius: 5px 5px 0 0;
}

.forum-image {
	float: left;
	padding-top: 5px;
	margin-right: 5px;
}

.forabg {
	margin-bottom: 10px;
	clear: both;
}

.forabg-sidebar {
	clear: both;
}

.forumbg {
	margin-bottom: 10px;
	clear: both;
}

.panel {
	border: 1px solid;
	margin-bottom: 10px;
	padding: 0 10px;
	overflow: hidden;
}

.panel.smooth {
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;
	border-radius: 5px;
}

.post {
	margin-bottom: 1px;
	padding: 0 10px;
	overflow: hidden;
}

.search.post {
	margin-bottom: 10px;
}

.rowbg {
	margin: 5px 5px 2px 5px;
}

/* Horizontal lists
----------------------------------------*/
ul.linklist {
	display: block;
	margin: 0;
	margin: 10px 0;
	height: auto;
}

ul.linklist li {
	display: block;
	list-style-type: none;
	float: left;
	width: auto;
	margin-right: 5px;
}

ul.linklist li a {
	text-decoration: none;
}

ul.linklist li.rightside, p.rightside {
	float: right;
	margin-right: 0;
	margin-left: 5px;
	text-align: right;
}

ul.linklist li.button {
	height: 24px;
}

ul.navlinks {
	padding-bottom: 1px;
	margin-bottom: 1px;
	font-weight: bold;
}

ul.navlinks li {
	float: left;
	list-style-type: none;
}

ul.leftside {
	float: left;
	margin-left: 0;
	margin-right: 5px;
	text-align: left;
}

ul.rightside {
	float: right;
	margin-left: 5px;
	margin-right: -5px;
	text-align: right;
}

/* Table styles
----------------------------------------*/
#ucp-main table.table1 {
	padding: 2px;
}

table.table1 thead th {
	font-size: 0.9166em;
	font-weight: bold;
	line-height: 1.3em;
	padding: 6px 10px;
}

table.table1 thead th span {
	padding-left: 7px;
}

table.table1 tbody td {
	padding: 0.5em;
}

table.table1 tbody th {
	padding: 0.5em;
	text-align: left;
}

/* Specific column styles */
table.table1 .name		{ text-align: left; }
table.table1 .posts		{ text-align: center !important; width: 7%; }
table.table1 .joined	{ text-align: left; width: 15%; }
table.table1 .active	{ text-align: left; width: 15%; }
table.table1 .mark		{ text-align: center; width: 7%; }
table.table1 .info		{ text-align: left; width: 30%; }
table.table1 .info div	{ width: 100%; white-space: normal; overflow: hidden; }
table.table1 .autocol	{ white-space: nowrap; }
table.table1 thead .autocol { padding-left: 1em; }

table.table1 span.rank-img {
	float: right;
	width: auto;
}

table.info td {
	padding: 3px;
}

table.info tbody th {
	padding: 3px;
	text-align: right;
	vertical-align: top;
}

/* Misc layout styles
---------------------------------------- */
/* column[1-2] styles are containers for two column layouts 
   Also see tweaks.css */
.column1 {
	float: left;
	clear: left;
	width: 49%;
}

.column2 {
	float: right;
	clear: right;
	width: 49%;
}

/* General classes for placing floating blocks */
.left-box {
	float: left;
	width: auto;
	text-align: left;
}

.right-box {
	float: right;
	width: auto;
	text-align: right;
}

dl.details {
	/*font-family: "Lucida Grande", Verdana, Helvetica, Arial, sans-serif;*/
	font-size: 1.1em;
}

dl.details dt {
	font-weight: bold;
	float: left;
	clear: left;
	width: 30%;
	text-align: left;
	display: block;
}

dl.details dd {
	margin-left: 0;
	padding-left: 2%;
	margin-bottom: 4px;
	float: left;
	width: 68%;
}

/* Pagination
---------------------------------------- */
.pagination {
	height: 1%; /* IE tweak (holly hack) */
	width: auto;
	text-align: right;
	float: right;
}

li.pagination {
	margin: 2px 0;
	padding: 1px 0;
}

.pagination strong, .pagination b {
	font-weight: bold;
}

.pagination span strong {
	border: 1px solid;
	margin: 0 2px;
	padding: 2px 6px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;
	border-radius: 5px;
}

.pagination span a, .pagination span a:link, .pagination span a:visited, .pagination span a:active {
	border: 1px solid;
	text-decoration: none;
	margin: 0 2px;
	padding: 2px 6px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;
	border-radius: 5px;
}

.pagination span a:hover {
	border: 1px solid;	
	margin: 0 2px;
	-moz-box-shadow: 0 0 3px #606060;
	-webkit-box-shadow: 0 0 3px #606060;
	-khtml-box-shadow: 0 0 3px #606060;
	box-shadow: 0 0 3px #606060;
}

/* Pagination in viewforum for multipage topics */
.row .pagination {
	display: block;
	float: right;
	width: auto;
	margin-top: 0;
	padding: 7px 2% 7px 1em;
}

.row .pagination span a:hover {
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	-khtml-box-shadow: none;
	box-shadow: none;
}

/* Miscellaneous styles
---------------------------------------- */
#forum-permissions {
	float: right;
	width: auto;
	padding-left: 5px;
	margin-left: 5px;
	margin-top: 10px;
	text-align: right;
}

.copyright {
	padding: 5px;
	text-align: center;
}

.titlespace {margin-bottom: 15px;}
.headerspace {margin: 10px 0;}

div.rules {
	padding: 0 10px;
	margin: 10px 0;
}

div.rules ul, div.rules ol {margin-left: 20px;}
p.rules {padding: 5px;}
p.rules img {vertical-align: middle; padding-top: 5px;}

p.rules a {
	vertical-align: middle;
	clear: both;
}

.error {
	border: 1px solid;
	display: inline-block;
	padding: 0.5em 6px;
	width: auto;
	clear: both;
}

p {margin: 10px 0;}
.center {text-align: center;}

em {font-family: "Lucida Sans", Verdana, Geneva, Arial, Helvetica, sans-serif; }

.clear {
	display: block;
	clear: both;
	font-size: 1px;
	line-height: 1px;
	background: transparent;
}

.hide {display: none;}
.show {display: block;}
/* proSilver Content Styles
---------------------------------------- */
ul.topiclist {
	display: block;
	margin: 0;
}

ul.topiclist li {
	display: block;
	list-style-type: none;
	margin: 0;
}

ul.topiclist dl.icon dt {
	position: relative;
	min-height: 30px;
}

ul.topiclist li.row {
	border-bottom: 1px solid;
}

ul.topiclist .col1, ul.topiclist .col2 {
	overflow: hidden;
}

ul.topiclist dt, ul.topiclist dd {
	display: block;
	padding: 6px 0;
	vertical-align: middle;
}

ul.topiclist dt {
	float: left;
	width: 49%;
}

ul.topiclist dd {
	border-left: 1px solid;
	float: left;
	height: 100%;
}

ul.topiclist dd div.inner {
	margin: 0 10px;
}

ul.topiclist li.row dt a.subforum {
	position: relative;
	white-space: nowrap;
	padding: 0 0 0 12px;
}

li.header dt, li.header dd {
	padding: 8px 0;
}

li.header dl.icon {
	font-weight: bold;
}

li.header dl.icon dt {
	text-decoration: none;
	text-transform: capitalize;
	font: 1.45em Helvetica, Arial, sans-serif;
}

.search.bg1, .search.bg2 {
	border-bottom: 4px solid;
}

/* Sidebar blocks */
.forabg-sidebar {
	margin-bottom: 10px;
	padding: 1px;
}

.forabg-sidebar.panel.smooth ul.topiclist {
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	-khtml-border-radius: 4px;
	border-radius: 4px;
}

.forabg-sidebar h2.sidebar {
	width: auto;
}

.forabg-sidebar ul.topiclist dd {
	margin-bottom: 0;
	padding: 6px 10px;
}

.forabg-sidebar h2.sidebar {
	font-size: 1.1em;
	font-weight: bold;
	margin: 0 0 0 10px;
	padding: 6px 0;
}

.forabg-sidebar h2.sidebar img {vertical-align: text-bottom;}

.back2top {
	margin: 0 0 2px -10px;
	clear: both;
}

.back2top a {
	text-decoration: none;
	padding: 6px 10px;
	-moz-border-radius: 5px 5px 0 0;
	-webkit-border-radius: 5px 5px 0 0
	-khtml-border-radius: 5px 5px 0 0;
	border-radius: 5px 5px 0 0;
}

.jump2post {
	margin-top: 2px;
	clear: both;
}

.jump2post a {
	text-decoration: none;
	padding: 6px 10px;
	-moz-border-radius: 0 0 5px 5px;
	-webkit-border-radius: 0 0 5px 5px;
	-khtml-border-radius: 0 0 5px 5px;
	border-radius: 0 0 5px 5px;
}

a.topictitle {
	font-weight: bold;
}

a.topictitle span {
	text-transform: capitalize;
}

h2.pagetitle, h1.topictitle, h2.cattitle, ul.topiclist dl.forum dt {
	font-family: "Myriad Pro", Arial, Helvetica, sans-serif;
	font-size: 1.45em;
	font-weight: normal;
	padding: 7px 10px;
	overflow: hidden;
	-moz-border-radius: 5px 5px 0 0;
	-webkit-border-radius: 5px 5px 0 0;
	-khtml-border-radius: 5px 5px 0 0;
	border-radius: 5px 5px 0 0;
}

h3.solo {
	font-size: 1.45em;
	font-weight: normal;
	text-transform: capitalize;
	padding: 8px 10px;
	overflow: hidden;
	-moz-border-radius: 5px 5px 0 0;
	-webkit-border-radius: 5px 5px 0 0;
	-khtml-border-radius: 5px 5px 0 0;
	border-radius: 5px 5px 0 0;
}

.panel h2.polltitle {
	font-size: 1.1666em;
	text-transform: uppercase;
	margin: 0 -10px 0.5em -10px; /* Negative margins */
	padding: 0.5em 10px;
}

h2.pagetitle a, h1.topictitle a, h2.cattitle a, .forabg li.header span, .forumbg li.header span, h2.pagetitle span, h2.cattitle span {
	border: 1px solid;
	padding: 0 0.4em;
	text-decoration: none;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;
	border-radius: 5px;
}

.pagetitle span a {
	border: 0;
	padding: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	-khtml-border-radius: 0;
	border-radius: 0;
}

h1.topictitle a.topicactions {
	font-size: 0.6322em;
	font-weight: bold;
	line-height: 1.7em;
	margin-top: 6px;
	float: right;
}

/* Forum list column styles */
ul.topiclist li.header dl.icon dt {
	margin-left: 10px;
}

dl.icon {
	min-height: 40px;
}

dl.icon dt, .meta dt {
	padding-left: 45px;	/* Space for folder icon */
}

.meta dt.no-icon {
	padding: 4px 0;	/* Space for folder icon */
}

/* List in forum description */
dl.icon dt ol,
dl.icon dt ul {
	list-style-position: inside;
	margin-left: 1em;
}

dl.icon dt li {
	display: list-item;
	list-style-type: inherit;
}

dl.meta {
	border-bottom: none;
	font-size: 0.9166em;
	font-weight: bold;
}

dl.meta dt , dl.meta dd {
	padding: 4px 0;
	line-height: 1.3em;
}

dl.meta dt {
	padding-left: 45px;
}

dt.forum {
	padding: 4px 0;
}

dd.stats {
	width: 15%;
	padding-right: 0.5% !important;
	text-align: right;
}

ul.topiclist dd.stats span.topics, ul.topiclist dd.stats span.posts {
	display: block;	
}

ul.topiclist dd.stats dfn {
	font-style: normal;
}

dd.posts, dd.views {
	line-height: 2.7em;
	text-align: center;
	width: 10%;
}

dd.lastpost {
	width: 29%;
	padding-left: 0.5% !important;
}

dd.lastpost .date {
	font-size: 0.9167em;
	padding-left: 0;
}

dd.lastpost span, ul.topiclist dd.searchby span, ul.topiclist dd.info span, ul.topiclist dd.time span, dd.redirect span, dd.moderation span {
	display: block;
}


dt.no-icon .inner {
	margin: 0;
	padding: 0 10px;
}

.meta dd.time {line-height: 1.3em;}
.meta dd.views {line-height: 1.3em;}
.meta dd.posts {line-height: 1.3em;}

dd.time {
	width: 20%;
	line-height: 200%;
}

dd.moderation, dd.posted {
	width: 30%;
}

dd.extra {
	width: 12%;
	text-align: center;
}

dd.mark {
	float: right !important;
	width: 10%;
	text-align: center;
}

dd.info {
	width: 30%;
}

dd.option {
	width: 15%;
	text-align: center;
}

dd.searchby {
	width: 47%;
}

ul.topiclist dd.searchextra {
	margin-left: 5px;
	padding: 0.2em 0;
	clear: both;
	width: 98%;
	overflow: hidden;
}

/* Container for post/reply buttons and pagination */
.topic-actions {
	margin: 10px 0;
	height: 24px;
	min-height: 24px;
}
div[class].topic-actions {
	height: auto;
}

/* Deep design */
a.forumtitle {
	font-size: 1.0909em;
	font-weight: bold;
	text-decoration: none;
}

a.forumtitle:hover {
	color: #FF0000;
	text-decoration: underline;
}

/* Post body styles
----------------------------------------*/
.postbody {
	margin: 10px 0;
	padding: 0;
	width: 79%;
	float: right;
	clear: both;
}

.postbody h3 {
	/* Postbody requires a different h3 format - so change it here */
	padding: 2px 0 0 0;
	margin: 0 0 0.3em 0 !important;
	font-family: Helvetica, Arial, Verdana, sans-serif;
}

.postbody h3 img {
	/* Also see tweaks.css */
	vertical-align: bottom;
}

.search .postbody {
	float: right;
	width: 86%;
}

/* Posting preview
----------------------------------------*/
#preview {
	margin: 1em 0;
}

/* Topic review panel
----------------------------------------*/
#review {
	margin-top: 2em;
}

#topicreview {
	overflow: auto;
	height: 300px;
}

#topicreview .postbody {
	width: auto;
	float: none;
	margin: 0;
	height: auto;
}

#topicreview .post {
	border: 1px solid;
	height: auto;
}

#topicreview .post .content {
	margin: 10px 0;
}

#topicreview h2 {
	border-bottom-width: 0;
}

.post-ignore .postbody {
	display: none;
}

/* Content container styles
----------------------------------------*/
.panel.login {
	float: left;
	margin: 10px 0;
	width: 63%;
}

.panel h3 {
	text-transform: uppercase;
	margin: 0.5em 0;
}

.panel p {
	margin-bottom: 1em;
}

.panel.info img {
	float: left;
	margin: 6px 0;
}

.panel.info p {
	margin: 10px 0;
	padding-left: 34px;
}

.panel.smooth {
	border-width: 0 0 1px;
	border-style: solid;
}

.panel.info.seo p {
	margin: 6px 0;
	padding-left: 42px;
}

/* panel sidebar */
.panel-sidebar {
	float: right;
	margin: 10px 0 10px 1%;
	padding: 1px;
	width: 33%;
}

.panel-sidebar .inner {
	padding: 4px 10px;
	height: 100%;
}

.panel-sidebar h3 {
	font-weight: bold;
	padding: 4px 10px;
}

.content {
	min-height: 3em;
	overflow: hidden;
	line-height: 1.7em;
	font-family: Verdana, "Verdana Ref", Geneva, Helvetica, Arial, sans-serif; 
	font-size: 1em;
}

.content h2, .panel h2 {
	margin-top: 0.5em;
	margin-bottom: 0.5em;
	padding-bottom: 0.5em;
}

.content p {
	margin-bottom: 1em;
}

dl.faq {
	margin-top: 1em;
	margin-bottom: 2em;
}

.content dl.faq {
	margin-bottom: 0.5em;
}

.content li {
	list-style-type: inherit;
}

.content ul, .content ol {
	margin-bottom: 0;
	margin-left: 3em;
}

.posthilit {
	padding: 0 2px 1px 2px;
}

/* Post author */
p.author {
	margin: 0 15em 0.6em 0;
	padding: 0 0 5px 0;
}

/* Post signature */
.signature {
	border-top: 1px solid;
	margin-top: 10px;
	padding-top: 10px;
	clear: left;
	line-height: 140%;
	overflow: hidden;
	width: 100%;
}

dd .signature {
	margin: 0;
	padding: 0;
	clear: none;
	border: none;
}

.signature li {
	list-style-type: inherit;
}

.signature ul, .signature ol {
	margin-bottom: 1em;
	margin-left: 3em;
}

/* Post noticies */
.notice {
	width: auto;
	margin-top: 1.5em;
	padding-top: 0.2em;
	clear: left;
	line-height: 130%;
}

/* Jump to post link for now */
ul.searchresults {
	list-style: none;
	text-align: left;
	clear: both;
}

/* BB Code styles
----------------------------------------*/
/* Quote block */
blockquote {
	border: 1px solid;
	margin: 0 1px 0 0;
	overflow: hidden;
	padding: 10px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;
	border-radius: 5px;
}

blockquote blockquote {
	/* Nested quotes */
	margin: 0.5em 1px 0 15px;	
}

blockquote cite {
	/* Username/source of quoter */
	margin-left: 20px;
	display: block;
}

blockquote.uncited {
	padding-top: 25px;
}

/* Code block */
dl.codebox {
	border: 1px solid;
}

dl.codebox dt {
	border-bottom: 1px solid;
	font-weight: bold;
	display: block;
	padding: 4px;
}

dl.codebox dd {
	padding: 4px;
}

blockquote dl.codebox {
	margin-left: 0;
}

dl.codebox code {
	/* Also see tweaks.css */
	overflow: auto;
	display: block;
	height: auto;
	max-height: 200px;
	white-space: normal;
	padding-top: 5px;
	margin: 2px 0;
}

/* Hide block */
div.adapthide {
        background-color: #F6F6F6;
        padding: 1em;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		-khtml-border-radius: 5px;
		border-radius: 5px;
}

/* Attachments
----------------------------------------*/
.attachbox {
	font-family: Verdana, "Verdana Ref", Geneva, Helvetica, Arial, sans-serif;
	float: left;
	width: auto; 
	margin: 5px 5px 5px 0;
	padding: 6px;
	clear: left;
}

.attachbox dt {
	font-weight: bold;
	float: left;
}

.attachbox dd {
	margin-top: 4px;
	padding-top: 4px;
	clear: left;
}

.attachbox dd dd {
	border: none;
}

.attachbox p {
	font-weight: normal;
	clear: left;
}

.attachbox p.stats
{
	clear: left;
}

.attach-image {
	margin: 3px 0;
	width: 100%;
	max-height: 350px;
	overflow: auto;
}

.attach-image img {
/*	cursor: move; */
	cursor: default;
}

/* Inline image thumbnails */
div.inline-attachment dl.thumbnail, div.inline-attachment dl.file {
	display: block;
	margin-bottom: 6px;
}

dl.file {
	display: block;
}

dl.file dt {
	margin: 0;
	padding: 0;
}

dl.file dd {
	display: inline;
	margin-left: 0.5em;
	padding: 0;	
}

dl.thumbnail img {
	padding: 3px;
}

/* Post poll styles
----------------------------------------*/
fieldset.polls {margin-bottom: 1em;}

fieldset.polls dl {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	margin-top: 5px;
	padding: 5px 0 0 0;
}

fieldset.polls dt {
	font-weight: bold;
	text-align: left;
	float: left;
	display: block;
	width: 30%;
	padding: 0;
	margin: 0;
	clear: both;
}

fieldset.polls dd {
	float: left;
	width: 15%;
	padding: 0 5px;
	margin-left: 0;
}

fieldset.polls dd.resultbar {
	width: 30%;
}

fieldset.polls dd input {
	margin: 2px 0;
}

fieldset.polls dd div {
	text-align: right;
	padding: 0 2px;
	overflow: visible;
	min-width: 2%;
}

/* Poster profile block
----------------------------------------*/
.postprofile {
	/* Also see tweaks.css */
	border-right: 1px solid;
	margin: 10px 0 10px 0;
	min-height: 80px;
	width: 19%;
	float: left;
	display: inline;
}

.postprofile dt {
	text-align: center;
}

.postprofile dd, .postprofile dt {
	line-height: 1.7em;
}

.postprofile dd {
	margin-bottom: 0.5em;
}

.postprofile dd strong {
	display: inline-block;
	width: 5em;
	margin-right: 0.5em;
	padding: 0.1em 0.4em;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	-khtml-border-radius: 3px;
	border-radius: 3px;
	text-align: center;
}

.postprofile dd.reputation {
	margin-right: 1em;
	padding: 0.1em 0.4em;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	-khtml-border-radius: 3px;
	border-radius: 3px;
	text-align: center;
}

.postprofile dd.reputation strong {
	display: inline;
	width: 0;
	padding: 0;
	margin: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	-khtml-border-radius: 0;
	border-radius: 0;
}

.avatar {
	margin-bottom: 3px;
}

/* Poster profile used by search*/
.search .postprofile {
	float: left;
	padding-right: 10px;
	width: 11%;
}

/* PM Styles
----------------------------------------*/
.pm {border: 1px solid;}

/* pm list in compose message if mass pm is enabled */
dl.pmlist dt {
	width: 60% !important;
}

dl.pmlist dt textarea {
	width: 95%;
}

dl.pmlist dd {
	margin-left: 61% !important;
	margin-bottom: 2px;
}

/* Poster meta block
----------------------------------------*/
.postmeta {
	font-weight: bold;
	line-height: 24px;
	margin: 0 -10px;
	padding: 4px 10px;
	height: 24px;
}

.postmeta a {
	text-decoration: none;	
}

.postmeta .dropdown {
	float: left;
}

.posmeta .username {
	float: left;
}

.postmeta .date {
	font-size: 0.9166em;
	float: right;
}

/* Factions page
----------------------------------------*/
#faction {
	margin: 20px auto;
	width: 960px;
	overflow: hidden;
}

#faction .details {
	border-right: 1px solid;
	float: left;
	width: 319px;
}

#faction .details dl dt {
	float: left;
	font-weight: bold;
	margin-bottom: 0.5em;
	width: 35%;
	clear: left;
}

#faction .details dl dd {
	float: left; 
	width: 65%;
}

#faction h2.name {
	float: left;
	margin: 0.5em 0;
}

#faction .buttons {
	margin: 0.5em 0;
	clear: both;
}

#faction .buttons li {
	list-style-type: none;
	display: inline;
	margin-right: 0.5em;
}

#faction .desc_disp {
	margin: 0 0 1em 0;
	padding: 0;
	width: 630px;
	float: right;
}

#faction .desc_disp .inner {
	padding: 0 1em 0.5em 1em;
}
/* proSilver Button Styles
---------------------------------------- */
.button1, .button2 {
	text-decoration: none;
}

/* Rollover buttons
   Based on: http://wellstyled.com/css-nopreload-rollovers.html
----------------------------------------*/
.buttons {
	float: left;
	width: auto;
	height: auto;
}

/* Rollover state */
.buttons div {
	float: left;
	margin: 0 5px 0 0;
	background-position: 0 100%;
}

/* Rolloff state */
.buttons div a {
	display: block;
	width: 100%;
	height: 100%;
	background-position: 0 0;
	position: relative;
	overflow: hidden;
}

/* Hide <a> text and hide off-state image when rolling over (prevents flicker in IE) */
/*.buttons div span		{ display: none; }*/
/*.buttons div a:hover	{ background-image: none; }*/
.buttons div span { 
	position: absolute; 
	width: 100%; 
	height: 100%; 
	cursor: pointer;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;
	border-radius: 5px;
}
.buttons div a:hover span	{ background-position: 0 100%; }

/* Big button images */
.reply-icon span	{ background: transparent none 0 0 no-repeat; }
.post-icon span		{ background: transparent none 0 0 no-repeat; }
.locked-icon span	{ background: transparent none 0 0 no-repeat; }
.pmreply-icon span	{ background: none 0 0 no-repeat; }
.newpm-icon span 	{ background: none 0 0 no-repeat; }
.forwardpm-icon span 	{ background: none 0 0 no-repeat; }

/* Set big button dimensions */
.buttons div.reply-icon		{ width: {IMG_BUTTON_TOPIC_REPLY_WIDTH}px; height: {IMG_BUTTON_TOPIC_REPLY_HEIGHT}px; }
.buttons div.post-icon		{ width: {IMG_BUTTON_TOPIC_NEW_WIDTH}px; height: {IMG_BUTTON_TOPIC_NEW_HEIGHT}px; }
.buttons div.locked-icon	{ width: {IMG_BUTTON_TOPIC_LOCKED_WIDTH}px; height: {IMG_BUTTON_TOPIC_LOCKED_HEIGHT}px; }
.buttons div.pmreply-icon	{ width: {IMG_BUTTON_PM_REPLY_WIDTH}px; height: {IMG_BUTTON_PM_REPLY_HEIGHT}px; }
.buttons div.newpm-icon		{ width: {IMG_BUTTON_PM_NEW_WIDTH}px; height: {IMG_BUTTON_PM_NEW_HEIGHT}px; }
.buttons div.forwardpm-icon	{ width: {IMG_BUTTON_PM_FORWARD_WIDTH}px; height: {IMG_BUTTON_PM_FORWARD_HEIGHT}px; }

/* Sub-header (navigation bar)
--------------------------------------------- */
a.print, a.sendemail, a.fontsize {
	display: block;
	height: 18px;
	text-align: left;
}

/* BBCode Buttons
--------------------------------------------- */
#format-buttons input, #mChatBBCodes input {
	background-position-y: -1px;
	padding: 1px 4px;
	font-size: 1.0833em;
	-moz-border-radius: 0px;
	-webkit-border-radius: 0px;
	-khtml-border-radius: 0px;
	border-radius: 0px;
}

/* Poster profile icons
----------------------------------------*/
ul.profile-icons {
	margin: 0 -10px;
	padding: 4px 10px;
	list-style: none;
	clear: both;
	overflow: hidden;
}

/* Rollover state */
ul.profile-icons li {
	font-size: 0.9166em;
	float: right;
}

/* Rolloff state */
ul.profile-icons li a {
	line-height: 20px;
	text-decoration: none;
	margin-left: 8px;
	padding: 0 8px;
	display: block;
	height: 20px;
}

/* Positioning of moderator icons */
.postbody ul.profile-icons {
	float: right;
	width: auto;
	padding: 0;
}

.postbody ul.profile-icons li {
	margin: 0 3px;
}

/* Fix profile icon default margins */
ul.profile-icons li.edit-icon	{}
ul.profile-icons li.quote-icon	{}
ul.profile-icons li.info-icon, ul.profile-icons li.report-icon	{}
/* proSilver Control Panel Styles
---------------------------------------- */


/* Main CP box
----------------------------------------*/
#cp-menu {
	float:left;
	width: 18.5%;
	margin: 0 1% 5px 0;
	padding-bottom: 1em;
}

#cp-main {
	float: left;
	width: 80%;
	padding-bottom: 1em;
}

#cp-main .content {
	padding: 0;
}

#cp-main .meta dt {
	padding: 4px 0;
}

#cp-main .panel ol {
	margin-left: 2em;
}

ul.cplist {
	margin-bottom: 1em;
}

#cp-main .panel {
	padding: 1em 1em;
	margin-bottom: 1em;
}

#cp-main table.table1 {
	margin-bottom: 1em;
}

#cp-main table.table1 thead th {
	font-weight: bold;
	padding: 5px;
}

#cp-main .pagination {
	float: right;
	width: auto;
	padding-top: 1px;
}

#cp-main .postbody p {
	font-size: 1.1em;
}

#cp-main .pm-message {
	margin: 10px 0;
	width: auto;
	float: none;
}

.pm-message h2 {
	padding-bottom: 5px;
}

#cp-main .postbody h3, #cp-main .box2 h3 {
	margin-top: 0;
}

#cp-main hr, #cp-menu hr {
	border: 1px solid;
}

#cp-main .buttons {
	margin-left: 0;
	padding: 6px 0;
}

#cp-main ul.linklist {
}

/* MCP Specific tweaks */
.mcp-main .postbody {
	width: 100%;
}

/* CP tabbed menu
----------------------------------------*/
#tabs {
	margin: 20px 0 -1px 0;
	min-width: 570px;
}

#tabs ul {
	margin:0;
	padding: 0;
	list-style: none;
}

#tabs li {
	display: inline;
	margin: 0;
	padding: 0;
}

#tabs a {
	border-style: solid;
	border-width: 1px 1px 0 1px;
	float: left;
	margin: 0 1px 0 0;
	padding: 0 0 0 5px;
	text-decoration: none;
	position: relative;
	cursor: pointer;
	/*
		-moz-border-radius: 5px 5px 0 0;
		-webkit-border-radius: 5px 5px 0 0;
		-khtml-border-radius: 5px;
		border-radius: 5px 5px 0 0;
	*/
}

#tabs a span {
	float: left;
	display: block;
	padding: 6px 10px 6px 5px;
	white-space: nowrap;
}

#tabs .activetab a span {
	padding-bottom: 7px;
}

/* Mini tabbed menu used in MCP
----------------------------------------*/
#minitabs {
	line-height: normal;
	margin: -20px 7px 0 0;
}

#minitabs ul {
	margin:0;
	padding: 0;
	list-style: none;
}

#minitabs li {
	display: block;
	float: right;
	padding: 0 10px 4px 10px;
	margin-left: 2px;
}

/* UCP navigation menu
----------------------------------------*/
/* Container for sub-navigation list */
#navigation {
	border-right: 2px solid;
	margin-top: 41px;
	padding: 0 3px 0 0;
	width: 100%;
}

#navigation ul {
	list-style: none;
}

/* Default list state */
#navigation li {
	margin: 1px 0;
	padding: 0;
	display: inline;
}

/* Link styles for the sub-section links */
#navigation a {
	border-style: solid;
	border-width: 1px;
	font-weight: bold;
	display: block;
	padding: 5px;
	margin: 4px 0;
}


#navigation #active-subsection a {
	display: block;
	margin-right: -3px;
	padding-right: 3px;
}

/* Preferences pane layout
----------------------------------------*/
#cp-main h2 {
	text-transform: uppercase;
	margin-left: 10px;
	padding: 0;
}

/* Friends list */
.cp-mini {
	padding: 0 5px;
	margin: 1em 0;
}

.cp-mini span.corners-top, .cp-mini span.corners-bottom {
	margin: 0 -5px;
}

dl.mini dt {
	font-size: 1.1666em;
	font-weight: bold;
	text-transform: uppercase;
}

dl.mini dd {
	border-bottom: 1px solid;
	padding: 2px 0;
}

/* PM Styles
----------------------------------------*/
#pm-menu {
	line-height: 2.5em;
}

/* PM panel adjustments */
.pm-panel-header {
	margin: 0; 
	padding-bottom: 10px; 
}

.reply-all {
	display: block; 
	padding-top: 4px; 
	clear: both;
	float: left;
}

.pm-panel-message {
	padding-top: 10px;
}

.pm-return-to {
	padding-top: 23px;
}

#cp-main .pm-message-nav {
	margin: 0; 
	padding: 2px 10px 5px 10px; 
}


/* Defined rules list for PM options */
ol.def-rules {
	padding-left: 0;
}

ol.def-rules li {
	padding: 1px;
}

.pm-legend {
	margin-bottom: 3px;
	padding-left: 3px;
}

/* Avatar gallery */
#gallery label {
	position: relative;
	float: left;
	margin: 10px;
	padding: 5px;
	width: auto;
	text-align: center;
}
/* proSilver Form Styles
---------------------------------------- */

/* General form styles
----------------------------------------*/
fieldset {
	border: none;
}

input {
	border: 1px solid;
	vertical-align: middle;
	padding: 2px 5px;
}

input[type=radio], input[type=checkbox] {
	border: none;
}

select {
	vertical-align: middle;
	padding: 1px;
}

option {
	padding-right: 1em;
}

textarea {
	border: 1px solid;
	text-align: left;
	width: 60%;
	padding: 2px;
}

label {
	cursor: default;
	padding-right: 6px;
	line-height: 2em;
}

label input {
	border: 1px solid;
	vertical-align: middle;
}

label img {
	vertical-align: middle;
}

/* Definition list layout for forms
---------------------------------------- */
fieldset dl {
	padding: 6px 0;
}

fieldset dt {
	float: left;	
	width: 15em;
	text-align: right;
	display: block;
}

fieldset dd {
	margin-left: 16em;
	vertical-align: top;
	margin-bottom: 3px;
}

fieldset dd span {
	font-size: 0.9166em;
}

/* Specific layout 1 */
fieldset.fields1 dt {
	width: 12em;
}

fieldset.fields1 dd {
	margin-left: 12em;
}

fieldset.fields1 div {
	margin-bottom: 3px;
}

/* Specific layout 2 */
fieldset.fields2 dt {
	width: 15em;
}

fieldset.fields2 dd {
	margin-left: 16em;
}

/* Form elements */
dt label {
	font-weight: bold;
	text-align: left;
}

dd label {
	white-space: nowrap;
}

dd input, dd textarea {
	margin-right: 3px;
}

dd select {
	width: auto;
}

dd textarea {
	width: 85%;
}

#timezone {
	width: 95%;
}

* html #timezone {
	width: 50%;
}

/* Quick-login on index page */
fieldset.quick-login {
	text-align: right;
	float: right;
	width: auto;
}

fieldset.quick-login input {
	width: auto;
}

fieldset.quick-login input.inputbox {
	width: 120px;
	vertical-align: middle;
	margin-right: 5px;
}

fieldset.quick-login label {
	white-space: nowrap;
	padding-right: 2px;
}

fieldset.quick-login .autologin {
	text-align: left;
	padding-top: 10px;
	clear: both;
}

/* Display options on viewtopic/viewforum pages  */
fieldset.display-options {
	text-align: center;
	margin: 10px 0 10px 0;
	padding: 6px 10px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;
	border-radius: 5px;
}

fieldset.display-options label {
	white-space: nowrap;
	padding-right: 2px;
}

fieldset.display-options a {
	border: 1px solid;
	padding: 3px 0.4em;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;
	border-radius: 5px;
}

/* Display actions for ucp and mcp pages */
fieldset.display-actions {
	line-height: 2em;
	text-align: right;
	white-space: nowrap;
	padding-right: 1em;
	margin: 1em 0;
}

fieldset.display-actions label {
	white-space: nowrap;
	padding-right: 2px;
}

fieldset.sort-options {
	line-height: 2em;
}

/* MCP forum selection*/
fieldset.forum-selection {
	margin: 5px 0 3px 0;
	float: right;
}

fieldset.forum-selection2 {
	margin: 13px 0 3px 0;
	float: right;
}

/* Jumpbox */
fieldset.jumpbox {
	text-align: right;
	margin-top: 15px;
	height: 2.5em;
}

fieldset.quickmod {
	width: 50%;
	float: right;
	text-align: right;
	height: 2.5em;
}

/* Submit button fieldset */
fieldset.submit-buttons, .submit-button {
	text-align: center;
	vertical-align: middle;
	margin: 5px 0;
}

fieldset.submit-buttons input {
	vertical-align: middle;
	padding-top: 3px;
	padding-bottom: 3px;
}

/* Posting page styles
----------------------------------------*/

/* Buttons used in the editor */
#format-buttons {
	margin: 10px 0 2px 0;
}

#format-buttons input, #format-buttons select {
	vertical-align: middle;
}

/* Main message box */
#message-box {
	width: 80%;
}

#message-box textarea {
	font-size: 1em;
	text-align: left;
	width: 100%;
}

/* Emoticons panel */
#smiley-box {
	width: 18%;
	float: right;
}

#smiley-box img {
	margin: 3px;
}

/* Input field styles
---------------------------------------- */
.inputbox {
	font-family: Verdana, "Verdana Ref", Geneva, Helvetica, Arial, sans-serif;
	font-size: 1em;
	padding: 3px;
	cursor: text;
}

input.inputbox	{ width: 85%; }
input.medium	{ width: 50%; }
input.narrow	{ width: 25%; }
input.tiny		{ width: 125px; }

textarea.inputbox {
	width: 85%;
}

.autowidth {
	width: auto !important;
}

/* Form button styles
---------------------------------------- */

a.button1, input.button1, input.button3, a.button2, input.button2 {
	border: 1px solid;
	max-height: 24px;
	width: auto !important;
}

input.button1, input.button2 {
	max-height: 30px;
}

input.button3 {
	padding: 0;
	margin: 0;
	height: 12px;
}

/* <a> button in the style of the form buttons */
a.button1, a.button1:link, a.button1:visited, a.button1:active, a.button2, a.button2:link, a.button2:visited, a.button2:active {
	display: inline-block;
	margin: 2px;
	padding: 3px 0.4em !important;
	vertical-align: middle;
	text-decoration: none !important;
}

a.button1:hover, a.button2:hover, input.button1:hover, input.button2:hover {
	-moz-box-shadow: 0 0 3px #606060;
	-webkit-box-shadow: 0 0 3px #606060;
	-khtml-box-shadow: 0 0 3px #606060;
	box-shadow: 0 0 3px #606060;
}

/* Topic and forum Search */
.search-box {
	margin-left: 5px;
	float: left;
}

input.search {
	padding-left: 20px !important;
}

.full { width: 95%; }
.medium { width: 50%;}
.narrow { width: 25%;}
.tiny { width: 10%;}
w/* proSilver Style Sheet Tweaks

These style definitions are mainly IE specific 
tweaks required due to its poor CSS support.
-------------------------------------------------*/

* html table, * html select, * html input { font-size: 100%; }
* html hr { margin: 0; }
* html span.corners-top, * html span.corners-bottom { background-image: url("{T_THEME_PATH}/images/corners_left.gif"); }
* html span.corners-top span, * html span.corners-bottom span { background-image: url("{T_THEME_PATH}/images/corners_right.gif"); }

table.table1 {
	width: 99%;		/* IE < 6 browsers */
	/* Tantek hack */
	voice-family: "\"}\"";
	voice-family: inherit;
	width: 100%;
}
html>body table.table1 { width: 100%; }	/* Reset 100% for opera */

* html ul.topiclist li { position: relative; }
* html .postbody h3 img { vertical-align: middle; }

/* Form styles */
html>body dd label input { vertical-align: text-bottom; }	/* Align checkboxes/radio buttons nicely */

* html input.button1, * html input.button2 {
	padding-bottom: 0;
	margin-bottom: 1px;
}

/* Misc layout styles */
* html .column1, * html .column2 { width: 45%; }

/* Nice method for clearing floated blocks without having to insert any extra markup (like spacer above)
   From http://www.positioniseverything.net/easyclearing.html 
#tabs:after, #minitabs:after, .post:after, .navbar:after, fieldset dl:after, ul.topiclist dl:after, ul.linklist:after, dl.polls:after {
	content: "."; 
	display: block; 
	height: 0; 
	clear: both; 
	visibility: hidden;
}*/

/* Equal height columns */
ul.topiclist dd {
	margin-bottom: -400px;
	padding-bottom: 400px;
}

.clearfix, #tabs, #minitabs, fieldset dl, ul.topiclist dl, dl.polls {
	height: 1%;
	overflow: hidden;
}

/* viewtopic fix */
* html .post {
	height: 25%;
	overflow: hidden;
}

/* navbar fix */
* html .clearfix, ul.linklist {
	height: 4%;
	overflow: hidden;
}

/* Simple fix so forum and topic lists always have a min-height set, even in IE6
	From http://www.dustindiaz.com/min-height-fast-hack */
dl.icon {
	min-height: 35px;
	height: auto !important;
	height: 35px;
}

* html #search-box {
	width: 25%;
}

/* Correctly clear floating for details on profile view */
*:first-child+html dl.details dd {
	margin-left: 30%;
	float: none;
}

* html dl.details dd {
	margin-left: 30%;
	float: none;
}

* html .forumbg table.table1 {
	margin: 0 -2px 0px -1px;
}

/* Remove videos from signaturs */
.signature embed {display: none;}
.signature object {display: none;}

/* Recent table */
table#recent {
	margin-bottom: 10px;
}

/* CSS Dropdown
-------------------------------------------------*/
.dropdown {
	letter-spacing: 0;
	text-align: left;
	position: relative;
	width: 100%;
	max-width: 175px;
	z-index: 80;
}

.dropdown:hover {
	z-index: 89;
	box-shadow: 3px 1px 2px #212121;
	-moz-box-shadow: 3px 1px 2px #212121;
	-webkit-box-shadow: 3px 1px 2px #212121;
}

.dropdown span {
	font-size: 1em;
	line-height: 21px;
	text-transform: none;
	display: block;
	padding: 0 8px;
	height: 21px;
	min-height: 21px;
	max-height: 21px;
	width: 159px;
}

h2 .dropdown span, h2 .dropdown ul li a {font-size: 0.8571em;}

.dropdown span.banned {
	text-decoration: line-through;
}

.dropdown span a {
	float: left;
}

.dropdown span img {
	float: right;
	display: none;
	margin-top: 5px;
	vertical-align: middle;
}

.dropdown:hover span img {
	display: block;
}

.dropdown ul {
	border-style: solid;
	border-width: 0 1px;
	font-size: 1em;
	line-height: 20px;
	display: none;
	position: absolute;
	left: 0;
	top: 23px;
	margin: 0 0 10px 0;
	padding: 0;
	width: 175px;
	z-index: 9999;
}

.dropdown:hover ul {
	display: block;
	box-shadow: 1px 1px 2px #212121;
	-moz-box-shadow: 1px 1px 2px #212121;
	-webkit-box-shadow: 1px 1px 2px #212121;
}

.dropdown ul li {
	display: block;
	margin: 0;
	overflow: hidden;
}

.dropdown ul li a {
	border-bottom: 1px solid;
	font-size: 1em;
	font-weight: normal;
	text-decoration: none;
	text-transform: none;
	display: block;
	padding: 2px 10px;
	width: 100%;
} 

/* Dropdowns used by search */
.search .dropdown:hover span img {
	display: none;
}

/* CSS Tabs
-------------------------------------------------*/
.tabs ul li {
	display: inline;;
}

.tabs ul li a {
	text-decoration: none;
	padding: 4px 10px;
	/*
	-moz-border-radius: 5px 5px 0 0;
	-webkit-border-radius: 5px 5px 0 0;
	-khtml-border-radius: 5px 5px 0 0;
	border-radius: 5px 5px 0 0;
	*/
	cursor: pointer;
}


#comment .commentrow ul.comment-icons {display: none;}
#comment .commentrow:hover ul.comment-icons {
	display: block;
	position: absolute;
	right: 10px;
	top: 10px;	
}

/* Hover Buttons
-------------------------------------------------*/
.hb_container {position: relative;}
.hb_container .hb {display: none;}
.hb_container:hover .hb {
	display: block;
	position: absolute;
	right: 6px;
	top: 6px;	
}

	.hb li, .hb a {display: inline;}
	
	.hb img {
		height: auto !important;
		width: auto !important;
		margin: 0 !important;
		float: none !important;
		position: static !important;
		left: 0 !important;
		overflow: auto !important;
	}
	
	.hb li a {
		margin: 0 !important;
		padding: 3px 6px;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		-khtml-border-radius: 5px;
		border-radius: 5px;
	}
	
	.hb li {
		font-size: 0.9166em;
		margin-left: 0.5em;
		list-style-type: none;
	}
	
	.hb li a:link, .hb li a:visited {
		background: #EEEEEE;
		border: 1px solid #D0D0D0; 
		color: #212121;	
	}
	
	.hb li a:hover, .hb li a:active {
		background: #212121;
		color: #FFFFFF;
	}

/*
	XS Syntax Highlighter CSS
*/
.content .syntax {
	color: #444;
	display: block;
	margin: 5px 1px;
	width: auto;
	border: solid 1px #D0D0D0;
	background-color: #FFF;
	padding: 5px;
	font-size: 0.9em;
	font-family: Courier, 'Courier New', sans-serif;
	line-height: 1.2em;
}
.content .syntax-header {
	margin: 0;
	margin-bottom: 5px;
	padding-left: 3px;
	padding-bottom: 3px;
	border-bottom: solid 1px #E0E0E0;
	font-size: 0.9em;
	line-height: 1.2em;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: normal;
	color: #808080;
}

.syntax-header a:link,
.syntax-header a:visited
{
	color: #666;
	text-decoration: none;
	border-bottom: dotted 1px #666;
}
.syntax-header a:hover,
.syntax-header a:active
{
	color: #FF1010;
	text-decoration: none;
	border-bottom: dotted 1px #FF1010;
}

.syntax-content { padding: 0; }

.syntax-list {
	margin-top: 3px;
	margin-right: 0;
	margin-bottom: 3px;
}

li.syntax-row { 
	margin-left: 12px;
	white-space: normal; 
	border-top: 1px #E0E0E0 solid;
	color: #BBB;
	wrap-option: emergency;
}
.syntax-row-text {
	color: #444;
}

div.syntax li.syntax-row-highlight {
	color: #FF1010;
	border-color: #D8D8D8;
}

div.syntax li.syntax-row-highlight .syntax-row-text, span.syntax-row-highlight {
	color: #FF1010;
}

li.syntax-row-first {
	border-top: none;
}
/* Mini Table */
.minitable {  
	color: #444;  
	display: block;  
	margin: 5px 20px;  
	border: solid 1px #D0D0D0;  
	background-color: #FFF;  
	font-size: 12px;  
}  
.minitable-header {  
	background: #fff url({T_THEME_PATH}/images/bg_header.gif) top left repeat-x;
	margin: 0;  
	margin-bottom: 5px;  
	padding-left: 5px;  
	padding-top: 7px;
	padding-right: 5px;
	border-bottom: solid 1px #D0D0D0;  
	font-size: 12px;  
	line-height: 1.2em;  
	font-family: Verdana, Arial, Helvetica, sans-serif;  
	font-weight: bold;
	color: #EDEFF4;
	height: 21px;

}  
.minitable-hideme {  
	font-size: 10px;  
	line-height: 1.2em;
	font-family: Verdana, Arial, Helvetica, sans-serif;  
	font-weight: bold;
	color: #EEE;
	float: right;
}
.minitable-hideme a, .minitable-hideme a:visited {
	color: #eee;
	text-decoration: none;
}
.minitable-hideme a:hover {
	color: #fff;
	text-decoration: none;
}
.minitable-contents {  
	padding-left: 5px;  
	padding-right: 5px;  
	padding-bottom: 5px;  
	line-height: 1.5;
	text-align: left;
}  
/* Hide content */
.hide-contents,
.hide-contents .quote-message {
	color: #757575;
	background-color: #F2F2F2;
	border: 2px dotted #DEDEDE;
	text-align: left;
	padding: 5px;
}


/* ul_syntaxhighlighter.css
-------------------------------------------------*/
/*
	XS Syntax Highlighter CSS
*/
.content .syntax {
	color: #444;
	display: block;
	margin: 5px 1px;
	width: auto;
	border: solid 1px #D0D0D0;
	background-color: #FFF;
	padding: 5px;
	font-size: 0.9em;
	font-family: Courier, 'Courier New', sans-serif;
	line-height: 1.2em;
}
.content .syntax-header {
	margin: 0;
	margin-bottom: 5px;
	padding-left: 3px;
	padding-bottom: 3px;
	border-bottom: solid 1px #E0E0E0;
	font-size: 0.9em;
	line-height: 1.2em;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: normal;
	color: #808080;
}

.syntax-header a:link,
.syntax-header a:visited
{
	color: #666;
	text-decoration: none;
	border-bottom: dotted 1px #666;
}
.syntax-header a:hover,
.syntax-header a:active
{
	color: #FF1010;
	text-decoration: none;
	border-bottom: dotted 1px #FF1010;
}

.syntax-content { padding: 0; }

.syntax-list {
	margin-top: 3px;
	margin-right: 0;
	margin-bottom: 3px;
}

li.syntax-row { 
	margin-left: 12px;
	white-space: normal; 
	border-top: 1px #E0E0E0 solid;
	color: #BBB;
	wrap-option: emergency;
}
.syntax-row-text {
	color: #444;
}

div.syntax li.syntax-row-highlight {
	color: #FF1010;
	border-color: #D8D8D8;
}

div.syntax li.syntax-row-highlight .syntax-row-text, span.syntax-row-highlight {
	color: #FF1010;
}

li.syntax-row-first {
	border-top: none;
}
/* Mini Table */
.minitable {  
	color: #444;  
	display: block;  
	margin: 5px 20px;  
	border: solid 1px #D0D0D0;  
	background-color: #FFF;  
	font-size: 12px;  
}  
.minitable-header {  
	background: #fff url({T_THEME_PATH}/images/bg_header.gif) top left repeat-x;
	margin: 0;  
	margin-bottom: 5px;  
	padding-left: 5px;  
	padding-top: 7px;
	padding-right: 5px;
	border-bottom: solid 1px #D0D0D0;  
	font-size: 12px;  
	line-height: 1.2em;  
	font-family: Verdana, Arial, Helvetica, sans-serif;  
	font-weight: bold;
	color: #EDEFF4;
	height: 21px;

}  
.minitable-hideme {  
	font-size: 10px;  
	line-height: 1.2em;
	font-family: Verdana, Arial, Helvetica, sans-serif;  
	font-weight: bold;
	color: #EEE;
	float: right;
}
.minitable-hideme a, .minitable-hideme a:visited {
	color: #eee;
	text-decoration: none;
}
.minitable-hideme a:hover {
	color: #fff;
	text-decoration: none;
}
.minitable-contents {  
	padding-left: 5px;  
	padding-right: 5px;  
	padding-bottom: 5px;  
	line-height: 1.5;
	text-align: left;
}  
/* Hide content */
.hide-contents,
.hide-contents .quote-message {
	color: #757575;
	background-color: #F2F2F2;
	border: 2px dotted #DEDEDE;
	text-align: left;
	padding: 5px;
}

/* portal.css
-------------------------------------------------*/

/* inner corners */

span.portal-corners-top-inner {
	margin: 0 -5px;
}

span.portal-corners-bottom-inner {
	margin: 0 -5px;
	clear: both;
}

span.portal-corners-top-inner, span.portal-corners-bottom-inner{
	font-size: 1px;
	line-height: 1px;
	display: block;
	height: 5px;
	background-repeat: no-repeat;
}

/* main menu, user menu and the links */

.portal-navigation{width: auto;}

.portal-navigation {
list-style-type: none;
margin: 0;
padding: 0;
margin-bottom: 8px; /*bottom spacing between each UL and rest of content*/
}

.portal-navigation li{
padding-bottom: 2px; /*bottom spacing between menu items*/
}

.portal-navigation li a{
background-image: url("{T_THEME_PATH}/images/portal/arrowbullet.gif");
background-repeat: no-repeat;
background-position: center left; /*custom bullet list image*/
display: block;
padding: 2px 0;
padding-left: 19px; /*link text is indented 19px*/
font-weight: bold;
font-size: 90%;
}

.portal-navigation div.menutitle{
padding: 1px 0;
font: bold 90% 'Trebuchet MS', 'Lucida Grande', Arial, sans-serif;
font-size: 12px;
}

/* mChat
-------------------------------------------------*/
.mChatBodyFix {
	padding: 0 0 10px 0;
}

#mChatData {
	margin: 10px 0;
	overflow: hidden;
}

.mChatBG1 img:first-child, .mChatBG2 img:first-child {
	height: 40px;
	width: 40px;
	margin: 0 -30px 0 0;
	float: left;
	position: relative;
	left: -40px;
	overflow: hidden;
}

#mChatData .body {
	height: auto;
	overflow: hidden;
}

#mChatData .date {
	color: #606060;
	font-size: 0.9166em;
	margin-left: 0.25em;
}

#mChatData .meta {
	overflow: hidden;
}

.mChatPanel input {
	margin: 4px 0;
}

/**
*
* @package mChat ProSilver Style
* @version 1.3.1 27.08.2009
* @copyright (c) djs596 ( http://djs596.com/ ), (c) RMcGirr83 ( http://www.rmcgirr83.org/ ), (c) Stokerpiller ( http://www.phpbb3bbcodes.com/ )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
**/

.mChatBG1 {
	background-color: #F9F9F9;
	padding: 5px 5px 5px 50px;
	border-bottom: 1px dotted #DDDDDD;
	overflow: hidden;
}

.mChatBG2 {
	background-color: #FFFFFF;
	padding: 5px 5px 5px 50px;
	border-bottom: 1px dotted #DDDDDD;
	overflow: hidden;
}

div.mChatRowLimit {
	overflow: auto;
	width: 100%;
	height: 200px;
	position: relative;
}

div.mChatRowLimitCustom {
	overflow: auto;
	width: 100%;
	height: 500px;
}

div.mChatPanel {
	text-align: center;
	padding: 5px;
}

input.mChatText {
	cursor: text;
	width: 50%;
	background-color: #FFFFFF;
	border: 1px solid #B4BAC0;
	color: #333333;
	padding: 3px 5px 3px 5px;
	margin: 0 0px 0px 5px;
}

input.mChatText:hover {
	border-color: #11A3EA;
}

div.mChatHover:hover {
	background-color: #FFFEDE;
}

div.mChatBodyFix {
	width: 100% !important;
	background-color: #EEEEEE !important;
}


/* Knowledge Base
-------------------------------------------------*/
/* CSS for the Knowledge Base */
h2.article_header {
	font-size: 1em;
	font-weight: bold;;
	margin: 10px 0;
	padding: 0.5em 10px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;
	border-radius: 5px;
}

h1.articletitle {
	font-size: 2.1666em;
	margin-bottom: 6px;
}

.articlebody {margin-bottom: 10px;}

.article .content {
	overflow: visible;
	font-family: Arial, Arial, Helvetica, sans-serif;
	font-size: 1.0833em;
	line-height: 1.7em;
}

.article_meta {
	color: #606060;
	font-size: 0.9166em;
}

textarea.desc {
	width: 40%;
}

/* Rating styles */
.star-rating
{
	list-style:none;
	margin-left:5px!important;
	padding:0px;
	width: 150px;
	height: 25px;
	position: relative;
	background: url("{T_THEME_PATH}/images/rate_star.gif") top left repeat-x;		
}

.star-rating li
{
	padding:0px;
	margin:0px;
	/*\*/
	float: left;
	/* */
}

.star-rating li a
{
	display:block;
	width:25px;
	height: 25px;
	text-decoration: none;
	text-indent: -9000px;
	z-index: 20;
	position: absolute;
	padding: 0px;
}

.star-rating li a:hover
{
	background: url("{T_THEME_PATH}/images/rate_star.gif") left bottom;
	z-index: 2;
	left: 0px;
}

.star-rating a.one-star
{
	left: 0px;
}

.star-rating a.one-star:hover
{
	width:25px;
}

.star-rating a.two-stars
{
	left:25px;
}

.star-rating a.two-stars:hover
{
	
	width: 50px;
}

.star-rating a.three-stars
{
	left: 50px;
}

.star-rating a.three-stars:hover
{
	width: 75px;
}

.star-rating a.four-stars
{
	left: 75px;
}	

.star-rating a.four-stars:hover
{
	width: 100px;
}

.star-rating a.five-stars
{
	left: 100px;
}

.star-rating a.five-stars:hover
{
	width: 125px;
}

.star-rating a.six-stars
{
	left: 125px;
}

.star-rating a.six-stars:hover
{
	width: 150px;
}

.star-rating li.current-rating
{
	background: url("{T_THEME_PATH}/images/rate_star.gif") left center;
	position: absolute;
	height: 25px;
	display: block;
	text-indent: -9000px;
	z-index: 1;
}

/**
* Left menu
*/
#left_menu {
	vertical-align: top;
}

#right_menu {
	vertical-align: top;
}

.left_menu_title {
	color: #212121;
	font-weight: bold;
	padding: 0.5em 0;
}

.cat_menu_title {
	font-weight: bold;
	text-align: left;
	padding: 1px 0 5px 0;
}

h3.kb_cat {
	font-size: 1.0833em;
	text-transform: none;
}

h3.kb_cat img {
	margin-bottom: -2px;
}

.kb_cat_desc {
	padding-right: 10px;
}

.kb_subcats {
	margin-top: 0.5em;
}

.kb_subcats strong {
	color: #000000;
}

.kb_latest_articles {
	font-size: 1em;
	margin-bottom: 2em;
}

.kb_latest_articles strong {color: #000000;}

#kb_searchform {
	color: #FFFFFF;
	margin: 5px 0;
	white-space: nowrap;
}

#kb_keywords {background-color: #FFFFFF;}

/* MCP Specific tweaks */
.mcp-main .kb-mcp-postbody {
	width: 76%;
}

.addthis_toolbox .custom_images a
{
    width: 24px;
    height: 24px;
    margin: 0;
    padding: 0;
}

.article-icon span		{ background: transparent none 0 0 no-repeat; }
.buttons div.article-icon		{ width: {IMG_BUTTON_ARTICLE_NEW_WIDTH}px; height: {IMG_BUTTON_ARTICLE_NEW_HEIGHT}px; }
.article-icon span		{ background-image: url("{IMG_BUTTON_ARTICLE_NEW_SRC}"); }

.comment-icon span		{ background: transparent none 0 0 no-repeat; }
.buttons div.comment-icon		{ width: {IMG_BUTTON_COMMENT_NEW_WIDTH}px; height: {IMG_BUTTON_COMMENT_NEW_HEIGHT}px; }
.comment-icon span		{ background-image: url("{IMG_BUTTON_COMMENT_NEW_SRC}"); }

.icon-kb {
	background-image: url("{T_THEME_PATH}/images/icon_kb.gif");
	background-position: 0 50%;
	background-repeat: no-repeat;
	padding: 1px 0 0 23px;
}

/*** INSTANT MESSENGER / STYLE FILE ***/


#site-bottom-bar, #site-bottom-bar-frame {
	
	bottom: 0;
	left: 20px;
	right: 20px;

	padding-left: 1px;
	padding-right: 1px;
	height: 26px;
	display: block;
	font-size: 11px;
}

.fixed-position {
	position: fixed;
	_position: absolute;
}

/* full background */

#site-bottom-bar {
	background-color: #f0f0f0;
	border-top: 1px solid #999;
	z-index: 100;
	height: 25px;
	_height: 26px;
	display: block;
	/*display:none;**/
}

#site-bottom-bar-frame {
	z-index: 101;
}

#site-bottom-bar-frame a:link,
#site-bottom-bar-frame a:active,
#site-bottom-bar-frame a:visited,
#site-bottom-bar-frame a:hover {
	font-weight: normal !important;
}

#site-bottom-bar-frame ul {
	list-style-type: none;
	margin-left: 0;
}

#site-bottom-bar-frame ul li{
	line-height: 1.5em;
	border-bottom: none;
	padding: 2px 4px;
}

#site-bottom-bar-frame ul li > a {
	display: block;
}


#site-bottom-bar-frame ul li:hover {
/*	color: #fff;*/
}
#site-bottom-bar-frame ul li > a:hover {
	background-color: #6D84B4;
	color: #fff;
	text-decoration: none;
}



#site-bottom-bar-frame .block-box {
	border-bottom: none;
	float: left;
	margin-right: -1px;
	margin-left: -1px;
}

#site-bottom-bar-frame .block-box:last-child{
	margin-right: 0px;
}

#site-bottom-bar-frame .rightside {
	float: right;
}

#site-bottom-bar-frame .button {
	background: #f0f0f0 url('{T_THEME_PATH}/images/im_toolbarbg.gif') repeat-x 0 0;
	border: 1px solid #999;
	z-index: 1100;
	padding: 0 10px;
	line-height: 25px;
	font-weight: bold;
	color: #333;
	cursor: pointer;
}

#site-bottom-bar-frame .button.hovering {
	background: #fff none no-repeat 0 0;
	/*border-top: 1px solid #fff;*/
	color: #1F1F1F;
}

#site-bottom-bar-frame #im-online-list .button span {
	background: transparent none no-repeat 0 50%;
	padding-left: 20px;
}

#site-bottom-bar-frame .block {
	position: absolute;
	bottom: 25px;
	background-color: #fff;
	border: 1px solid #999;
	z-index: 999;
	width: 230px;
	display: none;
	overflow: hidden;
}


#site-bottom-bar-frame #im-online-list .button {
	width: 160px;
	font-weight: bold;
}

#site-bottom-bar-frame #im-online-list .block {
	width: 200px;
}

#site-bottom-bar-frame #im-online-list .button img {
	float: left;
	margin-right: 5px;
	padding: 7px 0;
}

#site-bottom-bar-frame #im-online-list span{
  vertical-align: top;
  background: transparent none no-repeat 100% 50%;
  font-weight: bold;
  line-height: 21px;
}

#site-bottom-bar-frame #im-online-list .block ul li img {
	float: left;
	margin-right: 5px;
	padding: 0;
}


#site-bottom-bar-frame #im-online-list .block .bcontent.links ul li span {
	font-weight: normal;
	border: 0;
}

#site-bottom-bar-frame #im-online-list .block .bcontent.links ul li:hover span {
	color: #fff;
}

#site-bottom-bar-frame #im-news .block {
	width: 260px;
}

#site-bottom-bar-frame #im-status .block {
	width: 290px;
}

#site-bottom-bar-frame .rightside .block {
	right: +1px;
	margin-right: -1px;
}

#site-bottom-bar-frame .block-box .block h3 {
	border-bottom:1px solid #CCCCCC;
	font-size:1.1em;
	background: #212121;
	padding: 4px 10px;
	margin: 0px 0px;
	color: #fff;
	font-weight: bold;
}

#site-bottom-bar-frame .block h3 a:link,
#site-bottom-bar-frame .block h3 a:active,
#site-bottom-bar-frame .block h3 a:visited,
#site-bottom-bar-frame .block h3 a:hover {
	color: #fff;
	text-decoration: none;
	font-weight: bold !important;
}


#site-bottom-bar-frame .block .bcontent {
	padding: 2px 5px 5px;
	line-height: 1.2em;
	overflow: hidden;
}

#site-bottom-bar-frame .block .bcontent.links {
	padding: 0px;
}

#site-bottom-bar-frame .block .bcontent.links ul li{
	padding: 0px;
}

#site-bottom-bar-frame .block .bcontent.links ul li a,
#site-bottom-bar-frame .block .bcontent.links ul li span {
	padding: 1px 4px;
}

#site-bottom-bar-frame .block .bcontent.links ul li span {
	display: block;
	border-bottom: 1px solid #ccc;
}
#site-bottom-bar-frame .block .bcontent.links ul li:last-child span {
	border-bottom: 0px solid #ccc;
}

#site-bottom-bar-frame fieldset {
	border: none;
}

#site-bottom-bar-frame fieldset dl {
	margin: 0;
	padding: 0;
	overflow: hidden;
}
#site-bottom-bar-frame fieldset dt {
	width: 100%;
}

#site-bottom-bar-frame fieldset dd {
	margin-left: 0;
}

#site-bottom-bar-frame fieldset p {
	margin-top: 3px;
}

#site-bottom-bar-frame label, #site-bottom-bar-frame input.inputbox {
	float: left;
}

#site-bottom-bar-frame input.button1 {
	float: left;
	width: 100% !important;
}

#site-bottom-bar-frame input.button2 {
	float: left;
	width: 48% !important;
	margin-right: 3px;
}

#site-bottom-bar-frame p {
	margin-bottom: 0px;
}

#site-bottom-bar-frame blockquote.bubble_status {
   margin: 0;       
   padding: 5px 10px;
   border: 1px solid #c9c2c1;
   background-color: #fff;
   background-image: none;
}

.bubble blockquote {
	background-image: none;
	background-color: #fff;
	margin: 0;
	border-color: #c9c2c1;
}

.bubble blockquote p {
	margin: 0;
}

.postprofile .bubble, .left-box .bubble {
	margin: 5px 0 0 10px;
}

.left-box .bubble {
	margin-left: 0;
}

.postprofile .bubble cite, .left-box .bubble cite {
   position: relative;
   margin: 0px;
   padding: 0 0 0 15px;
   height: 7px;
   line-height: 7px;
   font-size: 7px;
   margin-bottom: -1px;
   background: transparent url('{T_THEME_PATH}/images/status_up.gif') no-repeat 20px 0;
   font-style: normal;
   display:block;
}

.left-box .bubble cite {
}

#site-bottom-bar-frame .down cite {
   background: transparent url('{T_THEME_PATH}/images/status_down.gif') no-repeat 20px -1px;
   display: block;
   height: 7px;
   top: -1px;
   position: relative;
}

/** OVERLAYs **/

.overlay {
	position: absolute;
	top: 0;
	left: 0;
	height: 100%;
	width: 100%;
	opacity: 0.3;
	display: none;
	z-index: 100;
	background-color: #000;
}

.overlay-text {
	position: absolute;
	top: 0;
	left: 0;
	z-index: 200;
	text-align: center;
	display: none;
	opacity: 1.0;
	font-weight: bold;
	color: #fff;
	font-size: 18px;
	line-height: 100%;
	width: 100%;
} 

/** Chat boxes **/

.chatbox {
	position: fixed;
	width: 216px;
	/*display:none;*/
	bottom: 26px;
}

.chatboxhead {
	background-color: #212121;
	padding:5px;
	color: #ffffff;
	border:1px solid #333333;
}

.chatboxtitle {
	float: left;
	font-weight:bold;
	font-size: 12px;
}

.chatboxoptions {
	float: right;
}

.chatboxoptions a {
	text-decoration: none;
	color: #ffffff;
	font-weight:bold;
}

.chatboxblink {
	background-color: #C80000;
	border:1px solid #333333;
}

.chatboxcontent {
	/*font-size: 13px;*/
	font-size: 1.1em;
	color: #000000;
	height:200px;
	width:200px;
	overflow-y:auto;
	overflow-x:hidden;
	padding:7px;
	border-left:1px solid #cccccc;
	border-right:1px solid #cccccc;
	border-bottom:1px solid #eeeeee;
	background-color: #ffffff;
	line-height: 1.3em;
}

.chatboxinput {
  background: #ffffff url('{T_THEME_PATH}/images/im_text.gif') no-repeat 3px 7px;
  border:1px solid #93A2C1;
	border-bottom:0;
	padding:4px 0 4px 20px;
}

.chatboxtextarea {
	font-family: Arial, Helvetica, sans-serif;
  font-size: 11px;
	width: 185px;
	height:16px;
	overflow:hidden;  
	border: 0;
  background: #ffffff;
}

.chatboxtextareaselected {
}

.chatboxmessage {
	margin-left:1em;
}

div.chatboxinfo{
	margin: 0px -5px;
	border-bottom: 1px solid #aaa;
}
span.chatboxinfo {
	padding-left:7px;
	color:#666666;
}

.chatboxmessagefrom {
	margin-left:-1em;
	font-weight: bold;
}

.chatboxmessagecontent {
}

.table1 .rightside {
	float: right;
	padding-right: 3px;
}

/*
 * jQuery Nivo Slider v1.9
 * http://nivo.dev7studios.com
 *
 * Copyright 2010, Gilbert Pellegrom
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * March 2010
 */
/* The Nivo Slider styles */
.nivoSlider {
	position:relative;
}
.nivoSlider img {
	position:absolute;
	top:0px;
	left:0px;
}
/* If an image is wrapped in a link */
.nivoSlider a.nivo-imageLink {
	position:absolute;
	top:0px;
	left:0px;
	width:100%;
	height:100%;
	border:0;
	padding:0;
	margin:0;
	z-index:60;
	display:none;
}
/* The slices in the Slider */
.nivo-slice {
	display:block;
	position:absolute;
	z-index:50;
	height:100%;
}
/* Caption styles */
.nivo-caption {
	position:absolute;
	left:0px;
	bottom:0px;
	background:#000;
	color:#fff;
	opacity:0.8; /* Overridden by captionOpacity setting */
	width:100%;
	z-index:89;
}
.nivo-caption p {
	padding:5px;
	margin:0;
}
/* Direction nav styles (e.g. Next & Prev) */
.nivo-directionNav a {
	position:absolute;
	top:45%;
	z-index:99;
	cursor:pointer;
}
.nivo-prevNav {
	left:0px;
}
.nivo-nextNav {
	right:0px;
}
/* Control nav styles (e.g. 1,2,3...) */
.nivo-controlNav a {
	position:relative;
	z-index:99;
	cursor:pointer;
}
.nivo-controlNav a.active {
	font-weight:bold;
}

/*
 * Note: Include the nivo-slider.css file that comes
 * with the main download before including this file.
 */

#slider {
	position:relative;
	max-height: 360px;
	max-width: 100%;
	margin:30px 30px 60px 30px;
	background:#202834 url({T_THEME_PATH}/images/loading.gif) no-repeat 50% 50%;
	-moz-box-shadow:0px 0px 10px #333;
	-webkit-box-shadow:0px 0px 10px #333;
	box-shadow:0px 0px 10px #333;
}
#slider img {
	position:absolute;
	top:0px;
	left:0px;
	display:none;
}
#slider a {
	border:0;
}

.nivo-controlNav {
	position:absolute;
	left:47%;
	bottom:-30px;
}
.nivo-controlNav a {
	display:block;
	width:10px;
	height:10px;
	background:url({T_THEME_PATH}/images/bullets.png) no-repeat;
	text-indent:-9999px;
	border:0;
	margin-right:3px;
	float:left;
}
.nivo-controlNav a.active {
	background-position:-10px 0;
}

.nivo-directionNav a {
	display:block;
	width:32px;
	height:34px;
	background:url({T_THEME_PATH}/images/arrows.png) no-repeat;
	text-indent:-9999px;
	border:0;
}
a.nivo-nextNav {
	background-position:-32px 0;
	right:10px;
}
a.nivo-prevNav {
	left:10px;
}

/* adBrite
-------------------------------------------------*/
.adbrite {
	text-align: center;
}

#bottom-ad {
	margin: 10px 0;
}
/*  	2D587E
--------------------------------------------------------------
Colours and backgrounds for common.css
-------------------------------------------------------------- */

html, body {
	color: #212121;
	background: #FFFFFF url({T_THEME_PATH}/images/wrap_bg.png) repeat-x scroll 0 122px;
}

h1 {color: #212121;}
h2 {color: #212121;}

h3 {
	border-bottom-color: #CCCCCC;
	color: #999999;
}

hr {
	border-color: #FFFFFF;
	border-top-color: #D0D0D0;
}

hr.dashed {
	border-color: #FFFFFF;
	border-top-color: #CCCCCC;
}

/* Main blocks
--------------------------------------------- */
#page-header {
	background: #EEEEEE url("{T_THEME_PATH}/images/header_bg.png") scroll repeat-x;
	border-top-color: #212121;
}

#board-statistics {
	background: #f6f6f6;
	border-color: #D0D0D0;
	color: #606060;
}

/* Quickpanel block
--------------------------------------------- */
#quickpanel {
	background-color: #111111;
	border-bottom-color: #000000;
	border-top-color: #333333;
	color: #FFFFFF;
}

#quickpanel a, #quickpanel label {color: #FFFFFF;}

/* Account actions box
--------------------------------------------- */
#account-actions li a:link, #account-actions li a:visited {color: #C9D2D8;}
#account-actions li a:hover, #account-actions li a:active {color: #FF0000;}

/* Search box
--------------------------------------------- */
#search-box {
	background-color: #D0D0D0;
	color: #212121;
}

#search-box #keywords {background-color: #FFFFFF;}

/* Footer Utilities box
--------------------------------------------- */
#footer-utilities {
	background: #000000 url("{T_THEME_PATH}/images/gradient_bg3.gif") repeat-x scroll 0 -1px;
	color: #FFFFFF;
}

#footer-utilities a:link, #footer-utilities a:visited {color: #C9D2D8;}
#footer-utilities a:hover, #footer-utilities a:active {color: #FF0000;}

/* Breadcrumbs box
--------------------------------------------- */
.breadcrumbs {
	background: #000000 url("{T_THEME_PATH}/images/gradient_bg3.gif") repeat-x scroll 0 -6px;
	color: #FFFFFF;
}

.breadcrumbs .navlinks .icon-home a.index:link, .breadcrumbs .navlinks .icon-home a.index:visited {color: #C9D2D8;}

.breadcrumbs .navlinks .icon-home a:link, .breadcrumbs .navlinks .icon-home a:visited {
	color: #999999;
	text-decoration: none;
}

.breadcrumbs .navlinks .icon-home a:hover, .breadcrumbs .navlinks .icon-home a:active {color: #FF0000;}

/* Navbar
--------------------------------------------- */
.navbar {color: #666666;}

.navbar li.current a {
	background: #FFFFFF;
	color: #212121;
}

.navbar li.current a span {color: #666666;}

.navbar a:link, .navbar a:visited {
	border-left-color: #f6f6f6;
	color: #666666;
}

.navbar a:hover, .navbar a:active {
	background: #EEEEEE url("{T_THEME_PATH}/images/tab_arrow.png") no-repeat scroll top center;
	color: #000000;
}

.navbar a:hover span, .navbar a:active span {color: #666666;}
.navbar span {color: #BBBBBB;}

/* Profile blocks
---------------------------------------- */
h2.pro-header, h3.pro-header {
	background-color: #D0D0D0;
	color: #666666;
}

#comment .commentrow:first-child {border-top-color: #D0D0D0;}
#comment .commentrow {border-bottom-color: #D0D0D0;}

#comment .date {color: #606060;}

.pro-box {
	background-color: #f6f6f6;
	border: 1px solid #D0D0D0;
	color: #212121;
}

/* Message box 
---------------------------------------- */
#message p {color: #212121;}
#confirm p {color: #212121;}

/* Factions page 
---------------------------------------- */ 
#faction .details {border-right-color: #E0E0E0;}
#faction .details dl dd {color: #666666;}

/* Round cornered boxes and backgrounds
---------------------------------------- */
.forabg {
	background-image: #FFFFFF url("{T_THEME_PATH}/images/bg_list.gif");
	border-bottom: 4px solid #666666;
}

.forabg-sidebar {
	background-color: #D0D0D0;
	background-image: url("{T_THEME_PATH}/images/bg_list.gif");
}

.forumbg {
	background-color: #FFFFFF;
	background-image: url("{T_THEME_PATH}/images/bg_header.gif");
	border-bottom: 4px solid #777777;
}

.panel {
	background-color: #f6f6f6;
	border-color: #D0D0D0;
	color: #666666;
}

.panel.smooth {
	border-color: transparent transparent #D0D0D0;
}

.panel-sidebar {background-color: #D0D0D0;}
.panel-sidebar h3 {color: #333333;}
.panel-sidebar .inner {background-color: #FFFFFF;}

#comment.panel {
	background: #FFFFFF;
	border: none;
}

.panel.info p {color: #666666}

.panel .login {border-right-color: #D0D0D0;}

.post:target .content {color: #000000;}

.post:target h3 a {color: #000000;}

.bg1 {background-color: #FFFFFF;}

.post.bg1 {
	background-color: #FFFFFF;
	border-bottom-color: #666666;
}

.post.reported {background-color: #F7ECEF !important;}

.search.post.bg1, .search.post.bg2 {border-bottom-color: #666666;}

.bg2 {background-color: #F6F6F6; }
.bg3 {background-color: #F6F6F6;}
.bg4 {background-color: #E6E6E6;}

.ucprowbg {background-color: #DCDEE2;}
.fieldsbg {background-color: #E7E8EA;}

/* Horizontal lists
----------------------------------------*/

ul.navlinks {border-bottom-color: #FFFFFF;}

/* Table styles
----------------------------------------*/
table.table1 thead th {
	background-color: #BBBBBB;
	color: #212121;
}

table.table1 thead th a {color: #212121;}
table.table1 tbody tr {border-color: #BFC1CF;}

table.table1 tbody tr:hover, table.table1 tbody tr.hover {
	background-color: #FFFEDE;
	color: #000;
}

table.table1 tr:hover td.posts, table.table1 tr:hover td.joined {
	background-color: #FFFEDE;
	color: #000000;
}

table.table1 td {color: #536482;}
table.table1 tbody td {border-top-color: #FAFAFA;}

table.table1 tbody th {
	border-bottom-color: #000000;
	color: #212121;
	background-color: #FFFFFF;
}

table.info tbody th {color: #000000;}

table#recent {
	background: #f6f6f6;
	border: 1px solid #D0D0D0;
}

table#recent .meta th {
	font-weight: bold;
	background: #C0C0C0;
	color: #212121;
}

table#recent tr:hover {background: transparent;}

/* Misc layout styles
---------------------------------------- */
dl.details dt {color: #000000;}
dl.details dd {color: #212121}
.sep {color: #212121;}

/* Pagination
---------------------------------------- */

.pagination span strong {
	background: #212121 url({T_THEME_PATH}/images/button3_bg.gif) repeat-x scroll 0 -1px;
	border-color: #212121;
	color: #F9F9F9;
}

.pagination span a, .pagination span a:link, .pagination span a:visited, .pagination span a:active {
	background: #D0D0D0 url({T_THEME_PATH}/images/button_bg3.gif) repeat-x scroll 0 -1px;
	color: #666666;
	border-color: #BBBBBB;
}

.pagination span a:hover {
	border-color: #606060;
	background-color: #183152;
	color: #000000;
}

/* Pagination in viewforum for multipage topics */
.row .pagination {background: url("{T_THEME_PATH}/images/icon_pages.gif");}
.row .pagination span a, li.pagination span a {background: #FFFFFF;}
.row .pagination span a:hover, li.pagination span a:hover {background: #C9D2D8;}

/* Miscellaneous styles
---------------------------------------- */

.copyright {color: #555555;}

.error {
	background-color: #FFE4E1;
	border-color: #990000;
	color:  #990000;
}

.reported {background-color: #F7ECEF;}

li.reported:hover {
	background-color: #ECD5D8 !important;
}

/* you can add a background for stickies and announcements*/
.sticky {}
.announce {}

div.rules {
	background-color: #ECD5D8;
	color: #FF530D;
}

p.rules {
	background-color: #ECD5D8;
	background-image: none;
}

/*  	
--------------------------------------------------------------
Colours and backgrounds for links.css
-------------------------------------------------------------- */

a:link	{ color: #0D4473; }
a:visited	{ color: #0D4473; }
a:hover	{ color: #D31141; }
a:active	{ color: #0D4473; }

/* Links on gradient backgrounds */
#search-box a:link {
	color: #FF530D;
}

.navbg a:link, .forumbg .header a:link, .forabg .header a:link, th a:link, .forumbg .header a:visited, .forabg .header a:visited, th a:visited {
	color: #FFFFFF;
}

#search-box a:visited, .navbg a:visited {
	color: #FF530D;
}

#search-box a:hover, .navbg a:hover, .forumbg .header a:hover, .forabg .header a:hover, th a:hover {
	color: #FF0000;
}

#search-box a:active, .navbg a:active, .forumbg .header a:active, .forabg .header a:active, th a:active {
	color: #FF0000;
}

/* Links for forum/topic lists */
a.forumtitle {color: #2D587E;}
/* a.forumtitle:visited { color: #2D587E; } */
a.forumtitle:hover {color: #FF0000;}
a.forumtitle:active {color: #2D587E;}

a.topictitle {color: #2D587E;}
a.topictitle:hover, a.topictitle:active {color: #FF0000;}

/* a.topictitle:visited { color: #368AD2; } */
.panel h2.polltitle {
	background-color: #BBBBBB;
	color: #212121;
}

h2.pagetitle a:hover, h1.topictitle a:hover, h3.solo a:hover {color: #FF0000;}
h2.pagetitle a:active, h1.topictitle a:active, h3.solo a:active {color: #2D587E;}

/* Post body links */
.postlink {
	color: #368AD2;
	border-bottom-color: #368AD2;
}

.postlink:visited {
	color: #0D4473;
	border-bottom-color: #666666;
}

.postlink:active {color: #368AD2;}

.postlink:hover {
	color: #0D4473;
}

.signature a, .signature a:visited, .signature a:active, .signature a:hover {
	background-color: transparent;
}

/* Profile links */
.postprofile a:link, .postprofile a:active, .postprofile a:visited, .postprofile dt.author a {color: #2D587E;}
.postprofile a:hover, .postprofile dt.author a:hover {color: #D31141}

/* Profile searchresults */	
.search .postprofile a {color: #D63600;}
.search .postprofile a:hover {color: #D31141;}

/* Profile meta */
.postmeta {
	background: #C0C0C0;
	color: #212121;
}

/* Profile icons */
ul.profile-icons {
	background: #EEEEEE;
	color: #212121;
}

ul.profile-icons li a {
	background: #D0D0D0 url("{T_THEME_PATH}/images/button_bg.gif") scroll repeat-x 0 -2px;
	border: 1px solid #C0C0C0;
	color: #28313F;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}

/* Back to top of page */
a.top {background-image: url("{IMG_ICON_BACK_TOP_SRC}");}
a.top2 {background-image: url("{IMG_ICON_BACK_TOP_SRC}");}

/* Arrow links  */
a.up		{ background-image: url("{T_THEME_PATH}/images/arrow_up.gif"); }
a.down		{ background-image: url("{T_THEME_PATH}/images/arrow_down.gif"); }
a.left		{ background-image: url("{T_THEME_PATH}/images/arrow_left.gif"); color: #FF530D;}
a.right		{ background-image: url("{T_THEME_PATH}/images/arrow_right.gif"); color: #FF530D;}

a.up:hover {background-color: transparent;}
a.left:hover, a.right:hover {color: #FF0000;}

/*  	
--------------------------------------------------------------
Colours and backgrounds for content.css
-------------------------------------------------------------- */

ul.forums {background-color: #BBBBBB;}
ul.topics {background-color: #FFFFFF;}
ul.topiclist li {color: #606060;}

ul.topiclist dl.meta {
	background-color: #C0C0C0;
	color: #212121;
}

ul.topiclist dd {
	border-left-color: #FFFFFF;
}

.rtl ul.topiclist dd {
	border-right-color: #FFFFFF;
	border-left-color: transparent;
}

.rtl blockquote {
	background-image: url("{T_THEME_PATH}/images/quote_rtl.gif");
}


ul.topiclist li.row dt a.subforum.read {background: url("{IMG_SUBFORUM_READ_SRC}") left center no-repeat scroll;}
ul.topiclist li.row dt a.subforum.unread {background: url("{IMG_SUBFORUM_UNREAD_SRC}") left center no-repeat scroll;}

.bg1 dd.stats, .bg1 dd.posts, .bg1 dd.lastpost, tr.bg1 td.posts, tr.bg1 td.joined {background-color: #FFFFFF;}

.bg2 dd.stats, .bg2 dd.posts, .bg2 dd.lastpost, tr.bg2 td.posts, tr.bg2 td.joined {background-color: #F6F6F6;}

ul.topiclist dl.meta dt, ul.topiclist dl.meta dd, li.header dl.meta dt, li.header dl.meta dd {
	background-color: #C0C0C0 !important;
	color: #212121 !important;
}

ul.topiclist li.row {border-bottom-color: #FFFFFF;}
li.row strong {color: #000000;}

li.row.reported, li.row.reported dd.stats, li.row.reported dd.posts, li.row.reported dd.views, li.row.reported dd.lastpost {
	background-color: #F7ECEF;
	color: #212121;
}

li.row.reported:hover, li.row.reported:hover dd.stats, li.row.reported:hover dd.posts, li.row.reported:hover dd.views, li.row.reported:hover dd.lastpost {
	background-color: #ECD5D8 !important;
	color: #212121;
}

li.row:hover, li.row:hover dd.stats, li.row:hover dd.posts, li.row:hover dd.views, li.row:hover dd.lastpost {
	background-color: #FFFEDE;
	color: #212121;
}

.rtl li.row:hover dd {
	border-right-color: #CCCCCC;
	border-left-color: transparent;
}

.back2top a {
	background: #EEEEEE;
}

.jump2post a {
	background: #BBBBBB;
	color: #FFFFFF;
}

.jump2post a:hover {color: #D31141}

.forabg li.header, .forumbg li.header, h2.cattitle {
	background: #000000 url("{T_THEME_PATH}/images/gradient_bg3.gif") repeat-x scroll;
}

.forabg-sidebar li.header {
	background: transparent;
}

li.header dt, li.header dd, h2.cattitle {
	color: #FFFFFF;
}

.forabg-sidebar li.header dt {
	color: #212121;
}

h2.pagetitle, h1.topictitle, h3.solo {
	background: #000000 url("{T_THEME_PATH}/images/gradient_bg3.gif") repeat-x scroll;
	color: #FFFFFF;
}

h2.pagetitle a, h1.topictitle a, h2.cattitle a, .forabg li.header span, .forumbg li.header span, h2.pagetitle span, h2.cattitle span {
	background-color: #000000;
	border-color: #212121;
	color: #FFFFFF;
}

/* Forum list column styles */
ul.topiclist dd.searchextra {
	color: #212121;
}

/* Post body styles
----------------------------------------*/
.postbody {color: #212121;}

/* Content container styles
----------------------------------------*/
.content {color: #212121;}

.content h2, .panel h2 {
	color: #212121;
	border-bottom-color:  #CCCCCC;
}

dl.faq dt {color: #212121;}

.posthilit {
	background-color: #C9D2D8;
	color: #111111;
}

/* Post signature */
.signature {border-top-color: #E0E0E0;}

/* Post noticies */
.notice {border-top-color:  #CCCCCC;}

/* BB Code styles
----------------------------------------*/
/* Quote block */
blockquote {
	background: #F3F3F3 url("{T_THEME_PATH}/images/quote.gif") no-repeat scroll 10px 10px;
	border-color: #D0D0D0;
}

blockquote blockquote {
	/* Nested quotes */
	background-color: #F6F6F6;
}

blockquote blockquote blockquote {
	/* Nested quotes */
	background-color: #F9F9F9;
}

/* Code block */
dl.codebox {
	border-color: #BBBBBB;
}

dl.codebox dt {
	background-color: #E0E0E0;
	border-bottom-color: #D0D0D0;
}

dl.codebox dd {
	background-color: #F6F6F6;
}

dl.codebox code {
	color: #2E8B57;
}

.syntaxbg		{ color: #FFFFFF; }
.syntaxcomment	{ color: #FF0000; }
.syntaxdefault	{ color: #0000BB; }
.syntaxhtml		{ color: #000000; }
.syntaxkeyword	{ color: #007700; }
.syntaxstring	{ color: #DD0000; }

/* Attachments
----------------------------------------*/
.attachbox {
	background-color: #FFFFFF;
	border-color:  #C9D2D8;
}

.pm-message .attachbox {background-color: #F2F3F3;}
.attachbox dd {border-top-color: #C9D2D8;}
.attachbox p {color: #666666;}
.attachbox p.stats {color: #666666;}
.attach-image img {border-color: #999999;}

/* Inline image thumbnails */

dl.file dd {color: #666666;}

dl.thumbnail img {
	border-color: #666666;
	background-color: #FFFFFF;
}

dl.thumbnail dd {color: #666666;}
dl.thumbnail dt a:hover {background-color: #EEEEEE;}
dl.thumbnail dt a:hover img {border-color: #368AD2;}

/* Post poll styles
----------------------------------------*/

fieldset.polls dl {
	border-top-color: #DCDEE2;
	color: #666666;
}

fieldset.polls dl.voted {
	color: #000000;
}

fieldset.polls dd div {
	color: #FFFFFF;
}

.rtl .pollbar1, .rtl .pollbar2, .rtl .pollbar3, .rtl .pollbar4, .rtl .pollbar5 {
	border-right-color: transparent;
}

.pollbar1 {
	background-color: #AA2346;
	border-bottom-color: #74162C;
	border-right-color: #74162C;
}

.rtl .pollbar1 {
	border-left-color: #74162C;
}

.pollbar2 {
	background-color: #BE1E4A;
	border-bottom-color: #8C1C38;
	border-right-color: #8C1C38;
}

.rtl .pollbar2 {
	border-left-color: #8C1C38;
}

.pollbar3 {
	background-color: #D11A4E;
	border-bottom-color: #AA2346;
	border-right-color: #AA2346;
}

.rtl .pollbar3 {
	border-left-color: #AA2346;
}

.pollbar4 {
	background-color: #E41653;
	border-bottom-color: #BE1E4A;
	border-right-color: #BE1E4A;
}

.rtl .pollbar4 {
	border-left-color: #BE1E4A;
}

.pollbar5 {
	background-color: #F81157;
	border-bottom-color: #D11A4E;
	border-right-color: #D11A4E;
}

.rtl .pollbar5 {
	border-left-color: #D11A4E;
}

/* Poster profile block
----------------------------------------*/
.postprofile {
	color: #666666;
	border-right-color: #E0E0E0;
}

.rtl .postprofile {
	border-right-color: #FFFFFF;
	border-left-color: transparent;
}

.pm .postprofile {
	border-left-color: #DDDDDD;
}

.rtl .pm .postprofile {
	border-right-color: #DDDDDD;
	border-left-color: transparent;
}

.postprofile strong {
	background-color: #EEEEEE;
	color: #000000;
}

.postprofile dd.reputation { background-color: #C9D2D8; }
.postprofile dd.reputation strong { background-color: transparent; }

.online {}

/*  	
--------------------------------------------------------------
Colours and backgrounds for buttons.css
-------------------------------------------------------------- */

/* Big button images */
.reply-icon span	{ background-image: url("{IMG_BUTTON_TOPIC_REPLY_SRC}"); }
.post-icon span		{ background-image: url("{IMG_BUTTON_TOPIC_NEW_SRC}"); }
.locked-icon span	{ background-image: url("{IMG_BUTTON_TOPIC_LOCKED_SRC}"); }
.pmreply-icon span	{ background-image: url("{IMG_BUTTON_PM_REPLY_SRC}") ;}
.newpm-icon span 	{ background-image: url("{IMG_BUTTON_PM_NEW_SRC}") ;}
.forwardpm-icon span	{ background-image: url("{IMG_BUTTON_PM_FORWARD_SRC}") ;}

a.print {background-image: url("{T_THEME_PATH}/images/icon_print.gif");}
/*a.sendemail {background-image: url("{T_THEME_PATH}/images/icon_sendemail.gif");}
a.fontsize {background-image: url("{T_THEME_PATH}/images/icon_fontsize.gif");}*/

/* Icon images
---------------------------------------- */
/*.sitehome						{ background-image: url("{T_THEME_PATH}/images/icon_home.gif"); }
.icon-faq						{ background-image: url("{T_THEME_PATH}/images/icon_faq.gif"); }
.icon-members					{ background-image: url("{T_THEME_PATH}/images/icon_members.gif"); }
.icon-home						{ background: transparent url("{T_THEME_PATH}/images/home.png") scroll no-repeat left; padding-left: 20px; }
.icon-ucp						{ background-image: url("{T_THEME_PATH}/images/icon_ucp.gif"); }
.icon-register					{ background-image: url("{T_THEME_PATH}/images/icon_register.gif"); }
.icon-logout					{ background-image: url("{T_THEME_PATH}/images/icon_logout.gif"); }
.icon-bookmark					{ background-image: url("{T_THEME_PATH}/images/icon_bookmark.gif"); }
.icon-bump						{ background-image: url("{T_THEME_PATH}/images/icon_bump.gif"); }
.icon-subscribe					{ background-image: url("{T_THEME_PATH}/images/icon_subscribe.gif"); }
.icon-unsubscribe				{ background-image: url("{T_THEME_PATH}/images/icon_unsubscribe.gif"); }
.icon-pages						{ background-image: url("{T_THEME_PATH}/images/icon_pages.gif"); }
.icon-search					{ background-image: url("{T_THEME_PATH}/images/icon_search.gif"); }
.icon-points					{ background-image: url("{T_THEME_PATH}/images/icon_points.gif"); }*/

/* Profile & navigation icons */
/*.email-icon, .email-icon a		{ background-image: url("{IMG_ICON_CONTACT_EMAIL_SRC}"); }
.aim-icon, .aim-icon a			{ background-image: url("{IMG_ICON_CONTACT_AIM_SRC}"); }
.yahoo-icon, .yahoo-icon a		{ background-image: url("{IMG_ICON_CONTACT_YAHOO_SRC}"); }
.web-icon, .web-icon a			{ background-image: url("{IMG_ICON_CONTACT_WWW_SRC}"); }
.msnm-icon, .msnm-icon a			{ background-image: url("{IMG_ICON_CONTACT_MSNM_SRC}"); }
.icq-icon, .icq-icon a			{ background-image: url("{IMG_ICON_CONTACT_ICQ_SRC}"); }
.jabber-icon, .jabber-icon a		{ background-image: url("{IMG_ICON_CONTACT_JABBER_SRC}"); }
.pm-icon, .pm-icon a				{ background-image: url("{IMG_ICON_CONTACT_PM_SRC}"); }
.quote-icon, .quote-icon a		{ background-image: url("{IMG_ICON_POST_QUOTE_SRC}"); }*/

/* Moderator icons */
/*.report-icon, .report-icon a		{ background-image: url("{IMG_ICON_POST_REPORT_SRC}"); }
.edit-icon, .edit-icon a			{ background-image: url("{IMG_ICON_POST_EDIT_SRC}"); }
.delete-icon, .delete-icon a		{ background-image: url("{IMG_ICON_POST_DELETE_SRC}"); }
.info-icon, .info-icon a			{ background-image: url("{IMG_ICON_POST_INFO_SRC}"); }
.warn-icon, .warn-icon a			{ background-image: url("{IMG_ICON_USER_WARN_SRC}"); } *//* Need updated warn icon */

/*  	
--------------------------------------------------------------
Colours and backgrounds for cp.css
-------------------------------------------------------------- */

/* Main CP box
----------------------------------------*/

#cp-main h3, #cp-main hr, #cp-menu hr {
	border-color: #D0D0D0;
}

#cp-main .panel li.row {
	border-bottom-color: #B5C1CB;
	border-top-color: #F9F9F9;
}

ul.cplist {
	border-top-color: #B5C1CB;
}

#cp-main .panel li.header dd, #cp-main .panel li.header dt {
	color: #000000;
}

#cp-main table.table1 thead th {
	color: #212121;
	border-bottom-color: #212121;
}

#cp-main .pm-message {
	border-color: #DBDEE2;
	background-color: #FFFFFF;
}

/* CP tabbed menu
----------------------------------------*/
#tabs a {
	background: #FFFFFF;
	border-color: #D0D0D0;
}

#tabs a span {
}

#tabs a:hover span {
	color: #FF530D;
}

#tabs .activetab a {
	background: #f6f6f6;
	border-bottom-color: #555555;
}

#tabs .activetab a span {color: #212121;}
#tabs .activetab a:hover span {color: #000000;}

/* Mini tabbed menu used in MCP
----------------------------------------*/
#minitabs li {background-color: #E1EBF2;}
#minitabs li.activetab {background-color: #F9F9F9;}
#minitabs li.activetab a, #minitabs li.activetab a:hover {color: #212121;}

/* UCP navigation menu
----------------------------------------*/
#navigation {border-right-color: #CCCCCC;}

/* Link styles for the sub-section links */
#navigation a {
	background-color: #FFFFFF;
	background-image: url("{T_THEME_PATH}/images/bg_menu.gif");
	border-color: #D0D0D0;
	color: #212121;
}

#navigation a:hover {
	background-image: none;
	color: #FF530D;
}

#navigation #active-subsection a {
	color: #212121;
	background-color: #D0D0D0;
	background-image: none;
}

/* Preferences pane layout
----------------------------------------*/
#cp-main h2 {color: #999999;}
#cp-main .panel {background-color: #FFFFFF;}
#cp-main .pm {background-color: #FFFFFF;}

#cp-main span.corners-top, #cp-menu span.corners-top {background-image: url("{T_THEME_PATH}/images/corners_left2.gif");}
#cp-main span.corners-top span, #cp-menu span.corners-top span {background-image: url("{T_THEME_PATH}/images/corners_right2.gif");}
#cp-main span.corners-bottom, #cp-menu span.corners-bottom {background-image: url("{T_THEME_PATH}/images/corners_left2.gif");}
#cp-main span.corners-bottom span, #cp-menu span.corners-bottom span {background-image: url("{T_THEME_PATH}/images/corners_right2.gif");}

/* Topicreview */
#topicreview .post {border-color: #D0D0D0;}

/* Friends list */
.cp-mini {background-color: #f6f6f6;}
dl.mini dt {;color: #999999;}
dl.mini dd {border-bottom-color: #CCCCCC}

/* PM Styles
----------------------------------------*/
.pm {border-color: #D0D0D0;}

/* PM Message history */
.current {color: #000000 !important;}

/* PM panel adjustments */
.pm-panel-header,
#cp-main .pm-message-nav {border-bottom-color: #A4B3BF;}

/* PM marking colours */
.pmlist li.pm_message_reported_colour, .pm_message_reported_colour {
	border-left-color: #FF530D;
	border-right-color: #FF530D;
}

.pmlist li.pm_marked_colour, .pm_marked_colour {border-color: #D63600;}
.pmlist li.pm_replied_colour, .pm_replied_colour {border-color: #A9B8C2;}
.pmlist li.pm_friend_colour, .pm_friend_colour {border-color: #5D8FBD;}
.pmlist li.pm_foe_colour, .pm_foe_colour {border-color: #000000;}

/* Avatar gallery */
#gallery label {
	background-color: #FFFFFF;
	border-color: #CCC;
}

#gallery label:hover {
	background-color: #EEE;
}

/*  	
--------------------------------------------------------------
Colours and backgrounds for forms.css
-------------------------------------------------------------- */

/* General form styles
----------------------------------------*/
select {
	border-color: #666666;
	background-color: #FAFAFA;
	color: #000;
}

label {color: #212121;}

option.disabled-option {color: graytext;}

/* Definition list layout for forms
---------------------------------------- */
dd label {color: #212121;}

/* Hover effects */
fieldset dl:hover dt label {}
fieldset.fields2 dl:hover dt label {}

/* Quick-login on index page */
fieldset.quick-login input.inputbox {background-color: #F2F3F3;}

/* Posting page styles
----------------------------------------*/

#message-box textarea {color: #212121;}

/* Input field styles
---------------------------------------- */
.inputbox {
	border-color: #BBBBBB;
	color: #212121;
}

.inputbox:hover {border-color: #000000;}

.inputbox:focus {
	background-color: #FFFFFF;
	/*border-color: #4F8A10;*/
	color: #000000;
}

/* Form button styles
---------------------------------------- */

a.button1 {
	background: #212121 url("{T_THEME_PATH}/images/button3_bg.gif") repeat-x scroll;
	color: #FFFFFF;
}

input.button1 {
	background: #212121 url("{T_THEME_PATH}/images/button3_bg.gif") repeat-x scroll !important;
	color: #FFFFFF;
}

a.button1, input.button1 {
	border-color: #222222;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}

input.button2, input.button3 {background: #C0C0C0 url("{T_THEME_PATH}/images/button_bg3.gif") repeat-x scroll !important;}
input.button3, a.button2, input.button2 {background: #C0C0C0 url("{T_THEME_PATH}/images/button_bg3.gif") repeat-x scroll;}

input.button3, a.button2, input.button2 {
	border-color: #BBBBBB;
	border-width: 1px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	-khtml-border-radius: 3px;
	border-radius: 3px;
}

input.button3 {background-image: none;}

/* Alternative button */
a.button2, input.button2, input.button3 {border-color: #C0C0C0;}

/* <a> button in the style of the form buttons */
a.button1, a.button1:link, a.button1:visited, a.button1:active {color: #FFFFFF;}
a.button2, a.button2:link, a.button2:visited, a.button2:active {color: #212121;}

/* Hover states */
a.button1:hover, input.button1:hover, a.button2:hover, input.button2:hover, input.button3:hover {
	border-color: #606060;
}

input.search {
	background: transparent url("{T_THEME_PATH}/images/search.png") scroll no-repeat 2px 2px;
	padding-left: 20px;
}

input.disabled {color: #666666;}

/* Display topics in viewforum/viewtopic pages */
fieldset.display-options {background: #000000 url("{T_THEME_PATH}/images/gradient_bg3.gif") scroll repeat-x 0 -1px;}
fieldset.display-options a {
	background-color: #000000;
	border-color: #212121;
	color: #ffffff;
}
fieldset.display-options label {color: #FFFFFF;}

/* Widgets
--------------------------------------------- */

/* CSS Dropdown */
.dropdown > span {
	background: #D0D0D0 url("{T_THEME_PATH}/images/button_bg2.gif") scroll repeat-x;
	border: 1px solid #999999;
}

.dropdown ul {
	background: #EEEEEE;
	border-color: #999999;
}

.dropdown ul a:link, .dropdown ul a:visited {
	border-bottom-color: #D0D0D0;
	color: #2D587E;
}

.dropdown ul li a:hover {background: #C9D2D8;}
.dropdown ul li span {background: none;}

/* CSS Tabs */
.tabs ul li a {background: #EEEEEE;}";s:10:"theme_path";s:8:"zerozaku";s:10:"theme_name";s:13:"Zerozaku v2.0";s:11:"theme_mtime";s:10:"1274570094";s:11:"imageset_id";s:1:"5";s:13:"imageset_name";s:13:"Zerozaku v2.0";s:18:"imageset_copyright";s:21:"&copy; 2009 Gio Borje";s:13:"imageset_path";s:8:"zerozaku";s:13:"template_path";s:8:"zerozaku";}}