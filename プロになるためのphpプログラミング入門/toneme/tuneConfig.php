<?php
//--------------------------------------------------------------//
//!	設定用データクラス
class TuneConfig {
	public $db_host			= 'localhost';			//!<	DBホスト
	public $db_user			= 'ppguest';			//!<	DB接続ユーザ
	public $db_password		= '1234';			//!<	DB接続パスワード
	public $db_useradm		= 'ppadmin';			//!<	DB接続ユーザ
	public $db_passwordadm	= '1234';			//!<	DB接続パスワード
	public $db_name			= 'ppdb';				//!<	DB名
	public $db_encoding		= 'utf8mb4';			//!<	DB文字エンコーディング
	public $security_salt	= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMN';	//!<	ソルト値
	public $login_page		= '/toneme/login.php';	//!<	ログインページ
	public $loginok_page	= '/toneme/search.php';	//!<	ログイン後ページ
	public $sessname		= 'SESSTONEME';			//!<	セッション名
}

const TUNE_CFG_CLASS = 'TuneConfig';
const TUNE_DB_ADMIN = 'adm';
const TUNE_DB_GUEST = '';

require_once 'webProc.php';		//	Web共通処理クラス
require_once 'chkHandler.php';	//	入力値チェック処理クラス
require_once 'tuneDtbs.php';	//	データベース処理クラス
require_once 'tuneProc.php';	//	共通処理クラス
require_once 'tunePage.php';	//	画面処理クラス
