<?php
include('lcheck.php');
if($addinvoice=='0')
{
	header("Location: dashboard.php");
}

if(isset($_POST['warrantysubmit']))
{
	if((isset($_POST['warranty']))&&(isset($_POST['invoicedate']))&&(isset($_POST['installedon']))&&(isset($_POST['ids'])))
	{
		$subquer="";
		$i=0;
		foreach($_POST['warranty'] as $warranty)
		{
			$warranty=mysqli_real_escape_string($connection, $warranty);
			if($warranty!='')
			{
			$installedon=mysqli_real_escape_string($connection, $_POST['installedon'][$i]);
			$invoicedate=mysqli_real_escape_string($connection, $_POST['invoicedate'][$i]);
			$id=mysqli_real_escape_string($connection, $_POST['ids'][$i]);
			if($installedon!='')
			{
			$overdate=$installedon;
			}
			else
			{
			$overdate= $invoicedate;
			}
			$off=(float)$warranty;
			$overdate = str_replace('/', '-', $overdate);
			$overdate=date('Y-m-d', strtotime($overdate));
			$warrantydate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
			
			$sqli=mysqli_query($connection, "update jrcxl set warranty='$warranty', warrantydate='$warrantydate' where id='$id'");
			$tid=$id;
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Missing Warranty Updated', '{$tid}', 'jrcxl')");

			if($sqli)
			{
				
			}

			}
			
			
			$i++;
		}
		header("Location: warrantymissing.php?remarks=Updated Successfully");
	}
}
?>