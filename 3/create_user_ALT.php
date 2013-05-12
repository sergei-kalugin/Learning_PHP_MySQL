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
	
	if (!$vk_full) {
		$vk = "http://vk.com/" . $vk;}
		
	if (!strpos($twitter, "@")) {
		$twitter_url = "http://twitter.com/" . $twitter;
		}
	
	else {$twitter_url = "http://twitter.com/" . substr($twitter,strpos($twitter, "@") + 1);
		}
	
	// Insert image data
	$image = $_FILES[$image_fieldname];
	$image_filename = $image['name'];
	$image_info = getimagesize($image['tmp_name']);
	$image_mime_type = $image_info['mime'];
	$image_size = $image['size'];
	$image_data = file_get_contents($image['tmp_name']);
	
	$insert_image_sql = sprintf("INSERT INTO images " .
										"(filename, mime_type, file_size, image_data) " . 
										"VALUES ('%s', '%s', '%d', '%s');",
										mysql_real_escape_string($image_filename),
										mysql_real_escape_string($image_mime_type),
										mysql_real_escape_string($image_size),
										mysql_real_escape_string($image_data));
	
	mysql_query($insert_image_sql);
	
	$profile_pic_id = mysql_insert_id();
	//
	
	// Insert user data
	$insert_sql = sprintf("INSERT INTO users (name, vk, twitter, race, sex, bio, profile_pic_id) " .
	"VALUES ('%s', '%s', '%s', '%s', '%s', '%s', %d);",
	mysql_real_escape_string($name),
	mysql_real_escape_string($vk),
	mysql_real_escape_string($twitter),
	mysql_real_escape_string($race),
	mysql_real_escape_string($sex),
	mysql_real_escape_string($bio),
	mysql_real_escape_string($profile_pic_id));
	
	mysql_query($insert_sql)
	or handle_error("Error occured. I can't insert data to the database.", mysql_error());
	//
	
	
	// Redirect to profile page
	header("Location: show_user.php?user_id=" . mysql_insert_id());
	exit();

	?>