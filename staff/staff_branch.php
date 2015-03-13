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
if(isset($_POST['edit'])==true)
{
	if (isset($_POST['staffcode'])==false)
	{
		header('Location:staff_ng.php');
	}
	$staff_code=$_POST['staffcode'];
	header('Location:staff_edit.php?staffcode='.$staff_code);
}

if(isset($_POST['delete'])==true)
{
	if (isset($_POST['staffcode'])==false)
	{
		header('Location:staff_ng.php');
	}
	$staff_code=$_POST['staffcode'];
	header('Location:staff_delete.php?staffcode='.$staff_code);
}

if(isset($_POST['add'])==true)
{
	header('Location:staff_add.php');
}

if(isset($_POST['disp'])==true)
{
	if(isset($_POST['staffcode'])==false)
	{
		header('Location:staff_ng.php');
	}
	$staff_code=$_POST['staffcode'];
	header('Location:staff_disp.php?staffcode='.$staff_code);
}

?>