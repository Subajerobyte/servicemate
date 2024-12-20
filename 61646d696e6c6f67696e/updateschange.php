<?php
include('lcheck.php');
if($updates=='0')
{
	header("Location: dashboard.php");
}
if (isset($_GET['id'])) {
$id=mysqli_real_escape_string($connection, $_GET['id']);
$val=mysqli_real_escape_string($connection, $_GET['val']);
if(($id!="")&&($val!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcupdates WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcupdates set enabled='$val' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Changed Updates and Announcements Status', '{$id}')");
				header("Location: updates.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: updates.php?error=This record is Not Found! Kindly check in All Updates and Announcements List");
			}
	}
	else
			{
				header("Location: updates.php?error=Error Data");
			}
}
?>