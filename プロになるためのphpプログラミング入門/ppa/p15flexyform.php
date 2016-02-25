<?php
//!	HTML_Template_Flexyのサンプル	フォーム要素を操作する
require_once 'ppPage.php';

$pkind[1] = 'モッチモチ！ 弾力がある厚めの生地です';
$pkind[2] = 'パリパリッ！ 薄い生地がお好きな方はどうぞ';
$pkind[3] = 'サクットロ～！ サクッとした生地の中にはトロ～リチーズ';
$elems['pbase'] = new HTML_Template_Flexy_Element;
$elems['pbase']->setOptions($pkind);
$elems['pbase']->setValue(2);

$elems['psize'] = new HTML_Template_Flexy_Element;
$elems['psize']->setValue(3);

$elems['ptop[]'] = new HTML_Template_Flexy_Element;
$elems['ptop[]']->setValue(array('2', '3'));

$elems['kname'] = new HTML_Template_Flexy_Element;
$elems['kname']->setValue('お名前を入力してください');

$elems['kcomm'] = new HTML_Template_Flexy_Element;
$elems['kcomm']->setValue('連絡事項を入力してください');
$elems['kcomm']->attributes['cols'] = 40;
$elems['kcomm']->attributes['rows'] = 10;

$page = new PpPage;
$page->display('p15flexyform.html', false, $elems);
?>
