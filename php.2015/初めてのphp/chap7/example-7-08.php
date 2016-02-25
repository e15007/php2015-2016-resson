<?php
require 'MDB2.php';
$db = MDB2::connect('mysql://yamauchi:1234@localhost/restaurant');
if (MDB2::isError($db)) { die("connection error: " . $db->getMessage()); }

// この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);

$q = $db->query("INSERT INTO dishes (dish_name, price, is_spicy)
    VALUES ('ポテトサラダ', 2.50, 0)");

print 'OK';
