<?php
session_start();

if (array_key_exists('username', $_SESSION)) {
    print "Hello, $_SESSION[username].";
} else {
//    print 'Howdy, stranger.';
	header('Location: http://'. $_SERVER['SERVER_NAME'] . '/php/php2/chap8/example-8-14.php');
}
?>
