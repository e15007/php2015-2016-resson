<?php
require 'MDB2.php';
$db = MDB2::connect('mysql://yamauchi:1234@localhost/restaurant');
if (MDB2::isError($db)) { die("connection error: " . $db->getMessage()); }

// この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);

$make_things_cheaper = true;

// remove expensive dishes
if ($make_things_cheaper) {
    $db->query("DELETE FROM dishes WHERE price > 19.95");
} else {
    // or, remove all dishes
    $db->query("DELETE FROM dishes");
}

print 'OK';
