<?php
$meals['breakfast'] = 'Walnut Bun';
$meals['lunch'] = 'Eggplant with Chili Sauce';
$amounts = array(3, 6);

print_r($meals);
print '<br>';
print_r($amounts);
print '<br>';

print "For breakfast, I'd like {$meals['breakfast']} and for lunch, ";
print "I'd like {$meals['lunch']}. I want $amounts[0] at breakfast and ";
print "$amounts[1] at lunch.";
