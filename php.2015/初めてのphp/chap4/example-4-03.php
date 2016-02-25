<?php
// This makes $vegetables an array
$vegetables['corn'] = 'yellow';

var_dump($vegetables);
print '<br>';

// This removes any trace of "corn" and "yellow" and makes $vegetables a scalar
$vegetables = 'delicious';

var_dump($vegetables);
print '<br>';

// This makes $fruits a scalar
$fruits = 283;

var_dump($fruits);
print '<br>';

// This makes $fruits an array and deletes its previous scalar value
$fruits['potassium'] = 'banana';

var_dump($fruits);
print '<br>';
