<?php
include('lcheck.php');
if($updates=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$updatesvalue=mysqli_real_escape_string($connection, $_POST['updates']);
	$enddate=mysqli_real_escape_string($connection, $_POST['enddate']);
	$updatetype=mysqli_real_escape_string($connection, $_POST['updatetype']);
	$addedon=date('Y-m-d H:i:s');
		$msg = "";
  $msg_class = "";
	if(($updatesvalue!="")&&($updatesvalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcupdates WHERE updates = '{$updatesvalue}' and  enddate = '{$enddate}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcupdates( updates,enddate,updatetype,addedon) VALUES ( '$updatesvalue','$enddate','$updatetype','$addedon')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Updates and Announcements', '{$tid}', 'jrcupdates')");
				
				$sqlup = "UPDATE `jrcengineer` SET `updates`='0'";
				$queryup = mysqli_query($connection, $sqlup);
				
				
				header("Location: updates.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: updates.php?error=This record is Already Found! Kindly check in All Updates and Announcements List");
			}
	}
	else
			{
				header("Location: updates.php?error=Error Data");
			}
}
else
			{
				header("Location: updates.php");
			}
?>