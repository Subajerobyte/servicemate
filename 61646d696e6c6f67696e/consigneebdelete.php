<?php
include('lcheck.php');
if($uploaddata=='0')
{
	header("Location: dashboard.php");
}
if(isset($_GET['pars']))
{
$sqlselect = "SELECT * From jrcconsignee order by consigneename asc";
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
	$sqlit=mysqli_query($connection, "select consigneeid from jrcxl where consigneeid='".$rowselect['id']."'");
	if(mysqli_num_rows($sqlit)==0)
	{
		$sqlit2=mysqli_query($connection, "delete from jrcconsignee where id='".$rowselect['id']."'");
		if($sqlit2)
		{
			
		}
	}	
	else
	{
		$sqlit2=mysqli_query($connection, "update jrcconsignee set invoiced='1' where id='".$rowselect['id']."'");
	}
}
header("Location: consigneesearch1.php?remarks=Deleted Successfully");
$tid=$rowselect['id'];
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Deleted Customers', '{$tid}', 'jrcconsignee')");

}
else
{
	header("Location: consigneesearch1.php?error=No Data Found");
}
}
else
{
	header("Location: consigneesearch1.php?error=No ID Found");
}
?>