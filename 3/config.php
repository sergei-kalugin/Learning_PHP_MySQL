<?php

define("DB_HOST", "localhost");
define("USERNAME", "serge");
define("PASSWORD", "serge");
define("DB_NAME", "serge");
define("DEBUG_MODE", TRUE);
define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT'] . "/php-learn/3/");





if(DEBUG_MODE) {
	error_reporting(E_ERROR);
	} else {
		error_reporting(0);
	}

function debug_print($message) {
	if (DEBUG_MODE) {
		echo $message;	
	}
}

function handle_error ($user_error_message, $system_error_message) {
	header("Location: " . get_web_path(SITE_ROOT) . "show_error.php?error_message={$user_error_message}&system_error_message={$system_error_message}");
	exit();
}

// Get web path:
function get_web_path ($file_system_path) {
	return str_replace($_SERVER['DOCUMENT_ROOT'], '', $file_system_path);
}

















?>