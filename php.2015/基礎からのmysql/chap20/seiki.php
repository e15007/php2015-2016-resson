<?php
$m = '107-0052';
$n = '050-7890-1204';
$yuubin = '/^[0-9]{3}-[0-9]{4}$/';
$keitai = '/^(090|080|070|050)-\d{4}-\d{4}$/';
if(preg_match($keitai, $n)){
	print 'とりあえずOKです';
}else{
	print '誤りがあります';
}
