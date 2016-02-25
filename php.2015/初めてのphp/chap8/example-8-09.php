<?php
session_start();

if(!array_key_exists('count', $_SESSION)){
	$_SESSION['count'] = 0;
}

$count = $count + 1;

$_SESSION['count'] = $_SESSION['count'] + 1;

print "You've looked at this page " . $_SESSION['count'] . ' times.<br>';
print '$count = ' . $count . '<br>';
