<?php

require_once 'authorize.php';
require_once 'db_connect.php';
require_once 'view.php';

// Authorization
authorize_user(array("users"));

$user_id = $_REQUEST['user_id'];

$get_user_query = sprintf("SELECT * FROM users WHERE user_id = %d;", $user_id);
$result = mysql_query($get_user_query)
	or handle_error("I can't select specified user, sorry.", "User with the id {$user_id} can not be bound in table.");

if ($result) {
	$row = mysql_fetch_array($result);
	$name = $row['name'];
	$sex = $row['sex'];
	$race = $row['race'];
	$vk = $row['vk'];
	$twitter = $row['twitter'];
	$bio = preg_replace("/[\r\n]+/", "</p><p>", $row['bio']);
	$user_image = get_web_path($row['user_image']);
} else {
	handle_error("There's a problem with finding your data", "I can not find user with ID {$user_id}" );
}

page_start("User Profile");
?>	
		<div id="content">
			<div class="user_profile">
				<h1><?php echo "{$name}, {$sex}, {$race}"?></h1>
				<p><img src="<?php echo $user_image;?>" class="user_pic" />
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
				<div id="example"><a href="show_users.php" style="color: #222; font-size: 18px; font-family: Georgia;">SEE ALL USERS</a></div>
		<?php display_footer(FOOTER_TEXT); ?>
	</body>
</html>