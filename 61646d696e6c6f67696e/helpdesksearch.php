<?php
include('lcheck.php');
function get_actiontaken($connection1 , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrchelpdesk WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection1, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection1,$_GET['type']);
 $getactiontaken = get_actiontaken($connection1, mysqli_real_escape_string($connection1, $_GET['term']), mysqli_real_escape_string($connection1,$_GET['type']));
 $actiontakenList = array();
 foreach($getactiontaken as $actiontaken){
 $actiontakenList[] = $actiontaken[$type];
 }
 echo json_encode($actiontakenList);
}
?>