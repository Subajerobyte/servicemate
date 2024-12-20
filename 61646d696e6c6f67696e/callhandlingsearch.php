<?php
include('lcheck.php');
function get_callhandlingname($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrccallhandling WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
 while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getcallhandlingname = get_callhandlingname($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $callhandlingnameList = array();
 foreach($getcallhandlingname as $callhandlingname){
 $callhandlingnameList[] = $callhandlingname[$type];
 }
 echo json_encode($callhandlingnameList);
}
?>