<?php require_once('/Connections/spacelog.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_edit")) {
  $updateSQL = sprintf("UPDATE sl_list SET `uid`=%s, `year`=%s, `month`=%s, `day`=%s, `start`=%s, `end`=%s, stamp=%s, event=%s, status=%s WHERE eid=%s",
                       GetSQLValueString($_POST['uid'], "int"),
                       GetSQLValueString($_POST['year'], "text"),
                       GetSQLValueString($_POST['month'], "text"),
                       GetSQLValueString($_POST['day'], "text"),
                       GetSQLValueString($_POST['start'], "text"),
                       GetSQLValueString($_POST['end'], "text"),
                       GetSQLValueString($_POST['stamp'], "text"),
                       GetSQLValueString($_POST['event'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['eid'], "int"));

  mysql_select_db($database_spacelog, $spacelog);
  $Result1 = mysql_query($updateSQL, $spacelog) or die(mysql_error());
}

$colname_RS_SL_EDIT_E = "-1";
if (isset($_GET['eid'])) {
  $colname_RS_SL_EDIT_E = $_GET['eid'];
}
mysql_select_db($database_spacelog, $spacelog);
$query_RS_SL_EDIT_E = sprintf("SELECT * FROM sl_list WHERE eid = %s", GetSQLValueString($colname_RS_SL_EDIT_E, "int"));
$RS_SL_EDIT_E = mysql_query($query_RS_SL_EDIT_E, $spacelog) or die(mysql_error());
$row_RS_SL_EDIT_E = mysql_fetch_assoc($RS_SL_EDIT_E);
$totalRows_RS_SL_EDIT_E = mysql_num_rows($RS_SL_EDIT_E);
?>
<!doctype php>
<html>
<head>
<meta charset="utf-8">
<title>E's space log - unit edit</title>
</head>
<body>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form_edit">
<table width="300" border="0">
  <tbody>
    <tr>
      <td>eid</td>
      <td><input name="eid" id="eid" value="<?php echo $row_RS_SL_EDIT_E['eid']; ?>"/></td>
    </tr>
    <tr>
      <td>start</td>
      <td><input name="start" id="start" value="<?php echo $row_RS_SL_EDIT_E['start']; ?>"/></td>
    </tr>
    <tr>
      <td>end</td>
      <td><input name="end" id="end" value="<?php echo $row_RS_SL_EDIT_E['end']; ?>"/></td>
    </tr>
    <tr>
      <td>event</td>
      <td><input name="event" id="event" value="<?php echo $row_RS_SL_EDIT_E['event']; ?>"/></td>
    </tr>
    <tr>
      <td>status</td>
      <td><input name="status" id="status" value="<?php echo $row_RS_SL_EDIT_E['status']; ?>"/></td>
    </tr>
    <tr>
      <td>stamp</td>
      <td><input name="stamp" id="stamp" value="<?php echo $row_RS_SL_EDIT_E['stamp']; ?>"/></td>
    </tr>
    <tr>
      <td>year</td>
      <td><input name="year" id="year" value="<?php echo $row_RS_SL_EDIT_E['year']; ?>"/></td>
    </tr>
    <tr>
      <td>month</td>
      <td><input name="month" id="month" value="<?php echo $row_RS_SL_EDIT_E['month']; ?>"/></td>
    </tr>
    <tr>
      <td>day</td>
      <td><input name="day" id="day" value="<?php echo $row_RS_SL_EDIT_E['day']; ?>"/></td>
    </tr>
    <tr>
      <td>uid</td>
      <td><input name="uid" id="uid" value="<?php echo $row_RS_SL_EDIT_E['uid']; ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
      	<input type="submit" value="更新"/>
        <input type="reset" value="重置"/>
      </td>
    </tr>
  </tbody>
</table>
<input type="hidden" name="MM_update" value="form_edit">
</form>
</body>
</html>
<?php
mysql_free_result($RS_SL_EDIT_E);
?>
