<?php
$finished = false;
// The entire test expression ($finished == false) 
// is true if $finished is false 
if ($finished == false) {
    print 'Not done yet!<br>';
}

// The entire test expression (! $finished)
// is true if $finished is false
if (! $finished) {
    print 'Not done yet!<br>';
}
