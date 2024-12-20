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
	$statecode=mysqli_real_escape_string($connection, $_POST['statecode']);
		$msg = "";
  $msg_class = "";

	if(($statecode!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcplace WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcplace set statecode='$statecode' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Place Information', '{$id}', 'jrcplace')");
				header("Location: places.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: places.php?error=This record is Not Found! Kindly check in All Place List");
			}
	}
	else
			{
				header("Location: places.php?error=Error Data");
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