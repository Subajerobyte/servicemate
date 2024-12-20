<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$problemobservedvalue=mysqli_real_escape_string($connection, $_POST['problemobserved']);
		$msg = "";
  $msg_class = "";
	if(($problemobservedvalue!="")&&($problemobservedvalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcproblemobserved WHERE problemobserved = '{$problemobservedvalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcproblemobserved( problemobserved) VALUES ( '$problemobservedvalue')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Reported Problem', '{$tid}', 'jrcproblemobserved')");
				header("Location: problemobserved.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: problemobserved.php?error=This record is Already Found! Kindly check in All Problem Observed List");
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