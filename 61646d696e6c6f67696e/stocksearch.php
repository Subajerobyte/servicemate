<?php
include('lcheck.php');
function get_stockmaincategory($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcstock WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getstockmaincategory = get_stockmaincategory($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $stockmaincategoryList = array();
 foreach($getstockmaincategory as $stockmaincategory){
 $stockmaincategoryList[] = $stockmaincategory[$type];
 }
 echo json_encode($stockmaincategoryList);
}
?>