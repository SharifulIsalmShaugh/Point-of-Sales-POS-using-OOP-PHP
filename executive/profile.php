<?php 
require_once 'header_link.php';  
$db_handle = new myFunctions();
$show="";
if(isset($_POST['update_password'])){
  $oldpass = md5(mysql_escape_string($_POST["oldpassword"]));
  $newpassword = mysql_escape_string($_POST["newpassword"]);
  $cpassword = mysql_escape_string($_POST["cpassword"]);

  if($_SESSION['userPassword']==$oldpass){
    if($newpassword==$cpassword){
      $userid = $_SESSION['userid'];
      $password = md5($cpassword);
      $r = $db_handle->changePassword($userid,$password);

      if($r){
        date_default_timezone_set('Asia/Dhaka');
        $date = date("Y-m-d");
        $time = date("h:i:sa");

        $userid = $_SESSION['userid'];
mysql_query("INSERT INTO tbactivity_logs (user_id,activity,date,time) VALUES ('$userid','Password Changed', '$date','$time')");

        $show = "<h3><b style='color:green;'>New Password has been successfully saved </b></h3><span style='font-size:12px'> Please <a href='logout.php'>Logout </a> and login again.......</span><br /><br /><br />";
      }


    }else{
      $show = "<h3><b style='color:red;'>New Password are mismatched !</b></h3>";
    }

  }else{
    $show = "<h3><b style='color:red;'>Old password is incorrect !</b></h3>";
  }


}

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
                    <div class=" collapse">
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
          <div class="span3" id="sidebar">
              <ul class="nav nav-list bs-docs-sidenav  collapse">
                  <li><a></a></li>
  	              <li><a href="dashboard.php"> Dashboard</a></li>
                  <li><a href="sales.php"> Sales</a></li>
                  <li><a href="report.php"> Report</a></li>
                  <li><a href="search_invoice.php"> Search Invoice</a></li>
                  <li class="active"><a href="profile.php"> Profile</a></li>
                  <li><a href="logout.php"> Log Out</a></li>
                  <li><a></a></li>
  	       </ul>
          </div>
          <div class="span9" id="content">
            <div class="row-fluid">
                <!-- block -->
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left" >Profile</div>
                    </div>
                    <div class="block-content collapse in">

                    <?php echo $show; ?>
                       
			               <table>
                        <tr>
                          <td><a rel="facebox" href="change_password.php">Change Password</a></td>
                        </tr>

                     </table>



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