<?php 
require_once 'header_link.php';                           
$db_handle = new myFunctions();

  if(!isset($_REQUEST['keywords']) && !isset($_REQUEST['num_rows']) ){
    $search = "";
    $num_rows = "15";
  }else{
    $search = $_REQUEST['keywords'];
    $num_rows = $_REQUEST['num_rows'];
  }
  if($num_rows==''){
    $num_rows = 15;
  }

  if($search != NULL && $num_rows!= NULL){
    $results = $db_handle->getNotifications($search,$num_rows);
  }
  if ($num_rows !=NULL && $search == NULL) {
    $results = $db_handle->getNotifications("",$num_rows);
  }


  if(isset($_POST['add_quantity'])){

$pid = mysql_escape_string($_POST['pid']);
$new_quantity = mysql_escape_string($_POST['new_quantity']);

$r = $db_handle->addProductQuantity($pid,$new_quantity);
echo "<script> document.location.href='notification.php';</script>";
  }
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
                    <ul class="nav nav-list bs-docs-sidenav collapse">
                       
                        <li><a></a></li>
					    <li><a href="dashboard.php"> Dashboard</a></li>
                        <li><a href="manage_products.php"> Manage Product</a></li>
                        <li><a href="manage_users.php"> Manage User</a></li>
                        <li><a href="manage_report.php"> Manage Report</a></li>
                        <li><a href="manage_references.php"> Raferences</a></li>
                        <li class="active"><a href="notification.php"> Notification <span class="badge"><?php echo $db_handle->getNotificationsNum();?></span></a></li>
                        <li><a href="others.php"> Others</a></li>
                        <li><a href="logout.php"> Log Out</a></li>
                        <li><a></a></li>


					</ul>
                </div>
                
                <div class="span10" style="margin-left:20px;" id="content">
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left" >Notification</div>
                            </div>
                            <div class="block-content collapse in">
                               
								
                               <center>
                                   <form action="" method="GET">
                                       <input name="keywords" type="text" value="<?php echo $search; ?>" placeholder="Search Keywords">
                                       <select name="num_rows">
                                           <option value="">Numbers of Row</option>
                                           <option value="20">20 rows</option>
                                           <option value="30">30 rows</option>
                                           <option value="50">50 rows</option>
                                           <option value="100">100 rows</option>
                                           <option value="200">200 rows</option>
                                       </select>
                                        <input  class="btn btn-success" style="margin-bottom:8px; margin-top:-5px;"  type="submit" value="Load" >
                                       </form>
                                    </center>

                                   <table style="margin-top:-15px"; class="table table-bordered table-stripted table-hover">
                                      <thead>
                                            <th width="3%">SN</th>
                                            <th width="12%">Product Code</th>
                                            <th width="25%">Product Name</th>
                                            <th  width="15%">Sub-Category</th>
                                            <th width="25%">Notification</th>
                                            <th width="15%">Action</th>
                                       </thead>
                                        <?php
                                        $i=0;
                                        $trow=count($results);
                                        if($trow>0){
                                         
                                         foreach($results as $product) {
                                        ?>
                                       <tr>
                                            <td><?php echo ++$i; ?></td>
                                            <td><?php echo htmlentities($product["code"]); ?></td>
                                            <td><?php echo htmlentities($product["pname"]); ?></td>
                                            <td><?php echo htmlentities($product["sub_cat_name"]); ?></td>
                                            <td><?php echo "Available product quantity is : <b>".htmlentities($product["quantity"]); ?></b></td>
                                            <td>
                                                <a style="text-decoration:none;color:green;" href="details_product.php?id=<?php echo $product['pid']; ?>"  rel="facebox" >Details</a>
                                                | <a style="text-decoration:none;color:blue;" rel="facebox"  href="add_product_quantity.php?pid=<?php echo $product['pid']; ?>&&pname=<?php echo htmlentities($product["pname"]); ?>"> Add Quantity</a>
                                            </td>
                                       </tr>
                                       <?php 
                                         
                                        } 
                                       }else{
                                          echo "<tr><td colspan='7' > <center>No data are matching</center></td></tr>";
                                        } 
                                        ?>
                                   </table>
                                    <?php 
                                    echo "Showing <b>".$i."</b> Rows of <b>".$db_handle->getNotificationsNum()."</b> Rows";
                                    echo " <br /> Searching Criteria : <b>".$search."</b>";
                                     ?>
                                                <br ><br >
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