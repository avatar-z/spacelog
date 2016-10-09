<?php
	class Access{
		function setAccess($account, $account_id){
			$expire = time() + 86400;
			setcookie("sl_account", $account, $expire, 'http://127.0.0.1');
			setcookie("sl_id", $account_id, $expire, 'http://127.0.0.1');
			setcookie("sl_access", "ACCESS_GRANTED", $expire, 'http://127.0.0.1');
		}
		function getAccess(){
			if($_COOKIE['sl_access'] == "ACCESS_GRANTED"){
				return $_COOKIE['sl_account'];
			}
			else{
				return "请登录";
			}
		}
		function deleteAccess(){
			setcookie("sl_account", $account, time()-1, 'http://127.0.0.1');
			setcookie("sl_id", $account_id, time()-1, 'http://127.0.0.1');
			setcookie("sl_access", "ACCESS_GRANTED", time()-1, 'http://127.0.0.1');
		}
	}
?>