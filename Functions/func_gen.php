<?php
require_once("/Connections/spacelog.php");
?>
<?php
$sl_eid = -2;
$sl_uid = -2;
$sl_date = "default";
$sl_stamp = "default";
$sl_status = "default";

$db_spacelog = new mysqli($hostname_spacelog, $username_spacelog, $password_spacelog, $database_spacelog);

$query['eid'] = "SELECT e_count FROM spacelog.sl_global WHERE gid = 0";
$result = $db_spacelog->query($query['eid'], MYSQLI_STORE_RESULT);
list($gen1) = $result->fetch_row();
$sl_eid = $gen1;
	
$query['uid'] = "SELECT u_count FROM spacelog.sl_global WHERE gid = 0";
$result = $db_spacelog->query($query['uid'], MYSQLI_STORE_RESULT);
list($gen2) = $result->fetch_row();
$sl_uid = $gen1;

$sl_date = date('Y-m-d');
$sl_stamp = time();
$sl_status = "STA_ONGOING";
?>