<meta charset='UTF-8'>
<?php
$s = mysql_connect('localhost', 'yamauchi', '1234') or die('失敗です');
print '成功しました<br>';
mysql_select_db('db1');

$q = <<<eot
select bang,avg(uria)
from tb
where uria >= 50
group by bang
having avg(uria) >= 120
order by avg(uria) desc;
eot;

$re = mysql_query($q);
while($kekka = mysql_fetch_array($re)){
	print '社員番号:';
	print $kekka[0];
	print ' 売上平均:';
	print $kekka[1];
	print '<br>';
}
mysql_close($s);
