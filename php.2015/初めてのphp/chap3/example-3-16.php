<?php

$i = 10;
print '<select name="people">';
while ($i <= 100) {
    print "<option>$i</option>\n";
    $i+=10;
}
print '</select>';
