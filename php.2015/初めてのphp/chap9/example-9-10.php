<?php
require '../chap6/formhelpers.php';

$midnight_today = mktime(0,0,0);
$choices = array();
for ($i = 0; $i < 7; $i++) {
    $timestamp = strtotime("+$i day", $midnight_today); // キー
    $display_date = strftime('%A, %B %d, %Y', $timestamp); // 値
    $choices[$timestamp] = $display_date; // 配列に格納
}
input_select('date', $_POST, $choices); // selectの表示
