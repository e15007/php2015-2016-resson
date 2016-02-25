<?php
//!	MySQLiでSQLクエリ発行を行うサンプル
$cnt = null;
$dbh = @new mysqli('localhost', 'ppguest', '1234', 'ppdb');
if($dbh->connect_errno){
	die('Connect Error: ' . $dbh->connect_errno);
}

$dbh->set_charset('utf8mb4');	//	MySQL5.5未満では'utf8'
$sql = "SELECT COUNT(*) FROM zipcodes where pref = '沖縄県'";
if($result = $dbh->query($sql)){
	$row = $result->fetch_row();
	$cnt = $row[0];
	$result->close();
}
$dbh->close();

if($cnt !== null){
	echo 'zipcodesテーブルのデータは、';
	echo htmlspecialchars($cnt, ENT_QUOTES, 'UTF-8');
	echo ' 件です';
}
else{
	echo 'エラーです';
}
?>
