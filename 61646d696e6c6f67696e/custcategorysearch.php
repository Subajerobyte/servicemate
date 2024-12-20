<?php
include('lcheck.php');
function get_custcategory($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrccustcategory WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getcustcategory = get_custcategory($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $custcategoryList = array();
 foreach($getcustcategory as $custcategory){
 $custcategoryList[] = $custcategory[$type];
 }
 echo json_encode($custcategoryList);
}
?>