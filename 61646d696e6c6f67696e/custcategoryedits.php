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
	$maincategoryvalue=mysqli_real_escape_string($connection, $_POST['maincategory']);
		$msg = "";
  $msg_class = "";

	if(($maincategoryvalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrccustcategory WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrccustcategory set maincategory='$maincategoryvalue' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Customer Main Category Information', '{$id}', 'jrccustcategory')");
				header("Location: custcategory.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: custcategory.php?error=This record is Not Found! Kindly check in All Customer Main Category List");
			}
	}
	else
			{
				header("Location: custcategory.php?error=Error Data");
			}
			}
	else
			{
				header("Location: custcategory.php?error=Error Data");
			}
}
else
			{
				header("Location: custcategory.php");
			}
?>