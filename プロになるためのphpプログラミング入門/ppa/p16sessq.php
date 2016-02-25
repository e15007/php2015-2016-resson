<?php
//!	セッション管理を行うサンプル	proPHPトラベルツアー質問画面処理
require_once 'ppPage.php';
require_once 'ppSession.php';
//	質問データ
$qmsg = array(	array(	'どこか遠くへ行きたい？', '遠くへ行きた～い', '近場がいいな～'),
				array(	'海と山どっちが好き？', '海が好き', '山が好き'),
				array(	'暑いのと寒いのとでは、どっちが苦手？', '暑いのは苦手', '寒いのは苦手')	);
$ans = 0;					//	回答
$qno = 0;					//	質問番号0～2
$qcnt = count($qmsg) - 1;	//	質問数

//	セッション管理クラス
$sess = new PpSession('SESSQANDA');
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$sess->start();
	$ans = (int)$sess->get('ans');
	$qno = (int)$sess->get('qno');
	if($qno >= 0 && $qno < $qcnt){
		if(isset($_POST['a1'])){
			$ans |= (1 << $qno);
		}
		$qno ++;
	}
	$sess->set('ans', $ans);
	$sess->set('qno', $qno);
}
else{
	if($sess->sessionExists()){
		$sess->start();
		$sess->endProc();
	}
}

//	画面表示処理
$dobj = new stdClass();
$dobj->qno = (string)($qno + 1);
$dobj->qstr = $qmsg[$qno][0];
$elem['a1'] = new HTML_Template_Flexy_Element;
$elem['a1']->setValue($qmsg[$qno][1]);
$elem['a2'] = new HTML_Template_Flexy_Element;
$elem['a2']->setValue($qmsg[$qno][2]);
if($qno >= $qcnt){
	$elem['a1f'] = new HTML_Template_Flexy_Element;
	$elem['a1f']->attributes['action'] = 'p16sessa.php';
	$elem['a2f'] = new HTML_Template_Flexy_Element;
	$elem['a2f']->attributes['action'] = 'p16sessa.php';
}
$page = new PpPage;
$page->display('p16sessq.html', $dobj, $elem);
?>
