<?php
$midnight_today = mktime(0,0,0); // 本日の0時0分0秒のエポックタイムスタンプ
print '<select name="date">';
for ($i = 0; $i < 7; $i++) {
    $timestamp = strtotime("+$i day", $midnight_today); // valueはエポックタムスタンプ
		$display_date = strftime('%A, %B %d, %Y', $timestamp); // 選択肢は「曜日, 月 日, 年」
    print '<option value="' . $timestamp .'">'.$display_date."</option>\n";
}
print "\n</select>";
