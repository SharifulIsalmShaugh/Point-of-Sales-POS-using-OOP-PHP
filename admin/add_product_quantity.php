<?php 
require_once 'header_link.php';  
?>

<div class="row animated  " style="color:black;">
        <div class="span-12">
          <form action="" method="POST">
            <table class="table table-striped table-bordered responsive-utilities">
                <tr>
                    <td class="span5">Product Name</td>
                    <td>
                        <input disabled name="pid" class="span4" value="<?php echo $_REQUEST['pname'];?>"   type="text"  />
                    </td>
                </tr>
                <tr>
                    <td class="span5">Quantity</td>
                    <td>
                        <input  name="pid" value="<?php echo $_REQUEST['pid'];?>" hidden />
                        <input  name="new_quantity" autofocus class="span4" required  placeholder="Enter New Quantity Number"  type="text"  />
                    </td>
                </tr>
                <tr>
                    <td class=" "></td>
                    <td class=" ">
                        <input type="submit" name="add_quantity" value="Add" class="btn btn-success ">
                        <input type="reset" name="" value="Reset" class="btn btn-warning ">
                    </td>
                </tr>
            </table>
            <span  class="span7"  type="text" disabled  ></span>
          </form>
         </div>
    </div>
</div>