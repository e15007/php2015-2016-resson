<meta charset="UTF-8">

<form method="post" action="radio_uke.php">
あなたの年齢を選択して、送信ボタンをクリックして下さい．<br>
<?php
$i = 1;
$c = 1;
while($i <= 100){
	print "<input type='radio' name='r' value='$i'>$i ";
	if($c == 10){
		print '<br>';
		$c=0;
	}
	$i++;
	$c++;
}
?>
<input type="submit" value="送信">
</form>
