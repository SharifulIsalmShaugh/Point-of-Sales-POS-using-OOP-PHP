<?php 
require_once 'header_link.php';  
?>

<div class="row animated  " style="color:black;">
        <div class="span-12">
          <form action="" method="POST" onsubmit="return check()" >
            <table class="table table-striped table-bordered responsive-utilities">
                <tr>
                    <td class="span5">Old Password</td>
                    <td>
                        <input  name="oldpassword" autofocus class="span4" required  placeholder="Enter old password"  type="password"  />
                    </td>
                </tr>
                <tr>
                    <td class="span5">New Password</td>
                    <td>
                        <input  class="span4" required placeholder="Enter New password"  id="txt1" type="password" name="newpassword" />
                    </td>
                </tr>                          
                <tr>
                    <td class="span5">Confirm Password</td>
                    <td>
                        <input  class="span4" name="cpassword" required placeholder="Confirm New password"  id="txt2" type="password" />
                        <span id='txt3'></span>
                    </td>
                </tr>
                <tr>
                    <td class=" "></td>
                    <td class=" ">
                        <input type="submit" name="update_password" value="Save" class="btn btn-success ">
                        <input type="reset" name="" value="Reset" class="btn btn-warning ">
                    </td>
                </tr>
            </table>
            <span  class="span7"  type="text" disabled  ></span>
          </form>
         </div>
    </div>
</div>
<script>
function check() {

var txtFirstNumberValue = document.getElementById('txt1').value;
var txtSecondNumberValue = document.getElementById('txt2').value;
    if (txtFirstNumberValue!=txtSecondNumberValue) {
      document.getElementById('txt3').innerHTML = "<b style='color:red;'>Password does not matched!</b>";
    return false;
    };
    if (txtFirstNumberValue==txtSecondNumberValue) {
      document.getElementById('txt3').innerHTML = "";
    return true;
    };
}
</script>