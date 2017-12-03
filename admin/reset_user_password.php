<?php 
require_once 'header_link.php';                           
$db_handle = new myFunctions(); 

$userid = $_REQUEST['user'];
$password = md5("1234");

$r = $db_handle->resetPassword($userid,$password);
 if($r){

 	 echo "<script> document.location.href='manage_users.php';</script>";
 }
?>