<?php
include('lcheck.php');
function get_actiontaken($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcmaterial WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getactiontaken = get_actiontaken($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $actiontakenList = array();
 foreach($getactiontaken as $actiontaken){
 $actiontakenList[] = $actiontaken[$type];
 }
 echo json_encode($actiontakenList);
}
?>