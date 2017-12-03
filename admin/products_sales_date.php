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
                        <li class="active"><a href="manage_products.php"> Manage Product</a></li>
                        <li><a href="manage_users.php"> Manage User</a></li>
                        <li><a href="manage_report.php"> Manage Report</a></li>
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
                        <div class="block span12">
                            <div class="navbar navbar-inner block-header">
                              <div class="muted pull-left" > </div>
                                 </div>
                            <div class="block-content collapse in">

                                <table style="margin-top:-15px"; class="table table-bordered table-stripted table-hover">
                                      <thead style="font-size:15px;color:black;">
                                            <th width=""></th>
                                       </thead>
                                    <?php
                                         $results = $db_handle->getProductsSaleDate();
                                        $trow=count($results);
                                          if($trow>0)
                                            {
                                                foreach($results as $invoice) 
                                                {
                                                ?>
                                               <tr>
                                                    <td><a href="product_sales_list.php?cdate=<?php echo htmlentities($invoice["invoiceDate"]);?>"><?php echo date("d-M-Y", strtotime(htmlentities($invoice["invoiceDate"]))); ?></a></td>
                                                </tr>

                                            <?php   
                                                }
                                            }else{
                                            echo "<tr><td>This Products is not sale yet</td></tr>";
                                        }
                                        ?>

                                       
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