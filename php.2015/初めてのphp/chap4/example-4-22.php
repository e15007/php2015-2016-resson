<?php

$fish = 'Bass, Carp, Pike, Flounder';
$fish_list = explode(', ', $fish);

print_r($fish_list);
print '<br>';

print "The second fish is $fish_list[1]";
