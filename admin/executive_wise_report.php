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
                        <li><a href="manage_products.php"> Manage Product</a></li>
                        <li><a href="manage_users.php"> Manage User</a></li>
                        <li class="active"><a href="manage_report.php"> Manage Report</a></li>
                        <li><a href="manage_references.php"> Raferences</a></li>
                        <li><a href="notification.php"> Notification <span class="badge"><?php echo $db_handle->getNotificationsNum();?></span></a></li>
                        <li><a href="others.php"> Others</a></li>
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
                                <div class="muted pull-right" style="margin-top:-10px;margin-boyyom:5px;" >
                                <a class="btn btn-info" href="executive_report_export_to_word.php?fromdate=<?php echo $_GET['fromdate'];?>&&todate=<?php echo $_GET['todate'];?>&&userid=<?php echo $_GET['ex_id'];?>">Export to Word</a>
                                 &nbsp;
                                 <a class="btn btn-success" href="executive_report_export_to_excel.php?fromdate=<?php echo $_GET['fromdate'];?>&&todate=<?php echo $_GET['todate'];?>&&userid=<?php echo $_GET['ex_id'];?>">Export to Excel</a>
                                 &nbsp;
                                 <a target="_BLANK" class="btn btn-primary" href="executive_report_as_pdf.php?fromdate=<?php echo $_GET['fromdate'];?>&&todate=<?php echo $_GET['todate'];?>&&userid=<?php echo $_GET['ex_id'];?>">Save as PDF</a></div>
                                <?php } ?>
                            </div>
                            <div class="block-content collapse in">
                              
                              <?php if(isset($_GET['show_report'])){  ?>
                                <br />
                                <table style="margin-top:-15px"; class="table table-bordered table-stripted table-hover">
                                      <thead style="font-size:15px;color:black;">
                                            <th width="12%">Invoice Number <br></th>
                                            <th width="25%">Customer Name <br></th>
                                            <th width="10%">Date</th>
                                            <th  width="10%">Time <br></th>
                                            <th  width="10%">Amount <br></th>
                                            <th width="10%">Profit <br></th>
                                            <th width="5%"> <br></th>
                                       </thead>
                                    <?php
                                        $gt =0;
                                        $ex_tot = 0;
                                        $ex_total_profit=0;
                                         $userid = $_GET['ex_id'];
                                         $fromdate = $_GET['fromdate'];
                                         $todate = $_GET['todate'];
                                         $results = $db_handle->getExecutivesWiseReport($userid,$fromdate,$todate);
                                         
                                        $trow=count($results);
                                        if($trow>0){
                                        foreach($results as $invoice) {
                                        ?>
                                       <tr>
                                            <td><?php echo htmlentities("Invoice - ".$invoice["invoice_Number"]); ?></td>

                                            <td><?php echo htmlentities($invoice["customerName"]); ?></td>
                                            <td><?php echo htmlentities($invoice["invoiceDate"]); ?></td>
                                            <td><?php echo htmlentities($invoice["invoiceTime"]); ?></td>
                                            <td><?php 

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

                                            echo htmlentities($total." TK"); ?></td>
                                             <td>
                                               <?php echo htmlentities($total_profit." TK"); ?>
                                               </td>
                                               <td>
                                                <a target="_BLANK" href="save_invoice_as_pdf.php?id=<?php echo $invoice["invoice_Number"];?>">Details</a>
                                            </td>
                                       </tr>

                                       <?php 
                                           
                                        } } ?>

                                        <tfoot>
                                           <th colspan="4">Total</th>
                                           <th colspan=""><b><?php echo $ex_tot." TK";?></b></th>
                                           <th colspan=""><b><?php echo $ex_total_profit." TK";?></b></th>
                                        </tfoot>
                                </table>
 


                             <?php
                              } ?>
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


    </body>
</html>