<?php
include('lcheck.php');
function get_typeofproduct($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcproduct WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $gettypeofproduct = get_typeofproduct($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $typeofproductList = array();
 foreach($gettypeofproduct as $typeofproduct){
 $typeofproductList[] = $typeofproduct[$type];
 }
 echo json_encode($typeofproductList);
}
?>