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
	$districtvalue=mysqli_real_escape_string($connection, $_POST['district']);
	$state=mysqli_real_escape_string($connection, $_POST['state']);
		$msg = "";
  $msg_class = "";

	if(($districtvalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcdistrict WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcdistrict set district='$districtvalue', state='$state' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated District Information', '{$id}', 'jrcdistrict')");
				header("Location: district.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: district.php?error=This record is Not Found! Kindly check in All District List");
			}
	}
	else
			{
				header("Location: district.php?error=Error Data");
			}
			}
	else
			{
				header("Location: district.php?error=Error Data");
			}
}
else
			{
				header("Location: district.php");
			}
?>