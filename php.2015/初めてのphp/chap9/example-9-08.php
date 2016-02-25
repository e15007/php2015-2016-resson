<?php
// 2016年11月1日のエポックタイムスタンプを取得
$november = mktime(0,0,0,11,1,2016);
// 2016年11月の最初の月曜日のエポックタイムスタンプを取得
$monday = strtotime('Monday', $november);
// 2016年11月の最初の月曜日の次の日(火曜日) => スーパー・チューズデー
$election_day = strtotime('+1 day', $monday);
// 次回の大統領選の日を表示
print strftime('Election day is %A, %B %d, %Y', $election_day);
print '<br>';
// 2016年1月1日ｎエポックタイムスタンプを取得
$january = mktime(0,0,0,1,1,2016);
// 2016年1月の第2月曜日のエポックタイムスタンプを取得
$seijin = strtotime('Second Monday of', $january);
// 2016年の成人の日を表示
print '来年の成人の日は' . date('n月d日', $seijin) . 'です';
print '<br>';
$july = mktime(0,0,0,7,1,2016);
$umi = strtotime('Second Monday of', $july);
print '来年の海の日は' . date('n月d日', $umi) . 'です';
