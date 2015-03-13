<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
<?php

$mbango=$_POST['mbango'];


$hoshi['M1']='カニ星雲';
$hoshi['M31']='アンドロメダ大星雲';
$hoshi['M42']='オリオン大星雲';
$hoshi['M57']='ドーナツ星雲';
$hoshi['M45']='すばる';

foreach($hoshi as $key=>$val)
{
	print $key.'は'.$val.'<br />';
}
print'<br /><br />';
print'あなたの選んだ星は、';
print $hoshi[$mbango];
print'です。<br />';
print'<input type="button" value="戻る" onclick="history.back()">';
?>
</form>
</body>
</html>
