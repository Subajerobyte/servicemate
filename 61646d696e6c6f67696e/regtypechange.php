<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if (isset($_GET['id'])) {
$id=mysqli_real_escape_string($connection, $_GET['id']);
$val=mysqli_real_escape_string($connection, $_GET['val']);
if(($id!="")&&($val!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcregtype WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcregtype set enabled='$val' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Changed GST Registration Type Status', '{$id}', 'jrcregtype')");
				header("Location: regtype.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: regtype.php?error=This record is Not Found! Kindly check in All GST Registration Type List");
			}
	}
	else
			{
				header("Location: regtype.php?error=Error Data");
			}
}
?>