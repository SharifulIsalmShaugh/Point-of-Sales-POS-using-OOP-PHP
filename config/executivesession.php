<?php
$user= "Logged User : <b style='color:rgba(63, 63, 63, 1);'>".$_SESSION['userFullName']."</b>";
	if($_SESSION['ExecutiveAccess']==NULL){
		    echo "<script> document.location.href='../index.php';</script>";
	}
?>