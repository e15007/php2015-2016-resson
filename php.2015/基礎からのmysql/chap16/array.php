<?php
$m[] = "ネズミ";
$m[] = "ウシ";
$m[] = "トラ";
$m[] = "ウサギ";
$m[] = "Dragon";

$n = array("ネズミ","ウシ","トラ","ウサギ","Dragon");

//var_dump($m);
print '$m:';
print_r($m);
print "<br>";
print '$n:';
print_r($n);
print "<br>";

$m = array();

$m[4] = "ネズミ";
$m[0] = "ウシ";
$m[2] = "トラ";
$m[1] = "ウサギ";
$m[3] = "Dragon";

print_r($m);
print "<br>";

ksort($m);

print_r($m);
print "<br>";

asort($m);

print_r($m);
print "<br>";