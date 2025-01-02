<?php
//改成自動加載
require_once("includes/init.php");
//session_start();

$_SESSION = [];

if (ini_get("session.use_cookies")){
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 442000, 
		$params["path"], $param["doman"] , $param["secure"], $param["httponly"]);
		
}

session_destroy();

Url::redirect("/PHP-beginger/index.php");