<?php
$dinner = array('Sweet Corn and Asparagus',
                'Lemon Chicken',
                'Braised Bamboo Fungus');
$meal = array('breakfast' => 'Walnut Bun',
              'lunch' => 'Cashew Nuts and White Mushrooms',
              'snack' => 'Dried Mulberries',
              'dinner' => 'Eggplant with Chili Sauce');

print "Before Sorting:<br>\n";
foreach ($dinner as $key => $value) {
    print " \$dinner: $key $value<br>\n";
}
foreach ($meal as $key => $value) {
    print "   \$meal: $key $value<br>\n";
}

//sort($dinner); // 昇順
//sort($meal); // 昇順

rsort($dinner); // 降順
rsort($meal); // 降順

print "After Sorting:<br>\n";
foreach ($dinner as $key => $value) {
    print " \$dinner: $key $value<br>\n";
}
foreach ($meal as $key => $value) {
    print "   \$meal: $key $value<br>\n";
}
