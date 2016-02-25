<?php
require_once 'tuneConfig.php';
//--------------------------------------------------------------//
//!	曲データ検索画面クラス
class TuneSearchState implements TuneState {
	const	TMPLFILE = 'tonemesearch.html';	//!<	画面テンプレートファイル

	//------------------------------//
	//!	チェック処理
	//!	@param	object	$ppDt	曲データ
	//!	@return	object			メッセージ情報	null:正常
	protected function checkProc(TuneData $ppDt) {
		//	入力値チェック処理
		try{
			if($ppDt->data['tune_name'] != ''){
				$handler = new ChkEncodeHandler();
				$handler->setHandler(new ChkMaxLengthHandler(20));
				if(($ret = $handler->doCheck($ppDt->data['tune_name'])) !== 0){
					throw new Exception('tune_name', $ret);
				}
			}

			//	アーティストID
			if(!empty($ppDt->data['artist_id'])){
				$handler = new ChkEncodeHandler();
				$handler->setHandler(new ChkNumMinMaxHandler(1, 99));
				if(($ret = $handler->doCheck($ppDt->data['artist_id'])) !== 0){
					throw new Exception('artist_id', $ret);
				}
			}

			//	気持ちID
			if(!empty($ppDt->data['feeling_id'])){
				$handler = new ChkEncodeHandler();
				$handler->setHandler(new ChkNumMinMaxHandler(1, 99));
				if(($ret = $handler->doCheck($ppDt->data['feeling_id'])) !== 0){
					throw new Exception('feeling_id', $ret);
				}
			}
		}
		catch(Exception $e){	//	エラー
			$ppDt->data['tune_name'] = '';
			$ppDt->data['artist_id'] = 0;
			$ppDt->data['feeling_id'] = 0;
			return new TuneMsgInfo($e->getMessage(), $e->getCode());
		}
		return null;
	}

	//------------------------------//
	//!	POST値取得＆チェック
	//!	@param	object	$ppMg	データマネージャオブジェクト
	//!	@return	object			状態オブジェクト
	public function doCheck(TuneDataManager $ppMg) {
		$ppDt = $ppMg->getPpDt();
		$inDt = $ppMg->getInDt();
		if($inDt->isPost()){	//	POSTされた検索条件を取得する
			$ppDt->data['tune_name'] = $inDt->getPost('tune_name', '');
			$ppDt->data['artist_id'] = $inDt->getPost('artist_id', 0);
			$ppDt->data['feeling_id'] = $inDt->getPost('feeling_id', 0);
			$ppMg->setMsgInfo($this->checkProc($ppDt));
		}
		return $this;
	}

	//------------------------------//
	//!	曲検索と曲データ検索画面表示
	//!	@param	object	$ppMg	データマネージャオブジェクト
	public function doMain(TuneDataManager $ppMg) {
		$ppDt = $ppMg->getPpDt();

		//	曲を検索する。$recordsにオブジェクトの配列が返ります。
		$ddb = new TuneDao(TUNE_DB_GUEST);
		$records = $ddb->getTuneDataAll($ppDt->data['tune_name'],
										$ppDt->data['artist_id'],
										$ppDt->data['feeling_id']);

		//	セレクトボックス用のデータを作成する
		$artists = $ddb->getNames('artists');
		$feelings = $ddb->getNames('feelings');
		$artists[0]  = '指定しない';
		$feelings[0] = '指定しない';
		ksort($artists);
		ksort($feelings);

		//	画面表示データを設定する
		$dsp = new TuneInputDsp();
		$dsp->makeDspData($ppDt->data, $ppMg->getMessage(), $artists, $feelings);
		$dsp->dspObj->records = $records;

		//	各曲の編集／削除のリンクを作成する
		foreach($dsp->dspObj->records as $rec){
			$tid = (string)$rec->tid;
			$dsp->elems['ed' . $tid] = new HTML_Template_Flexy_Element;
			$dsp->elems['ed' . $tid]->attributes['href'] = 'edit.php?id=' . $tid;
			$dsp->elems['dd' . $tid] = new HTML_Template_Flexy_Element;
			$dsp->elems['dd' . $tid]->attributes['href'] = 'delete.php?id=' . $tid;
			$rec->cmntflg = ($rec->comcont == '') ? 'なし' : 'あり';
		}
		$dsp->dispPage(self::TMPLFILE);	//	画面表示
	}
}
