<?php 
require_once 'header_link.php';  
$db_handle = new myFunctions();

$from_date=$_GET['fromdate'];
$to_date=$_GET['todate'];

$output = "";
$output .= invoiceHeaderExport();
$output.="
    <center><h3 style='margin-top:-10px;'> Sales report from: ".$from_date." to: ".$to_date."
    <br /><span style='font-weight:none;'> Name of Executive: ".$_SESSION['userFullName']."</span></h3>
    
    <table class='table' border='1'>
        <tr bgcolor='green'>
            <th>SN</th>
            <th>Invoice Number</th>
            <th>Customer Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Amount</th>
        </tr>";
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

    if($i%2==0){
        $output .="<tr bgcolor=''>
                    <td >".++$i."</td>
                    <td >"."Invoice - ".$invoice["invoice_Number"]."</td>
                    <td >".$invoice["customerName"]."</td>
                    <td >".date("d-m-Y", strtotime($invoice["invoiceDate"]))."</td>
                    <td >".$invoice["invoiceTime"]."</td>
                    <td >".$total." TK"."</td>
                    </tr>";
                }else{
                       $output .="<tr bgcolor='#DED0D0'>
                    <td >".++$i."</td>
                    <td >"."Invoice - ".$invoice["invoice_Number"]."</td>
                    <td >".$invoice["customerName"]."</td>
                    <td >".date("d-m-Y", strtotime($invoice["invoiceDate"]))."</td>
                    <td >".$invoice["invoiceTime"]."</td>
                    <td >".$total." TK"."</td>
                    </tr>";
                }
    }


   $output .="<tr>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
            </tr>

            <tr style='font-size:bold;' bgcolor=''>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ><b>Total: </td>
                    <td ><b>".$ex_tot." TK</b></td>
                    </tr>";

}else{
            $output.="<tr style='font-size:bold;' bgcolor=''>
                    <td > No data available</td>
                    </tr>";
}

$output .="</table></center>";

header("Content-Type:application/xlsx");
header("Content-Disposition:attachment;filename=executive_report.xls");
echo $output;
                              

?>