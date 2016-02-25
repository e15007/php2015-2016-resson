<meta charset='UTF-8'>
<?php
$s = mysql_connect('localhost', 'yamauchi', '1234') or die('失敗です');
print '成功しました<br>';
mysql_select_db('db1');

$b1_d = $_POST['b1'];

mysql_query("delete from tbk where bang={$b1_d}");

$re = mysql_query("select * from tbk order by bang");
while($kekka = mysql_fetch_array($re)){
	print $kekka[0];
	print ' : ';
	print $kekka[1];
	print ' : ';
	print $kekka[2];
	print '<br>';
}
mysql_close($s);
print "<br><a href='kantan.html'>トップメニューに戻ります</a>";
