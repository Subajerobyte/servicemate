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
 $id=mysqli_real_escape_string($connection,$_POST['id']);
$oconsigneename=mysqli_real_escape_string($connection,$_POST['oconsigneename']);
$consigneename=mysqli_real_escape_string($connection,$_POST['consigneename']);
$paymentdate=mysqli_real_escape_string($connection,$_POST['paymentdate']);
$consigneename=mysqli_real_escape_string($connection,$_POST['consigneename']);
$paymentmode=mysqli_real_escape_string($connection,$_POST['paymentmode']);
 $advance=mysqli_real_escape_string($connection,$_POST['advance']);
 $oadvance=mysqli_real_escape_string($connection,$_POST['oadvance']);

 $remarks=mysqli_real_escape_string($connection,$_POST['remarks']);
if(($advance!=""))
{
	
$sqlcon = "SELECT id From jrcpayment WHERE id = '{$id}'";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	 
			 
			$sqlup = "update jrcpayment set paymentdate='$paymentdate',consigneename='$consigneename',paymentmode='$paymentmode',advance='$advance',remarks='$remarks',ptype='Rental' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Payment Information', '{$id}', 'jrcpayment')");
				
				//for consignee amount increment
				if($consigneename!=$oconsigneename)
				{
					$oldconsigneepaid=0;
				$oldconsingneepending=0;
				$sqlcon = "SELECT id, totalpaidamount,totalbalanceamount,totalbilledamount From jrcconsignee where id='$consigneename'";
				$querycon = mysqli_query($connection, $sqlcon);
				$rowCountcon = mysqli_num_rows($querycon);
				
				if(!$querycon){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountcon > 0)
				{
				$rowcon = mysqli_fetch_array($querycon);
				
				$sqlcon1 = "SELECT id, totalpaidamount,totalbalanceamount,totalbilledamount From jrcconsignee where id='$oconsigneename'";
				$querycon1 = mysqli_query($connection, $sqlcon1);
				$rowCountcon1 = mysqli_num_rows($querycon1);
				$rowcon1 = mysqli_fetch_array($querycon1);
				
				//for oldconsinee
				$oldconsigneepaid=$rowcon1['totalpaidamount']-$oadvance;
				$oldconsingneepending=$rowcon1['totalbalanceamount']+$oadvance;
				//for new consignee
				$paidamount=$rowcon['totalpaidamount']+$advance;
				$pendingamount=$rowcon['totalbilledamount']-$paidamount;
				
			 		
				}
				mysqli_query($connection, "update jrcconsignee set totalpaidamount='$oldconsigneepaid',totalbalanceamount='$oldconsingneepending' where id='$oconsigneename'");
				mysqli_query($connection, "update jrcconsignee set totalpaidamount='$paidamount',totalbalanceamount='$pendingamount' where id='$consigneename'");			
				}
				
				
				else
				{		
				$sqlcon = "SELECT id,totalpaidamount,totalbalanceamount,totalbilledamount From jrcconsignee where id='$consigneename'";
				$querycon = mysqli_query($connection, $sqlcon);
				$rowCountcon = mysqli_num_rows($querycon);
				if(!$querycon){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountcon > 0)
				{
				$rowcon = mysqli_fetch_array($querycon);
				if($oadvance >$advance)
				{
			 	$totaladvance=$oadvance-$advance;
				$add=$rowcon['totalpaidamount']-$totaladvance;
				}
				else
				{
					$totaladvance1=$advance-$oadvance;
					$add=$rowcon['totalpaidamount']+$totaladvance1;
				}
				$pending=$rowcon['totalbilledamount']-$add;
                mysqli_query($connection, "update jrcconsignee set totalpaidamount='$add',totalbalanceamount='$pending' where id='$consigneename'");
				}
				}
				header("Location: payments.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: payments.php?error=This record is Not Found! Kindly check in All Payment List");
			}
	}
	else
			{
				header("Location: payments.php?error=Error Data");
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

