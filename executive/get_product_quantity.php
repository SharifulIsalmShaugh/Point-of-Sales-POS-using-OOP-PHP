<?php
require_once 'header_link.php';                             
$db_handle = new myFunctions();
if(!empty($_POST["product_id"])) {
	$query ="SELECT * FROM tbproducts  INNER JOIN tbproductunit ON tbproducts.unitid=tbproductunit.id  WHERE pid = '" . $_POST["product_id"] . "'";
	$results = $db_handle->runQuery($query);

	foreach($results as $product) {
?>
	<option value='<?php echo $product["quantity"]; ?>' ><?php echo $product["quantity"]." ".$product["unitName"]; ?></option>
	
<?php 
	}
}
?>