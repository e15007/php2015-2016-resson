<?php
require 'MDB2.php';
$db = MDB2::connect('mysql://yamauchi:1234@localhost/restaurant');
if (MDB2::isError($db)) { die("connection error: " . $db->getMessage()); }

// この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);

// Eggplant with Chili Sauce is spicy
$db->query("UPDATE dishes SET is_spicy = 1
            WHERE dish_name = 'カツカレー'");
// Lobster with Chili Sauce is spicy and pricy
$db->query("UPDATE dishes SET is_spicy = 1, price=price * 2
            WHERE dish_name = 'エビチリ'");

print 'OK';
