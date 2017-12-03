<?php
require_once("controller.php");

class myFunctions extends POSController{

	function getTotalRowNumber($tbname){

  		$query ="SELECT * FROM $tbname ";
  		return $this->getRowNumber($query);
	}


	function getCategory($search,$num_rows){

  		$query ="SELECT * FROM tbcategory WHERE cname like '%$search%' limit 0,$num_rows";
  		return $this->getData($query);
	}

	function saveCategory($name){

  		$query ="INSERT INTO  tbcategory(cname) VALUES ('$name')";
  		return $this->insertData($query);
	}


	function deleteCategory($cid){

  		$query ="DELETE FROM tbcategory WHERE cid= '$cid'";
  		return $this->deleteData($query);
	}


	function getSubCategory($search,$num_rows){

  		$query ="SELECT tbsubcategory.scid,tbsubcategory.sub_cat_name,tbcategory.cname FROM tbsubcategory INNER JOIN tbcategory ON tbcategory.cid=tbsubcategory.category_id WHERE tbsubcategory.sub_cat_name like '%$search%' OR tbcategory.cname like '%$search%'  limit 0,$num_rows";
  		return $this->getData($query);
	}

	

	function saveSubCategory($name,$category_id){

  		$query ="INSERT INTO  tbsubcategory(sub_cat_name,category_id) VALUES ('$name','$category_id')";
  		return $this->insertData($query);
	}

	function deleteSubCategory($cid){

  		$query ="DELETE FROM tbsubcategory WHERE scid= '$cid'";
  		return $this->deleteData($query);
	}	


	function getProducts($search,$num_rows){

  		$query ="SELECT * FROM tbproducts  INNER JOIN tbproductunit ON tbproducts.unitid=tbproductunit.id  INNER JOIN tbsubcategory ON tbproducts.subCategoryId=tbsubcategory.scid INNER JOIN tbcategory ON tbsubcategory.category_id=tbcategory.cid WHERE tbproducts.pname  like '%$search%' OR tbproducts.code  like '%$search%' OR tbsubcategory.sub_cat_name like '%$search%' OR tbcategory.cname like '%$search%'  limit 0,$num_rows";
  		return $this->getData($query);
	}

	function getProductInventory($search,$num_rows,$condition){

  		$query ="SELECT * FROM tbproducts  INNER JOIN tbproductunit ON tbproducts.unitid=tbproductunit.id  INNER JOIN tbsubcategory ON tbproducts.subCategoryId=tbsubcategory.scid INNER JOIN tbcategory ON tbsubcategory.category_id=tbcategory.cid WHERE $condition && (tbproducts.pname  like '%$search%' OR tbproducts.code  like '%$search%' OR tbsubcategory.sub_cat_name like '%$search%' OR tbcategory.cname like '%$search%' ) limit 0,$num_rows";
  		return $this->getData($query);
	}

	function getProductDetails($id){

  		$query ="SELECT * FROM tbproducts INNER JOIN tbsubcategory ON tbproducts.subCategoryId=tbsubcategory.scid INNER JOIN tbcategory ON tbsubcategory.category_id=tbcategory.cid INNER JOIN tbproductunit ON tbproducts.unitid=tbproductunit.id   WHERE pid = '$id'";
  		return $this->getData($query);
	}
	
	function updateProductInfo($id,$pname,$pcode,$subcat_id,$quantity,$description,$originalPrice,$sellingPrice,$discount){
  		$query ="UPDATE tbproducts SET pname='$pname', code='$pcode',subCategoryId='$subcat_id',quantity='$quantity',description='$description',originalPrice='$originalPrice',sellingPrice='$sellingPrice',discount='$discount' WHERE pid = '$id'";

  		return $this->UpdateData($query);
	}	

	function insertNewProductInfo($pname,$pcode,$subcat_id,$quantity,$description,$unitid,$originalPrice,$sellingPrice,$vat,$discount,$image){
  		$query ="INSERT INTO tbproducts (pname,code,subCategoryId,quantity,description,unitid,originalPrice,sellingPrice,vat,discount,image) VALUES ('$pname','$pcode','$subcat_id','$quantity','$description','$unitid','$originalPrice','$sellingPrice','$vat','$discount','$image')";

  		return $this->insertData($query);
	}

	function deleteProduct($pid){

  		$query ="DELETE FROM tbproducts WHERE pid= '$pid'";
  		return $this->deleteData($query);
	}

	function getUsers($search,$num_rows){

  		$query ="SELECT * FROM tbusers INNER JOIN tbusertype ON tbusers.userTypeId=tbusertype.userTypeId WHERE tbusers.userFullName like '%$search%' OR tbusers.userPhone like '%$search%'  OR tbusers.userEmail like '%$search%'  OR tbusers.userName like '%$search%'  limit 0,$num_rows";
  		return $this->getData($query);
	}	

	function getUserType(){

  		$query ="SELECT * FROM tbusertype WHERE userTypeId!=1";
  		return $this->getData($query);
	}

	function insertNewUserInfo($userfname,$usertype,$uemail,$uphone,$ujoiningDate,$uaddress,$username,$upassword,$image){
			$upassword = md5($upassword);

		$query ="INSERT INTO tbusers (userFullName,userTypeId,userEmail,userPhone,userJoiningDate,userAddress,userName,userPassword,userImage) VALUES ('$userfname','$usertype','$uemail','$uphone','$ujoiningDate','$uaddress','$username','$upassword','$image')";
  		return $this->insertData($query);

	}


	function getUserDetails($id){

  		$query ="SELECT * FROM tbusers INNER JOIN tbusertype ON tbusers.userTypeId=tbusertype.userTypeId WHERE userid='$id'";
  		return $this->getData($query);
	}	

	function updateUserInfo($id,$userfname,$usertype,$uemail,$uphone,$ujoiningDate,$uaddress,$username,$image){
  		$query ="UPDATE tbusers SET userFullName = '$userfname',userTypeId='$usertype',userEmail='$uemail',userPhone ='$uphone',userJoiningDate='$ujoiningDate',userAddress='$uaddress',userName='$username',userImage='$image' WHERE userid = '$id'";

  		return $this->UpdateData($query);
	}	


	function deleteUser($uid){

  		$query ="DELETE FROM tbusers WHERE userid= '$uid'";
  		return $this->deleteData($query);
	}

	function getUsersList(){

  		$query ="SELECT * FROM tbusers WHERE userTypeId=2";
  		return $this->getData($query);
	}	
	function resetPassword($userid,$password){
  		$query ="UPDATE tbusers SET userPassword = '$password' WHERE userid= '$userid'";
  		return $this->deleteData($query);
	}


	function getNotifications($search,$num_rows){

  		$query ="SELECT * FROM tbproducts  INNER JOIN tbsubcategory ON tbproducts.subCategoryId=tbsubcategory.scid INNER JOIN tbcategory ON tbsubcategory.category_id=tbcategory.cid WHERE quantity <5 AND (tbproducts.pname  like '%$search%' OR tbproducts.code  like '%$search%' OR tbsubcategory.sub_cat_name like '%$search%' OR tbcategory.cname like '%$search%') order by quantity ASC limit 0,$num_rows";
  		return $this->getData($query);
	}


	function getNotificationsNum(){

  		$query ="SELECT * FROM tbproducts WHERE quantity <5 ";
  		return $this->getRowNumber($query);
	}
	
	function addProductQuantity($id,$quantity){
  		$query ="UPDATE tbproducts SET quantity = quantity+'$quantity' WHERE pid = '$id'";

  		return $this->UpdateData($query);
	}	

	function getDateWiseReport($fromdate,$todate){
  		$query ="SELECT * FROM tbinvoice INNER JOIN tbusers ON tbinvoice.userId=tbusers.userid  WHERE  invoiceDate BETWEEN '$fromdate' AND '$todate' order by invoice_Number ASC";
  		return $this->getData($query);
	}

	function getProductSalesListByInvoiceNumber($invoiceNumber){
	  		$query ="SELECT * FROM tbproductsales  WHERE invoiceNumber = '$invoiceNumber'";
	  		return $this->getData($query);
	}

	function getExecutivesWiseReport($userid,$fromdate,$todate){
  		$query ="SELECT * FROM tbinvoice WHERE userId='$userid' &&  invoiceDate BETWEEN '$fromdate' AND '$todate' order by invoice_Number ASC ";
  		return $this->getData($query);
	}

	function getSalesProducts($id){
  		$query ="SELECT * FROM tbproductsales  INNER JOIN tbproducts ON tbproductsales.productId=tbproducts.pid INNER JOIN tbinvoice ON tbinvoice.invoice_Number=tbproductsales.invoiceNumber  INNER JOIN tbproductunit ON tbproducts.unitid=tbproductunit.id  WHERE invoiceNumber='$id' order by productSalesId ASC";
  		return $this->getData($query);
	}
	
	function getInvoiceDetails($id){
  		$query ="SELECT * FROM tbinvoice WHERE invoice_Number='$id'";
  		return $this->getData($query);
	}
	
	function getUnit($search,$num_rows){
  		$query ="SELECT * FROM tbproductunit WHERE unitName like '%$search%' limit 0,$num_rows";
  		return $this->getData($query);
	}

	function saveUnit($name){

  		$query ="INSERT INTO  tbproductunit(unitName) VALUES ('$name')";
  		return $this->insertData($query);
	}

	function deleteUnit($id){

  		$query ="DELETE FROM tbproductunit WHERE id= '$id'";
  		return $this->deleteData($query);
	}


	function searchCustomer($search){
  		$query ="SELECT distinct customerName,customerPhone FROM tbinvoice WHERE customerName like '%$search%' OR customerPhone like '%$search%' ";
  		return $this->getData($query);
	}

	function searchCustomerShoppingDate($search){
  		$query ="SELECT distinct invoiceDate FROM tbinvoice WHERE customerPhone = '$search' ";
  		return $this->getData($query);
	}

	function getCustomerInvoiceByDate($date,$cphone){
  		$query ="SELECT * FROM tbinvoice WHERE customerPhone='$cphone' &&  invoiceDate = '$date' order by invoice_Number ASC ";
  		return $this->getData($query);
	}

	function getProductsIdByCode($pcode){
  		$query ="SELECT * FROM tbproducts WHERE code='$pcode'";
  		return $this->getData($query);
	}


	function getProductsSaleDate(){
  		$query ="SELECT distinct invoiceDate FROM tbinvoice ";
  		return $this->getData($query);
	}

	function getProductsSaleHistory($date){
  		$query ="SELECT distinct tbproductunit.unitName,tbproductsales.productId,tbinvoice.invoiceDate,tbproducts.pname,tbproducts.pname,tbproductsales.productQtys FROM tbinvoice  INNER JOIN tbproductsales ON tbinvoice.invoice_Number=tbproductsales.invoiceNumber  INNER JOIN tbproducts ON tbproductsales.productId=tbproducts.pid  INNER JOIN tbproductunit ON tbproductunit.id=tbproducts.unitid  WHERE tbinvoice.invoiceDate = '$date' order by tbproductsales.productId ASC";
  		return $this->getData($query);
  	}
  	
	function getProductsSaleHistoryTotalQuantity($pid){
  		$query ="SELECT productQtys FROM tbproductsales WHERE productId='$pid'";
  		return $this->getData($query);
  	}

	function getActivityLogs($ex_id,$activity,$rows){

  		$query ="SELECT * FROM tbactivity_logs  INNER JOIN tbusers ON tbusers.userid=tbactivity_logs.user_id  WHERE user_id='$ex_id' AND activity like '%$activity%' order by acl_id desc limit 0,$rows ";
  		return $this->getData($query);
	}


}
?>