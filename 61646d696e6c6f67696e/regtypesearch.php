<?php
include('lcheck.php');
function get_regtype($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcregtype WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getregtype = get_regtype($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $regtypeList = array();
 foreach($getregtype as $regtype){
 $regtypeList[] = $regtype[$type];
 }
 echo json_encode($regtypeList);
}
?>