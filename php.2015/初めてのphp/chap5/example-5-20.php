<?php

$dinner = 'Curry Cuttlefish';

function vegetarian_dinner() {
    print "Dinner is {$GLOBALS['dinner']}, or ";
    $dinner = 'Sauteed Pea Shoots'; 
    print $dinner;
    print "<br>\n";
}

function kosher_dinner() {
		global $dinner;
    print "Dinner is $dinner, or ";
    $dinner_l = 'Kung Pao Chicken';
    print $dinner_l;
    print "<br>\n";
}

print "Vegetarian ";
vegetarian_dinner();
print "Kosher ";
kosher_dinner();
print "Regular dinner is $dinner";
