<?php require_once("webprofile.php"); ?>
<?php
	class Access{
		function setAccess($account, $account_id){
			$expire = time() + 86400;
			setcookie("sl_account", $account, $expire, $GLOBALS['WL']);
			setcookie("sl_id", $account_id, $expire, $GLOBALS['WL']);
			setcookie("sl_access", "ACCESS_GRANTED", $expire, $GLOBALS['WL']);
		}
		function getAccess(){
			if($_COOKIE['sl_access'] == "ACCESS_GRANTED"){
				return $_COOKIE['sl_account'];
			}
			else{
				return "请登录";
			}
		}
		/*
		function deleteAccess(){
			setcookie("sl_account", $account, time()-1, $GLOBALS['WL']);
			setcookie("sl_id", $account_id, time()-1, $GLOBALS['WL']);
			setcookie("sl_access", "ACCESS_GRANTED", time()-1, $GLOBALS['WL']);
		}
		*/
		function deleteAccess(){
			setcookie("sl_account", '');
			setcookie("sl_id", '');
			setcookie("sl_access", '');
		}
	}
?>