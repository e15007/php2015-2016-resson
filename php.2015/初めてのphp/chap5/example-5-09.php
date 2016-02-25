<?php

function countdown($counter) {
    while ($counter > 0) {
        print "$counter..";
        $counter--;
    }
    print "boom!<br>\n";
}

$counter = 5;
countdown($counter);
print "Now, counter is $counter";
