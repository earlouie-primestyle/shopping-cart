<?php 
	session_start();
	session_regenerate_id(true);
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

$onamae=$post['onamae'];
$email=$post['email'];
$postal1=$post['postal1'];
$posta12=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];

print$onamae.'様<br />';
print'ご注文ありがとうございました。<br />';
print$email.'にメールを送りましたのでご確認ください。<br />';
print'商品は以下の住所に発送させていただきます。<br />';
print$postal1.'-'.$posta12.'<br />';
print$address.'<br />';
print$tel.'<br />';

}

catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
?>

<input type="button" onclick="location.href='shop_list.php'" value="買い物に戻る">
</body>
</html>
