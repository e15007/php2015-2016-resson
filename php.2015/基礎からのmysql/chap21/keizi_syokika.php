<?php

// データベース情報等の読み込み
require_once('data/db_info.php');

// データべースへ接続、データベース選択
$s = mysql_connect($SERV, $USER, $PASS) or die('失敗しました');
mysql_select_db($DBNM);

//print 'OK!';

mysql_query('delete from tbj0');
mysql_query('delete from tbj1');
mysql_query('alter table tbj0 auto_increment=1');
mysql_query('alter table tbj1 auto_increment=1');

print 'ＳＱＬカフェのテーブルを初期化しました';

mysql_close($s);
