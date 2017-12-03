
<?php 

require_once 'dbclass.php';  

function developer(){

	echo "<p align='center'> Developed by <b>Tech-Novelty</b></p>";
	
	$MyDB = new MyPOSDB();
	$MyDB->closeDB();
}
 

function invoiceCompanyTitle(){
	return "Tech Novelty Solution Ltd.";
}

function invoiceCompanyaddress(){
	return "House: 20, Road:2/B , Sector:Uttara 11. ";
}

function invoiceCompanyPhone(){
	return "Phone: 01824168996 ";
}

function invoiceCompanyEmail(){
	return "Email: info@tech-novelty.com";
}




function invoiceHeader(){

	echo "<h3>Tech Novelty Solution Ltd.</h3>";
	echo "<p style='margin-top:-14px;margin-bottom:-14px;'>
		House: 20, Road:2/B , Sector:Uttara 11 .<br>
		Phone: 01824168996 ,01672331428<br>
		Email: info@tech-novelty.com</p>";
}

function invoiceHeaderExport(){

	return "<center>
<p><span style='font-size:25px;'><b>Tech Novelty Solution Ltd.</b></span><br />House: 20, Road:2/B , Sector:Uttara 11
<br />
Phone: 01824168996 
<br />
Email: samsujjamanbappy@gmail.com
</p> </center>";
}



?>