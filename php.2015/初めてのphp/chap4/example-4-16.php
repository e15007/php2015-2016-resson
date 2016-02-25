<meta charset="utf-8">

<?php
$meals = array('Walnut Bun' => 1,
               'Cashew Nuts and White Mushrooms' => 4.95,
               'Dried Mulberries' => 3.00,
               'Eggplant with Chili Sauce' => 6.50,
               'Shrimp Puffs' => 0); 

$dish = array_search(6.55, $meals);
if ($dish) {
    print "$dish costs \$6.50";
}else{
	print "その値段の料理はありません";
}
