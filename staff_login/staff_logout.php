<?php
session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
	setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
ログアウトしました。<br />
<br />
<input type="button" onclick="location.href='../staff_login/staff_login.html'" value="ログイン画面へ" style="width:200">
</body>
</html>
