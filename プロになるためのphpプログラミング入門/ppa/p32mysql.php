<?php
//!	MySQLiのプリペアド・ステートメントを使うサンプル
//	MySQLに接続する
$dbh = @new mysqli(	'localhost',	//	ホスト
					'ppguest',		//	ユーザ名
					'1234',	//	パスワード
					'ppdb'	);		//	DB名

if($dbh->connect_errno){
	die('Connect Error: ' . $dbh->connect_errno);	//	エラー時は終了する
}

//	MySQL5.5未満では'utf8'
$dbh->set_charset('utf8mb4');

$sql  = 'SELECT zipcode, pref, city, town FROM zipcodes';
//$sql .= ' WHERE zipcode >= ? AND zipcode <= ?';
$sql .= ' WHERE pref = ?';
//$sql .= ' ORDER BY zipcode ASC LIMIT 100';
$sql .= ' ORDER BY zipcode';

//	郵便番号の検索範囲
$mincd = '2070000';
$maxcd = '2090000';
$ken = '沖縄県';

$sth = $dbh->stmt_init();
if($sth->prepare($sql)){
	//$sth->bind_param('ss', $mincd, $maxcd);
	$sth->bind_param('s', $ken);
	$sth->execute();
	$sth->bind_result($code, $pref, $city, $town);

	//	表形式で表示する
	echo '<html><body><table>', PHP_EOL;
	echo '<tr><th>郵便番号</th><th>都道府県名</th>';
	echo '<th>市区町村名</th><th>町域名</th></tr>', PHP_EOL;

	while($sth->fetch()){
		echo '<tr><td>',  htmlspecialchars($code, ENT_QUOTES, 'UTF-8');
		echo '</td><td>', htmlspecialchars($pref, ENT_QUOTES, 'UTF-8');
		echo '</td><td>', htmlspecialchars($city, ENT_QUOTES, 'UTF-8');
		echo '</td><td>', htmlspecialchars($town, ENT_QUOTES, 'UTF-8');
		echo '</td></tr>', PHP_EOL;
	}
	echo '</table></body></html>', PHP_EOL;

	$sth->close();
}

$dbh->close();
?>
