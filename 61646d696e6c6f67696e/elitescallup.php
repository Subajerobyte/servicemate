<?php
include('lcheck.php');
$sqli=mysqli_query($connection, "select id, serial from jrccalls order by id asc ");
while($info=mysqli_fetch_array($sqli))
{
if($info['serial']!='')	
{
	$sqli2=mysqli_query($connection, "select id, consigneeid from jrcxl where serialnumber='".$info['serial']."'");
	if(mysqli_num_rows($sqli2)>0)
	{
	$info2=mysqli_fetch_array($sqli2);
	$sqli3=mysqli_query($connection, "update jrccalls set sourceid='".$info2['id']."', consigneeid='".$info2['consigneeid']."' where id='".$info['id']."'");
	if($sqli3)
	{
		echo $info['id'].'-'.$info2['id'].'-'.$info2['consigneeid'].'<br>';
	}
	}
	
	
}
}