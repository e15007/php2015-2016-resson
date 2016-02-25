<form method="get" action="<?php print $_SERVER['SCRIPT_NAME']?>">
<input type="text" name="product_id">
<select name="category">
<option value="ovenmitt">Pot Holder</option>
<option value="fryingpan">Frying Pan</option>
<option value="torch">Kitchen Torch</option>
</select>
<input type="submit" name="submit">
</form>
Here are the submitted values:
<br/>
product_id(post): <?php print isset($_POST['product_id']) ? $_POST['product_id'] : ''; ?>
<br/>
category(post): <?php print isset($_POST['category']) ? $_POST['category'] : ''; ?>
<br/>
product_id(get): <?php print isset($_GET['product_id']) ? $_GET['product_id'] : ''; ?>
<br/>
category(get): <?php print isset($_GET['category']) ? $_GET['category'] : ''; ?>
