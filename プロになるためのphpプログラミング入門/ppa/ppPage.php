<?php
//!	HTML_Template_Flexyのサンプル	ページ表示クラス
require_once 'HTML/Template/Flexy.php';
require_once 'HTML/Template/Flexy/Element.php';
define('TEMPLATE_PATH', '/home/yamauchi/templates');	//	テンプレートファイルを置くフォルダ
//------------------------------//
//!	ページ表示クラス
class PpPage {
	protected	$flexy = null;	//!<	Flexyオブジェクト

	//!	コンストラクタ
	public function __construct() {
		//	E_DEPRECATEDとE_STRICTのメッセージを非表示にする
		if(defined('E_DEPRECATED')){
			error_reporting(error_reporting() & ~(E_DEPRECATED | E_STRICT));
		}

		//	オプション設定
		$options = array(
			'locale'		=> 'jp',
			'charset'		=> 'UTF-8',
			'templateDir'	=> TEMPLATE_PATH,
			'compileDir'	=> TEMPLATE_PATH . '/templates_c',
			'plugins'		=> array('PpFlexyPlugin' => TEMPLATE_PATH . '/ppFlexyPlugin.php'));

		//	htmlspecialcharsに指定する文字エンコーディングを設定	※注意：特別な対策です！
		$GLOBALS['HTML_Template_Flexy']['options']['charset'] = $options['charset'];

		//	Flexyオブジェクトを作成
		$this->flexy = new HTML_Template_Flexy($options);
	}

	//!	コンパイルして表示する
	//!	@param	string	$tmpl	テンプレートファイル名
	//!	@param	object	$dobj	出力データ
	//!	@param	array	$elem	HTML要素出力データ
	public function display($tmpl, $dobj = false, array $elem = array()) {
		$this->flexy->compile($tmpl);
		$this->flexy->outputObject($dobj, $elem);
	}
}
