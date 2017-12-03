<?php 
require_once 'header_link.php';  
$db_handle = new myFunctions();
$date = $_GET['cdate'];
?>
<!DOCTYPE HTML>
<html>
<head>
	<script type="text/javascript">
		window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainer", {
				title: {
					text: "Product Selling Chart"
				},
				data: [{
					type: "bar",
					dataPoints: [
					<?php
					$results = $db_handle->getProductsSaleHistory($date);
					$trow=count($results);
					if($trow>0){
					foreach($results as $invoice) {
					$pid=$invoice["productId"];
					$pname=$invoice["pname"];

					$totp_quantity=0;
					  $results1 = $db_handle->getProductsSaleHistoryTotalQuantity($pid);
					   foreach($results1 as $tot) {
					        $totp_quantity +=$tot["productQtys"];
					   }

						echo '{ y: '.$totp_quantity.', label: "'.$pname.'" },';

					} 
					}else{

						echo '{ y: 0, label: "No Products Available" },';
					}


					?>
					]
				}]
			});
			chart.render();
		}
	</script>
	<script src="canvasjs.min.js"></script>
	<title>Product Selling Chart</title>
    <link href="assets/css/customizedstyle.css" rel="stylesheet" media="screen">

</head>

<body>
	<br />
	<center><a class="btn btn-primary" href="products_sales_date_graph.php"> Search Again</a></center>
	<br />
	<div id="chartContainer" style="height: 450px; width: 100%;"></div>
</body>

</html>