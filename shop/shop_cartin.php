<?php 
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	$to_top='../staff_login/staff_login.html';
	print'ようこそゲスト様　';
	print'<input type="button" onclick="location.href=\''.$to_top.'\'" value="会員ログイン" style="width:200">';
}
else
{
	$to_memtop='member_logout.php';
	print'ようこそ';
	print $_SESSION['member_name'];
	print'様　';
	print'<input type="button" onclick="location.href=\''.$to_memtop.'\'">'.'<br />';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<?php

try

{
$pro_code=$_GET['procode'];

if(isset($_SESSION['cart'])==true)
{
	$cart=$_SESSION['cart'];
}
$cart[]=$pro_code;
$_SESSION['cart']=$cart;

}//<----end of try
catch (Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<br />カートに追加しました。<br />
<br />
<input type="button" onclick="location.href='shop_list.php'" value="商品一覧に戻る">

</body>
</html>
