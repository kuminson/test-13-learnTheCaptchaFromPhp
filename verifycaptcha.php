<?php
// 判定收到传值
if(isset($_REQUEST["captcha_code"])){
	// 开启session
	session_start();
	// 判定收到的值和session中保存的值相同
	if(strtolower($_REQUEST["captcha_code"]) == $_SESSION["authcode"]){
		echo "输入正确";
	}else{
		echo "输入错误";
	}
	exit();
}
?>