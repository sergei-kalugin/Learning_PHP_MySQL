<?php 
	
	require_once 'authorize.php';
	require_once 'db_connect.php';	
	require_once 'config.php';
	
// Authorization
authorize_user(array("admins"));	
	
	if(!isset($_REQUEST['user_id'])) {
		handle_error("No ID specified", "No parameters");
	}
	
	$user_id = $_REQUEST['user_id'];
	
	$query = sprintf("DELETE FROM users WHERE user_id = %d", $user_id);
	mysql_query($query);
	
	$message = "User has been deleted";
	
	header("Location: show_users.php?success_msg={$message}");
	exit();
?>
