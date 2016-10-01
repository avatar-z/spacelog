<?php require_once('access.php'); ?>
<?php
	$logoutAccess = new Access;
	$logoutAccess->deleteAccess();
	//setcookie("campus_account", $account, time()-1, '~/access', 'campus.e1996.com');
	//setcookie("campus_access", "ACCESS_GRANTED", time()-1, '~/access', 'campus.e1996.com');
?>
<html>
<head>
<meta charset="utf-8">
<title>spacelog - user logout</title>
</head>
登出成功！正在跳转...
<?php
	/*
	$i=0;
	while(true){
		if($i > 10){
			header("location: http://local.spacelog.com/index.php");
			break;
		}
		$i++;
		sleep(2);
	}
	*/
	$url = 'http://local.spacelog.com/index.php';
	echo "<script language=\"javascript\">setTimeout(\"window.location.href='".$url."'\",1000)</script>";
?>
</html>