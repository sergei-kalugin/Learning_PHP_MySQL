<html>
	<?php 
	
	require ("db_connect.php");	
	
	$name = trim($_REQUEST['name']);
	$race = trim($_REQUEST['race']);	
	$twitter = trim($_REQUEST['twitter']);
	$vk = trim($_REQUEST['vk']);	
	$sex = trim($_REQUEST['sex']);
	$vk_full = preg_match("/vk.com/i", $vk);
	
	
	if (!$vk_full) {
		$vk = "http://vk.com/" . $vk;}
		
	if (strpos($twitter, "@") === false) {
		$twitter_url = "http://twitter.com/" . $twitter;
		}
	
	else {$twitter_url = "http://twitter.com/" . substr($twitter,strpos($twitter, "@") + 1);
		}
	
	$insert_sql = "INSERT INTO users (name, vk, twitter, race, sex) " .
	"VALUES ('{$name}', '{$vk}', '{$twitter_url}', '{$race}', '{$sex}');";
	
	mysql_query($insert_sql)
	or die(mysql_error());
	
	$get_user_query = "SELECT * FROM users WHERE vk='{$vk}'";
	mysql_query($get_user_query)
	or die(mysql_error());
	
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
		
		<?php
		var_dump($vk);
		?>
			
		</div>
	</body>
</html>