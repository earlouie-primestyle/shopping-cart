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

$staff_name=$_POST['name'];
$staff_pass=$_POST['pass'];

$staff_name=htmlspecialchars($staff_name);
$staff_pass=htmlspecialchars($staff_pass);

$dsn='mysql:dbname=shop;host=localhost';
$user='root';
$password='';
$dbh=new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

$sql='INSERT INTO mst_staff (name,password) VALUES(?,?)';
$stmt=$dbh->prepare($sql);
$data[]=$staff_name;
$data[]=$staff_pass;
$stmt->execute($data);

$dbh=null;

print $staff_name;
print'さんを追加しました。<br />';

}
catch (Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<input type="button" onclick="location.href='staff_list.php'" value="戻る">
</body>
</html>
