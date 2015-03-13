<?php

try
{

$staff_code=$_POST['code'];
$staff_pass=$_POST['pass'];

$staff_code=htmlspecialchars($staff_code);
$staff_pass=htmlspecialchars($staff_pass);

$staff_pass=md5($staff_pass);

$dsn='mysql:dbname=shop;host=localhost';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='SELECT name FROM mst_staff WHERE code=? AND password=?';
$stmt=$dbh->prepare($sql);
$data[]=$staff_code;
$data[]=$staff_pass;
$stmt->execute($data);

$dbh=null;

$rec=$stmt->fetch(PDO::FETCH_ASSOC);

if($rec==false)
{
	$to_top='../staff_login/staff_login.html';
	print'パスワードかスタッフコード、スタッフ名が間違っています<br />';
	print'<input type="button" onclick="location.href=\''.$to_top.'\'" value="ログイン画面へ" style="width:200">';
	exit();}
else
{
	session_start();
	$_SESSION['login']=1;
	$_SESSION['code']=$staff_code;
	$_SESSION['staff_name']=$rec['name'];
	header('Location:staff_top.php');
}
}//<----end of try
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>