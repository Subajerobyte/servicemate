<?php
include('lcheck.php');
function get_engineername($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcengineer WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getengineername = get_engineername($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $engineernameList = array();
 foreach($getengineername as $engineername){
 $engineernameList[] = $engineername[$type];
 }
 echo json_encode($engineernameList);
}
?>