<?php 
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	$to_top='../staff_login/staff_login.html';
	print'ログインをしてください。<br />';
	print'<input type="button" onclick="location.href=\''.$to_top.'\'" value="ログイン画面へ" style="width:200">';
	exit();
}
else
{
	print $_SESSION['staff_name'];
	print'さんログイン中<br /><br />';
}
?>
ショップ管理メニュー<br />
<br />
<input type="button" onclick="location.href='../staff/staff_list.php'" value="スタッフ管理">
<input type="button" onclick="location.href='../product/pro_list.php'" value="商品管理"><br /><br />
<input type="button" onclick="location.href='staff_logout.php'" value="ログアウト"><br />
