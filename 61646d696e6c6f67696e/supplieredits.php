<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	if(isset($_POST['id']))
	{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
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
		 
        $sqlcon = "SELECT id From jrcsuppliers WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			 $sqlup = "update jrcsuppliers set suppliername='$suppliername', address1='$address1', address2='$address2', area='$area',district='$district', pincode='$pincode', latlong='$latlong', email='$email', gstno='$gstno', gsttype='$gsttype', statecode='$statecode', mobile='$mobile' ,contact='$contact', phone='$phone', ctype='$ctype', maincategory='$maincategory', subcategory='$subcategory', department='$department' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Supplier Information', '{$id}', 'jrcsuppliers')");
				header("Location: suppliers.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: suppliers.php?error=This record is Not Found! Kindly check in All Supplier List");
			}
	}
	else
			{
				header("Location: suppliers.php?error=Error Data");
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