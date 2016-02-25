<?php
$_POST['comments'] = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet esse, numquam nobis quos doloribus error veritatis nemo temporibus libero dolorum tenetur iste. Nobis alias voluptas tempora cumque molestias, pariatur tenetur!';
// Grab the first thirty characters of $_POST['comments']
print substr($_POST['comments'], 0, 30);
// Add an ellipsis
print '...';
