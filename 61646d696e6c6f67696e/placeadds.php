<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$statecode=mysqli_real_escape_string($connection, $_POST['statecode']);
		$msg = "";
  $msg_class = "";
	if(($statecode!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcplace WHERE statecode = '{$statecode}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcplace(statecode) VALUES ('$statecode')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Place Details', '{$tid}', 'jrcplace')");
				header("Location: places.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: places.php?error=This record is Already Found! Kindly check in All Place List");
			}
	}
	else
			{
				header("Location: places.php?error=Error Data");
			}
}
else
			{
				header("Location: places.php");
			}
?>