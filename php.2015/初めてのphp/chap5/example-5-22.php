<?php

$dinner = 'Curry Cuttlefish';

function hungry_dinner() {
    $GLOBALS['dinner'] .= ' and Deep-Fried Taro';
}

print "Regular dinner is $dinner";
print "<br>\n";
hungry_dinner();
print "Hungry dinner is $dinner";
