<?php require_once("webprofile.php"); ?>
<html>
<?php
	$url = $GLOBALS['WL'].'/login.php';
?>
<script language="javascript">
//function winRedirect(){ setTimeout("window.location.href='".<?php echo $url; ?>."'",1000); }
//function winRedirect(){ setTimeout("window.open('".<?php echo $url; ?>."')",1000); }
//function winRedirect(){ setTimeout("window.parent.location.href='".<?php echo $url; ?>."'",1000); }
//function winClose(){ setTimeout("window.parent.opener=null; window.parent.close();",3000); }
</script>
<head>
<meta charset="utf-8">
<title>spacelog - user login</title>
</head>
<body bgcolor="#C8C8C8">
<h1 align="center" style="color:hsla(216,100%,50%,1.00); font-family:'Microsoft YaHei'">登录失败，请重新登陆！</h1>
<?php
	/*
	echo("<script language=\"javascript\">winRedirect();</script>");
	echo("<script language=\"javascript\">winClose();</script>");
	*/
	/* depricated
	echo <<<reload
<script language=JavaScript>   
setTimeout("parent.location.reload()",1500);
</script>
reload;
*/
echo <<<redirect
<script language=JavaScript>
setTimeout("window.location.href='$url'",1000);
</script>
redirect;
?>
</body>
</html>