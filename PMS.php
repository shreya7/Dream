<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_PMS = "localhost";
$database_PMS = "pcar";
$username_PMS = "root";
$password_PMS = "";
$PMS = mysql_pconnect($hostname_PMS, $username_PMS, $password_PMS) or trigger_error(mysql_error(),E_USER_ERROR); 
?>