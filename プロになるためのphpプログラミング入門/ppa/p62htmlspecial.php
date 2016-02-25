<html><body><form method="post" action="p62htmlspecial.php">
<input type="text" size="40" maxlength="30" name="val">
<input type="submit"></form><p>
<?php
//!	htmlspecialchars関数を使うサンプル
if(isset($_POST['val']) && $_POST['val'] != ''){
	$str = $_POST['val'];
	$str = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
	echo '入力値は以下です。<br><br>', PHP_EOL;
	echo $str;
	echo PHP_EOL;
}
?>
</p></body></html>
