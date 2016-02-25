<meta charset='UTF-8'>
<?php
$s = mysql_connect('localhost', 'yamauchi', '1234') or die('失敗です');
print '成功しました';
mysql_close($s);
