<?php 
require_once 'header_link.php';                           
$db_handle = new myFunctions();
  $id = $_REQUEST['id'];
  $results = $db_handle->getProductDetails($id);
foreach($results as $product) {
?>
   <h3 style="color:black;margin-top:-10px;" align="center"><?php echo htmlentities($product["pname"]); ?></h3>
  <table class="table table-bordered" width="450px;">
    <tr><td width="30%">Product Code:</td><td><b><?php echo htmlentities($product["code"]); ?></b></td></tr>
    <tr><td>Product Name:</td><td><b><?php echo htmlentities($product["pname"]); ?></b></td></tr>
    <tr><td>Sub-Category:</td><td><?php echo htmlentities($product["sub_cat_name"]); ?></td></tr>
    <tr><td>Category:</td><td><?php echo htmlentities($product["cname"]); ?></td></tr>
    <tr><td>Description:</td><td><?php echo htmlentities($product["description"]); ?></td></tr>
    <tr><td>Quantity:</td><td><b><?php echo htmlentities($product["quantity"])." ".htmlentities($product["unitName"]); ?></b></td></tr>
    <tr><td>Original Price:</td><td><?php echo htmlentities($product["originalPrice"]); ?></td></tr>
    <tr><td>Selling Price:</td><td><?php echo htmlentities($product["sellingPrice"]); ?></td></tr>
    <tr><td>Discount:</td><td><?php echo htmlentities($product["discount"]); ?></td></tr>
    <tr><td>Image:</td><td><img width="200px" height="150px" src="../product_image/<?php echo htmlentities($product["image"]); ?>" ></td></tr>
 
  </table>

  <?php }   ?>



