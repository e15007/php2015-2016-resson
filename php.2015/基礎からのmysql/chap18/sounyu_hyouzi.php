<meta charset='UTF-8'>
<?php
$s = mysql_connect('localhost', 'yamauchi', '1234') or die('失敗です');
print '成功しました<br>';
mysql_select_db('db1');
mysql_query("insert into tb1 values('K780', 'エスキュー花子', 25)");
$re = mysql_query("select * from tb1");
while($kekka = mysql_fetch_array($re)){
	print $kekka[0];
	print ':';
	print $kekka[1];
	print ':';
	print $kekka[2];
	print '<br>';
}
mysql_close($s);
