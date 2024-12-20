<?php
include('lcheck.php');
function get_problemobserved($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcproblemobserved WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getproblemobserved = get_problemobserved($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $problemobservedList = array();
 foreach($getproblemobserved as $problemobserved){
 $problemobservedList[] = $problemobserved[$type];
 }
 echo json_encode($problemobservedList);
}
?>