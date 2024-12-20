<?php
include('lcheck.php');
function get_tender($connection , $term){ 
 $query = "SELECT tender, id FROM jrctender WHERE LOWER(tender) LIKE LOWER('%".$term."%') and enabled='0' group by tender ORDER BY tender ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
 $gettender = get_tender($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $tenderList = array();
 foreach($gettender as $tender){
 $data['id'] = $tender['id'];
  $data['value'] = $tender['tender'];
        array_push($tenderList, $data);
 }
 echo json_encode($tenderList);
}
?>