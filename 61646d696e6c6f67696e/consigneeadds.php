<?php
include('lcheck.php');
if($addconsignee=='0')
{
header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
$maincategoryvalue=mysqli_real_escape_string($connection, $_POST['maincategory']);
$subcategoryvalue=mysqli_real_escape_string($connection, $_POST['subcategory']);
$consigneenamevalue=mysqli_real_escape_string($connection, $_POST['consigneename']);
$departmentvalue=mysqli_real_escape_string($connection, $_POST['department']);
$address1value=mysqli_real_escape_string($connection, $_POST['address1']);
$address2value=mysqli_real_escape_string($connection, $_POST['address2']);
$areavalue=mysqli_real_escape_string($connection, $_POST['area']);
$districtvalue=mysqli_real_escape_string($connection, $_POST['district']);
$pincodevalue=mysqli_real_escape_string($connection, $_POST['pincode']);
$contactvalue=mysqli_real_escape_string($connection, $_POST['contact']);
$phonevalue=mysqli_real_escape_string($connection, $_POST['phone']);
$mobilevalue=mysqli_real_escape_string($connection, $_POST['mobile']);
$emailvalue=mysqli_real_escape_string($connection, $_POST['email']);
$latlong=mysqli_real_escape_string($connection, $_POST['latlong']);
$gstno=mysqli_real_escape_string($connection, $_POST['gstno']);
$gsttype=mysqli_real_escape_string($connection, $_POST['gsttype']);
$statecode=mysqli_real_escape_string($connection, $_POST['statecode']);
$ctype=mysqli_real_escape_string($connection, $_POST['ctype']);
if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
{
$address1value=jbsencrypt($_SESSION['encpass'], $address1value);
$phonevalue=jbsencrypt($_SESSION['encpass'], $phonevalue);
$mobilevalue=jbsencrypt($_SESSION['encpass'], $mobilevalue);
$emailvalue=jbsencrypt($_SESSION['encpass'], $emailvalue);
}
}
if(($consigneenamevalue!="")&&($consigneenamevalue!="Customer Name(Unique)"))
{
$sqlcon = "SELECT id From jrcconsignee WHERE maincategory = '{$maincategoryvalue}' and subcategory = '{$subcategoryvalue}' and consigneename = '{$consigneenamevalue}' and department = '{$departmentvalue}' ";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountcon == 0)
{
$sqlup = "INSERT INTO jrcconsignee( encstatus, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email, latlong, gsttype, statecode, gstno, ctype) VALUES ( '$encstatus', '$maincategoryvalue', '$subcategoryvalue', '$consigneenamevalue', '$departmentvalue', '$address1value', '$address2value', '$areavalue', '$districtvalue', '$pincodevalue', '$contactvalue', '$phonevalue', '$mobilevalue', '$emailvalue', '$latlong', '$gsttype', '$statecode', '$gstno', '$ctype')";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
$tid=mysqli_insert_id($connection);
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Customer', '{$tid}', 'jrcconsignee')");
header("Location: consigneeview.php?id=".$tid."&remarks=Added Successfully");
}
}
else
{
header("Location: consignee.php?error=This record is Already Found! Kindly check in All Customer List");
}
}
else
{
header("Location: consignee.php?error=Error Data");
}
}
else
{
header("Location: consignee.php");
}
?>