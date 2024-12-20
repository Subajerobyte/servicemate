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
	$categoryname=mysqli_real_escape_string($connection, $_POST['categoryname']);
	$descriptionvalue=mysqli_real_escape_string($connection, $_POST['description']);
		$msg = "";
  $msg_class = "";

	if(($descriptionvalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcexpense WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcexpense set description='$descriptionvalue', categoryname='$categoryname' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Expense Details', '{$id}', 'jrcexpense')");
				header("Location: expense.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: expense.php?error=This record is Not Found! Kindly check in All expense List");
			}
	}
	else
			{
				header("Location: expense.php?error=Error Data");
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