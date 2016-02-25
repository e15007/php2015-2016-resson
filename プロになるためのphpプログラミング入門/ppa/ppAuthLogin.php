<?php
//!	認証処理サンプル	ログイン画面処理クラス
require_once 'ppAuthDb.php';
require_once 'ppSession.php';
require_once 'ppPage.php';
//--------------------------------------------------------------//
//!	ログイン画面処理クラス
class PpAuthLogin {
	protected	$options = array();		//!<	オプション
	protected	$encoding;				//!<	文字エンコーディング

	//!	コンストラクタ
	//!	@param	array	$opts		オプション配列
	public function __construct(array $opts = array()) {
		$this->options = $opts;			//	オプション
		$this->encoding = 'UTF-8';		//	文字エンコーディング
	}

	//!	入力値チェック
	//!	@param	string	$user	ユーザ名
	//!	@param	string	$passwd	パスワード
	//!	@return	boolean			true:OK	false:NG
	protected function chkInput($user, $passwd) {
		//	文字エンコーディングチェック
		if(!mb_check_encoding($user, $this->encoding)
		|| !mb_check_encoding($passwd, $this->encoding)){
			return false;
		}

		//	文字数と使用文字のチェックを行う
		if(preg_match('/\A[a-z0-9]{6,20}\z/ui', $user) == 0) {
			return false;
		}

		//	文字数と使用文字のチェックを行う
		if(preg_match('/\A[a-z0-9]{10,100}\z/ui', $passwd) == 0) {
			return false;
		}
		return true;
	}

	//!	ログアウト処理
	protected function logout() {
		$sess = new PpSession($this->options['sessname']);
		if($sess->sessionExists()){
			$sess->start();
			$sess->endProc();
		}
	}

	//!	ログイン成功処理
	protected function loggedin() {
		$sess = new PpSession($this->options['sessname']);
		$exist = $sess->sessionExists();
		$sess->start();
		if($exist){
			$sess->regenerate();	//	セッションIDを生成しなおす
		}
		$sess->set('loggedin', 1);
		$url = 'Location: http://' . $_SERVER['HTTP_HOST'] . $this->options['loginok_page'];
		header($url, true, 303);	//	ログイン後画面へ遷移
	}

	//!	パスワードチェック処理
	//!	@param	string	$passwd		パスワード（ユーザからの入力値）
	//!	@param	string	$passwddb	パスワード（DBからの取得値）
	//!	@return	boolean				true:パスワード一致	false:一致しない
	protected function chkPasswd($passwd, $passwddb) {
		$string = $this->options['security_salt'] . $passwd;
		$passcrypt = hash($this->options['cryptType'], $string);
		if($passcrypt === $passwddb){
			return true;
		}
		return false;
	}

	//!	認証処理
	//!	@return	integer		0:OK	0以外:NG
	protected function chkAuth() {
		if($_SERVER['REQUEST_METHOD'] !== 'POST'){
			return 0;
		}

		if(isset($_POST['logout'])){
			$this->logout();		//	ログアウト
			return 0;
		}

		if(!isset($_POST['login'], $_POST['username'], $_POST['password'])){
			return 0;
		}

		//	以下、認証処理
		$user   = $_POST['username'];
		$passwd = $_POST['password'];
		if($this->chkInput($user, $passwd)){	//	入力値チェック
			$db = new PpAuthDb($this->options);
			$passwddb = $db->getPasswd($user);
			if($passwddb !== null
			&& $this->chkPasswd($passwd, $passwddb)){
				$this->loggedin();				//	ログイン成功
				exit;
			}
		}
		return 1;	//	認証エラー
	}

	//!	ログイン画面表示
	//!	@param	integer	$msgNo		0以外:メッセージ番号
	protected function dispLogin($msgNo) {
		$page = new PpPage;
		$cdata = new stdClass;
		$cdata->errmsg = '';
		if($msgNo !== 0){
			$cdata->errmsg = 'ログインエラーです';
		}
		$elems['loginform'] = new HTML_Template_Flexy_Element;
		$elems['loginform']->attributes['action'] = $this->options['login_page'];
		$page->display($this->options['tmplfile'], $cdata, $elems);
	}

	//!	ログイン処理
	public function loginProc() {
		$ret = $this->chkAuth();	//	認証処理
		$this->dispLogin($ret);		//	ログイン画面表示
	}
}
