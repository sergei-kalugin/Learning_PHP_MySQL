<?php 
	
	require_once 'db_connect.php';	
	
	$name = trim($_REQUEST['name']);
	$race = trim($_REQUEST['race']);	
	$twitter = trim($_REQUEST['twitter']);
	$vk = trim($_REQUEST['vk']);	
	$sex = trim($_REQUEST['sex']);
	$vk_full = preg_match("/vk.com/i", $vk);
	$bio = trim($_REQUEST['bio']);
	$user_image = trim($_REQUEST['user_image']);
	
	
	if (!$vk_full) {
		$vk = "http://vk.com/" . $vk;}
		
	if (!strpos($twitter, "@")) {
		$twitter_url = "http://twitter.com/" . $twitter;
		}
	
	else {$twitter_url = "http://twitter.com/" . substr($twitter,strpos($twitter, "@") + 1);
		}
	
	$insert_sql = "INSERT INTO users (name, vk, twitter, race, sex000, bio, user_image) " .
	"VALUES ('{$name}', '{$vk}', '{$twitter_url}', '{$race}', '{$sex}', '{$bio}', '{$user_image}');";
	
	mysql_query($insert_sql)
	or handle_error("Error occured. I can't insert data to the database.", mysql_error());	
	
	header("Location: show_user.php?user_id=" . mysql_insert_id());
	exit();
	?>