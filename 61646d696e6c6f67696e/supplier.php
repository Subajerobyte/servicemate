<?php
include('lcheck.php');
function get_suppliername($connection , $term){ 
 $query = "SELECT address, id FROM jrcsuppliers WHERE LOWER(address) LIKE LOWER('%".$term."%') and enabled='0' group by address ORDER BY address ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getsuppliername = get_suppliername($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $suppliernameList = array();
 foreach($getsuppliername as $suppliername){
 $data['id'] = $suppliername['id'];
  $data['value'] = $suppliername['address'];
        array_push($suppliernameList, $data);
 }
 echo json_encode($suppliernameList);
}
?>