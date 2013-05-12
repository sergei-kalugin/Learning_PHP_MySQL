<?php 
	require_once 'db_connect.php';	
	
	mysql_connect(DB_HOST, USERNAME, PASSWORD)
		or handle_error("Error occured. I can't connect to the database.", mysql_error());
?>