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
        <link rel="stylesheet" href="assets/css/jquery-ui.css">
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">

                    <a class="brand" href="#">POS - Tech Novelty </a>
                    <div class=" collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                               <p style="margin-top:10px;">Time:  <b> <script src="time.js" type="text/javascript"></script></b></p> 
                             </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $user;?> </a>
                            </li>
                        </ul>
                        
                   </div>
            </div>
        </div>
		</div>
        
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav  collapse">
                       
                        <li><a></a></li>
					    <li><a href="dashboard.php"> Dashboard</a></li>
                        <li><a href="sales.php"> Sales</a></li>
                        <li class="active"><a href="report.php"> Report</a></li>
                        <li><a href="search_invoice.php"> Search Invoice</a></li>
                        <li><a href="profile.php"> Profile</a></li>
                        <li><a href="logout.php"> Log Out</a></li>
                        <li><a></a></li>


					</ul>
                </div>
                
                <div class="span9" id="content">
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                              <div class="muted pull-left" >Report <?php if(isset($_GET['fromdate'])&&isset($_GET['todate'])){ ?>(From:<?php echo date("d-M-Y", strtotime($_GET['fromdate']));?> - To:<?php echo date("d-M-Y", strtotime($_GET['todate']));  ?>) <?php } ?> </div>
                                 <?php if(isset($_GET['show_report'])){  ?>
                                <div class="muted pull-right" style="margin-top:-10px;margin-boyyom:5px;" ><a class="btn btn-success" href="report_export_to_excel.php?fromdate=<?php echo $_GET['fromdate'];?>&&todate=<?php echo $_GET['todate'];?>">Export to Excel</a> &nbsp;&nbsp;&nbsp;<a target="_BLANK" class="btn btn-primary" href="save_report_as_pdf.php?fromdate=<?php echo $_GET['fromdate'];?>&&todate=<?php echo $_GET['todate'];?>">Save as PDF</a></div>
                                <?php } ?>
                            </div>
                            <div class="block-content collapse in">
                              <br>
                              <?php if(isset($_GET['show_report'])){  ?>

                                <table style="margin-top:-15px"; class="table table-bordered table-stripted table-hover">
                                      <thead style="font-size:15px;color:black;">
                                            <th width="3%">SN</th>
                                            <th width="12%">Invoice Number <br></th>
                                            <th width="25%">Customer Name <br></th>
                                            <th width="10%">Date</th>
                                            <th  width="10%">Time <br></th>
                                            <th  width="10%">Amount <br></th>
                                            <th width="4%">Action <br></th>
                                       </thead>
                                    <?php
                                        $i=0;
                                        $gt =0;
                                        $ex_tot = 0;
                                         $userid = $_SESSION['userid'];
                                         $fromdate = $_GET['fromdate'];
                                         $todate = $_GET['todate'];
                                         $results = $db_handle->getExecutivesReport($userid,$fromdate,$todate);
                                         
                                        $trow=count($results);
                                        if($trow>0){
                                        foreach($results as $invoice) {
                                        ?>
                                       <tr>
                                            <td><?php echo ++$i; ?></td>
                                            <td><b><?php echo htmlentities("Invoice - ".$invoice["invoice_Number"]); ?></b></td>

                                            <td><?php echo htmlentities($invoice["customerName"]); ?></td>
                                            <td><?php echo date("d-M-Y", strtotime(htmlentities($invoice["invoiceDate"]))); ?></td>
                                            <td><?php echo htmlentities($invoice["invoiceTime"]); ?></td>
                                            <td><?php 

                                              $total = 0;

                                              $results1 = $db_handle->getProductSalesListByInvoiceNumber($invoice["invoice_Number"]);
                                              if($results1){
                                              foreach($results1 as $invoiceTotalAmount) {
                                                $total += $invoiceTotalAmount["productPriceRate"]*$invoiceTotalAmount["productQtys"];
                                              }
                                            }
                                              $ex_tot+=$total;

                                            echo htmlentities($total." TK"); ?></td> <td>
                                                <a style="text-decoration:none;color:blue;" target="_BLANK" href="invoice_details.php?id=<?php echo $invoice['invoice_Number']; ?>">Details</a>
                                       </tr>

                                       <?php 
                                           
                                        } } ?>

                                        <tfoot>
                                           <th colspan="5">Total</th>
                                           <th colspan=""><b><?php echo $ex_tot." TK";?></b></th>
                                           <th colspan=""></th>
                                        </tfoot>
                                </table>
 


                             <?php
                              }else{ ?>
                              <form action="" method="GET">
                                  <input name="fromdate"  autofocus  required type="text" placeholder="From: YYYY-MM-DD"  id="datepicker1"  >
                                  <input name="todate" required type="text" placeholder="To: YYYY-MM-DD"  id="datepicker2"  >
                                  <input name="show_report" type="submit" class="btn btn-primary" style="margin-top:-10px;" value="Show" >
                              </form>
                              <?php } ?>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
				</div>
			</div>
            <hr>
            <footer>

                <?php
                     developer();
                ?>

            </footer>
        </div>  

        <!--/.fluid-container-->
        <script src="assets/js/jquery-1.9.1.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="assets/js/jquery-ui.js"></script>
         <script>
          $( function() {
            $( "#datepicker1" ).datepicker();
          } );

          $( function() {
            $( "#datepicker2" ).datepicker();
          } );
          </script>

    </body>
</html>