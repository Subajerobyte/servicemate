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
	$materialvalue=mysqli_real_escape_string($connection, $_POST['material']);
	$descriptionvalue=mysqli_real_escape_string($connection, $_POST['description']);
		$msg = "";
  $msg_class = "";

	if(($materialvalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcmaterial WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcmaterial set material='$materialvalue',description='$descriptionvalue' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Reported Problem Information', '{$id}', 'jrcmaterial')");
				header("Location: material.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: material.php?error=This record is Not Found! Kindly check in All Additional Materials List");
			}
	}
	else
			{
				header("Location: material.php?error=Error Data");
			}
			}
	else
			{
				header("Location: material.php?error=Error Data");
			}
}
else
			{
				header("Location: material.php");
			}
?>