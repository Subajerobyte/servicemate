<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	if(isset($_POST['changeid']))
	{
	$id=mysqli_real_escape_string($connection, $_POST['changeid']);
	 
        $sqlcon = "SELECT maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email  From jrcconsignee WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }	
	$infocon = mysqli_fetch_array($querycon);
	
	$maincategoryvalue=$infocon['maincategory'];
	$subcategoryvalue=$infocon['subcategory'];
		$consigneenamevalue=$infocon['consigneename'];
		$departmentvalue=$infocon['department'];
		$address1value=$infocon['address1'];
		$address2value=$infocon['address2'];
		$areavalue=$infocon['area'];
		$districtvalue=$infocon['district'];
		$pincodevalue=$infocon['pincode'];
		$contactvalue=$infocon['contact'];
		$phonevalue=$infocon['phone'];
		$mobilevalue=$infocon['mobile'];
		$emailvalue=$infocon['email'];
		
	if((isset($_POST['ids']))&&is_array($_POST['ids']))
		{
			for($i=0;$i<count($_POST['ids']);$i++)
			{		
			$ids=mysqli_real_escape_string($connection, $_POST['ids'][$i]);
		 
        $sqlcon = "SELECT id From jrcxl WHERE tdelete='0' and  consigneeid = '{$ids}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
				$sqlup1 = "update jrcxl set maincategory='$maincategoryvalue', subcategory='$subcategoryvalue', consigneename='$consigneenamevalue', department='$departmentvalue', address1='$address1value', address2='$address2value', area='$areavalue', district='$districtvalue', pincode='$pincodevalue', contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue', email='$emailvalue', consigneeid='$id' where consigneeid='$ids'";
				$queryup1 = mysqli_query($connection, $sqlup1);
				 
				if(!$queryup1){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				$sqlup2 = "update jrcamc set consigneeid='$id' where consigneeid='$ids'";
				$queryup2 = mysqli_query($connection, $sqlup2);
				 
				if(!$queryup2){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				$sqlup3 = "update jrccalls set consigneeid='$id' where consigneeid='$ids'";
				$queryup3 = mysqli_query($connection, $sqlup3);
				 
				if(!$queryup3){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				$sqlup4 = "update jrccallshistory set consigneeid='$id' where consigneeid='$ids'";
				$queryup4 = mysqli_query($connection, $sqlup4);
				 
				if(!$queryup4){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				$sqlup5 = "update jrcserials set consigneeid='$id' where consigneeid='$ids'";
				$queryup5 = mysqli_query($connection, $sqlup5);
				 
				if(!$queryup5){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				

	    }
	}
}
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Merge A Customer', '{$id}', 'jrcconsignee')");
				
header("Location: consigneeview.php?id=".$id."&remarks=Added Successfully");
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