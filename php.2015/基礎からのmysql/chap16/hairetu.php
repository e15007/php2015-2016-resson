<?php
//$m = array("眠くないですか","お早うございます","こんにちは","こんばんは");
$m = array(
	"yonaka" => "眠くないですか",
	"asa" => "お早うございます",
	"hiru" => "こんにちは",
	"yoru" => "こんばんは");
//$hour = date("G");
$hour = 5;
var_dump($hour);
if($hour>=18){
	print $m["yoru"];
}elseif($hour>=9){
	print $m["hiru"];
}elseif($hour>=6){
	print $m["asa"];
}else{
	print $m["yonaka"];
}
