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
	    $this->SetY(-15);
	    $this->SetFont('Times','I',8);
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}


$from_date=$_GET['fromdate'];
$to_date=$_GET['todate'];

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();

$pdf->SetFont('Times','B',13);	
$pdf->Cell(190,10,"Sales Report From (".date("d-M-Y", strtotime($from_date)).") To (".date("d-M-Y", strtotime($to_date)).")",0,0,'C');
$pdf->Ln(8);

$pdf->SetFont('Times','',12);	
$pdf->Cell(90,6,"Name of Executive :",0,0,'R');
$pdf->SetFont('Times','B',13);	
$pdf->Cell(60,6,$_SESSION['userFullName'],0,0,'L');
$pdf->Ln(12);

$pdf->SetFont('Times','B',12);	
$pdf->Cell(10,8,"SN",1,0,'C');
$pdf->Cell(31,8,"Invoice Number",1);
$pdf->Cell(73,8,"Customer Name",1);
$pdf->Cell(26,8,"Date",1,0,'C');
$pdf->Cell(24,8,"Time",1,0,'C');
$pdf->Cell(29,8,"Amount",1,0,'C');
$pdf->Ln();
                           
$i=0;
$ex_tot = 0;
$userid = $_SESSION['userid'];
$results = $db_handle->getExecutivesReport($userid,$from_date,$to_date);
$trow=count($results);
if($trow>0){
	foreach($results as $invoice) {
	   $total = 0;
	   $results1 = $db_handle->getProductSalesListByInvoiceNumber($invoice["invoice_Number"]);
	   if($results1){
		   foreach($results1 as $invoiceTotalAmount) {
		    $total += $invoiceTotalAmount["productPriceRate"]*$invoiceTotalAmount["productQtys"];
		  }
		}

	  	$ex_tot+=$total;

		$pdf->SetFont('Times','',11);	
		$pdf->Cell(10,8,++$i,1,0,'C');
		$pdf->Cell(31,8,"Invoice - ".$invoice["invoice_Number"],1,0,'L');
		$pdf->Cell(73,8,$invoice["customerName"],1);
		$pdf->Cell(26,8,date("d-m-Y", strtotime($invoice["invoiceDate"])),1,0,'C');
		$pdf->Cell(24,8,$invoice["invoiceTime"],1,0,'C');
		$pdf->Cell(29,8,$total." TK",1,0,'C');
		$pdf->Ln();
	}

	$pdf->SetFont('Times','B',14);
	$pdf->Cell(140,8,"","");
	$pdf->Cell(24,8,"Total",1);
	$pdf->Cell(29,8,$ex_tot." TK",1,0,'C');
	$pdf->Ln();

}else{
	$pdf->SetFont('Arial','B',12);	
	$pdf->Cell(190,10,"",'c');
	$pdf->Ln();

	$pdf->SetFont('Times','B',12);	
	$pdf->Cell(190,10,"No data available",1,'c');
	$pdf->Ln();
}
$pdf->Output();
ob_end_flush(); 
?>