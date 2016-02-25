<?php
//!	キモチ曲検索画面処理
require_once 'tuneConfig.php';

$crDt = new TuneInput();
$feeling_id = 0;
for($idx = 1; $idx <= 6; $idx ++){
	$nm = 'btn' . $idx . '_x';
	if(isset($_POST[$nm])){
		$feeling_id = $idx;
		break;
	}
}
if($feeling_id < 0 || $feeling_id > 6){
	$feeling_id = 0;
}
$feelingok = false;
$comcontok = false;
$feel = array('', 'ルンルン', 'ノリノリ', 'ホノボノ', 'ラブラブ', 'ヘロヘロ', 'ガックリ');
$dobj = null;
$elems = array();

//	気持ちIDに一致する曲を１件取得する
if($feeling_id != 0){
	$ddb = new TuneDao(TUNE_DB_GUEST);
	$dobj = $ddb->getTuneDataFeel($feeling_id);
	if(!empty($dobj)){
		$feelingok = true;
		if($dobj->comcont != ''){
			$dobj->comcontok = true;	//	true:コメントを表示する

			//	コメントを改行コードで分割する
			$dobj->comconts = preg_split("/\x0A+/u", $dobj->comcont);
		}

		$dobj->feelname = $feel[$feeling_id];
		$elems['face'] = new HTML_Template_Flexy_Element;
		$elems['face']->attributes['src'] = 'img/face' . $feeling_id . '.png';
	}
}
if(empty($dobj)){
	$dobj = new stdClass();
}
$dobj->feelingok = $feelingok;			//	true:結果を表示する

$dsp = new PpPage();
$dsp->display('tonemeindex.html', $dobj, $elems);
?>
