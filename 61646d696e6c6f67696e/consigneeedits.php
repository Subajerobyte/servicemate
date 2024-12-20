<?php
include('lcheck.php');
if($addconsignee=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	if(isset($_POST['id']))
	{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
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
		$gsttype=mysqli_real_escape_string($connection, $_POST['gsttype']);
		$statecode=mysqli_real_escape_string($connection, $_POST['statecode']);
		$gstno=mysqli_real_escape_string($connection, $_POST['gstno']);
		$ctype=mysqli_real_escape_string($connection, $_POST['ctype']);
		
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
		
	if(($maincategoryvalue!="")||($subcategoryvalue!="")||($consigneenamevalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcconsignee WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcconsignee set maincategory='$maincategoryvalue', subcategory='$subcategoryvalue', consigneename='$consigneenamevalue', department='$departmentvalue', address1='$address1value', address2='$address2value', area='$areavalue', district='$districtvalue', pincode='$pincodevalue', contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue', email='$emailvalue', latlong='$latlong', gsttype='$gsttype', statecode='$statecode', gstno='$gstno', ctype='$ctype' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Customer Details', '{$id}', 'jrcconsignee')");
				 
				$sqlup1 = "update jrcxl set maincategory='$maincategoryvalue', subcategory='$subcategoryvalue', consigneename='$consigneenamevalue', department='$departmentvalue', address1='$address1value', address2='$address2value', area='$areavalue', district='$districtvalue', pincode='$pincodevalue', contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue', email='$emailvalue', gstno='$gstno', gsttype='$gsttype', statecode='$statecode' where consigneeid='$id'";
				$queryup1 = mysqli_query($connection, $sqlup1);
				 
				if(!$queryup1){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				else
				{
					header("Location: consigneeview.php?id=".$id."&remarks=Updated Successfully");
				}
			} 
	    }
		else
			{
				header("Location: consignee.php?error=This record is Not Found! Kindly check in All Customer List");
			}
	}
	else
			{
				header("Location: consignee.php?error=Error Data");
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