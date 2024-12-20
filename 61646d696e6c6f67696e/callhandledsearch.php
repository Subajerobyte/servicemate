<?php
include('lcheck.php');
function get_maincategory($connection , $term){ 
 $query = "SELECT consigneename, consigneeid FROM jrcxl WHERE tdelete='0' and ((LOWER(consigneename) LIKE LOWER('%".$term."%')) or (LOWER(invoiceno) LIKE LOWER('%".$term."%')) or (LOWER(invoicedate) LIKE LOWER('%".$term."%')) or (LOWER(department) LIKE LOWER('%".$term."%')) or (LOWER(address1) LIKE LOWER('%".$term."%')) or (LOWER(area) LIKE LOWER('%".$term."%'))  or (LOWER(pincode) LIKE LOWER('%".$term."%'))  or (LOWER(contact) LIKE LOWER('%".$term."%'))  or (LOWER(phone) LIKE LOWER('%".$term."%')) or (LOWER(mobile) LIKE LOWER('%".$term."%'))  or (LOWER(email) LIKE LOWER('%".$term."%')) or (LOWER(serialnumber) LIKE LOWER('%".$term."%'))) group by consigneename ORDER BY consigneename ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['id'] = $maincategory['consigneeid'];
  $data['value'] = $maincategory['consigneename'];
        array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>