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
カートを空にしました。<br />
<br />
<input type="button" onclick="location.href='shop_list.php'" value="リストに戻る" style="width:200">
</body>
</html>
