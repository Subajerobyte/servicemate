<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
 $createdon=date('Y-m-d H:i:s');
 $createdby=$_SESSION['email'];
$consigneename=mysqli_real_escape_string($connection,$_POST['consigneename']);
$paymentdate=mysqli_real_escape_string($connection,$_POST['paymentdate']);
$paymentmode=mysqli_real_escape_string($connection,$_POST['paymentmode']);
$advance=mysqli_real_escape_string($connection,$_POST['paidamount']);
$remarks=mysqli_real_escape_string($connection,$_POST['remarks']);
if(($advance!=""))
{
		 
    $sqlcon = "SELECT id From jrcpayment WHERE paymentdate = '{$paymentdate}' and tdelete='0'";
	$querycon = mysqli_query($connection, $sqlcon);
	$rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcpayment(createdon,createdby,consigneename,paymentdate,paymentmode,advance,remarks,ptype) values( '{$createdon}','{$createdby}','{$consigneename}','{$paymentdate}','{$paymentmode}','{$advance}','{$remarks}','Rental')";
			  $queryup = mysqli_query($connection, $sqlup);
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Payments', '{$tid}', 'jrcpayment')");
				//for consignee amount increment
				$sqlcon = "SELECT id, totalbilledamount,totalpaidamount,totalbalanceamount From jrcconsignee where id='$consigneename'";
				$querycon = mysqli_query($connection, $sqlcon);
				$rowCountcon = mysqli_num_rows($querycon);
				if(!$querycon){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountcon > 0)
				{
					
				$rowcon = mysqli_fetch_array($querycon);
				$paidamount=$rowcon['totalpaidamount']+$advance;
				$pendingamount=$rowcon['totalbilledamount']-$paidamount;
				}
                mysqli_query($connection, "update jrcconsignee set  totalpaidamount='$paidamount', totalbalanceamount='$pendingamount' where id='$consigneename'");
				header("Location: payments.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: payments.php?error=This record is Already Found! Kindly check in All Payments List");
			}
	}
	else
			{
				header("Location: payments.php?error=Error Data");
			}
}
else
			{
				header("Location: payments.php");
			}
?>















