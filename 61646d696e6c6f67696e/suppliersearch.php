<?php
include('lcheck.php');
function get_supplier($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcsuppliers WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getsupplier = get_supplier($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $supplierList = array();
 foreach($getsupplier as $supplier){
 $supplierList[] = $supplier[$type];
 }
 echo json_encode($supplierList);
}
?>