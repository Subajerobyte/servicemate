<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
function get_assest($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcassest WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getassest = get_assest($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $assestList = array();
 foreach($getassest as $assest){
 $assestList[] = $assest[$type];
 }
 echo json_encode($assestList);
}
?>