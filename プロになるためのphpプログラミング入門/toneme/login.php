<?php
//!	ログイン画面処理
require_once 'tuneConfig.php';
require_once 'tuneProc.php';
$auth = new TuneAuth();
$auth->loginProc();
?>
