<?php 
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	$to_top='member_login.html';
	print'ようこそゲスト様　';
	print'<input type="button" onclick="location.href=\''.$to_top.'\'" value="会員ログイン" style="width:200"><br />';
}
else
{
	$to_memtop='member_logout.php';
	print'ようこそ';
	print $_SESSION['member_name'].'様<br /><br />';
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

$dsn='mysql:dbname=shop;host=localhost';
$user='root';
$password='';
$dbh=new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

$sql='SELECT code,name,price FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

print'商品一覧<br /><br />';

while(true)
 {
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	print'<a href="shop_product.php?procode=';
	print$rec['code'].'">';
	print$rec['name'].'---';
	print$rec['price'].'円';
	print'</a>';
	print'<br /><br />';
 }
print'<a href="shop_cartlook.php">カートを見る</a><br />';


}


catch (Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

</body>
</html>
