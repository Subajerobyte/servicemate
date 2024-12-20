<?php
include('lcheck.php');
if($uploaddata=='0')
{
header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
if(isset($_POST['id']))
{
$id=mysqli_real_escape_string($connection, $_POST['id']);
$createdon=date("Y-m-d H:i:s");
$createdby=$_SESSION['email'];
$typevalue=mysqli_real_escape_string($connection, ((isset($_POST['type']))?$_POST['type']:'0'));
$skuvalue=mysqli_real_escape_string($connection, $_POST['sku']);
$codevalue=mysqli_real_escape_string($connection, $_POST['code']);
$unitvalue=mysqli_real_escape_string($connection, $_POST['unit']);
$unitqty=mysqli_real_escape_string($connection, $_POST['unitqty']);
$hsncodevalue=mysqli_real_escape_string($connection, $_POST['hsncode']);
$taxpreferencevalue=mysqli_real_escape_string($connection, $_POST['taxpreference']);
$gstpercentagevalue=mysqli_real_escape_string($connection, $_POST['gstpercentage']);
$gst=mysqli_real_escape_string($connection, $_POST['gstpercentage']);
$igstpercentagevalue=mysqli_real_escape_string($connection, $_POST['igstpercentage']);
$exemptionvalue=mysqli_real_escape_string($connection, $_POST['exemption']);
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
if(($stockitemvalue!=""))
{
$sqlcon = "SELECT id From jrcproduct WHERE id = '{$id}'";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountcon > 0)
{
$sqlup = "update jrcproduct set createdby='$createdby', createdon='$createdon',type='$typevalue', sku='$skuvalue',code='$codevalue', unit='$unitvalue', unitqty='$unitqty', hsncode='$hsncodevalue', taxpreference='$taxpreferencevalue', gstpercentage='$gstpercentagevalue', gst='$gst', igstpercentage='$igstpercentagevalue', exemption='$exemptionvalue',stockmaincategory='$stockmaincategoryvalue', stocksubcategory='$stocksubcategoryvalue', stockitem='$stockitemvalue', typeofproduct='$typeofproductvalue', componenttype='$componenttypevalue', componentname='$componentnamevalue', make='$makevalue', capacity='$capacityvalue', marketname='$marketnamevalue', description='$descriptionvalue' where id='$id'";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Product Information', '{$id}', 'jrcproduct')");
$sqlup1 = "update jrcxl set type='$typevalue', sku='$skuvalue',code='$codevalue', unit='$unitvalue', unitqty='$unitqty', hsncode='$hsncodevalue', taxpreference='$taxpreferencevalue', gstpercentage='$gstpercentagevalue', exemption='$exemptionvalue',stockmaincategory='$stockmaincategoryvalue', stocksubcategory='$stocksubcategoryvalue', stockitem='$stockitemvalue', typeofproduct='$typeofproductvalue', componenttype='$componenttypevalue', componentname='$componentnamevalue', make='$makevalue', capacity='$capacityvalue' where productid='$id'";
$queryup1 = mysqli_query($connection, $sqlup1);
if(!$queryup1){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
header("Location: product.php?remarks=Updated Successfully");
}
}
}
else
{
header("Location: product.php?error=This record is Not Found! Kindly check in All Product List");
}
}
else
{
header("Location: product.php?error=Error Data");
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