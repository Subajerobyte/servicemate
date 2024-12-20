<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$ctypevalue=mysqli_real_escape_string($connection, $_POST['ctype']);
		$msg = "";
  $msg_class = "";
	if(($ctypevalue!="")&&($ctypevalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcctype WHERE ctype = '{$ctypevalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcctype( ctype) VALUES ( '$ctypevalue')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Customer Type', '{$tid}', 'jrcctype')");
				header("Location: ctype.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: ctype.php?error=This record is Already Found! Kindly check in All Customer Type List");
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