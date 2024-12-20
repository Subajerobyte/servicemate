<?php
include('lcheck.php');
function get_gstpercentage($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcgstpercentage WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getgstpercentage = get_gstpercentage($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $gstpercentageList = array();
 foreach($getgstpercentage as $gstpercentage){
 $gstpercentageList[] = $gstpercentage[$type];
 }
 echo json_encode($gstpercentageList);
}
?>