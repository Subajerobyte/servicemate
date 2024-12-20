<?php
include('lcheck.php');
function get_maincategory($connection , $term){ 
 $query = "SELECT problemobserved, id FROM jrcproblemobserved WHERE LOWER(problemobserved) LIKE LOWER('%".$term."%') and enabled='0' group by problemobserved ORDER BY problemobserved ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['id'] = $maincategory['id'];
  $data['value'] = $maincategory['problemobserved'];
        array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>