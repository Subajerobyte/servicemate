<?php
include('lcheck.php');
if($sellprice=='0')
{
	header("Location: dashboard.php");
}
function get_saleproduct($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcproduct WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getsaleproduct = get_saleproduct($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $saleproductList = array();
 foreach($getsaleproduct as $saleproduct){
 $saleproductList[] = $saleproduct[$type];
 }
 echo json_encode($saleproductList);
}
?>