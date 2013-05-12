<?php

require_once 'db_connect.php';
require_once 'config.php';

function authorize_user($groups = NULL) {
// No cookie? Go to signin page with explanation	
if((!isset($_COOKIE['user_id'])) ||
   (!strlen($_COOKIE['user_id']) > 0)) {
	header('Location: signin.php?error_message=Hey, you should be signed in to see this!');
	exit;
   }

// If no groups passed to a_u
if ((is_null($groups)) || (empty($groups))) {
	return;
}
// SQL string creation
$query_string = "SELECT user_groups.user_id FROM user_groups, groups WHERE groups.name = '%s' " .
"AND groups.id = user_groups.group_id AND user_groups.user_id = " . $_COOKIE['user_id'] . ";";

foreach ($groups as $group) {
// SQL
$query = sprintf($query_string, mysql_real_escape_string($group));
$result = mysql_query($query);

if (mysql_num_rows($result) == 1) {
	// Allowed
	return;
}
}

// If we're here -- error
handle_error("You are not allowed to see this page. Authorization failed.");
exit;

}

function user_in_group($user_id, $group) {
	$query_string = "SELECT user_groups.group_id FROM user_groups, groups" .
	" WHERE groups.name = '%s' AND groups.id = user_groups.group_id AND user_groups.user_id = %d;";
	
	$query = sprintf($query_string, mysql_real_escape_string($group), mysql_real_escape_string($user_id));
	
	$result = mysql_query($query);
	
	if(mysql_num_rows($result) == 1) {
		return TRUE;
	} else {
		return FALSE;
	}
}

?>