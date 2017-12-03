<?php
require_once 'header_link.php';                            
$db_handle = new myFunctions();
if(!empty($_POST["product_id"])) {
	$query ="SELECT * FROM tbproducts WHERE pid = '" . $_POST["product_id"] . "'";
	$results = $db_handle->getData($query);

	foreach($results as $product) {
?>
	<option value='<?php echo $product["sellingPrice"]-$product["discount"]; ?>' ><?php echo $product["sellingPrice"]-$product["discount"]; ?> Taka (including Discount and VAT)</option> 
<?php 
	}
}
?>