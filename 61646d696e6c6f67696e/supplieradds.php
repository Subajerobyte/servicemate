<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$suppliername=mysqli_real_escape_string($connection, $_POST['suppliername']);
	$address1=mysqli_real_escape_string($connection, $_POST['address1']);
	$address2=mysqli_real_escape_string($connection, $_POST['address2']);
	$area=mysqli_real_escape_string($connection, $_POST['area']);
	$district=mysqli_real_escape_string($connection, $_POST['district']);
	$pincode=mysqli_real_escape_string($connection, $_POST['pincode']);
	$latlong=mysqli_real_escape_string($connection, $_POST['latlong']);
	$email=mysqli_real_escape_string($connection, $_POST['email']);
	$gstno=mysqli_real_escape_string($connection, $_POST['gstno']);
	$gsttype=mysqli_real_escape_string($connection, $_POST['gsttype']);
	$statecode=mysqli_real_escape_string($connection, $_POST['statecode']);
	$mobile=mysqli_real_escape_string($connection, $_POST['mobile']);
	$contact=mysqli_real_escape_string($connection, $_POST['contact']);
	$phone=mysqli_real_escape_string($connection, $_POST['phone']);
	$ctype=mysqli_real_escape_string($connection, $_POST['ctype']);
	$maincategory=mysqli_real_escape_string($connection, $_POST['maincategory']);
	$subcategory=mysqli_real_escape_string($connection, $_POST['subcategory']);
	$department=mysqli_real_escape_string($connection, $_POST['department']);
		$msg = "";
  $msg_class = "";
	if(($mobile!="")||($suppliername!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcsuppliers WHERE mobile = '{$mobile}' and suppliername = '{$suppliername}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcsuppliers( suppliername, address1, address2, area,district, pincode, latlong, email, gstno,gsttype, statecode, mobile,contact, phone, ctype, maincategory, subcategory, department) VALUES ( '$suppliername', '$address1', '$address2', '$area','$district', '$pincode', '$latlong', '$email', '$gstno', '$gsttype','$statecode', '$mobile','$contact', '$phone', '$ctype', '$maincategory', '$subcategory', '$department')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Supplier', '{$tid}', 'jrcsuppliers')");
				header("Location: suppliers.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: suppliers.php?error=This record is Already Found! Kindly check in All Supplier List");
			}
	}
	else
			{
				header("Location: suppliers.php?error=Error Data");
			}
}
else
			{
				header("Location: suppliers.php");
			}
?>