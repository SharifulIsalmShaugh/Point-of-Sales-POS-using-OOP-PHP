<?php
require_once 'header_link.php';                           
$db_handle = new POSController();
if(!empty($_POST["category_id"])) {
	$query ="SELECT * FROM tbsubcategory WHERE category_id = '" . $_POST["category_id"] . "'";
	$results = $db_handle->getData($query);
?>	
<option value="">Select Sub-category</option>
<?php
	foreach($results as $subcat) {
?>
	<option value="<?php echo $subcat["scid"]; ?>"><?php echo $subcat["sub_cat_name"]; ?></option>
<?php
	}
}
?>