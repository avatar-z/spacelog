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

$colname_RS_SL_SEARCH_E = "-1";
if (isset($_GET['eid'])) {
  $colname_RS_SL_SEARCH_E = $_GET['eid'];
}
mysql_select_db($database_spacelog, $spacelog);
$query_RS_SL_SEARCH_E = sprintf("SELECT * FROM sl_list WHERE eid = %s", GetSQLValueString($colname_RS_SL_SEARCH_E, "int"));
$RS_SL_SEARCH_E = mysql_query($query_RS_SL_SEARCH_E, $spacelog) or die(mysql_error());
$row_RS_SL_SEARCH_E = mysql_fetch_assoc($RS_SL_SEARCH_E);
$totalRows_RS_SL_SEARCH_E = mysql_num_rows($RS_SL_SEARCH_E);
?>
<!doctype php>
<html>
<head>
<meta charset="utf-8">
<title>E's space log - unit search</title>
</head>
<body>
<form method="GET" name="form_search">
<table width="300" border="0">
  <tbody>
    <tr>
      <td>search by eid</td>
      <td><input name="eid" id="eid" type="text"/></td>
    </tr>
    <tr>
      <td></td>
      <td><input name="submit" id="submit" type="submit" value="search"/></td>
    </tr>
  </tbody>
</table>
</form>
<table width="300" border="0">
  <tbody>
    <tr>
      <td>eid</td>
      <td><?php echo $row_RS_SL_SEARCH_E['eid']; ?></td>
    </tr>
    <tr>
      <td>start</td>
      <td><?php echo $row_RS_SL_SEARCH_E['start']; ?></td>
    </tr>
    <tr>
      <td>end</td>
      <td><?php echo $row_RS_SL_SEARCH_E['end']; ?></td>
    </tr>
    <tr>
      <td>event</td>
      <td><?php echo $row_RS_SL_SEARCH_E['event']; ?></td>
    </tr>
    <tr>
      <td>status</td>
      <td><?php echo $row_RS_SL_SEARCH_E['status']; ?></td>
    </tr>
    <tr>
      <td>stamp</td>
      <td><?php echo $row_RS_SL_SEARCH_E['stamp']; ?></td>
    </tr>
    <tr>
      <td>uid</td>
      <td><?php echo $row_RS_SL_SEARCH_E['uid']; ?></td>
    </tr>
  </tbody>
</table>
</body>
</html>
<?php
mysql_free_result($RS_SL_SEARCH_E);
?>
