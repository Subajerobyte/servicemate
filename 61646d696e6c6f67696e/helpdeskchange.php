<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if (isset($_GET['id'])) {
$id=mysqli_real_escape_string($connection1, $_GET['id']);
$val=mysqli_real_escape_string($connection1, $_GET['val']);
if(($id!="")&&($val!=""))
	{		
		 
        $sqlcon = "SELECT id From jrchelpdesk WHERE id = '{$id}'";
        $querycon = mysqli_query($connection1, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection1));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrchelpdesk set enabled='$val' where id='$id'";
			$queryup = mysqli_query($connection1, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection1));
			}
			else
			{
				mysqli_query($connection1, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Changed Reported Problem Status', '{$id}')");
				header("Location: helpdesk.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: helpdesk.php?error=This record is Not Found! Kindly check in All Complaint and Suggestion List");
			}
	}
	else
			{
				header("Location: helpdesk.php?error=Error Data");
			}
}
?>