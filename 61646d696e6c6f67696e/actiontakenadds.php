<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$actiontakenvalue=mysqli_real_escape_string($connection, $_POST['actiontaken']);
		$msg = "";
  $msg_class = "";
	if(($actiontakenvalue!="")&&($actiontakenvalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcactiontaken WHERE actiontaken = '{$actiontakenvalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcactiontaken( actiontaken) VALUES ( '$actiontakenvalue')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Action Taken', '{$tid}','jrcactiontaken')");
				header("Location: actiontaken.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: actiontaken.php?error=This record is Already Found! Kindly check in All Action Taken List");
			}
	}
	else
			{
				header("Location: actiontaken.php?error=Error Data");
			}
}
else
			{
				header("Location: actiontaken.php");
			}
?>