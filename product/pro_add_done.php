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
require_once('../common/common.php');
$post=sanitize($_POST);
$pro_name=$post['name'];
$pro_price=$post['price'];
$pro_gazou_name=$post['gazou_name'];

$dsn='mysql:dbname=shop;host=localhost';
$user='root';
$password='';
$dbh=new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

$sql='INSERT INTO mst_product (name,price,gazou) VALUES(?,?,?)';
$stmt=$dbh->prepare($sql);
$data[]=$pro_name;
$data[]=$pro_price;
$data[]=$pro_gazou_name;
$stmt->execute($data);

$dbh=null;

print $pro_name;
print'を追加しました。<br />';

}
catch (Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<input type="button" onclick="location.href='pro_list.php'" value="戻る">
</body>
</html>
