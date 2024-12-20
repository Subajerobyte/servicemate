<?php
include('lcheck.php');
if($_GET['type']=='code')
{
function get_maincategory($connection , $term){ 
$query = "SELECT * FROM jrcproduct WHERE price != '' AND gst != '' AND LOWER(code) LIKE LOWER('%".$term."%') ORDER BY code ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['value'] = $maincategory['code'];
 $data['id'] = $maincategory['id'];
 
 $data['code'] = $maincategory['code'];
 $data['stockitem'] = $maincategory['stockitem'];
 $data['marketname'] = $maincategory['marketname'];
 $data['make'] = $maincategory['make'];
 $data['capacity'] = $maincategory['capacity'];
 $data['unit'] = $maincategory['unit'];
 $data['unitqty'] = $maincategory['unitqty'];
 $data['hsncode'] = $maincategory['hsncode'];
 $data['price'] = $maincategory['price'];
 $data['componenttype'] = $maincategory['componenttype'];
 $data['componentname'] = $maincategory['componentname'];
  $data['stockmaincategory'] = $maincategory['stockmaincategory'];
  $data['hsntype'] = $maincategory['hsntype'];
 $data['stocksubcategory'] = $maincategory['stocksubcategory'];
 $data['typeofproduct'] = $maincategory['typeofproduct'];
 $data['model'] = $maincategory['model'];
  $data['gstpercentage'] = $maincategory['gstpercentage'];
  $data['warranty'] = $maincategory['warranty'];
  $data['gst'] = $maincategory['gst'];
 array_push($maincategoryList, $data);
 }
 $maincategoryList = array_map("unserialize", array_unique(array_map("serialize", $maincategoryList)));
 echo json_encode($maincategoryList);
}
}
if($_GET['type']=='stockitem')
{
function get_maincategory($connection , $term){ 
$query = "SELECT * from jrcproduct WHERE LOWER(stockitem) LIKE LOWER('%".$term."%') ORDER BY stockitem ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['value'] = $maincategory['stockitem'];
 $data['id'] = $maincategory['id'];
 $data['stockitem'] = $maincategory['stockitem'];
 $data['code'] = $maincategory['code'];
 $data['marketname'] = $maincategory['marketname'];
 $data['make'] = $maincategory['make'];
 $data['capacity'] = $maincategory['capacity'];
 $data['unit'] = $maincategory['unit'];
 $data['unitqty'] = $maincategory['unitqty'];
 $data['hsncode'] = $maincategory['hsncode'];
 $data['price'] = $maincategory['price'];
 $data['componenttype'] = $maincategory['componenttype'];
 $data['componentname'] = $maincategory['componentname'];
 $data['stockmaincategory'] = $maincategory['stockmaincategory'];
 $data['hsntype'] = $maincategory['hsntype'];
 $data['stocksubcategory'] = $maincategory['stocksubcategory'];
 $data['typeofproduct'] = $maincategory['typeofproduct'];
 $data['model'] = $maincategory['model'];
 $data['gstpercentage'] = $maincategory['gstpercentage'];
 $data['warranty'] = $maincategory['warranty'];
 $data['gst'] = $maincategory['gst'];
 
 array_push($maincategoryList, $data);
 }
 $maincategoryList = array_map("unserialize", array_unique(array_map("serialize", $maincategoryList)));
 echo json_encode($maincategoryList);
}
}
?>


