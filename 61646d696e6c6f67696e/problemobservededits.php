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
	$problemobservedvalue=mysqli_real_escape_string($connection, $_POST['problemobserved']);
		$msg = "";
  $msg_class = "";

	if(($problemobservedvalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcproblemobserved WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcproblemobserved set problemobserved='$problemobservedvalue' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Reported Problem Information', '{$id}', 'jrcproblemobserved')");
				header("Location: problemobserved.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: problemobserved.php?error=This record is Not Found! Kindly check in All Problem Observed List");
			}
	}
	else
			{
				header("Location: problemobserved.php?error=Error Data");
			}
			}
	else
			{
				header("Location: problemobserved.php?error=Error Data");
			}
}
else
			{
				header("Location: problemobserved.php");
			}
?>