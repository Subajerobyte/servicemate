<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$reportedproblemvalue=mysqli_real_escape_string($connection, $_POST['reportedproblem']);
		$msg = "";
  $msg_class = "";
	if(($reportedproblemvalue!="")&&($reportedproblemvalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcreportedproblem WHERE reportedproblem = '{$reportedproblemvalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcreportedproblem( reportedproblem) VALUES ( '$reportedproblemvalue')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Reported Problem', '{$tid}', 'jrcreportedproblem')");
				header("Location: reportedproblem.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: reportedproblem.php?error=This record is Already Found! Kindly check in All Problem Reported List");
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