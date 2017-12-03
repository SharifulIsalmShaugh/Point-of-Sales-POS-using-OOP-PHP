<?php
    require_once 'config/configure.php';
    require_once("tools/tools.php");
    require_once 'tools/dbclass.php'; 
    require_once("tools/functions.php"); 
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
                    <div class="nav-collapse collapse"></div>
            </div>
        </div>
		</div>
		
		
        
        <div class="container-fluid">
            <div class="row-fluid">
                
                <div class="span3" id="sidebar"></div>
                
                <div class="span6" id="content">
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left" >Login Area</div>
                            </div>
                            <div class="block-content collapse in">

                                <?php 
                                if(isset($_POST['login'])){ 
                                    $username= mysql_escape_string($_POST['username']);
                                    $password= md5(mysql_escape_string($_POST['password']));

                                    $DB = new MyPOSDB();

                                    $result = mysql_query("SELECT * FROM tbusers  INNER JOIN tbusertype ON tbusers.userTypeId=tbusertype.userTypeId  WHERE userName='$username' && userPassword = '$password'");
                                    $r = mysql_num_rows($result);

                                    if($r>0){
                                    while ($row=mysql_fetch_array($result)) {
                                        $type = $row['userType'];
                                        $userid = $row['userid'];
                                        $userFullName = $row['userFullName'];
                                        $userPassword = $row['userPassword'];
                                    }

                                    
                                    if($type=="Admin"){
                                        $_SESSION['AdminAccess']="login_success"; 
                                        $_SESSION['adminFullName']=$userFullName;
                                        $_SESSION['adminid']=$userid;
                                        echo "<script> document.location.href='admin/dashboard.php';</script>";
                                    }
                                    elseif($type=="Executive"){
                                        $_SESSION['ExecutiveAccess']="login_success"; 
                                        $_SESSION['userPassword']=$userPassword;
                                        $_SESSION['userFullName']=$userFullName;
                                        $_SESSION['userid']=$userid;

                                        date_default_timezone_set('Asia/Dhaka');
                                        $date = date("Y-m-d");
                                        $time = date("h:i:sa");

                                        mysql_query("INSERT INTO tbactivity_logs (user_id,activity,date,time) VALUES ('$userid','Log in', '$date','$time')");

                                        echo "<script> document.location.href='executive/dashboard.php';</script>";
                                    }

                                    }else{
                                        echo "<center>";
                                        echo "<h2 style='color:#AE0B0B;'>Invalid Username and Password</h2>";
                                        echo "<br />";
                                        echo "<br />";
                                        echo "<a href='index.php' class='btn btn-primary '>Try Again</a>";
                                        echo "</center>";

                                    }


                                ?>

                               
                               <?php }else{ ?>
                                    <form action="" method="POST">
                                            <table class="table">
                                                <tr>
                                                    <td width="20%">Username:</td>
                                                    <td><input   required autofocus name="username" placeholder="Insert Username Here" class="span10" type="text"  ></td>
                                                </tr>

                                                <tr>
                                                    <td>Password:</td>
                                                    <td><input type="password" required name="password" placeholder="Insert Password Here"  class="span10" ></td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td><input type="submit" name="login" value="Login" class="btn btn-primary" ></td>
                                                </tr>
                                            </table>
                                       </form>
                               <?php  } ?>
								
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