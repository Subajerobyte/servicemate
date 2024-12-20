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
	$edate=mysqli_real_escape_string($connection, $_POST['edate']);
	$categoryname=mysqli_real_escape_string($connection, $_POST['categoryname']);
	$amount=mysqli_real_escape_string($connection, $_POST['amount']);
	$invoice=mysqli_real_escape_string($connection, $_POST['invoice']);
	$remarks=mysqli_real_escape_string($connection, $_POST['remarks']);
	$oldexpensedoc=mysqli_real_escape_string($connection,  $_POST['oldexpensedoc']);
$target_dir = "../padhivetram/iexpense/";
$target_file = $target_dir .time(). basename($_FILES["expensedoc"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  if (move_uploaded_file($_FILES["expensedoc"]["tmp_name"],  $target_file)) 
  {
	$expensedoc=$target_file;
  } 
  else 
  {
	$expensedoc=$oldexpensedoc;
  }
		$msg = "";
  $msg_class = "";

	if(($edate!="")||($categoryname!=""))
	{		
		 
        $sqlcon = "SELECT id From jrciexpense WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrciexpense set edate='$edate',categoryname='$categoryname',amount='$amount',invoice='$invoice',remarks='$remarks', expensedoc='$expensedoc' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Upedated Expense Information', '{$id}', 'jrciexpense')");
				header("Location: iexpense.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: iexpense.php?error=This record is Not Found! Kindly check in All Expense List");
			}
	}
	else
			{
				header("Location: iexpense.php?error=Error Data");
			}
			}
	else
			{
				header("Location: iexpense.php?error=Error Data");
			}
}
else
			{
				header("Location: iexpense.php");
			}
?>