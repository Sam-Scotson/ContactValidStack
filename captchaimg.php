<?php session_start();
require("captcha.php");
$str = rand(100000, 999999);
$_SESSION['captcha'] = $str;
captcha($str);
?>