<?php
include('lcheck.php');
function get_maincategory($connection , $term){ 
$terms=explode(' ',$term);
$q="";
foreach($terms as $t)
{
	if($q=="")
	{
		$q.="((LOWER(maincategory) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(invoiceno) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(invoicedate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(subcategory) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(consigneename) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(department) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(address1) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(address2) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(area) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(district) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(pincode) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(contact) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(phone) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(mobile) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(email) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(stockitem) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(departments) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(serialnumber) LIKE LOWER('%".$t."%')))";
	}
	else
		{
		$q.=" and ((LOWER(maincategory) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(invoiceno) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(invoicedate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(subcategory) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(consigneename) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(department) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(address1) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(address2) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(area) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(district) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(pincode) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(contact) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(phone) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(mobile) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(email) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(stockitem) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(departments) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(serialnumber) LIKE LOWER('%".$t."%')))";
	}
		
}

 $query = "SELECT consigneename, consigneeid, department, subcategory, maincategory FROM jrcxl WHERE tdelete='0' and (".$q.") group by consigneename ORDER BY consigneename ASC";
 $result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['id'] = $maincategory['consigneeid'];
 if($maincategory['consigneename']!="")
 {
  $data['value'] = $maincategory['consigneename'];
 }
 else
 {
	  if($maincategory['department']!="")
 {
  $data['value'] = $maincategory['department'];
 }
 else
 {
	 if($maincategory['subcategory']!="")
 {
  $data['value'] = $maincategory['subcategory'];
 }
 else
 {
	 if($maincategory['maincategory']!="")
 {
  $data['value'] = $maincategory['maincategory'];
 }
 else
 {
	 $data['value'] = mysqli_real_escape_string($connection, $_GET['term']);
 }
 }
 }
 }
        array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>