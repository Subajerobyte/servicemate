<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$rypevalue=mysqli_real_escape_string($connection, $_POST['rype']);
		$msg = "";
  $msg_class = "";
	if(($rypevalue!="")&&($rypevalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcregtype WHERE rype = '{$rypevalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcregtype( rype) VALUES ( '$rypevalue')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A GST Registration Type', '{$tid}', 'jrcregtype')");
				header("Location: regtype.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: regtype.php?error=This record is Already Found! Kindly check in All GST Registration Type List");
			}
	}
	else
			{
				header("Location: regtype.php?error=Error Data");
			}
}
else
			{
				header("Location: regtype.php");
			}
?>