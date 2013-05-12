<html>
	
<?php

require_once('config.php');	

	if (isset($_REQUEST['error_message'])) {
	$error_message = preg_replace("/\\\\/", '', $_REQUEST['error_message']);
	} else {
		$error_message = "You're here because application has crashed. Sorry.";
	}
	
	if (isset($_REQUEST['system_error_message'])) {
		$system_error_message = preg_replace("/\\\\/", '', $_REQUEST['system_error_message']);
	} else {
		$system_error_message = "No system error messages! :-)";
	}
?>
	
    <head>
    	
    </head>
    <body>
     <div id="header"><h1>Error Page</h1></div>
     <div id="content">
       <p>Ошибка: <b><?php echo $error_message;?></b></p>
       <p>You may want <a href="mailto:kalugin.serge@gmail.com">to contact us.</a> or to 
       	get back to the previous page by clicking <a href="javascript:history.go(-1)">here</a>.</p>
       	
    <?php
    	debug_print("<hr color='green'/");
		debug_print("<p>System error was found: <b>{$system_error_message}</b></p>");
    ?>   	
       	
	</div>
     <div id="footer"></div>
    </body>
</html>