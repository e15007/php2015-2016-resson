<?php
//!	認証処理サンプル	認証済み画面２
require_once 'ppAuth.php';
require_once 'p41authopt.php';
$auth = new PpAuth($ppopts);
$auth->isLogined();

//	認証済みの場合のみ、以下が実行される
$page = new PpPage;
$page->display('p41auth2.html');
?>
