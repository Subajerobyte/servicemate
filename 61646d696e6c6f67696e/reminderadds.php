<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	$remindervalue=mysqli_real_escape_string($connection, $_POST['reminder']);
	$enddate=mysqli_real_escape_string($connection, $_POST['enddate']);
		$msg = "";
  $msg_class = "";
	if(($remindervalue!="")&&($remindervalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcreminder WHERE reminder = '{$remindervalue}' and  enddate = '{$enddate}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcreminder( createdon, reminder,enddate) VALUES ( '$times','$remindervalue','$enddate')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Reminder', '{$tid}', 'jrcreminder')");
				header("Location: reminder.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: reminder.php?error=This record is Already Found! Kindly check in All Reminder List");
			}
	}
	else
			{
				header("Location: reminder.php?error=Error Data");
			}
}
else
			{
				header("Location: reminder.php");
			}
?>