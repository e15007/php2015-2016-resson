<?php
//!	曲データ検索画面処理
require_once 'search_class.php';

//	認証済みかチェックする
$auth = new TuneAuth();
$auth->isLogined();

//	認証済みの場合のみ、以下が実行される
$inDt = new TuneInput();
$ppMg = new TuneDataManager($inDt);
$cont = new TuneCont($ppMg, new TuneSearchState());
$cont->doMain();
?>
