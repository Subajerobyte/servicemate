<?php
include('lcheck.php');
function get_spare($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcspares WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getspare = get_spare($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $spareList = array();
 foreach($getspare as $spare){
 $spareList[] = $spare[$type];
 }
 echo json_encode($spareList);
}
?>