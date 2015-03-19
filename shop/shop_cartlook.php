<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	$to_top='member_login.html';
	print'ようこそゲスト様　';
	print'<input type="button" onclick="location.href=\''.$to_top.'\'" value="会員ログイン" style="width:200"><br /><br />';
}
else
{
	$to_memtop='member_logout.php';
	print'ようこそ';
	print $_SESSION['member_name'].'様<br /><br />';
	print'<input type="button" onclick="location.href=\''.$to_memtop.'\'">'.'<br /><br />';
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

if(isset($_SESSION['cart'])==true)
{
	$cart=$_SESSION['cart'];
	$kazu=$_SESSION['kazu'];
	$max=count($cart);
}
else
{
	$max=0;
}

if($max==0)
{
	print 'カートに商品が入っていません。<br />';
	print '<br />';
	print '<a href="shop_list.php">商品一覧へ戻る</a>';
	exit();
}

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

foreach($cart as $key=>$val)
{
	$sql='SELECT code,name,price,gazou FROM mst_product WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data[0]=$val;
	$stmt->execute($data);

	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	$pro_name[]=$rec['name'];
	$pro_price[]=$rec['price'];
	if($rec['gazou']=='')
	{
		$pro_gazou[]='';
	}
	else
	{
		$pro_gazou[]='<img src="../product/pics/'.$rec['gazou'].'">';
	}
}
$dbh=null;

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>
カートの中身<br />
<table border="1">
<tr>
<td>商品</td>
<td>商品画像</td>
<td>価格</td>
<td>数量</td>
<td>小計</td>
<td>削除</td>
</tr>
<form method="post" action="kazu_change.php">
<?php for($i=0;$i<$max;$i++)
	{
?>
<tr>
	<td><?php print $pro_name[$i]; ?></td>
	<td><?php print $pro_gazou[$i]; ?></td>
	<td><?php print $pro_price[$i]; ?>円</td>
	<td><input type="text" name="kazu<?php print $i; ?>" value="<?php print $kazu[$i]; ?>" style="width:50"></td>
	<td><?php print number_format($pro_price[$i]*$kazu[$i]); ?>円</td>
	<td><input type="checkbox" name="sakujo<?php print $i; ?>"></td>
</tr>
<?php
	}
?>
</table>
<input type="hidden" name="max" value="<?php print $max; ?>">
<input type="submit" value="数量変更">
<input type="button" onclick="location.href='shop_list.php'" value="戻る">
</form>
<br /><br />
<input type="button" value="購入手続き" onclick="location.href='shop_form.html'">
</body>
</html>