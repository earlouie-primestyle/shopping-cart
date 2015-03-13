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

$dsn='mysql:dbname=shop;host=localhost';
$user='root';
$password='';
$dbh=new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

$sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_price=$rec['price'];
$pro_gazou_name=$rec['gazou'];

$dbh=null;

if($pro_gazou_name=='')
{
	$disp_gazou='';
}
else
{
	$disp_gazou='<img src="../product/pics/'.$pro_gazou_name.'">';
	print'<a href="shop_cartin.php?procode='.$pro_code.'"><br />カートに入れる</a><br /><br />';
}
}
catch (Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

商品情報参照<br />
<br />
商品コード<br />
<?php print $pro_code;?><br />
<br />
商品名<br />
<?php print $pro_name; ?><br />
<?php print $disp_gazou;?><br />
価格---<?php print $pro_price;?>円

<br /><br />
<input type="button" onclick="history.back()" value="戻る">
</form>

</body>
</html>
