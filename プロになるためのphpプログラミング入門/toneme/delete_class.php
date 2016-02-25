<?php
require_once 'tuneConfig.php';
//--------------------------------------------------------------//
//!	曲データ削除画面クラス
class TuneDeleteConfState implements TuneState {
	const	TMPLFILE = 'tonemedel.html';	//!<	画面テンプレートファイル

	//------------------------------//
	//!	入力値チェック
	//!	@param	object	$ppMg	データマネージャオブジェクト
	//!	@return	object			メッセージ情報	null:正常
	protected function checkProc(TuneDataManager $ppMg) {
		$id = (int)$ppMg->getInDt()->getGet('id');	//	曲ID
		try{
			if(!$ppMg->chkTuneIdRng($id)){
				throw new Exception();
			}
			$ddb = new TuneDao(TUNE_DB_ADMIN);
			if(($tune = $ddb->getById($id)) === null){
				throw new Exception();
			}
		} catch(Exception $e){		//	NG
			$ppMg->moveSearch();	//	曲データ検索画面へ遷移
		}
		$ppMg->getPpDt()->data = $tune;
		return null;
	}

	//------------------------------//
	//!	チェック処理
	//!	@param	object	$ppMg	データマネージャオブジェクト
	//!	@return	object			状態オブジェクト
	public function doCheck(TuneDataManager $ppMg) {
		$this->checkProc($ppMg);
		return $this;
	}

	//------------------------------//
	//!	曲データ削除画面表示
	//!	@param	object	$ppMg	データマネージャオブジェクト
	public function doMain(TuneDataManager $ppMg) {
		$ppDt = $ppMg->getPpDt();

		//	トークンをセッション変数に設定
		$token = $ppMg->genTokenStr();
		$ppMg->setTokenStr($token);

		//	アーティストと気持ちのデータをDBから取得
		$ddb = new TuneDao(TUNE_DB_ADMIN);
		$artist_name  = $ddb->getNameById('artists', $ppDt->data['artist_id']);
		$feeling_name = $ddb->getNameById('feelings', $ppDt->data['feeling_id']);

		//	画面表示データを作成する
		$dsp = new TuneConfDsp();
		$dsp->embedToken($token);		//	トークンを埋め込む
		$dsp->makeDspData($ppDt->data, '', $artist_name, $feeling_name);
		$dsp->dispPage(self::TMPLFILE);	//	画面表示
	}
}

//--------------------------------------------------------------//
//!	曲データ削除処理クラス
class TuneDeleteDbState implements TuneState {
	//------------------------------//
	//!	入力値チェック
	//!	@param	object	$ppMg	データマネージャオブジェクト
	//!	@return	object			メッセージ情報	null:正常
	protected function checkProc(TuneDataManager $ppMg) {
		$ppDt = $ppMg->getPpDt();
		$id = (int)$ppDt->data['id'];	//	曲ID
		try{
			if(!$ppMg->chkTuneIdRng($id)){
				throw new Exception();
			}
			$ddb = new TuneDao(TUNE_DB_ADMIN);
			if(($tune = $ddb->getById($id)) === null){
				throw new Exception();
			}
		} catch(Exception $e){		//	NG
			$ppMg->moveSearch();	//	曲データ検索画面へ遷移
		}
		return null;
	}

	//------------------------------//
	//!	チェック処理
	//!	@param	object	$ppMg	データマネージャオブジェクト
	//!	@return	object			状態オブジェクト
	public function doCheck(TuneDataManager $ppMg) {
		$inDt = $ppMg->getInDt();
		if(!$ppMg->chkTokenStr()){	//	トークンのチェック
			die('error.');
		}

		//	POSTされたデータを取得する
		$ppDt = $ppMg->getPpDt();
		$ppDt->data['id'] = $inDt->getPost('id');	//	曲ID
		$this->checkProc($ppMg);
		return $this;
	}

	//------------------------------//
	//!	曲削除処理
	//!	@param	object	$ppMg	データマネージャオブジェクト
	public function doMain(TuneDataManager $ppMg) {
		$ppDt = $ppMg->getPpDt();
		$ddb = new TuneDao(TUNE_DB_ADMIN);
		$ddb->delete($ppDt->data['id']);	//	曲削除
		$ppMg->moveSearch();				//	曲データ検索画面へ遷移
	}
}
