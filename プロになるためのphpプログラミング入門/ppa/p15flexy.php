<?php
//!	HTML_Template_Flexyのサンプル
require_once 'HTML/Template/Flexy.php';

//	テンプレートファイルを置くフォルダ
define('TEMPLATE_PATH', '/home/yamauchi/templates');

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
$flexy = new HTML_Template_Flexy($options);

//	表示データ用オブジェクト
$dobj = new stdClass();
$dobj->val = '楽しい夏休み';

//	コンパイルして表示する
$flexy->compile('p15flexy.html');
$flexy->outputObject($dobj);
?>
