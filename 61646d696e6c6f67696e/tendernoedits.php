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
	$tendernovalue=mysqli_real_escape_string($connection, $_POST['tenderno']);
		$msg = "";
  $msg_class = "";

	if(($tendernovalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrctenderno WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrctenderno set tenderno='$tendernovalue' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Tender Number Information', '{$id}', 'jrctenderno')");
				header("Location: tenderno.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: tenderno.php?error=This record is Not Found! Kindly check in All Tender Number List");
			}
	}
	else
			{
				header("Location: tenderno.php?error=Error Data");
			}
			}
	else
			{
				header("Location: tenderno.php?error=Error Data");
			}
}
else
			{
				header("Location: tender.php");
			}
?>