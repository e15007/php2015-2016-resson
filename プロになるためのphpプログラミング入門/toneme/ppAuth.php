<?php
//!	認証処理サンプル	認証チェック処理クラス
require_once 'ppAuthLogin.php';
require_once 'ppSession.php';
//--------------------------------------------------------------//
//!	認証チェック処理クラス
class PpAuth {
	protected	$options = array();		//!<	オプション
	protected	$sessoption = array();	//!<	セッションオプション
	protected	$sessobj = null;		//!<	セッションクラスオブジェクト

	//!	コンストラクタ
	//!	@param	array	$opts		オプション配列
	public function __construct(array $opts = array()) {
		$this->setDefaults();
		if(is_array($opts) && count($opts) > 0){
			$this->options = array_merge($this->options, $opts);
		}

		$this->sessoption['timeout'] = 0;
		if(isset($opts['timeout'])){
			$this->sessoption['timeout'] = $opts['timeout'];	//	セッションタイムアウト
		}
	}

	//!	デフォルトオプション設定
	protected function setDefaults() {
		$this->options['db_host']		= 'localhost';	//	DBホスト
		$this->options['db_user']		= '';			//	DB接続ユーザ
		$this->options['db_password']	= '';			//	DB接続パスワード
		$this->options['db_name']		= '';			//	DB名
		$this->options['db_encoding']	= 'utf8mb4';	//	DB文字エンコーディング
		$this->options['security_salt']	= '';			//	ソルト値
		$this->options['cryptType']		= 'sha256';		//	暗号化方法
		$this->options['tmplfile']		= 'ppLogin.html';//	ログイン画面テンプレート
		$this->options['login_page']	= '';			//	ログインページ
		$this->options['loginok_page']	= '';			//	ログイン後ページ
		$this->options['sessname']		= '';			//	セッション名
	}

	//!	ログイン中かチェックする
	//!	@return	boolean		true:ログイン中	false:ログインしていない(未認証)
	protected function chkLogined() {
		$sess = new PpSession($this->options['sessname'], $this->sessoption);
		if(!$sess->sessionExists()){
			return false;
		}
		if(!$sess->start()){	//	セッション開始とタイムアウトチェック
			$sess->endProc();	//	セッション終了
			return false;
		}

		$loggedin = $sess->get('loggedin');
		if(empty($loggedin)){
			$sess->endProc();	//	セッション終了
			return false;
		}

		$this->sessobj = $sess;	//	セッション処理オブジェクト
		return true;
	}

	//!	セッション処理オブジェクトを取得
	//!	@return	object	セッションクラス(PpSession)オブジェクト
	public function getSessObj() {
		return $this->sessobj;
	}

	//!	未ログインならログイン画面へ遷移する
	public function isLogined() {
		if(!$this->chkLogined()){
			$url = 'Location: http://' . $_SERVER['HTTP_HOST'] . $this->options['login_page'];
			header($url, true, 303);	//	ログイン画面へ遷移
			exit;
		}
	}

	//!	ログイン処理
	public function loginProc() {
		$obj = new PpAuthLogin($this->options);
		$obj->loginProc();
	}
}
