<?php
// データベース情報等の読み込み
require_once('data/db_info.php');

// データべースへ接続、データベース選択
$s = mysql_connect($SERV, $USER, $PASS) or die('失敗しました');
mysql_select_db($DBNM);

//print 'OK!';

// テーブルtbj1をselect
$re = mysql_query('select * from tbj1 order by niti');

// クエリの結果書き出し
$i = 1;
while($kekka = mysql_fetch_array($re)){
	print "$i($kekka[0]):$kekka[1]:$kekka[3] GP:$kekka[4] IP:$kekka[5]<br>";
	print nl2br($kekka[2]);
	print '<br><br>';
	$i++;
}

// データベース切断
mysql_close($s);
