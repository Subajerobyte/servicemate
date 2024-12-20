<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$helpdeskvalue=mysqli_real_escape_string($connection1, $_POST['titles']);
	$createdby=$_SESSION['email'];
	$createdon=date('Y-m-d H:i:s');
	$companyid=$_SESSION['companyid'];
	$descriptionvalue=mysqli_real_escape_string($connection1, $_POST['description']);
		$msg = "";
  $msg_class = "";
	if(($helpdeskvalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrchelpdesk WHERE titles = '{$helpdeskvalue}'";
        $querycon = mysqli_query($connection1, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection1));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrchelpdesk(createdon, createdby, companyid,  titles,description) VALUES ( '$createdon', '$createdby', '$companyid', '$helpdeskvalue','$descriptionvalue')";
			$queryup = mysqli_query($connection1, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection1));
			}
			else
			{
				$tid=mysqli_insert_id($connection1);
				mysqli_query($connection1, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Complaint and Suggestion', '{$tid}')");
				header("Location: helpdesk.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: helpdesk.php?error=This record is Already Found! Kindly check in All Complaint and Suggestion List");
			}
	}
	else
			{
				header("Location: helpdesk.php?error=Error Data");
			}
}
else
			{
				header("Location: helpdesk.php");
			}
?>