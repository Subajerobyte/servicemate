<?php
include('lcheck.php');
if($sellprice=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	if(isset($_POST['id']))  
	{
	$changedon=date('Y-m-d H:i:s');
	$id=mysqli_real_escape_string($connection, $_POST['id']);
	
$typevalue=mysqli_real_escape_string($connection, ((isset($_POST['type']))?$_POST['type']:'Goods'));
$code=mysqli_real_escape_string($connection, $_POST['code']);
$sku=mysqli_real_escape_string($connection, $_POST['sku']);
$unit=mysqli_real_escape_string($connection, $_POST['unit']);
$unitqty=mysqli_real_escape_string($connection, $_POST['unitqty']);
$hsncode=mysqli_real_escape_string($connection, $_POST['hsncode']);
$hsntype=mysqli_real_escape_string($connection, $_POST['hsntype']);
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


	$stockmaincategory=mysqli_real_escape_string($connection, $_POST['stockmaincategory']);
	$stocksubcategory=mysqli_real_escape_string($connection, $_POST['stocksubcategory']);
	$stockitem=mysqli_real_escape_string($connection, $_POST['stockitem']);
	$typeofproduct=mysqli_real_escape_string($connection, $_POST['typeofproduct']);
	$componenttype=mysqli_real_escape_string($connection, $_POST['componenttype']);
	$componentname=mysqli_real_escape_string($connection, $_POST['componentname']);
	$make=mysqli_real_escape_string($connection, $_POST['make']);
	$capacity=mysqli_real_escape_string($connection, $_POST['capacity']);
	$description=mysqli_real_escape_string($connection, $_POST['description']);	
	$price=mysqli_real_escape_string($connection, $_POST['price']);
	$minprice=mysqli_real_escape_string($connection, $_POST['minprice']);
	//$gst=mysqli_real_escape_string($connection, $_POST['gst']);
	$warranty=mysqli_real_escape_string($connection, $_POST['warranty']);
	$warrantycycle=mysqli_real_escape_string($connection, $_POST['warrantycycle']);
	$productlifetime=mysqli_real_escape_string($connection, $_POST['productlifetime']);
	$scrapvalue=mysqli_real_escape_string($connection, $_POST['scrapvalue']);
	$amcvalue=mysqli_real_escape_string($connection, $_POST['amcvalue']);
	$amcminvalue=mysqli_real_escape_string($connection, $_POST['amcminvalue']);
	$amcgst=mysqli_real_escape_string($connection, $_POST['amcgst']);
	$camcvalue=mysqli_real_escape_string($connection, $_POST['camcvalue']);
	$camcminvalue=mysqli_real_escape_string($connection, $_POST['camcminvalue']);
	$camcgst=mysqli_real_escape_string($connection, $_POST['camcgst']);
	$rentalvalue=mysqli_real_escape_string($connection, $_POST['rentalvalue']);
	$rentalminvalue=mysqli_real_escape_string($connection, $_POST['rentalminvalue']);
	$rentalgst=mysqli_real_escape_string($connection, $_POST['rentalgst']);
	$installvalue=mysqli_real_escape_string($connection, $_POST['installvalue']);
	$gsttype=mysqli_real_escape_string($connection, $_POST['gsttype']);
	$msg = "";
  	$msg_class = "";
	if(($stockitem!=""))
	{		 
		 
        $sqlcon = "SELECT id From jrcproduct WHERE stockmaincategory = '{$stockmaincategoryvalue}' and stocksubcategory = '{$stocksubcategoryvalue}' and stockitem = '{$stockitemvalue}' and typeofproduct = '{$typeofproductvalue}' and componenttype = '{$componenttypevalue}' and componentname = '{$componentnamevalue}' and make = '{$makevalue}' and capacity = '{$capacityvalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			  
			/* 
$stockmaincategory,$stocksubcategory,$stockitem,$typeofproduct,$componenttype,$componentname,$make,$capacity,$description,$price,$minprice,$gst,$warranty,$warrantycycle,$productlifetime,$scrapvalue,$amcvalue,$amcminvalue,$amcgst,$camcvalue,$camcminvalue,$camcgst,$rentalvalue,$rentalminvalue,$rentalgst,$installvalue,$gsttype		 */		
					$sqlupi = "INSERT INTO jrcproduct( type,sku,code,unit,unitqty,hsncode,hsntype,taxpreference,gstpercentage, gst, exemption,stockmaincategory, stocksubcategory, stockitem, typeofproduct, componenttype, componentname, make, capacity, igstpercentage,marketname,description,price,minprice,warranty,warrantycycle,productlifetime,scrapvalue,amcvalue,amcminvalue,amcgst,camcvalue,camcminvalue,camcgst,rentalvalue,rentalminvalue,rentalgst,installvalue,gsttype) VALUES ( '$typevalue', '$sku','$code', '$unit', '$unitqty', '$hsncode', '$hsntype', '$taxpreference', '$gstpercentage', '$gst', '$exemption','$stockmaincategoryvalue', '$stocksubcategoryvalue', '$stockitemvalue', '$typeofproductvalue', '$componenttypevalue', '$componentnamevalue', '$makevalue', '$capacityvalue', '$igstpercentage','$marketnamevalue','$descriptionvalue', '$price', '$minprice', '$warranty', '$warrantycycle', '$productlifetime', '$scrapvalue', '$amcvalue', '$amcminvalue', '$amcgst', '$camcvalue', '$camcminvalue', '$camcgst', '$rentalvalue', '$rentalminvalue', '$rentalgst', '$installvalue', '$gsttype')";
			$queryupi = mysqli_query($connection, $sqlupi);
			 
			if(!$queryupi){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert Reported Problem Information', '{$id}', 'jrcproduct')");
				header("Location: saleproduct.php?remarks=Insert Successfully");
			} 
			}
			else
			{
			header("Location: saleproduct.php?error=This record is Already Found! Kindly check in All Product List");
			}
			}
			else
			{
				header("Location: saleproduct.php?error=Error Data");
			}
			}
			else
			{
				header("Location: saleproduct.php?error=Error Data");
			}
}
else
			{
				header("Location: saleproduct.php");
			}
?>