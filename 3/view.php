<?php

require_once 'config.php';
require_once 'authorize.php';

// Message constants
define("SUCCESS_MESSAGE", "success");
define("ERROR_MESSAGE", "error");
define("FOOTER_TEXT", "Serge and Eve, 2011-2013");

// Messages functions
function display_message($msg, $msg_type) {
	echo "<div class='{$msg_type}'>\n";
	echo "<p>{$msg}</p>\n";
	echo "</div>\n";
}


function display_messages($success_msg = NULL, $error_msg = NULL) {
	echo "<div id='messages'>\n";
	if(!is_null($success_msg) && (strlen($success_msg) > 0)) {
	display_message($success_msg, SUCCESS_MESSAGE);
	}
	if(!is_null($error_msg) && (strlen($error_msg) > 0)) {
		display_message($error_msg, ERROR_MESSAGE);
	}
	echo "</div>\n\n";
}

function display_head($page_title = "", $embedded_javascript = NULL) {
	echo <<<EOD
	<html>
		<head>
			<title>{$page_title}</title>
			<link href='style.css' rel='stylesheet' type='text/css' />
			<link href='profile.css' rel='stylesheet' type='text/css' />
			<link href="jquery.validate.password.css" type="text/css" rel="stylesheet" />
		
			<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
			<script type="text/javascript" src="js/jquery.validate.js"></script>
			<script type="text/javascript" src="js/jquery.validate.password.js"></script>
			
EOD;
	if (!is_null($embedded_javascript)) {
		echo "<script type='text/javascript'>{$embedded_javascript}</script>";
	}
	echo " </head>";
}

function display_header($title, $success_msg = NULL, $error_msg = NULL) {
	echo <<<EOD
	<body>
		<div id="header"><h1>$title</h1></div>
		<div id="menu">
			<ul>
				<li><a href="index.html">HOMEPAGE</a></li>
EOD;

if(isset($_COOKIE['user_id'])) {
		
	$qwerty = user_in_group($_COOKIE['user_id'], "users");
	
	echo ("<li><a href='show_user.php?user_id=" . $_COOKIE['user_id'] . "'>My Profile</a></li>");
	if(user_in_group($_COOKIE['user_id'], 'admins')) {
		echo "<li><a href='show_users.php'>Management</a></li>";
	}
	echo "<li><a href='signout.php'>Sign me out</a></li>";
} else {
	echo "<li><a href='signin.php'>Sign in</a></li>";
}
	echo <<<EOD
</ul>
</div>
EOD;
	display_messages($success_msg, $error_msg);
	}

function page_start($title, $javascript = NULL, $success_message = NULL, $error_message = NULL) {
	display_head($title, $javascript);
	display_header($title, $success_message, $error_message);
}

function display_footer($footer_text) {
	echo <<<EOD
	<hr><div id="footer">$footer_text</div>
EOD;
}

?>