<?php
//--------------------------------------------------------------//
//!	メッセージ情報クラス
class TuneTp {
	const T_ENCODE		= 1;	//!<	文字エンコーディングエラー
	const T_MAXLEN		= 2;	//!<	文字列長エラー
	const T_NUMRNG		= 3;	//!<	数値範囲エラー
	const T_OTHER		= 10;	//!<	その他のエラー

	//!	画面に表示するメッセージ
	public static $msg = array(
		'other'		=> array(	self::T_OTHER		=>	'エラーです'),
		'tune_name'	=> array(	self::T_ENCODE		=>	'曲名のエラーです',
								self::T_MAXLEN		=>	'曲名は20文字以内で入力してください'),
		'comcont'	=> array(	self::T_ENCODE		=>	'コメントのエラーです',
								self::T_MAXLEN		=>	'コメントは30文字以内で入力してください'),
		'artist_id'	=> array(	self::T_NUMRNG		=>	'アーティストを選択してください'),
		'feeling_id'=> array(	self::T_NUMRNG		=>	'気持ちを選択してください'	));
}

//--------------------------------------------------------------//
//!	チェック処理クラス
abstract class CheckHandler {
	protected	$nextHandler;	//!<	次にチェーンするチェック処理ハンドラ
	protected	$encoding;		//!<	文字エンコーディング

	//!	コンストラクタ
	public function __construct() {
		$this->nextHandler = NULL;
		$this->encoding = 'UTF-8';
	}

	//!	次にチェーンするハンドラを設定
	//!	@param	object	$handler	次にチェーンするハンドラ
	//!	@return	object				自身のインスタンス
	public function setHandler(CheckHandler $handler) {
		$this->nextHandler = $handler;
		return $this;
	}

	//!	次にチェーンするハンドラを取得
	//!	@return	object				次にチェーンするハンドラ
	protected function getNextHandler() {
		return $this->nextHandler;
	}

	//!	チェーンハンドラ実行
	//!	@param		mixed	$val	チェックするデータ
	//!	@return		integer			0:OK	0以外:エラーコード
	public function doCheck($val) {
		//	チェック処理 false:NG
		if(!$this->check($val)){
			return $this->getErrorCode();	//	エラーコードを返す
		}
		//	チェックOKの場合は、次のチェーンハンドラを呼び出す
		if(!is_null($this->getNextHandler())){
			return $this->getNextHandler()->doCheck($val);
		}
		return 0;	//	チェーン終了
	}

	protected abstract function check($val);	//!<	チェック処理
	protected abstract function getErrorCode();	//!<	エラーコード取得
}

//--------------------------------------------------------------//
//!	文字エンコーディングのチェック
class ChkEncodeHandler extends CheckHandler {
	//!	チェック処理
	//!	@param	mixed	$val	チェックするデータ
	//!	@return	boolean			true:OK		false:NG
	protected function check($val) {
		return (is_string($val) && mb_check_encoding($val, $this->encoding));
	}

	//!	エラーコードを返す
	//!	@return	integer		エラーコード
	protected function getErrorCode() {
		return TuneTp::T_ENCODE;
	}
}

//--------------------------------------------------------------//
//!	文字列長、制御コードのチェック
class ChkMaxLengthHandler extends CheckHandler {
	protected	$maxLength;		//!<	許可する最大文字列長

	//!	コンストラクタ
	//!	@param	mixed	$maxLength	許可する最大文字列長
	public function __construct($maxLength = 30) {
		parent::__construct();
		$this->maxLength = $maxLength;
	}

	//!	チェック処理
	//!	@param	mixed	$val	チェックするデータ
	//!	@return	boolean			true:OK		false:NG
	protected function check($val) {
		$ptn = '/\A[[:^cntrl:]]{1,' . (int)$this->maxLength . '}\z/u';
		return preg_match($ptn, $val);
	}

	//!	エラーコードを返す
	//!	@return	integer		エラーコード
	protected function getErrorCode() {
		return TuneTp::T_MAXLEN;
	}
}

//--------------------------------------------------------------//
//!	文字列長、制御コードのチェック、改行は許す
class ChkMaxLengthMnHandler extends CheckHandler {
	protected	$maxLength;		//!<	許可する最大文字列長

	//!	コンストラクタ
	//!	@param	mixed	$maxLength	許可する最大文字列長
	public function __construct($maxLength = 30) {
		parent::__construct();
		$this->maxLength = $maxLength;
	}

	//!	チェック処理
	//!	@param	mixed	$val	チェックするデータ
	//!	@return	boolean			true:OK		false:NG
	protected function check($val) {
		$ptn = '/\A[\r\n[:^cntrl:]]{1,' . (int)$this->maxLength . '}\z/u';
		return preg_match($ptn, $val);
	}

	//!	エラーコードを返す
	//!	@return	integer		エラーコード
	protected function getErrorCode() {
		return TuneTp::T_MAXLEN;
	}
}

//--------------------------------------------------------------//
//!	整数値が範囲チェック
class ChkNumMinMaxHandler extends CheckHandler {
	protected	$min;	//!<	最小値
	protected	$max;	//!<	最大値

	//!	コンストラクタ
	//!	@param	integer	$min	最小値
	//!	@param	integer	$max	最大値
	public function __construct($min = 0, $max = 0) {
		parent::__construct();
		$this->min = (int)$min;
		$this->max = (int)$max;
	}

	//!	チェック処理
	//!	@param		mixed	$val	チェックするデータ
	//!	@return		boolean			true:OK		false:NG
	protected function check($val) {
		$val = (int)$val;
		return ($val >= $this->min && $val <= $this->max);
	}

	//!	エラーコードを返す
	//!	@return	integer		エラーコード
	protected function getErrorCode() {
		return TuneTp::T_NUMRNG;
	}
}
