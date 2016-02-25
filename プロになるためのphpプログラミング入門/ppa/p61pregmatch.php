<html><body>
<p>1文字以上10文字以下の英数字を入力してください</p>
<form method="post" action="p61pregmatch.php">
<input type="text" size="40" maxlength="30" name="val">
<input type="submit"></form><p>
<?php
//!	preg_match関数で入力値をチェックするサンプル
if(isset($_POST['val']) && $_POST['val'] != ''){
	$str = $_POST['val'];

	if(preg_match('/\A[a-z0-9]{1,10}\z/ui', $str) == 0) {
		echo 'チェックNG';
	}
	else{
		echo 'チェックOK';
	}
}
?>
</p></body></html>
