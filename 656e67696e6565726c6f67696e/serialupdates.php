<?php
include('lcheck.php');
//print_r($_POST);
if(isset($_POST['callid']))
{
	if(isset($_POST['callid']))
	{
		$callid=mysqli_real_escape_string($connection, $_POST['callid']);
		$sourceid=mysqli_real_escape_string($connection, $_POST['sourceid']);
		$upsserial=mysqli_real_escape_string($connection, $_POST['upsserial']);
		$consigneeid=mysqli_real_escape_string($connection, $_POST['consigneeid']);
		$productid=mysqli_real_escape_string($connection, $_POST['productid']);
		$location=mysqli_real_escape_string($connection, $_POST['department']);

		$sqli=mysqli_query($connection, "delete from jrcserials where productid='".$productid."' and consigneeid='".$consigneeid."' and sourceid='".$sourceid."'");


		$sno="";
		$depar="";
		if((isset($_POST['ids']))&&is_array($_POST['ids']))
		{
			for($i=0;$i<count($_POST['ids']);$i++)
			{
				$id=mysqli_real_escape_string($connection, $_POST['ids'][$i]);
				$serialnumber=mysqli_real_escape_string($connection, $_POST['serialnumber'][$i]);
				$sstatus=0;
				$sqlselect = "insert into jrcserials set upsserial='".$upsserial."', serialnumber='".$serialnumber."', location='".$location."', sourceid='".$sourceid."', consigneeid='".$consigneeid."', productid='".$productid."', sstatus='".$sstatus."', serialqty='".($i+1)."'";
				$tid=$id;
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Serials', '{$tid}', 'jrcserials')");

				$queryselect = mysqli_query($connection, $sqlselect);
				if(!$queryselect)
				{
					die("SQL query failed: " . mysqli_error($connection));
				}
				echo $sqlselect."<br>";
				if($sstatus=='0')
				{
					if($sno!="")
					{
						$sno.="| ".$serialnumber;
					}
					else
					{
						$sno.=$serialnumber;
					}
					if($depar!="")
					{
						$depar.="| ".$location;
					}
					else
					{
						$depar.=$location;
					}
				}
			}
		}
$sqlselect = "update jrcxl set serialnumber='".$sno."', departments='".$depar."' where id='".$sourceid."'";
$queryselect = mysqli_query($connection, $sqlselect);

mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated A Serials', '{$tid}', 'jrcserials')");
if(!$queryselect)
{
    die("SQL query failed: " . mysqli_error($connection));
}
else
{
	header("Location: calls.php?status=0&remarks=Serial Numbers Updated Successfully");
}

			}
	else
			{
				header("Location: calls.php?error=Error Data");
			}
}
else
			{
				header("Location: calls.php");
			}
?>