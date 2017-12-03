<?php
$user= "Logged User : <b style='color:black;'>".$_SESSION['adminFullName']."</b>";
	if($_SESSION['AdminAccess']==NULL){
		    echo "<script> document.location.href='../index.php';</script>";
	}
?>