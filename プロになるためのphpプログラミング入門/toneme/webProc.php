<?php
//--------------------------------------------------------------//
//!	Web入力処理クラス
class TuneInput {
	protected	$sessobj = null;	//!<	セッションクラスオブジェクト

	//!	コンストラクタ
	//!	@param	string	$sessobj	セッション名
	public function __construct($sessobj = null) {
		$this->sessobj = $sessobj;	//	セッションクラス
	}

	//!	POSTデータを取得
	//!	@param	string	$key		キー
	//!	@param	mixed	$default	デフォルト値
	//!	@return	mixed				POSTデータ値
	public function getPost($key, $default = null) {
		if(isset($_POST[$key])){
			return $_POST[$key];
		}
		return $default;
	}

	//!	GETデータを取得
	//!	@param	string	$key		キー
	//!	@param	mixed	$default	デフォルト値
	//!	@return	mixed				GETデータ値
	public function getGet($key, $default = null) {
		if(isset($_GET[$key])){
			return $_GET[$key];
		}
		return $default;
	}

	//!	POST送信されたかチェック
	//!	@return	boolean	true:POST送信された
	public function isPost() {
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			return true;
		}
		return false;
	}

	//!	GET送信されたかチェック
	//!	@return	boolean	true:GET送信された
	public function isGet() {
		if($_SERVER['REQUEST_METHOD'] === 'GET'){
			return true;
		}
		return false;
	}

	//!	セッション処理オブジェクトを取得
	public function getSessObj() {
		return $this->sessobj;
	}

	//!	セッション変数設定
	//!	@param	string	$key		キー
	//!	@param	mixed	$value	設定する値
	public function setSession($key, $value) {
		if(is_object($this->sessobj)){
			$this->sessobj->set($key, $value);
		}
	}

	//!	セッション変数取得
	//!	@param	string	$key		キー
	//!	@param	mixed	$default	存在しない場合のデフォルト値
	//!	@return	string				セッション変数値
	public function getSession($key, $default = null) {
		if(is_object($this->sessobj)){
			return $this->sessobj->get($key, $default);
		}
		return $default;
	}

	//!	セッション変数削除
	//!	@param	string	$key		キー
	public function unsetSession($key) {
		if(is_object($this->sessobj)){
			$this->sessobj->remove($key);
		}
	}
}
