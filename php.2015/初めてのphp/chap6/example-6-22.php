<?php

$_POST['comments'] = 'I <b>love</b> sweet <div class="fancy">rice</div> & tea.';

print $_POST['comments'];
print "\n<br>\n";

$comments = htmlentities($_POST['comments']);
// Now it's OK to print $comments
print $comments;
