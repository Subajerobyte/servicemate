<?php
include('lcheck.php');
function get_description($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcexpense WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getdescription = get_description($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $descriptionList = array();
 foreach($getdescription as $description){
 $descriptionList[] = $description[$type];
 }
 echo json_encode($descriptionList);
}
?>