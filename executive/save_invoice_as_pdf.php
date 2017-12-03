<?php 
ob_start();
require_once 'header_link.php';  
$db_handle = new myFunctions();
require('../fpdf/fpdf.php');
class PDF extends FPDF
{
	function Header()
	{
		
		$this ->SetFont('Times','B',18);;
		$this->Cell(200,10,invoiceCompanyTitle(),0,0,'C');
		$this->Ln(6);

		$this ->SetFont('Times','',11);;
		$this->Cell(200,10,invoiceCompanyAddress(),0,0,'C');
		$this->Ln(5);

		$this ->SetFont('Times','',11);;
		$this->Cell(200,10,invoiceCompanyPhone(),0,0,'C');
		$this->Ln(5);

		$this ->SetFont('Times','',11);;
		$this->Cell(200,10,invoiceCompanyEmail(),0,0,'C');
		$this->Ln(9);
	}

	function Footer()
	{
	    $this->SetY(-18);
	    $this->SetFont('Times','',10);
	    $this->Cell(0,10,"...................................................................",0,0,'R');

	    $this->SetY(-15);
	    $this->SetFont('Times','',10);
	    $this->Cell(0,10,"Signature & Date                    ",0,0,'R');

	     $this->SetY(-15);
	    $this->SetFont('Times','I',8);
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'L');
	}
}

require_once 'header_link.php';  
$db_handle = new myFunctions();


$invoice_number=$_GET['id'];
$r = $db_handle->getInvoiceDetails($invoice_number);
foreach($r as $invoiceDetails) {
    $customerName = $invoiceDetails['customerName'];
    $customerPhone = $invoiceDetails['customerPhone'];
    $customerAddress = $invoiceDetails['customerAddress'];
    $invoiceDate = $invoiceDetails['invoiceDate'];
    $invoiceTime = $invoiceDetails['invoiceTime'];
    $tenderedAmount = $invoiceDetails['tenderedAmount'];
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();

$pdf->SetFont('Times','B',12);	
$pdf->Cell(190,8,"Invoice Number: ".$invoice_number,0,0,'C');
$pdf->Ln(5);

$pdf->SetFont('Times','',11);	
$pdf->Cell(27,10,"Customer Name: ",0,0);
$pdf->SetFont('Times','B',12);	
$pdf->Cell(53,10,$customerName,0,0);
$pdf->Cell(35,10,"",0,0);
$pdf->SetFont('Times','',11);	
$pdf->Cell(28,10,"Customer Phone: ",0,0);
$pdf->SetFont('Times','B',11);	
$pdf->Cell(55,10,$customerPhone,0,0);
$pdf->Ln(6);

$pdf->SetFont('Times','',11);	
$pdf->Cell(31,10,"Customer Address: ",0,0);
$pdf->SetFont('Times','B',12);	
$pdf->Cell(50,10,$customerAddress,0,0);
$pdf->Cell(34,10,"",0,0);
$pdf->SetFont('Times','',11);	
$pdf->Cell(22,10,"Date & Time: ",0,0);
$pdf->SetFont('Times','B',11);	
$pdf->Cell(50,10,date("d-M-Y", strtotime($invoiceDate))."   ".$invoiceTime,0,0);
$pdf->Ln(12);

$pdf->SetFont('Times','B',12);	
$pdf->Cell(13,10,"Serial",1);
$pdf->Cell(105,10,"Product Name",1);
$pdf->Cell(21,10,"Quantity",1,0,'C');
$pdf->Cell(26,10,"Rate",1,0,'C');
$pdf->Cell(30,10,"Sub-Total",1,0,'C');
$pdf->Ln();

$results = $db_handle->getSalesProducts($invoice_number);
$i=0;
$gt =0;
$trow=count($results);
if($trow>0){
	foreach($results as $product){
			$pdf->SetFont('Times','',10);	
			$pdf->Cell(13,7,++$i,'LT',0,'C');
			$pdf->SetFont('Times','B',10);	
			$pdf->Cell(105,7,$product["pname"],'LT',0,'L');
			$pdf->SetFont('Times','',10);	
			$pdf->Cell(21,7,$product["productQtys"]." ".$product["unitName"],'LT',0,'C');
			$pdf->Cell(26,7,$product["productPriceRate"]." TK",'LT',0,'C');
			$pdf->Cell(30,7,($product["productQtys"]*$product["productPriceRate"])." TK",'LTR',0,'C');
			$pdf->Ln(5);

			$pdf->SetFont('Times','',8);	
			$pdf->Cell(13,5,"",'LB',0,'L');
			$pdf->Cell(105,5,$product["description"],'LB',0);
			$pdf->Cell(21,5,"",'LB',0);
			$pdf->Cell(26,5,"",'LB',0);
			$pdf->Cell(30,5,"",'LBR',0);
			$pdf->Ln();
			$gt+=($product["productQtys"]*$product["productPriceRate"]);
		if ($i==14) {
			$pdf->Ln(10);
		}
		}	
		
		$pdf->SetFont('Times','B',13);	
		$pdf->Cell(13,8,"",'',0,'L');
		$pdf->Cell(105,8,'',0,0);
		$pdf->Cell(21,8,"",0,0);
		$pdf->Cell(26,8,"Total",1,0);
		$pdf->Cell(30,8,$gt." TK",1,0,'C');
		$pdf->Ln();
	}

$filename = "Invoice-".$invoice_number.".pdf";

$pdf->Output("",$filename,"false");
ob_end_flush(); 
?>