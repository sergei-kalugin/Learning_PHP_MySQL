<?php

require 'db_connect.php';

$user_id = $_REQUEST['user_id'];

$get_user_query = "SELECT * FROM users WHERE user_id = {$user_id};";
$result = mysql_query($get_user_query)
	or die(mysql_error());

if ($result) {
	$row = mysql_fetch_array($result);
	$name = $row['name'];
	$sex = $row['sex'];
	$race = $row['race'];
	$vk = $row['vk'];
	$twitter = $row['twitter'];
	$bio = preg_replace("/[\r\n]+/", "</p><p>", $row['bio']);
	$user_image = $row['user_image'];
} else {
	die ("Error with ID {$user_id}");
}
?>

<html>
	<head>
		<link type="text/css" href="profile.css" rel="stylesheet"/>
	</head>
	<body>
		<div id="header"><h1>Профиль пользователя</h1></div>
		<div id="example"></div>
		
		<div id="content">
			<div class="user_profile">
				<h1><?php echo "{$name}, {$sex}, {$race}"?></h1>
				<p><img src="<?php echo $user_image?>" class="user_pic" />
					<?php echo "{$bio}"?>
				</p>
				<p class="contact_info">Поддерживайте связь с <?php echo "{$name}"?>:</p>
				<ul>
					<li>...
						<a href="<?php echo $vk?>">В Контакте</a>
					</li>
					<li>...
						<a href="<?php echo $twitter?>">В Твиттере</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="footer">
		</div>
	</body>
</html>