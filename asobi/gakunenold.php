<?php

$gakunen=$_POST['gakunen'];

$kousya[1]='あなたの校舎は南校舎です。';
$kousya[2]='あなたの校舎は西校舎です。';
$kousya[3]='あなたの校舎は東校舎です。';
$kousya[4]='あなたは３年生と同じ校舎です。';

print $kousya[$gakunen].'<br />';
print '<input type="button" onclick="history.back()" value="戻る" style="width:200px">';
?>