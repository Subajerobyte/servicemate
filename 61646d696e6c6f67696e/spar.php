<?php
include('lcheck.php');
function get_maincategory($connection , $term){ 
 $query = "SELECT subcategory, id FROM jrcspares WHERE LOWER(subcategory) LIKE LOWER('%".$term."%') and enabled='0' group by subcategory ORDER BY subcategory ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['id'] = $maincategory['id'];
  $data['value'] = $maincategory['subcategory'];
        array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>