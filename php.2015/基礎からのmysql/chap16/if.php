<?php
//$hour = date("G");
$hour = 5;
var_dump($hour);
if($hour>=18){
	print "こんばんは";
}elseif($hour>=9){
	print "こんにちは";
}elseif($hour>=6){
	print "お早うございます";
}else{
	print "眠くないですか";
}