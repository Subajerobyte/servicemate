<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$holidayvalue=mysqli_real_escape_string($connection, $_POST['holiday']);
	$descriptionvalue=mysqli_real_escape_string($connection, $_POST['description']);
		$msg = "";
  $msg_class = "";
	if(($holidayvalue!="")&&($holidayvalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcholiday WHERE holiday = '{$holidayvalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcholiday(holiday,description) VALUES ( '$holidayvalue','$descriptionvalue')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Holidays', '{$tid}', 'jrcholiday')");
				header("Location: holiday.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: holiday.php?error=This record is Already Found! Kindly check in All Holidays List");
			}
	}
	else
			{
				header("Location: holiday.php?error=Error Data");
			}
}
else
			{
				header("Location: holiday.php");
			}
?>