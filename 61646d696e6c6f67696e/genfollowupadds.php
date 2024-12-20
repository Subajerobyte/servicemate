<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
		$createdon=date('Y-m-d H:i:s');
		$createdby=$email;
		$consigneeid=mysqli_real_escape_string($connection, $_POST['consigneeid']);
		$followupdate=mysqli_real_escape_string($connection, $_POST['followupdate']);
		$followupback=mysqli_real_escape_string($connection, $_POST['followupback']);
		$status=mysqli_real_escape_string($connection, $_POST['status']);
		$reason=mysqli_real_escape_string($connection, $_POST['reason']);
		$followuptype="General Followup";
	if($followupdate!="")
	{		
		 
        $sqlcon = "SELECT id From jrcfollowup WHERE followupdate= '{$followupdate}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcfollowup( createdon, createdby, consigneeid, followupdate,followupback, status, reason, followuptype) VALUES ( '$createdon', '$createdby', '$consigneeid', '$followupdate','$followupback', '$status', '$reason', '$followuptype')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A New General Followup', '{$tid}', 'jrcfollowup')");
				if($status=='Postponed')
				{
				 mysqli_query($connection, "INSERT INTO jrcreminder (createdon, remindertype, reminder, enddate) VALUES ('{$createdon}', '{$followuptype}', 'General Followup Reminder', '{$followupback}')");
				}
				header("Location: consigneeview.php?id='".$consigneeid."'&remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: consigneeview.php?id='".$consigneeid."'&error=This record is Already Found! Kindly check in All Administrator List");
			}
	}
	else
			{
				header("Location: consigneeview.php?id='".$consigneeid."'&error=Error Data");
			}
}
else
			{
				header("Location: consigneeview.php?id='".$consigneeid."'");
			}



?>