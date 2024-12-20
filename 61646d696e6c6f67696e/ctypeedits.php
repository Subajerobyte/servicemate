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
	$ctypevalue=mysqli_real_escape_string($connection, $_POST['ctype']);
		$msg = "";
  $msg_class = "";

	if(($ctypevalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcctype WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcctype set ctype='$ctypevalue' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Customer Type Information', '{$id}', 'jrcctype')");
				header("Location: ctype.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: ctype.php?error=This record is Not Found! Kindly check in All Customer Type List");
			}
	}
	else
			{
				header("Location: ctype.php?error=Error Data");
			}
			}
	else
			{
				header("Location: ctype.php?error=Error Data");
			}
}
else
			{
				header("Location: ctype.php");
			}
?>