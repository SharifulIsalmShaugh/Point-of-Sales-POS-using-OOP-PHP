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
                <div class="span2" id="sidebar">
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
                
                <div class="span10" style="margin-left:10px;" id="content">
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                              <div class="muted pull-left" >Report <?php if(isset($_GET['fromdate'])&&isset($_GET['todate'])){ ?>(From:<?php echo date("d-M-Y", strtotime($_GET['fromdate']));?> - To:<?php echo date("d-M-Y", strtotime($_GET['todate']));  ?>) <?php } ?> </div>
                                 <?php if(isset($_GET['show_report'])){  ?>
                                <div class="muted pull-right" style="margin-top:-10px;margin-boyyom:5px;" >
                                <a class="btn btn-default" href="manage_report.php"><< Go Back</a>
                                <a class="btn btn-info" href="date_wise_report_export_to_word.php?fromdate=<?php echo $_GET['fromdate'];?>&&todate=<?php echo $_GET['todate'];?>">Export to Word</a>
                                 &nbsp;
                                 <a class="btn btn-success" href="date_wise_report_export_to_excel.php?fromdate=<?php echo $_GET['fromdate'];?>&&todate=<?php echo $_GET['todate'];?>">Export to Excel</a>
                                 &nbsp;
                                 <a target="_BLANK" class="btn btn-primary" href="date_wise_report_as_pdf.php?fromdate=<?php echo $_GET['fromdate'];?>&&todate=<?php echo $_GET['todate'];?>">Save as PDF</a></div>
                                <?php } ?>
                            </div>
                            <div class="block-content collapse in">
                              
                              <br>
                                <table style="margin-top:-15px"; class="table table-bordered table-stripted table-hover">
                                      <thead style="font-size:15px;color:black;">
                                            <th width="10%">Invoice no. <br></th>
                                            <th width="25%">Customer Name <br></th>
                                            <th width="10%">Date</th>
                                            <th  width="10%">Time <br></th>
                                            <th  width="10%">Amount <br></th>
                                            <th width="10%"></th>
                                       </thead>
                                    <?php
                                        $gt =0;
                                        $ex_tot = 0;
                                         $date = $_GET['cdate'];
                                         $cphone = $_GET['cphone'];
                                         $results = $db_handle->getCustomerInvoiceByDate($date,$cphone);
                                         
                                        $trow=count($results);
                                        if($trow>0){
                                        foreach($results as $invoice) {
                                        ?>
                                       <tr>
                                            <td><?php echo htmlentities("Invoice-".$invoice["invoice_Number"]); ?></td>

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
                                               }
                                            }
                                              $ex_tot+=$total;
                                              
                                            echo htmlentities($total." TK"); ?></td> 
                                           
                                            <td>
                                                <a target="_BLANK" href="save_invoice_as_pdf.php?id=<?php echo $invoice["invoice_Number"];?>">Details</a>
                                            </td>
                                          </tr>

                                       <?php 
                                           
                                        } } ?>
                                </table>

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