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
$q.=" or (LOWER(invoiceno) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(invoicedate) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(dcno) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(dcdate) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(pono) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(podate) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(subcategory) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(consigneename) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(department) LIKE LOWER('%".$t."%'))";
$q.=" or (address1!='')";
$q.=" or (LOWER(address2) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(area) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(district) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(pincode) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(contact) LIKE LOWER('%".$t."%'))";
$q.=" or (phone!='')";
$q.=" or (mobile!='')";
$q.=" or (email!='')";
$q.=" or (LOWER(stockitem) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(departments) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(serialnumber) LIKE LOWER('%".$t."%')))";
}
else
{
$q.=" and ((LOWER(maincategory) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(invoiceno) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(invoicedate) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(dcno) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(dcdate) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(pono) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(podate) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(subcategory) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(consigneename) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(department) LIKE LOWER('%".$t."%'))";
$q.=" or (address1!='')";
$q.=" or (LOWER(address2) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(area) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(district) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(pincode) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(contact) LIKE LOWER('%".$t."%'))";
$q.=" or (phone!='')";
$q.=" or (mobile!='')";
$q.=" or (email!='')";
$q.=" or (LOWER(stockitem) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(departments) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(serialnumber) LIKE LOWER('%".$t."%')))";
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
$q.=" or (LOWER(invoiceno) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(invoicedate) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(dcno) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(dcdate) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(pono) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(podate) LIKE LOWER('%".$t."%'))";
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
$q.=" or (LOWER(dcno) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(dcdate) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(pono) LIKE LOWER('%".$t."%'))";
$q.=" or (LOWER(podate) LIKE LOWER('%".$t."%'))";
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
$query = "SELECT consigneename, consigneeid, department, address1, address2, contact, phone, mobile, email, subcategory, maincategory FROM jrcxl WHERE tdelete='0' ".$a." and (".$q.") group by consigneename ORDER BY consigneename ASC";
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
if($maincategory['consigneename']!="")
{
	if($maincategory['mobile']!='')
	{
		$data['value'] = $maincategory['consigneename'].'-'.$maincategory['mobile'];
	}
	else{
		$data['value'] = $maincategory['consigneename'];
	}

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