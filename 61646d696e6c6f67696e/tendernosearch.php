<?php
include('lcheck.php');
function get_tenderno($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrctenderno WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $gettender = get_tender($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $tenderList = array();
 foreach($gettender as $tender){
 $tenderList[] = $tender[$type];
 }
 echo json_encode($tenderList);
}
?>