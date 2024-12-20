<?php
include('lcheck.php');
function get_state($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcplace WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getstate = get_state($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $stateList = array();
 foreach($getstate as $state){
 $stateList[] = $state[$type];
 }
 echo json_encode($stateList);
}
?>