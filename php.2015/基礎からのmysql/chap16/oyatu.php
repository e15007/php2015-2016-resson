<?php
//$hour = date("G");
$hour = 15;
var_dump($hour);
switch ($hour) {
	case 10:
		print "１０時のおやつです";
		break;
	case 15:
		print "３時のおやつです";
		break;
	default:
		print "おやつではありません";
		break;
}