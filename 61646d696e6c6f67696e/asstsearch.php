<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
function get_maincategory($connection , $term){ 
 $query = "SELECT assest, id FROM jrcassest WHERE LOWER(assest) LIKE LOWER('%".$term."%') and enabled='0' group by assest ORDER BY assest ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['id'] = $maincategory['id'];
  $data['value'] = $maincategory['assest'];
        array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>