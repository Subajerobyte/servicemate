<?php
include('lcheck.php');
function get_rype($connection , $term){ 
 $query = "SELECT rype, id FROM jrcregtype WHERE LOWER(rype) LIKE LOWER('%".$term."%') and enabled='0' group by rype ORDER BY rype ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getrype = get_rype($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $rypeList = array();
 foreach($getrype as $rype){
 $data['id'] = $rype['id'];
  $data['value'] = $rype['rype'];
        array_push($rypeList, $data);
 }
 echo json_encode($rypeList);
}
?>