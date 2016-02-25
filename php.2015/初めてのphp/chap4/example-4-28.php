<?php
$meals = array('breakfast' => array('Walnut Bun','Coffee'),
               'lunch'     => array('Cashew Nuts', 'White Mushrooms'),
               'snack'     => array('Dried Mulberries','Salted Sesame Crab'));

$lunches = array( array('Chicken','Eggplant','Rice'),
                  array('Beef','Scallions','Noodles'),
                  array('Eggplant','Tofu'));

$flavors = array('Japanese' => array('hot' => 'wasabi',
                                     'salty' => 'soy sauce'),
                 'Chinese'  => array('hot' => 'mustard',
                                     'pepper-salty' => 'prickly ash'));

//print $meals['lunch'][1] .'<br>';            // White Mushrooms
//print $meals['snack'][0] .'<br>';            // Dried Mulberries
//print $lunches[0][0] .'<br>';                // Chicken
//print $lunches[2][1] .'<br>';                // Tofu
//print $flavors['Japanese']['salty'] .'<br>';  // soy sauce
//print $flavors['Chinese']['hot'] .'<br>';    // mustard
print $lunches[1][1] .'<br>';                // Scallions
print $flavors['Japanese']['hot'] .'<br>';    // wasabi
