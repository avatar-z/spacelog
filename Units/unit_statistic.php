<?php require_once('Connections/spacelog.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_spacelog, $spacelog);
$query_RS_SL_STATISTIC_G = "SELECT * FROM sl_global";
$RS_SL_STATISTIC_G = mysql_query($query_RS_SL_STATISTIC_G, $spacelog) or die(mysql_error());
$row_RS_SL_STATISTIC_G = mysql_fetch_assoc($RS_SL_STATISTIC_G);
$totalRows_RS_SL_STATISTIC_G = mysql_num_rows($RS_SL_STATISTIC_G);

mysql_select_db($database_spacelog, $spacelog);
$query_RS_SL_STATISTIC_U = "SELECT * FROM sl_profile";
$RS_SL_STATISTIC_U = mysql_query($query_RS_SL_STATISTIC_U, $spacelog) or die(mysql_error());
$row_RS_SL_STATISTIC_U = mysql_fetch_assoc($RS_SL_STATISTIC_U);
$totalRows_RS_SL_STATISTIC_U = mysql_num_rows($RS_SL_STATISTIC_U);

mysql_select_db($database_spacelog, $spacelog);
$query_RS_SL_STATISTIC_E = "SELECT * FROM sl_list";
$RS_SL_STATISTIC_E = mysql_query($query_RS_SL_STATISTIC_E, $spacelog) or die(mysql_error());
$row_RS_SL_STATISTIC_E = mysql_fetch_assoc($RS_SL_STATISTIC_E);
$totalRows_RS_SL_STATISTIC_E = mysql_num_rows($RS_SL_STATISTIC_E);

//first time
$query_get_first_time = "SELECT stamp FROM sl_list WHERE eid = 0";
$get_first_time = mysql_query($query_get_first_time, $spacelog) or die(mysql_error());
$first_time = mysql_fetch_assoc($get_first_time);

//last time
$id_last = $totalRows_RS_SL_STATISTIC_E - 1;
$query_get_last_time = sprintf("SELECT stamp FROM sl_list WHERE eid = %d", $id_last);
$get_last_time = mysql_query($query_get_last_time, $spacelog) or die(mysql_error());
$last_time = mysql_fetch_assoc($get_last_time);
?>
<!doctype php>
<html>
<head>
<meta charset="utf-8">
<title>E's space log - unit statistic</title>
</head>
<body>
<form method="POST" name="form_statistic">
<table width="300" border="0">
  <tbody>
    <tr>
      <td>users</td>
      <td><?php echo $row_RS_SL_STATISTIC_G['u_count']; ?></td>
    </tr>
    <tr>
      <td>events</td>
      <td><?php echo $row_RS_SL_STATISTIC_G['e_count']; ?></td>
    </tr>
    <tr>
      <td>current user</td>
      <td>
	  <?php 
	  	$default_user = "guest";
	  	if($_COOKIE['sl_access'] == "ACCESS_GRANTED"){
			echo $_COOKIE['sl_account'];
		}
		else echo $default_user;
	  ?>
      </td>
    </tr>
    <tr>
      <td>first time</td>
      <td><?php echo $first_time['stamp']; ?></td>
    </tr>
    <tr>
      <td>last time</td>
      <td><?php echo $last_time['stamp']; ?></td>
    </tr>
  </tbody>
</table>
</form>
</body>
</html>
<?php
mysql_free_result($RS_SL_STATISTIC_G);

mysql_free_result($RS_SL_STATISTIC_U);

mysql_free_result($RS_SL_STATISTIC_E);
?>
