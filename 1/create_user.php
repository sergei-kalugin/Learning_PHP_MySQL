<html>
	<?php 
	
	require ("db_connect.php");	
	
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
		
	if (strpos($twitter, "@") === false) {
		$twitter_url = "http://twitter.com/" . $twitter;
		}
	
	else {$twitter_url = "http://twitter.com/" . substr($twitter,strpos($twitter, "@") + 1);
		}
	
	$insert_sql = "INSERT INTO users (name, vk, twitter, race, sex, bio, user_image) " .
	"VALUES ('{$name}', '{$vk}', '{$twitter_url}', '{$race}', '{$sex}', '{$bio}', '{$user_image}');";
	
	mysql_query($insert_sql)
	or die(mysql_error());
	
	header("Location: show_user.php?user_id=" . mysql_insert_id());
	exit();
	?>	
	
	<head>
		<link href="style.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div id="header"><h1>Your data</h1></div>
		<div id="example">You have entered:</div>
		<div id="content">
		
		<p>Name: <?php echo $name?></p>
		<p>VK: <a href="<?php echo $vk;?>">Зайти ВКонтакт</a>	</p>
		<p>Twitter: <a href="<?php echo $twitter_url;?>">Проверить мой Твиттер</a></p>
		<p>Sex: <?php echo $sex;?></p>
		<p>Race: <?php echo $race;?></p>
			
		</div>
	</body>
</html>