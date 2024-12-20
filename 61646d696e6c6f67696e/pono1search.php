<?php
include('lcheck.php');
function get_maincategory($connection , $term){ 
$query = "SELECT pono, SUM(grandtotal) AS totalAmount from jrctally WHERE LOWER(pono) LIKE LOWER('%".$term."%') ORDER BY pono ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['value'] = $maincategory['pono'];
 //$data['id'] = $maincategory['id'];
 
 $data['pono'] = $maincategory['pono'];
 $data['totalamount'] = $maincategory['totalAmount'];
 
  $sqlselect = "SELECT SUM(payamount) AS payamounts From jrcsalespayment where pono='".$data['pono']."' order by pono asc";		  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountselect > 0) 
		{
			$rowselect = mysqli_fetch_array($queryselect); 
			$balanceamount=$data['totalamount']-$rowselect['payamounts'];
			$data['balanceamount'] = $balanceamount;
		}
  
        array_push($maincategoryList, $data);
 }
 $maincategoryList = array_map("unserialize", array_unique(array_map("serialize", $maincategoryList)));
 echo json_encode($maincategoryList);
}

?>


