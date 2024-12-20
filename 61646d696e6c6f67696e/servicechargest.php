<?php
include('lcheck.php');
if($servicecharges=='0')
{
	header("Location: dashboard.php");
}
if(isset($_GET['id']))
{
	$id=mysqli_real_escape_string($connection, $_GET['id']);
	$status=mysqli_real_escape_string($connection, $_GET['status']);
	$sqli=mysqli_query($connection, "update jrccalldetails set tallystatus='$status' where id='$id'");
	if($sqli)
	{
		header("Location: servicecharges.php?remarks=Changed Successfully!");
	}
	else
	{
		header("Location: servicecharges.php?error=".mysqli_error($connection));
	}
}
else
{
	header("Location: servicecharges.php");
}
?>