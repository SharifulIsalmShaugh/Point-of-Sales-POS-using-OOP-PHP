<?php 
require_once 'header_link.php';                           
$db_handle = new myFunctions();
  $id = $_REQUEST['id'];
  $results = $db_handle->getUserDetails($id);
foreach($results as $user) {
?>
   <h3 style="color:black;margin-top:-10px;" align="center"><?php echo htmlentities($user["userFullName"]); ?></h3>
  <table class="table table-bordered" width="450px;">
    <tr><td width="30%">FullName:</td><td><b><?php echo htmlentities($user["userFullName"]); ?></b></td></tr>
    <tr><td>User Type:</td><td><b><?php echo htmlentities($user["userType"]); ?></b></td></tr>
    <tr><td>Email:</td><td><?php echo htmlentities($user["userEmail"]); ?></td></tr>
    <tr><td>Phone:</td><td><?php echo htmlentities($user["userPhone"]); ?></td></tr>
    <tr><td>Address:</td><td><?php echo htmlentities($user["userAddress"]); ?></td></tr>
    <tr><td>Joining Date:</td><td><b><?php echo htmlentities($user["userJoiningDate"]); ?></b></td></tr>
    <tr><td>Username:</td><td><?php echo htmlentities($user["userName"]); ?></td></tr>
    <tr><td>Image:</td><td><img width="200px" height="150px" src="../user_image/<?php echo htmlentities($user["userImage"]); ?>" ></td></tr>
 
  </table>

  <?php }   ?>



