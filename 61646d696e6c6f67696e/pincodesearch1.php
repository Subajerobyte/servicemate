<?php
include('lcheck.php');
function get_maincategory($connection , $term){ 
$query = "SELECT * from jrcpincode WHERE LOWER(pincode) LIKE LOWER('%".$term."%') ORDER BY pincode ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['value'] = $maincategory['pincode'];
 //$data['id'] = $maincategory['id'];
 
 $data['pincode'] = $maincategory['pincode'];
 $data['taluk'] = $maincategory['taluk'];
 $data['district'] = $maincategory['district'];
 
        array_push($maincategoryList, $data);
 }
 $maincategoryList = array_map("unserialize", array_unique(array_map("serialize", $maincategoryList)));
 echo json_encode($maincategoryList);
}

?>


