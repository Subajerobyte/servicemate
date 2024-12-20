<?php
include('lcheck.php');
if($addinvoice=='0')
{
	header("Location: dashboard.php");
}

if(isset($_POST['productlifetimesubmit']))
{
	if((isset($_POST['productlifetime']))&&(isset($_POST['ids'])))
	{
		$subquer="";
		$i=0;
		foreach($_POST['productlifetime'] as $productlifetime)
		{
			$productlifetime=mysqli_real_escape_string($connection, $productlifetime);
			if($productlifetime!='')
			{
			$id=mysqli_real_escape_string($connection, $_POST['ids'][$i]);
			$sqli=mysqli_query($connection, "update jrcproduct set productlifetime='$productlifetime' where id='$id'");
			$tid=$id;
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Product Life Time Missing Product', '{$tid}', 'jrcproduct')");

			if($sqli)
			{
				mysqli_query($connection, "update jrcxl set productlifetime='$productlifetime' where productid='$id'");
			}

			}
			
			
			$i++;
		}
		header("Location: productlifetime.php?remarks=Updated Successfully");
	}
}
else
{
	header("Location: productlifetime.php?error=Updated Successfully");
}
?>