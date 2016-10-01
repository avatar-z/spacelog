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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RS_SL_REVIEW_E = 10;
$pageNum_RS_SL_REVIEW_E = 0;
if (isset($_GET['pageNum_RS_SL_REVIEW_E'])) {
  $pageNum_RS_SL_REVIEW_E = $_GET['pageNum_RS_SL_REVIEW_E'];
}
$startRow_RS_SL_REVIEW_E = $pageNum_RS_SL_REVIEW_E * $maxRows_RS_SL_REVIEW_E;

mysql_select_db($database_spacelog, $spacelog);
$query_RS_SL_REVIEW_E = "SELECT * FROM sl_list";
$query_limit_RS_SL_REVIEW_E = sprintf("%s LIMIT %d, %d", $query_RS_SL_REVIEW_E, $startRow_RS_SL_REVIEW_E, $maxRows_RS_SL_REVIEW_E);
$RS_SL_REVIEW_E = mysql_query($query_limit_RS_SL_REVIEW_E, $spacelog) or die(mysql_error());
$row_RS_SL_REVIEW_E = mysql_fetch_assoc($RS_SL_REVIEW_E);

if (isset($_GET['totalRows_RS_SL_REVIEW_E'])) {
  $totalRows_RS_SL_REVIEW_E = $_GET['totalRows_RS_SL_REVIEW_E'];
} else {
  $all_RS_SL_REVIEW_E = mysql_query($query_RS_SL_REVIEW_E);
  $totalRows_RS_SL_REVIEW_E = mysql_num_rows($all_RS_SL_REVIEW_E);
}
$totalPages_RS_SL_REVIEW_E = ceil($totalRows_RS_SL_REVIEW_E/$maxRows_RS_SL_REVIEW_E)-1;

$queryString_RS_SL_REVIEW_E = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RS_SL_REVIEW_E") == false && 
        stristr($param, "totalRows_RS_SL_REVIEW_E") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RS_SL_REVIEW_E = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RS_SL_REVIEW_E = sprintf("&totalRows_RS_SL_REVIEW_E=%d%s", $totalRows_RS_SL_REVIEW_E, $queryString_RS_SL_REVIEW_E);
?>
<!doctype php>
<html>
<head>
<meta charset="utf-8">
<title>E's space log - unit review</title>
</head>
<body>
<form method="POST" name="form_review">
  <?php do { ?>
    <table width="300" border="0">
      <tbody>
        <tr>
          <td>eid</td>
          <td><?php echo $row_RS_SL_REVIEW_E['eid']; ?></td>
        </tr>
        <tr>
          <td>start</td>
          <td><?php echo $row_RS_SL_REVIEW_E['start']; ?></td>
        </tr>
        <tr>
          <td>end</td>
          <td><?php echo $row_RS_SL_REVIEW_E['end']; ?></td>
        </tr>
        <tr>
          <td>event</td>
          <td><?php echo $row_RS_SL_REVIEW_E['event']; ?></td>
        </tr>
        <tr>
          <td>status</td>
          <td><?php echo $row_RS_SL_REVIEW_E['status']; ?></td>
        </tr>
        <tr>
          <td>stamp</td>
          <td><?php echo $row_RS_SL_REVIEW_E['stamp']; ?></td>
        </tr>
        <tr>
          <td>uid</td>
          <td><?php echo $row_RS_SL_REVIEW_E['uid']; ?></td>
        </tr>
      </tbody>
  </table>
  <hr />
    <?php } while ($row_RS_SL_REVIEW_E = mysql_fetch_assoc($RS_SL_REVIEW_E)); ?>
  <table width="300" border="0">
      <tbody>
        <tr>
          <td><a href="<?php printf("%s?pageNum_RS_SL_REVIEW_E=%d%s", $currentPage, 0, $queryString_RS_SL_REVIEW_E); ?>">第一页</a></td>
          <td><a href="<?php printf("%s?pageNum_RS_SL_REVIEW_E=%d%s", $currentPage, max(0, $pageNum_RS_SL_REVIEW_E - 1), $queryString_RS_SL_REVIEW_E); ?>">前一页</a></td>
          <td><a href="<?php printf("%s?pageNum_RS_SL_REVIEW_E=%d%s", $currentPage, min($totalPages_RS_SL_REVIEW_E, $pageNum_RS_SL_REVIEW_E + 1), $queryString_RS_SL_REVIEW_E); ?>">下一个</a></td>
          <td><a href="<?php printf("%s?pageNum_RS_SL_REVIEW_E=%d%s", $currentPage, $totalPages_RS_SL_REVIEW_E, $queryString_RS_SL_REVIEW_E); ?>">最后一页</a></td>
        </tr>
      </tbody>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($RS_SL_REVIEW_E);
?>
