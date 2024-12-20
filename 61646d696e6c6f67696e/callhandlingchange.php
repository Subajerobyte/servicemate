<?php
include('lcheck.php');
if (isset($_GET['id'])) {
$id=mysqli_real_escape_string($connection, $_GET['id']);
$val=mysqli_real_escape_string($connection, $_GET['val']);
if(($id!="")&&($val!=""))
	{		
		// Query if email exists in db
        $sqlcon = "SELECT id From jrccallhandling WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
        // If query fails, show the reason 
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
        // Check if email exist
        if($rowCountcon > 0) 
		{	
			// Query if email exists in db
			$sqlup = "update jrccallhandling set enabled='$val' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			// If query fails, show the reason 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Changed Customer Support Executive Status', '{$id}')");
				header("Location: callhandling.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: callhandling.php?error=This record is Not Found! Kindly check in All Customer Support Executive List");
			}
	}
	else
			{
				header("Location: callhandling.php?error=Error Data");
			}
}
?>