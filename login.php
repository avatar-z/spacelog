<?php
	require_once('/access.php');
	$loginAccess = new Access;
?>
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
$query_RS_SL_LOGIN_U = "SELECT * FROM sl_profile";
$RS_SL_LOGIN_U = mysql_query($query_RS_SL_LOGIN_U, $spacelog) or die(mysql_error());
$row_RS_SL_LOGIN_U = mysql_fetch_assoc($RS_SL_LOGIN_U);
$totalRows_RS_SL_LOGIN_U = mysql_num_rows($RS_SL_LOGIN_U);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['name'])) {
  $loginUsername=$_POST['name'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login_redirect.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_spacelog, $spacelog);
  
  $LoginRS__query=sprintf("SELECT name, password FROM sl_profile WHERE name=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $spacelog) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
	
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    $loginAccess->setAccess($loginUsername); // set cookie
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<html>
<script type="text/javascript">
function logout(){
	location.href='http://local.spacelog.com/logout_redirect.php';
}
</script>
<style>
.box{display:inline-block;}
.box{*display:inline; *zoom:1; width:600px; border:#000 0px solid; vertical-align:middle;}
i{display:inline-block; width:0; height:100%; vertical-align:middle;}
</style>
<head>
<meta charset="utf-8">
<title>Space Log - user login</title>
</head>
<div style="background-color:#C8C8C8; width:100%; height:100%; position:fixed; z-index:-2">
</div>
<body leftmargin="0" topmargin="0">
<div align="center">
<i></i>
<div class="box">
<!--<img src="img/common/logo_gongshi.png" width="180" height="180" alt=""/>-->
<hr/>
<h1 style="color:hsla(202,100%,50%,1.00); font-family:'Microsoft YaHei'">用户登录</h1>
<hr/>
<?php if($_COOKIE['sl_access']=="ACCESS_GRANTED"){ ?>
<h2 style="color:hsla(202,100%,50%,1.00); font-family:'Microsoft YaHei'">已登录</h2>
<button onClick="logout()" style="background:none; border-color:hsla(202,100%,50%,1.00); width:100; height:30
font-family:'Microsoft YaHei'; font-size:16">
登出
</button>
<?php
}
else{
?>
<form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST">
<table width="300" border="0" cellspacing="0" cellpadding="0" style="font-family:'Microsoft YaHei'">
  <tbody>
    <tr>
      <td width="100" height="50">用户名:</td>
      <td>
      	<input type="text" name="name" id="name" style="background:none; height:30; width:200;
        border:dashed; border-color:hsla(202,100%,50%,1.00)" placeholder="<?php echo $loginAccess->getAccess() ?>">
      </td>
    </tr>
    <tr>
      <td width="100" height="50">密码:</td>
      <td>
      	<input type="password" name="password" id="password" style="background:none; height:30; width:200;
        border:dashed; border-color:hsla(202,100%,50%,1.00)">
      </td>
    </tr>
    <tr>
      <td>
      </td>
      <td>
      	<input type="submit" id="submit" name="submit" value="登录" style="background:none; border-color:hsla(202,100%,50%,1.00);
        height:30; width:100; font-family:'Microsoft YaHei'; font-size:16">
      </td>
    </tr>
  </tbody>
</table>
</form>
<?php } ?>
<hr/>
<h1> </h1>
</div>
</div>
<body>
</body>
</html>
<?php
mysql_free_result($RS_SL_LOGIN_U);
?>
