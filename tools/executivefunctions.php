<?php
require_once("controller.php");

class myFunctions extends POSController{

	function getTotalRowNumber($tbname,$dbcol,$col){
  		$query ="SELECT * FROM $tbname  WHERE $dbcol ='$col'";
  		return $this->getRowNumber($query);
	}

	
	function getCategory(){
  		$query ="SELECT * FROM tbcategory";
  		return $this->getData($query);
	}

	function runQuery($query) {
  		return $this->getData($query);
	}	

	function getTmpProducts($id){
  		$query ="SELECT * FROM tbproductsales_tmp  INNER JOIN tbproducts ON tbproductsales_tmp.productId=tbproducts.pid   INNER JOIN tbproductunit ON tbproducts.unitid=tbproductunit.id  WHERE tmpSalesNumber='$id' order by tmpid DESC";
  		return $this->getData($query);
	}

	function getProductDetails($id){
	  		$query ="SELECT * FROM tbproducts WHERE pid = '$id'";
	  		return $this->getData($query);
		}

	function insertProductToChart($tmpSalesNumber,$productId,$price,$profit,$quantity){
		$query ="INSERT INTO tbproductsales_tmp (tmpSalesNumber,productId,productPriceRate,profitAmount,productQtys) VALUES ('$tmpSalesNumber','$productId','$price','$profit','$quantity')";
  		return $this->insertData($query);
	}

	function deleteProductFromChart($tmpId){
  		$query ="DELETE FROM tbproductsales_tmp WHERE tmpid= '$tmpId'";
  		return $this->deleteData($query);
	}

	function updateDecreaseProductQuantity($pid,$pquantity){
  		$query ="UPDATE tbproducts SET quantity = quantity - '$pquantity' WHERE pid= '$pid'";
  		return $this->deleteData($query);
	}

	function updateIncreseProductQuantity($pid,$pquantity){
  		$query ="UPDATE tbproducts SET quantity = quantity + '$pquantity' WHERE pid= '$pid'";
  		return $this->deleteData($query);
	}

	function insertInvoiceInfo($invoiceNumber,$customerName,$customerPhone,$customerAddress,$userId,$invoiceDate,$invoiceTime,$paymentMethodId,$tenderedAmount){
		$query ="INSERT INTO tbinvoice(invoice_Number,customerName,customerPhone,customerAddress,userId,invoiceDate,invoiceTime,paymentMethodId,tenderedAmount) VALUES ('$invoiceNumber','$customerName','$customerPhone','$customerAddress','$userId','$invoiceDate','$invoiceTime','$paymentMethodId','$tenderedAmount')";
  		return $this->insertData($query);
	}
	

	function tmpToSales($invoice_id,$productId,$productPriceRate,$quantity,$profitAmount){
		$query ="INSERT INTO tbproductsales(invoiceNumber,productId,productPriceRate,productQtys,profitAmount) VALUES ('$invoice_id','$productId','$productPriceRate','$quantity','$profitAmount')";
  		return $this->insertData($query);
	}
	
	function getSalesProducts($id){
  		$query ="SELECT * FROM tbproductsales INNER JOIN tbproducts ON tbproductsales.productId=tbproducts.pid  INNER JOIN tbproductunit ON tbproducts.unitid=tbproductunit.id INNER JOIN tbinvoice ON tbinvoice.invoice_Number=tbproductsales.invoiceNumber WHERE invoiceNumber='$id' order by productSalesId ASC";
  		return $this->getData($query);
	}

	function getInvoiceDetails($id){
  		$query ="SELECT * FROM tbinvoice WHERE invoice_Number='$id'";
  		return $this->getData($query);
	}


	function getExecutivesReport($userid,$fromdate,$todate){
  		$query ="SELECT * FROM tbinvoice WHERE userId='$userid' &&  invoiceDate BETWEEN '$fromdate' AND '$todate' ";
  		return $this->getData($query);
	}

	function getProductDetailsbyCode($code){
	  		$query ="SELECT * FROM tbproducts   INNER JOIN tbproductunit ON tbproducts.unitid=tbproductunit.id   INNER JOIN tbsubcategory ON tbproducts.subCategoryId=tbsubcategory.scid INNER JOIN tbcategory ON tbsubcategory.category_id=tbcategory.cid WHERE code = '$code'";
	  		return $this->getData($query);
		}

	function getProductSalesListByInvoiceNumber($invoiceNumber){
	  		$query ="SELECT * FROM tbproductsales  WHERE invoiceNumber = '$invoiceNumber'";
	  		return $this->getData($query);
		}

	function changePassword($userid,$password){
  		$query ="UPDATE tbusers SET userPassword = '$password' WHERE userid= '$userid'";
  		return $this->deleteData($query);
	}

}
?>