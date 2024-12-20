<?php
include('lcheck.php');
function get_salesrepname($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcsalesrep WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getsalesrepname = get_salesrepname($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $salesrepnameList = array();
 foreach($getsalesrepname as $salesrepname){
 $salesrepnameList[] = $salesrepname[$type];
 }
 echo json_encode($salesrepnameList);
}
?>