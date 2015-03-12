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

$sql='SELECT name FROM mst_staff WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

print'スタッフ一覧<br /><br />';

while(true)
 {
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	print$rec['name'];
	print'</br>';
 }

}

catch (Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

</body>
</html>
