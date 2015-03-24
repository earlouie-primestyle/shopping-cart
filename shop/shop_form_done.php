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
$postal2=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];
$chumon=$post['chumon'];
$pass=$post['pass'];
$danjo=$post['danjo'];
$birth=$post['birth'];

print$onamae.'様<br />';
print'ご注文ありがとうございました。<br />';
print$email.'にメールを送りましたのでご確認ください。<br />';
print'商品は以下の住所に発送させていただきます。<br />';
print$postal1.'-'.$postal2.'<br />';
print$address.'<br />';
print$tel.'<br />';

$honbun='';
$honbun.=$onamae."様、\n\nこのたびはご注文ありがとうございました。\n\n";
$honbun.="ご注文の商品\n";
$honbun.="----------------\n";

$cart=$_SESSION['cart'];
$kazu=$_SESSION['kazu'];
$max=count($cart);

$dsn='mysql:dbname=shop;host=localhost';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

for($i=0;$i<$max;$i++)
{
	$sql='SELECT name,price FROM mst_product WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data[0]=$cart[$i];
	$stmt->execute($data);
	
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	
	$name=$rec['name'];
	$price=$rec['price'];
	$kakaku[]=$price;
	$suryo=$kazu[$i];
	$shokei=$price*$suryo;
	
	$honbun.=$name.'';
	$honbun.=$price.'円×';
	$honbun.=$suryo.'個=';
	$honbun.=$shokei."円\n";
}// end of for

$sql='LOCK TABLES dat_sales,dat_product WRITE';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$lastmembercode=0;
if(chumon=='chumontouroku')
{
	$sql='INSERT INTO dat_member(password,name,email,postal1,postal2,address,tel,danjo,born)VALUES(?,?,?,?,?,?,?,?,?,?)';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=md5($pass);
	$data[]=$onamae;
	$data[]=$email;
	$data[]=$postal1;
	$data[]=$postal2;
	$data[]=$address;
	$data[]=$tel;
	if(danjo=='dan')
	{
		$data[]=1;
	}
	else
	{
		$data[]=2;
	}
	$data[]=$birth;
	$stmt->execute($data);
	
	$sql='SELECT LAST_INSERT_ID()';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	$lastmembercode=$rec['LAST_INSERT_ID'];
}

$sql='INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data=array();
$data[]=0;
$data[]=$lastmembercode;
$data[]=$onamae;
$data[]=$email;
$data[]=$postal1;
$data[]=$postal2;
$data[]=$address;
$data[]=$tel;
$stmt->execute($data);

$sql='SELECT LAST_INSERT_ID()';
$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$lastcode=$rec['LAST_INSERT_ID()'];

for($i=0;$i<$max;$i++)
{
	$sql='INSERT INTO dat_sales_product(code_sales,code_product,price,quantity)VALUES(?,?,?,?)';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=$lastcode;
	$data[]=$cart[$i];
	$data[]=$kakaku[$i];
	$data[]=$kazu[$i];
	$stmt->execute($data);
}

$sql='UNLOCK TABLES';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

$honbun.="送料は無料です。\n";
$honbun.="-------------\n\n";
$honbun.="代金は以下の口座にお振り込みください。\n";
$honbun.="ろくまる銀行 やさい支店 普通口座 １２３４５６７\n";
$honbun.="入金確認が取れ次第、梱包、発送させていただきます。\n\n";
$honbun.="□□□□□□□□□□□□□□\n";
$honbun.="～安心野菜のろくまる農園～\n\n";
$honbun.="○○県六丸郡六丸村１２３－４\n";
$honbun.="電話番号 090-6060-xxxx\n";
$honbun.="メール info@rokumarunouen.co.jp\n";
$honbun.="□□□□□□□□□□□□□□\n";


//print'<br />';
//print nl2br($honbun);

$title='ご注文ありがとうございます。';
$header='From:info@rokumarunouen.co.jp';
$honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail($email,$title,$honbun,$header);

$title='ご注文いただきました。';
$header='From:$email';
$honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail('info@rokumarunouen.co.jp',$title,$honbun,$header);


} //end of try

catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
} //end of catch
?>

<input type="button" onclick="location.href='shop_list.php'" value="買い物に戻る">
</body>
</html>
