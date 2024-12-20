<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$assestvalue=mysqli_real_escape_string($connection, $_POST['assest']);
		$msg = "";
  $msg_class = "";
	if(($assestvalue!="")&&($assestvalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcassest WHERE assest = '{$assestvalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcassest( assest) VALUES ( '$assestvalue')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Reported Problem', '{$tid}', 'jrcassest')");
				header("Location: assest.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: assest.php?error=This record is Already Found! Kindly check in All Other Reference List");
			}
	}
	else
			{
				header("Location: assest.php?error=Error Data");
			}
}
else
			{
				header("Location: assest.php");
			}
?>