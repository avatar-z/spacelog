<?php
	require_once('webprofile.php');
	$url = $GLOBALS['WL'].'/index.php';
?>
<?php require_once('access.php'); ?>
<?php
	$logoutAccess = new Access;
	$logoutAccess->deleteAccess();
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
echo <<<redirect
<script language=JavaScript>
setTimeout("window.location.href='$url'",1000);
</script>
redirect;
?>
</html>