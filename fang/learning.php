<?php

//require '../../scripts/database_connection.php';

$user_id = $_REQUEST['user_id'];

$select_query = "SELECT * FROM users WHERE user_id = " . $user_id;

$result = mysql_query($select_query);

phpinfo()

?>

<html>
Hello!
</html>