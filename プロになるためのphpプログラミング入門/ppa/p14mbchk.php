<html>
<body><form method="post" action="p14mbchk.php">
<input type="text" maxlength="40" name="val">
<input type="submit"></form><p>
<?php
//!	mb_check_encoding関数で文字エンコーディングをチェックするサンプル
if(!isset($_POST['val']) || $_POST['val'] == ''){
	die('not submitted.');
}
if(mb_check_encoding($_POST['val'], 'UTF-8')){
	echo 'encoding OK.';
}
else{
	echo 'encoding NG.';
}
?>
</p></body></html>
