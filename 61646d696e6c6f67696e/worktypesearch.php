<?php
include('lcheck.php');
function get_worktype($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcworktype WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getworktype = get_worktype($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $worktypeList = array();
 foreach($getworktype as $worktype){
 $worktypeList[] = $worktype[$type];
 }
 echo json_encode($worktypeList);
}
?>