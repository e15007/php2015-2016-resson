<meta charset='UTF-8'>
<?php
require_once('data/db_info.php');
$s = mysql_connect($SERV, $USER, $PASS) or die('失敗です');
print '成功しました<br>';
mysql_select_db($DBNM);

//var_dump($_POST);

//$a1_d = htmlspecialchars($_POST['a1']);
//$a2_d = htmlspecialchars($_POST['a2']);
$a1_d = $_POST['a1'];
$a2_d = $_POST['a2'];

var_dump($a1_d);
var_dump($a2_d);

mysql_query("insert into tbk(nama, mess) values('{$a1_d}', '{$a2_d}')");
print mysql_error() . '<br>';

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
