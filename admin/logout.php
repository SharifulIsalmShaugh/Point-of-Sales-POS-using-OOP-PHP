<?php
session_start();
unset($_SESSION['AdminAccess']);
unset($_SESSION['adminid']);
unset($_SESSION['adminFullName']);
echo "<script> document.location.href='../index.php';</script>";
?>