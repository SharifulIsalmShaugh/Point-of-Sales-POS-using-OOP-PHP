<?php 
require_once 'header_link.php';                           
$db_handle = new myFunctions();

$id = mysql_escape_string($_GET["id"]);
$image = mysql_escape_string($_GET["image"]);
if ($image=="default.jpg") {
	
}else{
	unlink("product_image/".$image);
}
$db_handle->deleteProduct($id);

echo "<script> document.location.href='all_products_list.php';</script>";

?>