<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$createdon=date('Y-m-d h:i:s a');
    $createdby=$email;
	$pdate=mysqli_real_escape_string($connection, $_POST['pdate']);
	$pono=mysqli_real_escape_string($connection, $_POST['pono']);
	$totalamount=mysqli_real_escape_string($connection, $_POST['totalamount']);
	$balanceamount=mysqli_real_escape_string($connection, $_POST['balanceamount']);
	$payamount=mysqli_real_escape_string($connection, $_POST['payamount']);
	
	if(($pono!="")||($payamount!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcsalespayment WHERE pdate = '{$pdate}' and pono = '{$pono}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcsalespayment(createdon,createdby,pdate,pono,totalamount,balanceamount,payamount) VALUES ( '$createdon','$createdby','$pdate','$pono','$totalamount', '$balanceamount', '$payamount')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Salesordeer Payment Details', '{$tid}', 'jrcsalespayment')");
				header("Location: dashboard.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: dashboard.php?error=This record is Already Found! Kindly check in All Payment List");
			}
	}
	else
			{
				header("Location: dashboard.php?error=Error Data");
			}
}
else
			{
				header("Location: dashboard.php");
			}
?>