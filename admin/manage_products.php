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
     		<script src="assets/js/jquery.min.js"></script>
    		<link href="assets/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    		<script src="assets/facebox/facebox.js" type="text/javascript"></script>
    		<script type="text/javascript">
    		  jQuery(document).ready(function($) {
    		    $('a[rel*=facebox]').facebox({
    		      loadingImage : 'assets/facebox/loading.gif',
    		      closeImage   : 'assets/facebox/closelabel.png'
    		    })
    		  })
    		</script>

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
                   <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
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
                
                <div class="span9" id="content">
                      <div class="row-fluid">

                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left" >Manage Product</div>
                                <div class="pull-right" ></div>
                            </div>
                            <div class="block-content collapse in">
                               
                               <a href="all_products_list.php" class="btn btn-primary">View All Products List</a>
                               
                               <a href="in_stock_product.php" class="btn btn-primary">In Stock Products List</a>
                               
                               <a href="stock_out_product.php" class="btn btn-primary">Out of Stock Products List</a>
                               
                               <a href="insufficient_products_list.php" class="btn btn-primary">Insufficient Products List</a>
                                                                
                            </div>
                        </div>
                        <!-- /block -->
                        
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left" >Analysis of Product</div>
                                <div class="pull-right" ></div>
                            </div>
                            <div class="block-content collapse in">
                               
                             <a href="products_sales_date.php" class="btn btn-primary">Product's Sales Summary</a>
                             
                             <a href="products_sales_date_graph.php" class="btn btn-primary">Product's Sales Summary By Graph</a>
                               
                                                                
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