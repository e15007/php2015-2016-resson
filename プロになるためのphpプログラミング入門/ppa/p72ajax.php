<?php
//!	AjaxとPHPを組み合わせるサンプル	JSONデータを出力する
header('Content-Type: application/json; charset=UTF-8');

$rows = array();

//	Ajaxのリクエストかチェック
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) !== true
|| $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest'){
	die(json_encode($rows));	//	空の配列をJSON形式で返す
}

$pref = 0;
$city = 0;
if(isset($_GET['pref'])) {
	$pref = (int)$_GET['pref'];
}
if(isset($_GET['city'])) {
	$city = (int)$_GET['city'];
}
if($pref < 1 || $pref > 47 || $city < 0 || $city > 999){
	die(json_encode($rows));
}

//	MySQLに接続する
$dbh = @new mysqli(	'localhost', 'ppguest', '1234', 'ppdb');
if($dbh->connect_errno){
	die(json_encode($rows));
}

$dbh->set_charset('utf8mb4');	//	MySQL5.5未満では'utf8'
$sth = $dbh->stmt_init();

if($city === 0){				//	市区町村データを取得するSQL
	$sql  = 'SELECT DISTINCT jiscode, city FROM zipcodes';
	$sql .= ' WHERE jiscode LIKE ? ORDER BY jiscode ASC';
	$sth->prepare($sql);
	$icd = sprintf('%02d', $pref) . '%';
}
else{							//	町域データを取得するSQL
	$sql = 'SELECT jiscode, town FROM zipcodes WHERE jiscode = ?';
	$sth->prepare($sql);
	$icd = sprintf('%02d%03d', $pref, $city);
}

$sth->bind_param('s', $icd);
$sth->execute();
$sth->bind_result($jiscode, $addr);
$dat = array();

if($city === 0){
	while($sth->fetch()){
		$dat['d'] = (int)mb_substr($jiscode, 2, 3, 'UTF-8');	//	市区町村コード3桁
		$dat['c'] = strip_tags($addr);							//	市区町村名
		$rows[] = $dat;
	}
}
else{
	$tdata = array();
	while($sth->fetch()){
		if($addr !== '以下に掲載がない場合'){
			$tdata[] = strip_tags($addr);
		}
	}
	shuffle($tdata);				//	シャッフルする
	foreach($tdata as $tt){
		$dat['r'] = mt_rand(1, 5);	//	ランダム数値（文字サイズ）
		$dat['t'] = $tt;			//	町の名前
		$rows[] = $dat;
	}
}

$sth->close();
$dbh->close();

//	JSONデータを出力する
echo json_encode($rows, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
?>
