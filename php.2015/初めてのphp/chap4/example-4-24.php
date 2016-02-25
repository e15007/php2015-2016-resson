<?php
$meal = array('breakfast' => 'Walnut Bun',
              'lunch' => 'Cashew Nuts and White Mushrooms',
              'snack' => 'Dried Mulberries',
              'dinner' => 'Eggplant with Chili Sauce');
$meal2 = array('Walnut Bun',
              'Cashew Nuts and White Mushrooms',
              'Dried Mulberries',
              'Eggplant with Chili Sauce');

print "Before Sorting:<br>\n";
foreach ($meal as $key => $value) {
    print "   \$meal: $key $value<br>\n";
}

//asort($meal); // 昇順
arsort($meal); // 降順

print "After Sorting:<br>\n";
foreach ($meal as $key => $value) {
    print "   \$meal: $key $value<br>\n";
}
