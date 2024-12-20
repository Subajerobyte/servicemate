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
	$reportedproblemvalue=mysqli_real_escape_string($connection, $_POST['reportedproblem']);
		$msg = "";
  $msg_class = "";

	if(($reportedproblemvalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcreportedproblem WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcreportedproblem set reportedproblem='$reportedproblemvalue' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Reported Problem Information', '{$id}', 'jrcreportedproblem')");
				header("Location: reportedproblem.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: reportedproblem.php?error=This record is Not Found! Kindly check in All Problem Reported List");
			}
	}
	else
			{
				header("Location: reportedproblem.php?error=Error Data");
			}
			}
	else
			{
				header("Location: reportedproblem.php?error=Error Data");
			}
}
else
			{
				header("Location: reportedproblem.php");
			}
?>