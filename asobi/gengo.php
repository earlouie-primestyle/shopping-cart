<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
<?php

require_once('../common/common.php');

$seireki=$_POST['seireki'];

$wareki=gengo($seireki);
print $wareki.'<br /><br />';

print'<input type="button" onclick="history.back()" value="戻る">';


?>
</form>
</body>
</html>
