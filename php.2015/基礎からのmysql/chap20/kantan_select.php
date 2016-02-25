<meta charset='UTF-8'>
<?php
require_once('data/db_info.php');
$s = mysql_connect($SERV, $USER, $PASS) or die('失敗です');
print '成功しました<br>';
mysql_select_db($DBNM);
$re = mysql_query("select * from tbk order by bang");
while($kekka = mysql_fetch_array($re)){
	print htmlspecialchars($kekka[0]);
	print ' : ';
	print htmlspecialchars($kekka[1]);
	print ' : ';
	print htmlspecialchars($kekka[2]);
	print '<br>';
}
mysql_close($s);
print "<br><a href='kantan.html'>トップメニューに戻ります</a>";
