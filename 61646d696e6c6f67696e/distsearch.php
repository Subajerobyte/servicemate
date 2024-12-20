<?php
include('lcheck.php');
function get_district($connection , $term){ 
 $query = "SELECT district, id FROM jrcdistrict WHERE LOWER(district) LIKE LOWER('%".$term."%') and enabled='0' group by district ORDER BY district ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getdistrict = get_district($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $districtList = array();
 foreach($getdistrict as $district){
 $data['id'] = $district['id'];
  $data['value'] = $district['district'];
        array_push($districtList, $data);
 }
 echo json_encode($districtList);
}
?>