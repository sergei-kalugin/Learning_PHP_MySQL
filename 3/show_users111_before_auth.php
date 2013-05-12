<?php

require_once 'config.php';
require_once 'db_connect.php';
require_once 'view.php';

header('HTTP/1.1 401 Unauthorized');
header('WWW-Authenticate: Basic realm="The Social Site"');

$select_users = "SELECT user_id, name, sex, vk, user_image FROM users;";

$result = mysql_query($select_users);

$order = 1;

?>

<?php $delete_user_script = <<<EOD
	function deleteUser (userID) {
		  if (confirm("Are you sure about that? Data will be lost!")) {
		  	window.location = "delete_user.php?user_id=" + userID;
		  }
		}
EOD;
	page_start("Current Users of My Project", $delete_user_script, $_REQUEST['success_message'], $_REQUEST['error_message']);
?>
		<div id="content">
			<ul style="list-style: none; font-size: 18px; width: 400px; background: #ccc; padding: 10px; margin: 20px 25px; box-shadow: 1px 1px 10px #444; border-radius: 5px;">
				<?php
				while($user = mysql_fetch_array($result)) {
				$user_row = sprintf(
				"<li>%d. <img src='%s' width='60'/>&nbsp&nbsp<a href='show_user.php?user_id=%d'>%s</a>  |   " .
				"(<a href='http://vk.com/%s'>VK of %s</a>)  |" . 
				"  Delete user: <a href='javascript:deleteUser(%d)'><img class='delete' src='delete.png' width='10' /></a></li><hr>",
	 			// Variables 
				$order ,get_web_path($user['user_image']), $user['user_id'], $user['name'], $user['vk'], $user['name'], $user['user_id']);
				echo $user_row;
				
				$order++;
			}
				?>
			</ul>	
		</div>	
		<?php display_footer(FOOTER_TEXT); ?>
	</body>
</html>