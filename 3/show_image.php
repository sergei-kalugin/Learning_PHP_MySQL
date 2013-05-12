<?php

require_once 'config.php';
require_once 'db_connect.php';

try {
if (!isset($_REQUEST['image_id'])) {
	handle_error("No image for upload!");
}

$image_id = $_REQUEST['image_id'];

$select_query = sprintf("SELECT * FROM images WHERE image_id = %d;", $image_id);

$result = mysql_query($select_query);

if (mysql_num_rows($result) == 0) {
	handle_error("We can not find your pic", "Pic with the id {$image_id} wasn't found.");
}

$image = mysql_fetch_array($result);

// Tell browser what to expect:
header('Content-type: ' . $image['mime_type']);
header('Content-length: ' . $image['file_size']);

echo $image['image_data'];
} catch (Exception $exc) {
	handle_error("Error while uploading image. Retry please.", "System error: " . $exc->getMessage());
}

?> 