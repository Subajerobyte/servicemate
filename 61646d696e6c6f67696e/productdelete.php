<?php
include('lcheck.php');
if($uploaddata=='0')
{
	header("Location: dashboard.php");
}
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
$sqlselect = "SELECT * From jrcproduct where id='".$id."' order by componentname asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
    die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0) 
{
$count=1;
while($rowselect = mysqli_fetch_array($queryselect)) 
{
	$sqlit=mysqli_query($connection, "select productid from jrcxl where productid='".$rowselect['id']."'");
	if(mysqli_num_rows($sqlit)==0)
	{
		$sqlit2=mysqli_query($connection, "delete from jrcproduct where id='".$rowselect['id']."'");
		if($sqlit2)
		{
			header("Location: product.php?remarks=Deleted Successfully");
		}
	}	
	else
	{
		$sqlit2=mysqli_query($connection, "update jrcproduct set invoiced='1' where id='".$rowselect['id']."'");
		header("Location: product.php?error=This Product is Already Invoiced, You unable to delete it");
	}	
}
}
else
{
	header("Location: product.php?error=No Data Found");
}
}
else
{
	header("Location: product.php?error=No ID Found");
}
?>