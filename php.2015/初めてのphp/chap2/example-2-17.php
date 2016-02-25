<?php
/*
$price = 3.95;
$tax_rate = 0.08;
$tax_amount = $price * $tax_rate;
$total_cost = $price + $tax_amount;

$username = 'james';
$domain = '@example.com';
$email_address = $username . $domain;

print 'The tax is ' . $tax_amount;
print "<br>\n"; // this prints a linebreak
print 'The total cost is ' .$total_cost;
print "<br>\n"; // this prints a linebreak
print $email_address;
 */

$page_header = <<<HTML_HEADER
<html>
	<head>
		<title>MENU</title>
	</head>
	<body bgcolor='#ffed9'>
		<h1>Dinner</h1>
HTML_HEADER;

$page_footer = <<<HTML_FOOTER
</body>
</html>
HTML_FOOTER;

print $page_header;
print $page_footer;
?>
