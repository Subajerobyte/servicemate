<?php
include('lcheck.php');
if($updates=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	if(isset($_POST['id']))
	{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
	$updatesvalue=mysqli_real_escape_string($connection, $_POST['updates']);
	$enddate=mysqli_real_escape_string($connection, $_POST['enddate']);
	$updatetype=mysqli_real_escape_string($connection, $_POST['updatetype']);
	$addedon=date('Y-m-d H:i:s');
		$msg = "";
  $msg_class = "";

	if(($updatesvalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcupdates WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcupdates set updates='$updatesvalue', enddate='$enddate', updatetype='$updatetype', addedon='$addedon' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Updates and Announcements Information', '{$id}', 'jrcupdates')");
				$sqlup = "UPDATE `jrcengineer` SET `updates`='0'";
				$queryup = mysqli_query($connection, $sqlup);
				header("Location: updates.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: updates.php?error=This record is Not Found! Kindly check in All Updates and Announcements List");
			}
	}
	else
			{
				header("Location: updates.php?error=Error Data");
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