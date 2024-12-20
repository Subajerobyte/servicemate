<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$tendernovalue=mysqli_real_escape_string($connection, $_POST['tenderno']);
		$msg = "";
  $msg_class = "";
	if(($tendernovalue!="")&&($tendernovalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrctenderno WHERE tenderno = '{$tendernovalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrctenderno( tenderno) VALUES ( '$tendernovalue')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Tender Number', '{$tid}', 'jrctenderno')");
				header("Location: tenderno.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: tenderno.php?error=This record is Already Found! Kindly check in All Tender Number List");
			}
	}
	else
			{
				header("Location: tenderno.php?error=Error Data");
			}
}
else
			{
				header("Location: tenderno.php");
			}
?>