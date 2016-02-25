<?php

// データベース情報等の読み込み
require_once('data/db_info.php');

// データべースへ接続、データベース選択
$s = mysql_connect($SERV, $USER, $PASS) or die('失敗しました');
mysql_select_db($DBNM);

//echo 'OK!';

// タイトル、画像等の表示
print <<<eot1
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ＳＱＬカフェのページ</title>
</head>
<body bgcolor='lightsteelblue'>
	<img src="pic/oya.gif" alt="">
	<font size='7' color='indigo'>
	ＳＱＬカフェ掲示板だよ~
	</font>
	<br><br>
	見たいスレッドの番号をクリックして下さい
	<hr>
	<font size='5'>
	(スレッド一覧)
	</font>
	<br>
eot1;

// クライアントIPアドレスの取得
$ip = getenv('REMOTE_ADDR');

//var_dump($_GET);

// スレッドのタイトル(su)にデータがあればtbj0に挿入
$su_d = isset($_GET['su'])? htmlspecialchars($_GET['su']) : null;
//var_dump($su_d);
if($su_d<>''){
	$q = "insert into tbj0(sure, niti, aipi) values('$su_d', now(), '$ip')";
	//var_dump($q);
	//mysql_query("insert into tbj0(sure, niti, apipi) values('$su_d', now(), '$ip')");
	mysql_query($q);
}

// tbj0の全データ抽出
$re = mysql_query('select * from tbj0');
while($kekka = mysql_fetch_array($re)){
	print <<<oet2
<a href="keizi.php?gu=$kekka[0]">$kekka[0] $kekka[1]</a>
<br>
$kekka[2]作成<br><br>
oet2;
}

// データベース切断
mysql_close($s);

// スレッド名入力用表示、トップ等へのリンク
print <<<eot3
<hr>
<font size='5'>
(スレッド作成)
</font>
<br>
新しくスレッドを作るときはここでどうぞ！
<br>
<form method='get' action="keizi_top.php">
	新しく作るスレッドのタイトル
	<input type="text" name="su" size='50'>
	<br>
	<input type="submit" value="作成">
</form>
<hr>
<font size='5'>
(メッセージ検索)
</font>
<a href="keizi_search.php">検索するときはここをクリック</a>
<hr>
</body>
</html>
eot3;

?>
