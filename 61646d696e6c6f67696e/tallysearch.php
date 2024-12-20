<?php
include('lcheck.php');
function get_maincategory($connection , $term, $type, $table){ 
 $query = "SELECT distinct ".$type." FROM ".$table." WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']), mysqli_real_escape_string($connection,$_GET['table']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $maincategoryList[] = $maincategory[$type];
 }
 echo json_encode($maincategoryList);
}
else
{
	
}
?>