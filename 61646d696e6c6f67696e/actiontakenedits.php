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
	$actiontakenvalue=mysqli_real_escape_string($connection, $_POST['actiontaken']);
		$msg = "";
  $msg_class = "";

	if(($actiontakenvalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcactiontaken WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcactiontaken set actiontaken='$actiontakenvalue' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Action Taken Information', '{$id}', 'jrcactiontaken')");
				header("Location: actiontaken.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: actiontaken.php?error=This record is Not Found! Kindly check in All Action Taken List");
			}
	}
	else
			{
				header("Location: actiontaken.php?error=Error Data");
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