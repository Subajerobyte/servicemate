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
	$calltype=mysqli_real_escape_string($connection, $_POST['calltype']);
	$callnaturevalue=mysqli_real_escape_string($connection, $_POST['callnature']);
		$msg = "";
  $msg_class = "";

	if(($callnaturevalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrccallnature WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrccallnature set callnature='$callnaturevalue', calltype='$calltype' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Reported Problem Information', '{$id}', 'jrccallnature')");
				header("Location: callnature.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: callnature.php?error=This record is Not Found! Kindly check in All Call Nature List");
			}
	}
	else
			{
				header("Location: callnature.php?error=Error Data");
			}
			}
	else
			{
				header("Location: callnature.php?error=Error Data");
			}
}
else
			{
				header("Location: callnature.php");
			}
?>