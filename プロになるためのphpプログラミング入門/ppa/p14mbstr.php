<?php
//!	マルチバイト関数を使うサンプル
mb_internal_encoding('UTF-8');

$s1 = 'うらにわにはにわにわにはにわにわとりがいる';

//	文字数を取得する
$n1 = mb_strlen($s1, 'UTF-8');

//	12バイトに収まる文字列を取得する
$s2 = mb_strcut($s1, 0, 12, 'UTF-8');

//	にわ の出現回数を求める
$n2 = mb_substr_count($s1, 'にわ', 'UTF-8');

//	文字列を置換する
$s3 = preg_replace('/にわにはにわ/u', '庭には二羽、', $s1);

$n1 = '文字数は、' . $n1;
$s2 = '12バイトに収まる文字列は、' . $s2;
$n2 = 'にわ の出現回数は、' . $n2;

echo htmlspecialchars($s1, ENT_QUOTES, 'UTF-8'), '<br><br>';
echo htmlspecialchars($n1, ENT_QUOTES, 'UTF-8'), '<br>';
echo htmlspecialchars($s2, ENT_QUOTES, 'UTF-8'), '<br>';
echo htmlspecialchars($n2, ENT_QUOTES, 'UTF-8'), '<br><br>';
echo htmlspecialchars($s3, ENT_QUOTES, 'UTF-8'), '<br>';
?>
