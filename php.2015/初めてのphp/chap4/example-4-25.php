<?php
$meal = array('breakfast' => 'Walnut Bun',
              'lunch' => 'Cashew Nuts and White Mushrooms',
              'snack' => 'Dried Mulberries',
              'dinner' => 'Eggplant with Chili Sauce');

print "Before Sorting:<br>\n";
foreach ($meal as $key => $value) {
    print "   \$meal: $key $value<br>\n";
}

//ksort($meal); // 昇順
krsort($meal); // 降順

print "After Sorting:<br>\n";
foreach ($meal as $key => $value) {
    print "   \$meal: $key $value<br>\n";
}
