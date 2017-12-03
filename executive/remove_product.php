<?php 
require_once 'header_link.php';                           
$db_handle = new myFunctions();

$tmpId = $_REQUEST['id'];
$pid = $_REQUEST['pid'];
$quantity = $_REQUEST['quantity'];

$results = $db_handle->deleteProductFromChart($tmpId);

if($results){

		$db_handle->updateIncreseProductQuantity($pid,$quantity);
        echo "<script> document.location.href='sales.php';</script>";
}
else
{
		echo "<center>";
		echo "Products quantity are not available";
		echo "<a href='sales.php' class='btn btn-primary'>Try Again</a> ";
		echo "</center>";
}

?>