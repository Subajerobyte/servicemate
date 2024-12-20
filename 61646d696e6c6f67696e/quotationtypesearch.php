<?php
include('lcheck.php'); 
function get_quotationtype($connection , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM jrcquotationtype WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($connection,$_GET['type']);
 $getquotationtype = get_quotationtype($connection, mysqli_real_escape_string($connection, $_GET['term']), mysqli_real_escape_string($connection,$_GET['type']));
 $quotationtypeList = array();
 foreach($getquotationtype as $quotationtype){
 $quotationtypeList[] = $quotationtype[$type];
 }
 echo json_encode($quotationtypeList);
}
?>