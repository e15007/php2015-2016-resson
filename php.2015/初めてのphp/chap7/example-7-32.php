<?php
require 'MDB2.php';
$db = MDB2::connect('mysql://yamauchi:1234@localhost/restaurant');
if (MDB2::isError($db)) { die("connection error: " . $db->getMessage()); }

// この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);

$q = $db->query('SELECT dish_name, price FROM dishes');
print 'There are ' . $q->numrows() . ' rows in the dishes table.';
