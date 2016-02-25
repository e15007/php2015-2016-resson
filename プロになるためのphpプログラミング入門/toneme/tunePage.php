<?php
require_once 'ppPage.php';
//--------------------------------------------------------------//
//!	画面処理クラス
class TunePage extends PpPage {
	public		$dspObj;		//!<	出力データ
	public		$elems;			//!<	HTML要素出力データ

	//------------------------------//
	//!	コンストラクタ
	public function __construct() {
		$this->dspObj = new stdClass();
		$this->elems = array();
		parent::__construct();
	}

	//------------------------------//
	//!	トークン埋め込み
	//!	@param	string	$token		トークン
	public function embedToken($token) {
		$this->elems['token'] = new HTML_Template_Flexy_Element;
		$this->elems['token']->setValue($token);
	}

	//------------------------------//
	//!	画面表示
	//!	@param	string	$tmplFile	テンプレートファイル名
	public function dispPage($tmplFile) {
		parent::display($tmplFile, $this->dspObj, $this->elems);
	}
}

//--------------------------------------------------------------//
//!	入力画面処理クラス
class TuneInputDsp extends TunePage {
	//------------------------------//
	//!	画面表示用データを作成
	//!	@param	array	$data		曲データ
	//!	@param	string	$message	メッセージ
	//!	@param	array	$artists	アーティストデータ
	//!	@param	array	$feelings	気持ちデータ
	public function makeDspData(array $data, $message, array $artists, array $feelings) {
		//	メッセージ
		$this->dspObj->message = $message;

		//	曲名
		if(isset($data['tune_name'])){
			$this->elems['tune_name'] = new HTML_Template_Flexy_Element;
			$this->elems['tune_name']->setValue($data['tune_name']);
		}

		//	アーティストのセレクトボックス
		$this->elems['artist_id'] = new HTML_Template_Flexy_Element;
		$this->elems['artist_id']->setOptions($artists);
		if($data['artist_id'] > 0){
			$this->elems['artist_id']->setValue($data['artist_id']);
		}

		//	気持ちのセレクトボックス
		$this->elems['feeling_id'] = new HTML_Template_Flexy_Element;
		$this->elems['feeling_id']->setOptions($feelings);
		if($data['feeling_id'] > 0){
			$this->elems['feeling_id']->setValue($data['feeling_id']);
		}
	}

	//------------------------------//
	//!	画面表示用データを作成
	//!	@param	array		$data		曲データ
	public function makeDspData2(array $data) {
		//	コメント
		if($data['comcont'] != ''){
			$this->elems['comcont'] = new HTML_Template_Flexy_Element;
			$this->elems['comcont']->setValue($data['comcont']);
		}

		//	曲IDを埋め込む
		$this->elems['id'] = new HTML_Template_Flexy_Element;
		$this->elems['id']->setValue($data['id']);
	}
}

//--------------------------------------------------------------//
//!	確認画面処理クラス
class TuneConfDsp extends TunePage {
	//------------------------------//
	//!	確認画面表示用データを作成
	//!	@param	array	$data			曲データ
	//!	@param	string	$message		メッセージ
	//!	@param	string	$artist_name	アーティスト名
	//!	@param	string	$feeling_name	気持ち名
	public function makeDspData(array $data, $message, $artist_name, $feeling_name) {
		$this->dspObj->tune_name	= $data['tune_name'];	//	曲名
		$this->dspObj->artist_name	= $artist_name;			//	アーティスト名
		$this->dspObj->feeling_name	= $feeling_name;		//	気持ち名

		//	コメントを改行コードで分割する
		if(isset($data['comcont'])){
			$this->dspObj->comconts = preg_split("/\x0A+/u", $data['comcont']);
		}

		//	曲IDを埋め込む
		$this->elems['id'] = new HTML_Template_Flexy_Element;
		$this->elems['id']->setValue($data['id']);
	}
}
