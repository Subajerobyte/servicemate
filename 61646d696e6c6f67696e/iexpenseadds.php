<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$edate=mysqli_real_escape_string($connection, $_POST['edate']);
	$categoryname=mysqli_real_escape_string($connection, $_POST['categoryname']);
	$amount=mysqli_real_escape_string($connection, $_POST['amount']);
	$invoice=mysqli_real_escape_string($connection, $_POST['invoice']);
	$remarks=mysqli_real_escape_string($connection, $_POST['remarks']);
	if (!file_exists('../padhivetram/iexpense/'))
		{
    mkdir('../padhivetram/iexpense/', 0777, true);
        }
	$target_dir = "../padhivetram/iexpense/";
$target_file = $target_dir .time(). basename($_FILES["expensedoc"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if(move_uploaded_file($_FILES["expensedoc"]["tmp_name"], $target_file)) 
  {
$expensedoc=$target_file;
  } 
  else 
  {
$expensedoc="";
  }
		$msg = "";
  $msg_class = "";
	if(($edate!="")||($categoryname!=""))
	{		
		 
        $sqlcon = "SELECT id From jrciexpense WHERE edate = '{$edate}' and categoryname = '{$categoryname}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrciexpense(edate,categoryname,amount,invoice,remarks, expensedoc) VALUES ( '$edate','$categoryname','$amount','$invoice','$remarks', '$expensedoc')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Expense Details', '{$tid}', 'jrciexpense')");
				header("Location: iexpense.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: iexpense.php?error=This record is Already Found! Kindly check in All Additional Materials List");
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