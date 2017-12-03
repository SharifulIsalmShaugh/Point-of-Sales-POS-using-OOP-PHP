<?php 
require_once 'header_link.php';  
$db_handle = new myFunctions();
?>
<div class="row-fluid" style="color:black;">
    <div class="span12">
        <form action="save_invoice.php" method="POST">
        <table class="table table-striped table-bordered">
            <h3 align="center">Customer's Information</h3>
            <br />
                    <tr>
                    <td class="span4" >Customer Name:</td>
                    <td class="span8" ><input required placeholder="Customer Name" class="span12" type="text"  name="name"></td>
                    </tr>
                    
                    <tr>
                    <td class="span2">Customer Phone</td>
                    <td class="span4"><input type="text"   placeholder="Customer Phone"  class="span12" name="phone"></td>
                    </tr>

                    <tr>
                    <td class="span2">Customer Address</td>
                    <td class="span4"><input type="text"   placeholder="Customer Address" class="span12" name="address"></td>
                    </tr>

                    <tr>
                    <td class="span2">Total Amount</td>
                    <td  class="span4"><input value="<?php echo $_REQUEST['tot'];?>" id="txt2"  onkeyup="cal();"  disabled type="text"  class="span12" name="total_amount"></td>
                    </tr>
                    <tr>
                    <td class="span2">Tendered Amount</td>
                    <td class="span4"><input required placeholder="Tendered Amount" type="number"   id="txt1"  onkeyup="cal();"  class="span12" name="tendered_amount"></td>
                    </tr>

                    <tr>
                    <td class="span2">Return Change</td>
                    <td class="span4"><input  placeholder="" id="txt3" disabled type="text" class="span12" name="change_amount"></td>
                    </tr>
                    
    					<tr>
                    <td class="span2"></td>
                    <td  class="span4">
                    <input type="submit" name="invoice_save_print" value="Save & Print" class="btn btn-primary ">
                    </td>
                    </tr>
        </table>
        </form>
    </div>
</div>

<script>
    function cal() {
        var txtFirstNumberValue = document.getElementById('txt1').value;
        var txtSecondNumberValue = document.getElementById('txt2').value;
        var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
        if (!isNaN(result)) {
            document.getElementById('txt3').value = result;
        }
    }
</script>
