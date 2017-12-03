<?php
class POSController extends MyPOSDB{

	function getData($query) {
		$result = mysql_query($query);
		while($row=mysql_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}	

	function getRowNumber($query) {
		$result = mysql_query($query);
		$rows=mysql_num_rows($result);
		return $rows;
	}

	function insertData($query) {
		$result = mysql_query($query);
		if($result)
			return true;
	}


	function deleteData($query) {
		$result = mysql_query($query);
		if($result)
			return true;
	}


	function UpdateData($query) {
		$result = mysql_query($query);
		if($result)
			return true;
	}

}
	?>