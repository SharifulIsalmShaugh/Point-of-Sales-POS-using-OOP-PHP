<?php 
ob_start();
require_once 'header_link.php';  
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

$db_handle = new myFunctions();

$from_date=$_GET['fromdate'];
$to_date=$_GET['todate'];
$path ="";
$filename="";

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();

$pdf->SetFont('Times','B',13);	
$pdf->Cell(190,10,"Sales Report From (".date("d-m-Y", strtotime($from_date)).") To (".date("d-m-Y", strtotime($to_date)).")",0,0,'C');
$pdf->Ln(12);

$filename = "Sales Report From ".date("d-m-Y", strtotime($from_date))." to ".date("d-m-Y", strtotime($to_date)).".pdf";

$pdf->SetFont('Times','B',11);	
$pdf->Cell(20,8,"Invoice",1);
$pdf->Cell(48,8,"Customer Name",1);
$pdf->Cell(38,8,"Executive Name",1);
$pdf->Cell(20,8,"Date",1,0,'C');
$pdf->Cell(20,8,"Time",1,0,'C');
$pdf->Cell(23,8,"Amount",1,0,'C');
$pdf->Cell(23,8,"Profit",1,0,'C');
$pdf->Ln();
                           
$i=0;
$ex_tot = 0;
$ex_total_profit=0;
$results = $db_handle->getDateWiseReport($from_date,$to_date);
$trow=count($results);
if($trow>0){
	foreach($results as $invoice) {
	   $total = 0;
       $total_profit=0;
	   $results1 = $db_handle->getProductSalesListByInvoiceNumber($invoice["invoice_Number"]);
	   if($results1){
		   foreach($results1 as $invoiceTotalAmount) {
		    $total += $invoiceTotalAmount["productPriceRate"]*$invoiceTotalAmount["productQtys"];
            $total_profit += $invoiceTotalAmount["profitAmount"]*$invoiceTotalAmount["productQtys"];
		  }
		}

	  	$ex_tot+=$total;
        $ex_total_profit+=$total_profit;

		$pdf->SetFont('Times','',10);	
		$pdf->Cell(20,8,"Invoice-".$invoice["invoice_Number"],1,0,'L');
		$pdf->Cell(48,8,$invoice["customerName"],1);
		$pdf->Cell(38,8,$invoice["userFullName"],1);
		$pdf->Cell(20,8,date("d-m-Y", strtotime($invoice["invoiceDate"])),1,0,'C');
		$pdf->Cell(20,8,$invoice["invoiceTime"],1,0,'C');
		$pdf->Cell(23,8,$total." TK",1,0,'C');
		$pdf->Cell(23,8,$total_profit." TK",1,0,'C');
		$pdf->Ln();
	}

	$pdf->SetFont('Times','B',11);
	$pdf->Cell(126,10,"","");
	$pdf->Cell(20,10,"Total",1);
	$pdf->Cell(23,10,$ex_tot." TK",1,0,'C');
	$pdf->Cell(23,10,$ex_total_profit." TK",1,0,'C');
	$pdf->Ln();
}else{
	$pdf->SetFont('Arial','B',12);	
	$pdf->Cell(190,10,"",'c');
	$pdf->Ln();

	$pdf->SetFont('Times','B',12);	
	$pdf->Cell(190,10,"No data available",1,'c');
	$pdf->Ln();
}
$pdf->Output("",$filename,"true");
ob_end_flush(); 
?>