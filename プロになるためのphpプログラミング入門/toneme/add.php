<?php
//!	曲データ追加画面処理
require_once 'add_class.php';

//	認証済みかチェックする
$auth = new TuneAuth();
$auth->isLogined();

//	認証済みの場合のみ、以下が実行される
$inDt = new TuneInput($auth->getSessObj());
$ppMg = new TuneDataManager($inDt);
if($inDt->isPost()){				//	POST送信された場合
	$state = new TuneAddDbState();	//	曲データ追加処理
}
else{
	$state = new TuneAddInState();	//	曲データ追加画面処理
}
$cont = new TuneCont($ppMg, $state);
$cont->doMain();
?>
