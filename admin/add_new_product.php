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
                                <div class="muted pull-left" >New Product Information</div>
                                <div class="pull-right" ><a href="all_products_list.php" style="margin-bottom:8px; margin-top:-5px;" class="btn btn-xs btn-primary">All Products List</a></div>
                            </div>
                            <div class="block-content collapse in">
                               
                               <center>
                               <?php if (isset($_POST['save'])) {

                                $pname = mysql_escape_string($_POST['pname']);
                                $pcode = mysql_escape_string($_POST['pcode']);
                                $subcat_id = mysql_escape_string($_POST['subcat_id']);
                                $quantity = mysql_escape_string($_POST['quantity']);
                                $discription = mysql_escape_string($_POST['discription']);
                                $originalPrice = mysql_escape_string($_POST['originalPrice']);
                                $sellingPrice = mysql_escape_string($_POST['sellingPrice']);
                                $vat = mysql_escape_string($_POST['vat']);
                                $discount = mysql_escape_string($_POST['discount']);
                                $unitid = mysql_escape_string($_POST['unitid']);
                                $image = "default.jpg";
                                
                                if(isset($_FILES['photo']['name'])){
                                  $a = explode(".", $_FILES['photo']['name']);
                                  if(count($a) > 1)
                                  {
                                      $ext = strtolower($a[count($a) - 1]);
                                      
                                      if($ext=="jpg" || $ext=="png" || $ext=="jpeg")
                                      {
                                          if(($_FILES['photo']['size']) <= (3000*1024))
                                          {
                                            
                                            $maxrow= $db_handle->getTotalRowNumber("tbproducts");

                                                 $picture_tmp = $_FILES['photo']['tmp_name'];
                                                  $picture_name = $_FILES['photo']['name'];
                                                  $picture_type = $_FILES['photo']['type'];
                                                  $extension1=end(explode(".", $picture_tmp));
                                                  $extension=end(explode(".", $picture_name));
                                                  $image="p"."_".$maxrow."_".$pcode .".".$extension;
                                                  $newfilename1="p"."_".$maxrow."_".$pcode .".".$extension1;
                                                  $path = '../product_image/'.$image; 

                                                  move_uploaded_file($picture_tmp, $path);

                                          }
                                      }
                                    }
                                  }

                                $r = $db_handle->insertNewProductInfo($pname,$pcode,$subcat_id,$quantity,$discription,$unitid,$originalPrice,$sellingPrice,$vat,$discount,$image);

                                if($r==1){
                                    echo "<h2 style='color:green;'>Product Information has been Successfully Updated</h2>";

                                    echo "<br />";

                                    echo "<a href='add_new_product.php' style='margin-bottom:8px; margin-top:-5px;'' class='btn btn-xs btn-primary'>Add Another Product</a> &nbsp;&nbsp;";
                                    echo "<a href='manage_products.php' style='margin-bottom:8px; margin-top:-5px;'' class='btn btn-xs btn-primary'>Manage Products</a>";
                                }else{
                                    echo "<h2 style='color:red;'>Product Insertion Failed</h2>";

                                    echo "<br />";
                                    echo "<br />";
                                    echo "<a href='manage_products.php' style='margin-bottom:8px; margin-top:-5px;'' class='btn btn-xs btn-primary'>Manage Products</a>";
                                  }

                               }else{ ?>

                                 
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


                                    <form action="" method="POST" enctype="multipart/form-data"  >
                                      <tr><td width="30%">Product Code:</td><td><input autofocus style="margin-bottom:-0px;" class="span10" required name="pcode" type="text" value=""></td></tr>
                                      
                                      <tr><td>Product Name:</td><td><input  class="span10" required name="pname" type="text" value="">  </td></tr>
                                      
                                      <tr><td>Category:</td><td>
                                      <select name="cat_id" required class="span10"  onChange="getSubCat(this.value);" >
                                      <option value=""> Select Category</option>
                                        <?php
                                          $results = $db_handle->getCategory("","50000");
                                       foreach($results as $category) {
                                        ?>
                                           <option value="<?php echo $category['cid']; ?>"><?php echo $category['cname']; ?></option>
                                        <?php } ?>
                                        </select></td></tr>

                                        <tr><td>Sub-Category:</td><td>
                                         <select id="subcat_list" name="subcat_id" class="span10"  required > 
                                            <option value="">Select </option>
                                          </select>
                                      </td></tr>
                                      
                                      <tr><td>Quantity:</td><td><input required name="quantity" style="margin-bottom:-2px;"  class="span10" type="number" step="any" value=""></td></tr>
                                      
                                      <tr><td>Description:</td><td><textarea  class="span10" required name="discription" style="margin-bottom:-2px;"></textarea></td></tr>
                                      
                                      <tr><td>Unit:</td><td>
                                        <select name="unitid"  class="span10"  required >
                                            <option value=""> Select Unit</option>
                                            <?php
                                            $results = $db_handle->getUnit("","50000");
                                            foreach($results as $unit) {
                                            ?>
                                             <option value="<?php echo $unit['id']; ?>"><?php echo $unit['unitName']; ?></option>
                                          <?php } ?>
                                        </select>

                                      </td></tr>
                                      
                                      <tr><td>Original Price:</td><td><input  class="span10" name="originalPrice" style="margin-bottom:-2px;" id='txt1' required  type="number" step="any" value=""></td></tr>
                                      
                                      <tr><td>Selling Price :</td><td><input  class="span10" name="sellingPrice" style="margin-bottom:-2px;" id='txt2' required type="number" step="any" value=""></td></tr>
                                      
                                      <tr><td>Vat (%) :</td><td><input  class="span10"  name="vat" style="margin-bottom:-2px;" id='txt2' required type="number" step="any" value=""></td></tr>
                                   
                                      <tr><td>Discount:</td><td><input name="discount"  class="span10" type="number" step="any" style="margin-bottom:-2px;" onkeyup="total();" id='txt3' required value=""></td></tr>
                                                                            
                                      <tr><td>Total Price:</td><td><input id="tot"  class="span10" type="text" style="margin-bottom:-2px;"  disabled value=""></td></tr>
                                      
                                                                                 
                                      <tr><td>Image:</td><td><input type="file" style="margin-bottom:-2px;"  class="span10"  name="photo"></td></tr>
                                      
                                
                                      
                                      <tr><td></td><td><input name="save" type="submit" class="btn btn-success" style="margin-bottom:-2px;"  value="Add Product"></td></tr>

                                   </form>
                                    </table>

                                    <?php } ?>
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

        <script>

             function total() {
                var txtSecondNumberValue = document.getElementById('txt2').value;
                var txtThirdNumberValue = document.getElementById('txt3').value;
                var txtVat = 0;
                var result1= (parseInt(txtSecondNumberValue)-parseInt(txtThirdNumberValue))+ parseInt(txtVat);
                if (!isNaN(result1)) {
                    document.getElementById('tot').value = result1;
                }

            }
        </script>
        <script src="assets/js/jquery-1.9.1.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>