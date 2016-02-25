<?php
//!	認証処理サンプル	認証用データベース処理
class PpAuthDb {
	protected	$options = array();	//!<	オプション
	protected	$db = null;			//!<	DB接続オブジェクト

	//!	コンストラクタ
	public function __construct($opts = array()) {
		$this->options = $opts;
	}

	//!	DB接続
	//!	@return	boolean		true:OK	false:NG
	protected function connect() {
		if(is_subclass_of($this->db, 'mysqli')){
			return true;
		}

		$mysqli = @new mysqli(	$this->options['db_host'],
								$this->options['db_user'],
								$this->options['db_password'],
								$this->options['db_name']);
		if($mysqli->connect_errno === 0){	//	接続OK
			$mysqli->set_charset($this->options['db_encoding']);
			$this->db = $mysqli;
			return true;
		}
		return false;
	}

	//!	ユーザに一致するパスワードを取得する
	//!	@param	string	$user	ユーザ名
	//!	@return	string			パスワード
	public function getPasswd($user) {
		if(!$this->connect()){	//	DB接続
			return null;
		}

		$passwd = null;
		$sql = 'SELECT username, password FROM users WHERE username = ?';
		$sth = $this->db->stmt_init();
		if($sth->prepare($sql)){
			$sth->bind_param('s', $user);
			$sth->execute();
			$sth->bind_result($rs_user, $rs_passwd);
			if($sth->fetch()){
				$passwd = $rs_passwd;
			}
			$sth->close();
		}
		return $passwd;
	}
}
