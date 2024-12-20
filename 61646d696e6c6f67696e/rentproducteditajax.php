<?php
include('lcheck.php');
if($addconsignee=='0')
{
//header("Location: dashboard.php"); 
}
$data = array();
if(isset($_POST['prproductid']))
{

$id=mysqli_real_escape_string($connection, $_POST['prproductid']);
$productid=mysqli_real_escape_string($connection, $_POST['prproductid']);
$type=mysqli_real_escape_string($connection, ((isset($_POST['prtype']))?$_POST['prtype']:'0'));
$sku=mysqli_real_escape_string($connection, $_POST['prsku']);
$unit=mysqli_real_escape_string($connection, $_POST['prunit']);
$hsncode=mysqli_real_escape_string($connection, $_POST['prhsncode']);
$taxpreference=mysqli_real_escape_string($connection, $_POST['prtaxpreference']);
$gstpercentage=mysqli_real_escape_string($connection, $_POST['prgstpercentage']);
$gst=mysqli_real_escape_string($connection, $_POST['prgstpercentage']);
$igstpercentage=mysqli_real_escape_string($connection, $_POST['prigstpercentage']);
$exemption=mysqli_real_escape_string($connection, $_POST['prexemption']);
$stockmaincategory=mysqli_real_escape_string($connection, $_POST['prstockmaincategory']);
$stocksubcategory=mysqli_real_escape_string($connection, $_POST['prstocksubcategory']);
$stockitem=mysqli_real_escape_string($connection, $_POST['prstockitem']);
$typeofproduct=mysqli_real_escape_string($connection, $_POST['prtypeofproduct']);
$componenttype=mysqli_real_escape_string($connection, $_POST['prcomponenttype']);
$componentname=mysqli_real_escape_string($connection, $_POST['prcomponentname']);
$make=mysqli_real_escape_string($connection, $_POST['prmake']);
$capacity=mysqli_real_escape_string($connection, $_POST['prcapacity']);
if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
{
$address1=jbsencrypt($_SESSION['encpass'], $address1);
$phone=jbsencrypt($_SESSION['encpass'], $phone);
$mobile=jbsencrypt($_SESSION['encpass'], $mobile);
$email=jbsencrypt($_SESSION['encpass'], $email);
}
}
if(($stockitem!=""))
{
$sqlcon = "SELECT id From jrcproduct WHERE id = '{$id}'";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountcon > 0)
{
$sqlup = "update jrcproduct set type='$type', sku='$sku', unit='$unit', hsncode='$hsncode', taxpreference='$taxpreference', gstpercentage='$gstpercentage', gst='$gst', igstpercentage='$igstpercentage', exemption='$exemption',stockmaincategory='$stockmaincategory', stocksubcategory='$stocksubcategory', stockitem='$stockitem', typeofproduct='$typeofproduct', componenttype='$componenttype', componentname='$componentname', make='$make', capacity='$capacity' where id='$id'";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Product Information', '{$id}', 'jrcproduct')");
$sqlup1 = "update jrcxl set type='$type', sku='$sku', unit='$unit', hsncode='$hsncode', taxpreference='$taxpreference', gstpercentage='$gstpercentage', exemption='$exemption',stockmaincategory='$stockmaincategory', stocksubcategory='$stocksubcategory', stockitem='$stockitem', typeofproduct='$typeofproduct', componenttype='$componenttype', componentname='$componentname', make='$make', capacity='$capacity' where productid='$id'";
$queryup1 = mysqli_query($connection, $sqlup1);
if(!$queryup1){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
$fetchData = mysqli_query($connection,"select * from jrcproduct where  id='".$id."' order by stockitem limit 200");
while ($row = mysqli_fetch_array($fetchData)) {
$productid = $row['id'];
if($row['stockmaincategory']!='')
{
$stockmaincategory = $row['stockmaincategory'];
}
else
{
$stockmaincategory = "";
}
if($row['stocksubcategory']!='')
{
$stocksubcategory = $row['stocksubcategory'];
}
else
{
$stocksubcategory = "";
}
if($row['stockitem']!='')
{
$stockitem = $row['stockitem'];
}
else
{
$stockitem = "";
}
if($row['typeofproduct']!='')
{
$typeofproduct = $row['typeofproduct'];
}
else
{
$typeofproduct = "";
}
if($row['componenttype']!='')
{
$componenttype = $row['componenttype'];
}
else
{
$componenttype = "";
}
if($row['componentname']!='')
{
$componentname = $row['componentname'];
}
else
{
$componentname = "";
}
if($row['make']!='')
{
$make = $row['make'];
}
else
{
$make = "";
}
if($row['capacity']!='')
{
$capacity = $row['capacity'];
}
else
{
$capacity = "";
}
if($row['warranty']!='')
{
$warranty = $row['warranty'];
}
else
{
$warranty = "";
}
if($row['description']!='')
{
$description = $row['description'];
}
else
{
$description = "";
}
if($row['rentalvalue']!='')
{
$rentalvalue = $row['rentalvalue'];
}
else
{
$rentalvalue = "";
}
if($row['rentalminvalue']!='')
{
$rentalminvalue = $row['rentalminvalue'];
}
else
{
$rentalminvalue = "";
}
if($row['rentalgst']!='')
{
$rentalgst = $row['rentalgst'];
}
else
{
$rentalgst = "";
}
if($row['currentstock']!='')
{
$currentstock = $row['currentstock'];
}
else
{
$currentstock = "";
}
if($row['type']!='')
{
$type = $row['type'];
}
else
{
$type = "";
}
if($row['sku']!='')
{
$sku = $row['sku'];
}
else
{
$sku = "";
}
if($row['unit']!='')
{
$unit = $row['unit'];
}
else
{
$unit = "";
}
if($row['hsncode']!='')
{
$hsncode = $row['hsncode'];
}
else
{
$hsncode = "";
}
if($row['taxpreference']!='')
{
$taxpreference = $row['taxpreference'];
}
else
{
$taxpreference = "";
}
if($row['gstpercentage']!='')
{
$gstpercentage = $row['gstpercentage'];
}
else
{
$gstpercentage = "";
}
if($row['igstpercentage']!='')
{
$igstpercentage = $row['igstpercentage'];
}
else
{
$igstpercentage = "";
}
$curr=array();
$sqlist=mysqli_query($connection, "select id, godownname from jrcgodown where godowntype='Rental'");
while($infost=mysqli_fetch_array($sqlist))
{
	$sqlist1=mysqli_query($connection, "select availablestock from jrcproductstock where godownid='".$infost['id']."' and productid='".$row['id']."'");
	if(mysqli_num_rows($sqlist1)>0)
	{		
	$infost1=mysqli_fetch_array($sqlist1);
	$av=(float)$infost1['availablestock'];
	}
	else
	{
		$av=0;
	}
	
	$curr[] = array("id"=>$infost['id'], "godownname"=>$infost['godownname'], "availablestock"=>$av);
}
$data[] = array("id"=>$row['id'], "text"=>$row['stockitem'], "rentalgst" => $rentalgst, "productid" => $productid, "stockitem" => $stockitem, "stockmaincategory" => $stockmaincategory, "stocksubcategory" => $stocksubcategory, "stockitem" => $stockitem, "typeofproduct" => $typeofproduct, "componenttype" => $componenttype, "componentname" => $componentname, "make" => $make, "capacity" => $capacity, "warranty" => $warranty, "description" => $description, "rentalminvalue" => $rentalminvalue, "rentalvalue" => $rentalvalue, "currentstock" => $currentstock, "type" => $type, "sku" => $sku, "unit" => $unit, "hsncode" => $hsncode, "taxpreference" => $taxpreference, "gstpercentage" => $gstpercentage, "igstpercentage" => $igstpercentage, "availablestock" => $curr);
}
//header("Location: product.php?remarks=Updated Successfully");
}
}
}
else
{
//header("Location: product.php?error=This record is Not Found! Kindly check in All Product List");
}
}
else
{
//header("Location: product.php?error=Error Data");
}
}
else
{
////header("Location: product.php?error=Error Data");
}
echo json_encode($data);
?>