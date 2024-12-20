<?php
include('lcheck.php');
if($addinvoice=='0')
{
	header("Location: dashboard.php");
}
if(isset($_GET['xlid']))
{
    $id=mysqli_real_escape_string($connection,$_GET['xlid']);
	$tdelete=mysqli_real_escape_string($connection,$_GET['tdelete']);
    $check_user="select * from jrcxl WHERE id='$id'";
	$run=mysqli_query($connection,$check_user);
    if(mysqli_num_rows($run)>0)
    {
		if($tdelete==0)
		{
			$tdelete=1;
		}
		else
		{
			$tdelete=0;
		}
        $insertvalue="update jrcxl set tdelete='$tdelete' where id='$id'";
		$exec=mysqli_query($connection,$insertvalue);
		if($exec)
		{
			mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'A Product Deleted', '{$id}')");
			header("Location: consigneeview.php?id=".$_GET['consigneeid']."&remarks=Removed Successfully!");
		}
		else
		{
			header("Location: consigneeview.php?id=".$_GET['consigneeid']."&remarks=".mysqli_error($bd));
		}
    }
    else
    {
        header("Location: consigneeview.php?id=".$_GET['consigneeid']."&remarks=This Product is Not Exists!");
    }
}
else
{
    header("Location: index.php?remarks=No Data Found!");
}
?> 