<?php
// Load the form helper functions
require '../chap6/formhelpers.php';

require 'MDB2.php';

$db = MDB2::connect('mysql://yamauchi:1234@localhost/restaurant');
if (MDB2::isError($db)) { die("connection error: " . $db->getMessage()); }

// この後のデータベースエラーに関してはメッセージを出力して抜け出す
$db->setErrorHandling(PEAR_ERROR_DIE);

// The main page logic:
// - If the form is submitted, validate and then process or redisplay
// - If it's not submitted, display
if (array_key_exists('_submit_check', $_POST)) {
    // If validate_form() returns errors, pass them to show_form()
    if ($form_errors = validate_form()) {
        show_form($form_errors);
    } else {
        // The submitted data is valid, so process it
        process_form();
    }
} else {
    // The form wasn't submitted, so display
    show_form();
}

function show_form($errors = '') {
    // If the form is submitted, get defaults from submitted parameters
    if (array_key_exists('_submit_check', $_POST)) {
        $defaults = $_POST;
				var_dump($defaults);
    } else {
        // Otherwise, set our own defaults: price is $5
			$defaults = array('price' => '5.00',
												'dish_name' => '',
												'is_spicy' => 'no', 
											);
    }
    
    // If errors were passed in, put them in $error_text (with HTML markup)
    if (is_array($errors)) {
        $error_text = '<tr><td>You need to correct the following errors:';
        $error_text .= '</td><td><ul><li>';
        $error_text .= implode('</li><li>',$errors);
        $error_text .= '</li></ul></td></tr>';
    } else {
        // No errors? Then $error_text is blank
        $error_text = '';
    }

    // Jump out of PHP mode to make displaying all the HTML tags easier
?>
<form method="POST" action="<?php print $_SERVER['PHP_SELF']; ?>">
<table>
<?php print $error_text ?>

<tr><td>Dish Name:</td>
<td><?php input_text('dish_name', $defaults) ?></td></tr>

<tr><td>Price:</td>
<td><?php input_text('price', $defaults) ?></td></tr>

<tr><td>Spicy:</td>
<td><?php input_radiocheck('checkbox','is_spicy', $defaults, 'yes'); ?>
 Yes</td></tr>

<tr><td colspan="2" align="center"><?php input_submit('save','Order'); ?>
</td></tr>

</table>
<input type="hidden" name="_submit_check" value="1"/>
</form>
<?php
      } // The end of show_form()

function validate_form() {
    $errors = array();

    // dish_name is required
    if (! strlen(trim($_POST['dish_name']))) {
        $errors[] = 'Please enter the name of the dish.';
    }

    // price must be a valid floating point number and 
    // more than 0
    if (floatval($_POST['price']) <= 0) {
        $errors[] = 'Please enter a valid price.';
    }

    return $errors;
}

function process_form() {
    // Access the global variable $db inside this function
    global $db;

    // Get a unique ID for this dish
    //$dish_id = $db->nextID('dishes');

    // Set the value of $is_spicy based on the checkbox
    if (array_key_exists('is_spicy', $_POST) && $_POST['is_spicy'] == 'yes') {
        $is_spicy = 1;
    } else {
        $is_spicy = 0;
    }

    // Insert the new dish into the table
    /*$db->query('INSERT INTO dishes (dish_id, dish_name, price, is_spicy)
                VALUES (?,?,?,?)',
               array($dish_id, $_POST['dish_name'], $_POST['price'],
								 $is_spicy));*/

		// 新しい料理をテーブルに挿入
		$sth = $db->prepare('insert into dishes(dish_name, price, is_spicy) values(?,?,?)');
		$sth->execute(array($_POST['dish_name'], $_POST['price'], $is_spicy));

    // Tell the user that we added a dish.
    print 'Added ' . htmlentities($_POST['dish_name']) . 
          ' to the database.';
}

?>
