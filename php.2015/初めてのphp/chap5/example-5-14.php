<?php

require_once('example-5-13.php');

$totals = restaurant_check2(15.22, 8.25, 15);

$total_notip = $totals[0];
$total_tip = $totals[1];

if ($total_notip < 20) {
    print 'The total without tip is less than $20.<br>';
}
if ($total_tip < 20) {
    print 'The total with tip is less than $20.<br>';
}

var_dump($totals);
