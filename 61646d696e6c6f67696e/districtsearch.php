<?php
include('lcheck.php');
function get_district($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcdistrict WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getdistrict = get_district($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $districtList = array();
 foreach($getdistrict as $district){
 $districtList[] = $district[$type];
 }
 echo json_encode($districtList);
}
?>