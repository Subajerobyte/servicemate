<?php
include('lcheck.php');
function get_callnature($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcmark WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getcallnature = get_callnature($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $callnatureList = array();
 foreach($getcallnature as $callnature){
 $callnatureList[] = $callnature[$type];
 }
 echo json_encode($callnatureList);
}
?>