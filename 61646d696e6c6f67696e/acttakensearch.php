<?php
include('lcheck.php');
function get_maincategory($connection , $term){ 
 $query = "SELECT actiontaken, id FROM jrcactiontaken WHERE LOWER(actiontaken) LIKE LOWER('%".$term."%') and enabled='0' group by actiontaken ORDER BY actiontaken ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['id'] = $maincategory['id'];
  $data['value'] = $maincategory['actiontaken'];
        array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>