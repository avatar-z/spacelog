<?php require_once('/Connections/spacelog.php'); ?>

<?php
$GEN['year'] = "2016";
$GEN['month'] = "9";
$GEN['day'] = "30";
/*
$_POST['uid'] = "2016";
$_POST['start'] = "2016";
$_POST['end'] = "2016";
$_POST['stamp'] = "2016";
$_POST['event'] = "2016";
$_POST['status'] = "2016";
*/
?>

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_insert")) {
  $insertSQL = sprintf("INSERT INTO sl_list (eid, `uid`, `start`, `end`, stamp, event, status, year, month, day) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['eid'], "int"),
                       GetSQLValueString($_POST['uid'], "int"),
                       GetSQLValueString($_POST['start'], "text"),
                       GetSQLValueString($_POST['end'], "text"),
                       GetSQLValueString($_POST['stamp'], "text"),
                       GetSQLValueString($_POST['event'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($GEN['year'], "text"),
                       GetSQLValueString($GEN['month'], "text"),
                       GetSQLValueString($GEN['day'], "text"));

  mysql_select_db($database_spacelog, $spacelog);
  $Result1 = mysql_query($insertSQL, $spacelog) or die(mysql_error());
}

mysql_select_db($database_spacelog, $spacelog);
$query_RS_SL_INSERT_E = "SELECT * FROM sl_list";
$RS_SL_INSERT_E = mysql_query($query_RS_SL_INSERT_E, $spacelog) or die(mysql_error());
$row_RS_SL_INSERT_E = mysql_fetch_assoc($RS_SL_INSERT_E);
$totalRows_RS_SL_INSERT_E = mysql_num_rows($RS_SL_INSERT_E);
?>
<!doctype php>
<html>
<head>
<meta charset="utf-8">
<title>E's space log - unit insert</title>
</head>
<?php
require_once("/Functions/func_gen.php");
?>
<body>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form_insert">
<table width="300" border="0">
  <tbody>
    <tr>
      <td>eid</td>
      <td><input name="eid" id="eid" type="text"/></td>
    </tr>
    <tr>
      <td>start</td>
      <td><input name="start" id="start" type="text"/></td>
    </tr>
    <tr>
      <td>end</td>
      <td><input name="end" id="end" type="text"/></td>
    </tr>
    <tr>
      <td>event</td>
      <td><input name="event" id="event" type="text"/></td>
    </tr>
    <tr>
      <td>status</td>
      <td><input name="status" id="status" type="text"/></td>
    </tr>
    <tr>
      <td>stamp</td>
      <td><input name="stamp" id="stamp" type="text"/></td>
    </tr>
    <tr>
      <td>uid</td>
      <td><input name="uid" id="uid" type="text"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="submit" id="submit" type="submit" value="Submit"</td>
    </tr>
  </tbody>
</table>
<input type="hidden" name="MM_insert" value="form_insert">
</form>
</body>
</html>
<?php
mysql_free_result($RS_SL_INSERT_E);
?>
