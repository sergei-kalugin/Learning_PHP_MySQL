<?php

require_once('config.php');

echo "Hello, {$name}\n\n";
$query = "SELECT * FROM users WHERE name = {$name}";
echo "{$query}\n\n";

?>