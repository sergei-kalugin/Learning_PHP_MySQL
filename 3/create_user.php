<?php 
	
	require_once'config.php';
	require_once 'db_connect.php';	
	
	$upload_dir = SITE_ROOT . "uploads/profile_pics/";
	$image_fieldname = "user_image";
	
	// File upload errors:
	$php_errors = array(1 => 'File size is more than in php.ini', 
						2 => 'File size is more than in HTML',
						3 => 'Just part of file was uploaded',
						4 => 'File for upload was not specified');
	
	// Getting stuff from the form
	$name = trim($_REQUEST['name']);
	$race = trim($_REQUEST['race']);	
	$twitter = trim($_REQUEST['twitter']);
	$vk = trim($_REQUEST['vk']);	
	$sex = trim($_REQUEST['sex']);
	$vk_full = preg_match("/vk.com/i", $vk);
	$bio = trim($_REQUEST['bio']);
	$username = trim($_REQUEST['username']);
	$password = trim($_REQUEST['password']);
	
	// Check image upload errors
	($_FILES[$image_fieldname]['error'] == 0)
		or handle_error("Server can't accept your image, sorry.", $php_errors[$_FILES[$image_fieldname]['error']]);
		
	// Check name (is it a normal upload?)
	@is_uploaded_file($_FILES[$image_fieldname]['tmp_name'])
		or handle_error("What a shame! Screw you!", "They tried to upload file named {$_FILES[$image_fieldname]['tmp_name']}");
	
	// Is it an image?
	@getimagesize($_FILES[$image_fieldname]['tmp_name'])
		or handle_error( "You tried to upload non-image file", "{$_FILES[$image_fieldname]['tmp_name']} is NOT an image!");
	
	// Unique name for the imagefile
	$now = time();
	while(file_exists($upload_filename = $upload_dir . $now . '-' . $_FILES[$image_fieldname]['name'])) {
		$now++;
	}
	
	// Move file from temp to our folder
	move_uploaded_file($_FILES[$image_fieldname]['tmp_name'], $upload_filename)
		or handle_error("There is a problem with saving your image. Sorry.", "Priveleges don't allow to upload file to {$upload_filename}");
	
	
	
	
	if (!$vk_full) {
		$vk = "http://vk.com/" . $vk;}
		
	if (!strpos($twitter, "@")) {
		$twitter_url = "http://twitter.com/" . $twitter;
		}
	
	else {$twitter_url = "http://twitter.com/" . substr($twitter,strpos($twitter, "@") + 1);
		}
	
	$insert_sql = sprintf("INSERT INTO users (name, username, password, vk, twitter, race, sex, bio, user_image) " .
	"VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
	mysql_real_escape_string($name),
	mysql_real_escape_string($username),
	mysql_real_escape_string(crypt($password, $username)),
	mysql_real_escape_string($vk),
	mysql_real_escape_string($twitter),
	mysql_real_escape_string($race),
	mysql_real_escape_string($sex),
	mysql_real_escape_string($bio),
	mysql_real_escape_string($upload_filename));
	
	mysql_query($insert_sql)
	or handle_error("Error occured. I can't insert data to the database.", mysql_error());	
	
	header("Location: show_user.php?user_id=" . mysql_insert_id());
	exit();
	?>