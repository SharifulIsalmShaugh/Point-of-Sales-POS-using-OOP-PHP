<?php 
require_once 'header_link.php';                           
$db_handle = new myFunctions();
?>
<div>

    <div class="row animated  " style="color:black;">
        <div class="span-12">
            <form action="save_to_tbtmp.php" method="POST" onsubmit="return cal()" >
            <table class="table table-striped table-bordered responsive-utilities">
            <br /><br />
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
                             
                    function getProductList(val) {
                        $.ajax({
                        type: "POST",
                        url: "get_product_list.php",
                        data:'sub_cat_id='+val,
                        success: function(data){
                            $("#product-list").html(data);
                        }
                        });
                    }
                    function getProductPrice(val) {
                        $.ajax({
                        type: "POST",
                        url: "get_product_price.php",
                        data:'product_id='+val,
                        success: function(data){
                            $("#product-price").html(data);
                        }
                        });
                    }
                    function getProductQuantity(val) {
                        $.ajax({
                        type: "POST",
                        url: "get_product_quantity.php",
                        data:'product_id='+val,
                        success: function(data){
                            $("#product-quantity").html(data);
                        }
                        });
                    }
                </script>
                          <tr>
                              <td class="span2">Select Category:</td>
                              <td>
                                  <select class="span4" name="cat_id" required autofocus onChange="getSubCat(this.value);" >
                                      <option value=""> Select Category</option>
                                        <?php
                                          $results = $db_handle->getCategory("","50000");
                                       foreach($results as $category) {
                                        ?>
                                           <option value="<?php echo $category['cid']; ?>"><?php echo $category['cname']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td class="span2">Select Sub-Category:</td>
                                <td >
                                 <select id="subcat_list"  class="span4" onChange="getProductList(this.value);"  required name="subcat_id" required >
                                  </select>
                              </td>
                          </tr>
                        <tr>
                            <td  class="span2">Select Product</td>
                            <td class=" ">
                                <select id="product-list"  class="span4" name="product_id"  onclick="getProductQuantity(this.value);" onChange="getProductPrice(this.value);"  required  class="select2me form-control">
                            </select>
                            </td>
                        </tr>
                        
                        <tr>
                             <td  class="span2">Price</td>
                            <td class=" ">
                                <select id="product-price"  class="span4" name="price"  readonly  class="select2me form-control"></select></td>
                        </tr>

                        <tr>
                            <td  class="span2">Available Quantity</td>
                            <td>
                                <select id="product-quantity" id="avilable_quantity"  class="span4" name="avail_quan"  onkeyup="cal();" readonly  class="select2me form-control"></select>
                            </td>
                        </tr>

                     
                        <tr>
                            <td class="span2">Quantity</td>
                            <td>
                                <input  class="span3" required placeholder="Number of Quantity"  onkeyup="cal();" id="txt2" type="text" name="quantity">
                                <span id='txt3'></span>
                            </td>
                        </tr>
						   
                        <tr>
                            <td class=" "></td>
                            <td class=" ">
                                <input type="submit" name="add_product" value="Add Product" class="btn btn-success ">
                                <input type="reset" name="" value="Reset" class="btn btn-danger ">
                            </td>
                        </tr>
            </table>
                 </form>
                        <span  class="span6"  type="text" disabled  > </span>
         </div>
    </div>
</div>
<script>
function cal() {
var txtFirstNumberValue = document.getElementById('product-quantity').value;
var txtSecondNumberValue = document.getElementById('txt2').value;
var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
if (!isNaN(result)) {

    if (result<0) {
      document.getElementById('txt3').innerHTML = "<br><b style='color:red;'>Product Quantity is not Available in Stock</b>";
    return false;
    };
    if (result>=0) {
      document.getElementById('txt3').innerHTML = "";
    return true;
    };
}
}
</script>
