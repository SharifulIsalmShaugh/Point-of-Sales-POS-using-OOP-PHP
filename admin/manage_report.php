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
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">  <?php echo $user;?> </a>
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
                                <div class="muted pull-left" >Search Invoice</div>
                           </div>
                            <div class="block-content collapse in">
                              <a href="search_invoice.php" class="btn btn-primary">Search Invoice</a>
                            </div>
                        </div>
                        <!-- /block -->
                        
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left" >Date Wise Report</div>
                           </div>
                            <div class="block-content collapse in">
                               <form action="date_wise_report.php" method="GET">
                                <input type="text" name="fromdate" style="margin-top:10px;" placeholder="Select Date" id="datepicker"> &nbsp;&nbsp;
                                <input type="text" name="todate" style="margin-top:10px;" id="datepicker1" placeholder="Select Date" >
                                <input name="show_report" type="submit" class="btn btn-success"  value="Show report"> 
                               </form> 
                            </div>
                        </div>
                        <!-- /block -->
                                                
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left" >Executive Wise Report</div>
                           </div>
                            <div class="block-content collapse in">
                               <form action="executive_wise_report.php" method="GET">
                                    <Select  style="margin-top:10px;" name="ex_id" >
                                        <option value="">Select Executive</option>
                                        <?php
                                        $results = $db_handle->getUsersList();
                                        foreach($results as $user) {
                                        ?>
                                            <option value="<?php echo $user['userid']; ?>"><?php echo $user['userFullName']; ?></option>
                                        <?php } ?>
                                    </Select> 
                                    <input type="text" name="fromdate" style="margin-top:10px;" placeholder="Select Date"  id="datepicker2" > &nbsp;&nbsp;
                                    <input type="text" name="todate" style="margin-top:10px;" placeholder="Select Date"  id="datepicker3" >
                                   
                                    <input name="show_report" type="submit" class="btn btn-info"  value="Show report"> 
                               </form>
                            </div>
                        </div>
                        <!-- /block -->   
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left" >Customer Wise Report</div>
                           </div>
                            <div class="block-content collapse in">
                               <form action="customer_wise_report.php" method="GET">
                               <input type="text" class="span6" name="cus_search" style="margin-top:10px;" placeholder="Enter Customer Name or Phone Number" >
                                <input name="show_report" type="submit" class="btn btn-success"  value="Submit"> 
                               </form> 
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
            $( "#datepicker" ).datepicker();
          } );

          $( function() {
            $( "#datepicker1" ).datepicker();
          } );
          
          $( function() {
            $( "#datepicker2" ).datepicker();
          } ); 
          
          $( function() {
            $( "#datepicker3" ).datepicker();
          } );
          </script>
    </body>
</html>