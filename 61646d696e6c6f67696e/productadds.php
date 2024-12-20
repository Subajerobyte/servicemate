<?php
include('lcheck.php');
if($uploaddata=='0')
{
header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
$createdon=date("Y-m-d H:i:s");
$createdby=$_SESSION['email'];
$typevalue=mysqli_real_escape_string($connection, ((isset($_POST['type']))?$_POST['type']:'Goods'));
$code=mysqli_real_escape_string($connection, $_POST['code']);
$sku=mysqli_real_escape_string($connection, $_POST['sku']);
$unit=mysqli_real_escape_string($connection, $_POST['unit']);
$hsncode=mysqli_real_escape_string($connection, $_POST['hsncode']);
$taxpreference=mysqli_real_escape_string($connection, $_POST['taxpreference']);
$gstpercentage=mysqli_real_escape_string($connection, $_POST['gstpercentage']);
$gst=mysqli_real_escape_string($connection, $_POST['gstpercentage']);
$igstpercentage=mysqli_real_escape_string($connection, $_POST['igstpercentage']);
$exemption=mysqli_real_escape_string($connection, $_POST['exemption']);
$stockmaincategoryvalue=mysqli_real_escape_string($connection, $_POST['stockmaincategory']);
$stocksubcategoryvalue=mysqli_real_escape_string($connection, $_POST['stocksubcategory']);
$stockitemvalue=mysqli_real_escape_string($connection, $_POST['stockitem']);
$typeofproductvalue=mysqli_real_escape_string($connection, $_POST['typeofproduct']);
$componenttypevalue=mysqli_real_escape_string($connection, $_POST['componenttype']);
$componentnamevalue=mysqli_real_escape_string($connection, $_POST['componentname']);
$makevalue=mysqli_real_escape_string($connection, $_POST['make']);
$capacityvalue=mysqli_real_escape_string($connection, $_POST['capacity']);
$marketnamevalue=mysqli_real_escape_string($connection, $_POST['marketname']);
$descriptionvalue=mysqli_real_escape_string($connection, $_POST['description']);
/*$warrantyvalue=mysqli_real_escape_string($connection, $_POST['warranty']); */

if(($stockitemvalue!=""))
{

$sqlcon = "SELECT id From jrcproduct WHERE stockmaincategory = '{$stockmaincategoryvalue}' and stocksubcategory = '{$stocksubcategoryvalue}' and stockitem = '{$stockitemvalue}' and typeofproduct = '{$typeofproductvalue}' and componenttype = '{$componenttypevalue}' and componentname = '{$componentnamevalue}' and make = '{$makevalue}' and capacity = '{$capacityvalue}'";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);

if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
}

if($rowCountcon == 0)
{

$sqlup = "INSERT INTO jrcproduct( createdby, createdon, type,sku,code,unit,hsncode,taxpreference,gstpercentage, gst, exemption,stockmaincategory, stocksubcategory, stockitem, typeofproduct, componenttype, componentname, make, capacity, igstpercentage,marketname,description) VALUES ( '$createdby', '$createdon', '$typevalue', '$sku','$code', '$unit', '$hsncode', '$taxpreference', '$gstpercentage', '$gst', '$exemption','$stockmaincategoryvalue', '$stocksubcategoryvalue', '$stockitemvalue', '$typeofproductvalue', '$componenttypevalue', '$componentnamevalue', '$makevalue', '$capacityvalue', '$igstpercentage','$marketnamevalue','$descriptionvalue')";
$queryup = mysqli_query($connection, $sqlup);

if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
$tid=mysqli_insert_id($connection);
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Product', '{$tid}', 'jrcproduct')");
header("Location: product.php?remarks=Added Successfully");
}
}
else
{
header("Location: product.php?error=This record is Already Found! Kindly check in All Product List");
}
}
else
{
header("Location: product.php?error=Error Data");
}
}
else
{
header("Location: product.php");
}






?>