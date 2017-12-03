<?php
require_once 'header_link.php';                             
$db_handle = new myFunctions();
if(!empty($_POST["sub_cat_id"])) {
	$query =@"SELECT * FROM tbproducts WHERE subCategoryId = '" . $_POST["sub_cat_id"] . "' ORDER BY pname ASC ";
	$results = $db_handle->runQuery($query);
?>	
<option value="">Select Product</option>
<?php
	foreach($results as $product) {
?>
	<option value="<?php echo $product["pid"]; ?>"><?php echo $product["pname"]; ?></option>
<?php
	}
}
?>