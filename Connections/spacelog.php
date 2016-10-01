<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_spacelog = "localhost:3306";
$database_spacelog = "spacelog";
$username_spacelog = "root";
$password_spacelog = "kzy229lu";
$spacelog = mysql_pconnect($hostname_spacelog, $username_spacelog, $password_spacelog) or trigger_error(mysql_error(),E_USER_ERROR); 
?>