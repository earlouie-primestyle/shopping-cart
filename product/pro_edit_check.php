<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<?php

$pro_code=$_POST['code'];
$pro_name=$_POST['name'];
$pro_price=$_POST['price'];
$pro_gazou_name_old=$_POST['gazou_name_old'];
$pro_gazou=$_FILES['gazou'];

$pro_name=htmlspecialchars($pro_name);
$pro_price=htmlspecialchars($pro_price);
$pro_code=htmlspecialchars($pro_code);

if($pro_name=='')
{
	print'商品名が入力されていません。<br />';
}
else
{
	print'商品名:';
	print $pro_name.'<br />';
	print '価格---';
	print $pro_price.'円';
	print'<br />';
}

if($pro_price=='')
{
	print'価格が入力されていません。<br />';
}
if($pro_gazou['size']>0)
{
	if($pro_gazou['size']>1000000)
	{
		print'画像が大き過ぎです';
	}
	else
	{
		move_uploaded_file($pro_gazou['tmp_name'],'./pics/'.$pro_gazou['name']);
		print'<img src="./pics/'.$pro_gazou['name'].'">';
		print'<br />';
	}
}
if($pro_name==''||$pro_price==''||preg_match('/^[0-9]+$/',$pro_price)==0||$pro_gazou['size']>1000000)
{
	print'データを正しく入力してください。<br />';
	print'<form>';
	print'<input type="button" onclick="history.back()" value="戻る">';
	print'</form>';
}

else
{
	print'上記のように変更します。<br />';
	print'<form method="post" action="pro_edit_done.php">';
	print'<input type="hidden" name="code" value="'.$pro_code.'">';
	print'<input type="hidden" name="name" value="'.$pro_name.'">';
	print'<input type="hidden" name="price" value="'.$pro_price.'">';
	print'<input type="hidden" name="gazou_name_old" value="'.$pro_gazou_name_old.'">';
	print'<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';
	print'<br />';
	print'<input type="button" onclick="history.back()" value="戻る">';
	print'<input type="submit" value="ＯＫ">';
	print'</form>';
}

?>

</body>
</html>
