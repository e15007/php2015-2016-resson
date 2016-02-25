<?php
//!	HTML_Template_Flexyのサンプル	if制御構文で表示を制御する
require_once 'ppPage.php';
$page = new PpPage;
$dobj = new stdClass();
$dobj->member = false;

//	0: 非会員	1: 会員
$kaiin = 1;
if($kaiin === 1){
	$dobj->member = true;
}
$page->display('p15flexyif.html', $dobj);
?>
