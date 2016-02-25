<?php
$_POST['email'] = 'president@whitehouse.goV';

//if ($_POST['email'] == 'president@whitehouse.gov') {
if(strcasecmp($_POST['email'], 'president@whitehouse.gov') == 0){
   print "Welcome, Mr. President.";
}else{
	print 'error!!!';
}
