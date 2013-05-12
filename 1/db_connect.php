
	
<?php

require("config.php");

mysql_connect(DB_HOST, USERNAME, PASSWORD)
or die("<p>Can't connect to MySQL, sorry!</p><p>The error is: " . mysql_error() . "</p>");
echo "Connected to MySQL! ";

mysql_select_db(DB_NAME)
or die("<p>Can't find database, sorry!</p><p>The error is: " . mysql_error() . "</p>");
echo "And also connected to database: <b>" . DB_NAME . ".</b>";
?>