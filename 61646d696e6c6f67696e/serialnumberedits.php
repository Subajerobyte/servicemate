<?php
include('lcheck.php');
//print_r($_POST);
if(isset($_POST['id']))
{
	
	if(isset($_POST['id']))
	{
		$sourceid=mysqli_real_escape_string($connection, $_POST['sourceid']);
		$consigneeid=mysqli_real_escape_string($connection, $_POST['consigneeid']);
		$upsserial=mysqli_real_escape_string($connection, $_POST['upsserial']);
		if(isset($_POST['ts1']))
			{
				$ts1=mysqli_real_escape_string($connection, $_POST['ts1']);
			}
		$sno="";
		$depar="";
		if((isset($_POST['id']))&&is_array($_POST['id']))
		{
			for($i=0;$i<count($_POST['id']);$i++)
			{
				$id=mysqli_real_escape_string($connection, $_POST['id'][$i]);
				$serialnumber=mysqli_real_escape_string($connection, $_POST['serialnumber'][$i]);
				$location=mysqli_real_escape_string($connection, $_POST['location'][$i]);
				$sstatus=mysqli_real_escape_string($connection, ((isset($_POST['sstatus'][$i]))?$_POST['sstatus'][$i]:''));
				$sqlselect = "update jrcserials set serialnumber='".$serialnumber."', upsserial='".$upsserial."', location='".$location."', sstatus='".$sstatus."' where id='".$id."'";
				$queryselect = mysqli_query($connection, $sqlselect);
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
$sqlselect = "update jrcxl set serialnumber='".$sno."',  departments='".$depar."' where id='".$sourceid."'";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
    die("SQL query failed: " . mysqli_error($connection));
}
else
{if(isset($_POST['ts1']))
			{
				
	header("Location: reminderedit.php?id={$ts1}&remarks=Updated Successfully");
			}
			else{
			header("Location: serialnumberedit.php?consigneeid={$consigneeid}&xlid={$sourceid}&remarks=Updated Successfully");
			}
}

			}
	else
			{
				header("Location: consignee.php?error=Error Data");
			}
}
else
			{
				header("Location: consignee.php");
			}
?>