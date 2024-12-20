<?php
include('lcheck.php');
function get_ctype($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcctype WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getctype = get_ctype($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $ctypeList = array();
 foreach($getctype as $ctype){
 $ctypeList[] = $ctype[$type];
 }
 echo json_encode($ctypeList);
}
?>