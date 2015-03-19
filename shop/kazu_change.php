<?php
	session_start();
	session_regenerate_id(true);

	require_once('../common/common.php');
	
	$to_list='shop_cartlook.php';
	
	$post=sanitize($_POST);

	$max=$post['max'];
	for($i=0;$i<$max;$i++)
	{
		if(preg_match("/^[0-9]+$/",$post['kazu'.$i])==0)
		{

			print'数量に誤りがあります。';
			print'<input type="button" value="戻る" onclick="location.href=\''.$to_list.'\'">';
			exit();
		}
		if($post['kazu'.$i]<1||10<$post['kazu'.$i])
		{
			print'数量は必ず１個以上、１０個までです。';
			print'<input type="button" value="戻る" onclick="location.href=\''.$to_list.'\'">';
			exit();
		}
		$kazu[]=$post['kazu'.$i];
	}
	
	$cart=$_SESSION['cart'];
	for($i=$max; 0<=$i;$i--)
	{
		if(isset($_POST['sakujo'.$i])==true)
		{
			array_splice($cart,$i,1);
			array_splice($kazu,$i,1);
		}
	}
	$_SESSION['cart']=$cart;
	$_SESSION['kazu']=$kazu;

	header('Location:shop_cartlook.php');

?>