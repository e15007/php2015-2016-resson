<?php
require 'MDB2.php';
require 'example-10-12.php';

$db = MDB2::connect('mysql://yamauchi:1234@localhost/restaurant');
if (MDB2::isError($db)) { die("connection error: " . $db->getMessage()); }

// この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);

// Tell the web client that a CSV file called "dishes.csv" is coming
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="dishes.csv"');

// Retrieve the info from the database table and print it
$dishes = $db->query('SELECT dish_name, price, is_spicy FROM dishes');
while ($row = $dishes->fetchRow()) {
    print make_csv_line($row);
}
