<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$calltype=mysqli_real_escape_string($connection, $_POST['calltype']);
	$callnaturevalue=mysqli_real_escape_string($connection, $_POST['callnature']);
		$msg = "";
  $msg_class = "";
	if(($callnaturevalue!="")&&($callnaturevalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrccallnature WHERE callnature = '{$callnaturevalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrccallnature( callnature, calltype) VALUES ( '$callnaturevalue', '$calltype')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Reported Problem', '{$tid}', 'jrccallnature')");
				header("Location: callnature.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: callnature.php?error=This record is Already Found! Kindly check in All Call Nature List");
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