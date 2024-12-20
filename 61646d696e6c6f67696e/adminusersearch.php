<?php
include('lcheck.php');
function get_adminusername($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcadminuser WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getadminusername = get_adminusername($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $adminusernameList = array();
 foreach($getadminusername as $adminusername){
 $adminusernameList[] = $adminusername[$type];
 }
 echo json_encode($adminusernameList);
}
?>