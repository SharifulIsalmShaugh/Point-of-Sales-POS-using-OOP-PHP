<?php 
require_once 'header_link.php';  
$db_handle = new myFunctions();
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <title>POS - Tech Novelty </title>
        <link href="assets/css/customizedstyle.css" rel="stylesheet" media="screen">
        <link href="assets/css/myresponsivestyle.css" rel="stylesheet" media="screen">
        <link href="assets/css/styles.css" rel="stylesheet" media="screen">
        <style type="text/css">
    
        @media print {
            .remove_from_print ,.th_border,.header{
                display: none;
            }
        }

        @media url{
            .remove_from_print{
               display: none; 
            }
        }
        </style>
    </head>
    
    <body>
        <div class="remove_from_print navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">

                    <a class="brand remove_from_print" href="#">POS - Tech Novelty </a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $user;?> </a>
                            </li>
                        </ul>
                   </div>
            </div>
        </div>
		</div>
        
        <div class="container-fluid">
            <div class="row-fluid remove_from_print">
                <div class="span12">
                    <?php      
                        $query0 = mysql_query("SELECT MAX(invoice_Number) as maximum FROM tbinvoice"); 
                        $row0 = mysql_fetch_array($query0);
                          $invoiceNumber = $row0['maximum']+1;

                          date_default_timezone_set('Asia/Dhaka');
                        
                        if(isset($_POST['invoice_save_print'])){
                           
                           $tmpId = $_SESSION['tmpSalesNumber'];
                            $customerName = $_POST['name'];
                            $customerPhone = $_POST['phone'];
                            $customerAddress = $_POST['address'];
                            $invoiceDate = date("Y-m-d");
                            $invoiceTime = date("h:i:sa");
                            $userId =$_SESSION['userid'];
                            $paymentMethodId = 1;
                            $tenderedAmount = $_POST['tendered_amount'];

                            $results = $db_handle->getTmpProducts($tmpId);
                             foreach($results as $product) {
                                $tmpid = $product["tmpid"];
                                $pid = $product["pid"];
                                $productPriceRate = $product["productPriceRate"];
                                $profitAmount = $product["profitAmount"];
                                $quantity = $product["productQtys"];
                               $db_handle->tmpToSales($invoiceNumber,$pid,$productPriceRate,$quantity,$profitAmount);
                                $db_handle->deleteProductFromChart($tmpid);
                             }
                             if($results){
                                 $db_handle->insertInvoiceInfo($invoiceNumber,$customerName,$customerPhone,$customerAddress,$userId,$invoiceDate,$invoiceTime,$paymentMethodId,$tenderedAmount);
                                }
                                unset($_SESSION['tmpSalesNumber']);  

                                echo "<h2 align='center' autofocus style='color:green;'>Invoice Successfully Saved</h2>";     
                                echo "<center><br /><a target='_BLANK' href='save_invoice_as_pdf.php?id=".$invoiceNumber."' class='btn btn-primary'>Save as PDF</a>";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "<a href='sales.php' class='btn btn-primary'>Goto Sales Page</a></center>";                           
                                }
                   
                    ?>
                </div>

                </div>

            <br /><br /><br />
            
            <footer  class="remove_from_print" >
                <?php
                     developer();
                ?>
            </footer>
        </div>
        <!--/.fluid-container-->
        <script src="assets/js/jquery-1.9.1.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>