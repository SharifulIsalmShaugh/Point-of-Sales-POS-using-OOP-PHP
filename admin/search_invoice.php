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
                        <li class="active"><a href="manage_report.php"> Manage Report</a></li>
                        <li><a href="manage_references.php"> Raferences</a></li>
                        <li><a href="notification.php"> Notification <span class="badge"><?php echo $db_handle->getNotificationsNum();?></span></a></li>
                        <li><a href="others.php"> Others</a></li>
                        <li><a href="logout.php"> Log Out</a></li>
                        <li><a></a></li>
          </ul>
                </div>
          
          <div class="span9" id="content"  style="margin-top: 10px;" >
              <div class="row-fluid">
                      <div class="span12">
                             <table class="table-stripted table-hover" style="margin-top:05px;"  align="center">
                               <form action="" method="GET">
                                   <tr style="font-size:15px;">
                                      <td><b>Invoice Number: </b></td>
                                     <td>
                                        <input name="invoice_number" required autofocus type="text"  placeholder="Insert Invoice Number" style="margin-top:10px;" >
                                     </td>
                                     <td>
                                        <input name="search" class="btn btn-primary" type="submit" value="Search Invoice" >
                                     </td>
                                   </tr> 
                                  </form>
                              </table>
                              <hr>
                      </div>
                  </div>

               <?php 
                  if(isset($_GET['search'])){
                  $invoice_number = $_GET['invoice_number'];
                   $results = $db_handle->getSalesProducts($invoice_number);
                  if(!isset($results))
                  {
                    echo "<h4 style='margin-left: 30px;' >Invoice Number: <b>".$invoice_number."</b></h4>";
                    echo "<h2 style='color:;margin-top:80px;'>Sorry, Invoice does not found</h2>";
                  }else{ 
                    $results1 = $db_handle->getInvoiceDetails($invoice_number);
                    foreach($results1 as $InvoiceDetails) {
                ?>
                
              <div class="row-fluid" >
                  <div class="span11" align="center" style="margin-top: -20px;" >
                  <a target="_BLANK" href="save_invoice_as_pdf.php?id=<?php echo $invoice_number; ?>">Save as PDF</a>
                    <?php echo invoiceHeader(); ?>
                  </div>
              </div>

                  <div class="row-fluid"  style="margin-left: 30px;">
                      <div class="span7" align="left">
                            <?php 
                                  echo "<h5 >Invoice Number: <b>".$invoice_number."</b></h5>";
                                  echo "Customer Name &nbsp;&nbsp;&nbsp;&nbsp;: <b>".$InvoiceDetails["customerName"]."</b><br/>";
                                  echo "Customer Phone &nbsp;&nbsp;&nbsp;: <b>".$InvoiceDetails["customerPhone"]."</b><br/>";
                                   }
                              ?> 
                      </div>
                      <div  class="span4" align="" style="margin-top:35px;" >
                        <?php 
                            echo "Customer Address : <b>".$InvoiceDetails["customerAddress"]."</b><br/>";
                            echo "Date & Time: <b>".$InvoiceDetails["invoiceDate"]." ".$InvoiceDetails["invoiceTime"]."</b>";
                            $ten_amount = $InvoiceDetails["tenderedAmount"];
                              
                        ?>
                      </div>
                  </div>

                  <div class="row-fluid"  style="margin-left: 30px;">
                    <div class="span12">
                      <table  style="margin-top:15px;"  align="center"class="table table-bordered table-stripted table-hover">
                        <thead style="font-size:15px;color:black;">
                              <th width="3%">SN</th>
                              <th width="35%">Product Name <br></th>
                              <th width="4%">Quantity <br></th>
                              <th width="12%">Rate <span style="font-size:11px;">(inc. Vat & Discount)</span></th>
                              <th  width="8%">Sub-Total <br></th>
                         </thead>
                          <?php
                          $i=0;
                          $gt =0;
                          $trow=count($results);
                          if($trow>0){
                           
                           foreach($results as $product) {
                          ?>
                         <tr>
                              <td><?php echo ++$i; ?></td>
                              <td><b><?php echo htmlentities($product["pname"]); ?></b><br>
                              <span style="font-size:11px;"><?php echo htmlentities($product["description"]); ?></span>

                              </td>
                              <td><?php echo htmlentities($product["productQtys"])." ".htmlentities($product["unitName"]); ?> </td>
                              <td><?php echo htmlentities($product["productPriceRate"]); ?> Taka</td>
                               <td><?php echo htmlentities(($product["productPriceRate"])*($product["productQtys"])); ?> Taka</td>
                              
                         </tr>

                         <?php 
                          $gt = $gt + (($product["productPriceRate"])*($product["productQtys"]));
                           
                          } 
                         }else{
                            echo "<tr><td colspan='6' > <center>No Products are in Chart</center></td></tr>";
                          } 
                          ?> 
                          <tr>
                              <th colspan="3"></th>
                              <th colspan="" >Total </th>
                              <th  colspan="" style="font-size:15px;"><?php echo $gt;?> Taka</th>
                         </tr>
                         <tr>
                              <th colspan="3"></th>
                              <th colspan="" >Tendered Amount </th>
                              <th  colspan="" style="font-size:15px;"><?php echo $ten_amount;?> Taka</th>
                         </tr>
                         <tr>
                              <th colspan="3"></th>
                              <th colspan="" >Changed Amount </th>
                              <th  colspan="" style="font-size:15px;"><?php echo ($ten_amount-$gt);?> Taka</th>
                         </tr>
                      </table>
                     <?php 
                        } 
                        } 
                      ?>
                  </div>         
                </div>
          </div>
    </div>
  </div>
    <hr>
    <footer>

        <?php
             developer();
        ?>

    </footer>
  <!--/.fluid-container-->
  <script src="assets/js/jquery-1.9.1.min.js"></script>
  <script src="assets/js/scripts.js"></script>
</body>
</html>