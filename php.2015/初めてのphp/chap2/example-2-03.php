<?php
$_POST['zipcode'] = '   1234           ';
// $_POST['zipcode'] holds the value of the submitted form parameter
// "zipcode"
$zipcode = trim($_POST['zipcode']);
// Now $zipcode holds that value, with any leading or trailing spaces
// removed
$zip_length = strlen($zipcode);
// Complain if the ZIP code is not 5 characters long
//if ($zip_length != 5) {
if(strlen(trim($_POST['zipcode'])) != 5){
    print "Please enter a ZIP code that is 5 characters long($zip_length).";
}else{
	print 'OK!';
}
