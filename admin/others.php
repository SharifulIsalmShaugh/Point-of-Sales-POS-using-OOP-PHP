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
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                       
                        <li><a></a></li>
					    <li><a href="dashboard.php"> Dashboard</a></li>
                        <li><a href="manage_products.php"> Manage Product</a></li>
                        <li><a href="manage_users.php"> Manage User</a></li>
                        <li><a href="manage_report.php"> Manage Report</a></li>
                        <li><a href="manage_references.php"> Raferences</a></li>
                        <li><a href="notification.php"> Notification <span class="badge"><?php echo $db_handle->getNotificationsNum();?></span></a></li>
                        <li class="active"><a href="others.php"> Others</a></li>
                        <li><a href="logout.php"> Log Out</a></li>
                        <li><a></a></li>


					</ul>
                </div>
                
                <div class="span9" id="content">
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left" >Activity Logs</div>
                            </div>
                            <div class="block-content collapse in">

                            <?php if(!isset($_POST['show'])){ ?>
                               <form action="" method="POST">
                                <center>
                                    <Select required style="margin-top:10px;" name="ex_id" >
                                        <option value="">Select Executive</option>
                                        <?php
                                        $results = $db_handle->getUsersList();
                                        foreach($results as $user) {
                                        ?>
                                            <option value="<?php echo $user['userid']; ?>"><?php echo $user['userFullName']; ?></option>
                                        <?php } ?>
                                    </Select>  

                                    <Select required style="margin-top:10px;" name="activity" >
                                        <option value=" ">All Activity</option>
                                        <option value="log">Log In/Out</option>
                                        <option value="password">Password Change</option>
                                       

                                    </Select> 

                                     <select required  style="margin-top:10px;" name="num_rows">
                                           <option value="">Numbers of Row</option>
                                           <option value="20">20 rows</option>
                                           <option value="30">30 rows</option>
                                           <option value="50">50 rows</option>
                                           <option value="100">100 rows</option>
                                           <option value="200">200 rows</option>
                                       </select>

                                       <input type="submit" name="show" value="Show" class="btn btn-primary">
                                </center>

                               </form>

                               <?php }else{
                                
                                  $results = $db_handle->getActivityLogs($_POST['ex_id'],$_POST['activity'],$_POST['num_rows']);

                                ?>
                                <br>
                                 <table style="margin-top:-15px"; class="table table-bordered table-stripted table-hover">
                                      <thead>
                                            <th width="5%">Serial</th>
                                            <th width="25%">Executive Name</th>
                                            <th width="25%">Activity</th>
                                            <th width="12%">Date</th>
                                            <th width="12%">Time</th>
                                       </thead>
                                        <?php
                                        $i=0;
                                        $trow=count($results);
                                        if($trow>0){
                                            foreach($results as $activity) {
                                            ?>
                                             <tr>
                                                <td><?php echo ++$i; ?></td>
                                                <td><?php echo htmlentities($activity["userFullName"]); ?></td>
                                                <td><?php echo htmlentities($activity["activity"]); ?></td>
                                                <td><?php echo htmlentities(date("d-M-Y", strtotime($activity["date"]))); ?></td>
                                                <td><?php echo htmlentities($activity["time"]); ?></td>
                                               
                                            </tr>
                                           <?php 
                                            } 
                                         }else{
                                                echo "<tr><td colspan='7' > <center>No data are found</center></td></tr>";
                                            } 
                                        ?>
                                    </table>
                                <?php }?>					
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