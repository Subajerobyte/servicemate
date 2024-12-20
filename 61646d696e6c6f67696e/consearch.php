
<?php
include('lcheck.php');
function get_maincategory($connection , $term, $encsystem, $encpass){ 
$terms=explode(' ',$term);
$q="";
if(($encsystem=='1')||($encsystem=='2'))
{
	if((isset($encpass))&&($encpass!=""))
	{
		foreach($terms as $t)
		{
			if($q=="")
			{
				$q.="((LOWER(maincategory) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(subcategory) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(consigneename) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(department) LIKE LOWER('%".$t."%'))";
				$q.=" or (address1!='')";
				$q.=" or (LOWER(address2) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(area) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(district) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(pincode) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(contact) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(gstno) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(statecode) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(gsttype) LIKE LOWER('%".$t."%'))";
				$q.=" or (phone!='')";
				$q.=" or (mobile!='')";
				$q.=" or (email!=''))";
			}
			else
			{
				$q.=" and ((LOWER(maincategory) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(subcategory) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(consigneename) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(department) LIKE LOWER('%".$t."%'))";
				$q.=" or (address1!='')";
				$q.=" or (LOWER(address2) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(area) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(district) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(pincode) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(gstno) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(statecode) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(gsttype) LIKE LOWER('%".$t."%'))";
				$q.=" or (LOWER(contact) LIKE LOWER('%".$t."%'))";
				$q.=" or (phone!='')";
				$q.=" or (mobile!='')";
				$q.=" or (email!=''))";
			}
		}
	}
}
else
{
	foreach($terms as $t)
	{
		if($q=="")
		{
			$q.="((LOWER(maincategory) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(subcategory) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(consigneename) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(department) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(address1) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(address2) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(area) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(district) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(pincode) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(gstno) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(statecode) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(gsttype) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(contact) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(phone) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(mobile) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(email) LIKE LOWER('%".$t."%')))";
		}
		else
		{
			$q.=" and ((LOWER(maincategory) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(subcategory) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(consigneename) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(department) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(address1) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(address2) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(area) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(district) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(pincode) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(gstno) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(statecode) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(gsttype) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(contact) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(phone) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(mobile) LIKE LOWER('%".$t."%'))";
			$q.=" or (LOWER(email) LIKE LOWER('%".$t."%')))";
		}
	}	
}

if(($encsystem=='1')||($encsystem=='2'))
{
	if((isset($encpass))&&($encpass!=""))
	{
		$a=" and encstatus='1' ";
	}
}
else
{
	$a=" and encstatus='0' ";
}

$query = "SELECT consigneename, id as consigneeid, department, subcategory, maincategory, department, address1, address2, area, pincode, contact, phone, mobile, email, district, gstno, statecode , gsttype FROM jrcconsignee WHERE (".$q.") ".$a." group by consigneename ORDER BY consigneename ASC";
$result = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($result)) 
{ 

if(($encsystem=='1')||($encsystem=='2'))
{
	if((isset($encpass))&&($encpass!=""))
	{
		
		if($row['address1']!='')
		{
		$row['address1']=jbsdecrypt($_SESSION['encpass'], $row['address1']);
		}
		
		if($row['phone']!='')
		{
		$row['phone']=jbsdecrypt($_SESSION['encpass'], $row['phone']);
		}
		if($row['mobile']!='')
		{
		$row['mobile']=jbsdecrypt($_SESSION['encpass'], $row['mobile']);
		}
		if($row['email']!='')
		{
		$row['email']=jbsdecrypt($_SESSION['encpass'], $row['email']);
		}
		foreach($terms as $t)
		{
		if((strpos(strtolower($row['address1']), strtolower($t)) !== false)||(strpos(strtolower($row['phone']), strtolower($t)) !== false)||(strpos(strtolower($row['mobile']), strtolower($t)) !== false)||(strpos(strtolower($row['email']), strtolower($t)) !== false))
		{
		$data[] = $row; 
		}
		}
	}
}
else
{
$data[] = $row; 
}

}
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	if(isset($_SESSION['encpass']))
	{
		$encpass=$_SESSION['encpass'];
	}
	else
	{
		$encpass="";
	}
 $getmaincategory = get_maincategory($connection, mysqli_real_escape_string($connection, $_GET['term']), $infocompany1['encsystem'], $encpass);
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['id'] = $maincategory['consigneeid'];
 $data['consigneeid'] = $maincategory['consigneeid'];
 $data['maincategory'] = $maincategory['maincategory'];
 $data['subcategory'] = $maincategory['subcategory'];
 $data['consigneename'] = $maincategory['consigneename'];
 $data['department'] = $maincategory['department'];
 $data['address1'] = $maincategory['address1'];
 $data['address2'] = $maincategory['address2'];
 $data['area'] = $maincategory['area'];
 $data['district'] = $maincategory['district'];
 $data['gstno'] = $maincategory['gstno'];
 $data['statecode'] = $maincategory['statecode'];
 $data['gsttype'] = $maincategory['gsttype'];
 $data['pincode'] = $maincategory['pincode'];
 $data['contact'] = $maincategory['contact'];
 $data['phone'] = $maincategory['phone'];
 $data['mobile'] = $maincategory['mobile'];
 $data['email'] = $maincategory['email'];
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