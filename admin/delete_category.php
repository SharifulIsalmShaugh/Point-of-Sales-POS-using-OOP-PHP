<?php 
require_once 'header_link.php';                           
$db_handle = new myFunctions();

$id = mysql_escape_string($_GET["id"]);
$db_handle->deleteCategory($id);

echo "<script> document.location.href='manage_category.php';</script>";

?>