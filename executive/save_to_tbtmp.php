<?php 
require_once 'header_link.php';                           
$db_handle = new myFunctions();

$productId = $_POST['product_id'];
$avail_quan = $_POST['avail_quan'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$tmpSalesNumber = $_SESSION['tmpSalesNumber'];

$results = $db_handle->getProductDetails($productId);
	foreach($results as $product) {
	    $originalPrice = $product['originalPrice'];
	    $sellingPrice = $product['sellingPrice'];
	    $discount = $product['discount'];

	    $profit = $quantity * (($sellingPrice-$discount) - $originalPrice);
	}

if($quantity>0 && $avail_quan>=$quantity){
		$results = $db_handle->insertProductToChart($tmpSalesNumber,$productId,$price,$profit,$quantity);
		$db_handle->updateDecreaseProductQuantity($productId,$quantity);
        echo "<script> document.location.href='sales.php';</script>";
}
else
{
		echo "<center>";
		echo "<h1 style='font-size:38px;color:#930B0B;'>Products quantity are not available in stock</h1>";
		echo "<a href='sales.php' class='btn btn-primary'>Try Again</a> ";
		echo "</center>";
}
?>