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
                                <div class="muted pull-left" >Editing Product Information</div>
                                <div class="pull-right" ><a href="all_products_list.php" style="margin-bottom:8px; margin-top:-5px;" class="btn btn-xs btn-primary">All Products List</a></div>
                            </div>
                            <div class="block-content collapse in">
                               
                               <center>
                               <?php if (isset($_POST['update'])) {

                                $pid = mysql_escape_string($_POST['pid']);
                                $pname = mysql_escape_string($_POST['pname']);
                                $pcode = mysql_escape_string($_POST['pcode']);
                                $subcat_id = mysql_escape_string($_POST['subcat_id']);
                                $quantity = mysql_escape_string($_POST['quantity']);
                                $description = mysql_escape_string($_POST['description']);
                                $originalPrice = mysql_escape_string($_POST['originalPrice']);
                                $sellingPrice = mysql_escape_string($_POST['sellingPrice']);
                                $discount = mysql_escape_string($_POST['discount']);

                                $r = $db_handle->updateProductInfo($pid,$pname,$pcode,$subcat_id,$quantity,$description,$originalPrice,$sellingPrice,$discount);

                                if($r==1){
                                    echo "<h2 style='color:green;'>Product Information has been Successfully Updated</h2>";

                                    echo "<br />";

                                    echo "<a href='manage_products.php' style='margin-bottom:8px; margin-top:-5px;'' class='btn btn-xs btn-primary'>Manage Products</a>";
                                }else{
                                    echo "<h2 style='color:red;'>Information Update Failed</h2>";

                                    echo "<br />";
                                    echo "<br />";
                                    echo "<a href='manage_products.php' style='margin-bottom:8px; margin-top:-5px;'' class='btn btn-xs btn-primary'>Manage Products</a>";
                                  }

                               }else{ 

                                    $id = $_REQUEST['id'];
                                    $results = $db_handle->getProductDetails($id);
                                    
                                  foreach($results as $product) {
                                  ?>
                                      <table class="table table-bordered" width="800px;">
                                      <script>
                                      function getSubCat(val) {
                                      $.ajax({
                                      type: "POST",
                                      url: "get_sub_category.php",
                                      data:'category_id='+val,
                                      success: function(data){
                                      $("#subcat_list").html(data);
                                      }
                                      });
                                      } 
                                    </script>


                                    <form action="" method="POST" >
                                      <input hidden name="pid" value="<?php echo $id;?>">
                                      <tr><td width="30%">Product Code:</td><td><input class="span10"  style="margin-bottom:-0px;" name="pcode" type="text" value="<?php echo htmlentities($product["code"]); ?>"></td></tr>
                                      
                                      <tr><td>Product Name:</td><td><input name="pname" class="span10"  type="text" value="<?php echo htmlentities($product["pname"]); ?>">  </td></tr>
                                      
                                      <tr><td>Category:</td><td>
                                      <select name="cat_id" required  onChange="getSubCat(this.value);" >
                                      <option value=""> Select Category</option>
                                        <?php
                                          $results = $db_handle->getCategory("","50000");
                                       foreach($results as $category) {
                                        ?>
                                           <option value="<?php echo $category['cid']; ?>"><?php echo $category['cname']; ?></option>
                                        <?php } ?>
                                        </select> Previous Category: <b><?php echo htmlentities($product["cname"]); ?></b></td></tr>

                                        <tr><td>Sub-Category:</td><td>
                                         <select id="subcat_list" name="subcat_id" required > 
                                            <option value="">Select </option>
                                          </select> Previous Sub-Category: <b><?php echo htmlentities($product["sub_cat_name"]); ?></b>
                                      </td></tr>
                                      
                                      <tr><td>Description:</td><td><textarea name="description" class="span10"  style="margin-bottom:-2px;"><?php echo htmlentities($product["description"]); ?></textarea></td></tr>
                                      <tr><td>Quantity:</td><td><input name="quantity" class="span10"  style="margin-bottom:-2px;" type="text" value="<?php echo htmlentities($product["quantity"]); ?>"></td></tr>
                                      <tr><td>Original Price:</td><td><input name="originalPrice" class="span10"  style="margin-bottom:-2px;"  type="text" value="<?php echo htmlentities($product["originalPrice"]); ?>"></td></tr>
                                      <tr><td>Selling Price:</td><td><input name="sellingPrice" class="span10"  style="margin-bottom:-2px;"  type="text" value="<?php echo htmlentities($product["sellingPrice"]); ?>"></td></tr>
                                      <input name="vat" hidden  style="margin-bottom:-2px;"  value="<?php echo htmlentities($product["vat"]); ?>">
                                      <tr><td>Discount:</td><td><input name="discount" class="span10"  type="text" style="margin-bottom:-2px;"  value="<?php echo htmlentities($product["discount"]); ?>"></td></tr>
                                      <tr><td>:</td><td><input name="update" type="submit" class="btn btn-success" style="margin-bottom:-2px;"  value="Update"></td></tr>
                                   </form>
                                    </table>

                                    <?php } } ?>
                                </center>

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