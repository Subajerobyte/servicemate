<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$categoryname=mysqli_real_escape_string($connection, $_POST['categoryname']);
	$descriptionvalue=mysqli_real_escape_string($connection, $_POST['description']);
		$msg = "";
  $msg_class = "";
	if(($descriptionvalue!="")&&($descriptionvalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcexpense WHERE description = '{$descriptionvalue}' and categoryname = '{$categoryname}' ";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcexpense( description, categoryname) VALUES ( '$descriptionvalue', '$categoryname')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Expense Details', '{$tid}', 'jrcexpense')");
				header("Location: expense.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: expense.php?error=This record is Already Found! Kindly check in All expense List");
			}
	}
	else
			{
				header("Location: expense.php?error=Error Data");
			}
}
else
			{
				header("Location: expense.php");
			}
?>