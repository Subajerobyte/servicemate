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
	$gsttype=mysqli_real_escape_string($connection, $_POST['gsttype']);
	$gstpercentagevalue=mysqli_real_escape_string($connection, $_POST['gstpercentage']);
		$msg = "";
  $msg_class = "";

	if(($gstpercentagevalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcgstpercentage WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcgstpercentage set gstpercentage='$gstpercentagevalue', gsttype='$gsttype' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated a GST Rate', '{$id}', 'jrcgstpercentage')");
				header("Location: gstpercentage.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: gstpercentage.php?error=This record is Not Found! Kindly check in All GST Rate List");
			}
	}
	else
			{
				header("Location: gstpercentage.php?error=Error Data");
			}
			}
	else
			{
				header("Location: gstpercentage.php?error=Error Data");
			}
}
else
			{
				header("Location: gstpercentage.php");
			}
?>