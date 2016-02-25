<?php
require_once 'tuneConfig.php';
//--------------------------------------------------------------//
//!	曲データ編集画面クラス
class TuneEditInState implements TuneState {
	const	TMPLFILE = 'tonemeedit.html';	//!<	画面テンプレートファイル

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
	//!	曲データ編集画面表示
	//!	@param	object	$ppMg	データマネージャオブジェクト
	public function doMain(TuneDataManager $ppMg) {
		$ppDt = $ppMg->getPpDt();

		//	トークンをセッション変数に設定
		$token = $ppMg->genTokenStr();
		$ppMg->setTokenStr($token);

		//	アーティストと気持ちのセレクトボックス用データをDBから取得
		$ddb = new TuneDao(TUNE_DB_ADMIN);
		$artists = $ddb->getNames('artists');
		$feelings = $ddb->getNames('feelings');

		//	画面表示データを作成する
		$dsp = new TuneInputDsp();
		$dsp->embedToken($token);		//	トークンを埋め込む
		$dsp->makeDspData($ppDt->data, $ppMg->getMessage(), $artists, $feelings);
		$dsp->makeDspData2($ppDt->data);
		$dsp->dispPage(self::TMPLFILE);	//	画面表示
	}
}

//--------------------------------------------------------------//
//!	曲データ更新処理クラス
class TuneEditDbState implements TuneState {
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
			if($ddb->getById($id) === null){
				throw new Exception();
			}
		} catch(Exception $e){		//	NG
			$ppMg->moveSearch();	//	曲データ検索画面へ遷移
		}
		return $ppMg->chkInData($ppDt->data);
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
		$ppDt->data['id']			= $inDt->getPost('id');			//	曲ID
		$ppDt->data['tune_name']	= $inDt->getPost('tune_name');	//	曲名
		$ppDt->data['artist_id']	= $inDt->getPost('artist_id');	//	アーティストID
		$ppDt->data['feeling_id']	= $inDt->getPost('feeling_id');	//	気持ちID
		$ppDt->data['comcont']		= $inDt->getPost('comcont');	//	コメント

		//	エラー発生時は、画面ステートに変更する
		if(($msgInfo = $this->checkProc($ppMg)) !== null){
			$ppMg->setMsgInfo($msgInfo);
			return new TuneEditInState();
		}
		return $this;
	}

	//------------------------------//
	//!	曲更新処理
	//!	@param	object	$ppMg	データマネージャオブジェクト
	public function doMain(TuneDataManager $ppMg) {
		$ppDt = $ppMg->getPpDt();

		//	コメントデータの改行を0x0Aに統一する
		$ppDt->data['comcont'] = preg_replace("/\x0D\x0A|\x0D/u", "\x0A", $ppDt->data['comcont']);

		$ddb = new TuneDao(TUNE_DB_ADMIN);
		$ddb->update($ppDt->data['id'], $ppDt->data);	//	曲更新
		$ppMg->moveSearch();							//	曲データ検索画面へ遷移
	}
}
