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
	$assestvalue=mysqli_real_escape_string($connection, $_POST['assest']);
		$msg = "";
  $msg_class = "";

	if(($assestvalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcassest WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcassest set assest='$assestvalue' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Reported Problem Information', '{$id}', 'jrcassest')");
				header("Location: assest.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: assest.php?error=This record is Not Found! Kindly check in All Other Reference List");
			}
	}
	else
			{
				header("Location: assest.php?error=Error Data");
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