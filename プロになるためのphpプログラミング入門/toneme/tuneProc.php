<?php
require_once 'ppAuth.php';
//--------------------------------------------------------------//
//!	状態クラス（ステートクラス）
interface TuneState {
	public function doCheck(TuneDataManager $ppMg);	//!<	チェック処理
	public function doMain(TuneDataManager $ppMg);	//!<	メイン処理
}

//--------------------------------------------------------------//
//!	メッセージ情報
class TuneMsgInfo {
	public	$idd;	//!<	データ識別子
	public	$msgNo;	//!<	メッセージ番号

	//!	コンストラクタ
	//!	@param	string	$idd	データ識別子
	//!	@param	integer	$msgNo	メッセージ番号
	public function __construct($idd = 0, $msgNo = 0) {
		$this->idd = $idd;
		$this->msgNo = $msgNo;
	}
}

//--------------------------------------------------------------//
//!	曲データ情報
class TuneData {
	public	$data;	//!<	曲データ

	//!	コンストラクタ
	public function __construct() {
		$this->data['id'] = 0;			//	曲ID
		$this->data['tune_name'] = '';	//	曲名
		$this->data['artist_id'] = 0;	//	アーティストID
		$this->data['feeling_id'] = 0;	//	気持ちID
		$this->data['comcont'] = '';	//	コメント
	}
}

//--------------------------------------------------------------//
//!	データマネージャクラス
class TuneDataManager {
	protected	$inDt;		//!<	入力データ（TuneInput）
	protected	$ppDt;		//!<	曲データ（TuneData）
	protected	$msgInfo;	//!<	メッセージ情報（TuneMsgInfo）

	//!	コンストラクタ
	//!	@param	object	$inDt	入力データ
	public function __construct(TuneInput $inDt) {
		$this->inDt = $inDt;
		$this->ppDt = new TuneData();
		$this->msgInfo = null;
	}

	//!	曲データ取得
	public function getPpDt() {
		return $this->ppDt;
	}

	//!	入力データ取得
	public function getInDt() {
		return $this->inDt;
	}

	//------------------------------//
	//!	入力値のチェック
	//!	@param	array		$data	チェックするデータ
	//!	@return	object				エラー時、TuneMsgInfoオブジェクト
	public function chkInData(array $data) {
		try{
			//	文字エンコーディングのチェック
			$handler = new ChkEncodeHandler();

			//	曲名	1～20文字
			$handler->setHandler(new ChkMaxLengthHandler(20));
			if(($ret = $handler->doCheck($data['tune_name'])) !== 0){
				throw new Exception('tune_name', $ret);
			}

			//	コメント	0～30文字
			if($data['comcont'] != ''){
				$handler->setHandler(new ChkMaxLengthMnHandler(30));
				if(($ret = $handler->doCheck($data['comcont'])) !== 0){
					throw new Exception('comcont', $ret);
				}
			}

			//	アーティストID	1～99
			$handler->setHandler(new ChkNumMinMaxHandler(1, 99));
			if(($ret = $handler->doCheck($data['artist_id'])) !== 0){
				throw new Exception('artist_id', $ret);
			}

			//	気持ちID		1～99
			$handler->setHandler(new ChkNumMinMaxHandler(1, 99));
			if(($ret = $handler->doCheck($data['feeling_id'])) !== 0){
				throw new Exception('feeling_id', $ret);
			}
		}
		catch(Exception $e){	//	NG
			return new TuneMsgInfo($e->getMessage(), $e->getCode());
		}
		return null;			//	OK
	}

	//------------------------------//
	//!	曲IDの範囲チェック
	//!	@param	integer		$id		曲ID
	//!	@return	boolean				true: OK	false;NG
	public function chkTuneIdRng($id) {
		return ($id > 0 && $id <= 999);
	}

	//------------------------------//
	//!	曲データ検索画面へ遷移
	public function moveSearch() {
		$cfgData = get_class_vars(TUNE_CFG_CLASS);
		$url = 'Location: http://' . $_SERVER['HTTP_HOST'] . $cfgData['loginok_page'];
		header($url, true, 303);		//	曲データ検索画面へ遷移
		exit;
	}

	//------------------------------//
	//!	表示メッセージを取得
	//!	@return	string		表示メッセージ
	public function getMessage() {
		$msg = '';
		if(!empty($this->msgInfo) && $this->msgInfo->msgNo !== 0){
			$msg = TuneTp::$msg[$this->msgInfo->idd][$this->msgInfo->msgNo];
		}
		return $msg;
	}

	//------------------------------//
	//!	メッセージ情報設定
	//!	@param	TuneMsgInfo	$msgInfo	メッセージ情報オブジェクト
	public function setMsgInfo($msgInfo) {
		$this->msgInfo = $msgInfo;
	}

	//------------------------------//
	//!	トークン生成
	//!	@return	string				生成したトークン
	public function genTokenStr() {
		return hash('sha1', 'tk_toneme_' . session_id());
	}

	//------------------------------//
	//!	トークンをセッション変数に保存
	//!	@param	string	$token		トークン
	public function setTokenStr($token) {
		$this->inDt->setSession('token', $token);
	}

	//------------------------------//
	//!	トークンのチェック
	//!	@return	boolean				true:OK	false:NG
	public function chkTokenStr() {
		$sid = session_id();
		if(empty($sid)){
			return false;	//	セッションを開始していない
		}

		$tokSess = $this->inDt->getSession('token');
		$this->inDt->unsetSession('token');
		if(empty($tokSess)){
			return false;	//	セッション変数にトークンがない
		}

		if(!$this->inDt->isPost()){
			return false;	//	POSTメソッドでない
		}

		$tokPost = $this->inDt->getPost('token');
		if(empty($tokPost)){
			return false;	//	フォームにトークンがない
		}

		if($tokPost !== $tokSess){
			return false;	//	トークンが間違っている
		}
		return true;
	}
}

//--------------------------------------------------------------//
//!	状態管理クラス
class TuneCont {
	protected	$state;	//!<	状態オブジェクト(TuneState)
	protected	$ppMg;	//!<	データマネージャオブジェクト(TuneDataManager)

	//------------------------------//
	//!	コンストラクタ
	//!	@param	object		$ppMg	データマネージャオブジェクト
	//!	@param	object		$state	状態オブジェクト
	public function __construct(TuneDataManager $ppMg, TuneState $state) {
		$this->ppMg = $ppMg;
		$this->state = $state;
	}

	//------------------------------//
	//!	メイン処理
	public function doMain() {
		$this->state = $this->state->doCheck($this->ppMg);
		$this->state->doMain($this->ppMg);
	}
}

//--------------------------------------------------------------//
//!	認証処理クラス
class TuneAuth extends PpAuth {
	//!	コンストラクタ
	public function __construct(array $options = array()) {
		$cfgData = get_class_vars(TUNE_CFG_CLASS);
		$opts = array(	'db_host'		=> $cfgData['db_host'],
						'db_user'		=> $cfgData['db_user'],
						'db_password'	=> $cfgData['db_password'],
						'db_name'		=> $cfgData['db_name'],
						'db_encoding'	=> $cfgData['db_encoding'],
						'security_salt'	=> $cfgData['security_salt'],
						'tmplfile'		=>'tonemelogin.html',
						'login_page'	=> $cfgData['login_page'],
						'loginok_page'	=> $cfgData['loginok_page'],
						'sessname'		=> $cfgData['sessname']	);

		if(is_array($options) && count($options) > 0){
			$opts = array_merge($opts, $options);
		}

		parent::__construct($opts);
	}
}
