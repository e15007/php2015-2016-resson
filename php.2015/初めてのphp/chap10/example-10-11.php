<?php
require 'MDB2.php';
$db = MDB2::connect('mysql://yamauchi:1234@localhost/restaurant');
if (MDB2::isError($db)) { die("connection error: " . $db->getMessage()); }

// この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);

// Open the CSV file
$fh = fopen('dishes.csv','rb');

for ($info = fgetcsv($fh, 1024); ! feof($fh); $info = fgetcsv($fh, 1024)) {
    // $info[0] is the dish name    (the  first field in a line of dishes.csv)
    // $info[1] is the price        (the second field)
    // $info[2] is the spicy status (the  third field)
    // Insert a row into the database table
    $sth = $db->prepare("INSERT INTO dishes (dish_name, price, is_spicy) VALUES (?, ?, ?)");
		$sth->execute($info);
    print "Inserted $info[0]<br>\n";
}
// Close the file
fclose($fh);
echo 'OK!';
