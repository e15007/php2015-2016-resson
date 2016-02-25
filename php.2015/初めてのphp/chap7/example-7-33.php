<?php
require 'MDB2.php';
$db = MDB2::connect('mysql://yamauchi:1234@localhost/restaurant');
if (MDB2::isError($db)) { die("connection error: " . $db->getMessage()); }

// この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);

$rows = $db->queryAll('SELECT dish_name, price FROM dishes');
foreach ($rows as $row) {
    print "$row[0], $row[1] <br>\n";
}
