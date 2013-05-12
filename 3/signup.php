<?php
require_once 'view.php';

$inline_javascript = <<<EOD
	$(document).ready(function() {
		$("#signup").validate({
	 		rules: {password: {minlength: 6},
					confirm_password: {minlength: 6, equalTo: "#password"}},
			messages: {password: {minlength: "Password should be no shorter then 6 characters"},
					   confirm_password: {minlength: "Password should be no shorter then 6 character", equalTo: "Passwords are different!"}}
		});
	});
EOD;

page_start("Sign Up To M'our Club!", $inline_javascript);
?>
		<div id="example" style="font-size: 28px;">Registration</div>
		<div id="content">
			<p>Enter your data below please:</p>
			<form id="signup" action="create_user.php" method="POST" enctype="multipart/form-data">
				<fieldset>
					<label for="name">Name:</label>
					<input type="text" size="20" name="name" class="required" /></br>
					<!-- Sigh Ups -->
					<label for="username">Select username:</label>
					<input type="text" size="20" name="username" class="required" /></br>
					<label for="password">Select password:</label>
					<input type="password" size="20" name="password" id="password" class="required password" />
					<div class="password-meter">
						<div class="password-meter-message"></div>
						<div class="password-meter-bg">
							<div class="password-meter-bar"></div>
						</div>
					</div><br/>
					<label for="confirm_password">Confirm password</label>
					<input type="password" id="confirm_password" size="20" name="confirm_password" class="required" /></br>
					<!--End of sign-up-->
					<label for="race">Race:</label>
					<input type="text" size="20" name="race"class="required" /></br>
					<label for="sex">Sex:</label>
					<input type="text" size="10" name="sex" /></br>
					<label for="vk">Your VK page:</label>
					<input type="text" size="10" name="vk" /></br>
					<label for="twitter">Twitter:</label>
					<input type="text" size="20" name="twitter" /></br>
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
					<label for="user_image">Upload your avatar here (2 MB max):</label>
					<input type="file" size="30" name="user_image" /></br><br>
					
					<label for="bio">Biography:</label>
					<textarea cols="30" rows="7" name="bio" maxlength="1000"></textarea></br>
				</fieldset>
				<fieldset class="center">
					<input type="submit" value="Join us" />
					<input type="reset" value="Clear all and start over" />
				</fieldset>
			</form>		
		</div>
		<div id="footer"></div>
	</body>
</html>