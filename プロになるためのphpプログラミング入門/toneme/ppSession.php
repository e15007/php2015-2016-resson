<?php
//!	セッション管理のサンプル	セッション管理処理クラス
//------------------------------//
//!	セッション管理クラス
class PpSession {
	protected	$timeout;	//!<	セッションタイムアウト時間

	//!	コンストラクタ
	//!	@param	string	$sessname	セッション名
	//!	@param	array	$params		オプション
	public function __construct($sessname = null, array $params = array()) {
		if(is_string($sessname) && !empty($sessname)){
			session_name($sessname);
		}

		//	タイムアウト時間が指定されていないときは
		//	セッションガーベジコレクタの時間をセッションタイムアウト時間とする
		$gc_maxlifetime = ini_get('session.gc_maxlifetime');
		$this->timeout = $gc_maxlifetime;
		if(is_array($params) && count($params) > 0){
			if(isset($params['timeout']) && ($params['timeout'] > 0)){
				if($gc_maxlifetime < $params['timeout']){
					ini_set('session.gc_maxlifetime', $params['timeout']);
				}
				$this->timeout = $params['timeout'];
			}
		}
	}

	//!	セッション存在チェック
	//!	@return	boolean		true:セッション開始中
	public function sessionExists() {
		if(isset($_COOKIE[session_name()])){
			return true;
		}
		return false;
	}

	//!	セッション開始とタイムアウトチェック
	//!	@return	boolean	true	:セッションタイムアウトしていない
	//!					false	:セッションタイムアウトした
	public function start() {
		session_start();

		$now = time();
		$lastreq = $this->get('lastreq', $now);		//	前回アクセス時刻を取得
		$this->set('lastreq', $now);				//	アクセス時刻を保存
		if(($lastreq + $this->timeout) <= $now){	//	タイムアウト？
			return false;
		}
		return true;
	}

	//!	セッションIDを生成しなおす
	public function regenerate() {
		session_regenerate_id(true);
	}

	//!	クッキー削除要求処理
	public function delCookie() {
		if($this->sessionExists()){
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
						$params['path'],   $params['domain'],
						$params['secure'], $params['httponly']);
		}
	}

	//!	セッション終了処理
	public function endProc() {
		$this->clear();
		$this->delCookie();
		session_destroy();
	}

	//!	セッション変数設定
	//!	@param	string	$key	キー
	//!	@param	mixed	$value	設定する値
	public function set($key, $value) {
		$_SESSION[$key] = $value;
	}

	//!	セッション変数取得
	//!	@param	string	$key		キー
	//!	@param	mixed	$default	存在しない場合のデフォルト値
	//!	@return	string				セッション変数値
	public function get($key, $default = null) {
		if(isset($_SESSION[$key])){
			return $_SESSION[$key];
		}
		return $default;
	}

	//!	セッション変数削除
	//!	@param	string	$key		キー
	public function remove($key) {
		if(isset($_SESSION[$key])){
			unset($_SESSION[$key]);
		}
	}

	//!	セッション変数クリア
	public function clear() {
		$_SESSION = array();
	}
}
