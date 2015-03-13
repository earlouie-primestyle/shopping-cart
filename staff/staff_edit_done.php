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
$staff_code=$post['code'];
$staff_name=$post['name'];
$staff_pass=$post['pass'];


$dsn='mysql:dbname=shop;host=localhost';
$user='root';
$password='';
$dbh=new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

$sql='UPDATE mst_staff SET name=?,password=? WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$staff_name;
$data[]=$staff_pass;
$data[]=$staff_code;
$stmt->execute($data);

$dbh=null;

}
catch (Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

修正しました。<br />
<br />
<input type="button" onclick="location.href='staff_list.php'" value="戻る">
</body>
</html>
