<?php
include('lcheck.php');

function get_maincategory($connection , $term){ 
$data=array();
$query = "SELECT * from jrctally WHERE pono='".$term."' ORDER BY pono ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['value'] = $maincategory['pono'];
 $data['id'] = $maincategory['id'];
 
 $data['pono'] = $maincategory['pono'];

        array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>