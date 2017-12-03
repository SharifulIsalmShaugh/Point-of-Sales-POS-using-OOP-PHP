<?php 
require_once 'header_link.php';  
$db_handle = new myFunctions();
$autofocus='autofocus';
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
                    <ul class="nav nav-list bs-docs-sidenav  collapse">
                       
                        <li><a></a></li>
					    <li><a href="dashboard.php"> Dashboard</a></li>
                        <li class="active"><a href="sales.php"> Sales</a></li>
                        <li><a href="report.php"> Report</a></li>
                        <li><a href="search_invoice.php"> Search Invoice</a></li>
                        <li><a href="profile.php"> Profile</a></li>
                        <li><a href="logout.php"> Log Out</a></li>
						
                        <li><a></a></li>


					</ul>
                </div>
                
                <div class="span10" id="content"  style="margin-top:-10px;" >
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="">
                            <div class="block-content in">
                                  <div class="row-fluid">
                                    <div class="span12" align="right" style="margin-top:-15px;">
                                         <a href="sales.php" class="btn btn-info">Refresh</a> 
                                         <a href="sales.php?new_invoice=new" style="margin-right:-25px;"  class="btn btn-default">Create New Invoice</a> 
                                    </div>
                                </div>

                                <div class="row-fluid"  align="center">
                                    <div class="span10" style="">
                                         <form style="margin-top:15px;" action="" method="POST">
                                         <a style="margin-top:-15px;"  rel="facebox" href="add_product_by_category.php" class="btn btn-primary">Add Product By Category</a> 
                                         &nbsp;&nbsp;&nbsp;
                                          <b>OR,</b> 
                                         &nbsp;&nbsp;&nbsp;
                                           <input  <?php if(!isset($_POST['barcode_product'])){echo $autofocus;}?>  name="productCode" type="text" class="span4" placeholder="Click here and scan product's barcode" >
                                          <input type="submit" name="barcode_product" value="Continue" style="margin-top:-10px;" class="btn btn-success">
                                        </form>
                                    </div>
                                </div> 

                                <?php if(isset($_POST['barcode_product'])){ ?>
                                <div class="row-fluid"  align="center">
                                    <div class="span12">
                                    <hr  style="margin-top:-15px;" >
                                        <?php 
                                            $code = $_POST['productCode'];
                                           $r = $db_handle->getTotalRowNumber("tbproducts","code","$code");
                                           if ($r>0) { 
                                                $results = $db_handle->getProductDetailsbyCode($code);
                                               foreach($results as $product) {  
                                        ?>

                                              <form method="POST" action="save_to_tbtmp.php" onsubmit="return cal()" >
                                                <p style="font-size:14px;color:black;margin-top:-5px;margin-bottom:25px;">
                                                    Category: <b><?php echo htmlentities($product["cname"]); ?></b>
                                                    &nbsp;>> &nbsp;
                                                    Sub Category: <b><?php echo htmlentities($product["sub_cat_name"]); ?></b>
                                                    &nbsp;>> &nbsp; 
                                                    Product Name: <b><?php echo htmlentities($product["pname"]); ?></b>
                                                    &nbsp;>> &nbsp;
                                                    Available Quantity: <span style="font-size:16px;"><b><?php echo htmlentities($product["quantity"]); ?> </b></span>
                                                </p>
                                                <input name="product_id" hidden value="<?php echo htmlentities($product["pid"]); ?>">
                                                <input name="price" hidden value="<?php echo htmlentities($product["sellingPrice"]-$product["discount"]); ?>">
                                                <input name="avail_quan" id="avilable" onkeyup="cal();"  value="<?php echo htmlentities($product["quantity"]); ?>" hidden >
                                                <input disabled type="text" class="span4" value="<?php echo "Price: ". htmlentities($product["sellingPrice"]-$product["discount"])." Taka (including Discount and VAT)"; ?> ">
                                                <input name="quantity" onkeyup="cal();"  id="quantity" required autofocus placeholder="Quantity" type="text" class="span3"  ><span id="txt3"></span>
                                                <br >
                                                <input id="add_product" name="add" type="Submit" value="Add Product to List" class="btn btn-info">
                                              </form>

                                      <?php
                                           } 
                                         }else{
                                              echo "<h4 style='color:red;'>Invalid Product's barcode </h4>";
                                           }
                                      ?>
                                        <hr   style="margin-top:-5px;" >
                                    </div>
                                </div> 
                                <?php } ?>

                            </div>
                        </div>
                        <!-- /block -->
                        <!-- block -->
                        <div class="row-fluid">
                        <br>
                        <?php                       
                            if(isset($_GET['new_invoice'])){
                              $tmpId = $_SESSION['tmpSalesNumber'];

                                $r = $db_handle->getTotalRowNumber("tbproductsales_tmp","tmpSalesNumber",$tmpId);
                                if($r<=0){
                                      unset($_SESSION['tmpSalesNumber']);
                                }else{

                                $results = $db_handle->getTmpProducts($tmpId);
                                 foreach($results as $product) {
                                    $pid = $product["pid"];
                                    $quantity = $product["productQtys"];
                                    $tmpid = $product["tmpid"];
                                    $db_handle->updateIncreseProductQuantity($pid,$quantity);
                                    $db_handle->deleteProductFromChart($tmpid);
                                    unset($_SESSION['tmpSalesNumber']);
                                 }                             
                                }
                              }

                                
                            if(!isset($_SESSION['tmpSalesNumber']))
                            {
                             $tmp_id1 = rand(1000000,9999999);
                             $_SESSION['tmpSalesNumber']=md5($tmp_id1);
                            }
                            
                            $tmp_id = $_SESSION['tmpSalesNumber'];
                        ?>
                            
                            <div class="span12">
                               <?php 
                                    $tmp_id = $_SESSION['tmpSalesNumber'];
                                    $results = $db_handle->getTmpProducts($tmp_id);
                               ?>
                               <table style="margin-top:-30px"; class="table table-bordered table-stripted table-hover">
                                      <thead style="font-size:15px;color:black;">
                                            <th width="3%">SN</th>
                                            <th width="35%">Product Name <br></th>
                                            <th width="4%">Quantity <br></th>
                                            <th width="12%">Rate <span style="font-size:11px;">(inc. Vat & Discount)</span></th>
                                            <th  width="8%">Sub-Total <br></th>
                                            <th width="4%">Action <br></th>
                                       </thead>
                                        <?php
                                        $i=0;
                                        $gt =0;
                                        $trow=count($results);
                                        if($trow>0){
                                         
                                         foreach($results as $product) {
                                        ?>
                                       <tr>
                                            <td><?php echo ++$i; ?></td>
                                            <td><b><?php echo htmlentities($product["pname"]); ?></b><br>
                                            <span style="font-size:11px;"><?php echo htmlentities($product["description"]); ?></span>

                                            </td>
                                            <td><?php echo htmlentities($product["productQtys"])." ".htmlentities($product["unitName"]); ?> </td>
                                            <td><?php echo htmlentities($product["productPriceRate"]); ?> Taka</td>
                                             <td><?php echo htmlentities(($product["productPriceRate"])*($product["productQtys"])); ?> Taka</td>
                                            <td>
                                                <a style="text-decoration:none;color:red;" onClick="return confirm('Do you want to remove this Product from Chart?');"  href="remove_product.php?id=<?php echo $product['tmpid']; ?>&&pid=<?php echo $product['pid']; ?>&&quantity=<?php echo $product['productQtys']; ?>" >Remove</a>
                                       </tr>

                                       <?php 
                                        $gt = $gt + (($product["productPriceRate"])*($product["productQtys"]));
                                         
                                        } 
                                       }else{
                                          echo "<tr><td colspan='7' > <center>No Products are in Chart</center></td></tr>";
                                        } 
                                        ?> 
                                        <tfoot>
                                            <th colspan="4" >Total </th>
                                            <th  colspan="" style="font-size:15px;"><?php echo $gt;?> Taka</th>
                                            <th  colspan=""></th>
                                       </tfoot>
                                   </table>
                                   <div class="row-fluid">
                                    <div class="span12" align="center">
                                         <a  style="margin-left:10px;" rel="facebox" href="poccessing_save_invoice.php?tot=<?php echo $gt;?>" class="btn btn-success">Save Invoice</a> 
                                    </div>
                                </div>         

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
         function cal() {
            var txtFirstNumberValue = document.getElementById('avilable').value;
            var txtSecondNumberValue = document.getElementById('quantity').value;
            var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
            if (!isNaN(result)) {

                if (result<0) {
                  document.getElementById('txt3').innerHTML = "<br><b style='color:red;'>Product Quantity is not Available in Stock</b>";
                document.getElementById('add_product').innerHTML.hidden;
                return false;
                };
                if (result>=0) {
                  document.getElementById('txt3').innerHTML = "";
                return true;
                };
            }
        }
</script>

        <!--/.fluid-container-->
        <script src="assets/js/jquery-1.9.1.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>