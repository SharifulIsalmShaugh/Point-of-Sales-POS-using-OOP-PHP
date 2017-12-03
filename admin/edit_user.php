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
                        <li><a href="manage_products.php"> Manage Product</a></li>
                        <li class="active"><a href="manage_users.php"> Manage User</a></li>
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
                                <div class="muted pull-left" >New User Information</div>
                                <div class="pull-right" ><a href="manage_users.php" style="margin-bottom:8px; margin-top:-5px;" class="btn btn-xs btn-primary">Manage Users</a></div>
                            </div>
                            <div class="block-content collapse in">
                               
                               <center>
                               <?php if (isset($_POST['update'])) {

                                $userfname = mysql_escape_string($_POST['userfname']);
                                $usertype = mysql_escape_string($_POST['usertype']);
                                $uemail = mysql_escape_string($_POST['uemail']);
                                $uphone = mysql_escape_string($_POST['uphone']);
                                $ujoiningDate = mysql_escape_string($_POST['ujoiningDate']);
                                $uaddress = mysql_escape_string($_POST['uaddress']);
                                $username = mysql_escape_string($_POST['username']);
                                $image = mysql_escape_string($_POST['photo1']); ;
                                
                                if(isset($_FILES['photo']['name'])){
                                  $a = explode(".", $_FILES['photo']['name']);
                                  if(count($a) > 1)
                                  {
                                      $ext = strtolower($a[count($a) - 1]);
                                      
                                      if($ext=="jpg" || $ext=="png" || $ext=="jpeg")
                                      {
                                          if(($_FILES['photo']['size']) <= (3000*1024))
                                          {
                                                  unlink("user_image/".$image);
                                                  $picture_tmp = $_FILES['photo']['tmp_name'];
                                                  $picture_name = $_FILES['photo']['name'];
                                                  $picture_type = $_FILES['photo']['type'];
                                                  $extension1=end(explode(".", $picture_tmp));
                                                  $extension=end(explode(".", $picture_name));
                                                  $image="user"."_".$usertype."_".$uphone .".".$extension;
                                                  $newfilename1="user"."_".$usertype."_".$uphone .".".$extension1;
                                                  $path = 'user_image/'.$image; 
                                                  move_uploaded_file($picture_tmp, $path);
                                          }
                                      }
                                    }
                                  }


                                    $id = $_REQUEST['id'];
                                    $r = $db_handle->updateUserInfo($id,$userfname,$usertype,$uemail,$uphone,$ujoiningDate,$uaddress,$username,$image);

                                if($r==1){
                                    echo "<h2 style='color:green;'>User Information has been Successfully Updated</h2>";

                                    echo "<br />";

                                    echo "<a href='manage_users.php' style='margin-bottom:8px; margin-top:-5px;'' class='btn btn-xs btn-primary'>Manage Users</a>";
                                }else{
                                    echo "<h2 style='color:red;'>User Updating Failed</h2>";

                                    echo "<br />";
                                    echo "<br />";
                                    echo "<a href='manage_users.php' style='margin-bottom:8px; margin-top:-5px;'' class='btn btn-xs btn-primary'>Manage User</a>";
                                  }

                               }else{
                                 
                                    $id = $_REQUEST['id'];
                                    $results = $db_handle->getUserDetails($id);
                                    
                                  foreach($results as $user) {
                                  ?>
                                <table class="table table-bordered" width="800px;">

                                    <form action="" method="POST" enctype="multipart/form-data"  >
                                     
                                      <tr><td width="25%">Fullname:</td><td><input style="margin-bottom:-0px;" value="<?php echo htmlentities($user["userFullName"]); ?>" class="span10" required name="userfname" type="text" value=""></td></tr>
                                      
                                      <tr><td>Type:</td><td>
                                      <select name="usertype" required class="span7"  onChange="getSubCat(this.value);" >
                                      <option value=""> Select Type</option>
                                        <?php
                                          $results = $db_handle->getUserType("","100");
                                       foreach($results as $usertype) {
                                        ?>
                                           <option value="<?php echo $usertype['userTypeId']; ?>"><?php echo $usertype['userType']; ?></option>
                                        <?php } ?>
                                        </select> Previous Type: <b><?php echo htmlentities($user["userType"]); ?></b></td></tr>

                                      <tr><td>Email :</td><td><input value="<?php echo htmlentities($user["userEmail"]); ?>" name="uemail" style="margin-bottom:-2px;"  class="span10" type="email" </td></tr>
                                      
                                      <tr><td>Phone:</td><td><input  class="span10"  value="<?php echo htmlentities($user["userPhone"]); ?>" name="uphone" style="margin-bottom:-2px;" required  type="text"></td></tr>
                                      
                                      <tr><td>Joining Date:</td><td><input  class="span10"  value="<?php echo htmlentities($user["userJoiningDate"]); ?>" name="ujoiningDate" style="margin-bottom:-2px;"required  type="text" ></td></tr>
                                      
                                      <tr><td>Address:</td><td><textarea  class="span10" required name="uaddress" style="margin-bottom:-2px;"> <?php echo htmlentities($user["userAddress"]); ?></textarea></td></tr>
                                      
                                      <tr><td>Username:</td><td><input  value="<?php echo htmlentities($user["userName"]); ?>"  class="span10" name="username" style="margin-bottom:-2px;" required type="text"></td></tr>
                                      
                                      <tr><td>Password:</td><td><a  onClick="return confirm('Do you want to reset this User password?');" href="reset_user_password.php?user=<?php echo $id;?>">Reset password to default</a> 
                                      </td></tr>
                                      
                                                                                  
                                      <tr><td>Image:</td><td><input name="photo1"  value="<?php echo htmlentities($user["userImage"]); ?>" hidden ><input type="file" style="margin-bottom:-2px;"   name="photo"> <a style="text-decoration:none; color:red;">NB: If You don't want to change photo just skip it</a></td></tr>
                                      
                                
                                      
                                      <tr><td></td><td><input name="update" type="submit" class="btn btn-success" style="margin-bottom:2px;margin-top:8px;"  value="Update User Information"></td></tr>

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

        <script>

             function total() {
                var txtSecondNumberValue = document.getElementById('txt2').value;
                var txtThirdNumberValue = document.getElementById('txt3').value;
                var txtVat = document.getElementById('txt4').value;
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