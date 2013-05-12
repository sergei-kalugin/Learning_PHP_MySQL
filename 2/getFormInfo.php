<html>
	<?php 
	
	require ("db_connect.php");	
	
	$name = trim($_REQUEST['name']);
	$race = trim($_REQUEST['race']);	
	$twitter = trim($_REQUEST['twitter']);
	$vk = trim($_REQUEST['vk']);	
	$sex = trim($_REQUEST['sex']);
	$position = strpos($vk, "vk.com");
	
	
	if ($position === false) {
		$vk = "http://vk.com/" . $vk;}
		
	if (strpos($twitter, "@") === false) {
		$twitter_url = "http://twitter.com/" . $twitter;
		}
	
	else {$twitter_url = "http://twitter.com/" . substr($twitter,strpos($twitter, "@") + 1);
		}
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