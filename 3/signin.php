<?php

require_once 'db_connect.php';
require_once 'view.php';

$error_message = $_REQUEST['error_message'];

// I STOPPED HERE
session_start();

if(!isset($_COOKIE['user_id'])) {
	
	if(isset($_POST['username'])) {
		$username = mysql_real_escape_string(trim($_REQUEST['username']));
		$password = mysql_real_escape_string(trim($_REQUEST['password']));
// Looking for a user
	$query = sprintf("SELECT user_id, username FROM users WHERE username ='%s' AND password = '%s';",
	$username, crypt($password, $username));
	$results = mysql_query($query);
	
	if(mysql_num_rows($results) == 1) {
		$result = mysql_fetch_array($results);
		$user_id = $result['user_id'];
		setcookie('user_id', $user_id);
		setcookie('username', $username);
		header("Location: show_user.php?user_id=" . $user_id);
	} else {
		$error_message = "Wrong login/password combination, try again";
		
	}
}
// Not registerd, just show the form
page_start("Registration", NULL, NULL, $error_message);
?>

<html>
	<div id="content">
		<h1>Login here, user!</h1>
		<form method="POST" id="signin_form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset style="background: #bbb; width: 450px;">
				<label for="username">Name of the user:</label>
				<input name="username" id="username" type="text" size="20" value="<?php echo $username;?>" /><br/>
				<label for="password">Your password</label>
				<input type="password" name="password" id="password" size="20" />
			</fieldset>
			<fieldset style="width: 450px; text-align: center;">
				<input type="submit"value="Sign in"  />
			</fieldset>
		</form>
	</div>
</html>

<?php
} else {
	header("Location: show_user.php?user_id=" . $_COOKIE['user_id']);
}

?>