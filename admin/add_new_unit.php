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
                        <li><a href="manage_users.php"> Manage User</a></li>
                        <li><a href="manage_report.php"> Manage Report</a></li>
                        <li class="active"><a href="manage_references.php"> Raferences</a></li>
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
                                <div class="muted pull-left" >Add New Product Unit</div>
                                <div class="pull-right" ><a href="manage_unit.php" style="margin-bottom:8px; margin-top:-5px;" class="btn btn-xs btn-primary">Manage Unit</a></div>
                            </div>
                            <div class="block-content collapse in">
                               
                               <center>
                               <?php if (isset($_POST['save'])) {

                               	$name = mysql_escape_string($_POST['name']);
                               	$r = $db_handle->saveUnit($name);

                               	if($r==1){
                               			echo "<h2 style='color:green;'>Product Unit has been Successfully Inserted</h2>";

                               			echo "<br />";

                               			echo "<a href='add_new_unit.php' style='margin-bottom:8px; margin-top:-5px;'' class='btn btn-xs btn-success'>Add Another Unit</a> &nbsp;&nbsp;";

                               			echo "<a href='manage_unit.php' style='margin-bottom:8px; margin-top:-5px;'' class='btn btn-xs btn-primary'>Manage Unit</a>";
                               	}else{
                               			echo "<h2 style='color:red;'>Insertion Failed</h2>";

                               			echo "<br />";
                               			echo "<br />";

                               			echo "<a href='add_new_unit.php' style='margin-bottom:8px; margin-top:-5px;'' class='btn btn-xs btn-primary'>Try Again</a> &nbsp;&nbsp;";
                               		}

                               }else{ ?>
                                   <form action="" method="POST">
	                                      <table width="450px;">
	                                      	<tr><td>Unit ID:</td><td><input name="id" style=" margin-top:10px;" disabled type="text" placeholder="ID will be generated automatically"></td></tr>
	                                      	
	                                      	<tr> <td> Unit Name:</td><td> <input autofocus name="name"  style=" margin-top:10px;"  required  type="text" placeholder="Insert Unit name"></td></tr>
	                                      	
	                                      	<tr><td></td><td><input  class="btn btn-success" style="margin-top:25px;" name="save" type="submit" value="Save" ></td></tr>
	                                      </table>
	                                        
                                    </form>
                                    <?php } ?>
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
        <!--/.fluid-container-->
        <script src="assets/js/jquery-1.9.1.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>