<?php
include('lcheck.php');
if($addinvoice=='0')
{
	header("Location: dashboard.php");
}

if(isset($_POST['warrantysubmit']))
{
	if((isset($_POST['warrantycycle']))&&(isset($_POST['ids'])))
	{
		$subquer="";
		$i=0;
		foreach($_POST['warrantycycle'] as $warrantycycle)
		{
			$warrantycycle=mysqli_real_escape_string($connection, $warrantycycle);
			if($warrantycycle!='')
			{
			$id=mysqli_real_escape_string($connection, $_POST['ids'][$i]);
			echo 'hello';
			$sqli=mysqli_query($connection, "update jrcproduct set warrantycycle='$warrantycycle' where id='$id'");
			$tid=$id;
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Missing Warranty Cycle Updated', '{$tid}', 'jrcproduct')");

			if($sqli)
			{
				mysqli_query($connection, "update jrcxl set warrantycycle='$warrantycycle' where productid='$id'");
			}

			}
			
			
			$i++;
		}
		header("Location: warrantycycle.php?remarks=Updated Successfully");
	}
}
?>