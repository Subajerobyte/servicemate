<?php
include('lcheck.php');
function get_coordinatorname($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrccoordinator WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
 while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getcoordinatorname = get_coordinatorname($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $coordinatornameList = array();
 foreach($getcoordinatorname as $coordinatorname){
 $coordinatornameList[] = $coordinatorname[$type];
 }
 echo json_encode($coordinatornameList);
}
?>