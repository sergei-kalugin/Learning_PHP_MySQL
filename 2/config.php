<?php

define("DB_HOST", "localhost");
define("USERNAME", "serge");
define("PASSWORD", "serge");
define("DB_NAME", "serge");
define("DEBUG_MODE", TRUE);
define("SITE_ROOT", "/php-learn/form2/");


if(DEBUG_MODE) {
	error_reporting(E_ALL);
	} else {
		error_reporting(0);
	}

function debug_print($message) {
	if (DEBUG_MODE) {
		echo $message;	
	}
}

function handle_error ($user_error_message, $system_error_message) {
	header("Location: " . SITE_ROOT . "show_error.php?error_message={$user_error_message}&system_error_message={$system_error_message}");
	exit();
}

?>