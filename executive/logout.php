<?php
require_once '../config/configure.php';
require_once("../tools/tools.php");
require_once '../tools/dbclass.php'; 

date_default_timezone_set('Asia/Dhaka');
$date = date("Y-m-d");
$time = date("h:i:sa");

$DB = new MyPOSDB();

$userid = $_SESSION['userid'];
mysql_query("INSERT INTO tbactivity_logs (user_id,activity,date,time) VALUES ('$userid','Log out', '$date','$time')");

unset($_SESSION['ExecutiveAccess']);
unset($_SESSION['userid']);
unset($_SESSION['userFullName']);
unset($_SESSION['userPassword']);
echo "<script> document.location.href='../index.php';</script>";
?>