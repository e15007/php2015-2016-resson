<?php
$now = time(); // 現在のエポックタイムスタンプ
$later = strtotime('Thursday',$now);
$before = strtotime('last thursday',$now);
print strftime("now: %c <br>\n", $now);
print strftime("later: %c <br>\n", $later);
print strftime("before: %c <br>\n", $before);
