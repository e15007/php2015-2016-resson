<?php
require_once('example-5-11.php');
require_once('example-5-15.php');

$total = restaurant_check(15.22, 8.25, 15);
$method = payment_method(20, $total);
print 'I will pay with ' . $method;
