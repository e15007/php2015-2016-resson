<?php
//--------------------------------------------------------------//
//!	データベース接続処理クラス
class TuneDb {
	private	static	$dbh;	//!<	データベース接続インスタンス

	//!	データベース接続インスタンスを取得
	//!	@param	string	$acl	データベースアクセスユーザ識別
	//!	@return	object			Mysqliオブジェクト
	public static function getDbInstance($acl = '') {
		if(!isset(self::$dbh)){
			$cfgData = get_class_vars(TUNE_CFG_CLASS);
			self::$dbh = @new mysqli(	$cfgData['db_host'],
										$cfgData['db_user' . $acl],
										$cfgData['db_password' . $acl],
										$cfgData['db_name']	);
			if(self::$dbh->connect_errno){
				die('DB connect error');
			}
			//	文字エンコーディングを設定する	MySQL5.5未満では'utf8'
			self::$dbh->set_charset($cfgData['db_encoding']);
		}
		return self::$dbh;
	}
}

//--------------------------------------------------------------//
//!	データベース処理クラス
class TuneDao {
	protected	$acl;	//!<	データベースアクセスユーザ識別

	//------------------------------//
	//!	コンストラクタ
	//!	@param	string	$acl	データベースアクセスユーザ識別
	public function __construct($acl = '') {
		$this->acl = $acl;			//	'adm': 管理者
	}

	//------------------------------//
	//!	DB操作(SELECT)	IDをキーとする連想配列で取得する
	//!	@param	string	$tblName	テーブル名
	//!	@param	integer	$id			検索対象レコードのID
	//!	@return	array				検索レコード
	public function getNames($tblName, $id = 0) {
		$dbh = TuneDb::getDbInstance($this->acl);	//	DB接続インスタンスを取得
		$dbData = array();

		$sql = 'SELECT id, name FROM ' . $tblName;
		if($id > 0){
			$sql .= ' WHERE id = ?';
		}

		$sql .= ' ORDER BY id ASC';
		$sth = $dbh->stmt_init();
		if($sth->prepare($sql)){			//	SQL文を準備する
			if($id > 0){
				$sth->bind_param('i', $id);	//	IDをバインド
			}
			$sth->execute();
			$sth->bind_result($rid, $name);
			while($sth->fetch()){
				$dbData[$rid] = $name;		//	IDをキーとする連想配列
			}
			$sth->close();
		}
		return $dbData;
	}

	//------------------------------//
	//!	DB操作(SELECT)	IDに一致するデータを取得する
	//!	@param	string	$tblName	テーブル名
	//!	@param	integer	$id			検索対象レコードのID
	//!	@return	string				データ
	public function getNameById($tblName, $id = 0) {
		$item = '';
		if($id > 0){
			$items = $this->getNames($tblName, $id);
			if(!empty($items)){
				$item = $items[$id];
			}
		}
		return $item;
	}

	//------------------------------//
	//!	DB操作(SELECT)
	//!	@param	integer	$id	ID
	//!	@return	array		取得した曲データ
	public function getById($id) {
		$row = null;
		$dbh = TuneDb::getDbInstance($this->acl);	//	DB接続インスタンスを取得

		//	１件のレコードを検索するSQL
		$sql  = 'SELECT id, name as tune_name, artist_id, feeling_id, comcont';
		$sql .= ' FROM tunes WHERE id = ?';
		$sql .= ' ORDER BY id ASC LIMIT 0, 1';

		$sth = $dbh->stmt_init();
		if($sth->prepare($sql)){
			$sth->bind_param('i', $id);
			$sth->execute();
			$sth->bind_result($v1, $v2, $v3, $v4, $v5);
			if($sth->fetch()){
				$row['id']			= $v1;
				$row['tune_name']	= $v2;
				$row['artist_id']	= $v3;
				$row['feeling_id']	= $v4;
				$row['comcont']		= $v5;
			}
			$sth->close();
		}
		return $row;
	}

	//------------------------------//
	//!	DB操作(INSERT)
	//!	@param	array	$data			曲データ
	//!	@param	string	$inserted_id	追加した曲データのID
	//!	@return	integer					追加した行数
	public function insert(array $data, &$inserted_id) {
		$ret = 0;
		$dbh = TuneDb::getDbInstance($this->acl);	//	DB接続インスタンスを取得

		$inserted_id = null;

		//	１件のレコードを追加するSQL
		$sql  = 'INSERT INTO tunes (name, artist_id, feeling_id, comcont, modified)';
		$sql .= ' VALUES (?, ?, ?, ?, NOW())';
		$sth = $dbh->stmt_init();
		if($sth->prepare($sql)){
			$sth->bind_param('siis',
							$data['tune_name'],		//	曲名
							$data['artist_id'],		//	アーティストID
							$data['feeling_id'],	//	気持ちID
							$data['comcont']);		//	コメントID
			$sth->execute();
			$ret = $sth->affected_rows;
			$inserted_id = $sth->insert_id;
			$sth->close();
		}
		return $ret;
	}

	//------------------------------//
	//!	DB操作(UPDATE)
	//!	@param	integer	$id		ID
	//!	@param	array	$data	曲データ
	//!	@return	integer			更新した行数
	public function update($id, array $data) {
		$ret = 0;
		$dbh = TuneDb::getDbInstance($this->acl);

		//	１件のレコードを更新するSQL
		$sql  = 'UPDATE tunes SET name = ?, artist_id = ?, feeling_id = ?, comcont = ?';
		$sql .= ' WHERE id = ?';

		$sth = $dbh->stmt_init();
		if($sth->prepare($sql)){
			$sth->bind_param('siisi',
							$data['tune_name'],		//	曲名
							$data['artist_id'],		//	アーティストID
							$data['feeling_id'],	//	気持ちID
							$data['comcont'],		//	コメント
							$data['id']);			//	曲ID
			$sth->execute();
			$ret = $sth->affected_rows;
			$sth->close();
		}
		return $ret;
	}

	//------------------------------//
	//!	DB操作(DELETE)
	//!	@param	integer	$id		ID
	//!	@return	integer			削除した行数
	public function delete($id) {
		$ret = 0;
		$dbh = TuneDb::getDbInstance($this->acl);

		//	１件のレコードを削除するSQL
		$sql = 'DELETE FROM tunes WHERE id = ?';
		$sth = $dbh->stmt_init();
		if($sth->prepare($sql)){
			$sth->bind_param('i', $id);
			$sth->execute();
			$ret = $sth->affected_rows;
			$sth->close();
		}
		return $ret;
	}

	//------------------------------//
	//!	検索条件を作成
	//!	@param	string	$tn		曲名
	//!	@param	integer	$aid	アーティストID
	//!	@param	integer	$fid	気持ちID
	//!	@return	array			検索条件
	protected function makeCondData($tn, $aid, $fid) {
		$cc = array();
		$data = array();
		$sqls = array();
		$pkid = array();

		if(isset($tn) && $tn != ''){	//	曲名
			$tn = preg_replace('/([_%#])/u', '#$1', $tn);
			$data[] = '%' . $tn . '%';
			$sqls[] = "t.name LIKE ? ESCAPE '#'";
			$pkid[] = 's';
		}

		if($aid > 0){					//	アーティストID
			$data[] = $aid;
			$sqls[] = 't.artist_id = ?';
			$pkid[] = 'i';
		}

		if($fid > 0){					//	気持ちID
			$data[] = $fid;
			$sqls[] = 't.feeling_id = ?';
			$pkid[] = 'i';
		}

		if(count($data) > 0){			//	条件が存在する場合
			$cc['data'] = $data;
			$cc['sqls'] = $sqls;
			$cc['pkid'] = $pkid;
		}
		return $cc;
	}

	//------------------------------//
	//!	検索条件に一致する曲データを取得
	//!	@param	string	$tn		曲名
	//!	@param	integer	$aid	アーティストID
	//!	@param	integer	$fid	気持ちID
	//!	@return	array			取得した曲データ
	public function getTuneDataAll($tn, $aid, $fid) {
		$records = array();
		$ret = 0;
		$dbh = TuneDb::getDbInstance($this->acl);	//	DB接続インスタンスを取得

		//	条件データを作成
		$cc = $this->makeCondData($tn, $aid, $fid);
		$sss = '';
		$idx = 0;

		$cccnt = count($cc);
		if($cccnt > 0){
			$sss = ' WHERE ' . implode(' AND ', $cc['sqls']);
		}

		$sql  = '';
		$sql .= 'SELECT t.id AS tid, t.comcont, t.name AS tname, a.name AS aname, f.name AS fname FROM tunes AS t';
		$sql .= ' INNER JOIN artists AS a on t.artist_id = a.id';
		$sql .= ' INNER JOIN feelings AS f on t.feeling_id = f.id';
		$sql .= $sss;
		$sql .= ' ORDER BY t.id ASC';
		$sql .= ' LIMIT 0,100';

		$sth = $dbh->stmt_init();
		if($sth->prepare($sql)){	//	SQL文を準備する
			if($cccnt > 0){
				$types = '';
				$dd[0] = '';
				$idx = 0;
				foreach($cc['data'] as $vv){
					$dd[] = &$cc['data'][$idx];
					$idx ++;
				}

				$dd[0] = implode('', $cc['pkid']);		//	バインドデータの型
				call_user_func_array(array($sth, 'bind_param'), $dd);
			}

			$sth->execute();
			$sth->bind_result($v1, $v2, $v3, $v4, $v5);

			while($sth->fetch()){
				$row = new stdClass;
				$row->tid = $v1;
				$row->comcont = $v2;
				$row->tname = $v3;
				$row->aname = $v4;
				$row->fname = $v5;
				$records[] = $row;
			}
			$sth->close();
		}
		return $records;
	}

	//------------------------------//
	//!	気持ちIDに該当する曲データを１件取得する
	//!	@param	integer	$feeling_id		気持ちID
	//!	@return	array					取得した曲データ
	public function getTuneDataFeel($feeling_id) {
		$row = null;
		$ret = 0;
		$dbh = TuneDb::getDbInstance($this->acl);

		//	指定された気持ちIDに該当するレコードの件数を求めるSQL
		$sql = 'SELECT COUNT(*) as cnt FROM tunes WHERE feeling_id = ?';
		$sth = $dbh->stmt_init();

		if($sth->prepare($sql)){
			$sth->bind_param('i', $feeling_id);
			$sth->execute();
			$sth->bind_result($cnt);
			$sth->fetch();
			$sth->close();
		}

		$cnt = (int)$cnt;
		if($cnt == 0){
			return 0;
		}

		$nno = rand(0, ($cnt - 1));	//	件数を使ってランダム値を求める

		//	求めたランダム値を使って１件を抽出するSQL
		$sql = 'SELECT t.name, a.name, t.comcont FROM tunes AS t INNER JOIN artists AS a on t.artist_id = a.id';
		$sql .= ' WHERE t.feeling_id = ? LIMIT ?,1';

		$sth = $dbh->stmt_init();
		if($sth->prepare($sql)){	//	SQL文を準備する
			$sth->bind_param('ii', $feeling_id, $nno);
			$sth->execute();
			$sth->bind_result($v1, $v2, $v3);
			$sth->fetch();
			$row = new stdClass();
			$row->name = $v1;
			$row->artist = $v2;
			$row->comcont = $v3;
			$sth->close();
		}
		return $row;
	}
}
