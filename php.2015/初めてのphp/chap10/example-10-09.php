<?php
require 'MDB2.php';
$db = MDB2::connect('mysql://yamauchi:1234@localhost/restaurant');
if (MDB2::isError($db)) { die("connection error: " . $db->getMessage()); }

// この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);

// Open dishes.txt for writing
$fh = fopen('dishes.txt','wb');

$q = $db->query("SELECT dish_name, price FROM dishes");
while($row = $q->fetchRow()) {
    // Write each line (with a newline on the end) to
    // dishes.txt
    fwrite($fh, "The price of $row[0] is $row[1] \n");
}
fclose($fh);
echo 'OK!';
