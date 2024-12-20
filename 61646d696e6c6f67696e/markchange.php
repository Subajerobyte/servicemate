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
		 
        $sqlcon = "SELECT id From jrcmark WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcmark set enabled='$val' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Changed a Price Mark Detail', '{$id}', 'jrcmark')");
				header("Location: mark.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: mark.php?error=This record is Not Found! Kindly check in All Price Marks List");
			}
	}
	else
			{
				header("Location: mark.php?error=Error Data");
			}
}
?>