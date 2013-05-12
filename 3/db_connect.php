<?php
   require_once 'config.php';
   
   mysql_connect(DB_HOST, USERNAME, PASSWORD)
   or handle_error("возникла проблема, связанная с подключением к базе данных, " .
                      "содержащей нужную информацию.", mysql_error());
     
   mysql_select_db(DB_NAME)
   or handle_error("возникла проблема с конфигурацией нашей базы данных.", mysql_error());
?>