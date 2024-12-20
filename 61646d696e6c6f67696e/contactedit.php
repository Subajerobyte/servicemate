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
		$contactvalue=mysqli_real_escape_string($connection, $_POST['contact']);
		$phonevalue=mysqli_real_escape_string($connection, $_POST['phone']);
		$mobilevalue=mysqli_real_escape_string($connection, $_POST['mobile']);
		$emailvalue=mysqli_real_escape_string($connection, $_POST['email']);
		
		if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{
		
		$phone=jbsencrypt($_SESSION['encpass'], $phone);
		$mobile=jbsencrypt($_SESSION['encpass'], $mobile);
		$email=jbsencrypt($_SESSION['encpass'], $email);
	}
}
		
	if(($contact!="")||($phone!="")||($mobile!="")||($email!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcconsignee WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcconsignee set contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue', email='$emailvalue' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Customer Details', '{$id}', 'jrcconsignee')");
				 
				$sqlup1 = "update jrcxl set  contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue', email='$emailvalue' where consigneeid='$id'";
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