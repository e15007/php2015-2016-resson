<?php
print '<select name="doughnuts">';
for ($min = 1, $max = 3; $min < 15; $min += 3, $max += 3) {
    print "<option>$min - $max</option>\n";
}
print '</select>';
